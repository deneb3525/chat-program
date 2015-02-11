<?php

require_once 'BaseDAO.php';
require_once 'controllers/controllerFactory.php';

try
    {
        $usersController = controllerFactory::getUsersController();
        $usersController->createUser($_POST['myusername'], $_POST['mypassword'],$_POST['mydisplayname']);
		
	header("location:index.php");

    }
    catch (Exception $e)
    {
        echo $e->getMessage();
        echo "Username already exists, please chose another.<br>";
        echo "<a href=\"create_act.php\">Try again</a><br>";
        echo "<a href=\"Main_login.php\">Return to Login</a>";

    }
	
	

?>