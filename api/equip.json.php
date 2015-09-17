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

	require_once("../inc/config.php");
	require_once("../inc/classes/class.equip.php");
	require_once("../inc/classes/class.mob.php");
	require_once("../inc/classes/class.searchEngine.php");
	
	/*
	* Metódos:
	*	EQUIPID = Busca apenas 1 item
	*	EQUIPIDS = Busca vários itens (Separados por ",")
	*	INFO = Solicita apenas as informações necessárias
	*/
	$searchEngine = new searchEngine();
	
	if( isset($_GET['equipid']) ) {
		$equips = explode( ",",$_GET['equipid'] );
		if( count($equips) <= 1) {
			$equips_result = $searchEngine->getEquipsById($_GET['equipid']);
			echo json_encode(getEquip($equips_result[0]));
			//print_r(getEquip($equips_result[0]));
		} else {
			
			$itemString = "";
			foreach($equips as $e) {
				if( is_numeric($e) ) {
					$itemString .= $e.",";
				} else {
					echo json_encode(Array("ERROR"=> utf8_encode("O item solicitado não está disponível")));
					exit;
				}
			}
			$itemString = substr($itemString,0,-1);
			$allEquips = array();
			$equips_result = $searchEngine->getEquipsById($itemString);
			foreach ($equips_result as $equip_result) {
				$allEquips[$equip_result["itemid"]] = getEquip($equip_result);
				//array_push($allEquips,getEquip($equip_result));
			}
			echo json_encode($allEquips);
		}
	}
	
	function getEquip($equip_data) {
		//$equip = null;
		try {
			$equip = new equip("","",$equip_data);
		}  catch(Exception $e) {
			echo json_encode(Array("ERROR"=> utf8_encode("O item solicitado não está disponível")));
			exit;
		}
		
		if($equip == null) {
			echo json_encode(Array("ERROR"=> utf8_encode("O item solicitado não está disponível")));
			exit;
		} else {
			$shouldFilter = false;
			$filter = array();
			if( isset($_GET['info']) ) {
				$shouldFilter = true;
				$filter = explode(",",$_GET['info']);
			}
			
			$allowedFilters = array("equipid","name","link","icon","islot","vslot","reqJob","reqLevel","reqSTR","reqDEX","reqINT","reqLUK","cash","incSTR","incDEX","incINT","incPAD","incPDD","incMAD","incMDD","incEVA","incACC","tradeBlock","price","slotMax","incSpeed","incJump","incMHP","incMMP","tradeAvailable","maxHP","speed","reqPOP","incHP","incLUK","consumeHP","consumeMP","hpRecovery","mpRecovery","sfx","walk","stand","attackSpeed","descr");
			
			foreach($filter as $f) {
				if( !in_array($f,$allowedFilters) ) {
					echo json_encode(Array("ERROR"=> utf8_encode("O item solicitado não está disponível")));
					exit;
				}
			}
			
			$result = array();
			//Default items
			if( in_array("equipid",$filter) || !$shouldFilter) $result["equipid"] = $equip->getItemid();
			if( in_array("name",$filter) || !$shouldFilter) $result["name"] = $equip->getName();
			if( in_array("link",$filter) || !$shouldFilter) $result["link"] = $equip->getSingleLink(true);
			if( in_array("icon",$filter) || !$shouldFilter) $result["icon"] = $equip->getCachedIcon(true);
			//Custom items
			if( in_array("islot",$filter)) $result["islot"] = $equip->getIslot();
			if( in_array("vslot",$filter)) $result["vslot"] = $equip->getVslot();
			if( in_array("reqJob",$filter)) $result["reqJob"] = $equip->getReqJob();
			if( in_array("reqLevel",$filter)) $result["reqLevel"] = $equip->getReqLevel();
			if( in_array("reqSTR",$filter)) $result["reqSTR"] = $equip->getReqSTR();
			if( in_array("reqDEX",$filter)) $result["reqDEX"] = $equip->getReqDEX();
			if( in_array("reqINT",$filter)) $result["reqINT"] = $equip->getReqINT();
			if( in_array("reqLUK",$filter)) $result["reqLUK"] = $equip->getReqLUK();
			if( in_array("cash",$filter)) $result["cash"] = $equip->getCash();
			if( in_array("incSTR",$filter)) $result["incSTR"] = $equip->getIncSTR();
			if( in_array("incDEX",$filter)) $result["incDEX"] = $equip->getIncDEX();
			if( in_array("incINT",$filter)) $result["incINT"] = $equip->getIncINT();
			if( in_array("incPAD",$filter)) $result["incPAD"] = $equip->getIncPAD();
			if( in_array("incPDD",$filter)) $result["incPDD"] = $equip->getIncPDD();
			if( in_array("incMAD",$filter)) $result["incMAD"] = $equip->getIncMAD();
			if( in_array("incMDD",$filter)) $result["incMDD"] = $equip->getIncMDD();
			if( in_array("incEVA",$filter)) $result["incEVA"] = $equip->getIncEVA();
			if( in_array("incACC",$filter)) $result["incACC"] = $equip->getIncACC();
			if( in_array("tradeBlock",$filter)) $result["tradeBlock"] = $equip->getTradeBlock();
			if( in_array("price",$filter)) $result["price"] = $equip->getPrice();
			if( in_array("slotMax",$filter)) $result["slotMax"] = $equip->getSlotMax();
			if( in_array("incSpeed",$filter)) $result["incSpeed"] = $equip->getIncSpeed();
			if( in_array("incJump",$filter)) $result["incJump"] = $equip->getIncJump();
			if( in_array("incMHP",$filter)) $result["incMHP"] = $equip->getIncMHP();
			if( in_array("incMMP",$filter)) $result["incMMP"] = $equip->getIncMMP();
			if( in_array("tradeAvailable",$filter)) $result["tradeAvailable"] = $equip->getTradeAvailable();
			if( in_array("maxHP",$filter)) $result["maxHP"] = $equip->getMaxHP();
			if( in_array("speed",$filter)) $result["speed"] = $equip->getSpeed();
			if( in_array("reqPOP",$filter)) $result["reqPOP"] = $equip->getReqPOP();
			if( in_array("incHP",$filter)) $result["incHP"] = $equip->getIncHP();
			if( in_array("incLUK",$filter)) $result["incLUK"] = $equip->getIncLUK();
			if( in_array("consumeHP",$filter)) $result["consumeHP"] = $equip->getConsumeHP();
			if( in_array("consumeMP",$filter)) $result["consumeMP"] = $equip->getConsumeMP();
			if( in_array("hpRecovery",$filter)) $result["hpRecovery"] = $equip->getHpRecovery();
			if( in_array("mpRecovery",$filter)) $result["mpRecovery"] = $equip->getMpRecovery();
			if( in_array("sfx",$filter)) $result["sfx"] = $equip->getSfx();
			if( in_array("walk",$filter)) $result["walk"] = $equip->getWalk();
			if( in_array("stand",$filter)) $result["stand"] = $equip->getStand();
			if( in_array("attackSpeed",$filter)) $result["attackSpeed"] = $equip->getAttackSpeed();
			if( in_array("descr",$filter)) $result["descr"] = $equip->getDescr();
			
			return $result;
		}
	}
?>