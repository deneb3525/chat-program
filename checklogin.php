
<?php
	include 'controllers\controllerFactory.php';

    try
    {
        $usersController = controllerFactory::getUsersController();
        $row = $usersController->loginUser($_POST['myusername'], $_POST['mypassword']);
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
        echo "<a href=\"main_login.php\">Try again</a>";
    }
    // Register $myusername, $mypassword and redirect to file "login_success.php"
    session_start();
        $_SESSION['userID']=$row[0];
            $_SESSION['displayname']=$row[3];
        header("location:index3.php");

?>