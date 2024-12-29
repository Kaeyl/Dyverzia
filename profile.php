<?php include "./includes/html_head_tags.php"; ?>


<?php
// Check if the user is logged in
if (!isset($_SESSION['given_name'])) {
    header('Location: ./login_page.php');
    exit();
}

// Get the uniq_username from the URL
$profile_name = isset($_GET['profile-page']) ? mysqli_real_escape_string($connection, $_GET['profile-page']) : $_SESSION['uniq_username'];

// Query to get the user data for the profile being viewed using uniq_username
// $query = "SELECT * FROM user_profile WHERE uniq_username = '{$profile_name}'";
// $result = mysqli_query($connection, $query);

// if (!$result) {
//     die("QUERY FAILED: " . mysqli_error($connection));
// }

// // Fetch user data
// if ($row = mysqli_fetch_assoc($result)) {
//     $user_id = $row['user_id'];
//     $full_name = $row['given_name'] . ' ' . $row['surname'];
//     $profile_picture = $row['profile_picture'];
//     $user_profile_email = $row['email_add'];
//     $user_profile_country = $row['country'];
//     $user_profile_state = $row['state'];
//     $user_profile_city = $row['city'];
//     $user_profile_cover_photo = $row['user_cover_photo'];
// } else {
//     die("User not found.");
// }





include "./includes/functions/profileUserDataQuery.php"; 
?>
<div class="profilePagePrimaryContainer">


<!-- <div class="leftColumn">
    <h2>hellow world</h2>
</div> -->





<div class="contentContainer">
    <div class="profileMainContainer">
        <div class="userHeadInformationContainer">
        <?php include "./includes/functions/coverHeadInfo.php"; ?>
    
        <?php include "./includes/functions/updateUserProfilePic.php"; ?>
        <!-- Include the PHP file that handles updating the user's profile picture -->
         <?php include "./includes/functions/updateCoverPhoto.php"; ?>
        <!-- Include the PHP file that handles updating the user's cover photo -->
        </div>
        <?php include "./includes/functions/profileContent.php"; ?>

            <!-- Friend List -->
            <div class="friendList">
                <h2 class="connectionsTitle">Connections</h2>
                <?php include "./includes/functions/viewUserFriends.php"; ?>
            </div>

            <!-- Create Post Section -->
            <div class="postContainer">
                <h2 class="userPostsTitle">Create post</h2>
                <div class="postArea">
                    <div class="createPostContainer">
                        <form method="POST" action="profile.php?profile-page=<?php echo urlencode($profile_name); ?>">
                            <input name="titlePostField" type="text" id="title" placeholder="Would you like to title your post?">
                            <label for="title" class="labelHide">Text input area for the title of your post</label><br>
                            <textarea id="txt" name="textareaPostField" placeholder="What's on your mind?"></textarea>
                            <label for="txt" class="labelHide">Text input area for your post</label>
                            <br>
                            <input type="file" id="user_upload_pic" name="user_pic" accept=".jpg, .jpeg, .png" size="60" />
                            <label for="user_upload_pic" class="labelHide">Select the image you want to upload</label><br>
                            <div class="submit">
                                <div class="submitButton">
                                    <input type="submit" value="Create post" class="postButton" name="submit">
                                    <label for="postButton" class="labelHide">Submit post</label>
                                </div>
                            </div>
                        </form>
                        <?php include "./includes/functions/createPost.php"; ?>
                    </div>
                </div>

                <!-- Display User Posts -->
                    <div class="post">
                    <ul>
                        <?php include "./includes/functions/showUserPosts.php"; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include "./includes/functions/userPersonalProgressTracking.php"; ?>

<!-- </div> -->
<?php 
include "./includes/functions/emojiFunction.php"; ?>

<!-- </div> -->
<!-- </div> -->




<script type="text/javascript" src="includes/js/showEmojis.js"></script>


<script type="text/javascript" src="includes/js/editProfilePopup.js"></script>
<script type="text/javascript" src="includes/js/editProfilePicture.js"></script>
<script type="text/javascript" src="includes/js/editCoverPhoto.js"></script>
