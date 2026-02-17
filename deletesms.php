<?php 
@session_start();
set_time_limit(0);
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'DELETE SMS-EMAILS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$id=$_POST['id'];
foreach ($id as $sms)
{
	print $sms;
$x="DELETE FROM outbox WHERE id=$sms ";	mysqli_query($connect,$x)or die(mysqli_error($connect));
}

$_SESSION['message']="SMS(S) DELETED";
?>