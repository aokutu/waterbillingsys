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
public $localexamination=null;
public $cardiovascular=null;
public $respiratory=null;
public $abdomen=null;
public $ent=null;
public $cns=null;
public $mascularskeleton=null;
public $differentialdiagnosis=null;
public $git=null;
public $skin=null;
public $observation=null;
public $conclusion=null;


}

$clinicalobservation=new clinicalobservation;
$clinicalobservation->localexamination=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['localexamination'])))));
$clinicalobservation->cardiovascular=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['cardiovascular'])))));
$clinicalobservation->respiratory=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['respiratory'])))));
$clinicalobservation->abdomen=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['abdomen'])))));
$clinicalobservation->ent=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['ent'])))));
$clinicalobservation->cns=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['cns'])))));

$clinicalobservation->mascularskeleton=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['mascularskeleton'])))));
$clinicalobservation->differentialdiagnosis=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['differentialdiagnosis'])))));
$clinicalobservation->git=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['git'])))));
$clinicalobservation->skin=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['skin'])))));
$clinicalobservation->observation=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['observation'])))));
$clinicalobservation->conclusion=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['conclusion'])))));

$clinicalobservation->patientnumber=$_SESSION['patientnumber'];
$connect ->query("INSERT INTO patientclinicalreport(PATIENTNUMBER,LOCAL,CARDIOVASCULAR,RESPIRATORY,ABDOMEN,ENT,CNS,MASCULARSKELETON,DIFFERENTIALDIAGNOSIS,GIT,SKIN,ATTENDANT,DATE) 
VALUES('$clinicalobservation->patientnumber','$clinicalobservation->localexamination','$clinicalobservation->cardiovascular','$clinicalobservation->respiratory','$clinicalobservation->abdomen','$clinicalobservation->ent','$clinicalobservation->cns','$clinicalobservation->mascularskeleton','$clinicalobservation->differentialdiagnosis','$clinicalobservation->git','$clinicalobservation->skin','$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR))");

$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('UPDATED  CLINICAL EXAMINATIONS  OF  PATIENT   MUMBER $clinicalobservation->patientnumber '),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
print $clinicalobservation->observation;
$_SESSION['message']='CLINICAL  OBSERVATION  UPDATED'.$clinicalobservation->patientnumber;
?>
