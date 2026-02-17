<?php 
session_start();
include_once("password.php");
$password1=$_POST['password1'];
$password2=$_POST['password2'];
if($password1!==$password2){header("LOCATION:resetpassword.php");}

$x="UPDATE users SET PASSWORD='$password1' WHERE NAME='$user' AND PASSWORD='123456' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(USER,SESSION,ACTION,DATE) VALUES('".$_SESSION['user']."',now(),'SET NEW PASSWORD',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
header("LOCATION:exit.php");
?>