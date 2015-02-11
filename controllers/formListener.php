<?php

require_once 'controllerFactory.php';
require_once 'renderEngine.php';

class formListener
{
    public function create($post)
    {
        try
        {
            $usersController = controllerFactory::getUsersController();
            $usersController->createUser($post['myusername'], $post['mypassword'],$post['mydisplayname']);

            renderEngine::renderView('chatroom');
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            echo "Username already exists, please chose another.<br>";
            echo "<a href=\"create_act.php\">Try again</a><br>";
            echo "<a href=\"Main_login.php\">Return to Login</a>";

        }
    }
    
    public function login($post)
    {
        try
        {
            $usersController = controllerFactory::getUsersController();
            $usersController->loginUser($post['myusername'], $post['mypassword']);
            renderEngine::renderView('chatroom');
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            echo "<a href=\"main_login.php\">Try again</a>";
        }
    }
}

$formListener = new formListener();
switch($_POST['Submit'])
{
    case 'Login':
        $formListener->login($_POST);
        break;
    case 'Register':
        $formListener->create($_POST);
        break;
}
?>