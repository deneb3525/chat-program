
<?php
    require_once 'controllers\controllerFactory.php';

    try
    {
        $usersController = controllerFactory::getUsersController();
        $usersController->loginUser($_POST['myusername'], $_POST['mypassword']);
		 // Register $myusername, $mypassword and redirect to file "login_success.php"
		
        header("location:index2.php");

    }
    catch (Exception $e)
    {
        echo $e->getMessage();
        echo "<a href=\"main_login.php\">Try again</a>";
    }
    
?>