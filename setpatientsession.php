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

class patientdetails 
{
	
public $patientnumber=null;
public $patientclass=null; 

}

$patientdetails=new patientdetails;
$patientdetails->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['patientnumber']))));

$connect->query("UPDATE consultation  SET CHECKIN=DATE_ADD(CURRENT_TIME, INTERVAL 10 HOUR)  WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND  CHECKIN ='00:00:00' ");

$x=$connect->query("SELECT CLASS AS CLS  FROM patientsrecord WHERE ACCOUNT='$patientdetails->patientnumber' ");
while ($data = $x->fetch_object())
{$patientdetails->patientclass=$data->CLS; }

$x=$connect->query("SELECT  PATIENTNUMBER   FROM pendingsales WHERE DETAILS='CONSULTATION' AND PATIENTNUMBER='".$_SESSION['patientnumber']."'");
if(mysqli_num_rows($x)<1)
{
if(($patientdetails->patientclass=='WALK IN') OR ($patientdetails->patientclass=='CASH'))
{
$connect ->query("INSERT  INTO pendingsales(DETAILS,PRICE,QUANTITY,GROSSTOTAL,TOTAL,CASHIER,PATIENTNUMBER,DATE,STATUS)	SELECT DETAILS,PRICE,CONCAT(1),PRICE,PRICE,CONCAT('$dbdetails->user'),CONCAT('$patientdetails->patientnumber'),DATE_ADD(NOW(), INTERVAL 10 HOUR),CONCAT('ISSUED')  FROM services WHERE DETAILS='CONSULTATION' ");	
	
}
else if($patientdetails->patientclass=='INSUARANCE')
{
$connect ->query("INSERT  INTO pendingsales(DETAILS,PRICE,QUANTITY,GROSSTOTAL,TOTAL,CASHIER,PATIENTNUMBER,DATE,STATUS)	SELECT DETAILS,COPRATEPRICE,CONCAT(1),COPRATEPRICE,COPRATEPRICE,CONCAT('$dbdetails->user'),CONCAT('$patientdetails->patientnumber'),DATE_ADD(NOW(), INTERVAL 10 HOUR),CONCAT('ISSUED')  FROM services WHERE DETAILS='CONSULTATION' ");		
}	
} 
$_SESSION['patientnumber']=$patientdetails->patientnumber;
header("LOCATION:consultation.php");exit;
?>