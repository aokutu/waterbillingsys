<?php
@session_start();
@$user =$_SESSION['user'];
@$password=$_SESSION['password'];
@$zone=$_SESSION['zone'];
@$company=$_SESSION['company'];
if(!isset($_SESSION['company']) || empty($_SESSION['company'])) { header('Location:loggin.php');}
//print $company;
//$connect2=mysqli_connect('localhost','lawascoco','l@wasco2023','lawascoco_Company');
$connect=mysqli_connect('localhost','lawascoco','Stealmouse@355.',$company);
$x="UPDATE users  SET LOGGED='OFF' WHERE NAME='$user'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'Log Out',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
session_unset();
@$_SESSION['user']='no name';
@session_destroy();
@$_SESSION=array();
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: Mon,26 Jul 1980 05:00:00 GMT');
header('Location:loggin.php');
?>
