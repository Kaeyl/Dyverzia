<?php 
// This code retrieves user profile information and associated hobbies from a database. 
// It selects fields like user ID, username, email, location details, and hobby information 
// using SQL JOINs. The data is then fetched, stored in variables, and organized into an 
// array of hobbies. If the user is not found, an error is displayed.

// Assume $logged_in_username is the username of the logged-in user
$logged_in_username = $_SESSION['uniq_username']; // Adjust as necessary

// Step 1: Retrieve hobbies of the logged-in user
$query_user_hobbies = "
    SELECT 
        hc.name AS hobby_name
    FROM 
        user_profile AS up
    LEFT JOIN 
        user_hobbies AS uh ON up.user_id = uh.user_id
    LEFT JOIN 
        hobby_categories AS hc ON uh.hobby_name = hc.name
    WHERE 
        up.uniq_username = '{$logged_in_username}'
";

$result_user_hobbies = mysqli_query($connection, $query_user_hobbies);

if (!$result_user_hobbies) {
    die("QUERY FAILED: " . mysqli_error($connection));
}

// Collect hobbies of the logged-in user
$logged_in_hobbies = [];
while ($row = mysqli_fetch_assoc($result_user_hobbies)) {
    if (!empty($row['hobby_name'])) {
        $logged_in_hobbies[] = $row['hobby_name'];
    }
}

if (empty($logged_in_hobbies)) {
    die("No hobbies found for the logged-in user.");
}

// Step 2: Find users with the same hobbies and are not friends or the logged-in user
if (!empty($logged_in_hobbies)) {
    $hobbies_placeholder = "'" . implode("', '", array_map(function($hobby) use ($connection) {
        return mysqli_real_escape_string($connection, $hobby);
    }, $logged_in_hobbies)) . "'";

    // Get the user ID of the logged-in user for further filtering
    $query_user_id = "
        SELECT user_id 
        FROM user_profile 
        WHERE uniq_username = '{$logged_in_username}'
    ";
    
    $result_user_id = mysqli_query($connection, $query_user_id);
    if (!$result_user_id) {
        die("QUERY FAILED: " . mysqli_error($connection));
    }

    $user_data = mysqli_fetch_assoc($result_user_id);
    $logged_in_user_id = $user_data['user_id'];

    // Main query to find matching users excluding the logged-in user and friends
    $query_matching_users = "
        SELECT DISTINCT 
            up.user_id,
            up.given_name AS first_name,
            up.surname AS last_name,
            up.uniq_username,
            up.profile_picture
        FROM 
            user_profile AS up
        JOIN 
            user_hobbies AS uh ON up.user_id = uh.user_id
        LEFT JOIN 
            user_friends AS uf ON (up.user_id = uf.friend_id AND uf.user_id = '{$logged_in_user_id}')
        WHERE 
            uh.hobby_name IN ($hobbies_placeholder)
            AND up.user_id != '{$logged_in_user_id}' -- Exclude the logged-in user
            AND uf.friend_id IS NULL -- Exclude friends
    ";
}

// Execute the query for matching users
$result_matching_users = mysqli_query($connection, $query_matching_users);

if (!$result_matching_users) {
    die("QUERY FAILED: " . mysqli_error($connection));
}

?>

<div class="makeFriendPannel">
  <div class="makeFriendList">
  <h3>Suggested Friends</h3>
<?php
echo "<ul>";
while ($user = mysqli_fetch_assoc($result_matching_users)) {
    echo "<a href='http://localhost/websiteDevelopment/projects/Uniq/profile.php?profile-page=" . htmlspecialchars($user['uniq_username']) . "'><li>
            <div class='makeFriendImage'>
                <img src='./includes/images/" . htmlspecialchars($user['profile_picture']) . "' alt='Profile Picture'>
            </div>
            <div class='makeFriendUsername'>
                <h4>" . htmlspecialchars($user['first_name']) . " " .htmlspecialchars($user['last_name']) . "</h4>
            </div>
          </li></a>";
}
echo "</ul>";
?>

    <a href="#"><p>View more users</p></a>
</div>
</div>