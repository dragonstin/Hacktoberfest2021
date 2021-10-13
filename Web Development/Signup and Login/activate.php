<?php 
session_start();
$token= $_GET["token"];
$email= $_GET["email"];
include("connection.php");
$sql="UPDATE `user` SET `status`=1 WHERE `email`='$email' AND `token`='$token'";
$result = mysqli_query($conn, $sql);
if ($result) {
    $_SESSION['error'] = "Verification_success";
    header("Location:index.php");
}
else{
    $_SESSION['error'] = "Verification_failed";
    header("Location:index.php"); 
}
