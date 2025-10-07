<?php
require 'constant.php';
// connect to database
$conn = new mysqli(DB_HOST, DB_USER, DB_USER, DB_NAME);
if(mysqli_errno($conn)){
    die(mysqli_error($conn));
}else{
    // echo 'connection successfull';
}
?>