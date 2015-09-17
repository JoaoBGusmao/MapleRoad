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
	
	class news {
		private $results;
		private $requisitedFields;
		
		public function getFromDB($id,$fields=false) {
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
			
			if(is_numeric($id)) {
				$fieldToSearch = "id";
			} else {
				$fieldToSearch = "url";
			}
			
			//Load all equip informations
			$b = connection::getInstance()->prepare("SELECT ".$toQuery." i.id FROM news AS i WHERE i.".$fieldToSearch."=:id");
			$b->bindParam(":id",$id);
			$b->execute();
			$resColumn = $b->fetchAll();
			
			if($resColumn == null) {
				throw new Exception('NOT_FOUND');
			}
			
			$this->results = $resColumn[0];
		}

		function __construct($id,$fields=false,$preQuery = false) {
			if(empty($id)) throw new Exception('NOT_FOUND');
			
			if($preQuery == false) {
				$this->getFromDB($id,$fields);
			} else {
				$this->results = $preQuery;
			}
			
		}
		
		public function getId() {
			if($this->requisitedFields == null || in_array("id",$this->requisitedFields)) {
				return $this->results["id"];
			} else {
				return false;
			}
		}
		
		public function getTitle() {
			if($this->requisitedFields == null || in_array("title",$this->requisitedFields)) {
				return $this->results["title"];
			} else {
				return false;
			}
		}
		
		public function getAuthor() {
			if($this->requisitedFields == null || in_array("author",$this->requisitedFields)) {
				return $this->results["author"];
			} else {
				return false;
			}
		}
		
		public function getContent() {
			if($this->requisitedFields == null || in_array("content",$this->requisitedFields)) {
				return $this->results["content"];
			} else {
				return false;
			}
		}
		
		public function getDate() {
			if($this->requisitedFields == null || in_array("date",$this->requisitedFields)) {
				return $this->results["date"];
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
		
		public function getSingleLink() {
			$localPath = LOCAL_PATH;
			if($this->getUrl() == "") {
				return $localPath."noticia/".$this->getId();
			} else {
				return $localPath."noticia/".$this->getUrl();
			}
		}
		
		public function getDateString() {
			$date = explode(" ",$this->getDate());
			$date2 = explode("-",$date[0]);
			$meses = array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
			return $date2[2]." de ".$meses[intval($date2[1]-1)]." de ".$date2[0];
		}
		
	}