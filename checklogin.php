
<?php
	define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'admin');
    define('DB_DATABASE', 'chatroom');
    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    if ($db->connect_error) {
        die('Connect Error (' . $db->connect_errno . ') '
                . $db->connect_error);
    }

$tbl_name="users"; // Table name

// username and password sent from form
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
//$myusername = mysql_real_escape_string($myusername);
//$mypassword = mysql_real_escape_string($mypassword);

$sql="SELECT * FROM $tbl_name WHERE loginname='$myusername' and password='$mypassword' and active='1'";
$result=mysqli_query($db,$sql);

$row = $result->fetch_row();

// Mysql_num_row is counting table row
$count = $result->num_rows;

// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
session_start();
    $_SESSION['userID']=$row[0];
	$_SESSION['displayname']=$row[3];
    header("location:index3.php");
}
else {
echo "Wrong Username or Password";
echo "<a href=\"main_login.php\">Try again</a>";
}
?>