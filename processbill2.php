<?php

@session_start();
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="FINANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' 
OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'PHAMARCY'  
OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'LAB & IMAGING' 
OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'POINT OF SALE' 
");

if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


class processbill extends dbdetails
{
	
public $totalcharges=null;
public $discount=null;
public $actualcharges=null;
public $clienttype=null;
public $paymode=null;
public $paymentreff=null;
public $receiptnumber=null;
public $vat=null;
public $document=null;
public $clientnumber=null;
public $bedcharges=null;
public $days=null;
public $admissiondate=null;
public $dischargedate=null;
public $billdate=null;
}

$processbill =new processbill;
$processbill->totalcharges=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['totalcharges']))));
$processbill->discount=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['discount']))));
$processbill->clientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));
$processbill->actualcharges=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['actualcharges']))));
$processbill->document=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['document']))));
$processbill->bedcharges=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['bedcharges']))));
$processbill->days=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['days']))));
$processbill->admissiondate=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['admissiondate']))));
$processbill->dischargedate=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['dischargedate']))));
$processbill->billdate=$_POST['billdate'];

$_SESSION['patientnumber']=$processbill->clientnumber;

$x=$connect->query("SELECT CLASS  FROM patientsrecord   WHERE ACCOUNT ='$processbill->clientnumber' ");
while ($data = $x->fetch_object())
{ $processbill->clienttype=$data->CLASS;}


$processbill->paymode=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['paymentmode']))));
$processbill->paymentreff=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['paymentreffnumber']))));
$processbill->vat=0;


if($processbill->document=='RECEIPT')
{
	
	
$x=$connect->query("SELECT IFNULL(MAX(RECEIPTNUMBER)+1,1) AS RECEIPT   FROM receiptrecords  ");
while ($data = $x->fetch_object())
{ $processbill->receiptnumber=$data->RECEIPT; }


$connect->query("INSERT INTO receiptrecords(RECEIPTNUMBER,PAYMODE,PAYMENTREFF,AMOUNT,DISCOUNT,TAX,TOTALCHARGES,DATE,CASHIER,PATIENTNUMBER) 
	SELECT CONCAT('$processbill->receiptnumber'),CONCAT('$processbill->paymode'),CONCAT('$processbill->paymentreff'),CONCAT('$processbill->totalcharges'),CONCAT('$processbill->discount'),CONCAT('$processbill->vat'),CONCAT('$processbill->actualcharges'),'$processbill->billdate',CONCAT('$dbdetails->user'),CONCAT('$processbill->clientnumber')	FROM pendingsales  WHERE PATIENTNUMBER='".$_SESSION['patientnumber']."'  GROUP BY PATIENTNUMBER ");	
$processbill->receiptnumber=str_pad($processbill->receiptnumber, 5, "0", STR_PAD_LEFT);

$connect->query(" INSERT INTO receiptsdetails(DETAILS,UNIT,PRICE,QUANTITY,TOTAL,TAXES,GROSSTOTAL,CASHIER,DATE,RECEIPTNUMBER,PATIENTNUMBER) 
	SELECT DETAILS,UNIT,PRICE,QUANTITY,TOTAL,TAXES,GROSSTOTAL,CASHIER,CONCAT('$processbill->billdate'),CONCAT('$processbill->receiptnumber'),CONCAT('$processbill->clientnumber') FROM pendingsales WHERE PATIENTNUMBER='".$_SESSION['patientnumber']."'  ");	

if(($processbill->bedcharges>0) && ($processbill->days>0) && ($processbill->document=='RECEIPT'))
{
$connect->query(" INSERT INTO receiptsdetails(DETAILS,TOTAL,GROSSTOTAL,QUANTITY,PRICE,CASHIER,DATE,RECEIPTNUMBER,PATIENTNUMBER)  
 VALUES('BED CHARGES',$processbill->bedcharges*$processbill->days,$processbill->bedcharges*$processbill->days,$processbill->days,$processbill->bedcharges,'$dbdetails->user','$processbill->billdate','$processbill->receiptnumber','$processbill->clientnumber' ) ");
$connect->query("UPDATE  inpatientsrecord SET ADMISSIONDATE=DATE_ADD(NOW(), INTERVAL 10 HOUR)  WHERE PATIENTNUMBER='$processbill->clientnumber' ");
		
}



if($processbill->discount>0)
{
	$processbill->discount=-1*$processbill->discount;
	$connect->query(" INSERT INTO receiptsdetails(DETAILS,GROSSTOTAL,CASHIER,DATE,RECEIPTNUMBER,PATIENTNUMBER) 
	VALUES('DISCOUNT','$processbill->discount','$dbdetails->user','$processbill->billdate','$processbill->receiptnumber','$processbill->clientnumber') ");	
}



$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('GENERATED RECEIPT NUMBER   $processbill->receiptnumber ON  $processbill->clientnumber ACCOUNT'),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
$connect ->query("DELETE  FROM pendingsales WHERE PATIENTNUMBER='".$_SESSION['patientnumber']."'  ");
$_SESSION['receiptnumber']=$processbill->receiptnumber;
header("LOCATION:patientsreceipt.php"); exit;
}


if(($processbill->document=='INVOICE')&& ( !is_null($processbill->clientnumber)))
{
$x=$connect->query("SELECT IFNULL(MAX(INVOICENUMBER)+1,1) AS RECEIPT   FROM invoicerecords  ");
while ($data = $x->fetch_object())
{ $processbill->receiptnumber=$data->RECEIPT; }

$connect->query("INSERT INTO invoicerecords(INVOICENUMBER,PAYMODE,PAYMENTREFF,AMOUNT,DISCOUNT,TAX,TOTALCHARGES,DATE,CASHIER,CLIENTNUMBER,INSUARANCE,INSUARANCEREFF,PATIENTCLASS,BIRTHDATE,ADMISSIONDATE,DISCHARGEDATE) 
	SELECT CONCAT('$processbill->receiptnumber'),CONCAT('$processbill->paymode'),CONCAT('$processbill->paymentreff'),CONCAT('$processbill->totalcharges'),CONCAT('$processbill->discount'),CONCAT('$processbill->vat'),CONCAT('$processbill->actualcharges'),'$processbill->billdate',CONCAT('$dbdetails->user'),CONCAT('$processbill->clientnumber'),INSUARANCE,INSUARANCENUMBER,CLASS,BIRTHDATE,CONCAT('$processbill->admissiondate'),CONCAT('$processbill->dischargedate')	FROM pendingsales,patientsrecord  WHERE PATIENTNUMBER='".$_SESSION['patientnumber']."'   AND pendingsales.PATIENTNUMBER=patientsrecord.ACCOUNT GROUP BY PATIENTNUMBER ");	
$processbill->receiptnumber=str_pad($processbill->receiptnumber, 5, "0", STR_PAD_LEFT);


 $connect->query(" INSERT INTO invoicedetails(DETAILS,UNIT,PRICE,QUANTITY,TOTAL,TAXES,GROSSTOTAL,CASHIER,DATE,INVOICENUMBER,PATIENTNUMBER) 
	SELECT DETAILS,UNIT,PRICE,QUANTITY,TOTAL,TAXES,GROSSTOTAL,CASHIER,CONCAT('$processbill->billdate'),CONCAT('$processbill->receiptnumber'),CONCAT('$processbill->clientnumber') FROM pendingsales WHERE PATIENTNUMBER='".$_SESSION['patientnumber']."'    ");	

if(($processbill->bedcharges>0) && ($processbill->days>0) && ($processbill->document=='INVOICE') )
{
	
$connect->query(" INSERT INTO invoicedetails(DETAILS,TOTAL,GROSSTOTAL,QUANTITY,PRICE,CASHIER,DATE,INVOICENUMBER,PATIENTNUMBER)  
 VALUES('BED CHARGES',$processbill->bedcharges*$processbill->days,$processbill->bedcharges*$processbill->days,$processbill->days,$processbill->bedcharges,'$dbdetails->user','$processbill->billdate','$processbill->receiptnumber','$processbill->clientnumber' ) ");
$connect->query("UPDATE  inpatientsrecord SET ADMISSIONDATE=DATE_ADD(NOW(), INTERVAL 10 HOUR)  WHERE PATIENTNUMBER='$processbill->clientnumber' ");

		
}

if($processbill->discount>0)
{
	$processbill->discount=-1*$processbill->discount;
	$connect->query(" INSERT INTO invoicedetails(DETAILS,GROSSTOTAL,CASHIER,DATE,INVOICENUMBER) 
	VALUES('DISCOUNT','$processbill->discount','$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR),'$processbill->receiptnumber') ");	
}
$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('GENERATED INVOICE NUMBER   $processbill->receiptnumber ON $processbill->clientnumber ACCOUNT '),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
$connect ->query("DELETE  FROM pendingsales WHERE PATIENTNUMBER='".$_SESSION['patientnumber']."'  ");
$_SESSION['invoicenumber']=$processbill->receiptnumber;
header("LOCATION:patientsinvoice.php"); exit;

}
header("LOCATION:pointofsale.php"); exit;
?>