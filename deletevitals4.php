<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="NURSE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'CONSULTATION' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class vitalspatient
{
public $patient=null;	
}

$vitalspatient =new vitalspatient;
$vitalspatient->patient=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['patientnumber']))));

$connect->query("DELETE FROM vitalsreport WHERE PATIENTNUMBER='$vitalspatient->patient' ");
header("LOCATION:vitalsigns.php");
 

?>