<?php 
set_time_limit(0);
session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
$date1=$_POST['date1'];
$_SESSION['date1']=$_POST['date1'];
$_SESSION['date2']=$_POST['date2'];
$_SESSION['message']='PROCESSED';
include_once("audittrail.php");
?>