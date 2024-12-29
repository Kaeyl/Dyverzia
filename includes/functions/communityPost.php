<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include necessary files
// include "./includes/html_head_tags.php"; 
// include "./includes/functions/communityProfileDataQuery.php"; 

// Check if the user is logged in
if (!isset($_SESSION['given_name'])) {
    header('Location: ./login_page.php');
    exit(); // Stop script execution after redirection.
}

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Ensure $community_id is set and available
    $user_id = $_SESSION['user_id'];

    // Initialize variables
    $postContent = $_POST['textareaPostField'];
    $userPostTitle = $_POST['titlePostField'];
    $community_post_category = $_POST['categoryPostField'];
    $media_url = '';

    if (isset($_FILES['user_pic'])) {
        if ($_FILES['user_pic']['error'] !== UPLOAD_ERR_NO_FILE) {
            if ($_FILES['user_pic']['error'] == UPLOAD_ERR_OK) {
                $upload_dir = 'C:\xampp\htdocs\websiteDevelopment\projects\Uniq\includes\images\uploads';
                $upload_file = $upload_dir . DIRECTORY_SEPARATOR . basename($_FILES['user_pic']['name']);

                // Move the uploaded file to the desired directory
                if (move_uploaded_file($_FILES['user_pic']['tmp_name'], $upload_file)) {
                    // Use only the file name for the database
                    $media_url = basename($_FILES['user_pic']['name']);
                    
                    // Escape the file name for SQL
                    $media_url = mysqli_real_escape_string($connection, $media_url);
                } else {
                    die("File upload failed: Unable to move the file.");
                }
            } else {
                // Handle file upload errors
                switch ($_FILES['user_pic']['error']) {
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        die("File is too large.");
                    case UPLOAD_ERR_PARTIAL:
                        die("File was only partially uploaded.");
                    case UPLOAD_ERR_NO_FILE:
                        die("No file was uploaded.");
                    default:
                        die("Unknown upload error: " . $_FILES['user_pic']['error']);
                }
            }
        }
    }

    // Check if the post content is not empty
    if (!empty($postContent)) {
        // Escape the post content
        $postContent = mysqli_real_escape_string($connection, htmlspecialchars($postContent, ENT_QUOTES, 'UTF-8'));
        $post_date = date('Y-m-d H:i:s'); // Use a more standard date format

        // Construct the SQL query
        $query = "INSERT INTO community_posts (community_id, user_id, post_title, community_post_category, content, media_url, post_timestamp) VALUES ('{$community_id}', '{$user_id}', '{$userPostTitle}', '{$community_post_category}', '{$postContent}', '{$media_url}', '{$post_date}')";

        // Check the database connection
        if (!$connection) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        // Execute the query
        $register_user_query = mysqli_query($connection, $query);

        if (!$register_user_query) {
            die("QUERY FAILED: " . mysqli_error($connection));
        } else {
            // Redirect to the same page after successful post creation
            header("Location: community.php?community-name=" . urlencode($community_name));
            exit(); // Ensure no further code is executed
        }
    } else {
        die("Fields cannot be empty");
    }
}
?>
