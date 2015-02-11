<?php

class BaseDAO {
    private $db;
    
    public function __construct() {
        $this->connect();
    }

    public function connect()
    {
        $DB_SERVER = 'localhost';
        $DB_USERNAME = 'root';
        $DB_PASSWORD = '';
        $DB_DATABASE = 'chatroom';
        $this->db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);
        if ($this->db->connect_error) {
            die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }
    }
    
    public function query($sql, $params)
    {
        $query = vsprintf($sql, $params);
        echo $query;
        return mysqli_query($this->db,$query);
    }
    
    public function __destruct() {
        unset($this->db);
    }
}

?>