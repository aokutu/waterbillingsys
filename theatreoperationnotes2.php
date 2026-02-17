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

class theatreoperativenotes
{
public $patientnumber =null;
public $diagnosis =null;
public $date =null;
public $operation =null;
public $surgeon =null;
public $asetsurgeon =null;
public $scrubnurse =null;
public $anasthesist =null;
public $anasthesiatype =null;
public $insision =null;
public $operationprocedurenotes =null;	
}

$theatreoperativenotes = new theatreoperativenotes;
$theatreoperativenotes->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber'])))); 
$theatreoperativenotes->diagnosis=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['diagnosis'])))); 
$theatreoperativenotes->date=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['date'])))); 
$theatreoperativenotes->operation=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['operation'])))); 
$theatreoperativenotes->surgeon=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['surgeon'])))); 
$theatreoperativenotes->asetsurgeon=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['asetsurgeon'])))); 
$theatreoperativenotes->scrubnurse=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['scrubnurse'])))); 
$theatreoperativenotes->anasthesist=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['anasthesist'])))); 
$theatreoperativenotes->anasthesiatype=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['anasthesiatype'])))); 
$theatreoperativenotes->insision=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['insision'])))); 
$theatreoperativenotes->operationprocedurenotes=$connect->real_escape_string(nl2br(htmlspecialchars(trim(addslashes($_POST['operationprocedurenotes'])))));
$connect ->query("INSERT INTO theatreoperationnotes (PATIENTNUMBER, DIAGNOSIS, OPERATION, SURGEON, ASETSURGEON, SCRUBNURSE, ANASTHESIST, ANASTHESIATYPE,INSISION, OPERATIONPROCEDURENOTES, DATE) 
VALUES ('$theatreoperativenotes->patientnumber', '$theatreoperativenotes->diagnosis', 
'$theatreoperativenotes->operation', '$theatreoperativenotes->surgeon', '$theatreoperativenotes->asetsurgeon',
 '$theatreoperativenotes->scrubnurse', '$theatreoperativenotes->anasthesist', '$theatreoperativenotes->anasthesiatype','$theatreoperativenotes->insision','$theatreoperativenotes->operationprocedurenotes',
 '$theatreoperativenotes->date');"); 
 
 $connect->query(" INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR),'POSTED THEATRE OPERATION NOTES ON PATEINT $theatreoperativenotes->patientnumber ',DATE_ADD(NOW(), INTERVAL 10 HOUR))");
$_SESSION['message']="POSTED";

?>