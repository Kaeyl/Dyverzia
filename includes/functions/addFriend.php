<?php
include "../../includes/db.php"; // Ensure this file includes the database connection
session_start(); // Make sure to start the session to access session variables

// Check if the form was submitted
if (isset($_POST['followButton'])) {
    // Accessing the values passed from the form
    $redirect = isset($_POST['redirect']) ? $_POST['redirect'] : '';
    $friend_id = isset($_POST['friend_id']) ? intval($_POST['friend_id']) : 0; // Use intval for safety
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0; // Use intval for safety
    $user_friend_name = isset($_POST['user_friend_name']) ? $_POST['user_friend_name'] : '';

    // Now you can use these variables for further processing, like adding a friend
    if ($friend_id > 0 && $user_id > 0 && !empty($user_friend_name)) {
        // Check if the friendship already exists
        $checkStmt = $connection->prepare("SELECT * FROM user_friends WHERE user_id = ? AND friend_id = ?");
        $checkStmt->bind_param("ii", $user_id, $friend_id);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        // If no existing friendship, insert the new one
        if ($result->num_rows == 0) {
            $stmt = $connection->prepare("INSERT INTO user_friends (user_id, friend_id, user_friend_name) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("iis", $user_id, $friend_id, $user_friend_name);
                if ($stmt->execute()) {
                    echo "Friend added successfully.";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Prepare failed: " . $connection->error;
            }
        } else {
            echo "You are already friends with this user.";
        }

        $checkStmt->close();
    } else {
        echo "Invalid data provided.";
    }

    // Redirect or return to the previous page
    header("Location: " . $redirect);
    exit();
}

// The rest of your code for fetching users can remain the same
?>
