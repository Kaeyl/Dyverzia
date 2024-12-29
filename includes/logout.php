
<?php
  $_SESSION['user_id'] = null;
  $_SESSION['given_name'] = null;
  $_SESSION['email'] = null;
  $_SESSION['lastname'] = null;
  $_SESSION['country'] = null;
  $_SESSION['state'] = null;
  $_SESSION['surname'] = null;
  $_SESSION['user_friends'] = null;
  $_SESSION['profile_picture'] = null;
  $_SESSION['user_cover_photo'] = null;
  $_SESSION['role'] = null;






session_destroy();

header('Location: ../login_page.php');
?>
