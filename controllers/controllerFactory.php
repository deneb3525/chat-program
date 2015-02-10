<?php

/* 
 * Factory for controllers
 */

class controllerFactory
{
    function getUsersController()
    {
        include('usersController.php');
        return new usersController();
    }
}