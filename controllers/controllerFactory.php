<?php

/* 
 * Factory for controllers
 */

class controllerFactory
{
    static function getUsersController()
    {
        include('usersController.php');
        return new usersController();
    }
}