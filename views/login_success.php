<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/views/header.php';
// Check if session is not registered, redirect back to main page.
// Put this code in first line of web page.

?>

<html>
<body>
Login Successful
 <a href="<?= 'http://'.$_SERVER['HTTP_HOST'].'/views/logout.php' ?>">Log out </a> 
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