<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
@$account1=$_POST['account1'];
@$account2=$_POST['account2'];
$_SESSION['account1']=$account1;
$_SESSION['account2']=$account2;
@$depositdate1=$_POST['date1']; @$depositdate2=$_POST['date2'];
$_SESSION['depositdate1']=$depositdate1;$_SESSION['depositdate2']=$depositdate2;
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'VIEW SLIPS'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$_SESSION['message']="SEARCH ACCOUNTS"; header("LOCATION:bankstatements.php");exit;
?>