<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("interface.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="FINANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  


class paymentdetails 
{
public $companyname=null;
public $amount=null;
public $paymentmethod=null;
public $paymentreff=null;
public $invoicenumber=null;	
public $paydate=null;
}
$paymentdetails=new paymentdetails;
$paymentdetails->companyname=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['companyname']))));
$paymentdetails->amount=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['amount']))));
$paymentdetails->paymentmethod=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['paymentmethod']))));
$paymentdetails->paymentreff=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['paymentreff']))));
$paymentdetails->invoicenumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['invoicenumber']))));
$paymentdetails->paydate=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['date']))));

$connect ->query(" INSERT   INTO insuarancepayment(INSUARANCE,INVOICENUMBER,AMOUNT,PAYMENTMODE,PAYMENTREFF,DATE) 
VALUES('$paymentdetails->companyname','$paymentdetails->invoicenumber','$paymentdetails->amount','$paymentdetails->paymentmethod','$paymentdetails->paymentreff','$paymentdetails->paydate')");
$paymentdetails->amount=number_format($paymentdetails->amount,2);
$connect ->query("INSERT INTO events(USER,SESSION,ACTION,DATE) 
VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),'ENTERED  INSUARANCE  PAYMENT FROM   $paymentdetails->companyname  WORTH  $paymentdetails->amount ',DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
$_SESSION['message']=' PAYMENT POSTED';exit;



?>
