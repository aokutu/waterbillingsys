<?php 

@session_start();
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="consultation";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;} 

class dischargereport
{
public  $admissiondate=null;
public  $dischargedate=null;
public  $diagnosis=null;
public  $chiefcomplain=null;
public $presentingillness=null;
public $onexamination=null;
public $patientnumber=null;
public $summary=null;
public $diagnosisdetails=null;
}


$dischargereport = new dischargereport;
$dischargereport->admissiondate=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['admissiondate']))));
$dischargereport->dischargedate=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['dischargedate']))));
$dischargereport->diagnosis=$_POST['diagnosis'];
$dischargereport->chiefcomplain=$connect->real_escape_string(nl2br(htmlspecialchars(trim(addslashes($_POST['chiefcomplain'])))));
$dischargereport->presentingillness=$connect->real_escape_string(nl2br(htmlspecialchars(trim(addslashes($_POST['presentingillness'])))));
$dischargereport->onexamination=$connect->real_escape_string(nl2br(htmlspecialchars(trim(addslashes($_POST['onexamination'])))));
$dischargereport->summary=$connect->real_escape_string(nl2br(htmlspecialchars(trim(addslashes($_POST['summary'])))));
$dischargereport->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));

$dischargereport->diagnosis=$_POST['diagnosis'];
$dischargereport->diagnosisdetails=$connect->real_escape_string(trim(addslashes(strtoupper(implode(",",$dischargereport->diagnosis)))));

$x=$connect->query("SELECT ACCOUNT,GENDER,CLIENT,TIMESTAMPDIFF(YEAR,BIRTHDATE, DATE_ADD(NOW(), INTERVAL 10 HOUR)) AS YRS,
TIMESTAMPDIFF(MONTH,BIRTHDATE, DATE_ADD(NOW(), INTERVAL 10 HOUR)) % 12 AS  MONTHS FROM patientsrecord WHERE ACCOUNT ='$dischargereport->patientnumber'   ");
while ($data = $x->fetch_object())
{
	

$age =$data->YRS.' YRS '.$data->MONTHS.' MONTHS';
$connect->query(" INSERT INTO patientdischargereport (PATIENTNUMBER, AGE, 
GENDER, MEDICALOFFICER, ADMISSIONDATE, DISCHARGEDATE, 
DIAGNOSIS, CHIEFCOMPLAIN, PRESEMTINGILLNESS, ONEXAMINATION,
 SUMMARY) 
VALUES ('$dischargereport->patientnumber','$age','$data->GENDER','$dbdetails->user','$dischargereport->admissiondate',
'$dischargereport->dischargedate', '$dischargereport->diagnosisdetails', '$dischargereport->chiefcomplain', '$dischargereport->presentingillness', '$dischargereport->onexamination', '$dischargereport->summary')");

$_SESSION['message']="DISCHARGE REPORT <br>POSTED";  

}


?>

