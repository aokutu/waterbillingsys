<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$min=$_POST['min'];$max=$_POST['max'];
if($min >=$max){header("Location:invalidentries.php");exit;}
if(strtotime($_POST['date1'])>strtotime($_POST['date2'])){$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$_SESSION['date1']=$_POST['date1'];@$_SESSION['date2']=$_POST['date2'];
@$_SESSION['min']=$_POST['min'];@$_SESSION['max']=$_POST['max'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{include_once("accessdenied.php");exit;}
header("Location:dateset.php");

?>
