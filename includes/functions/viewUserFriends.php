<?php 
// This PHP code snippet retrieves and displays the number of friends a user has,
// as well as lists those friends along with their profile details.

// Query to count the number of friends for the user
$query = "SELECT COUNT(*) AS friend_count FROM user_friends WHERE user_id = {$user_id}";
// Execute the query against the database connection
$friend_count_query = mysqli_query($connection, $query);

// Fetch the result of the query
if ($friend_count_row = mysqli_fetch_assoc($friend_count_query)) {
    // If a result is returned, get the count of friends
    $friend_count = $friend_count_row['friend_count'];
} else {
    // If the query fails or returns no results, default the count to 0
    $friend_count = 0;
}

// Output the count of connections in a paragraph
echo "<p>You have {$friend_count} connections</p>" . "<br>";
?>

<ul>
<?php
// Query to get the IDs of friends for the user
$query = "SELECT friend_id FROM user_friends WHERE user_id = {$user_id}";
// Execute the query to get friend IDs
$friend_query_result = mysqli_query($connection, $query);

// Loop through each friend ID returned by the query
while ($friend_row = mysqli_fetch_assoc($friend_query_result)) {
    $friend_id = $friend_row['friend_id'];

    // Query to get the friend's profile data, including their unique username
    $friend_profile_query = "SELECT * FROM user_profile WHERE user_id = {$friend_id}";
    // Execute the query to get profile data
    $friend_profile_result = mysqli_query($connection, $friend_profile_query);

    // Fetch the friend's profile data
    if ($friend_data = mysqli_fetch_assoc($friend_profile_result)) {
        // Extract the unique username from the user profile data
        $friend_uniq_name = $friend_data['uniq_username']; 
        
        // Create a list item with a link to the friend's profile page
        echo '<li><a href="profile.php?profile-page=' . urlencode($friend_uniq_name) . '">'; // Use URL encoding for safety
        echo '<div class="friendImage">'; // Div for friend's profile image
        echo '<img src="./includes/images/' . htmlspecialchars($friend_data['profile_picture']) . '" alt="friend profile image">'; // Display the profile picture with proper escaping
        echo '</div>';
        echo '<div class="friendUsername">'; // Div for friend's name display
        echo '<h4>' . htmlspecialchars($friend_data['given_name'] . ' ' . $friend_data['surname']) . '</h4>'; // Display friend's full name, escaped for safety
        echo '</div>';
        echo '</a></li>'; // Close the list item
    }
}
?>
</ul>
