<?php
	require_once("class.connection.php");
	class equip {
		
		private $requisitedFields;
		private $results;
		
		
		public function getFromDB($itemid,$fields=false) {
			if($fields != false) {
				$explodedFields = explode(",",$fields);
				$toQuery = "";
				foreach($explodedFields as $field) {
					$toQuery .= "e.".$field.",";
				}
			} else {
				$explodedFields = null;
				$toQuery = "e.*,";
			}
			$this->requisitedFields = $explodedFields;
			
			if(is_numeric($itemid)) {
				$fieldToSearch = "itemid";
			} else {
				$fieldToSearch = "url";
			}
			
			//Load all equip informations
			$b = connection::getInstance()->prepare("SELECT ".$toQuery." e.itemid FROM equips AS e WHERE e.".$fieldToSearch."=:id");
			$b->bindParam(":id",$itemid);
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			
			//put informations in variables
			
			
			$this->results = $resColumn[0];
		}

		function __construct($itemid,$fields=false,$preQuery = false) {
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
			$path = IMG_EQUIP_PATH;
			if($this->getUrl() == "") {
				if(file_exists("{$_SERVER['DOCUMENT_ROOT']}/".IMG_EQUIP_PATH.$this->getItemid().".png")) {
					return $path.$this->getItemid().".png";
				} else {
					return $path."";
				}
			} else {
				if(file_exists("{$_SERVER['DOCUMENT_ROOT']}/".IMG_EQUIP_PATH.$this->getUrl().".png")) {
					return $path.$this->getUrl().".png";
				} else{
					return $path."item-no-img.png";
				}
			}
		}
		
		public function getSingleLink() {
			$localPath = LOCAL_PATH;
			if($this->getUrl() == "") {
				return $localPath."equipamento/".$this->getItemid();
			} else {
				return $localPath."equipamento/".$this->getUrl();
			}
		}
		public function getIslot() {
		  if($this->requisitedFields == null || in_array("islot",$this->requisitedFields)) {
			return $this->results["islot"];
		  } else {
			return false;
		  }
		}
		public function getVslot() {
		  if($this->requisitedFields == null || in_array("vslot",$this->requisitedFields)) {
			return $this->results["vslot"];
		  } else {
			return false;
		  }
		}
		public function getReqJob() {
		  if($this->requisitedFields == null || in_array("reqJob",$this->requisitedFields)) {
			return $this->results["reqJob"];
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
		public function getReqSTR() {
		  if($this->requisitedFields == null || in_array("reqSTR",$this->requisitedFields)) {
			return $this->results["reqSTR"];
		  } else {
			return false;
		  }
		}
		public function getReqDEX() {
		  if($this->requisitedFields == null || in_array("reqDEX",$this->requisitedFields)) {
			return $this->results["reqDEX"];
		  } else {
			return false;
		  }
		}
		public function getReqINT() {
		  if($this->requisitedFields == null || in_array("reqINT",$this->requisitedFields)) {
			return $this->results["reqINT"];
		  } else {
			return false;
		  }
		}
		public function getReqLUK() {
		  if($this->requisitedFields == null || in_array("reqLUK",$this->requisitedFields)) {
			return $this->results["reqLUK"];
		  } else {
			return false;
		  }
		}
		public function getCash() {
		  if($this->requisitedFields == null || in_array("cash",$this->requisitedFields)) {
			return $this->results["cash"];
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
		public function getTimeLimited() {
		  if($this->requisitedFields == null || in_array("timeLimited",$this->requisitedFields)) {
			return $this->results["timeLimited"];
		  } else {
			return false;
		  }
		}
		public function getTuc() {
		  if($this->requisitedFields == null || in_array("tuc",$this->requisitedFields)) {
			return $this->results["tuc"];
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
		public function getIncINT() {
		  if($this->requisitedFields == null || in_array("incINT",$this->requisitedFields)) {
			return $this->results["incINT"];
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
		public function getIncPDD() {
		  if($this->requisitedFields == null || in_array("incPDD",$this->requisitedFields)) {
			return $this->results["incPDD"];
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
		public function getIncMDD() {
		  if($this->requisitedFields == null || in_array("incMDD",$this->requisitedFields)) {
			return $this->results["incMDD"];
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
		public function getIncACC() {
		  if($this->requisitedFields == null || in_array("incACC",$this->requisitedFields)) {
			return $this->results["incACC"];
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
		public function getPrice() {
		  if($this->requisitedFields == null || in_array("price",$this->requisitedFields)) {
			return $this->results["price"];
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
		public function getNotSale() {
		  if($this->requisitedFields == null || in_array("notSale",$this->requisitedFields)) {
			return $this->results["notSale"];
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
		public function getIncJump() {
		  if($this->requisitedFields == null || in_array("incJump",$this->requisitedFields)) {
			return $this->results["incJump"];
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
		public function getIncMHP() {
		  if($this->requisitedFields == null || in_array("incMHP",$this->requisitedFields)) {
			return $this->results["incMHP"];
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
		public function getOnlyEquip() {
		  if($this->requisitedFields == null || in_array("onlyEquip",$this->requisitedFields)) {
			return $this->results["onlyEquip"];
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
		public function getEquipTradeBlock() {
		  if($this->requisitedFields == null || in_array("equipTradeBlock",$this->requisitedFields)) {
			return $this->results["equipTradeBlock"];
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
		public function getMaxHP() {
		  if($this->requisitedFields == null || in_array("MaxHP",$this->requisitedFields)) {
			return $this->results["MaxHP"];
		  } else {
			return false;
		  }
		}
		public function getMedalTag() {
		  if($this->requisitedFields == null || in_array("medalTag",$this->requisitedFields)) {
			return $this->results["medalTag"];
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
		public function getIncCraft() {
		  if($this->requisitedFields == null || in_array("incCraft",$this->requisitedFields)) {
			return $this->results["incCraft"];
		  } else {
			return false;
		  }
		}
		public function getSpecialID() {
		  if($this->requisitedFields == null || in_array("specialID",$this->requisitedFields)) {
			return $this->results["specialID"];
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
		public function getExpireOnLogout() {
		  if($this->requisitedFields == null || in_array("expireOnLogout",$this->requisitedFields)) {
			return $this->results["expireOnLogout"];
		  } else {
			return false;
		  }
		}
		public function getReqPOP() {
		  if($this->requisitedFields == null || in_array("reqPOP",$this->requisitedFields)) {
			return $this->results["reqPOP"];
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
		public function getPachinko() {
		  if($this->requisitedFields == null || in_array("pachinko",$this->requisitedFields)) {
			return $this->results["pachinko"];
		  } else {
			return false;
		  }
		}
		public function getAcc() {
		  if($this->requisitedFields == null || in_array("acc",$this->requisitedFields)) {
			return $this->results["acc"];
		  } else {
			return false;
		  }
		}
		public function getWeekly() {
		  if($this->requisitedFields == null || in_array("weekly",$this->requisitedFields)) {
			return $this->results["weekly"];
		  } else {
			return false;
		  }
		}
		public function getIncHP() {
		  if($this->requisitedFields == null || in_array("incHP",$this->requisitedFields)) {
			return $this->results["incHP"];
		  } else {
			return false;
		  }
		}
		public function getEpicItem() {
		  if($this->requisitedFields == null || in_array("epicItem",$this->requisitedFields)) {
			return $this->results["epicItem"];
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
		public function getIncLUK() {
		  if($this->requisitedFields == null || in_array("incLUK",$this->requisitedFields)) {
			return $this->results["incLUK"];
		  } else {
			return false;
		  }
		}
		public function getPickupMeso() {
		  if($this->requisitedFields == null || in_array("pickupMeso",$this->requisitedFields)) {
			return $this->results["pickupMeso"];
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
		public function getPickupOthers() {
		  if($this->requisitedFields == null || in_array("pickupOthers",$this->requisitedFields)) {
			return $this->results["pickupOthers"];
		  } else {
			return false;
		  }
		}
		public function getSweepForDrop() {
		  if($this->requisitedFields == null || in_array("sweepForDrop",$this->requisitedFields)) {
			return $this->results["sweepForDrop"];
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
		public function getConsumeMP() {
		  if($this->requisitedFields == null || in_array("consumeMP",$this->requisitedFields)) {
			return $this->results["consumeMP"];
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
		public function getAccountSharable() {
		  if($this->requisitedFields == null || in_array("accountSharable",$this->requisitedFields)) {
			return $this->results["accountSharable"];
		  } else {
			return false;
		  }
		}
		public function getFs() {
		  if($this->requisitedFields == null || in_array("fs",$this->requisitedFields)) {
			return $this->results["fs"];
		  } else {
			return false;
		  }
		}
		public function getTamingMob() {
		  if($this->requisitedFields == null || in_array("tamingMob",$this->requisitedFields)) {
			return $this->results["tamingMob"];
		  } else {
			return false;
		  }
		}
		public function getIncSwim() {
		  if($this->requisitedFields == null || in_array("incSwim",$this->requisitedFields)) {
			return $this->results["incSwim"];
		  } else {
			return false;
		  }
		}
		public function getIncFatigue() {
		  if($this->requisitedFields == null || in_array("incFatigue",$this->requisitedFields)) {
			return $this->results["incFatigue"];
		  } else {
			return false;
		  }
		}
		public function getHpRecovery() {
		  if($this->requisitedFields == null || in_array("hpRecovery",$this->requisitedFields)) {
			return $this->results["hpRecovery"];
		  } else {
			return false;
		  }
		}
		public function getMpRecovery() {
		  if($this->requisitedFields == null || in_array("mpRecovery",$this->requisitedFields)) {
			return $this->results["mpRecovery"];
		  } else {
			return false;
		  }
		}
		public function getAfterImage() {
		  if($this->requisitedFields == null || in_array("afterImage",$this->requisitedFields)) {
			return $this->results["afterImage"];
		  } else {
			return false;
		  }
		}
		public function getSfx() {
		  if($this->requisitedFields == null || in_array("sfx",$this->requisitedFields)) {
			return $this->results["sfx"];
		  } else {
			return false;
		  }
		}
		public function getWalk() {
		  if($this->requisitedFields == null || in_array("walk",$this->requisitedFields)) {
			return $this->results["walk"];
		  } else {
			return false;
		  }
		}
		public function getStand() {
		  if($this->requisitedFields == null || in_array("stand",$this->requisitedFields)) {
			return $this->results["stand"];
		  } else {
			return false;
		  }
		}
		public function getAttackSpeed() {
		  if($this->requisitedFields == null || in_array("attackSpeed",$this->requisitedFields)) {
			return $this->results["attackSpeed"];
		  } else {
			return false;
		  }
		}
		public function getIncRMAF() {
		  if($this->requisitedFields == null || in_array("incRMAF",$this->requisitedFields)) {
			return $this->results["incRMAF"];
		  } else {
			return false;
		  }
		}
		public function getIncRMAS() {
		  if($this->requisitedFields == null || in_array("incRMAS",$this->requisitedFields)) {
			return $this->results["incRMAS"];
		  } else {
			return false;
		  }
		}
		public function getElemDefault() {
		  if($this->requisitedFields == null || in_array("elemDefault",$this->requisitedFields)) {
			return $this->results["elemDefault"];
		  } else {
			return false;
		  }
		}
		public function getIncRMAI() {
		  if($this->requisitedFields == null || in_array("incRMAI",$this->requisitedFields)) {
			return $this->results["incRMAI"];
		  } else {
			return false;
		  }
		}
		public function getIncRMAL() {
		  if($this->requisitedFields == null || in_array("incRMAL",$this->requisitedFields)) {
			return $this->results["incRMAL"];
		  } else {
			return false;
		  }
		}
		public function getHide() {
		  if($this->requisitedFields == null || in_array("hide",$this->requisitedFields)) {
			return $this->results["hide"];
		  } else {
			return false;
		  }
		}
		public function getKnockback() {
		  if($this->requisitedFields == null || in_array("knockback",$this->requisitedFields)) {
			return $this->results["knockback"];
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
	}