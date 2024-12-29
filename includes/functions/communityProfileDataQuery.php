<?php
// This PHP code snippet checks if a user is logged in and retrieves data for a specific community.

// Check if the user is logged in by verifying if 'given_name' is set in the session
if (!isset($_SESSION['given_name'])) {
    // If the user is not logged in, redirect them to the login page
    header('Location: ./login_page.php');
    exit(); // Exit to ensure no further code is executed after the redirect
}

// Get the community name from the URL query parameter
$community_name = isset($_GET['community-name']) ? mysqli_real_escape_string($connection, $_GET['community-name']) : 'Default Community';

// Query to retrieve community data along with user permissions
$query = "
    SELECT 
        c.community_id,
        c.community_name,
        c.profile_picture,
        c.cover_picture,
        cp.user_id,
        cp.permission_type
    FROM 
        communities AS c
    LEFT JOIN 
        community_permissions AS cp ON c.community_id = cp.community_id
    WHERE 
        c.community_name = '{$community_name}'
";

// Execute the query against the database connection
$result = mysqli_query($connection, $query);

// Check if the query executed successfully
if (!$result) {
    // If the query fails, output an error message and terminate the script
    die("QUERY FAILED: " . mysqli_error($connection));
}

// Fetch the community data
if ($row = mysqli_fetch_assoc($result)) {
    // If a row is returned, extract the community data and permissions into variables
    $community_id = $row['community_id'];
    $community_name = $row['community_name'];
    $profile_picture = $row['profile_picture'];
    $cover_picture = $row['cover_picture'];
    $user_id = $row['user_id'];
    $permission_type = $row['permission_type'];

    // Check if the user is an admin or member
    if ($user_id === $_SESSION['user_id']) {
        if ($permission_type === 1) { 
            // User is an admin
            // Additional logic for admin can go here

            
        } elseif ($permission_type === 2) {

            // User is a member
            // Additional logic for member can go here
        }
    } else {

        // User is not associated with this community
        // Handle case when user does not have permissions
        die("You do not have permissions to access this community.");


    }
} else {
    // If no row is returned, terminate the script with an error message
    die("Community not found.");
}
?>
