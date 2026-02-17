<?php 
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="INSUARANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


$_SESSION['insuarancecompany']=$_POST['insuarancecompany'];
$_SESSION['date1']=$_POST['date1'];
$_SESSION['date2']=$_POST['date2'];
header("LOCATION:insurancecashflow.php");exit;
?>