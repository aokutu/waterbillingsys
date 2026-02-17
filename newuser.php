<?php 
session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'      AND  ACCESS  REGEXP  'USERS ADMIN'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS DENIED";exit;}

$data=implode(',',$_POST['right']);

@$name=strtoupper(addslashes($_POST['name']));
$x="SELECT * FROM users  WHERE  name='$name'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){ echo "USER  EXISTS"; exit; }
else{}
$x="INSERT INTO users(name,password,access) VALUES('$name','123456','$data')";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'CREATED   USER  :$name',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']="NEW  USER CREATED";exit;
?>