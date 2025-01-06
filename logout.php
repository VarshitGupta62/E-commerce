<?php

session_start();

// Unset only the 'login_username' session variable
unset($_SESSION['user_id']);


// Optionally, you can redirect to another page after unsetting the session variable
header("Location: index.php");
exit();

?>