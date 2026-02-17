<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'PRODUCTION METER'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$date1=$_POST['date1']; @$date2=$_POST['date2'];
$_SESSION['date1']=$date1;
$_SESSION['date2']=$date2;
$_SESSION['message']="SEARCHING REPORTS"; exit;
?>
