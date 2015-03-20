<?php

	require_once("class.connection.php");
	require_once("class.npc.php");
	
	class searchEngine {
		
		public function getAllNPCs() {
			$b = connection::getInstance()->prepare("SELECT npcid FROM npcs where link = ''");
			$b->bindParam(":id",$itemid);
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				return null;
			}
			
			$resultado = array();
			
			foreach($resColumn as $result) {
				$npc = new npc($result["npcid"]);
				array_push($resultado,$npc);
			}
			return $resultado;
		}
		
		public function getDropListByItemId($itemid) {
			//Load all drop informations
			$b = connection::getInstance()->prepare("SELECT m.mobid,m.name,m.url 
				FROM drop_list as l
				LEFT JOIN mobs as m on(m.mobid=l.dropperid)
				WHERE l.itemid=:id");
			$b->bindParam(":id",$itemid);
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				return null;
			}
			return $resColumn;
		}

		public function getDropList($mobid) {
			//Load all drop informations
			$b = connection::getInstance()->prepare("SELECT l.itemid,l.min_qtd,l.max_qtd,l.quest,l.chance,i.itemtype,
				CASE
				when e.name != '' then e.name
				when i.name != '' then i.name
				end as name,
				CASE
				when e.name != '' then 'equip'
				when i.name != '' then 'item'
				end as type,
				CASE
				when e.url != '' then e.url
				when i.url != '' then i.url
				end as url
				FROM drop_list as l
				LEFT JOIN equips as e on(e.itemid=l.itemid)
				LEFT JOIN items as i on(i.itemid=l.itemid)
				WHERE l.dropperid=:id");
			$b->bindParam(":id",$mobid);
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				return null;
			}
			return $resColumn;
		}
		
		public function getAllItens() {
			$b = connection::getInstance()->prepare("SELECT name,url,itemid FROM items");
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				return null;
			}
			return $resColumn;
		}
		
		public function getItemsLimited($condition,$page,$perPage) {
			$start = $perPage*$page;
			$b = connection::getInstance()->prepare("SELECT name,url,itemid,descr,price,slotMax, (SELECT COUNT(*) FROM items WHERE $condition) as resultCount FROM items WHERE $condition LIMIT $start,$perPage");
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function getNpcsLimited($page,$perPage) {
			$start = $perPage*$page;
			$b = connection::getInstance()->prepare("SELECT name,url,npcid,func, (SELECT COUNT(*) FROM npcs) as resultCount FROM npcs LIMIT $start,$perPage");
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function getQuestsLimited($page,$perPage) {
			$start = $perPage*$page;
			$b = connection::getInstance()->prepare("SELECT q.name,q.questid,q.url, (SELECT COUNT(*) FROM wz_questdata) as resultCount FROM wz_questdata as q LIMIT $start,$perPage");
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function searchTool($term) {
			return false;
		}
		
		public function getEquipsLimited($condition,$page,$perPage) {
			$start = $perPage*$page;
			$b = connection::getInstance()->prepare("SELECT name,url,itemid,descr,tuc,only,tradeBlock,notSale,tradeAvailable,equipTradeBlock,expireOnLogout,quest,price,reqJob,reqLevel,reqSTR,reqDEX,reqINT,reqLUK,reqPOP,incSTR,incDEX,incINT,incLUK,incMMP,incMHP,incPAD, incMAD, incPDD, incMDD, incEVA, incACC, incSpeed, incJump,
			(SELECT COUNT(*) FROM equips WHERE $condition) as resultCount FROM equips WHERE $condition LIMIT $start,$perPage");
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function getMobsLimited($condition,$page,$perPage) {
			$start = $perPage*$page;
			$b = connection::getInstance()->prepare("SELECT name,url,mobid,level,exp,maxHP,
			(SELECT COUNT(*) FROM mobs WHERE $condition) as resultCount FROM mobs WHERE $condition LIMIT $start,$perPage");
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function getAllJobsForEquip($condition) {
			$b = connection::getInstance()->prepare("SELECT distinct(reqJob) FROM equips WHERE $condition order by reqJob");
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function getQueryReqJob($name) {
			switch ($name) {
				case "comum":
					return " and (reqJob = 0)";
				case "guerreiro":
					return " and (reqJob = 1 or reqJob = 3 or reqJob = 5 or reqJob = 9 or reqJob = 13)";
				case "mago":
					return " and (reqJob = 2 or reqJob = 3 or reqJob = 10)";
				case "arqueiro":
					return " and (reqJob = 4 or reqJob = 5 or reqJob = 13)";
				case "gatuno":
					return " and (reqJob = 8 or reqJob = 9 or reqJob = 10 or reqJob = 13)";
				case "pirata":
					return " and (reqJob = 16)";
				default:
					return "";
			}
		}
		
		public function getMapLocationForMob($mobid) {
			$b = connection::getInstance()->prepare("SELECT m.mapName,m.url,m.mapid FROM maps_life as l JOIN maps as m ON(m.mapid=l.mapid) WHERE l.id=:id and type='m' GROUP BY mapid");
			$b->bindParam(":id",$mobid);
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function getMapLocationForNpc($npcid) {
			$b = connection::getInstance()->prepare("SELECT m.mapName,m.url,m.mapid FROM maps_life as l JOIN maps as m ON(m.mapid=l.mapid) WHERE l.id=:id and type='n' GROUP BY mapid");
			$b->bindParam(":id",$npcid);
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function getAllNpcsFromMap($mapid) {
			$b = connection::getInstance()->prepare("SELECT n.npcid,n.name,n.url FROM maps_life as l JOIN npcs as n ON(n.npcid=l.id) WHERE l.mapid=:id and type='n' ");
			$b->bindParam(":id",$mapid);
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function getAllMobsFromMap($mapid) {
			$b = connection::getInstance()->prepare("SELECT m.mobid,m.name,m.url,count(*) as mobQtd  FROM maps_life as l JOIN mobs as m ON(m.mobid=l.id) WHERE l.mapid=:id and type='m' GROUP BY mobid ");
			$b->bindParam(":id",$mapid);
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function getAllPortalsFromMap($mapid) {
			$b = connection::getInstance()->prepare("SELECT m.mapName,m.url,m.mapid FROM maps_portals as p JOIN maps as m ON(m.mapid=p.tm) WHERE tm!=999999999 and p.mapid=:id GROUP BY p.tm");
			$b->bindParam(":id",$mapid);
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function getWorldMap($string) {
			$b = connection::getInstance()->prepare("SELECT l.*,m.mapName,m.url,m.mapid FROM worldmap_maplist as l JOIN maps as m ON(m.mapid=l.mapNo) WHERE l.worldmap=:id");
			$b->bindParam(":id",$string);
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function getWorldMap_Links($string) {
			$b = connection::getInstance()->prepare("SELECT * FROM worldmap_maplink WHERE worldmap=:id");
			$b->bindParam(":id",$string);
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function getWorldMaps() {
			$b = connection::getInstance()->prepare("SELECT * FROM worldmap");
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function getAllWorldMaps() {
			$b = connection::getInstance()->prepare("SELECT * FROM worldmap");
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function getWhereItemIsReward($itemid) {
			$b = connection::getInstance()->prepare("SELECT itemData.itemid,itemData.count,actData.questid
				FROM wz_questactitemdata as itemData
				LEFT JOIN wz_questactdata as actData ON(itemData.uniqueid=actData.uniqueid)
				WHERE itemData.itemid=:id and actData.type=1 and itemData.count>0");
			$b->bindParam(":id",$itemid);
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				return null;
			}
			return $resColumn;
		}
		
		public function getInvolvedWith($npcid) {
			$b = connection::getInstance()->prepare("SELECT qData.name,qData.url,qData.questid
				FROM wz_questreqdata as reqData
				LEFT JOIN wz_questdata as qData ON(reqData.questid=qData.questid)
				WHERE reqData.stringStore=:id GROUP by questid");
			$b->bindParam(":id",$npcid);
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				return null;
			}
			return $resColumn;
		}
		
		public function getJobByID($job) {
			$jobs = array(
				0 => "Aprendiz",
                100 => "Guerreiro",
                110 => "Soldado",
                111 => "Templário",
                112 => "Herói",
                120 => "Escudeiro",
                121 => "Cavaleiro Branco",
                122 => "Paladino",
                130 => "Lanceiro",
                131 => "Cavaleiro Draconiano",
                132 => "Cavaleiro Negro",
                200 => "Mago",
                210 => "Feiticeiro (Fogo, Veneno)",
                211 => "Mago (Fogo, Veneno)",
                212 => "Arquimago (Fogo, Veneno)",
                220 => "Feiticeiro (Gelo, Luz)",
                221 => "Mago (Gelo, Luz)",
                222 => "Arquimago (Gelo, Luz)",
                230 => "Clérigo",
                231 => "Sacerdote",
                232 => "Sumo Sacerdote",
                300 => "Arqueiro",
                310 => "Caçador",
                311 => "Rastreador",
                312 => "Mestre Arqueiro",
                320 => "Balestreiro",
                321 => "Atirador",
                322 => "Atirador de Elite",
                400 => "Gatuno",
                410 => "Mercenário",
                411 => "Andarílho",
                412 => "Lorde Negro",
                420 => "Arruaceiro",
                421 => "Mestre Arruaceiro",
                422 => "Mestre das Sombras",
                500 => "Pirata",
                510 => "Lutador",
                511 => "Saqueador",
                512 => "Bucaneiro",
                520 => "Pistoleiro",
                521 => "Foragido",
                522 => "Corsário",
                900 => "GM",
                910 => "SuperGM",
			);
			if(isset($jobs[$job])) {
				return $jobs[$job];
			} else return null;
		}
		
		public function getJobIdByUrl($job) {
            $jobs = array(
                "aprendiz" => 0,
                "guerreiro" => 100,
                "soldado" => 110,
                "templario" => 111,
                "heroi" => 112,
                "escudeiro" => 120,
                "cavaleiro-branco" => 121,
                "paladino" => 122,
                "lanceiro" => 130,
                "cavaleiro-draconiano" => 131,
                "cavaleiro-negro" => 132,
                "mago" => 200,
                "feiticeiro-fogo-veneno" => 210,
                "mago-fogo-veneno" => 211,
                "arquimago-fogo-veneno" => 212,
                "feiticeiro-gelo-luz" => 220,
                "mago-gelo-luz" => 221,
                "arquimago-gelo-luz" => 222,
                "clerigo" => 230,
                "sacerdote" => 231,
                "sumo-sacerdote" => 232,
                "arqueiro" => 300,
                "cacador" => 310,
                "rastreador" => 311,
                "mestre-arqueiro" => 312,
                "balestreiro" => 320,
                "atirador" => 321,
                "atirador-de-elite" => 322,
                "gatuno" => 400,
                "mercenario" => 410,
                "andarilho" => 411,
                "lorde-negro" => 412,
                "arruaceiro" => 420,
                "mestre-arruaceiro" => 421,
                "mestre-das-sombras" => 422,
                "pirata" => 500,
                "lutador" => 510,
                "saqueador" => 511,
                "bucaneiro" => 512,
                "pistoleiro" => 520,
                "foragido" => 521,
                "corsario" => 522,
                "gm" => 900,
                "supergm" => 910,
            );
            if(isset( $jobs[$job])) {
                return $jobs[$job];
            } else return null;
        }
		
		public function getJobUrlById($job) {
            $jobs = array(
                0 => "aprendiz",
				100 => "guerreiro",
				110 => "soldado",
				111 => "templario",
				112 => "heroi",
				120 => "escudeiro",
				121 => "cavaleiro-branco",
				122 => "paladino",
				130 => "lanceiro",
				131 => "cavaleiro-draconiano",
				132 => "cavaleiro-negro",
				200 => "mago",
				210 => "feiticeiro-fogo-veneno",
				211 => "mago-fogo-veneno",
				212 => "arquimago-fogo-veneno",
				220 => "feiticeiro-gelo-luz",
				221 => "mago-gelo-luz",
				222 => "arquimago-gelo-luz",
				230 => "clerigo",
				231 => "sacerdote",
				232 => "sumo-sacerdote",
				300 => "arqueiro",
				310 => "cacador",
				311 => "rastreador",
				312 => "mestre-arqueiro",
				320 => "balestreiro",
				321 => "atirador",
				322 => "atirador-de-elite",
				400 => "gatuno",
				410 => "mercenario",
				411 => "andarilho",
				412 => "lorde-negro",
				420 => "arruaceiro",
				421 => "mestre-arruaceiro",
				422 => "mestre-das-sombras",
				500 => "pirata",
				510 => "lutador",
				511 => "saqueador",
				512 => "bucaneiro",
				520 => "pistoleiro",
				521 => "foragido",
				522 => "corsario",
				900 => "gm",
				910 => "supergm",
            );
            if(isset( $jobs[$job])) {
                return $jobs[$job];
            } else return null;
        }
		
		public function doSearch($query) {
			$comumTerms = array("de","do","da","a","e","é","a","o","que","para","the");
			$searchTables = array( array("equips","itemid","name"), array("items","itemid","name"), array("maps","mapid","mapName"), array("mobs","mobid","name"), array("npcs","npcid","name"), array("wz_questdata","questid","name") );
			//$searchTables = array( array("mobs","mobid","name") );
			
			$terms = explode(" ",$query);
			
			if(count($terms) > 4) {
				return "EXCEDED_NUMBER_OF_TERMS";
			}
			
			$resultBox = array();
			
			foreach($searchTables as $tables) {
				foreach($terms as $term) {
					if(!in_array($term,$comumTerms)) {
						$b = connection::getInstance()->prepare("SELECT ".$tables[1].", ".$tables[2].", url FROM ".$tables[0]." WHERE ".$tables[2]." LIKE :term");
						$b->bindValue(":term","%{$term}%");
						$b->execute();
						$resColumn = $b->fetchAll();
						if($resColumn != null) {
							foreach($resColumn as $result) {
								array_push($resultBox, array($result,$tables[0]) ); 
							}
						}
					}
				}
			}
			
			$finalResult = array();
			
			$count=0;
			
			foreach($resultBox as $result) {
				$repeatCount = 0;
				foreach($resultBox as $result2) {
					if($result == $result2) {
						$repeatCount++;
					}
				}
				$newArray = array($repeatCount,$result);
				if(!in_array( $newArray, $finalResult)) {
					array_push($finalResult, $newArray );
				}
			}
			
			rsort($finalResult);
			
			return $finalResult;
		}
		
		public function getSkillByJobId($jobId) {
			$b = connection::getInstance()->prepare("SELECT * FROM skills WHERE parent='$jobId'");
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
		
		public function getLatestsNews($limit) {
			$b = connection::getInstance()->prepare("SELECT * FROM news order by date desc LIMIT $limit");
			$b->execute();
			$resColumn = $b->fetchAll();
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			return $resColumn;
		}
	}
	
?>