<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'NURSING'  OR name='$user' AND password='$password'    AND  ACCESS  REGEXP  'CONSULTATION'  OR name='$user' AND password='$password'    AND  ACCESS  REGEXP  'NURSE' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$_SESSION['patientnumber']=$_GET['patientnumber'];
header("LOCATION:chargeprocedure.php");exit;
?>