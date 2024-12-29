<?php include "./includes/html_head_tags.php"; ?>
<?php include "./includes/functions/communityListDataQuery.php"; ?>


<?php
// Check if the user is logged in by verifying the session variable 'given_name'.
// If not logged in, redirect the user to the login page.
if (!isset($_SESSION['given_name'])) {
    header('Location: ./login_page.php');
    exit(); // Stop script execution after redirection.
}
?>

<div class="contentContainer">
    <h1>Find Communities</h1>

    <div class="communityListContainer">
        <?php
        if (!empty($communities)) {
            foreach ($communities as $community) {
                $communityName = htmlspecialchars($community['community_name']);
                $coverPicture = htmlspecialchars($community['cover_picture']);
                $profilePicture = htmlspecialchars($community['profile_picture']);
                $communityId = htmlspecialchars($community['community_id']);
                $community_name = htmlspecialchars($community['community_name']);
                $community_description = htmlspecialchars($community['community_description']);
                ?>
                <a href="community.php?community-name=<?php echo $community_name; ?>" class="joinCommunityButton">
                <div class="communityCard">
                    <div class="coverPhoto" style="background-image: url('includes/images/<?php echo $coverPicture; ?>');"></div>
                    <div class="communityInfo">
                        <img class="communityProfilePic" src="includes/images/<?php echo $profilePicture; ?>" alt="Community Profile Picture">
                        <h2><?php echo $community_name; ?></h2>
                        <p><?php echo $community_description; ?></p>

                    </div>
                </div>
                </a>
                <?php
            }
        } else {
            echo "<p>$noCommunitiesMessage</p>"; // Display the message if no communities are found
        }
        ?>
    </div>

<div class="communityCreationContainer">
    <h2>Can't find the community you're looking for?</h2>
    <p>Communities are a space for users and groups to communicate and discuss their interests.</p>
    <p>While we ecourage freedom of speach, we also respect people's freedom of liberty. As such, at this stage a community creation will be sent for evaluation
        to ensure it meets our community guidelines.
    </p>
<div class="createCommunity">

    <?php include "./includes/functions/createCommunity.php";?> 


    <div class="communityCOntainer">
    <button class="createCommunityButton" id="createCommunityBtn">Create Community</button>
    
    <div class="overlay" id="overlay">
        <div class="popup" id="createCommunityPopup">
            <button type="button" class="close-button" id="closePopup">&times;</button>
            <h3>New Community</h3>
            <div class="createCommunityContainer">
            <form action="create_community.php" method="post" enctype="multipart/form-data">
                <div class="communityInfo">
            <label for="community_name">Community Name:</label>
            <input type="text" id="community_name" name="community_name" required><br><br>
            </div>
            <div class="communityRequest">
            <label for="community_creator_name">Community Creator:</label>
            <input type="text" id="community_name" name="community_name" required><br><br>
            <label for="community_request">Community Request:</label>
            <input type="text" id="community_name" name="community_name" required><br><br>
            </div>

            </form>

        </div>
        <button type="button" class="submitRequest" id="submitRequest">Submit request;</button>
        </div>

        </div>
        
        </div>
        


</div>
</div>

</div>

<script type="text/javascript" src="includes/js/createCommunityPopUp.js"></script>
