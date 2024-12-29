<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db.php"; // Ensure this file includes the database connection
session_start();

// Handle account creation
if (isset($_POST['create'])) {
    function create_uniq_username($given_name, $surname) {
        $random_string = random_int(100000, 999999); // Generate a random number
        
        // Create an array with the components you want to shuffle
        $components = [
            substr($given_name, 0, 1), // First character of given name
            substr($surname, 0, 5),     // First five characters of surname
            (string)$random_string       // Random number as a string
        ];
        
        // Shuffle the array to randomize the order
        shuffle($components);
        
        // Concatenate the shuffled components into a single string
        return strtolower(implode('', $components)); // Return the random ordered string in lowercase
    }

    $given_name = $_POST['given_name'];
    $surname = $_POST['surname'];
    $uniq_username = create_uniq_username($given_name, $surname);
    $email_add = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];

    if (!empty($uniq_username) && !empty($given_name) && !empty($surname) && !empty($email_add) && !empty($password)) {
        $uniq_username = mysqli_real_escape_string($connection, $uniq_username);
        $given_name = mysqli_real_escape_string($connection, $given_name);
        $surname = mysqli_real_escape_string($connection, $surname);
        $email_add = mysqli_real_escape_string($connection, $email_add);
        $password = mysqli_real_escape_string($connection, $password);
        $dob = mysqli_real_escape_string($connection, $dob);
        $country = mysqli_real_escape_string($connection, $country);
        $state = mysqli_real_escape_string($connection, $state);
        $city = mysqli_real_escape_string($connection, $city);

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the database
        $query = "INSERT INTO user_profile (uniq_username, email_add, passwd, country, state, city, dob, given_name, surname, profile_picture, user_cover_photo) ";
        $query .= "VALUES ('{$uniq_username}', '{$email_add}', '{$hashed_password}', '{$country}', '{$state}', '{$city}', '{$dob}', '{$given_name}', '{$surname}', 'nothing', 'nothing')";
        
        $register_user_query = mysqli_query($connection, $query);
        if (!$register_user_query) {
            die("QUERY FAILED: " . mysqli_error($connection));
        }

        // Redirect to the login screen after 3 seconds
        echo "<p>Your registration has been submitted. You will be redirected to the login page in 3 seconds.</p>";
        echo "<meta http-equiv='refresh' content='3;url=../login_page.php'>";
        exit();
    } else {
        $message = "Fields cannot be empty.";
    }
}


?>