<?php include "./includes/html_head_tags.php"; ?>
<?php include "./includes/functions/communityProfileDataQuery.php"; ?>


<?php
// Check if the user is logged in by verifying the session variable 'given_name'.
// If not logged in, redirect the user to the login page.
if (!isset($_SESSION['given_name'])) {
    header('Location: ./login_page.php');
    exit(); // Stop script execution after redirection.
}
?>
<?php include "./includes/functions/communityPost.php"; ?>


<div class="contentContainer">
    <div class="communityMainContainer">
        <a class="coverPhotoViewSelect" href="#" onclick="showCoverPhotoModal(); return false;">
            <div class="coverPhotoViewSelect" style="background-image: url('includes/images/<?php echo htmlspecialchars($cover_picture); ?>');">

            </div>
        </a>
        <?php include "./includes/functions/updateCommunityCoverPhoto.php"; ?>
        <div class="coverTitle"><h1><?php echo htmlspecialchars($community_name); ?></h1></div>

        <div class="communityHead">
            <img class="communityProfilePic" src="includes/images/<?php echo htmlspecialchars($profile_picture); ?>" alt="Community Profile Picture">
            <div class="memberList">
                <h2><?php echo $permission_type; ?></h2>
                <h2>Members</h2>
                <ul>
                    <?php include "./includes/functions/viewCommunityMembers.php"; ?>
                </ul>
            </div>
        </div>
    </div>
</div>


<hr>
    <div class="profileContentPanel">
        <div class="communityPanel">
            <h2 class="communityPanelTitle">Trending topics</h2>
            <h2 class="communityPanelTitle">Weekly Poll</h2>
            <h2 class="communityPanelTitle">Support Hotlines</h2>
        </div>
        
        <div class="postContainer">
            <button class="createPostButton" id="createPostBtn">Create Post</button>
            
            <div class="overlay" id="overlay">
                <div class="popup" id="postPopup">
                    <button type="button" class="close-button" id="closePopup">&times;</button>
                    <h3>New Post</h3>
                    <div class="createPostContainer">
                    <form method="POST" action="community.php?community-name=<?php echo urlencode($community_name); ?>" enctype="multipart/form-data">
                        <label class="inputLabel" for="title">Post Title:</label>
                        <input name="titlePostField" type="text" id="title" placeholder="Title your post..." required>
                        
                        <label class="inputLabel" for="category">Category:</label>
                        <?php include "./includes/functions/categories.php"; ?>
                        
                        <label class="inputLabel" for="txt">Post Content:</label>
                        <textarea class="postContentField" id="txt" name="textareaPostField" placeholder="What's on your mind?" required></textarea>
                        
                        <label class="inputLabel" for="user_upload_pic">Upload Image:</label>
                        <input type="file" id="user_upload_pic" name="user_pic" accept=".jpg, .jpeg, .png" />
                        
                        <input type="submit" value="Create Post" class="postButton" name="submit">
                    </form>
                    </div>
                </div>
            </div>

            <h2>Community Posts</h2>
            <div class="posts">
                <ul>
                    <?php include "./includes/functions/showCommunityPosts.php"; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="includes/js/communityCreatePostPopUp.js"></script>
<script type="text/javascript" src="includes/js/editCoverPhoto.js"></script>
<!-- <script type="text/javascript" src="includes/js/editProfilePicture.js"></script>
<script type="text/javascript" src="includes/js/editCoverPhoto.js"></script> -->
