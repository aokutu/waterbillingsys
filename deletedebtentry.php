<?php 
@session_start();
$_SESSION['message']=null;
include_once("password2.php");
include_once("interface2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="REGISTRATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'    ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIEDx"; header("LOCATION:accessdenied4.php");exit;}

class debtdetails
{
public $debtentryid =null;
public $accessname	=null;
public $accesspass	=null;

}
$debtdetails =new debtdetails; 
$debtdetails->debtentryid=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['debtentryid']))));
$debtdetails->accessname=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accessname']))));
$debtdetails->accesspass=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accesspass']))));

$x = $connect ->query("SELECT * FROM users  WHERE  name='$debtdetails->accessname' AND password='$debtdetails->accesspass'  AND  ACCESS REGEXP 'FINANCE'  ");
if(mysqli_num_rows($x)>0)
{
$connect ->query("DELETE FROM debtrecords WHERE ID=$debtdetails->debtentryid ");
 $_SESSION['message']='DELETED ';
exit; 
	
}
else 
{
 $_SESSION['message']='ACCESS DENIED';
exit;
}
?>