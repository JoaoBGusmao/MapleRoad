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

	$etc_list = "1032000,1000004";
	$url = "http://www.mapleroad.com.br/api/equip.json.php?equipid=".$etc_list;
	$item_road = json_decode(file_get_contents($url),true);
	
	echo '<img src="'.$item_road["1032000"]["icon"].'"></img>';
	
?>