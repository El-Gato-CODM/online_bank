<?php
require '../config/database.php';

if(isset($_POST['freeze'])){
    $user_id = htmlspecialchars($_POST['user_id']);
    

    $account_status_sql = "UPDATE users SET account_status = 'frozen' WHERE id = $user_id";
    $account_status_query = mysqli_query($conn, $account_status_sql);

    $_SESSION['success_message'] = "Account Frozen Successfully";
    header('location:' . ROOT_URL . 'admin/manage_users.php');
}


if(isset($_GET['id'])){
    $user_id = htmlspecialchars($_GET['id']);
    echo $user_id;
    

    $delete_account_sql = "DELETE FROM users WHERE id = $user_id";
    $delete_account_query = mysqli_query($conn, $delete_account_sql);

    $_SESSION['success_message'] = "Account Deleted Successfully";
    header('location:' . ROOT_URL . 'admin/manage_users.php');
}




?>