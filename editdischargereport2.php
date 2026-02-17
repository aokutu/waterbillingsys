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
public $editid=null;
}


$dischargereport = new dischargereport;
$dischargereport->editid=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['editid']))));
$dischargereport->admissiondate=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['admissiondate']))));
$dischargereport->dischargedate=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['dischargedate']))));
$dischargereport->diagnosis=$_POST['diagnosis'];
$dischargereport->chiefcomplain=$connect->real_escape_string(htmlspecialchars(trim(addslashes($_POST['chiefcomplain']))));
$dischargereport->presentingillness=$connect->real_escape_string(htmlspecialchars(trim(addslashes($_POST['presentingillness']))));
$dischargereport->onexamination=$connect->real_escape_string(htmlspecialchars(trim($_POST['onexamination'])));
$dischargereport->summary=$connect->real_escape_string(htmlspecialchars(trim($_POST['summary'])));
$dischargereport->diagnosis=$_POST['diagnosis'];
$dischargereport->diagnosisdetails=$connect->real_escape_string(trim(addslashes(strtoupper(implode(",",$dischargereport->diagnosis)))));


/*$x=$connect->query("SELECT ACCOUNT,GENDER,CLIENT,TIMESTAMPDIFF(YEAR,BIRTHDATE, DATE_ADD(NOW(), INTERVAL 10 HOUR)) AS YRS,
TIMESTAMPDIFF(MONTH,BIRTHDATE, DATE_ADD(NOW(), INTERVAL 10 HOUR)) % 12 AS  MONTHS FROM patientsrecord WHERE ACCOUNT =(SELECT PATIENTNUMBER FROM  patientdischargereport WHERE  ID ='$dischargereport->editid')  ");
while ($data = $x->fetch_object())
{
$age =$data->YRS.' YRS '.$data->MONTHS.' MONTHS';

}


*/
$x=$connect->query("UPDATE patientdischargereport SET  ADMISSIONDATE='$dischargereport->admissiondate', DISCHARGEDATE='$dischargereport->dischargedate', 
DIAGNOSIS='$dischargereport->diagnosisdetails', CHIEFCOMPLAIN='$dischargereport->chiefcomplain', PRESEMTINGILLNESS='$dischargereport->presentingillness', ONEXAMINATION='$dischargereport->onexamination',
 SUMMARY='$dischargereport->summary' WHERE  ID ='$dischargereport->editid'");
 $_SESSION['editid']=$_POST['editid'];
header("LOCATION:dischargereport.php");
?>

