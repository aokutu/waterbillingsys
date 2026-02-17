<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="INSUARANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class deleteinsuarance
{
public $insuarance=null;	
}
$deleteinsuarance=new deleteinsuarance;
$deleteinsuarance->insuarance=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['insuarance']))));

$connect ->query("INSERT INTO events(user,session,action,date) 
VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),'DELETE  SUPPLIER  $deleteinsuarance->insuarance ',DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");

 $connect ->query(" DELETE FROM insuarances WHERE insuarance='$deleteinsuarance->insuarance'");
 
$_SESSION['message']=$deleteinsuarance->insuarance.' DELETED';
?>