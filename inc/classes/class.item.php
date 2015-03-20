<?php
	require_once("class.connection.php");
	class item {
		
		private $requisitedFields;
		private $results;
		

		public function getFromDB($itemid,$fields=false) {
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
			
			if(is_numeric($itemid)) {
				$fieldToSearch = "itemid";
			} else {
				$fieldToSearch = "url";
			}
			
			//Load all equip informations
			$b = connection::getInstance()->prepare("SELECT ".$toQuery." i.itemid FROM items AS i WHERE i.".$fieldToSearch."=:id");
			$b->bindParam(":id",$itemid);
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			
			$this->results = $resColumn[0];
		}

		function __construct($itemid,$fields=false,$preQuery = false) {
			if(empty($itemid)) throw new Exception('NOT_FOUND');
			
			if($preQuery == false) {
				$this->getFromDB($itemid,$fields);
			} else {
				$this->results = $preQuery;
			}
			
		}
		
		public function getItemid() {
		  if($this->requisitedFields == null || in_array("itemid",$this->requisitedFields)) {
			return $this->results["itemid"];
		  } else {
			return false;
		  }
		}
		public function getIcon() {
		  if($this->requisitedFields == null || in_array("icon",$this->requisitedFields)) {
			return $this->results["icon"];
		  } else {
			return false;
		  }
		}
		public function getIconRaw() {
		  if($this->requisitedFields == null || in_array("iconRaw",$this->requisitedFields)) {
			return $this->results["iconRaw"];
		  } else {
			return false;
		  }
		}
		
		public function getCachedIcon() {
			$path = IMG_ITEM_PATH;
			if($this->getUrl() == "") {
				if(file_exists("{$_SERVER['DOCUMENT_ROOT']}/".IMG_ITEM_PATH.$this->getItemid().".png")) {
					return $path.$this->getItemid().".png";
				} else {
					return $path."";
				}
			} else {
				if(file_exists("{$_SERVER['DOCUMENT_ROOT']}/".IMG_ITEM_PATH.$this->getUrl().".png")) {
					return $path.$this->getUrl().".png";
				} else{
					return $path."item-no-img.png";
				}
			}
		}
		
		public function getSingleLink() {
			$localPath = LOCAL_PATH;
			if($this->getUrl() == "") {
				return $localPath."item/".$this->getItemid();
			} else {
				return $localPath."item/".$this->getUrl();
			}
		}
		public function getCash() {
		  if($this->requisitedFields == null || in_array("cash",$this->requisitedFields)) {
			return $this->results["cash"];
		  } else {
			return false;
		  }
		}
		public function getNoFlip() {
		  if($this->requisitedFields == null || in_array("noFlip",$this->requisitedFields)) {
			return $this->results["noFlip"];
		  } else {
			return false;
		  }
		}
		public function getSlotMax() {
		  if($this->requisitedFields == null || in_array("slotMax",$this->requisitedFields)) {
			return $this->results["slotMax"];
		  } else {
			return false;
		  }
		}
		public function getSoldInform() {
		  if($this->requisitedFields == null || in_array("soldInform",$this->requisitedFields)) {
			return $this->results["soldInform"];
		  } else {
			return false;
		  }
		}
		public function getProtectTime() {
		  if($this->requisitedFields == null || in_array("protectTime",$this->requisitedFields)) {
			return $this->results["protectTime"];
		  } else {
			return false;
		  }
		}
		public function getPath() {
		  if($this->requisitedFields == null || in_array("path",$this->requisitedFields)) {
			return $this->results["path"];
		  } else {
			return false;
		  }
		}
		public function getType() {
		  if($this->requisitedFields == null || in_array("type",$this->requisitedFields)) {
			return $this->results["type"];
		  } else {
			return false;
		  }
		}
		public function getFloatType() {
		  if($this->requisitedFields == null || in_array("floatType",$this->requisitedFields)) {
			return $this->results["floatType"];
		  } else {
			return false;
		  }
		}
		public function getTradeBlock() {
		  if($this->requisitedFields == null || in_array("tradeBlock",$this->requisitedFields)) {
			return $this->results["tradeBlock"];
		  } else {
			return false;
		  }
		}
		public function getSpeed() {
		  if($this->requisitedFields == null || in_array("speed",$this->requisitedFields)) {
			return $this->results["speed"];
		  } else {
			return false;
		  }
		}
		public function getDirection() {
		  if($this->requisitedFields == null || in_array("direction",$this->requisitedFields)) {
			return $this->results["direction"];
		  } else {
			return false;
		  }
		}
		public function getStateChangeItem() {
		  if($this->requisitedFields == null || in_array("stateChangeItem",$this->requisitedFields)) {
			return $this->results["stateChangeItem"];
		  } else {
			return false;
		  }
		}
		public function get0() {
		  if($this->requisitedFields == null || in_array("0",$this->requisitedFields)) {
			return $this->results["0"];
		  } else {
			return false;
		  }
		}
		public function getBgmPath() {
		  if($this->requisitedFields == null || in_array("bgmPath",$this->requisitedFields)) {
			return $this->results["bgmPath"];
		  } else {
			return false;
		  }
		}
		public function getIsBgmOrEffect() {
		  if($this->requisitedFields == null || in_array("isBgmOrEffect",$this->requisitedFields)) {
			return $this->results["isBgmOrEffect"];
		  } else {
			return false;
		  }
		}
		public function getRrepeat() {
		  if($this->requisitedFields == null || in_array("Rrepeat",$this->requisitedFields)) {
			return $this->results["Rrepeat"];
		  } else {
			return false;
		  }
		}
		public function getRecoveryRate() {
		  if($this->requisitedFields == null || in_array("recoveryRate",$this->requisitedFields)) {
			return $this->results["recoveryRate"];
		  } else {
			return false;
		  }
		}
		public function getLife() {
		  if($this->requisitedFields == null || in_array("life",$this->requisitedFields)) {
			return $this->results["life"];
		  } else {
			return false;
		  }
		}
		public function getPickupItem() {
		  if($this->requisitedFields == null || in_array("pickupItem",$this->requisitedFields)) {
			return $this->results["pickupItem"];
		  } else {
			return false;
		  }
		}
		public function getRadd() {
		  if($this->requisitedFields == null || in_array("Radd",$this->requisitedFields)) {
			return $this->results["Radd"];
		  } else {
			return false;
		  }
		}
		public function getConsumeHP() {
		  if($this->requisitedFields == null || in_array("consumeHP",$this->requisitedFields)) {
			return $this->results["consumeHP"];
		  } else {
			return false;
		  }
		}
		public function getLongRange() {
		  if($this->requisitedFields == null || in_array("longRange",$this->requisitedFields)) {
			return $this->results["longRange"];
		  } else {
			return false;
		  }
		}
		public function getDropSweep() {
		  if($this->requisitedFields == null || in_array("dropSweep",$this->requisitedFields)) {
			return $this->results["dropSweep"];
		  } else {
			return false;
		  }
		}
		public function getPickupAll() {
		  if($this->requisitedFields == null || in_array("pickupAll",$this->requisitedFields)) {
			return $this->results["pickupAll"];
		  } else {
			return false;
		  }
		}
		public function getIgnorePickup() {
		  if($this->requisitedFields == null || in_array("ignorePickup",$this->requisitedFields)) {
			return $this->results["ignorePickup"];
		  } else {
			return false;
		  }
		}
		public function getConsumeMP() {
		  if($this->requisitedFields == null || in_array("consumeMP",$this->requisitedFields)) {
			return $this->results["consumeMP"];
		  } else {
			return false;
		  }
		}
		public function getRecall() {
		  if($this->requisitedFields == null || in_array("recall",$this->requisitedFields)) {
			return $this->results["recall"];
		  } else {
			return false;
		  }
		}
		public function getAutoSpeaking() {
		  if($this->requisitedFields == null || in_array("autoSpeaking",$this->requisitedFields)) {
			return $this->results["autoSpeaking"];
		  } else {
			return false;
		  }
		}
		public function getMeso() {
		  if($this->requisitedFields == null || in_array("meso",$this->requisitedFields)) {
			return $this->results["meso"];
		  } else {
			return false;
		  }
		}
		public function getRate() {
		  if($this->requisitedFields == null || in_array("rate",$this->requisitedFields)) {
			return $this->results["rate"];
		  } else {
			return false;
		  }
		}
		public function getPachinko() {
		  if($this->requisitedFields == null || in_array("pachinko",$this->requisitedFields)) {
			return $this->results["pachinko"];
		  } else {
			return false;
		  }
		}
		public function getTime() {
		  if($this->requisitedFields == null || in_array("time",$this->requisitedFields)) {
			return $this->results["time"];
		  } else {
			return false;
		  }
		}
		public function getPrice() {
		  if($this->requisitedFields == null || in_array("price",$this->requisitedFields)) {
			return $this->results["price"];
		  } else {
			return false;
		  }
		}
		public function getSample() {
		  if($this->requisitedFields == null || in_array("sample",$this->requisitedFields)) {
			return $this->results["sample"];
		  } else {
			return false;
		  }
		}
		public function getEmotion() {
		  if($this->requisitedFields == null || in_array("emotion",$this->requisitedFields)) {
			return $this->results["emotion"];
		  } else {
			return false;
		  }
		}
		public function getNpc() {
		  if($this->requisitedFields == null || in_array("npc",$this->requisitedFields)) {
			return $this->results["npc"];
		  } else {
			return false;
		  }
		}
		public function getAddTime() {
		  if($this->requisitedFields == null || in_array("addTime",$this->requisitedFields)) {
			return $this->results["addTime"];
		  } else {
			return false;
		  }
		}
		public function getMaxDays() {
		  if($this->requisitedFields == null || in_array("maxDays",$this->requisitedFields)) {
			return $this->results["maxDays"];
		  } else {
			return false;
		  }
		}
		public function getSlotIndex() {
		  if($this->requisitedFields == null || in_array("slotIndex",$this->requisitedFields)) {
			return $this->results["slotIndex"];
		  } else {
			return false;
		  }
		}
		public function getAddDay() {
		  if($this->requisitedFields == null || in_array("addDay",$this->requisitedFields)) {
			return $this->results["addDay"];
		  } else {
			return false;
		  }
		}
		public function getIncLEV() {
		  if($this->requisitedFields == null || in_array("incLEV",$this->requisitedFields)) {
			return $this->results["incLEV"];
		  } else {
			return false;
		  }
		}
		public function getNotSale() {
		  if($this->requisitedFields == null || in_array("notSale",$this->requisitedFields)) {
			return $this->results["notSale"];
		  } else {
			return false;
		  }
		}
		public function getQuest() {
		  if($this->requisitedFields == null || in_array("quest",$this->requisitedFields)) {
			return $this->results["quest"];
		  } else {
			return false;
		  }
		}
		public function getTimeLimited() {
		  if($this->requisitedFields == null || in_array("timeLimited",$this->requisitedFields)) {
			return $this->results["timeLimited"];
		  } else {
			return false;
		  }
		}
		public function getMcType() {
		  if($this->requisitedFields == null || in_array("mcType",$this->requisitedFields)) {
			return $this->results["mcType"];
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
		public function getOnly() {
		  if($this->requisitedFields == null || in_array("only",$this->requisitedFields)) {
			return $this->results["only"];
		  } else {
			return false;
		  }
		}
		public function getTradBlock() {
		  if($this->requisitedFields == null || in_array("tradBlock",$this->requisitedFields)) {
			return $this->results["tradBlock"];
		  } else {
			return false;
		  }
		}
		public function getBigSize() {
		  if($this->requisitedFields == null || in_array("bigSize",$this->requisitedFields)) {
			return $this->results["bigSize"];
		  } else {
			return false;
		  }
		}
		public function getPquest() {
		  if($this->requisitedFields == null || in_array("pquest",$this->requisitedFields)) {
			return $this->results["pquest"];
		  } else {
			return false;
		  }
		}
		public function getTragetBlock() {
		  if($this->requisitedFields == null || in_array("tragetBlock",$this->requisitedFields)) {
			return $this->results["tragetBlock"];
		  } else {
			return false;
		  }
		}
		public function getNoCancelMouse() {
		  if($this->requisitedFields == null || in_array("noCancelMouse",$this->requisitedFields)) {
			return $this->results["noCancelMouse"];
		  } else {
			return false;
		  }
		}
		public function getScanTradeBlock() {
		  if($this->requisitedFields == null || in_array("scanTradeBlock",$this->requisitedFields)) {
			return $this->results["scanTradeBlock"];
		  } else {
			return false;
		  }
		}
		public function getMax() {
		  if($this->requisitedFields == null || in_array("max",$this->requisitedFields)) {
			return $this->results["max"];
		  } else {
			return false;
		  }
		}
		public function getIncPDD() {
		  if($this->requisitedFields == null || in_array("incPDD",$this->requisitedFields)) {
			return $this->results["incPDD"];
		  } else {
			return false;
		  }
		}
		public function getSuccess() {
		  if($this->requisitedFields == null || in_array("success",$this->requisitedFields)) {
			return $this->results["success"];
		  } else {
			return false;
		  }
		}
		public function getIncMDD() {
		  if($this->requisitedFields == null || in_array("incMDD",$this->requisitedFields)) {
			return $this->results["incMDD"];
		  } else {
			return false;
		  }
		}
		public function getIncACC() {
		  if($this->requisitedFields == null || in_array("incACC",$this->requisitedFields)) {
			return $this->results["incACC"];
		  } else {
			return false;
		  }
		}
		public function getIncMHP() {
		  if($this->requisitedFields == null || in_array("incMHP",$this->requisitedFields)) {
			return $this->results["incMHP"];
		  } else {
			return false;
		  }
		}
		public function getIcon_link() {
		  if($this->requisitedFields == null || in_array("icon_link",$this->requisitedFields)) {
			return $this->results["icon_link"];
		  } else {
			return false;
		  }
		}
		public function getIconRaw_link() {
		  if($this->requisitedFields == null || in_array("iconRaw_link",$this->requisitedFields)) {
			return $this->results["iconRaw_link"];
		  } else {
			return false;
		  }
		}
		public function getCursed() {
		  if($this->requisitedFields == null || in_array("cursed",$this->requisitedFields)) {
			return $this->results["cursed"];
		  } else {
			return false;
		  }
		}
		public function getIncINT() {
		  if($this->requisitedFields == null || in_array("incINT",$this->requisitedFields)) {
			return $this->results["incINT"];
		  } else {
			return false;
		  }
		}
		public function getIncDEX() {
		  if($this->requisitedFields == null || in_array("incDEX",$this->requisitedFields)) {
			return $this->results["incDEX"];
		  } else {
			return false;
		  }
		}
		public function getIncMAD() {
		  if($this->requisitedFields == null || in_array("incMAD",$this->requisitedFields)) {
			return $this->results["incMAD"];
		  } else {
			return false;
		  }
		}
		public function getIncPAD() {
		  if($this->requisitedFields == null || in_array("incPAD",$this->requisitedFields)) {
			return $this->results["incPAD"];
		  } else {
			return false;
		  }
		}
		public function getIncEVA() {
		  if($this->requisitedFields == null || in_array("incEVA",$this->requisitedFields)) {
			return $this->results["incEVA"];
		  } else {
			return false;
		  }
		}
		public function getIncSTR() {
		  if($this->requisitedFields == null || in_array("incSTR",$this->requisitedFields)) {
			return $this->results["incSTR"];
		  } else {
			return false;
		  }
		}
		public function getIncLUK() {
		  if($this->requisitedFields == null || in_array("incLUK",$this->requisitedFields)) {
			return $this->results["incLUK"];
		  } else {
			return false;
		  }
		}
		public function getIncSpeed() {
		  if($this->requisitedFields == null || in_array("incSpeed",$this->requisitedFields)) {
			return $this->results["incSpeed"];
		  } else {
			return false;
		  }
		}
		public function getIncMMP() {
		  if($this->requisitedFields == null || in_array("incMMP",$this->requisitedFields)) {
			return $this->results["incMMP"];
		  } else {
			return false;
		  }
		}
		public function getIncJump() {
		  if($this->requisitedFields == null || in_array("incJump",$this->requisitedFields)) {
			return $this->results["incJump"];
		  } else {
			return false;
		  }
		}
		public function getPreventslip() {
		  if($this->requisitedFields == null || in_array("preventslip",$this->requisitedFields)) {
			return $this->results["preventslip"];
		  } else {
			return false;
		  }
		}
		public function getWarmsupport() {
		  if($this->requisitedFields == null || in_array("warmsupport",$this->requisitedFields)) {
			return $this->results["warmsupport"];
		  } else {
			return false;
		  }
		}
		public function getReqRUC() {
		  if($this->requisitedFields == null || in_array("reqRUC",$this->requisitedFields)) {
			return $this->results["reqRUC"];
		  } else {
			return false;
		  }
		}
		public function getRecover() {
		  if($this->requisitedFields == null || in_array("recover",$this->requisitedFields)) {
			return $this->results["recover"];
		  } else {
			return false;
		  }
		}
		public function getReqLevel() {
		  if($this->requisitedFields == null || in_array("reqLevel",$this->requisitedFields)) {
			return $this->results["reqLevel"];
		  } else {
			return false;
		  }
		}
		public function getRandom() {
		  if($this->requisitedFields == null || in_array("random",$this->requisitedFields)) {
			return $this->results["random"];
		  } else {
			return false;
		  }
		}
		public function getMob() {
		  if($this->requisitedFields == null || in_array("mob",$this->requisitedFields)) {
			return $this->results["mob"];
		  } else {
			return false;
		  }
		}
		public function getRcreate() {
		  if($this->requisitedFields == null || in_array("Rcreate",$this->requisitedFields)) {
			return $this->results["Rcreate"];
		  } else {
			return false;
		  }
		}
		public function getRleft() {
		  if($this->requisitedFields == null || in_array("Rleft",$this->requisitedFields)) {
			return $this->results["Rleft"];
		  } else {
			return false;
		  }
		}
		public function getRright() {
		  if($this->requisitedFields == null || in_array("Rright",$this->requisitedFields)) {
			return $this->results["Rright"];
		  } else {
			return false;
		  }
		}
		public function getTop() {
		  if($this->requisitedFields == null || in_array("top",$this->requisitedFields)) {
			return $this->results["top"];
		  } else {
			return false;
		  }
		}
		public function getBottom() {
		  if($this->requisitedFields == null || in_array("bottom",$this->requisitedFields)) {
			return $this->results["bottom"];
		  } else {
			return false;
		  }
		}
		public function getMobHP() {
		  if($this->requisitedFields == null || in_array("mobHP",$this->requisitedFields)) {
			return $this->results["mobHP"];
		  } else {
			return false;
		  }
		}
		public function getBridleMsgType() {
		  if($this->requisitedFields == null || in_array("bridleMsgType",$this->requisitedFields)) {
			return $this->results["bridleMsgType"];
		  } else {
			return false;
		  }
		}
		public function getBridleProp() {
		  if($this->requisitedFields == null || in_array("bridleProp",$this->requisitedFields)) {
			return $this->results["bridleProp"];
		  } else {
			return false;
		  }
		}
		public function getUseDelay() {
		  if($this->requisitedFields == null || in_array("useDelay",$this->requisitedFields)) {
			return $this->results["useDelay"];
		  } else {
			return false;
		  }
		}
		public function getDelayMsg() {
		  if($this->requisitedFields == null || in_array("delayMsg",$this->requisitedFields)) {
			return $this->results["delayMsg"];
		  } else {
			return false;
		  }
		}
		public function getMasterLevel() {
		  if($this->requisitedFields == null || in_array("masterLevel",$this->requisitedFields)) {
			return $this->results["masterLevel"];
		  } else {
			return false;
		  }
		}
		public function getTradeAvailable() {
		  if($this->requisitedFields == null || in_array("tradeAvailable",$this->requisitedFields)) {
			return $this->results["tradeAvailable"];
		  } else {
			return false;
		  }
		}
		public function getReqSkillLevel() {
		  if($this->requisitedFields == null || in_array("reqSkillLevel",$this->requisitedFields)) {
			return $this->results["reqSkillLevel"];
		  } else {
			return false;
		  }
		}
		public function getMaxLevel() {
		  if($this->requisitedFields == null || in_array("maxLevel",$this->requisitedFields)) {
			return $this->results["maxLevel"];
		  } else {
			return false;
		  }
		}
		public function getMonsterBook() {
		  if($this->requisitedFields == null || in_array("monsterBook",$this->requisitedFields)) {
			return $this->results["monsterBook"];
		  } else {
			return false;
		  }
		}
		public function getLv() {
		  if($this->requisitedFields == null || in_array("lv",$this->requisitedFields)) {
			return $this->results["lv"];
		  } else {
			return false;
		  }
		}
		public function getPickUpBlock() {
		  if($this->requisitedFields == null || in_array("pickUpBlock",$this->requisitedFields)) {
			return $this->results["pickUpBlock"];
		  } else {
			return false;
		  }
		}
		public function getShowMessage() {
		  if($this->requisitedFields == null || in_array("showMessage",$this->requisitedFields)) {
			return $this->results["showMessage"];
		  } else {
			return false;
		  }
		}
		public function getExp() {
		  if($this->requisitedFields == null || in_array("exp",$this->requisitedFields)) {
			return $this->results["exp"];
		  } else {
			return false;
		  }
		}
		public function getNotExtend() {
		  if($this->requisitedFields == null || in_array("notExtend",$this->requisitedFields)) {
			return $this->results["notExtend"];
		  } else {
			return false;
		  }
		}
		public function getSlotMat() {
		  if($this->requisitedFields == null || in_array("slotMat",$this->requisitedFields)) {
			return $this->results["slotMat"];
		  } else {
			return false;
		  }
		}
		public function getExpireOnLogout() {
		  if($this->requisitedFields == null || in_array("expireOnLogout",$this->requisitedFields)) {
			return $this->results["expireOnLogout"];
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
		public function getDescr() {
		  if($this->requisitedFields == null || in_array("descr",$this->requisitedFields)) {
			return $this->results["descr"];
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
		public function getUiData() {
		  if($this->requisitedFields == null || in_array("uiData",$this->requisitedFields)) {
			return $this->results["uiData"];
		  } else {
			return false;
		  }
		}
		public function getGrade() {
		  if($this->requisitedFields == null || in_array("grade",$this->requisitedFields)) {
			return $this->results["grade"];
		  } else {
			return false;
		  }
		}
		public function getQuestId() {
		  if($this->requisitedFields == null || in_array("questId",$this->requisitedFields)) {
			return $this->results["questId"];
		  } else {
			return false;
		  }
		}
		public function getHybrid() {
		  if($this->requisitedFields == null || in_array("hybrid",$this->requisitedFields)) {
			return $this->results["hybrid"];
		  } else {
			return false;
		  }
		}
		public function getIncMaxHP() {
		  if($this->requisitedFields == null || in_array("incMaxHP",$this->requisitedFields)) {
			return $this->results["incMaxHP"];
		  } else {
			return false;
		  }
		}
		public function getIncMaxMP() {
		  if($this->requisitedFields == null || in_array("incMaxMP",$this->requisitedFields)) {
			return $this->results["incMaxMP"];
		  } else {
			return false;
		  }
		}
		public function getIncReqLevel() {
		  if($this->requisitedFields == null || in_array("incReqLevel",$this->requisitedFields)) {
			return $this->results["incReqLevel"];
		  } else {
			return false;
		  }
		}
		public function getRandOption() {
		  if($this->requisitedFields == null || in_array("randOption",$this->requisitedFields)) {
			return $this->results["randOption"];
		  } else {
			return false;
		  }
		}
		public function getRandStat() {
		  if($this->requisitedFields == null || in_array("randStat",$this->requisitedFields)) {
			return $this->results["randStat"];
		  } else {
			return false;
		  }
		}
		public function getLvMin() {
		  if($this->requisitedFields == null || in_array("lvMin",$this->requisitedFields)) {
			return $this->results["lvMin"];
		  } else {
			return false;
		  }
		}
		public function getLvMax() {
		  if($this->requisitedFields == null || in_array("lvMax",$this->requisitedFields)) {
			return $this->results["lvMax"];
		  } else {
			return false;
		  }
		}
		public function getRecoveryHP() {
		  if($this->requisitedFields == null || in_array("recoveryHP",$this->requisitedFields)) {
			return $this->results["recoveryHP"];
		  } else {
			return false;
		  }
		}
		public function getRecoveryMP() {
		  if($this->requisitedFields == null || in_array("recoveryMP",$this->requisitedFields)) {
			return $this->results["recoveryMP"];
		  } else {
			return false;
		  }
		}
		public function getDistanceX() {
		  if($this->requisitedFields == null || in_array("distanceX",$this->requisitedFields)) {
			return $this->results["distanceX"];
		  } else {
			return false;
		  }
		}
		public function getDistanceY() {
		  if($this->requisitedFields == null || in_array("distanceY",$this->requisitedFields)) {
			return $this->results["distanceY"];
		  } else {
			return false;
		  }
		}
		public function getMaxDiff() {
		  if($this->requisitedFields == null || in_array("maxDiff",$this->requisitedFields)) {
			return $this->results["maxDiff"];
		  } else {
			return false;
		  }
		}
		public function getIconD() {
		  if($this->requisitedFields == null || in_array("iconD",$this->requisitedFields)) {
			return $this->results["iconD"];
		  } else {
			return false;
		  }
		}
		public function getIconRawD() {
		  if($this->requisitedFields == null || in_array("iconRawD",$this->requisitedFields)) {
			return $this->results["iconRawD"];
		  } else {
			return false;
		  }
		}
		public function getHungry() {
		  if($this->requisitedFields == null || in_array("hungry",$this->requisitedFields)) {
			return $this->results["hungry"];
		  } else {
			return false;
		  }
		}
		public function getNameTag() {
		  if($this->requisitedFields == null || in_array("nameTag",$this->requisitedFields)) {
			return $this->results["nameTag"];
		  } else {
			return false;
		  }
		}
		public function getChatBalloon() {
		  if($this->requisitedFields == null || in_array("chatBalloon",$this->requisitedFields)) {
			return $this->results["chatBalloon"];
		  } else {
			return false;
		  }
		}
		public function getEvol() {
		  if($this->requisitedFields == null || in_array("evol",$this->requisitedFields)) {
			return $this->results["evol"];
		  } else {
			return false;
		  }
		}
		public function getEvol1() {
		  if($this->requisitedFields == null || in_array("evol1",$this->requisitedFields)) {
			return $this->results["evol1"];
		  } else {
			return false;
		  }
		}
		public function getEvolReqItemID() {
		  if($this->requisitedFields == null || in_array("evolReqItemID",$this->requisitedFields)) {
			return $this->results["evolReqItemID"];
		  } else {
			return false;
		  }
		}
		public function getEvolNo() {
		  if($this->requisitedFields == null || in_array("evolNo",$this->requisitedFields)) {
			return $this->results["evolNo"];
		  } else {
			return false;
		  }
		}
		public function getEvolProb1() {
		  if($this->requisitedFields == null || in_array("evolProb1",$this->requisitedFields)) {
			return $this->results["evolProb1"];
		  } else {
			return false;
		  }
		}
		public function getEvol2() {
		  if($this->requisitedFields == null || in_array("evol2",$this->requisitedFields)) {
			return $this->results["evol2"];
		  } else {
			return false;
		  }
		}
		public function getEvol3() {
		  if($this->requisitedFields == null || in_array("evol3",$this->requisitedFields)) {
			return $this->results["evol3"];
		  } else {
			return false;
		  }
		}
		public function getEvol4() {
		  if($this->requisitedFields == null || in_array("evol4",$this->requisitedFields)) {
			return $this->results["evol4"];
		  } else {
			return false;
		  }
		}
		public function getEvolProb2() {
		  if($this->requisitedFields == null || in_array("evolProb2",$this->requisitedFields)) {
			return $this->results["evolProb2"];
		  } else {
			return false;
		  }
		}
		public function getEvolProb3() {
		  if($this->requisitedFields == null || in_array("evolProb3",$this->requisitedFields)) {
			return $this->results["evolProb3"];
		  } else {
			return false;
		  }
		}
		public function getEvolProb4() {
		  if($this->requisitedFields == null || in_array("evolProb4",$this->requisitedFields)) {
			return $this->results["evolProb4"];
		  } else {
			return false;
		  }
		}
		public function getEvolReqPetLvl() {
		  if($this->requisitedFields == null || in_array("evolReqPetLvl",$this->requisitedFields)) {
			return $this->results["evolReqPetLvl"];
		  } else {
			return false;
		  }
		}
		public function getAutoReact() {
		  if($this->requisitedFields == null || in_array("autoReact",$this->requisitedFields)) {
			return $this->results["autoReact"];
		  } else {
			return false;
		  }
		}
		public function getEvol5() {
		  if($this->requisitedFields == null || in_array("evol5",$this->requisitedFields)) {
			return $this->results["evol5"];
		  } else {
			return false;
		  }
		}
		public function getEvolProb5() {
		  if($this->requisitedFields == null || in_array("evolProb5",$this->requisitedFields)) {
			return $this->results["evolProb5"];
		  } else {
			return false;
		  }
		}
		public function getLimitedLife() {
		  if($this->requisitedFields == null || in_array("limitedLife",$this->requisitedFields)) {
			return $this->results["limitedLife"];
		  } else {
			return false;
		  }
		}
		public function getNoRevive() {
		  if($this->requisitedFields == null || in_array("noRevive",$this->requisitedFields)) {
			return $this->results["noRevive"];
		  } else {
			return false;
		  }
		}
		public function getNoMoveToLocker() {
		  if($this->requisitedFields == null || in_array("noMoveToLocker",$this->requisitedFields)) {
			return $this->results["noMoveToLocker"];
		  } else {
			return false;
		  }
		}
		public function getPermanent() {
		  if($this->requisitedFields == null || in_array("permanent",$this->requisitedFields)) {
			return $this->results["permanent"];
		  } else {
			return false;
		  }
		}
		public function getItemtype() {
		  if($this->requisitedFields == null || in_array("itemtype",$this->requisitedFields)) {
			return $this->results["itemtype"];
		  } else {
			return false;
		  }
		}
	}