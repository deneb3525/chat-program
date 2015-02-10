<?php
include 'BaseDAO.php';

try
    {
        $usersController = controllerFactory::getUsersController();
        $row = $usersController->createUser($_POST['myusername'], $_POST['mypassword']);
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
        echo "<a href=\"main_login.php\">Try again</a>";
    }
	
$goober = new BaseDAO();
$db = $goober->connect();

$tbl_name="users"; // Table name

// username and password sent from form
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];
$mydisplayname=$_POST['mydisplayname'];
// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
//$myusername = mysql_real_escape_string($myusername);
//$mypassword = mysql_real_escape_string($mypassword);
	
$sql="SELECT * FROM $tbl_name WHERE loginname='$myusername' and active='1'";
$result=mysqli_query($db,$sql);

// Mysql_num_row is counting table row
$count = $result->num_rows;

// There must be no matches

if($count==0){
// Add the username and password to the DB, then register the username and display name.
// Register $myusername, $mypassword and redirect to file "login_success.php"
$sql="insert into chatroom.users (loginname, password, displayname, active) values ('$myusername', '$mypassword', '$mydisplayname', 1);";
echo $sql;
$result = mysqli_query($db, $sql);
	
session_start();
	$_SESSION['userID']=$myusername;
	$_SESSION['displayname']=$mydisplayname;
	header("location:index3.php");
}
else {
echo "Username already exists, please chose another.<br>";
echo "<a href=\"create_act.php\">Try again</a><br>";
echo "<a href=\"Main_login.php\">Return to Login</a>";
}

?>