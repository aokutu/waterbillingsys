<?php
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$company=$_SESSION['company'];
include_once("password.php");
$msg=$_POST['msg'];@$chatmate=$_POST['chatmate']; $msg=addslashes($msg);
@$_SESSION['chatmate']=$chatmate;
$x="INSERT INTO company.chatroom (`SENDER`, `message`, `RECIPIENT`, `date`) VALUES ('$user', '$msg', '$chatmate', now());";
mysqli_query($connect2,$x)or die(mysqli_error($connect2));
?>