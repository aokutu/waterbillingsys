<?php
session_start();
@$_SESSION['message']="SEARCHING  ACCOUNTS";
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
@$account1=$_POST['account1'];
@$account2=$_POST['account2'];
$_SESSION['account1']=$account1;
$_SESSION['account2']=$account2;
$_SESSION['zone']=$zone;
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ include_once("accessdenied.php");exit;}
print $_SESSION['message'];
?>