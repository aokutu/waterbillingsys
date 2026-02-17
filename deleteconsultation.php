<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="CONSULTATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' 
OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'NURSE'");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class deleteconsultation extends dbdetails
{
public $id=null;	
}

$deleteconsultation =new deleteconsultation;
$deleteconsultation->id=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['id']))));



$connect ->query("INSERT INTO events(user,session,action,date)  
SELECT CONCAT('$dbdetails->user'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('CLEARED PATIENT NUMBER ',PATIENTNUMBER,' FROM ',URGENCY),DATE_ADD(NOW(), INTERVAL 10 HOUR) FROM  
consultation WHERE ID='$deleteconsultation->id' ");


$connect->query("DELETE FROM consultation WHERE ID='$deleteconsultation->id' ");
print $deleteconsultation->id;
header("LOCATION:bookedconsultation.php");


?>