<?php
@session_start();

$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="LAB & IMAGING";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class deletecompletebloodcount
{
public $procedureid=null;	
}
$deletecompletebloodcount=new deletecompletebloodcount;
$deletecompletebloodcount->procedureid=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['procedureid']))));



$connect ->query("INSERT INTO events(user,session,action,date) 
SELECT  CONCAT('$dbdetails->user'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('DELETE  COMPLETE BLOOD COUNT  RESULTS  FOR  PATIENT  NUMBER',PATIENTNUMBER),DATE_ADD(NOW(), INTERVAL 10 HOUR) FROM completebloodcountresults WHERE  TRACKKEY='$deletecompletebloodcount->procedureid' ");


$connect ->query(" DELETE FROM completebloodcountresults WHERE  TRACKKEY ='$deletecompletebloodcount->procedureid'");

$_SESSION['message']=$deletecompletebloodcount->procedureid.'RESULTS  DELETED';
?>