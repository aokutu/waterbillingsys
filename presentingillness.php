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

class presentingillness 
{
	
public $patientnumber=null;
public $complaint=null;

}

$presentingillness=new presentingillness;
$presentingillness->complaint=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['presentingillness'])))));
$presentingillness->patientnumber=$_SESSION['patientnumber'];

$connect ->query("INSERT INTO presentingillness(PATIENTNUMBER,PRESENTINGILLNESS,ATTENDANT,DATE) 
VALUES('$presentingillness->patientnumber','$presentingillness->complaint','$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR))");

$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('UPDATED  COMPLAINTS OF  PATIENT   MUMBER $presentingillness->patientnumber '),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
print $presentingillness->patientnumber;
$_SESSION['message']='PATIENTS  PRESENTING UPDATED'.$presentingillness->patientnumber;
?>
