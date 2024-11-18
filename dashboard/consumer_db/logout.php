<?php
session_start(); // Start the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
header("Location:/login_db/loginpage.php "); // Redirect to login page if not logged in
exit();
?>
