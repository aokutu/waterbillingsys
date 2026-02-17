<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$min2=$_POST['min'];$min2=addslashes($min2);@$max2=$_POST['max'];$max2=addslashes($max2);
if(($min2  =="" )&&($max2 =="")){echo "INVALID ENTRIES ";exit;}

if(($min2  >=0  )&&($max2 =="")){$max2=$min2;}
if (($min2  <0 )||($min2 >$max2)){echo "INVALID ENTRIES ";exit;}
else {$_SESSION['min2']=$min2; $_SESSION['max2']=$max2;   echo "RANGE SET ";exit; }
?>


