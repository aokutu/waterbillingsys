<?php
@session_start();
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="consultation";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights'  OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'LAB & IMAGING'");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  
////////////////////////
class bookprocedure
{
public $procedures=null;
public $patientnumber=null;
public $patientcategory=null;
public $frequency=null;
	
}
$bookprocedure=new bookprocedure;
$bookprocedure->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));


$x=$connect->query("SELECT CLASS AS  CLS FROM  patientsrecord WHERE ACCOUNT='$bookprocedure->patientnumber' ");
while ($data = $x->fetch_object())
{
$bookprocedure->patientcategory=$data->CLS;	
	
}




  if (count($_POST['procedure']) === count($_POST['frequency']) ) 
	{
        // Loop through each item
	for ($i = 0; $i < count($_POST['procedure']); $i++) 
	{
$bookprocedure->procedures = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['procedure'][$i]))));
$bookprocedure->frequency = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['frequency'][$i]))));

if(($bookprocedure->patientcategory=='WALK IN') OR ($bookprocedure->patientcategory=='CASH'))
{
$connect ->query("INSERT  INTO pendingsales(DETAILS,PRICE,QUANTITY,GROSSTOTAL,TOTAL,CASHIER,PATIENTNUMBER,DATE)	
SELECT DETAILS,PRICE,CONCAT('$bookprocedure->frequency'),PRICE*$bookprocedure->frequency,PRICE*$bookprocedure->frequency,CONCAT('$dbdetails->user'),CONCAT('$bookprocedure->patientnumber'),DATE_ADD(NOW(), INTERVAL 10 HOUR)  FROM services WHERE DETAILS='$bookprocedure->procedures' ");	
	
}

else if($bookprocedure->patientcategory=='INSUARANCE')
{
$connect ->query("INSERT  INTO pendingsales(DETAILS,PRICE,QUANTITY,GROSSTOTAL,TOTAL,CASHIER,PATIENTNUMBER,DATE)	
SELECT DETAILS,COPRATEPRICE,CONCAT('$bookprocedure->frequency'),CONCAT(COPRATEPRICE*$bookprocedure->frequency),CONCAT(COPRATEPRICE*$bookprocedure->frequency),CONCAT('$dbdetails->user'),CONCAT('$bookprocedure->patientnumber'),DATE_ADD(NOW(), INTERVAL 10 HOUR)  FROM services WHERE DETAILS='$bookprocedure->procedures' ");		

}
$connect ->query("INSERT INTO events(user,session,action,date) SELECT CONCAT('$dbdetails->user'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('BILLED $billing->patientnumber ',DETAILS),DATE_ADD(NOW(), INTERVAL 10 HOUR) FROM services WHERE DETAILS='$bookprocedure->procedures' ");

print $bookprocedure->frequency;
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

	
	}
	
$_SESSION['message']='procedures BOOKED';
?>