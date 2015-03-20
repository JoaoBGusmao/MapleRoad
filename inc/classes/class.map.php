<?php
	require_once("class.connection.php");
	class map {
		
		private $requisitedFields;
		private $results;
		private $life;
		

		public function getFromDB($mapid,$fields=false) {
			if($fields != false) {
				$explodedFields = explode(",",$fields);
				$toQuery = "";
				foreach($explodedFields as $field) {
					$toQuery .= "i.".$field.",";
				}
			} else {
				$explodedFields = null;
				$toQuery = "i.*,";
			}
			$this->requisitedFields = $explodedFields;
			
			if(is_numeric($mapid)) {
				$fieldToSearch = "mapid";
			} else {
				$fieldToSearch = "url";
			}
			
			//Load all equip informations
			$b = connection::getInstance()->prepare("SELECT ".$toQuery." i.mapid FROM maps AS i WHERE i.".$fieldToSearch."=:id");
			$b->bindParam(":id",$mapid);
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			
			$this->results = $resColumn[0];
		}

		function __construct($mapid,$fields=false,$preQuery = false) {
			if(empty($mapid)) throw new Exception('NOT_FOUND');
			
			if($preQuery == false) {
				$this->getFromDB($mapid,$fields);
			} else {
				$this->results = $preQuery;
			}
			
		}
		
		public function getMapid() {
			if($this->requisitedFields == null || in_array("mapid",$this->requisitedFields)) {
				return $this->results["mapid"];
			  } else {
				return false;
			  }
		}
		public function getBgm() {
			if($this->requisitedFields == null || in_array("bgm",$this->requisitedFields)) {
				return $this->results["bgm"];
			  } else {
				return false;
			  }
		}
		public function getMapMark() {
			if($this->requisitedFields == null || in_array("mapMark",$this->requisitedFields)) {
				return $this->results["mapMark"];
			  } else {
				return false;
			  }
		}
		public function getOnFirstUserEnter() {
			if($this->requisitedFields == null || in_array("onFirstUserEnter",$this->requisitedFields)) {
				return $this->results["onFirstUserEnter"];
			  } else {
				return false;
			  }
		}
		public function getOnUserEnter() {
			if($this->requisitedFields == null || in_array("onUserEnter",$this->requisitedFields)) {
				return $this->results["onUserEnter"];
			  } else {
				return false;
			  }
		}
		public function getVersion() {
			if($this->requisitedFields == null || in_array("version",$this->requisitedFields)) {
				return $this->results["version"];
			  } else {
				return false;
			  }
		}
		public function getCloud() {
			if($this->requisitedFields == null || in_array("cloud",$this->requisitedFields)) {
				return $this->results["cloud"];
			  } else {
				return false;
			  }
		}
		public function getTown() {
			if($this->requisitedFields == null || in_array("town",$this->requisitedFields)) {
				return $this->results["town"];
			  } else {
				return false;
			  }
		}
		public function getSwim() {
			if($this->requisitedFields == null || in_array("swim",$this->requisitedFields)) {
				return $this->results["swim"];
			  } else {
				return false;
			  }
		}
		public function getReturnMap() {
			if($this->requisitedFields == null || in_array("returnMap",$this->requisitedFields)) {
				return $this->results["returnMap"];
			  } else {
				return false;
			  }
		}
		public function getForcedReturn() {
			if($this->requisitedFields == null || in_array("forcedReturn",$this->requisitedFields)) {
				return $this->results["forcedReturn"];
			  } else {
				return false;
			  }
		}
		public function getFly() {
			if($this->requisitedFields == null || in_array("fly",$this->requisitedFields)) {
				return $this->results["fly"];
			  } else {
				return false;
			  }
		}
		public function getNoMapCmd() {
			if($this->requisitedFields == null || in_array("noMapCmd",$this->requisitedFields)) {
				return $this->results["noMapCmd"];
			  } else {
				return false;
			  }
		}
		public function getHideMinimap() {
			if($this->requisitedFields == null || in_array("hideMinimap",$this->requisitedFields)) {
				return $this->results["hideMinimap"];
			  } else {
				return false;
			  }
		}
		public function getFieldLimit() {
			if($this->requisitedFields == null || in_array("fieldLimit",$this->requisitedFields)) {
				return $this->results["fieldLimit"];
			  } else {
				return false;
			  }
		}
		public function getVRTop() {
			if($this->requisitedFields == null || in_array("VRTop",$this->requisitedFields)) {
				return $this->results["VRTop"];
			  } else {
				return false;
			  }
		}
		public function getVRLeft() {
			if($this->requisitedFields == null || in_array("VRLeft",$this->requisitedFields)) {
				return $this->results["VRLeft"];
			  } else {
				return false;
			  }
		}
		public function getVRBottom() {
			if($this->requisitedFields == null || in_array("VRBottom",$this->requisitedFields)) {
				return $this->results["VRBottom"];
			  } else {
				return false;
			  }
		}
		public function getVRRight() {
			if($this->requisitedFields == null || in_array("VRRight",$this->requisitedFields)) {
				return $this->results["VRRight"];
			  } else {
				return false;
			  }
		}
		public function getFieldType() {
			if($this->requisitedFields == null || in_array("fieldType",$this->requisitedFields)) {
				return $this->results["fieldType"];
			  } else {
				return false;
			  }
		}
		public function getMapDesc() {
			if($this->requisitedFields == null || in_array("mapDesc",$this->requisitedFields)) {
				return $this->results["mapDesc"];
			  } else {
				return false;
			  }
		}
		public function getMoveLimit() {
			if($this->requisitedFields == null || in_array("moveLimit",$this->requisitedFields)) {
				return $this->results["moveLimit"];
			  } else {
				return false;
			  }
		}
		public function getStreetName() {
			if($this->requisitedFields == null || in_array("streetName",$this->requisitedFields)) {
				return $this->results["streetName"];
			  } else {
				return false;
			  }
		}
		public function getMapName() {
			if($this->requisitedFields == null || in_array("mapName",$this->requisitedFields)) {
				return $this->results["mapName"];
			  } else {
				return false;
			  }
		}
		public function getCachedIcon() {
			$path = IMG_MAP_PATH;
			if($this->getUrl() == "") {
				if(file_exists("{$_SERVER['DOCUMENT_ROOT']}/".IMG_MAP_PATH.$this->getMapId().".png")) {
					return $path.$this->getMapid().".png";
				} else {
					return $path."";
				}
			} else {
				if(file_exists("{$_SERVER['DOCUMENT_ROOT']}/".IMG_MAP_PATH.$this->getUrl().".png")) {
					return $path.$this->getUrl().".png";
				} else{
					return $path."map-no-img.png";
				}
			}
		}
		public function getContinent() {
			if($this->requisitedFields == null || in_array("continent",$this->requisitedFields)) {
				return $this->results["continent"];
			  } else {
				return false;
			  }
		}
		public function getMiniMapOnOff() {
			if($this->requisitedFields == null || in_array("miniMapOnOff",$this->requisitedFields)) {
				return $this->results["miniMapOnOff"];
			  } else {
				return false;
			  }
		}
		public function getTimeLimit() {
			if($this->requisitedFields == null || in_array("timeLimit",$this->requisitedFields)) {
				return $this->results["timeLimit"];
			  } else {
				return false;
			  }
		}
		public function getLink() {
			if($this->requisitedFields == null || in_array("link",$this->requisitedFields)) {
				return $this->results["link"];
			  } else {
				return false;
			  }
		}
		public function getHelp() {
			if($this->requisitedFields == null || in_array("help",$this->requisitedFields)) {
				return $this->results["help"];
			  } else {
				return false;
			  }
		}
		public function getLvLimit() {
			if($this->requisitedFields == null || in_array("lvLimit",$this->requisitedFields)) {
				return $this->results["lvLimit"];
			  } else {
				return false;
			  }
		}
		public function getSnow() {
			if($this->requisitedFields == null || in_array("snow",$this->requisitedFields)) {
				return $this->results["snow"];
			  } else {
				return false;
			  }
		}
		public function getRain() {
			if($this->requisitedFields == null || in_array("rain",$this->requisitedFields)) {
				return $this->results["rain"];
			  } else {
				return false;
			  }
		}
		public function getLvForceMove() {
			if($this->requisitedFields == null || in_array("lvForceMove",$this->requisitedFields)) {
				return $this->results["lvForceMove"];
			  } else {
				return false;
			  }
		}
		public function getDecHP() {
			if($this->requisitedFields == null || in_array("decHP",$this->requisitedFields)) {
				return $this->results["decHP"];
			  } else {
				return false;
			  }
		}
		public function getDecInterval() {
			if($this->requisitedFields == null || in_array("decInterval",$this->requisitedFields)) {
				return $this->results["decInterval"];
			  } else {
				return false;
			  }
		}
		public function getProtectItem() {
			if($this->requisitedFields == null || in_array("protectItem",$this->requisitedFields)) {
				return $this->results["protectItem"];
			  } else {
				return false;
			  }
		}
		public function getDropExpire() {
			if($this->requisitedFields == null || in_array("dropExpire",$this->requisitedFields)) {
				return $this->results["dropExpire"];
			  } else {
				return false;
			  }
		}
		public function getEffect() {
			if($this->requisitedFields == null || in_array("effect",$this->requisitedFields)) {
				return $this->results["effect"];
			  } else {
				return false;
			  }
		}
		public function getVRLimit() {
			if($this->requisitedFields == null || in_array("VRLimit",$this->requisitedFields)) {
				return $this->results["VRLimit"];
			  } else {
				return false;
			  }
		}
		public function getEverlast() {
			if($this->requisitedFields == null || in_array("everlast",$this->requisitedFields)) {
				return $this->results["everlast"];
			  } else {
				return false;
			  }
		}
		public function getScrollDisable() {
			if($this->requisitedFields == null || in_array("scrollDisable",$this->requisitedFields)) {
				return $this->results["scrollDisable"];
			  } else {
				return false;
			  }
		}
		public function getPartyOnly() {
			if($this->requisitedFields == null || in_array("partyOnly",$this->requisitedFields)) {
				return $this->results["partyOnly"];
			  } else {
				return false;
			  }
		}
		public function getAllMoveCheck() {
			if($this->requisitedFields == null || in_array("allMoveCheck",$this->requisitedFields)) {
				return $this->results["allMoveCheck"];
			  } else {
				return false;
			  }
		}
		public function getZakum2Hack() {
			if($this->requisitedFields == null || in_array("zakum2Hack",$this->requisitedFields)) {
				return $this->results["zakum2Hack"];
			  } else {
				return false;
			  }
		}
		public function getTimeOut() {
			if($this->requisitedFields == null || in_array("timeOut",$this->requisitedFields)) {
				return $this->results["timeOut"];
			  } else {
				return false;
			  }
		}
		public function getNoRegenMap() {
			if($this->requisitedFields == null || in_array("noRegenMap",$this->requisitedFields)) {
				return $this->results["noRegenMap"];
			  } else {
				return false;
			  }
		}
		public function getReactorShuffle() {
			if($this->requisitedFields == null || in_array("reactorShuffle",$this->requisitedFields)) {
				return $this->results["reactorShuffle"];
			  } else {
				return false;
			  }
		}
		public function getPersonalShop() {
			if($this->requisitedFields == null || in_array("personalShop",$this->requisitedFields)) {
				return $this->results["personalShop"];
			  } else {
				return false;
			  }
		}
		public function getEntrustedShop() {
			if($this->requisitedFields == null || in_array("entrustedShop",$this->requisitedFields)) {
				return $this->results["entrustedShop"];
			  } else {
				return false;
			  }
		}
		public function getFixedMobCapacity() {
			if($this->requisitedFields == null || in_array("fixedMobCapacity",$this->requisitedFields)) {
				return $this->results["fixedMobCapacity"];
			  } else {
				return false;
			  }
		}
		public function getCreateMobInterval() {
			if($this->requisitedFields == null || in_array("createMobInterval",$this->requisitedFields)) {
				return $this->results["createMobInterval"];
			  } else {
				return false;
			  }
		}
		public function getReactorShuffleName() {
			if($this->requisitedFields == null || in_array("reactorShuffleName",$this->requisitedFields)) {
				return $this->results["reactorShuffleName"];
			  } else {
				return false;
			  }
		}
		public function getDamageCheckFree() {
			if($this->requisitedFields == null || in_array("damageCheckFree",$this->requisitedFields)) {
				return $this->results["damageCheckFree"];
			  } else {
				return false;
			  }
		}
		public function getBlockPBossChange() {
			if($this->requisitedFields == null || in_array("blockPBossChange",$this->requisitedFields)) {
				return $this->results["blockPBossChange"];
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
		
		public function getLife() {
			if($this->life == null) {
				$b = connection::getInstance()->prepare("SELECT * FROM maps_life WHERE i.mapid=:id");
				$b->bindParam(":id",$this->getMapid());
				$b->execute();
				$resColumn = $b->fetchAll();
				
				if($resColumn == null) {
					throw new Exception('NOT_FOUND');
				}
				$this->life = $resColumn;
				return $this->life;
			} else {
				return $life;
			}
		}
		
		public function getSingleLink() {
			$localPath = LOCAL_PATH;
			if($this->getUrl() == "") {
				return $localPath."mapa/".$this->getMapid();
			} else {
				return $localPath."mapa/".$this->getUrl();
			}
		}
		
	}