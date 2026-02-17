<?php 

@session_start();
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="CONSULTATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  


class preoperativedetails 
{
public $operationcategory=null;
public $operationstate=null;
public $operationtechnique=null;
public $operationroute=null;
public $anasthesiatype=null;
public $ivtherapy=null;
public $postoperationcomplications=null;
public $patientnumber=null;
public $preoperativeremarks=null;
public $postoperativeremarks=null;

}


$preoperativedetails =new preoperativedetails;
$preoperativedetails->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));
$preoperativedetails->operationcategory=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['operationcategory']))));
$preoperativedetails->operationstate=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['operationstate']))));
$preoperativedetails->operationtechnique=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['operationtechnique']))));
$preoperativedetails->operationroute=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['operationroute']))));
$preoperativedetails->anasthesiatype=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['anasthesiatype']))));
$preoperativedetails->ivtherapy=implode(",",$_POST['ivtherapy']);
$preoperativedetails->postoperationcomplications=implode(",",$_POST['postoperationcomplications']);
$preoperativedetails->preoperativeremarks=$connect->real_escape_string(nl2br(htmlspecialchars(trim(addslashes($_POST['preoperativeremarks'])))));
$preoperativedetails->postoperativeremarks=$connect->real_escape_string(nl2br(htmlspecialchars(trim(addslashes($_POST['postoperativeremarks'])))));
$connect ->query(" INSERT INTO preoperativerecord (PATIENTNUMBER, OPERATIONCATEGORY, OPERATIONSTATE, OPERATIONTECHNIQUE, OPERATIONROUTE, ANASTHESIATYPE, IVTHERAPY,
 POSTOPERATIONCOMPLICATIONS,PREOPERATIVEREMARKS,POSTOPERATIVEREMARKS,DATE) 
VALUES ('$preoperativedetails->patientnumber', '$preoperativedetails->operationcategory', '$preoperativedetails->operationstate', '$preoperativedetails->operationtechnique', '$preoperativedetails->operationroute',
 '$preoperativedetails->anasthesiatype', '$preoperativedetails->ivtherapy', '$preoperativedetails->postoperationcomplications','$preoperativedetails->preoperativeremarks','$preoperativedetails->postoperativeremarks',DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");


 $connect->query(" INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR),'POSTED PRE OPERATIVE RECORDS ON PATEINT $preoperativedetails->patientnumber ',DATE_ADD(NOW(), INTERVAL 10 HOUR))");
$_SESSION['message']="POSTED";
?>