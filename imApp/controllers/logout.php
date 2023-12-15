<?php
session_start();
session_destroy();

// Clear the session cookie by setting its expiration time to the past
setcookie(session_name(), '', time()-1);

// Prevent caching
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

// Redirect to the login page
header('Location: /login');
exit;
?>
