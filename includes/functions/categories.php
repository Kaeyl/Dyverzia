<?php
// $query = "SELECT * FROM user_posts WHERE user_id = {$user_id}";
$query = "SELECT * FROM categories";

$post_query = mysqli_query($connection, $query);

if ($post_query) {
    echo '<select name="categoryPostField" id="postTopic" required>';
    while ($row = mysqli_fetch_assoc($post_query)) {
        echo '<option class="option" value="' . htmlspecialchars($row['category_name']) . '">' . htmlspecialchars($row['category_name']) . '</option>';
    }
    echo '</select>';
} else {
    // Handle query error
    echo 'Error: ' . mysqli_error($connection);
}
?>


