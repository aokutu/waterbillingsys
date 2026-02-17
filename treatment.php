<?php
@session_start();
include_once("password2.php");
include_once("interface.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="PHAMARCY";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class treatmentreport 
{
	
public $patientnumber=null;
public $diagnosis=null;
public $treatment=null;
public $medication=null;
public $route=null;
public $dosage=null;
public $frequency=null;
public $period=null;
public $note=null;
}

$treatmentreport=new treatmentreport;
$treatmentreport->treatment=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['treatment'])))));
$treatmentreport->medication=$connect->real_escape_string (trim(addslashes(strtoupper($_POST['medication']))));
$treatmentreport->route=$connect->real_escape_string (trim(addslashes(strtoupper($_POST['route']))));
$treatmentreport->dosage=$connect->real_escape_string (trim(addslashes(strtoupper($_POST['dosage']))));
$treatmentreport->frequency=$connect->real_escape_string (trim(addslashes(strtoupper($_POST['frequency']))));
$treatmentreport->period=$connect->real_escape_string (trim(addslashes(strtoupper($_POST['period']))));
$treatmentreport->note='MEDICATION:'.$treatmentreport->medication.'<br>'.'ROUTE:'.$treatmentreport->route.' '.'DOSAGE:'.$treatmentreport->dosage.' '.'FREQUENCY:'.$treatmentreport->frequency.'<br> '.'PERIOD:'.$treatmentreport->period.'<br>';

$treatmentreport->patientnumber=$_SESSION['patientnumber'];
$connect ->query("INSERT INTO treatmentreport(PATIENTNUMBER,PRESCRIPTION,TREATMENT,ATTENDANT,DATE) 
VALUES('$treatmentreport->patientnumber','$treatmentreport->note','$treatmentreport->treatment','$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR))");
$connect ->query("UPDATE consultation SET  URGENCY='PHAMARCY' WHERE PATIENTNUMBER='$treatmentreport->patientnumber' ");
$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('UPDATED  TREATMENT REPORT   OF  PATIENT   MUMBER $treatmentreport->patientnumber '),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
$_SESSION['message']='DIAGNOSIS REPORT  UPDATED'.$treatmentreport->patientnumber; 
?>
