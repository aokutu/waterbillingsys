<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="FINANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
class deletependingtransaction 
{
public $id=null;	
}

$deletependingtransaction =new deletependingtransaction;
$deletependingtransaction->id=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['id']))));
$connect ->query("INSERT INTO events(user,session,action,date) 
SELECT CONCAT('$dbdetails->user'),CURRENT_TIMESTAMP,CONCAT('DELETED ',DETAILS,' FROM PATIENT ',PATIENTNUMBER,' PENDING TRANACTION '),CURRENT_DATE FROM  pendingsales WHERE  ID='$deletependingtransaction->id' ");

$connect->query("DELETE FROM pendingsales  WHERE ID='$deletependingtransaction->id' ");
header("LOCATION:pendingtransactions.php");
?>