<?php
@session_start();
include_once("password2.php");
include_once("interface.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="REGISTRATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  


class consultationbooking 
{
public $patientnumber=null;
}
$consultationbooking= new consultationbooking;

$consultationbooking->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['clientid']))));


$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$consultationbooking->patientnumber' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,BOOKEDIN,DATE)   VALUES('$consultationbooking->patientnumber',NOW(),NOW())");
header("LOCATION:patientsregistry.php");exit;	
	
}
else
{
header("LOCATION:accessdenied4.php");exit;
}

?>
