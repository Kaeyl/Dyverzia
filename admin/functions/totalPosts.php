<?php 

// Establish the connection
// $connection2 = mysqli_connect('hostname', 'username', 'password', 'database');
// if (!$connection2) {
//     die('Connection failed: ' . mysqli_connect_error());
// }

$count_query = "
    SELECT COUNT(*) AS post_count FROM (
        SELECT community_id FROM community_posts
        UNION ALL
        SELECT user_id FROM user_posts
    ) AS combined_posts
";

$post_count_query = mysqli_query($connection2, $count_query);

// Check if the query executed successfully
if ($post_count_row = mysqli_fetch_assoc($post_count_query)) {
    $post_count = $post_count_row['post_count'];
} else {
    $post_count = 0; // Handle the case when the query fails
}

// Output the count of posts in a paragraph
echo "<div class='card'>";
echo "<h5 class='card-title'>Total Posts</h5>";
echo "<p class='card-text'>$post_count</p>";
echo "</div>";

// Close the database connection after all queries are executed
mysqli_close($connection2);
?>
