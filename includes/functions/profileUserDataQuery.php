<?php 

// This code retrieves user profile information and associated hobbies from a database. 
// It selects fields like user ID, username, email, location details, and hobby information 
// using SQL JOINs. The data is then fetched, stored in variables, and organized into an 
// array of hobbies. If the user is not found, an error is displayed.


// Query to get the user data for the profile being viewed using uniq_username
$query = "
    SELECT 
        up.user_id,
        up.uniq_username,
        up.email_add,
        up.country,
        up.state,
        up.city,
        up.dob,
        up.nuerodivergent_flavour,
        up.pronouns,
        up.given_name,
        up.surname,
        up.profile_picture,
        up.user_cover_photo,
        hc.hobby_id,
        hc.name AS hobby_name,
        hc.description
    FROM 
        user_profile AS up
    LEFT JOIN 
        user_hobbies AS uh ON up.user_id = uh.user_id
    LEFT JOIN 
        hobby_categories AS hc ON uh.hobby_name = hc.name
    WHERE 
        up.uniq_username = '{$profile_name}'
";

// Execute the query
$result = mysqli_query($connection, $query);

if (!$result) {
    die("QUERY FAILED: " . mysqli_error($connection));
}

// Fetch user data and hobbies
$user_hobbies = [];
if ($row = mysqli_fetch_assoc($result)) {
    // Store user profile information
    $user_id = $row['user_id'];
    $full_name = $row['given_name'] . ' ' . $row['surname'];
    $nuerodivergence = $row['nuerodivergent_flavour'];
    $pronouns = $row['pronouns'];
    $profile_picture = $row['profile_picture'];
    $user_profile_email = $row['email_add'];
    $user_profile_country = $row['country'];
    $user_profile_state = $row['state'];
    $user_profile_city = $row['city'];
    $user_profile_cover_photo = $row['user_cover_photo'];

    // Check if hobbies exist and collect them
    do {
        if (!empty($row['hobby_name'])) {
            $user_hobbies[] = [
                'hobby_id' => $row['hobby_id'],
                'hobby_name' => $row['hobby_name'],
                'description' => $row['description']
            ];
        }
    } while ($row = mysqli_fetch_assoc($result));
} else {
    die("User not found.");
}


// Output user hobbies
if (!empty($user_hobbies)) {
    // echo "<h3>User Hobbies:</h3><ul>";
    foreach ($user_hobbies as $hobby) {
        // echo "<li>" . htmlspecialchars($hobby['hobby_name']) . " - " . htmlspecialchars($hobby['description']) . "</li>";
    }
    // echo "</ul>";
} else {
    // echo "<p>No hobbies found for this user.</p>";
}


?>