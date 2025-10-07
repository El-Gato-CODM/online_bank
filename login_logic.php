<?php
require './config/database.php';



if(isset($_POST['submit'])){
    $email_username = htmlspecialchars($_POST['email_username']);
    $password = htmlspecialchars($_POST['password']);


    if(!$email_username){
        $_SESSION['login'] = "Please Enter your Username or Email";
    }elseif(!$password){
        $_SESSION['login'] = "Please Enter your password";
    }else{

        //Checking If the login details are on the database

        $fetch_user_sql = "SELECT * FROM users WHERE email = '$email_username' OR username = '$email_username'";

        $fetch_user_query = mysqli_query($conn, $fetch_user_sql);

        if(mysqli_num_rows($fetch_user_query) > 0){
            //saving user record
            $user_record = mysqli_fetch_assoc($fetch_user_query);

            //checking password
            $db_password = $user_record['password'];

            if(password_verify($password, $db_password)){

                //Control Key or Access Key
                $_SESSION['user_id'] = $user_record['id'];
                header('location:' . ROOT_URL . 'dashboard.php');
                
            }else{
                header('location:' . ROOT_URL . 'login.php');
                $_SESSION['login'] = "Incorrect password";
            }
            

        }else{
            header('location:' . ROOT_URL . 'login.php');
            $_SESSION['login'] = "Incorrect Login Details";
        }
    }








    //Error Check

    if(isset($_SESSION['login'])){
        header('location:' . ROOT_URL . 'login.php');
    }














}else{
    header('location:' . ROOT_URL . 'login.php');
}
?>