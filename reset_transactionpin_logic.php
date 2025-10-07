<?php
require './config/database.php';

if(isset($_POST['submit'])){
    $password = htmlspecialchars($_POST['password']);
    $transaction_pin = htmlspecialchars($_POST['transaction_pin']);
    $confirm_transaction_pin = htmlspecialchars($_POST['confirm_transaction_pin']);
    $user_id = htmlspecialchars($_POST['user_id']);
    $user_password = htmlspecialchars($_POST['user_password']);

    if(password_verify($password, $user_password)){
        
        if(strlen($transaction_pin) > 4 || strlen($transaction_pin) < 4){

            $_SESSION['error_message'] = "Transaction pin must be four characters";
            header('location:'. ROOT_URL . 'reset_transactionpin.php');

        }elseif($transaction_pin !== $confirm_transaction_pin){

            $_SESSION['error_message'] = "Transaction pins do not match";
            header('location:'. ROOT_URL . 'reset_transactionpin.php');

        }else{

            $transaction_pin_sql = "UPDATE users SET transaction_pin = '$transaction_pin' WHERE id = '$user_id'";

            $transaction_pin_query = mysqli_query($conn, $transaction_pin_sql);


            $_SESSION['success_message'] = "Transaction Pin Updated Successfully";

            header('location:'. ROOT_URL . 'reset_transactionpin.php');
        }

    }else{
        $_SESSION['error_message'] = "Incorrect Password";
        header('location:'. ROOT_URL . 'reset_transactionpin.php');
    }
    
}

?>