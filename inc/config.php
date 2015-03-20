<?php
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