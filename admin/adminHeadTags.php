<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if it's not already started
}

// Check if the admin user is logged in
if (!isset($_SESSION['admin_name']) || !isset($_SESSION['admin_id'])) {
    header('Location: ./adminLogin.php'); // Redirect to login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./includes/css/style.css">
</head>