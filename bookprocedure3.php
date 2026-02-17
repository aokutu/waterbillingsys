<?php
@session_start();
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="LAB & IMAGING";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class bookprocedure
{
public $procedures=null;
public $patientnumber=null;
public $patientcategory=null;	
	
	
}

$bookprocedure=new bookprocedure;
$bookprocedure->procedures=$_POST['procedure'];
$bookprocedure->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['patientnumber']))));

$x=$connect->query("SELECT CLASS AS  CLS FROM  patientsrecord WHERE ACCOUNT='$bookprocedure->patientnumber' ");
while ($data = $x->fetch_object())
{
$bookprocedure->patientcategory=$data->CLS;	
	
}
foreach($bookprocedure->procedures as $key =>$data)
{

if(($bookprocedure->patientcategory=='WALK IN') OR ($bookprocedure->patientcategory=='CASH'))
{
$connect ->query("INSERT  INTO pendingsales(DETAILS,PRICE,QUANTITY,GROSSTOTAL,TOTAL,CASHIER,PATIENTNUMBER,DATE,STATUS)	SELECT DETAILS,PRICE,CONCAT(1),PRICE,PRICE,CONCAT('$dbdetails->user'),CONCAT('$bookprocedure->patientnumber'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('ISSUED')  FROM services WHERE DETAILS='$data' ");	
	
}
else if($bookprocedure->patientcategory=='INSUARANCE')
{
$connect ->query("INSERT  INTO pendingsales(DETAILS,PRICE,QUANTITY,GROSSTOTAL,TOTAL,CASHIER,PATIENTNUMBER,DATE,STATUS)	SELECT DETAILS,COPRATEPRICE,CONCAT(1),COPRATEPRICE,COPRATEPRICE,CONCAT('$dbdetails->user'),CONCAT('$bookprocedure->patientnumber'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('ISSUED')  FROM services WHERE DETAILS='$data' ");	
}
$connect ->query("INSERT INTO events(user,session,action,date) SELECT CONCAT('$dbdetails->user'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('BILLED $bookprocedure->patientnumber ',DETAILS),DATE_ADD(NOW(), INTERVAL 10 HOUR) FROM services WHERE DETAILS='$data' ");



}


$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$bookprocedure->patientnumber' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,URGENCY,BOOKEDIN,DATE)   
VALUES('$bookprocedure->patientnumber','LAB & IMAGING',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR))");
}
else
{
$connect->query("UPDATE consultation SET URGENCY='LAB & IMAGING' ,DATE=NOW(),BOOKEDIN=DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR)  WHERE PATIENTNUMBER ='$bookprocedure->patientnumber' ");	

}
$_SESSION['message']='PROCEDURES  BILLED';
?>