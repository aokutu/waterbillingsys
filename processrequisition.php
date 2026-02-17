<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$requisitioner=$_POST['requisitioner'];$_SESSION['requisitioner']=$requisitioner;
$authorizer=$_POST['authorizer'];$_SESSION['authorizer']=$authorizer;
$_SESSION['message']=" LOAD REQUISITIONS ";exit;
?>

