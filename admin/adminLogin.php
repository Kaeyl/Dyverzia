<?php include "adminLoginHeadTags.php";?>

<body>
    <div class="login-container">
        <h1>Admin Panel Login</h1>

        <form action="./functions/login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit">Login</button>
        </form>
        <p class="message">Forgot your password? <a href="/reset-password">Reset it</a></p>
    </div>
</body>
</html>
