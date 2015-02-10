<?php
include 'controllers\controllerFactory.php';

try
    {
        $usersController = controllerFactory::getUsersController();
        $row = $usersController->createUser($_POST['myusername'], $_POST['mypassword'],$_POST['mydisplayname']); ?>
		
		<form method="post" action="checklogin.php">
		<input type="hidden" name="myusername" value="<?php $_POST['myusername']?>">
		<input type="hidden" name="mypassword" value="<?php $_POST['mypassword']?>">
		<input type="submit">
		</form>
		<?php

    }
    catch (Exception $e)
    {
        echo $e->getMessage();
        echo "Username already exists, please chose another.<br>";
		echo "<a href=\"create_act.php\">Try again</a><br>";
		echo "<a href=\"Main_login.php\">Return to Login</a>";

    }
	
	

?>