<?php 
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="NURSE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class patientdetails extends dbdetails
{
public $ward=null;
public $patientnumber=null;
public $bednumber=null;
}

$patientdetails=new patientdetails;
$patientdetails->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['patientnumber']))));
$patientdetails->ward=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['ward']))));
$patientdetails->bednumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['bednumber']))));

$connect ->query("UPDATE inpatientsrecord SET WARD='$patientdetails->ward' ,BEDNUMBER='$patientdetails->bednumber'  WHERE PATIENTNUMBER='$patientdetails->patientnumber' ");
$connect ->query("INSERT INTO events(user,session,action,date) 
VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('TRANSFERED PATIENT  ','$patientdetails->patientnumber',' TO  NEW  BED '),DATE_ADD(NOW(), INTERVAL 10 HOUR)     ) ");
header("LOCATION:admissiondischarge.php");exit;

?>
