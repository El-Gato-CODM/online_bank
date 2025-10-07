<?php
require './config/database.php';

if(isset($_POST['submit'])){
    $fullname = htmlspecialchars($_POST['fullname']);
    $dob = htmlspecialchars($_POST['dob']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $occupation = htmlspecialchars($_POST['occupation']);
    $username = htmlspecialchars($_POST['username']);
    $country = htmlspecialchars($_POST['country']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);

    if(!$fullname){
        $_SESSION['signup'] = "Please Enter your full names";
    }elseif(!$dob){
        $_SESSION['signup'] = "Please Enter your date of birth";
    }elseif(!$phone){
        $_SESSION['signup'] = "Please Enter your phone number";
    }elseif(!$email){
        $_SESSION['signup'] = "Please Enter your email";
    }elseif(!$address){
        $_SESSION['signup'] = "Please Enter your address";
    }elseif(!$occupation){
        $_SESSION['signup'] = "Please Enter your occupation";
    }elseif(!$username){
        $_SESSION['signup'] = "Please Enter your username";
    }elseif(!$country){
        $_SESSION['signup'] = "Please choose your country";
    }else{
        if(strlen($password) < 8 || strlen($confirm_password) < 8){
            $_SESSION['signup'] = "Please Password should be 8 characters or more";
        }elseif($password !== $confirm_password){
            $_SESSION['signup'] = "Passwords do not match";
        }else{
            // hash our password
           $hash_password = password_hash($password, PASSWORD_DEFAULT);


           //Creating account number
           // Extract 4 alphabets from the user's name

           $name = preg_replace('/[^a-zA-Z]/', '', $fullname);

           //taking 4 alpabets and changing to uppercase
           $name = strtoupper(substr($name, 0, 4));

           $random_digit = str_pad(rand(10000, 99999), 8, '0', STR_PAD_LEFT);

           $acc_no = $name . $random_digit;






            //Checking for already existing email
            $email_check_sql = "SELECT * FROM users WHERE email = '$email'";
            $email_check_query = mysqli_query($conn, $email_check_sql);

            if(mysqli_num_rows($email_check_query) > 0){
                $_SESSION['signup'] = "Email already exists, Try logging in";
            }else{
                
                //Checking for already existing username
            $username_check_sql = "SELECT * FROM users WHERE username = '$username'";
            $username_check_query = mysqli_query($conn, $username_check_sql);

            if(mysqli_num_rows($username_check_query) > 0){

                $_SESSION['signup'] = "Username already exists";
            }
        }
        }
        
        
    }


    // Checking if there is any session error
    if(isset($_SESSION['signup'])){
        // send back form data if any error
        $_SESSION['signup_data'] = $_POST;
        header('location:' . ROOT_URL .'signup.php');

    }else{

           

        // Insert new user record into database
        $user_insert = "INSERT INTO users (fullname, phone, address, email, occupation, username, country, password, dob, acc_no)
        VALUES('$fullname', '$phone', '$address', '$email', '$occupation', '$username', '$country', '$hash_password', '$dob', '$acc_no')";

        $user_insert_query = mysqli_query($conn, $user_insert);

        if(!mysqli_errno($conn)){

            //Redirect to login page with success message
            $_SESSION['signup_success'] = "Sign up Successfull, Please Log in";

            header('location:' . ROOT_URL . 'login.php');
            die();
        }




    }





































}else{
    header('location:'. ROOT_URL .'signup.php');
}


?>