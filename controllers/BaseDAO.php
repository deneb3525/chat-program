<?php

class BaseDAO {

    private $db;
    
    public function __construct() {
        $this->connect();
    }

    public function connect() {
        $configSettings = parse_ini_file($_SERVER['DOCUMENT_ROOT']."/configs/dbconfig.ini");

        $this->db = mysqli_connect($configSettings['DB_SERVER'],$configSettings['DB_USERNAME'],$configSettings['DB_PASSWORD'],$configSettings['DB_DATABASE']);
        if ($this->db->connect_error) {
                die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }
    }
    
    public function query($sql, $params)
    {
        $query = vsprintf($sql, $params);
        return mysqli_query($this->db,$query);
    }
    
    public function __destruct() {
        unset($this->db);
    }
}

?>