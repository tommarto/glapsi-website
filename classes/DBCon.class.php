<?php

class DBCon {
    
    private $dsn;
    private $dbEngine;
    private $host;
    private $port;
    private $user;
    private $pass;
    private $dbName;
    public static $con; 
    

    private function __construct($dbEngine, $host, $dbUser, $dbPass, $dbName, $port = 3306, $single = TRUE)
    {
        // $this->setDBEngine($dbEngine);
        // $this->setHost($host);
        // $this->setUser($dbUser);
        // $this->setPass($dbPass);
        // $this->setDBName($dbName);
        // $this->setPort($port);
        // $this->setDsn("$dbEngine:host=$host:$port;dbname=$dbName;");

        // if($single = TRUE){
        //     self::$con = new PDO($this->getDsn(), $this->getUser(), $this->getPass());
        //     return self::$con;
        // }else{
        //     $this->con = new PDO($this->getDsn());
        //     return $this->con;
        // }
        
    }

    public static function connect($dbEngine = NULL, $host = NULL, $dbUser = NULL, $dbPass = NULL, $dbName = NULL, $port = 3306, $single = TRUE){
        if($single == TRUE){
            if(!isset(self::$con)){
                // self::$con = new DBCon($dbEngine, $host, $dbUser, $dbPass, $dbName, $port, $single = TRUE);
                self::$con = new PDO("$dbEngine:host=$host:$port;dbname=$dbName;",$dbUser,$dbPass);
            }
            return self::$con;
        }else{
            return new DBCon($dbEngine, $host, $dbUser, $dbPass, $dbName, $port, $single);
        }
    }

    #### Getters & Setters: 
    public function setDsn($data)
    {
        $this->dsn = $data;
    }
    public function setDBEngine($data)
    {
        $this->dbEngine = $data;
    }
    public function setHost($data)
    {
        $this->host = $data;
    }
    public function setUser($data)
    {
        $this->user = $data;
    }
    public function setPass($data)
    {
        $this->pass = $data;
    }
    public function setDBName($data)
    {
        $this->dbName = $data;
    }
    public function setPort($data)
    {
        $this->port = $data;
    }
    
    public function getDsn()
    {
        return $this->dsn;
    }
    public function getDBEngine()
    {
        return $this->dbEngine;
    }
    public function getHost()
    {
        return $this->host;
    }
    public function getUser()
    {
        return $this->user;
    }
    public function getPass()
    {
        return $this->pass;
    }
    public function getDBName()
    {
        return $this->dbName;
    }
    public function getPort()
    {
        return $this->port;
    }
}

