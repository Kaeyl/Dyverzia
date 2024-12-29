<div class="postArea">
    <div class="post">

<?php

$username = $_SESSION['given_name'];
$id = $_SESSION['user_id'];

// Fetch logged-in user profile
$query = "SELECT * FROM user_profile WHERE user_id = $id";
$select_user_query = mysqli_query($connection, $query);
$user_row = mysqli_fetch_assoc($select_user_query);

// Display posts for the logged-in user and their friends
if ($user_row) {
    $user_profile_name = $user_row['given_name'];
    $user_profile_id = $user_row['user_id'];

    // Combined query to fetch user's and friends' posts
    $query = "
    SELECT user_posts.*, user_profile.given_name, user_profile.surname 
    FROM user_posts 
    LEFT JOIN user_profile ON user_posts.user_id = user_profile.user_id 
    WHERE (user_posts.user_id = $id 
           OR user_posts.user_id IN (SELECT friend_id FROM user_friends WHERE user_id = $id))
      AND user_posts.status = 'approved'
    ORDER BY post_timestamp DESC";
    
    $select_posts_query = mysqli_query($connection, $query);

    while ($post_row = mysqli_fetch_assoc($select_posts_query)) {
        displayPost($post_row);
    }
}

function displayPost($post_row) {
    global $connection; // Access the database connection

    $user_post_id = $post_row['post_id'];
    $post_title = $post_row['post_title'];
    $user_post_content = $post_row['content'];
    $user_post_media_type = $post_row['media_type'];
    $user_post_url = $post_row['media_url'];
    $user_post_timestamp = $post_row['post_timestamp'];

    // Extract the user's name and surname
    $creator_name = $post_row['given_name'] . ' ' . $post_row['surname'];

    ?>
    <ul>
        <li class="activePost">
            <h3><?php echo $post_title; ?></h3>
            <p class="timeStamp"><span><?php echo 'Author: ' . $creator_name . ' | '; ?></span><?php echo $user_post_timestamp; ?> </p>

            <?php 
            // Reconstruct post content
            $arr = explode("\n", $user_post_content);
            foreach ($arr as $key => $value) {
                if (trim($value) !== '') {
                    $arr[$key] = '<p>' . $value . '</p>'; // Wrap in <p> tags
                } else {
                    $arr[$key] = ''; // Keep empty lines as empty
                }
            }
            $reconstructed_content = implode("\n", $arr);
            echo $reconstructed_content;
            ?>

            <?php if (!empty($user_post_url)) : ?>
                <img src="./includes/images/<?php echo $user_post_url; ?>" alt="Post image"><br>
            <?php endif; ?>

            <div class="userPostButtons">
                <a href="#">
                    <div class="like">
                        <img src="./includes/images/icons/like.png" alt="like button">
                        <p class="likeButton">like</p>
                    </div>
                </a>
                <a href="#">
                    <div class="comment">
                        <img src="./includes/images/icons/comment.png" alt="comment button">
                        <p>comment</p>
                    </div>
                </a>
                <a href="#">
                    <div class="share">
                        <img src="./includes/images/icons/share.png" alt="share button">
                        <p class="shareButton">share</p>
                    </div>
                </a>
            </div>
        </li>
    </ul>
    <?php
}

?>
    </div>
</div>
