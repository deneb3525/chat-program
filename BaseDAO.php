<?php

class BaseDAO {
    public function connect() {
		$configSettings = parse_ini_file("dbconfig.ini");
		
		$db = mysqli_connect($configSettings['DB_SERVER'],$configSettings['DB_USERNAME'],$configSettings['DB_PASSWORD'],$configSettings['DB_DATABASE']);
        if ($db->connect_error) {
                die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
        }
        return $db;
    }
}

?>