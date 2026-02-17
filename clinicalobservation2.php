<?php
@session_start();
include_once("password2.php");
include_once("interface.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="ADMIN";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class clinicalobservation 
{
	
public $patientnumber=null;
public $observation=null;
public $conclusion=null;


}

$clinicalobservation=new clinicalobservation;
$clinicalobservation->observation=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['observation'])))));
$clinicalobservation->conclusion=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['conclusion'])))));

$clinicalobservation->patientnumber=$_SESSION['patientnumber'];
print $clinicalobservation->conclusion;

$connect ->query("INSERT INTO clinicalobservation(PATIENTNUMBER,OBSERVATION,CONCLUSION,DATE) 
VALUES('$clinicalobservation->patientnumber','$clinicalobservation->observation','$clinicalobservation->conclusion',DATE_ADD(NOW(), INTERVAL 10 HOUR))");

$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('UPDATED  CLINICAL OBSERVATION  OF  PATIENT   MUMBER $clinicalobservation->patientnumber '),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
print $clinicalobservation->observation;
$_SESSION['message']='CLINICAL  OBSERVATION  UPDATED'.$clinicalobservation->patientnumber;

?>
