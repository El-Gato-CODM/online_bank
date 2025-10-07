<?php
require '../config/database.php';



if(isset($_POST['approve'])){
    $user_id = htmlspecialchars($_POST['user_id']);
    $fullname = htmlspecialchars($_POST['fullname']);
    $dob = htmlspecialchars($_POST['dob']);
    $address = htmlspecialchars($_POST['address']);
    $id_card = htmlspecialchars($_POST['id_card']);
    $poa = htmlspecialchars($_POST['poa']);

    


    $approve_kyc_sql = "INSERT INTO approved_kyc(user_id, fullname, dob, address, id_card, poa)
                        VALUES ('$user_id', '$fullname', '$dob', '$address', '$id_card', '$poa')";

    $approve_kyc_query = mysqli_query($conn, $approve_kyc_sql);


    $approve_kyc_sql_2 = "DELETE FROM kyc_request WHERE user_id = $user_id";
    $approve_kyc_sql_2 = mysqli_query($conn, $approve_kyc_sql_2);


    $kyc_status_update = "UPDATE users SET kyc_status = 'approved' WHERE id = $user_id";
    $kyc_status_update_query = mysqli_query($conn, $kyc_status_update);

    $_SESSION['approve_message'] = "KYC Approved Successfully";
    header('location:' . ROOT_URL . 'admin/kyc_request.php');
    
}




if(isset($_POST['decline'])){
    $user_id = htmlspecialchars($_POST['user_id']);
    $fullname = htmlspecialchars($_POST['fullname']);
    $dob = htmlspecialchars($_POST['dob']);
    $address = htmlspecialchars($_POST['address']);
    $id_card = htmlspecialchars($_POST['id_card']);
    $poa = htmlspecialchars($_POST['poa']);

    


    $decline_kyc_sql = "INSERT INTO declined_kyc(user_id, fullname, dob, address, id_card, poa)
                        VALUES ('$user_id', '$fullname', '$dob', '$address', '$id_card', '$poa')";

    $decline_kyc_query = mysqli_query($conn, $decline_kyc_sql);

    $decline_kyc_sql_2 = "DELETE FROM kyc_request WHERE user_id = $user_id";
    $decline_kyc_sql_2 = mysqli_query($conn, $decline_kyc_sql_2);


    $kyc_status_update = "UPDATE users SET kyc_status = 'declined' WHERE id = $user_id";
    $kyc_status_update_query = mysqli_query($conn, $kyc_status_update);

    $_SESSION['decline_message'] = "KYC Declined Successfully";
    header('location:' . ROOT_URL . 'admin/kyc_request.php');
    
}


?>