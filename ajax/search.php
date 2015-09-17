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
	require_once("../inc/classes/class.searchEngine.php");
	require_once("../inc/classes/class.quest.php");
	require_once("../inc/classes/class.map.php");
	require_once("../inc/classes/class.mob.php");
	require_once("../inc/classes/class.npc.php");
	require_once("../inc/classes/class.item.php");
	require_once("../inc/classes/class.equip.php");
	
	$searchEngine = new searchEngine();
	
	$return = array();
	
	
	$search = $searchEngine->doSearch($_GET['query']);
	
	if($search == "EXCEDED_NUMBER_OF_TERMS") {
		$return = array(array("type"=>"error","error_type"=>"EXCEDED_NUMBER_OF_TERMS"));
	} else {
		foreach( $search as $searchResult ) {
			$type = $searchResult[1][1];
			
			if($type == "mobs") {
				$id = $searchResult[1][0]["mobid"];
				$name = $searchResult[1][0]["name"];
				$url = $searchResult[1][0]["url"];
				$mobInstance = new mob($id,"", array("mobid"=>$id,"name"=>$name,"url"=>$url) ); 
				array_push($return, array("type"=>"mobs","name"=>$mobInstance->getName(),"singleLink"=>$mobInstance->getSingleLink(),"cachedIcon"=>$mobInstance->getCachedIcon() ));
			}
			
			if($type == "items") {
				$id = $searchResult[1][0]["itemid"];
				$name = $searchResult[1][0]["name"];
				$url = $searchResult[1][0]["url"];
				$itemInstance = new item($id,"", array("itemid"=>$id,"name"=>$name,"url"=>$url) ); 
				array_push($return, array("type"=>"items","name"=>$itemInstance->getName(),"singleLink"=>$itemInstance->getSingleLink(),"cachedIcon"=>$itemInstance->getCachedIcon() ));
			}
			
			if($type == "equips") {
				$id = $searchResult[1][0]["itemid"];
				$name = $searchResult[1][0]["name"];
				$url = $searchResult[1][0]["url"];
				$equipInstancce = new equip($id,"", array("itemid"=>$id,"name"=>$name,"url"=>$url) ); 
				array_push($return, array("type"=>"equips","name"=>$equipInstancce->getName(),"singleLink"=>$equipInstancce->getSingleLink(),"cachedIcon"=>$equipInstancce->getCachedIcon() ));
			}
			
			if($type == "maps") {
				$id = $searchResult[1][0]["mapid"];
				$name = $searchResult[1][0]["mapName"];
				$url = $searchResult[1][0]["url"];
				$mapInstance = new map($id,"", array("mapid"=>$id,"mapName"=>$name,"url"=>$url) ); 
				array_push($return, array("type"=>"maps","mapName"=>$mapInstance->getMapName(),"singleLink"=>$mapInstance->getSingleLink(),"cachedIcon"=>$mapInstance->getCachedIcon() ));
			}
			
			if($type == "npcs") {
				$id = $searchResult[1][0]["npcid"];
				$name = $searchResult[1][0]["name"];
				$url = $searchResult[1][0]["url"];
				$npcInstance = new npc($id,"", array("npcid"=>$id,"name"=>$name,"url"=>$url) ); 
				array_push($return, array("type"=>"npcs","name"=>$npcInstance->getName(),"singleLink"=>$npcInstance->getSingleLink(),"cachedIcon"=>$npcInstance->getCachedIcon() ));
			}
			
			if($type == "wz_questdata") {
				$id = $searchResult[1][0]["questid"];
				$name = $searchResult[1][0]["name"];
				$url = $searchResult[1][0]["url"];
				$questInstance = new quest($id,"", array("npcid"=>$id,"name"=>$name,"url"=>$url) ); 
				array_push($return, array("type"=>"wz_questdata","name"=>$questInstance->getName(),"singleLink"=>$questInstance->getSingleLink(),"cachedIcon"=>"" ));
			}
		}
	}
	echo json_encode($return);

?>