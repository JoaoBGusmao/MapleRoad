<?php

	class connection extends PDO { 
    /*
    private $engine; 
    private $host; 
    private $database; 
    private $user; 
    private $pass; */
    
    /*public function __construct(){ 
        global $connection;
		$this->engine = DB_ENGINE; 
		$this->host = DB_HOST; 
		$this->database = DB_DATABASE; 
		$this->user = DB_USER; 
		$this->pass = DB_PASS; 
		$dns = $this->engine.':dbname='.$this->database.";host=".$this->host; 
		$connection = parent::__construct( $dns, $this->user, $this->pass );
    }
	
	public function getConnection() {
		
	}*/
	private static $instance; 
	
	public function __construct() { 
	// 
	} 
	public static function getInstance() {
		if (!isset(self::$instance)) {
			self::$instance = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING); 
		}
		return self::$instance; 
	}

}