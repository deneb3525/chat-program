<?php

/* 
 * Factory for controllers
 */

class controllerFactory
{
    static function getUsersController()
    {
        require_once ($_SERVER['DOCUMENT_ROOT'].'/controllers/usersController.php');
        return new usersController();
    }
    
    static function getChatlogController()
    {
        require_once ($_SERVER['DOCUMENT_ROOT'].'/controllers/chatlogController.php');
        return new chatlogController();
    }
}