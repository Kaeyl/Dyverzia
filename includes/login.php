<?php
include "db.php"; // Ensure this file includes the database connection
session_start();

// Handle login
if (isset($_POST['login'])) {
    $email_add = trim($_POST['email_add']);
    $passwd = trim($_POST['password']);

    // Validate email format
    if (!filter_var($email_add, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../login_page.php?error=invalid_email');
        exit();
    }

    // Sanitize email for database query
    $email_add = mysqli_real_escape_string($connection, $email_add);

    // Query to fetch user by email
    $query = "SELECT * FROM user_profile WHERE email_add = '{$email_add}'";
    $select_user_query = mysqli_query($connection, $query);

    if (!$select_user_query) {
        die("QUERY FAILED: " . mysqli_error($connection));
    }

    // Fetch user details
    if ($row = mysqli_fetch_array($select_user_query)) {
        $db_user_id = $row['user_id'];
        $db_given_name = $row['given_name'];
        $db_surname = $row['surname'];
        $db_user_password = $row['passwd']; // Hashed password
        $db_email_add = $row['email_add'];
        $db_role = $row['role'];

        // Verify the password
        if (password_verify($passwd, $db_user_password)) {
            // Set session variables
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['given_name'] = $db_given_name;
            $_SESSION['uniq_username'] = $db_given_name; // Replace undefined variable
            $_SESSION['surname'] = $db_surname;
            $_SESSION['email'] = $db_email_add;
            $_SESSION['role'] = $db_role;

            // Redirect to the index page after successful login
            header('Location: ../index.php');
            exit();
        } else {
            header('Location: ../login_page.php?error=invalid_password');
            exit();
        }
    } else {
        header('Location: ../login_page.php?error=user_not_found');
        exit();
    }
}
?>
