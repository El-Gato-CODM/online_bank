<?php
require '../config/database.php';

if(isset($_POST['unfreeze'])){
    $user_id = htmlspecialchars($_POST['user_id']);
    

    $account_status_sql = "UPDATE users SET account_status = '' WHERE id = $user_id";
    $account_status_query = mysqli_query($conn, $account_status_sql);

    $_SESSION['unfreeze_message'] = "Account Restored Successfully";
    header('location:' . ROOT_URL . 'admin/frozen_accounts.php');
} 
?>