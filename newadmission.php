<?php 
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="NURSE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{
	
}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class wardadmission
{
public $patientnumber=null;
public $ward=null;
public $bednumber=null;
public $date=null;
}

$wardadmission=new wardadmission;
$wardadmission->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['patientnumber']))));

$wardadmission->ward=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['ward']))));
$wardadmission->bednumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['bednumber']))));
$wardadmission->date=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['date']))));
$x=$connect->query("SELECT PATIENTNUMBER  FROM inpatientsrecord WHERE inpatientsrecord.PATIENTNUMBER='$wardadmission->patientnumber' ");
if(mysqli_num_rows($x)>0)
{
$_SESSION['message']='ADMITTED PATIENT '.$wardadmission->patientnumber;exit;
}

$connect->query("INSERT INTO inpatientsrecord(PATIENTNUMBER,WARD,BEDNUMBER,ADMISSIONDATE,ADMITDATE2) VALUES('$wardadmission->patientnumber','$wardadmission->ward','$wardadmission->bednumber','$wardadmission->date','$wardadmission->date')");


$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$wardadmission->patientnumber' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,URGENCY,BOOKEDIN,DATE)   
VALUES('$wardadmission->patientnumber','INPATIENT',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR))");
}
else
{
$connect->query("UPDATE consultation SET URGENCY='INPATIENT' ,DATE=NOW(),BOOKEDIN=DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR)  WHERE PATIENTNUMBER ='$wardadmission->patientnumber' ");	

}


$connect ->query("INSERT INTO events(user,session,action,date) 
VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('ADMITTED  NEW INPATIENT $wardadmission->patientnumber TO  WARD  $wardadmission->ward  BED  $wardadmission->bednumber'),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
$_SESSION['message']='ADMITTED PATIENT '.$wardadmission->patientnumber;exit;

/*
$_SESSION['message']='BED ENGAGED';exit;*/
?>