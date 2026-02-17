<?php 
@session_start();

include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;} 

class bugdetails
{
public $module=null;
public $submodule=null;
public $details=null;
public $ticketnumber =null;
	
} 
$bugdetails =new bugdetails;
$bugdetails->module=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['module']))));
$bugdetails->submodule=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['submodule']))));
$bugdetails->details=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['details'])))));
$x=$connect2->query("SELECT IFNULL(MAX(REFFNUMBER),0)+1  AS REFFNUMBER FROM bugstrack ");
while ($data = $x->fetch_object())
{$bugdetails->ticketnumber=str_pad($data->REFFNUMBER, 5, '0', STR_PAD_LEFT);}
$connect2->query("INSERT INTO bugstrack(MODULE,SUBMODULE,BUG,REFFNUMBER,DATE) VALUES('$bugdetails->module','$bugdetails->submodule','$bugdetails->details','$bugdetails->ticketnumber',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR)) ");
$_SESSION['message']="BUG NOTIFICATION  REFF NUMBER".$bugdetails->ticketnumber;exit;
?>