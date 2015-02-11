<!DOCTYPE html>
<html>
<body>

<?php
session_start();
print_r($_SESSION);

// remove all session variables
session_unset();

// destroy the session
session_destroy();

print_r($_SESSION);
?>

You are logged out.

 <a href="<?= 'http://'.$_SERVER['HTTP_HOST'].'/views/main_login.php' ?>">Back to login</a>
</body>
</html> 