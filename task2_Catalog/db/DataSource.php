<?php

class DataSource {
	private $host = '127.0.0.1';
    private $db = 'catalog';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8';

    public function getConnection() {
	    $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
	    $opt = [
	        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        PDO::ATTR_EMULATE_PREPARES   => false,
	    ];
	    
	    return new PDO($dsn, $this->user, $this->pass, $opt);
    }
}