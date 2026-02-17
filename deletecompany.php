<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'COMPANY ADMIN' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$name=$_GET['name'];


$connect2=mysqli_connect('localhost','root','','COMPANY');
$x="DELETE FROM COMPANY WHERE NAME='$name' ";mysqli_query($connect2,$x)or die(mysqli_error($connect));
$connect3=mysqli_connect('localhost','root','');
$x="DROP  DATABASE $name ";mysqli_query($connect3,$x)or die(mysqli_error($connect3)); 


header("LOCATION:companyadmin.php"); exit;
?>