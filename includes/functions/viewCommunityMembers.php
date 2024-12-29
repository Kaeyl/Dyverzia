<?php 
// This PHP code snippet is responsible for fetching and displaying the number of friends a user has in a community,
// as well as listing those friends with their profile details.

// Query to count the number of friends for the user in a specific community
$query = "SELECT COUNT(*) AS community_member_count FROM community_members WHERE community_id = {$community_id}";
// Execute the query against the database connection
$member_count_query = mysqli_query($connection, $query);

// Fetch the result of the query
if ($member_count_row = mysqli_fetch_assoc($member_count_query)) {
    // If a result is returned, get the community member count
    $member_count_row = $member_count_row['community_member_count'];
} else {
    // If the query fails or returns no results, default the count to 0
    $member_count_row = 0;
}

// Output the count of connections in a paragraph
echo "<p>You have {$member_count_row} connections</p>" . "<br>";
?>

<ul>
<?php
// Query to get the IDs of friends in the community
$query = "SELECT member_id FROM community_members WHERE community_id = {$community_id}";
// Execute the query to get member IDs
$member_count_result = mysqli_query($connection, $query);

// Loop through each member ID returned by the query
while ($community_member_row = mysqli_fetch_assoc($member_count_result)) {
    $member_id = $community_member_row['member_id'];
    
    // Query to get the friend's profile data, including their unique username
    $member_profile_query = "SELECT * FROM user_profile WHERE user_id = {$member_id}";

    // Execute the query to get profile data
    $member_profile_result = mysqli_query($connection, $member_profile_query);

    // Fetch the friend's profile data
    if ($member_data = mysqli_fetch_assoc($member_profile_result)) {
        // Extract the unique username from the user profile data
        $member_profile_uniq_name = $member_data['uniq_username']; 
        
        // Create a list item with a link to the friend's profile page
        echo '<li><a href="profile.php?profile-page=' . urlencode($member_profile_uniq_name) . '">'; // Use url encoding for safety
        echo '<div class="friendImage">'; // Div for friend's profile image
        echo '<img src="./includes/images/' . htmlspecialchars($member_data['profile_picture']) . '" alt="friend profile image">'; // Display the profile picture with proper escaping
        echo '</div>';
        echo '<div class="friendUsername">'; // Div for friend's name display
        echo '<h4>' . htmlspecialchars($member_data['given_name'] . ' ' . $member_data['surname']) . '</h4>'; // Display friend's full name, escaped for safety
        echo '</div>';
        echo '</a></li>'; // Close the list item
    }
}
?>
</ul>
