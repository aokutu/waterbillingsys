<?php
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="CONSULTATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class vitalsid
{
public $id=null;	
}

$vitalsid =new vitalsid;
$vitalsid->id=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['vitalsid']))));
print $vitalsid->id;
$connect->query("DELETE FROM vitalsreport WHERE ID='$vitalsid->id' ");
header("LOCATION:consultation.php");
 

?>