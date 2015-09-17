<?php
/*
	This file is part of MapleRoad
	Copyright (C) 2015 João Gusmão
	
	This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

	require_once("class.connection.php");
	class npc {
		private $requisitedFields;
		private $results;
		private $life;
		

		public function getFromDB($npcid,$fields=false) {
			if($fields != false) {
				$explodedFields = explode(",",$fields);
				$toQuery = "";
				foreach($explodedFields as $field) {
					$toQuery .= "n.".$field.",";
				}
			} else {
				$explodedFields = null;
				$toQuery = "n.*,";
			}
			$this->requisitedFields = $explodedFields;
			
			if(is_numeric($npcid)) {
				$fieldToSearch = "npcid";
			} else {
				$fieldToSearch = "url";
			}
			
			//Load all equip informations
			$b = connection::getInstance()->prepare("SELECT ".$toQuery." n.npcid FROM npcs AS n WHERE n.".$fieldToSearch."=:id");
			$b->bindParam(":id",$npcid);
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			
			$this->results = $resColumn[0];
		}

		function __construct($npcid,$fields=false,$preQuery = false) {
			if(empty($npcid)) throw new Exception('NOT_FOUND');
			
			if($preQuery == false) {
				$this->getFromDB($npcid,$fields);
			} else {
				$this->results = $preQuery;
			}
			
		}
		
		public function getNpcid() {
			if($this->requisitedFields == null || in_array("npcid",$this->requisitedFields)) {
				return $this->results["npcid"];
			} else {
				return false;
			}
		}
		
		public function getName() {
			if($this->requisitedFields == null || in_array("name",$this->requisitedFields)) {
				return $this->results["name"];
			} else {
				return false;
			}
		}
		
		public function getFunc() {
			if($this->requisitedFields == null || in_array("func",$this->requisitedFields)) {
				return $this->results["func"];
			} else {
				return false;
			}
		}
		
		public function getUrl() {
			if($this->requisitedFields == null || in_array("url",$this->requisitedFields)) {
				return $this->results["url"];
			} else {
				return false;
			}
		}
		
		public function getSingleLink() {
			$localPath = LOCAL_PATH;
			if($this->getUrl() == "") {
				return $localPath."npc/".$this->getNpcid();
			} else {
				return $localPath."npc/".$this->getUrl();
			}
		}
		
		public function getCachedIcon() {
			$path = IMG_NPC_PATH;
			if($this->getUrl() == "") {
				if(file_exists("{$_SERVER['DOCUMENT_ROOT']}/".IMG_NPC_PATH.$this->getNpcid().".png")) {
					return $path.$this->getNpcid().".png";
				} else {
					return $path."";
				}
			} else {
				if(file_exists("{$_SERVER['DOCUMENT_ROOT']}/".IMG_NPC_PATH.$this->getUrl().".png")) {
					return $path.$this->getUrl().".png";
				} else{
					return $path."mob-no-img.png";
				}
			}
		}
	}