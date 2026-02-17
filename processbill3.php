<?php
@session_start();
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="FINANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights'  
OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'LAB & IMAGING' 
OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'PHAMARCY'");
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
public $patientnumber=null;
}

$processbill =new processbill;
$processbill->totalcharges=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['totalcharges']))));
$processbill->discount=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['discount']))));
$processbill->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));
$processbill->actualcharges=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['actualcharges']))));
$processbill->document=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['document']))));
$processbill->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));

$x=$connect->query("SELECT CLASS  FROM patientsrecord   WHERE ACCOUNT ='$processbill->patientnumber' ");
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

$connect->query("INSERT INTO receiptrecords(RECEIPTNUMBER,PAYMODE,PAYMENTREFF,AMOUNT,TOTALCHARGES,DATE,CASHIER,PATIENTNUMBER) 
	SELECT CONCAT('$processbill->receiptnumber'),CONCAT('$processbill->paymode'),CONCAT('$processbill->paymentreff'),CONCAT('$processbill->totalcharges'),CONCAT('$processbill->actualcharges'),DATE_ADD(NOW(), INTERVAL 10 HOUR),CONCAT('$dbdetails->user'),CONCAT('$processbill->patientnumber')	
	FROM pendingsales WHERE  PATIENTNUMBER='$processbill->patientnumber' AND  STATUS='ISSUED' GROUP   BY   PATIENTNUMBER ");	
$processbill->receiptnumber=str_pad($processbill->receiptnumber, 5, "0", STR_PAD_LEFT);
print $processbill->receiptnumber;

$connect->query(" INSERT INTO receiptsdetails(DETAILS,UNIT,PRICE,QUANTITY,TOTAL,GROSSTOTAL,CASHIER,DATE,RECEIPTNUMBER,PATIENTNUMBER) 
	SELECT DETAILS,UNIT,PRICE,QUANTITY,TOTAL,GROSSTOTAL,CASHIER,DATE,CONCAT('$processbill->receiptnumber'),CONCAT('$processbill->patientnumber') 
	FROM pendingsales WHERE PATIENTNUMBER='$processbill->patientnumber'  AND pendingsales.STATUS='ISSUED' ");	


$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR),CONCAT('GENERATED RECEIPT NUMBER   $processbill->receiptnumber ON  $processbill->patientnumber ACCOUNT'),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
$connect ->query("DELETE  FROM pendingsales WHERE PATIENTNUMBER='$processbill->patientnumber'  AND pendingsales.STATUS='ISSUED'  ");
$connect ->query(" DELETE FROM  inpatientsrecord  WHERE  PATIENTNUMBER='$processbill->patientnumber' ");

$_SESSION['receiptnumber']=$processbill->receiptnumber;
$_SESSION['patientnumber']=$processbill->patientnumber;
header("LOCATION:patientsreceipt.php"); 
exit;

/*

if($processbill->discount>0)
{
	$processbill->discount=-1*$processbill->discount;
	$connect->query(" INSERT INTO receiptsdetails(DETAILS,GROSSTOTAL,CASHIER,DATE,RECEIPTNUMBER,PATIENTNUMBER) 
	VALUES('DISCOUNT','$processbill->discount','$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR),'$processbill->receiptnumber','$processbill->patientnumber') ");
	
}

*/
}


if($processbill->document=='INVOICE')
{

$x=$connect->query("SELECT IFNULL(MAX(INVOICENUMBER)+1,1) AS INVOICE   FROM invoicerecords  ");
while ($data = $x->fetch_object())
{ $processbill->invoicenumber=$data->INVOICE; }


$connect->query("INSERT INTO invoicerecords(INVOICENUMBER,PAYMODE,PAYMENTREFF,AMOUNT,TOTALCHARGES,DATE,CASHIER,CLIENTNUMBER) 
	SELECT CONCAT('$processbill->invoicenumber'),CONCAT('$processbill->paymode'),CONCAT('$processbill->paymentreff'),CONCAT('$processbill->totalcharges'),CONCAT('$processbill->actualcharges'),DATE_ADD(NOW(), INTERVAL 10 HOUR),CONCAT('$dbdetails->user'),CONCAT('$processbill->patientnumber')	
	FROM pendingsales WHERE  PATIENTNUMBER='$processbill->patientnumber' AND  STATUS='ISSUED' GROUP   BY   PATIENTNUMBER ");	
$processbill->invoicenumber=str_pad($processbill->invoicenumber, 5, "0", STR_PAD_LEFT);

$connect->query(" INSERT INTO invoicedetails(DETAILS,UNIT,PRICE,QUANTITY,TOTAL,GROSSTOTAL,CASHIER,DATE,INVOICENUMBER,PATIENTNUMBER) 
	SELECT DETAILS,UNIT,PRICE,QUANTITY,TOTAL,GROSSTOTAL,CASHIER,DATE,CONCAT('$processbill->invoicenumber'),CONCAT('$processbill->patientnumber') 
	FROM pendingsales WHERE PATIENTNUMBER='$processbill->patientnumber'  AND pendingsales.STATUS='ISSUED' ");	


$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR),CONCAT('GENERATED INVOICE NUMBER   $processbill->invoicenumber ON  $processbill->patientnumber ACCOUNT'),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
$connect ->query("DELETE  FROM pendingsales WHERE PATIENTNUMBER='$processbill->patientnumber'  AND pendingsales.STATUS='ISSUED'  ");
$connect ->query(" DELETE FROM  inpatientsrecord  WHERE  PATIENTNUMBER='$processbill->patientnumber' ");

$_SESSION['invoicenumber']=$processbill->invoicenumber;
$_SESSION['patientnumber']=$processbill->patientnumber;
header("LOCATION:patientsinvoice.php"); exit;
exit;

/*

if($processbill->discount>0)
{
	$processbill->discount=-1*$processbill->discount;
	$connect->query(" INSERT INTO receiptsdetails(DETAILS,GROSSTOTAL,CASHIER,DATE,INVOICENUMBER,CLIENTNUMBER) 
	VALUES('DISCOUNT','$processbill->discount','$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR),'$processbill->invoicenumber','$processbill->patientnumber') ");
	
}



header("LOCATION:patientsinvoice.php"); exit;
*/
}
//header("LOCATION:treatmentreport.php"); exit;
?>