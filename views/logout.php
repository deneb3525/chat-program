<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php

print_r($_SESSION);

// remove all session variables
session_unset();

// destroy the session
session_destroy();

print_r($_SESSION);
?>

You are logged out.

 <a href="views/login_success.php">Back to login</a>
</body>
</html> 