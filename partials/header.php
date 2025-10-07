<?php
require './config/database.php';

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $user_details_sql = "SELECT * FROM users WHERE id = '$user_id'";

    $user_details_query = mysqli_query($conn, $user_details_sql);
    $user_details_record = mysqli_fetch_assoc($user_details_query);


    //Fetching Users transactions
    $user_transactions_sql = "SELECT * FROM transactions WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 4 ";
    $user_transactions_query = mysqli_query($conn, $user_transactions_sql);


    $user_transactions_all_sql = "SELECT * FROM transactions WHERE user_id = '$user_id' ORDER BY id DESC ";
    $user_transactions_all_query = mysqli_query($conn, $user_transactions_all_sql);

}else{
    header('location:' . ROOT_URL . 'login.php');
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= ROOT_URL ?>dashboard_style.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>transfer_style.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>deposit_style.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>transactionhistory_style.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>kyc_style.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>reset_transactionpin_style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="main">
        <div class="menu">
            <div>
                <h2>Orbix Bank</h2>
            </div>
            <div>
                <ul>
                    <li><a href="dashboard.php"><div class="icon"><i class="bi bi-house-fill"></i></div> Home</a></li>
                    <li><a href="transfer.php"><div class="icon"><i class="bi bi-arrow-bar-up"></i></div> Transfer</a></li>
                    <li><a href="deposit.php"><div class="icon"><i class="bi bi-arrow-bar-down"></i></div> Deposit</a></li>
                    <li><a href="transactionhistory.php"><div class="icon"><i class="bi bi-clock-history"></i></div> Transaction History</a></li>
                    <li><a href="kyc.php"><div class="icon"><i class="bi bi-person-check"></i></div> KYC Verification</a></li>
                    <li><a href="reset_transactionpin.php"><div class="icon"><i class="bi bi-shield-fill-exclamation"></i></div> Transaction pin</a></li>
                    <li><a href="<?= ROOT_URL?>logout.php"><div class="icon"><i class="bi bi-lock-fill"></i></div> Logout</a></li>
                </ul>
            </div>
        </div>