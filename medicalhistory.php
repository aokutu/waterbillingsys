<?php
@session_start();
include_once("password2.php");
include_once("interface.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="CONSULTATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class medicalhistory 
{
	
public $patientnumber=null;
public $history=null;
public $personalhistory=null;
public $familyhistory=null;
public $sexualhistory=null;
public $hivtestdate=null;
public $allergies=null;
public $currentmedication=null;
public $chroniccondition=null;
public $surgeries=null;

}

$medicalhistory=new medicalhistory;
$medicalhistory->history=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['medicalhistory'])))));
$medicalhistory->personalhistory=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['personalhistory'])))));
$medicalhistory->familyhistory=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['familyhistory'])))));
$medicalhistory->sexualhistory=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['sexualhistory'])))));
$medicalhistory->hivtestdate=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['hivtestdate']))));
$medicalhistory->allergies=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['allergies']))));
$medicalhistory->currentmedication=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['currentmedication']))));
$medicalhistory->chroniccondition=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['chroniccondition']))));
$medicalhistory->surgeries=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['surgeries']))));
$medicalhistory->patientnumber=$_SESSION['patientnumber'];

$connect ->query("INSERT INTO medicalhistory(PATIENTNUMBER,MEDICALHISTORY,PERSONALHISTORY,FAMILYHISTORY,SEXUALHISTORY,HIVTESTDATE,ALLERGY,CURRENTMEDICATION,CHRONICILLNESS,SURGERIES,ATTENDANT,DATE) 
VALUES('$medicalhistory->patientnumber','$medicalhistory->history','$medicalhistory->personalhistory','$medicalhistory->familyhistory','$medicalhistory->sexualhistory','$medicalhistory->hivtestdate','$medicalhistory->allergies','$medicalhistory->currentmedication','$medicalhistory->chroniccondition','$medicalhistory->surgeries','$dbdetails->user',NOW())");
$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('UPDATED  MEDICAL  HISTORY OF PATIENT   MUMBER $medicalhistory->patientnumber '),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
$_SESSION['message']='OTHER HISTORY  UPDATED ON PATIENT NUMBER'.$medicalhistory->patientnumber; 
?>
