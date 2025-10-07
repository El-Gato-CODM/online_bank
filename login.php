<?php
require './config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="login_style.css">
</head>
<body>
    <nav>
        <div>LOGO</div>
        <div>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            </ul>
        </div>
    </nav>

    <div class="login">
        <h1>Log in</h1>

<?php if(isset($_SESSION['signup_success'])): ?>
        <div class="signup_success_message">
          <p class="signup_success">
            <?= $_SESSION['signup_success'];
            unset($_SESSION['signup_success']); ?>
          </p>
        </div>
<?php endif; ?>

<?php if(isset($_SESSION['login'])): ?>
        <div class="error_message">
          <p class="error_message">
            <?= $_SESSION['login'];
            unset($_SESSION['login']); ?>
          </p>
        </div>
<?php endif; ?>

        <form action="<?= ROOT_URL?>login_logic.php" method="POST">
            <p><input type="text" placeholder="Username or Email" class="input" name="email_username"></p>
            <p><input type="password" placeholder="Password" class="input" name="password"></p>

            <div>
                <input type="checkbox">Remember Me
                <a href="#" class="forgot_password">Forgot Password?</a>
            </div>

        

            <div>
               <input type="submit" class="login_button" name="submit" value="Login">
               <p class="or_text">Don't have an Account?</p>
               <a href="signup.php" class="signup_button">Sign up</a>
            </div>
        </form>
    </div>

    <div class="bottomtext">
        <h1>Welcome Back!</h1>
    </div>
</body>
</html>