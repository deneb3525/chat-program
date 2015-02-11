<?php

/* 
 * Controllers handle the backend logic.
 * For example, if you're dealing with a Login script, a Users controller should contain the functions that check the passwords.
 * 
 * The baseController should contain functionality that is commonly used in all controllers
 */

class baseController {
    protected function DBconnect()
    {
        require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/BaseDAO.php';
	
	$baseDAO = new BaseDAO();
	return $baseDAO;
    }
}