<?php
	$etc_list = "1032000,1000004";
	$url = "http://www.mapleroad.com.br/api/equip.json.php?equipid=".$etc_list;
	$item_road = json_decode(file_get_contents($url),true);
	
	echo '<img src="'.$item_road["1032000"]["icon"].'"></img>';
	
?>