<?php

session_start();
 
// Destroy user session
unset($_SESSION['customer_id']);
 
// Redirect to index.php page
header("Location: login.php");
?>