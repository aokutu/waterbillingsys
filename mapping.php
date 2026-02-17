<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'UPDATE CORDINATES'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{
	
$_SESSION['message']="ACCESS DENIED ";exit;
	
	}
@$account=$_POST['account'];@$longitude=$_POST['longitude']; @$lattitude=$_POST['lattitude'];
$x="UPDATE $accountstable SET LONGITUDE='$longitude' ,LATTITUDE='$lattitude' WHERE ACCOUNT ='$account'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'MAPPED  ACCOUNT $account',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']="ACCOUNT COORDINATES UPDATED ";exit;
?>