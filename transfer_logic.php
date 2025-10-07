<?php
require './config/database.php';


if(isset($_POST)){
    $amount = htmlspecialchars($_POST['amount']);
    $description = htmlspecialchars($_POST['description']);
    $user_id = htmlspecialchars($_POST['user_id']);
    $transaction_pin = htmlspecialchars($_POST['transaction_pin']);
    $account_number = htmlspecialchars($_POST['account_number']);


    //Fetching user info from the database
    $fetch_user_sql = "SELECT * FROM users WHERE id = '$user_id'";
    $fetch_user_query = mysqli_query($conn, $fetch_user_sql);
    $fetch_user_record = mysqli_fetch_assoc($fetch_user_query);
    $user_pin = $fetch_user_record['transaction_pin'];

    if($user_pin == ""){
        $_SESSION['error_message'] = "Please Set a Transaction PIN"; 
        header('location:' . ROOT_URL . 'reset_transactionpin.php');
        die();
    }

    $user_balance = intval($fetch_user_record['balance']);
    


    //Checking if account number exists
    $account_sql = "SELECT * FROM users WHERE acc_no = '$account_number'";
    $account_sql_query = mysqli_query($conn, $account_sql);

    if(mysqli_num_rows($account_sql_query) > 0 ){

         if($fetch_user_record['transaction_pin'] == "$transaction_pin"){

            //FEtching the user who owns the account number
            $user_sql = "SELECT * FROM users WHERE acc_no = '$account_number'";
            $user_query = mysqli_query($conn, $user_sql);

            $user_record = mysqli_fetch_assoc($user_query);
            
            $user_record_id = $user_record['id'];
            $user_record_balance = $user_record['balance'];

            $new_balance = intval($user_record_balance) + intval($amount);


            if($amount > $user_balance){

                $_SESSION['error_message'] = "Insufficient Funds"; 
                header('location:' . ROOT_URL . 'transfer.php');

            }elseif($amount == ''){
                $_SESSION['error_message'] = "Please Enter Amount"; 
                header('location:' . ROOT_URL . 'transfer.php');
            }else{

                $user_update_sql = "UPDATE users SET balance = $new_balance WHERE id = $user_record_id";
                 $user_update_query = mysqli_query($conn, $user_update_sql);


            
            
            // Debit 
            $main_user_balance = $fetch_user_record['balance'];

            $main_user_new_balance = intval($main_user_balance) - intval($amount);

            $main_user_update_sql = "UPDATE users SET balance = $main_user_new_balance WHERE id = $user_id";
            $main_user_update_query = mysqli_query($conn, $main_user_update_sql);

           
            
            
            $transaction_sql = "INSERT INTO transactions (amount, description, user_id, t_type)
            VALUES ($amount, '$description', '$user_id', 'debit')";
            $transaction_query = mysqli_query($conn, $transaction_sql);

            $credit_transaction_sql = "INSERT INTO transactions (amount, description, user_id, t_type)
            VALUES ($amount, '$description', '$user_record_id', 'credit')";
            $credit_transaction_query = mysqli_query($conn, $credit_transaction_sql);






            $_SESSION['success_message'] = "Transfer Successfull"; 
            header('location:' . ROOT_URL . 'dashboard.php');



           


            }
            

            






    }else{

        $_SESSION['error_message'] = "Incorrect Pin"; 
        header('location:' . ROOT_URL . 'transfer.php');
    }

    }else{
        $_SESSION['error_message'] = "Invalid Account Details"; 
        header('location:' . ROOT_URL . 'transfer.php');
    }

    
   




    

    
}











?>