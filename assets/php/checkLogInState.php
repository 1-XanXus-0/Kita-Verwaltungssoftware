<?php
// Initialize the session
session_start();
 
$username = '';

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: page-login.php");
    exit;
}else
{
    $username = $_SESSION["signin-email"];
}
?>