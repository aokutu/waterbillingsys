<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='GUEST'  AND STATUS ='RESET' ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{}
else{echo "ACCESS DENIED";exit;}
$username=strtoupper(addslashes($_POST['username']));
$newpassword=strtoupper(addslashes($_POST['newpassword']));
$id=addslashes($_POST['id']);

$x="SELECT * FROM users  WHERE  name='$username' AND password='$newpassword' ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{  echo $password;exit;}
$x="UPDATE users  SET name='$username'  , password='$newpassword' ,STATUS='ACTIVE' WHERE   id =$id";mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['user']=$username;  $_SESSION['password']=$newpassword;
 echo "UPDATED ";exit;
?>