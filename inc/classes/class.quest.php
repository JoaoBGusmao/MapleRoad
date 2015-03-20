<?php
	require_once("class.connection.php");
	class quest {
		
		private $name;
		private $questid;
		private $questreqdata;
		private $results;
		
		function __construct($questid,$preQuery = false) {
			if(empty($questid)) throw new Exception('NOT_FOUND');
			
			if($preQuery == false) {
				$this->getFromDB($questid);
			} else {
				$this->results = $preQuery;
			}
		}
		

		function getFromDB($questid) {
			if(is_numeric($questid)) {
				$fieldToSearch = "questid";
			} else {
				$fieldToSearch = "url";
			}
			
			//Load quest informations
			$b = connection::getInstance()->prepare("SELECT name,questid,url FROM wz_questdata WHERE ".$fieldToSearch."=:id");
			$b->bindParam(":id",$questid);
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			
			$this->results = $resColumn[0];
		}
		
		public function getQuestid() {
			return $this->results["questid"];
		}
		
		public function getName() {
			return $this->results["name"];
		}
		
		public function getUrl() {
			return $this->results["url"];
		}
		
		public function loadReqData() {
			//Load quest informations
			$b = connection::getInstance()->prepare("SELECT name,questid,type,stringStore,intStoresFirst,intStoresSecond FROM wz_questreqdata WHERE questid=:id");
			$questid = $this->getQuestid();
			$b->bindParam(":id",$questid);
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			$this->questreqdata = $resColumn;
		}
		
		public function loadActData() {
			//Load quest informations
			$b = connection::getInstance()->prepare("SELECT a.*,i.itemid,i.count FROM wz_questactdata as a LEFT JOIN wz_questactitemdata as i ON(i.uniqueid=a.uniqueid) where questid=:id");
			$questid = $this->getQuestid();
			$b->bindParam(":id",$questid);
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			$this->questactdata = $resColumn;
		}
		
		public function getReqData() {
			return $this->questreqdata;
		}
		
		public function getActData() {
			return $this->questactdata;
		}
		
		public function getReqInfo($info,$type=false) {
			if($type == false) $type = 0;
			foreach($this->questreqdata as $req) {
				if($req["name"] == $info && $req["type"] == $type) {
					return $req;
				}
			}
			return null;
		}
		
		public function getActInfo($info,$type=false) {
			if($type == false) $type = 0;
			$return = Array();
			foreach($this->questactdata as $act) {
				if($act["name"] == $info && $act["type"] == $type) {
					array_push($return,$act);
				}
			}
			return $return;
		}
		
		public function getSingleLink() {
			$localPath = LOCAL_PATH;
			if($this->getUrl() == "") {
				return $localPath."missao/".$this->getQuestid();
			} else {
				return $localPath."missao/".$this->getUrl();
			}
		}
		
	}