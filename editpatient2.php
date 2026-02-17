<?php 
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="REGISTRATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class patientdetails extends dbdetails
{
public $patientnumber=null;
public $name=null;
public $contact=null;
public $birthdate=null;
public $gender=null;
public $residence=null;	
public $idnumber=null;
public $nextofkin=null;
public $nextofkincontact=null;
public $patienttype=null;
public $insuarance=null;
public $refferencenumber=null;
public $nextofkinrelation=null;
}

$patientdetails=new patientdetails;
$patientdetails->name=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['name']))));
$patientdetails->contact=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['contact']))));
$patientdetails->birthdate=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['birthdate']))));
$patientdetails->idnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['idnumber']))));
$patientdetails->nextofkin=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['nextofkin']))));
$patientdetails->nextofkincontact=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['nextofkincontact']))));
$patientdetails->patienttype=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['patienttype']))));
$patientdetails->refferencenumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['refferencenumber']))));
$patientdetails->insuarance=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['insuarance']))));
$patientdetails->residence=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['residence']))));
$patientdetails->gender=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['gender']))));
$patientdetails->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['patientnumber']))));
$patientdetails->nextofkinrelation=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['nextofkinrelation']))));
$pati=str_pad($patientdetails->patientnumber, 5, '0', STR_PAD_LEFT);
$connect ->query("UPDATE patientsrecord SET NEXTOFKINRELATION='$patientdetails->nextofkinrelation',CLIENT='$patientdetails->name' ,CONTACT='$patientdetails->contact',BIRTHDATE='$patientdetails->birthdate' ,IDNUMBER='$patientdetails->idnumber',CLASS='$patientdetails->patienttype',NEXTKIN='$patientdetails->nextofkin',NEXTKINCONTACT='$patientdetails->nextofkincontact',INSUARANCE='$patientdetails->insuarance',
GENDER='$patientdetails->gender',INSUARANCENUMBER='$patientdetails->refferencenumber',LOCATION='$patientdetails->residence'  WHERE ACCOUNT ='$patientdetails->patientnumber' ");
$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('UPDATED DETAILS OF CLIENT  NUMBER  $patientdetails->patientnumber'),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
header("LOCATION:patientsregistry.php");exit;

?>
