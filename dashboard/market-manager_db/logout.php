<?php
session_start();

// Destroy all session variables
session_unset();

// Destroy the session
session_destroy();

// Clear session cookie
setcookie(session_name(), '', time() - 3600, '/');

// Redirect to login page
header("Location:/login_db/loginpage.php ");  // Change 'login.html' to your actual login page
exit();
