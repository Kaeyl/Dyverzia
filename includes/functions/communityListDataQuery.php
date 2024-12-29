<?php
// This PHP code snippet checks if a user is logged in and retrieves data for all communities.

// Check if the user is logged in by verifying if 'given_name' is set in the session
if (!isset($_SESSION['given_name'])) {
    // If the user is not logged in, redirect them to the login page
    header('Location: ./login_page.php');
    exit(); // Exit to ensure no further code is executed after the redirect
}

// Query to retrieve all community data
$query = "
    SELECT 
        community_id,
        community_name,
        profile_picture,
        cover_picture,
        community_description
    FROM 
        communities
";

// Execute the query against the database connection
$result = mysqli_query($connection, $query);

// Check if the query executed successfully
if (!$result) {
    // If the query fails, output an error message and terminate the script
    die("QUERY FAILED: " . mysqli_error($connection));
}

// Fetch all community data
$communities = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Store each community's data in the $communities array
    $communities[] = $row;
}

// If no communities are found, handle that case
if (empty($communities)) {
    $noCommunitiesMessage = "No communities found. Please check back later!";
}
?>
