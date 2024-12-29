
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start(); 
}

// Check if the user is logged in and if the session data is correct
if (!isset($_SESSION['given_name']) || !isset($_SESSION['user_id']) || !isset($_SESSION['email']) || 
  $_SESSION['user_id'] !== $_SESSION['user_id'] || $_SESSION['email'] !== $_SESSION['email']) {
  header('Location: ./login_page.php');
  exit();
}
// Get the first name from the URL, if available, otherwise fallback to session
$first_name = isset($_GET['first_name']) ? htmlspecialchars($_GET['first_name']) : $_SESSION['given_name'];
// $uniq_username = isset($_GET['uniq_username']) ? htmlspecialchars($_GET['uniq_username']) : $_SESSION['uniq_username'];


// Get the uniq_username from the session
$uniq_username = $_SESSION['uniq_username'];


// Continue with the rest of your profile page logic
// Include navigation
include "./includes/nav.php";

$username = $_SESSION['given_name'];
$id = $_SESSION['user_id'];
$user_role = $_SESSION['role'];



// Get the current script name
$current_page = basename($_SERVER['PHP_SELF']);

// Determine the CSS file based on the current page
if ($current_page === 'profile.php') {
    $css_file = 'includes/css/profile.css';
} elseif ($current_page === 'index.php') {
    $css_file = 'includes/css/style.css';
} elseif ($current_page === 'community.php') {
  $css_file = 'includes/css/community.css';
} elseif ($current_page === 'resources.php') {
  $css_file = 'includes/css/resources.css';
} elseif ($current_page === 'findCommunities.php' || 'findFriends.php') {
  $css_file = 'includes/css/findCommunities.css';
} 

// Get the first name from the URL, default to session if not present
// $first_name = isset($_GET['first_name']) ? htmlspecialchars($_GET['first_name']) : $_SESSION['first_name'];  
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $username; ?>'s Profile - Uniq</title>
    <link rel="stylesheet" href="<?php echo $css_file; ?>">
    <link rel="stylesheet" href="includes/css/nav.css">
</head> 






<!-- 
<!DOCTYPE html>
<html lang="en" dir="ltr">




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uniq</title>
    <link rel="stylesheet" href="<?php echo $css_file; ?>">
    <link rel="stylesheet" href="includes/css/nav.css">
</head> 
<body> -->
</body>
</html>


</html>

  </head>
