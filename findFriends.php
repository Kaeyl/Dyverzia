<?php include "./includes/html_head_tags.php"; ?>
<?php include "./includes/functions/communityListDataQuery.php"; ?>

<?php
// Check if the user is logged in by verifying the session variable 'given_name'.
if (!isset($_SESSION['given_name'])) {
    header('Location: ./login_page.php');
    exit(); // Stop script execution after redirection.
}

// Assume $logged_in_id is the user ID of the logged-in user
$logged_in_id = $_SESSION['user_id']; 
?>

<div class="contentContainer">
    <h2>Find Friends</h2>
    <div class="friendListContainer">
    <?php 
        // Query for additional recommendations, grouping hobbies
        $query_recommendations = "
            SELECT 
                up.user_id, up.uniq_username, 
                up.given_name, up.surname, 
                up.profile_picture, up.user_cover_photo,
                GROUP_CONCAT(uh.hobby_name SEPARATOR ', ') AS hobbies
            FROM 
                user_hobbies AS uh
            JOIN 
                user_profile AS up ON uh.user_id = up.user_id
            WHERE 
                up.user_id != {$logged_in_id}  
            GROUP BY 
                up.user_id
            LIMIT 10"; 

        $result_recommendations = mysqli_query($connection, $query_recommendations);

        if ($result_recommendations) {
            while ($recommendation = mysqli_fetch_assoc($result_recommendations)) {
                $friendFirstname = htmlspecialchars($recommendation['given_name']);
                $friendLastname = htmlspecialchars($recommendation['surname']);
                $userUniqUsername = htmlspecialchars($recommendation['uniq_username']);
                $friendProfilePic = htmlspecialchars($recommendation['profile_picture']);
                $friendUserCoverPhoto = htmlspecialchars($recommendation['user_cover_photo']);
                $hobbies = htmlspecialchars($recommendation['hobbies']);
                ?>
                <a href="profile.php?profile-page=<?php echo urlencode($userUniqUsername); ?>">
                    <div class="friendCard">
                        <div class="coverPhoto" style="background-image: url('includes/images/<?php echo $friendUserCoverPhoto; ?>');"></div>
                        <div class="friendInfo">
                            <img class="friendProfilePic" src="includes/images/<?php echo $friendProfilePic; ?>" alt="Friend Profile Picture">
                            <h2><?php echo $friendFirstname . ' ' . $friendLastname; ?></h2>
                           
                                <ul class="listHobbyOutput">
                                <p>Similar hobbies:</p>
                                    <?php
                                    // Split the hobbies string into an array
                                    $hobbiesArray = explode(', ', $hobbies);
                                    for ($x = 0; $x < count($hobbiesArray); $x++) {
                                        echo '<li class="hobbyOutput">' . htmlspecialchars($hobbiesArray[$x]) . '</li>';
                                    }
                                    ?>
                                </ul>

                        </div>
                    </div>
                </a>
                <?php
            }
        } else {
            echo "<p>Failed to retrieve recommendations.</p>";
        }
    ?>
    </div>
</div>

<?php include "findFriendsFromCommunities.php"; ?>
