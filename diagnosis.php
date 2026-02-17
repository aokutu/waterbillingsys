<?php
@session_start();
include_once("password2.php");
include_once("interface.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="consultation";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class clinicaldiagnosis 
{
	
public $patientnumber=null;
public $diagnosis=null;
public $conclusion=null;


}

$clinicaldiagnosis=new clinicaldiagnosis;
$clinicaldiagnosis->diagnosis=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['diagnosis'])))));
$clinicaldiagnosis->conclusion=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['conclusion'])))));
$clinicaldiagnosis->patientnumber=$_SESSION['patientnumber'];
$connect ->query("INSERT INTO diagnosisreport(PATIENTNUMBER,DIAGNOSIS,DETAILS,ATTENDANT,DATE) 
VALUES('$clinicaldiagnosis->patientnumber','$clinicaldiagnosis->diagnosis','$clinicaldiagnosis->conclusion','$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR))");

$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('UPDATED  DIAGNOSIS REPORT   OF  PATIENT   MUMBER $clinicaldiagnosis->patientnumber '),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
$_SESSION['message']='DIAGNOSIS REPORT  UPDATED'.$clinicaldiagnosis->patientnumber; 
?>
