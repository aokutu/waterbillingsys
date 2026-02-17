<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'VIEW REPORTS'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACESS DENIED";exit;}
$_SESSION['date1']=$_POST['date1'];$_SESSION['date2']=$_POST['date2'];
$_SESSION['searchvalue']=addslashes($_POST['searchvalue']);
$_SESSION['searchmethod']= addslashes($_POST['searchmethod']);
$_SESSION['message']="SEARCHING";  exit;
?>