<?php 
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="NURSE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'consultation'");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class vitals extends dbdetails 
{
public $patientnumber=null;
public $date=null;
public $time=null;
public $tempreture=null;
public $pulserate=null;
public $respiratoryrate=null;
public $bloodpressure=null;
public $weight=null;
public $medicalnote=null;
public $status=null;
	
}

$vitals=new vitals;
if(isset($_POST['patientnumber']))
{
$vitals->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['patientnumber']))));
}
else if(isset($_SESSION['patientnumber']))
{
$vitals->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));
}
$vitals->date=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['date']))));
$vitals->time=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['time']))));
$vitals->tempreture=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['tempreture']))));
$vitals->pulserate=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['pulserate']))));
$vitals->respiratoryrate=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['respiratoryrate']))));
$vitals->bloodpressure=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['bloodpressure']))));
$vitals->weight=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['weight']))));
$vitals->medicalnote=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['medicalnote'])))));
$vitals->status=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['status'])))));

$connect->query(" INSERT INTO vitalsreport (PATIENTNUMBER,DATE,TIME,TEMPRETURE,PULSERATE,RESPIRATORYRATE,BLOODPRESSURE,WEIGHT,MEDICALNOTE,NURSE) 
VALUES('$vitals->patientnumber','$vitals->date','$vitals->time','$vitals->tempreture','$vitals->pulserate','$vitals->respiratoryrate','$vitals->bloodpressure','$vitals->weight','$vitals->medicalnote','$dbdetails->user')");
$connect->query("UPDATE  consultation  SET URGENCY='$vitals->status' WHERE PATIENTNUMBER='$vitals->patientnumber'  ");
$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('ENTERED VITAL RECORDS FOR PATIENT NUMBER  ',$vitals->patientnumber),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
$_SESSION['message']='VITALS RECORDINGS  UPDATED  TO PATIENT'.$vitals->patientnumber;
?>