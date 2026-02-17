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

class nursingcareplandetails
{
public $admissiondate=null;
public $datetime=null;
public $time2=null;
public $diagnosis=null;
public $ward=null;
public $bednumber=null;
public $assesment=null;
public $nursingdiagnosis=null;
public $expectedoutcome=null;
public $intervention=null;
public $rationale=null;
public $implementation=null;
public $evaluation=null;
public $patientnumber=null;


}
$nursingcareplandetails =new nursingcareplandetails;
$nursingcareplandetails->admissiondate=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['admissiondate']))));
$nursingcareplandetails->datetime=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['datetime']))));
$nursingcareplandetails->diagnosis=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['diagnosis']))));
$nursingcareplandetails->ward=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['ward']))));
$nursingcareplandetails->bednumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['bednumber']))));
$nursingcareplandetails->assesment=$connect->real_escape_string(trim(addslashes($_POST['assesment'])));
$nursingcareplandetails->nursingdiagnosis=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['nursingdiagnosis']))));
$nursingcareplandetails->expectedoutcome=$connect->real_escape_string(trim(addslashes($_POST['expectedoutcome'])));
$nursingcareplandetails->intervention=$connect->real_escape_string(trim(addslashes($_POST['intervention'])));
$nursingcareplandetails->rationale=$connect->real_escape_string(trim(addslashes($_POST['rationale'])));
$nursingcareplandetails->implementation=$connect->real_escape_string(trim(addslashes($_POST['implementation'])));
$nursingcareplandetails->evaluation=$connect->real_escape_string(trim(addslashes($_POST['evaluation'])));
$nursingcareplandetails->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));

$connect ->query(" INSERT INTO nursecareplan (PATIENTNUMBER,ADMISSIONDATE, DATETIME, WARD, BEDNUMBER, DIAGNOSIS,
 ASSESMENT, NURSEDIAGNOSIS, EXPECTEDOUTCOME, INTERVENTIONS, RATIONALE, IMPLEMENTATION, EVALUATION, ATTENDANT) 
 VALUES ('$nursingcareplandetails->patientnumber','$nursingcareplandetails->admissiondate', '$nursingcareplandetails->datetime','$nursingcareplandetails->ward',
 '$nursingcareplandetails->bednumber', '$nursingcareplandetails->diagnosis', '$nursingcareplandetails->assesment','$nursingcareplandetails->nursingdiagnosis',
 '$nursingcareplandetails->expectedoutcome','$nursingcareplandetails->intervention', '$nursingcareplandetails->rationale', '$nursingcareplandetails->implementation', 
 '$nursingcareplandetails->evaluation', '$dbdetails->user') ");
;

 $_SESSION['message']=$nursingcareplandetails->patientnumber." NURSING PLAN POSTED ";
?>