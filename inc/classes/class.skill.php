<?php
	require_once("class.connection.php");
	class skill {
		
		private $requisitedFields;
		private $results;
		

		public function getFromDB($skillid,$fields=false) {
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
			
			$fieldToSearch = "skillid";
			
			//Load all equip informations
			$b = connection::getInstance()->prepare("SELECT ".$toQuery." i.skillid FROM skills AS i WHERE i.".$fieldToSearch."=:skillid");
			$b->bindParam(":skillid",$skillid);
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			
			$this->results = $resColumn[0];
		}

		function __construct($skillid,$fields=false,$preQuery = false) {
			if(empty($skillid)) throw new Exception('NOT_FOUND');
			
			if($preQuery == false) {
				$this->getFromDB($skillid,$fields);
			} else {
				$this->results = $preQuery;
			}
			
		}
		
		public function getSkillid() {
		  if($this->requisitedFields == null || in_array("skillid",$this->requisitedFields)) {
		  return $this->results["skillid"];
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
		public function getBookName() {
		  if($this->requisitedFields == null || in_array("bookName",$this->requisitedFields)) {
		  return $this->results["bookName"];
		  } else {
		  return false;
		  }
		}
		public function getRdesc() {
		  if($this->requisitedFields == null || in_array("Rdesc",$this->requisitedFields)) {
		  return $this->results["Rdesc"];
		  } else {
		  return false;
		  }
		}
		public function getH1() {
		  if($this->requisitedFields == null || in_array("h1",$this->requisitedFields)) {
		  return $this->results["h1"];
		  } else {
		  return false;
		  }
		}
		public function getH2() {
		  if($this->requisitedFields == null || in_array("h2",$this->requisitedFields)) {
		  return $this->results["h2"];
		  } else {
		  return false;
		  }
		}
		public function getH3() {
		  if($this->requisitedFields == null || in_array("h3",$this->requisitedFields)) {
		  return $this->results["h3"];
		  } else {
		  return false;
		  }
		}
		public function getH4() {
		  if($this->requisitedFields == null || in_array("h4",$this->requisitedFields)) {
		  return $this->results["h4"];
		  } else {
		  return false;
		  }
		}
		public function getH5() {
		  if($this->requisitedFields == null || in_array("h5",$this->requisitedFields)) {
		  return $this->results["h5"];
		  } else {
		  return false;
		  }
		}
		public function getH6() {
		  if($this->requisitedFields == null || in_array("h6",$this->requisitedFields)) {
		  return $this->results["h6"];
		  } else {
		  return false;
		  }
		}
		public function getH7() {
		  if($this->requisitedFields == null || in_array("h7",$this->requisitedFields)) {
		  return $this->results["h7"];
		  } else {
		  return false;
		  }
		}
		public function getH8() {
		  if($this->requisitedFields == null || in_array("h8",$this->requisitedFields)) {
		  return $this->results["h8"];
		  } else {
		  return false;
		  }
		}
		public function getH9() {
		  if($this->requisitedFields == null || in_array("h9",$this->requisitedFields)) {
		  return $this->results["h9"];
		  } else {
		  return false;
		  }
		}
		public function getH10() {
		  if($this->requisitedFields == null || in_array("h10",$this->requisitedFields)) {
		  return $this->results["h10"];
		  } else {
		  return false;
		  }
		}
		public function getH11() {
		  if($this->requisitedFields == null || in_array("h11",$this->requisitedFields)) {
		  return $this->results["h11"];
		  } else {
		  return false;
		  }
		}
		public function getH12() {
		  if($this->requisitedFields == null || in_array("h12",$this->requisitedFields)) {
		  return $this->results["h12"];
		  } else {
		  return false;
		  }
		}
		public function getH13() {
		  if($this->requisitedFields == null || in_array("h13",$this->requisitedFields)) {
		  return $this->results["h13"];
		  } else {
		  return false;
		  }
		}
		public function getH14() {
		  if($this->requisitedFields == null || in_array("h14",$this->requisitedFields)) {
		  return $this->results["h14"];
		  } else {
		  return false;
		  }
		}
		public function getH15() {
		  if($this->requisitedFields == null || in_array("h15",$this->requisitedFields)) {
		  return $this->results["h15"];
		  } else {
		  return false;
		  }
		}
		public function getH16() {
		  if($this->requisitedFields == null || in_array("h16",$this->requisitedFields)) {
		  return $this->results["h16"];
		  } else {
		  return false;
		  }
		}
		public function getH17() {
		  if($this->requisitedFields == null || in_array("h17",$this->requisitedFields)) {
		  return $this->results["h17"];
		  } else {
		  return false;
		  }
		}
		public function getH18() {
		  if($this->requisitedFields == null || in_array("h18",$this->requisitedFields)) {
		  return $this->results["h18"];
		  } else {
		  return false;
		  }
		}
		public function getH19() {
		  if($this->requisitedFields == null || in_array("h19",$this->requisitedFields)) {
		  return $this->results["h19"];
		  } else {
		  return false;
		  }
		}
		public function getH20() {
		  if($this->requisitedFields == null || in_array("h20",$this->requisitedFields)) {
		  return $this->results["h20"];
		  } else {
		  return false;
		  }
		}
		public function getH21() {
		  if($this->requisitedFields == null || in_array("h21",$this->requisitedFields)) {
		  return $this->results["h21"];
		  } else {
		  return false;
		  }
		}
		public function getH22() {
		  if($this->requisitedFields == null || in_array("h22",$this->requisitedFields)) {
		  return $this->results["h22"];
		  } else {
		  return false;
		  }
		}
		public function getH23() {
		  if($this->requisitedFields == null || in_array("h23",$this->requisitedFields)) {
		  return $this->results["h23"];
		  } else {
		  return false;
		  }
		}
		public function getH24() {
		  if($this->requisitedFields == null || in_array("h24",$this->requisitedFields)) {
		  return $this->results["h24"];
		  } else {
		  return false;
		  }
		}
		public function getH25() {
		  if($this->requisitedFields == null || in_array("h25",$this->requisitedFields)) {
		  return $this->results["h25"];
		  } else {
		  return false;
		  }
		}
		public function getH26() {
		  if($this->requisitedFields == null || in_array("h26",$this->requisitedFields)) {
		  return $this->results["h26"];
		  } else {
		  return false;
		  }
		}
		public function getH27() {
		  if($this->requisitedFields == null || in_array("h27",$this->requisitedFields)) {
		  return $this->results["h27"];
		  } else {
		  return false;
		  }
		}
		public function getH28() {
		  if($this->requisitedFields == null || in_array("h28",$this->requisitedFields)) {
		  return $this->results["h28"];
		  } else {
		  return false;
		  }
		}
		public function getH29() {
		  if($this->requisitedFields == null || in_array("h29",$this->requisitedFields)) {
		  return $this->results["h29"];
		  } else {
		  return false;
		  }
		}
		public function getH30() {
		  if($this->requisitedFields == null || in_array("h30",$this->requisitedFields)) {
		  return $this->results["h30"];
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
		
		public function getMasterLevel() {
			$master = 0;
			for($i=0;$i<30;$i++) {
				if(call_user_func(array( $this, "getH".($i+1)."" ))) {
					$master++;
				} 
			}
			return $master;
		}
	}