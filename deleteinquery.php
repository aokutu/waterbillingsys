<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'BALANCE  INQUERY' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$del=$_POST['del'];

foreach($del as  $id)
{
$x="DELETE FROM emails WHERE id=$id  ";
$x=mysqli_query($connect2,$x)or die(mysqli_error($connect2));	
}
$_SESSION['message']="BALANCE INQUERY DELETED ";exit;
?>