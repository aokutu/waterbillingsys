<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="ADMIN";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


class postprocedureresults 
{
public $summary=null;
public $observation=null;
public $conclusion=null;
public $transactionid=null;
}

$postprocedureresults =new postprocedureresults;
$postprocedureresults->transactionid=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['transactionid']))));
$postprocedureresults->summary=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['summary']))));
$postprocedureresults->observation=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['observation'])))));
$postprocedureresults->conclusion=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['conclusion'])))));

$connect->query("  INSERT INTO procedurereports(PATIENTNUMBER,procedures,SUMMARY,OBSERVATION,CONCLUSION,ATTENDANT,DATE) SELECT PATIENTNUMBER,DETAILS,CONCAT('$postprocedureresults->summary'),CONCAT('$postprocedureresults->observation'),CONCAT('$postprocedureresults->conclusion'),CONCAT('$dbdetails->user'),DATE_ADD(NOW(), INTERVAL 10 HOUR)  FROM pendingsales WHERE ID=$postprocedureresults->transactionid   ");
$connect ->query("INSERT INTO events(user,session,action,date)  SELECT CONCAT('$dbdetails->user'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('POSTED ',DETAILS,' RESULTS FOR PATIENT ',PATIENTNUMBER),DATE_ADD(NOW(), INTERVAL 10 HOUR) FROM pendingsales WHERE ID=$postprocedureresults->transactionid ");
$connect ->query("UPDATE pendingsales SET STATUS='ISSUED' WHERE ID=$postprocedureresults->transactionid");
$connect ->query("UPDATE consultation SET  URGENCY='CONSULTATION' WHERE PATIENTNUMBER=(SELECT PATIENTNUMBER FROM pendingsales WHERE ID=$postprocedureresults->transactionid  ) ");

$x=$connect->query("SELECT PATIENTNUMBER FROM pendingsales WHERE ID=$postprocedureresults->transactionid ");
while ($data = $x->fetch_object())
{
$_SESSION['patientnumber']=$data->PATIENTNUMBER;
}
header("LOCATION:consultation.php");
?>