<?php
include "adminDB.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submission_type = $_POST['sub_type'];
    $post_id = $_POST['post_id'];
    $new_status = $_POST['new_status'];


    if ($submission_type == 'User Post') {
    // Validate inputs
    if (empty($post_id) || !in_array($new_status, ['draft', 'delete', 'approve', 'frozen'])) {
        die('Invalid input.');
    }

    // Update query
    if ($new_status === 'delete') {
        $query = "DELETE FROM user_posts WHERE post_id = ?";
    } else if ($new_status === 'draft') {
        $query = "UPDATE user_posts SET status = 'draft' WHERE post_id = ?";
    } else if ($new_status === 'approve') {
        $query = "UPDATE user_posts SET status = 'approved' WHERE post_id = ?";
    } else {
        $query = "UPDATE user_posts SET status = 'frozen' WHERE post_id = ?";
    }

    if ($stmt = mysqli_prepare($connection2, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $post_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // Redirect back to the posts page or show a success message

    header('Location: ../index.php'); 
    exit;
}

 else if ($submission_type === 'Community Post' ){
    if (empty($post_id) || !in_array($new_status, ['draft', 'delete', 'approve', 'frozen'])) {
        die('Invalid input.');
    }

    // Update query
    if ($new_status === 'delete') {
        $query = "DELETE FROM community_posts WHERE post_id = ?";
    } else if ($new_status === 'draft') {
        $query = "UPDATE community_posts SET status = 'draft' WHERE post_id = ?";
    } else if ($new_status === 'approve') {
        $query = "UPDATE community_posts SET status = 'approved' WHERE post_id = ?";
    } else {
        $query = "UPDATE community_posts SET status = 'frozen' WHERE post_id = ?";
    }

    if ($stmt = mysqli_prepare($connection2, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $post_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // Redirect back to the posts page or show a success message

    header('Location: ../index.php'); 
    exit;
}
}
// Close the database connection
mysqli_close($connection2);
?>