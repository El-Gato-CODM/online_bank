<?php
require './config/database.php';

if(isset($_POST['submit'])){
    $fullname = htmlspecialchars($_POST['fullname']);
    $dob = htmlspecialchars($_POST['dob']);
    $address = htmlspecialchars($_POST['address']);
    $user_id = htmlspecialchars($_POST['user_id']);



    $id_card_allowed_ext = ['png', 'jpeg', 'jpg', 'gif'];
    if(!empty($_FILES['id_card']['name'])){
        $id_card_file_name = $_FILES['id_card']['name'];
        $id_card_file_size = $_FILES['id_card']['size'];
        $id_card_file_tmp_name = $_FILES['id_card']['tmp_name'];

        //Generating and adding random characters to the file name
          $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
         $randomstring = substr(str_shuffle($characters), 0, 5);

          $id_card_file_name = $randomstring . $id_card_file_name;

        $target_file_id_card = 'uploads/'. $id_card_file_name;


       
    }else{
        $_SESSION['error_message'] = "Please upload your ID Card";
    }



    



    //Getting file extension
    $id_card_file_ext = explode('.', $id_card_file_name);
    $id_card_file_ext = strtolower(end($id_card_file_ext));
    
    

    //Checking file Extension
    if(in_array($id_card_file_ext, $id_card_allowed_ext)){

        //Checking File Size
        if($id_card_file_size <= 2000000){

            //Move uploaded file
            move_uploaded_file($id_card_file_tmp_name, $target_file_id_card);

        }else{
            $_SESSION['error_message'] = "ID Card File Size Too Large";
        }
    }else{
        $_SESSION['error_message'] = "Invalid ID Card File Type";
    }





    $poa_allowed_ext = ['png', 'jpeg', 'jpg', 'gif', 'docx', 'pdf'];
    if(!empty($_FILES['poa']['name'])){
        $poa_file_name = $_FILES['poa']['name'];
        $poa_file_size = $_FILES['poa']['size'];
        $poa_file_tmp_name = $_FILES['poa']['tmp_name'];

        //Adding random characters to poa file name
        $poa_file_name = $randomstring . $poa_file_name;

        $target_file_poa = 'uploads/'. $poa_file_name;


       
    }else{
        $_SESSION['error_message'] = "Please Upload Your Proof Of Address";
    }




    


    //Getting file extension
    $poa_file_ext = explode('.', $poa_file_name);
    $poa_file_ext = strtolower(end($poa_file_ext));
    
    

    //Checking file Extension
    if(in_array($poa_file_ext, $poa_allowed_ext)){

        //Checking File Size
        if($poa_file_size <= 2000000){

            //Move uploaded file
            move_uploaded_file($poa_file_tmp_name, $target_file_poa);

        }else{
            $_SESSION['error_message'] = "Proof Of Address File Size Too Large";
        }
    }else{
        $_SESSION['error_message'] = "Invalid Proof Of Address File Type";
    }


    if(isset($_SESSION['error_message'])){
        header('location:' . ROOT_URL . 'kyc.php');
        die();
    }else{
        $kyc_sql = "INSERT INTO kyc_request (user_id, fullname, dob, address, id_card, poa)
        VALUES ($user_id, '$fullname', '$dob', '$address', '$id_card_file_name', '$poa_file_name')";

        $kyc_update = "UPDATE users SET kyc_status = 'pending' WHERE id = $user_id";



        $kyc_sql_query = mysqli_query($conn, $kyc_sql);

        $kyc_update_query = mysqli_query($conn, $kyc_update);



        header('location:' . ROOT_URL . 'kyc.php');
    }





}


?>