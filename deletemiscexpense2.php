<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="FINANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND  ACCESS  REGEXP  '$dbdetails->userrights'   ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class  deletemiscexpence
{
public $deleteid=null;
public $accessname=null;
public $accesspass=null;
}
$deletemiscexpence =new deletemiscexpence;
$deletemiscexpence->deleteid=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['deleteid']))));
$deletemiscexpence->accessname=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accessname']))));
$deletemiscexpence->accesspass=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accesspass']))));

/*$x = $connect ->query("SELECT * FROM users  WHERE  name='$deletemiscexpence->accessname' AND password='$deletemiscexpence->accesspass'  ");
if(mysqli_num_rows($x)<1)
{$_SESSION['message']="ACCESS  DENIED";exit;} 
$connect ->query(" INSERT INTO  events(USER,SESSION,ACTION,DATE) SELECT CONCAT('$dbdetails->user'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('DELETED  MISCELLENIOUS EXPENCE ',EXPENSE,'  APPROVED BY  $deletemiscexpence->accessname'),DATE_ADD(NOW(), INTERVAL 10 HOUR)  FROM  miscexpences WHERE ID='$deletemiscexpence->deleteid' ");
*/
$connect ->query("DELETE  FROM `miscexpences` WHERE  ID =$deletemiscexpence->deleteid ");
$_SESSION['message']=$deletemiscexpence->deleteid."DELETED ";
?>