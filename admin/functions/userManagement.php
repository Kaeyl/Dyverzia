<?php include "adminDB.php"; ?>
<table>
  <tr>
    <th>User id</th>
    <th>User image</th>
    <th>Uniq name</th>
    <th>Email address</th>
    <th>Country</th>  
    <th>State</th>  
    <th>City</th>  
    <th>View user</th>  
    <th>Flag user</th>  
  </tr>
<?php 


// Query to get the IDs of friends in the community
$get_user_query = "SELECT * FROM user_profile";
$users_query = mysqli_query($connection2, $get_user_query);
// Execute the query to get member IDs

// Loop through each member ID returned by the query
while ($users_row = mysqli_fetch_assoc($users_query)) {
    
    $user_id = $users_row['user_id'];
    
    $user_profile_query = "SELECT * FROM user_profile WHERE user_id = {$user_id}";

    $user_profile_result = mysqli_query($connection2, $user_profile_query);
    // Fetch the friend's profile data
    if ($user_data = mysqli_fetch_assoc($user_profile_result)) {
        // Extract the unique username from the user profile data
        $profile_id = $user_data['user_id']; 
        $profile_uniq_name = $user_data['uniq_username']; 
        $profile_picture = $user_data['profile_picture']; 
        $profile_email = $user_data['email_add']; 
        $profile_country = $user_data['country']; 
        $profile_state = $user_data['state']; 
        $profile_city = $user_data['city']; 
        
        // Create a list item with a link to the friend's profile page
        echo '<tr>'; // Use url encoding for safety
        echo '<td>' . $profile_id . '</td>'; // Use url encoding for safety
        echo '<td class="tableRowProfilePicture"><img src="../includes/images/' . $profile_picture . '" alt=""></td>';
        echo '<td>' . $profile_uniq_name . '</td>'; // Div for friend's profile image
        echo '<td>' .  $profile_email .'</td>'; 
        echo '<td>' .  $profile_country .'</td>'; 
        echo '<td>' .  $profile_state .'</td>'; 
        echo '<td>' .  $profile_city .'</td>'; 
        echo '</td>'; 

    }
}

?>



  <!-- <tr>
    <td>Alfreds Futterkiste</td>
    <td>Maria Anders</td>
    <td>Germany</td>
  </tr> -->

</table>