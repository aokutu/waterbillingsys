<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="REGISTRATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class deletepatient 
{
public $patientnumber=null;	
}

$deletepatient =new deletepatient;
$deletepatient->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['patientnumber']))));

$connect->query("INSERT  INTO  events(user,session,action,date)  SELECT CONCAT('$dbdetails->user'),DATE_ADD(NOW(), INTERVAL 10 HOUR),CONCAT('DELETED PATIENT NUMBER ',ACCOUNT),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR) FROM patientsrecord WHERE ACCOUNT='$deletepatient->patientnumber' ");
$connect->query("DELETE FROM patientsrecord WHERE ACCOUNT='$deletepatient->patientnumber' ");
print $deletepatient->id;
header("LOCATION:patientsregistry.php");
 
?>