<?php include "includes/login_header.php" ?>

<body>
<section id="login">
  <div class="main-content">
    <div class="right-container">
      <div class="container active" id="login-container">
        <form action="includes/login.php" method="post" id="login-form">
          <h2>Sign in to your account.</h2>
          <div class="loginField">
            <input type="text" name="email_add" placeholder="somebody@example.com" id="email_add" required>
            <input type="password" name="password" placeholder="Password" id="password" required>
          </div>
          <div class="signInForgot">
            <a href="#" id="switchToSignup" class="signup">Sign Up</a>
            <a href="#" class="forgetpass">Forget Password?</a>
          </div>
          <input type="submit" value="Sign in" class="btn1" name="login">
        </form>
        <div class="overlay">
          
          <div class="overlayContent">
            <h2>Welcome to Dyverzia</h2>
            <img src="Dyverzia.jpg">
            <p>Dyverzia is a social media platform dedicated to Neurodivergent people</p>
          </div>
        </div>
      </div>

      <div class="container inactive" id="signup-container">
        <form action="includes/createAccount.php" method="post" id="signup-form">
          <h2>Create your profile.</h2>
          <div class="signupField">
            <div class="fullNameField">
              <input type="text" name="given_name" placeholder="Name" required>
              <input type="text" name="surname" placeholder="Surname" required>
            </div>
            <input type="email" name="email" placeholder="somebody@example.com" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="date" name="dob"  required>
            <div class="countryAndStateField">
              <input type="text" name="country" placeholder="Country" required>
              <input type="text" name="state" placeholder="State" required>
              <input type="text" name="city" placeholder="City" required>
            </div>
          </div>
          <div class="signInForgot">
            <a href="#" id="switchToLogin" class="signin">Sign In</a>
          </div>
          <input type="submit" value="Create Account" class="btn1" name="create">
        </form>
        <div class="signup-overlay">
          <h2>Complete your registration to join us!</h2>
        </div>
      </div>
    </div>
  </div>
</section>


</body>
<script src="./includes/js/loginpage.js"></script>
</html>
