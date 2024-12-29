<?php include "adminDB.php"; ?>

<?php
function load_hateful_words($filename) {
    if (!file_exists($filename)) {
        return []; // Return an empty array if the file doesn't exist
    }
    return array_map('trim', file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
}

// Load hateful words from the text file
$hateful_words = load_hateful_words('../banned-content/hateful_words.txt');
// Debug: Check loaded hateful words
echo "<script>console.log('Loaded hateful words:', " . json_encode($hateful_words) . ");</script>";

// Create a regex pattern from the hateful words
$pattern = '/\b(?:' . implode('|', array_map('preg_quote', $hateful_words)) . ')\b/i';
?>

<table id="postsTable">
    <tr>
        <th>User ID</th>
        <th>User Image</th>
        <th>Post ID</th>
        <th>Post Title</th>
        <th>Content</th>
        <th>Media URL</th>
        <th>Post Timestamp</th>
        <th>Post Type</th>
        <th>Name</th>
        <th>Post Status</th>
        <th>View User</th>
        <th>Quarantine</th>
    </tr>

<?php 

if (!$connection2) {
    die('Connection failed: ' . mysqli_connect_error());
}

$post_query = "
    SELECT 
        up.user_id, 
        up.uniq_username, 
        up.profile_picture, 
        usp.post_id, 
        usp.post_title, 
        usp.content, 
        usp.media_url, 
        usp.post_timestamp, 
        usp.status,
        'User Post' AS post_type,
        NULL AS community_name
    FROM user_profile up
    JOIN user_posts usp ON up.user_id = usp.user_id
    
    UNION ALL
    
    SELECT 
        cp.community_id AS user_id, 
        c.community_name, 
        c.profile_picture, 
        cp.post_id, 
        cp.post_title AS post_title, 
        cp.content, 
        cp.media_url, 
        cp.post_timestamp, 
        cp.status,
        'Community Post' AS post_type,
        c.community_name
    FROM community_posts cp
    JOIN communities c ON cp.community_id = c.community_id
";

$result = mysqli_query($connection2, $post_query);

while ($post_row = mysqli_fetch_assoc($result)) {
    $profile_id = $post_row['user_id'];
    $profile_picture = $post_row['profile_picture']; 
    $post_id = $post_row['post_id']; 
    $post_title = $post_row['post_title'];
    $content = $post_row['content'];
    $media_url = $post_row['media_url'];
    $post_timestamp = $post_row['post_timestamp'];
    $user_post_status = $post_row['status'];
    $post_type = $post_row['post_type'];
    $community_name = $post_row['community_name'];

    // Check if the post title or content contains hateful words
    $matches_title = [];
    $matches_content = [];
    $title_found = preg_match($pattern, $post_title, $matches_title);
    $content_found = preg_match($pattern, $content, $matches_content);

    // Combine matches from title and content
    $found_hateful_words = array_unique(array_merge($matches_title, $matches_content));

    // Determine if the row should be highlighted
    $highlight_row = ($title_found || $content_found) ? 'highlight' : '';

    // Determine the name to display based on post type
    $name_to_display = ($post_type === 'Community Post') ? htmlspecialchars($community_name) : htmlspecialchars($post_row['uniq_username']);

    // Create a row in the table for the user's profile and their post
    echo '<tr class="' . $highlight_row . '">';
    echo '<td>' . htmlspecialchars($profile_id) . '</td>'; 
    echo '<td class="tableRowProfilePicture"><img src="../includes/images/' . htmlspecialchars($profile_picture) . '" alt=""></td>';
    echo '<td>' . htmlspecialchars($post_id) . '</td>'; 
    echo '<td>' . htmlspecialchars($post_title) . '</td>'; 
    echo '<td class="post-content">' . htmlspecialchars($content) . '</td>'; 
    echo '<td>' . htmlspecialchars($media_url) . '</td>'; 
    echo '<td>' . htmlspecialchars($post_timestamp) . '</td>'; 
    echo '<td>' . htmlspecialchars($post_type) . '</td>'; 
    echo '<td>' . $name_to_display . '</td>'; // Updated line to display name

    // Modified line to display approval status and post type
    echo '<td>' . 
    ($user_post_status === 'approved' ? 'Approved' : 
    ($user_post_status === 'frozen' ? 'Frozen' : 
    ($user_post_status === 'draft' ? 'Draft' : 
    ($user_post_status === 'marked_for_deletion' ? 'Marked for Deletion' : 'Not Approved')))) 
     . '</td>';

    echo '<td>
        <a href="#" class="viewPost" onclick="showCoverPhotoModal(event);" data-title="' . htmlspecialchars($post_title) . '" data-content="' . htmlspecialchars($content) . '" data-badWords="' . htmlspecialchars(json_encode($found_hateful_words)) . '">View</a>
    </td>';
    echo '<td>
        <form action="./functions/updatePostStatus.php" method="POST" onsubmit="return confirm(\'Are you sure you want to change the status of this post?\');">
            <input type="hidden" name="post_id" value="' . htmlspecialchars($post_id) . '">
            <input type="hidden" name="sub_type" value="' . htmlspecialchars($post_type) . '">
            <select id="statusOptions" name="new_status">
                <option value="">Select Action</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="frozen">Freeze</option>
                <option value="approve">Approve</option>
            </select>
            <button id="statusOptionsSubmit" type="submit">Submit</button>
        </form>
    </td>'; 
    echo '</tr>'; 
}

// Close the database connection
mysqli_close($connection2);
?>

</table>

<!-- Your modal HTML here -->
<div id="editCoverPhotoModal" class="modal">
    <div class="modal-content">
        <button class="close-button" onclick="hideCoverPhotoModal()">&times;</button>
        <div class="contentContainerModal">
            <h2>Post Content</h2>
            <p id="modalContent"></p> <!-- Content here -->
            <hr>
            <p id="badWords"></p> 
            <div class="updateCoverPhotoFormContainer"></div>
        </div>
    </div>
</div>
