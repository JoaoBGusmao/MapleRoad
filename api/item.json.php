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
	require_once("../inc/classes/class.item.php");
	require_once("../inc/classes/class.mob.php");
	require_once("../inc/classes/class.searchEngine.php");
	
	/*
	* Metódos:
	*	ITEMID = Busca apenas 1 item
	*	INFO = Solicita apenas as informações necessárias
	*/
	$searchEngine = new searchEngine();
	
	if( isset($_GET['itemid']) ) {
		$items = explode( ",",$_GET['itemid'] );
		if( count($items) <= 1) {
			$items_result = $searchEngine->getItemsById($_GET['itemid']);
			//print_r($items_result);
			echo json_encode(getItem($items_result[0]));
		} else {
			
			$itemString = "";
			foreach($items as $e) {
				if( is_numeric($e) ) {
					$itemString .= $e.",";
				} else {
					echo json_encode(Array("ERROR"=> utf8_encode("O item solicitado não está disponível")));
					exit;
				}
			}
			$itemString = substr($itemString,0,-1);
			$allItems = array();
			$items_result = $searchEngine->getItemsById($itemString);
			foreach ($items_result as $item_result) {
				$allItems[$item_result["itemid"]] = getItem($item_result);
				//array_push($allItems,getItem($item_result));
			}
			echo json_encode($allItems);
		}
	}
	
	function getItem($item_data) {
		error_reporting(E_ALL);
		try {
			$item = new item("","",$item_data);
		}  catch(Exception $e) {
			echo json_encode(Array("ERROR"=> utf8_encode("O item solicitado não está disponível")));
			exit;
		}
		
		if($item == null) {
			echo json_encode(Array("ERROR"=> utf8_encode("O item solicitado não está disponível")));
			exit;
		} else {
			$shouldFilter = false;
			$filter = array();
			if( isset($_GET['info']) ) {
				$shouldFilter = true;
				$filter = explode(",",$_GET['info']);
			}
			
			$allowedFilters = array("itemid","name","link","icon","cash","slotMax","type","tradeBlock","speed","consumeHP","consumeMP","price","incPDD","incMDD","incACC","incMHP","incINT","incDEX","incMAD","incPAD","incEVA","incSTR","incLUK","incSpeed","incMMP","incJump","descr","itemtype",);
			
			foreach($filter as $f) {
				if( !in_array($f,$allowedFilters) ) {
					echo json_encode(Array("ERROR"=> utf8_encode("O item solicitado não está disponível")));
					exit;
				}
			}
			
			$result = array();
			//Default items
			if( in_array("itemid",$filter) || !$shouldFilter) $result["itemid"] = $item->getItemid();
			if( in_array("name",$filter) || !$shouldFilter) $result["name"] = $item->getName();
			if( in_array("link",$filter) || !$shouldFilter) $result["link"] = $item->getSingleLink(true);
			if( in_array("icon",$filter) || !$shouldFilter) $result["icon"] = $item->getCachedIcon(true);
			//Custom items
			if( in_array("cash",$filter) ) $result["cash"] = $item->getCash();
			if( in_array("slotMax",$filter) ) $result["slotMax"] = $item->getSlotMax();
			if( in_array("type",$filter) ) $result["type"] = $item->getType();
			if( in_array("tradeBlock",$filter) ) $result["tradeBlock"] = $item->getTradeBlock();
			if( in_array("speed",$filter) ) $result["speed"] = $item->getSpeed();
			if( in_array("consumeHP",$filter) ) $result["consumeHP"] = $item->getConsumeHP();
			if( in_array("consumeMP",$filter) ) $result["consumeMP"] = $item->getConsumeMP();
			if( in_array("price",$filter) ) $result["price"] = $item->getPrice();
			if( in_array("incPDD",$filter) ) $result["incPDD"] = $item->getIncPDD();
			if( in_array("incMDD",$filter) ) $result["incMDD"] = $item->getIncMDD();
			if( in_array("incACC",$filter) ) $result["incACC"] = $item->getIncACC();
			if( in_array("incMHP",$filter) ) $result["incMHP"] = $item->getIncMHP();
			if( in_array("incINT",$filter) ) $result["incINT"] = $item->getIncINT();
			if( in_array("incDEX",$filter) ) $result["incDEX"] = $item->getIncDEX();
			if( in_array("incMAD",$filter) ) $result["incMAD"] = $item->getIncMAD();
			if( in_array("incPAD",$filter) ) $result["incPAD"] = $item->getIncPAD();
			if( in_array("incEVA",$filter) ) $result["incEVA"] = $item->getIncEVA();
			if( in_array("incSTR",$filter) ) $result["incSTR"] = $item->getIncSTR();
			if( in_array("incLUK",$filter) ) $result["incLUK"] = $item->getIncLUK();
			if( in_array("incSpeed",$filter) ) $result["incSpeed"] = $item->getIncSpeed();
			if( in_array("incMMP",$filter) ) $result["incMMP"] = $item->getIncMMP();
			if( in_array("incJump",$filter) ) $result["incJump"] = $item->getIncJump();
			if( in_array("descr",$filter) ) $result["descr"] = $item->getDescr();
			if( in_array("itemtype",$filter) ) $result["itemtype"] = $item->getItemtype();
			
			return $result;
		}
	}
?>