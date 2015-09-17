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
	class mob {
		
		private $requisitedFields;
		private $results;
		

		public function getFromDB($mobid,$fields=false) {
			if($fields != false) {
				$explodedFields = explode(",",$fields);
				$toQuery = "";
				foreach($explodedFields as $field) {
					$toQuery .= "m.".$field.",";
				}
			} else {
				$explodedFields = null;
				$toQuery = "m.*,";
			}
			$this->requisitedFields = $explodedFields;
			
			if(is_numeric($mobid)) {
				$fieldToSearch = "mobid";
			} else {
				$fieldToSearch = "url";
			}
			
			//Load all equip informations
			$b = connection::getInstance()->prepare("SELECT ".$toQuery." m.mobid FROM mobs AS m WHERE m.".$fieldToSearch."=:id");
			$b->bindParam(":id",$mobid);
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			
			$this->results = $resColumn[0];
		}
		
		function __construct($mobid,$fields=false,$preQuery = false) {
			if($preQuery == false) {
				$this->getFromDB($mobid,$fields);
			} else {
				$this->results = $preQuery;
			}
		}
		
		public function getMobid() {
		  if($this->requisitedFields == null || in_array("mobid",$this->requisitedFields)) {
				return $this->results["mobid"];
			  } else {
				return false;
			  }
		}
		public function getLevel() {
		  if($this->requisitedFields == null || in_array("level",$this->requisitedFields)) {
				return $this->results["level"];
			  } else {
				return false;
			  }
		}
		public function getMaxHP() {
		  if($this->requisitedFields == null || in_array("maxHP",$this->requisitedFields)) {
				return $this->results["maxHP"];
			  } else {
				return false;
			  }
		}
		public function getMaxMP() {
		  if($this->requisitedFields == null || in_array("maxMP",$this->requisitedFields)) {
				return $this->results["maxMP"];
			  } else {
				return false;
			  }
		}
		public function getPADamage() {
		  if($this->requisitedFields == null || in_array("PADamage",$this->requisitedFields)) {
				return $this->results["PADamage"];
			  } else {
				return false;
			  }
		}
		public function getPDDamage() {
		  if($this->requisitedFields == null || in_array("PDDamage",$this->requisitedFields)) {
				return $this->results["PDDamage"];
			  } else {
				return false;
			  }
		}
		public function getMADamage() {
		  if($this->requisitedFields == null || in_array("MADamage",$this->requisitedFields)) {
				return $this->results["MADamage"];
			  } else {
				return false;
			  }
		}
		public function getMDDamage() {
		  if($this->requisitedFields == null || in_array("MDDamage",$this->requisitedFields)) {
				return $this->results["MDDamage"];
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
		public function getEva() {
		  if($this->requisitedFields == null || in_array("eva",$this->requisitedFields)) {
				return $this->results["eva"];
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
		public function getUndead() {
		  if($this->requisitedFields == null || in_array("undead",$this->requisitedFields)) {
				return $this->results["undead"];
			  } else {
				return false;
			  }
		}
		public function getPushed() {
		  if($this->requisitedFields == null || in_array("pushed",$this->requisitedFields)) {
				return $this->results["pushed"];
			  } else {
				return false;
			  }
		}
		public function getSummonType() {
		  if($this->requisitedFields == null || in_array("summonType",$this->requisitedFields)) {
				return $this->results["summonType"];
			  } else {
				return false;
			  }
		}
		public function getMobType() {
		  if($this->requisitedFields == null || in_array("mobType",$this->requisitedFields)) {
				return $this->results["mobType"];
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
		public function getElemAttr() {
		  if($this->requisitedFields == null || in_array("elemAttr",$this->requisitedFields)) {
				return $this->results["elemAttr"];
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
		public function getHpTagColor() {
		  if($this->requisitedFields == null || in_array("hpTagColor",$this->requisitedFields)) {
				return $this->results["hpTagColor"];
			  } else {
				return false;
			  }
		}
		public function getHpTagBgcolor() {
		  if($this->requisitedFields == null || in_array("hpTagBgcolor",$this->requisitedFields)) {
				return $this->results["hpTagBgcolor"];
			  } else {
				return false;
			  }
		}
		public function getBoss() {
		  if($this->requisitedFields == null || in_array("boss",$this->requisitedFields)) {
				return $this->results["boss"];
			  } else {
				return false;
			  }
		}
		public function getHPgaugeHide() {
		  if($this->requisitedFields == null || in_array("HPgaugeHide",$this->requisitedFields)) {
				return $this->results["HPgaugeHide"];
			  } else {
				return false;
			  }
		}
		public function getRareItemDropLevel() {
		  if($this->requisitedFields == null || in_array("rareItemDropLevel",$this->requisitedFields)) {
				return $this->results["rareItemDropLevel"];
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
		public function getExplosiveReward() {
		  if($this->requisitedFields == null || in_array("explosiveReward",$this->requisitedFields)) {
				return $this->results["explosiveReward"];
			  } else {
				return false;
			  }
		}
		public function getRemoveAfter() {
		  if($this->requisitedFields == null || in_array("removeAfter",$this->requisitedFields)) {
				return $this->results["removeAfter"];
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
		public function getMbookID() {
		  if($this->requisitedFields == null || in_array("mbookID",$this->requisitedFields)) {
				return $this->results["mbookID"];
			  } else {
				return false;
			  }
		}
		public function getChaseSpeed() {
		  if($this->requisitedFields == null || in_array("chaseSpeed",$this->requisitedFields)) {
				return $this->results["chaseSpeed"];
			  } else {
				return false;
			  }
		}
		public function getNoregen() {
		  if($this->requisitedFields == null || in_array("noregen",$this->requisitedFields)) {
				return $this->results["noregen"];
			  } else {
				return false;
			  }
		}
		public function getSpeed() {
		  if($this->requisitedFields == null || in_array("Speed",$this->requisitedFields)) {
				return $this->results["Speed"];
			  } else {
				return false;
			  }
		}
		public function getPublicReward() {
		  if($this->requisitedFields == null || in_array("publicReward",$this->requisitedFields)) {
				return $this->results["publicReward"];
			  } else {
				return false;
			  }
		}
		public function getDefaultHP() {
		  if($this->requisitedFields == null || in_array("defaultHP",$this->requisitedFields)) {
				return $this->results["defaultHP"];
			  } else {
				return false;
			  }
		}
		public function getDefaultMP() {
		  if($this->requisitedFields == null || in_array("defaultMP",$this->requisitedFields)) {
				return $this->results["defaultMP"];
			  } else {
				return false;
			  }
		}
		public function getBuff() {
		  if($this->requisitedFields == null || in_array("buff",$this->requisitedFields)) {
				return $this->results["buff"];
			  } else {
				return false;
			  }
		}
		public function getDisable() {
		  if($this->requisitedFields == null || in_array("disable",$this->requisitedFields)) {
				return $this->results["disable"];
			  } else {
				return false;
			  }
		}
		public function getHideHP() {
		  if($this->requisitedFields == null || in_array("hideHP",$this->requisitedFields)) {
				return $this->results["hideHP"];
			  } else {
				return false;
			  }
		}
		public function getInvincible() {
		  if($this->requisitedFields == null || in_array("invincible",$this->requisitedFields)) {
				return $this->results["invincible"];
			  } else {
				return false;
			  }
		}
		public function getNotAttack() {
		  if($this->requisitedFields == null || in_array("notAttack",$this->requisitedFields)) {
				return $this->results["notAttack"];
			  } else {
				return false;
			  }
		}
		public function getDamagedByMob() {
		  if($this->requisitedFields == null || in_array("damagedByMob",$this->requisitedFields)) {
				return $this->results["damagedByMob"];
			  } else {
				return false;
			  }
		}
		public function getDropItemPeriod() {
		  if($this->requisitedFields == null || in_array("dropItemPeriod",$this->requisitedFields)) {
				return $this->results["dropItemPeriod"];
			  } else {
				return false;
			  }
		}
		public function getGetCP() {
		  if($this->requisitedFields == null || in_array("getCP",$this->requisitedFields)) {
				return $this->results["getCP"];
			  } else {
				return false;
			  }
		}
		public function getDoNotRemove() {
		  if($this->requisitedFields == null || in_array("doNotRemove",$this->requisitedFields)) {
				return $this->results["doNotRemove"];
			  } else {
				return false;
			  }
		}
		public function getIgnoreFieldOut() {
		  if($this->requisitedFields == null || in_array("ignoreFieldOut",$this->requisitedFields)) {
				return $this->results["ignoreFieldOut"];
			  } else {
				return false;
			  }
		}
		public function getFixedDamage() {
		  if($this->requisitedFields == null || in_array("fixedDamage",$this->requisitedFields)) {
				return $this->results["fixedDamage"];
			  } else {
				return false;
			  }
		}
		public function getFixDamage() {
		  if($this->requisitedFields == null || in_array("fixDamage",$this->requisitedFields)) {
				return $this->results["fixDamage"];
			  } else {
				return false;
			  }
		}
		public function getOnlyNormalAttack() {
		  if($this->requisitedFields == null || in_array("onlyNormalAttack",$this->requisitedFields)) {
				return $this->results["onlyNormalAttack"];
			  } else {
				return false;
			  }
		}
		public function getHidename() {
		  if($this->requisitedFields == null || in_array("hidename",$this->requisitedFields)) {
				return $this->results["hidename"];
			  } else {
				return false;
			  }
		}
		public function getCantPassByTeleport() {
		  if($this->requisitedFields == null || in_array("cantPassByTeleport",$this->requisitedFields)) {
				return $this->results["cantPassByTeleport"];
			  } else {
				return false;
			  }
		}
		public function getWeapon() {
		  if($this->requisitedFields == null || in_array("weapon",$this->requisitedFields)) {
				return $this->results["weapon"];
			  } else {
				return false;
			  }
		}
		public function getChargeCount() {
		  if($this->requisitedFields == null || in_array("ChargeCount",$this->requisitedFields)) {
				return $this->results["ChargeCount"];
			  } else {
				return false;
			  }
		}
		public function getAngerGauge() {
		  if($this->requisitedFields == null || in_array("AngerGauge",$this->requisitedFields)) {
				return $this->results["AngerGauge"];
			  } else {
				return false;
			  }
		}
		public function getFirstattack() {
		  if($this->requisitedFields == null || in_array("firstattack",$this->requisitedFields)) {
				return $this->results["firstattack"];
			  } else {
				return false;
			  }
		}
		public function getFlySpeed() {
		  if($this->requisitedFields == null || in_array("FlySpeed",$this->requisitedFields)) {
				return $this->results["FlySpeed"];
			  } else {
				return false;
			  }
		}
		public function getRemoveQuest() {
		  if($this->requisitedFields == null || in_array("removeQuest",$this->requisitedFields)) {
				return $this->results["removeQuest"];
			  } else {
				return false;
			  }
		}
		public function getBodyattack() {
		  if($this->requisitedFields == null || in_array("bodyattack",$this->requisitedFields)) {
				return $this->results["bodyattack"];
			  } else {
				return false;
			  }
		}
		public function getRemoveOnMiss() {
		  if($this->requisitedFields == null || in_array("removeOnMiss",$this->requisitedFields)) {
				return $this->results["removeOnMiss"];
			  } else {
				return false;
			  }
		}
		public function getCoolDamage() {
		  if($this->requisitedFields == null || in_array("coolDamage",$this->requisitedFields)) {
				return $this->results["coolDamage"];
			  } else {
				return false;
			  }
		}
		public function getCoolDamageProb() {
		  if($this->requisitedFields == null || in_array("coolDamageProb",$this->requisitedFields)) {
				return $this->results["coolDamageProb"];
			  } else {
				return false;
			  }
		}
		public function getPoint() {
		  if($this->requisitedFields == null || in_array("point",$this->requisitedFields)) {
				return $this->results["point"];
			  } else {
				return false;
			  }
		}
		public function getStand0() {
		  if($this->requisitedFields == null || in_array("stand0",$this->requisitedFields)) {
				return $this->results["stand0"];
			  } else {
				return false;
			  }
		}
		public function getCachedIcon() {
			$path = IMG_MOB_PATH;
			if($this->getUrl() == "") {
				if(file_exists("{$_SERVER['DOCUMENT_ROOT']}/".IMG_MOB_PATH.$this->getMobId().".png")) {
					return $path.$this->getMobId().".png";
				} else {
					return $path."";
				}
			} else {
				if(file_exists("{$_SERVER['DOCUMENT_ROOT']}/".IMG_MOB_PATH.$this->getUrl().".png")) {
					return $path.$this->getUrl().".png";
				} else{
					return $path."mob-no-img.png";
				}
			}
		}
		public function getSingleLink() {
			$localPath = LOCAL_PATH;
			if($this->getUrl() == "") {
				return $localPath."monstro/".$this->getMobId();
			} else {
				return $localPath."monstro/".$this->getUrl();
			}
		}
		public function getName() {
		  if($this->requisitedFields == null || in_array("name",$this->requisitedFields)) {
				return $this->results["name"];
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