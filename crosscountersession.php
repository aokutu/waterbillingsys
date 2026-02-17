<?php
@session_start();
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="PHAMARCY";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class patientdetails 
{
	
public $patientnumber=null; 
public $clienttype=null;

}

$patientdetails=new patientdetails;
$patientdetails->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['patientnumber']))));
$patientdetails->clienttype=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['clienttype']))));

$_SESSION['patientnumber']=$patientdetails->patientnumber;
$_SESSION['clienttype']=$patientdetails->clienttype;

header("LOCATION:crosscounterdrugdispence.php");exit;
?>