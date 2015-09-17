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

	error_reporting(0);
	//Deine as variáveis para o banco
	define("DB_ENGINE", "mysql");
	define("DB_HOST", "HOST");
	define("DB_USER", "USER");
	define("DB_PASS", "PASSWORD");
	define("DB_DATABASE", "DATABASE");
	
	define("IMG_NPC_PATH", "/img/npcs/default/");
	define("IMG_MOB_PATH", "/img/mobs/stand0/");
	define("IMG_ITEM_PATH", "/img/items/icon/");
	define("IMG_EQUIP_PATH", "/img/equips/icon/");
	define("IMG_MAP_PATH", "/img/maps/minimap/");
	define("LOCAL_PATH", "/");
	define("REMOTE_PATH", "http://www.mapleroad.com.br/");
	
	//Instancia a classe responsável pela conexão com o banco
		function tempoExecucao($start = null) {
			// Calcula o microtime atual
			$mtime = microtime(); // Pega o microtime
			$mtime = explode(' ',$mtime); // Quebra o microtime
			$mtime = $mtime[1] + $mtime[0]; // Soma as partes montando um valor inteiro

			if ($start == null) {
				// Se o parametro não for especificado, retorna o mtime atual
				return $mtime;
			} else {
				// Se o parametro for especificado, retorna o tempo de execução
				return round($mtime - $start, 2);
			}
		}
		// Define uma constante contendo o microtime atual
	define('mTIME', tempoExecucao());
?>