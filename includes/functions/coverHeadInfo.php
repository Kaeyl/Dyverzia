
<div class="userImageAndCover">
<!-- <div class="coverPhoto <?php echo empty($user_profile_cover_photo) ? 'gradient-background' : ''; ?>">
            <a class="coverPhotoViewSelect" href="#" onclick="showCoverPhotoModal(); return false;">
                <img class="coverPhoto" src="<?php echo empty($user_profile_cover_photo) ? 'path/to/transparent.png' : './includes/images/' . htmlspecialchars($user_profile_cover_photo); ?>" alt="user cover photo" style="display: <?php echo empty($user_profile_cover_photo) ? 'none' : 'block'; ?>;">
            </a>
        </div> -->

        <div class="profileHead">
            <div class="profilePicContainer" style="background-color: <?php echo empty($profile_picture) ? 'white' : 'transparent'; ?>;">
                <!-- Set background color to white if profile_picture is empty, otherwise make it transparent -->
                <a class="profileImageViewSelect" href="#" onclick="showProfileImageModal(); return false;">
                    <img class="profilePic" src="<?php echo empty($profile_picture) ? 'data:image/gif;base64,R0lGODlhAQABAAAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==' : './includes/images/' . htmlspecialchars($profile_picture); ?>" alt="user profile image">
                </a>
            </div>
            </div>
            </div>
            <div class="profileInfo">
    <div class="userNameAndPronouns">
        <h1 class="profileName"><?php echo htmlspecialchars($full_name); ?></h1>
        <span>(<?php echo htmlspecialchars($pronouns); ?>)</span>
    </div>
    <br>
    <p><?php echo htmlspecialchars($nuerodivergence); ?></p>
    <h2 class="profileSubHeading"><?php echo htmlspecialchars($user_profile_city . ', ' . $user_profile_state); ?></h2>

    <!-- Choose Mood Button -->
   
    <?php if ($user_id == $_SESSION['user_id']) : ?>
        <button class="editProfileButton" onclick="showModal()">Edit profile</button>
    <?php else : ?>
        <form method="POST" action="./includes/functions/addFriend.php">
            <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
            <input type="hidden" name="friend_id" value="<?php echo htmlspecialchars($user_id); ?>"> 
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>"> 
            <input type="hidden" name="user_friend_name" value="<?php echo htmlspecialchars($full_name); ?>"> 

            <?php 
            $checkQuery = $connection->prepare("SELECT * FROM user_friends WHERE user_id = ? AND friend_id = ?");
            $checkQuery->bind_param("ii", $_SESSION['user_id'], $user_id);
            $checkQuery->execute();
            $result = $checkQuery->get_result();

            if ($result->num_rows == 0) {
                ?>
                <button type="submit" name="followButton" class="followButton">Add Friend</button>
                <?php 
            } else {
                echo '<button type="submit" name="unfollowButton" class="unfollowButton" disabled>Friends</button>';
            }

            $checkQuery->close();
            ?>
        </form>
    <?php endif; ?>


<!-- Choose Mood Button -->
<button id="chooseMoodButton" class="chooseMoodButton">Choose Mood</button>




<!-- Emoji Selector -->

<!-- </div> -->

<!-- </div> -->
</div>






