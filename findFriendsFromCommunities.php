<?php
// Assume $logged_in_id is the user ID of the logged-in user

// Step 1: Retrieve hobbies of the logged-in user
$query_user_hobbies = "
    SELECT uh.hobby_id 
    FROM user_hobbies AS uh
    WHERE uh.user_id = {$logged_in_id}
";

$result_user_hobbies = mysqli_query($connection, $query_user_hobbies);
if (!$result_user_hobbies) {
    die("QUERY FAILED: " . mysqli_error($connection));
}

// Collect hobby IDs of the logged-in user
$hobby_ids = [];
while ($row = mysqli_fetch_assoc($result_user_hobbies)) {
    $hobby_ids[] = $row['hobby_id'];
}

if (empty($hobby_ids)) {
    // die("No hobbies found for the logged-in user.");
}

// Step 2: Find communities of the logged-in user
$query_communities = "
    SELECT cm.community_id 
    FROM community_members AS cm 
    WHERE cm.member_id = {$logged_in_id}
";

$result_communities = mysqli_query($connection, $query_communities);
$community_ids = [];

if ($result_communities) {
    while ($community = mysqli_fetch_assoc($result_communities)) {
        $community_ids[] = $community['community_id'];
    }
}

if (empty($community_ids)) {
    die("No communities found for the logged-in user.");
}

// Step 3: Prepare potential friends list based on hobbies and communities
$potential_friends = [];
if (!empty($hobby_ids) && !empty($community_ids)) {
    $hobby_ids_placeholder = implode(',', array_map('intval', $hobby_ids));
    $community_ids_placeholder = implode(',', array_map('intval', $community_ids));

    // Query to find users with the same hobbies and in the same communities
    $query_matching_users = "
        SELECT DISTINCT 
            uh.user_id, uh.hobby_name, 
            up.uniq_username, up.given_name, up.surname, 
            up.profile_picture, up.user_cover_photo
        FROM 
            user_hobbies AS uh
        JOIN 
            user_profile AS up ON uh.user_id = up.user_id
        JOIN 
            community_members AS cm ON up.user_id = cm.member_id
        WHERE 
            uh.hobby_id IN ($hobby_ids_placeholder)
            AND cm.community_id IN ($community_ids_placeholder)
            AND up.user_id != {$logged_in_id}
    ";

    $result_matching_users = mysqli_query($connection, $query_matching_users);
    if (!$result_matching_users) {
        die("QUERY FAILED: " . mysqli_error($connection)); // Check for query errors
    }

    while ($friend = mysqli_fetch_assoc($result_matching_users)) {
        $potential_friends[] = $friend;
    }
}

// Display potential friends found in communities
if (!empty($potential_friends)) {
    echo "<div class='contentContainer'>";
    echo "<h2>People with Similar Hobbies from your communities.</h2>";
    echo "<div class='friendListContainer'>";

    foreach ($potential_friends as $friend) {
        $friendFirstname = htmlspecialchars($friend['given_name']);
        $friendLastname = htmlspecialchars($friend['surname']);
        $userUniqUsername = htmlspecialchars($friend['uniq_username']);
        $friendProfilePic = htmlspecialchars($friend['profile_picture']);
        $friendUserCoverPhoto = htmlspecialchars($friend['user_cover_photo']);
        $hobbyName = htmlspecialchars($friend['hobby_name']);


        ?>
        <a href="profile.php?profile-page=<?php echo urlencode($userUniqUsername); ?>">
            <div class="friendCard">
                <div class="coverPhoto" style="background-image: url('includes/images/<?php echo $friendUserCoverPhoto; ?>');"></div>
                <div class="friendInfo">
                    <img class="friendProfilePic" src="includes/images/<?php echo $friendProfilePic; ?>" alt="Friend Profile Picture">
                    <h2><?php echo $friendFirstname . ' ' . $friendLastname; ?></h2>
                    <p>Hobby: <?php echo $hobbyName; ?></p>
                </div>
            </div>
        </a>
        <?php
    }
    // echo "</div></div>";
} else {
    // echo "<p>No friends found with similar hobbies.</p>"; 
}
?>
