<?php
require '../config/database.php';




if(isset($_GET['id'])){
    $id = $_GET['id'];
    $value = $_GET['value'];
    $amn = $_GET['amn'];
    

}
if(isset($_POST['submit'])){
    $amount = intval(htmlspecialchars($_POST['amount']));
    $id = htmlspecialchars($_POST['id']);
    $value = htmlspecialchars($_POST['value']);
    $amn = htmlspecialchars($_POST['amn']);


    if($value == "credit"){
        $new_amount = $amount + intval($amn);
        $updated_amount_sql = "UPDATE users SET balance = $new_amount WHERE id = '$id'";

        $updated_amount_query = mysqli_query($conn, $updated_amount_sql);


        //Insert transaction into transaction table
        $transaction_sql = "INSERT INTO transactions (description, amount, user_id, t_type)
        VALUES ('Credit', $amount, '$id', 'credit')";
        $transaction_sql_query = mysqli_query($conn, $transaction_sql);



        $_SESSION['top_success'] = "User Credited Successfully ";
        header('location:' . ROOT_URL . 'admin/topup.php');

    }elseif($value == "debit"){
        $new_amount =  intval($amn) - intval($amount);
        $updated_amount_sql = "UPDATE users SET balance = $new_amount WHERE id = '$id'";

        $updated_amount_query = mysqli_query($conn, $updated_amount_sql);


                //Insert transaction into transaction table
        $transaction_sql = "INSERT INTO transactions (description, amount, user_id, t_type)
        VALUES ('Debit', $amount, '$id', 'debit')";
        $transaction_sql_query = mysqli_query($conn, $transaction_sql);



        $_SESSION['top_success'] = "User Debited Successfully ";
        header('location:' . ROOT_URL . 'admin/topup.php');
    }else{
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <p>Enter Amount</p>
        <input type="number" name="amount">
        <input type="submit" name="submit">
        <input type="text" value="<?=$id?>"  name="id">
        <input type="text" value="<?=$value?>"  name="value">
        <input type="text" value="<?= $amn?>" name="amn">
    </form>
</body>
</html>