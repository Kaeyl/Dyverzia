<?php include "adminDB.php"; ?>

<!-- <main class="main-content"> -->
<div class="cards">
<?php 

// Ensure this connection is established correctly

// Query to count the number of users in the user_profile table
$count_query = "SELECT COUNT(*) AS profile_count FROM user_profile";
$user_count_query = mysqli_query($connection2, $count_query);

if (!$user_count_query) {
    die('Query failed: ' . mysqli_error($connection2));
}

// Fetch the result of the count query
if ($user_count_row = mysqli_fetch_assoc($user_count_query)) {
    $user_count = $user_count_row['profile_count'];
} else {
    $user_count = 0;
}

// Output the count of users
echo "<div class='card'>";
echo "<h5 class='card-title'>Total Users</h5>";
echo "<p class='card-text'>$user_count</p>";
echo "</div>";

// Query to count the number of posts in combined posts
$count_query = "
    SELECT COUNT(*) AS post_count FROM (
        SELECT community_id FROM community_posts
        UNION ALL
        SELECT user_id FROM user_posts
    ) AS combined_posts
";

$post_count_query = mysqli_query($connection2, $count_query);

if (!$post_count_query) {
    die('Query failed: ' . mysqli_error($connection2));
}

// Check if the query executed successfully
if ($post_count_row = mysqli_fetch_assoc($post_count_query)) {
    $post_count = $post_count_row['post_count'];
} else {
    $post_count = 0;
}

// Output the count of posts
echo "<div class='card'>";
echo "<h5 class='card-title'>Total Posts</h5>";
echo "<p class='card-text'>$post_count</p>";
echo "</div>";

// Close the database connection after all queries are executed
// mysqli_close($connection2);

echo "<div class='card'>";
echo "<h5 class='card-title'>Daily Active Users</h5>";
echo "<p class='card-text'>432</p>";
echo "</div>";
?>
        </div>

<div class="analytics-section">
    <h2>Analytics Overview</h2>



</div>

<div class="requests-section">
    <h2>New Requests</h2>
    <!-- Insert requests list here -->
</div>
</main>