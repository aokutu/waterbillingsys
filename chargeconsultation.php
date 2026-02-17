<?php
@session_start();
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="ADMIN";
$x = $connect ->query(" SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'FINANCE'   
OR  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class bookprocedure
{
public $patientnumber=null;	
	
}

$bookprocedure=new bookprocedure;
$bookprocedure->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['patientnumber']))));

$x = $connect ->query("SELECT PATIENTNUMBER FROM pendingsales  WHERE  PATIENTNUMBER ='$bookprocedure->patientnumber' AND DETAILS REGEXP 'CONSULTATION' ");
if(mysqli_num_rows($x)>0)
{header("LOCATION:bookedconsultation.php");exit;}
$connect ->query("INSERT  INTO pendingsales(DETAILS,PRICE,QUANTITY,GROSSTOTAL,TOTAL,CASHIER,PATIENTNUMBER,STATUS,DATE)	SELECT DETAILS,PRICE,CONCAT(1),PRICE,PRICE,CONCAT('$dbdetails->user'),CONCAT('$bookprocedure->patientnumber'),CONCAT('ISSUED'),CURRENT_DATE  FROM SERVICES WHERE DETAILS REGEXP 'consultation' LIMIT 1");	

header("LOCATION:bookedconsultation.php");exit;
?>