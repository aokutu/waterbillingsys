<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="PHAMARCY";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND  ACCESS  REGEXP  '$dbdetails->userrights'   ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class deletephamarcypatient
{
public $patientnumber =null;

}
$deletephamarcypatient = new deletephamarcypatient;
$deletephamarcypatient->patientnumber =$connect->real_escape_string(trim(addslashes(strtoupper($_POST['patientnumber']))));
$connect ->query("DELETE FROM treatmentreport WHERE PATIENTNUMBER ='$deletephamarcypatient->patientnumber'  ");
$connect->query("UPDATE consultation SET URGENCY='REGISTRY DESK' ,DATE=NOW(),BOOKEDIN=DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR)  WHERE PATIENTNUMBER ='$deletephamarcypatient->patientnumber' ");	
$_SESSION['message']="PATIENT ".$deletephamarcypatient->patientnumber."<br>DELETED ";
?>