<?php

class BaseDAO {
	public function connect() {
		define('DB_SERVER', 'localhost');
		define('DB_USERNAME', 'root');
		define('DB_PASSWORD', 'admin');
		define('DB_DATABASE', 'chatroom');
		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if ($db->connect_error) {
			die('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
		}
		return $db;
	}
	/*
	public quary($db,$sql){
		$result=mysqli_query($db,$sql);
		return $result;
	}*/	
}

?>