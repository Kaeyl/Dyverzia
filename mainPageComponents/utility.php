

<div class="utilityPanel">
  <div class="utilityList">
    <ul>
      <h3>Connectivity</h3>
      <div class="utilityContainer">

      <li>
        <img class="utilityImage"src="includes/images/icons/group.png" alt="">
        <p>Friends</p>
      </li>

      <li>
        <img class="utilityImage"src="includes/images/icons/community.png" alt="">
        <p>Community</p>
      </li>





      </div>
    </ul>
</div>
<!-- <div class="leftPannel"> -->

  <h3>Community Hub</h3>
  <ul>
  
  <?php
$query = "SELECT * FROM user_communities WHERE user_id = {$user_id}";

$post_query = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($post_query)) {

    echo '<li class="userCommunityPage">';
    echo '<a id="communityElement" href="community.php?community-name=' . urlencode(htmlspecialchars($row['community_name'])) . '">';
    echo '<div class="communityEventTitle">' . htmlspecialchars($row['community_name']) . '</div>';
    echo '</a>';
    // echo '</div>';
    echo '<div class="communityIcon">';
    echo '</div>';
    echo '</li>';

}
?>


      </ul>
  </div>
 
