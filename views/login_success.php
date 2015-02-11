<?php
include_once 'header.php';
// Check if session is not registered, redirect back to main page.
// Put this code in first line of web page.

?>

<html>
<body>
Login Successful
 <a href="logout.php">Log out </a> 
 <br>
 <?php
 //print_r($_SESSION);
 ?>
 <?php
 print("Hello " . $_SESSION['displayname']);
 print( ", how are you today?");
 ?>
 
</body>
</html>