<?php
require './config/database.php';

// getting form data
$fullname = $_SESSION['signup_data']['fullname'] ?? null;
$dob = $_SESSION['signup_data']['dob'] ?? null;
$phone = $_SESSION['signup_data']['phone'] ?? null;
$email = $_SESSION['signup_data']['email'] ?? null;
$address = $_SESSION['signup_data']['address'] ?? null;
$occupation = $_SESSION['signup_data']['occupation'] ?? null;
$username = $_SESSION['signup_data']['username'] ?? null;
$country = $_SESSION['signup_data']['country'] ?? null;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="signup_style.css">
</head>
<body>
    <nav>
        <div>LOGO</div>
        <div>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
    </nav>

    <div class="signup">
        <h1>Sign up</h1>

<?php if(isset($_SESSION['signup'])): ?>
        <div class="error_message">
          <p>
            <?= $_SESSION['signup'];
            unset($_SESSION['signup']); ?>
          </p>
        </div>
<?php endif; ?>

        <form action="<?= ROOT_URL ?>signup_logic.php" method="POST">
           <div class="name_date">
                <div>
                  <p>Full Name</p>
                  <input type="text" class="name_and_date" name="fullname" value="<?= $fullname ?>" required>
                </div>
                <div>
                  <p>Date of Birth</p>
                  <input type="date" class="name_and_date" name="dob" value="<?= $dob ?>" required >
                </div>
            </div>

            <div class="phone_email">
                <div>
                  <p>Phone Number</p>
                  <input type="mobile" class="phone_and_email" name="phone" value="<?= $phone ?>" required>
                </div>
                <div>
                  <p>Email</p>
                  <input type="email" class="phone_and_email" name="email" value="<?= $email ?>" required>
                </div>
            </div>


            <div class="address">
                <p>Residential Address</p>
                <input type="text" class="address_input" name="address" value="<?= $address ?>" required>
            </div>


            <div class="occupation">
                <div>
                  <p>Occupation</p>
                  <input type="text" class="occupation_and_employer" name="occupation" value="<?= $occupation ?>" required >
                </div>
                <div>
                  <p>Employer Name</p>
                  <input type="mobile" class="occupation_and_employer">
                </div>
            </div>


            <div class="username">
                <div>
                  <p>User Name</p>
                  <input type="text" class="username_and_country" name="username" value="<?= $username ?>" required>
                </div>
                <div>
                  <p>Country</p>
                  <input type="text" class="username_and_country" name="country" value="<?= $country ?>" required >
                </div>
            </div>


            <div class="password" required>
                <div>
                  <p>Password</p>
                  <input type="password" class="password_and_confirm" name="password">
                </div>
                <div>
                  <p>Confirm Password</p>
                  <input type="password" class="password_and_confirm" name="confirm_password" required>
                </div>
            </div>

            <div>
                <p class="text">I confirm that all the information provided are accurate</p>
                <input type="submit" class="signup_button" name="submit">
            </div>

        </form>



    </div>

    <div class="bottom_text">
        <h1>Get Started</h1>
    </div>
</body>
</html>