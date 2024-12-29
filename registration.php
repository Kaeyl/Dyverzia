<?php  include "includes/db.php"; ?>
 <?php  include "includes/login_header.php"; ?>

<?php
if(isset($_POST['create'])) {
// echo 'it is working';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if(!empty($username) && !empty($email) && !empty($password)) {
  $username = mysqli_real_escape_string($connection, $username);
  $email = mysqli_real_escape_string($connection, $email);
  $password = mysqli_real_escape_string($connection, $password);

  $query = "SELECT randSalt FROM users";
  $select_randsalt_query = mysqli_query($connection, $query);
  if(!$select_randsalt_query){
    die("Query Failed" . mysqli_error($connection));
  }

  $row = mysqli_fetch_array($select_randsalt_query);
  $salt = $row['randSalt'];
  $password = crypt($password, $salt);

  $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
  $query .= "VALUES('{$username}','{$email}','{$password}', 'subscriber') ";
  $register_user_query = mysqli_query($connection, $query);
  if(!$register_user_query){
    die("QUERY FAILED" . mysqli_error($connection) . ' ' . mysqli_error($connection));
  }

$message = "Your registration has been submitted";

} else {
  $message = "Fields can not be empty";
}


} else {
  $message = "";
}

?>


    <!-- Navigation -->

    <?php  include "includes/login_nav.php"; ?>


    <!-- Page Content -->


      <section id="login">
      <div class="main-content">
        <div class="containerSignUp">

          <form name="sign up form" class="box" action="#" method="post" id="login-form">
            <h1 style="margin-left: -5px;">Uniq <span>| Sign-up</span></h1>
            <h2 style="margin-bottom: 30px;">Create your account.</h2>
            <h2 style="margin-bottom: 0px;"><?php echo $message; ?></h2>
              <div class="form-group">
                  <input type="text" name="username" id="username" class="form-control" placeholder="Username">
              </div>

              <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
            </div>

              <div class="form-group">
                <input type="password" name="password" id="key" class="form-control" placeholder="Password" >
              </div>
              <div class="signInForgot">
              <a href="login_page.php" class="signin">Sign In</a>
              <!-- </label> -->
              </div>
              <div class="submit">
                <input type="submit" value="Create Account" class="btn1" name="create" >
              </div>

          </form>
</div>
</div>
</section>


