<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

include "adminDB.php"; // Ensure this file includes the database connection
session_start();

// Handle login
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $passwd = $_POST['password'];
    // echo $passwd, $email_add;
// }

    // Sanitize input
    $username = mysqli_real_escape_string($connection1, $username);
    $passwd = mysqli_real_escape_string($connection1, $passwd);

    // Check if the query is correct
    $query = "SELECT * FROM admin_account WHERE admin_name = '{$username}'"; 
    echo $query;

    $select_user_query = mysqli_query($connection1, $query);

    if (!$select_user_query) {
        die("QUERY FAILED: " . mysqli_error($connection1));
    }

    // Fetch user details
    if ($row = mysqli_fetch_array($select_user_query)) {
        $db_user_id = $row['admin_id'];
        $db_given_name = $row['admin_name'];  
        $db_user_password = $row['admin_password']; // Hashed password


        // Verify the password
        if (password_verify($passwd, $db_user_password)) {
            // Set session variables
            $_SESSION['admin_id'] = $db_user_id;
            $_SESSION['admin_name'] = $db_given_name;


            // Redirect to the index page after successful login
   
            header('Location: ../index.php');
            exit(); // Ensure no further code is executed
        } 
    } 

    // Redirect to the login page if credentials are incorrect
    header('Location: login_page.php');
    exit(); // Ensure no further code is executed
}
?>

