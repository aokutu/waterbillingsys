<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP 'ADMINISTRATOR'  OR   name='$user' AND password='$password'     AND  ACCESS  REGEXP 'USER'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ echo "ACCESS DENIED";exit;}  
$_SESSION['mode']=$_POST['mode'];  $search=$_POST['search']; $_SESSION['search']=strtoupper(addslashes($search));
$_SESSION['date1']=$_POST['date1'];$_SESSION['date2']=$_POST['date2'];  $_SESSION['id']=$_POST['id'];
$_SESSION['message']="SEARCHING";exit;
?>