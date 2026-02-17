<?php
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="ADMIN";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class deletemedicalhistory 
{
public $id=null;	
}

$deletemedicalhistory =new deletemedicalhistory;
$deletemedicalhistory->id=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['id']))));
$connect->query("DELETE FROM patientcomplaints WHERE ID='$deletemedicalhistory->id' ");
header("LOCATION:consultation.php"); 
 


?>