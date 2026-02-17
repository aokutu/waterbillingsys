<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="IMAGING";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class deleteprocedure
{
public $proedureid=null;
public $image=null;	
}
$deleteprocedure=new deleteprocedure;
$deleteprocedure->proedureid=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['trackkey']))));
$deleteprocedure->image='xrayimages/'.$deleteprocedure->proedureid.'.png';
$connect ->query("INSERT INTO events(user,session,action,date) 
SELECT  CONCAT('$dbdetails->user'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT(' DELETE PROCEDURE REFF NUMBER ',TRACKKEY),DATE_ADD(NOW(), INTERVAL 10 HOUR) FROM imagingresults WHERE  TRACKKEY='$deleteprocedure->proedureid' LIMIT 1 ");
unlink($deleteprocedure->image);
$connect ->query(" DELETE FROM imagingresults WHERE  TRACKKEY='$deleteprocedure->proedureid'"); 
$_SESSION['message']='  DELETED PROCEDURE<br> REFF NO <br>'.$deleteprocedure->image;
?>