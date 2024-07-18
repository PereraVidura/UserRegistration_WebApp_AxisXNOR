<?php
session_start();

// Include database configuration
include('admin/database/dbconfig.php');

// Check if the database is connected
if(!$dbconfig) 
{
    // Redirect to the database configuration page if the connection fails
    header("Location: admin/database/dbconfig.php");
    exit();
}

// Check if the user is logged in
if(!isset($_SESSION['username'])) 
{
    // Redirect to the login page if the user is not logged in
    header("Location: admin/login.php");
    exit();
}
?>
