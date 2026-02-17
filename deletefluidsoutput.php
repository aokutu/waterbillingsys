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
class deletefluidsoutput
{
public $deleteid =null;
}
$deletefluidsoutput =new deletefluidsoutput;
$deletefluidsoutput->deleteid=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['deleteid']))));
$connect ->query("INSERT INTO events(user,session,action,date) SELECT CONCAT('$dbdetails->user'),DATE_ADD(NOW(), INTERVAL 10 HOUR),CONCAT('DELETED FLUIDS OUTPUT REPORT  FOR   PATIENT ',PATIENTNUMBER),DATE_ADD(NOW(), INTERVAL 10 HOUR) 
FROM  fluidsoutput WHERE  ID='$deletefluidsoutput->deleteid'");
$connect ->query("DELETE FROM fluidsoutput WHERE  ID='$deletefluidsoutput->deleteid' ");
$_SESSION['message']='RECORD DELETED';
?>