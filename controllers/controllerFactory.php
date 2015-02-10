<?php

/* 
 * Factory for controllers
 */

class controllerFactory
{
    static function getUsersController()
    {
        require_once ('usersController.php');
        return new usersController();
    }
    
    static function getChatlogController()
    {
        require_once ('chatlogController.php');
        return new chatlogController();
    }
}