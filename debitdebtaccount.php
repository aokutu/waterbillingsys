<?php
@session_start();
$_SESSION['message']=null;
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="REGISTRATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'    ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class debtpayment
{
public $patientnumber =null;
public $amount =null;
public $paymode =null;
public $date =null;
}
$debtpayment =new debtpayment; 
$debtpayment->patientnumber =$connect->real_escape_string(trim(addslashes(strtoupper($_POST['patientnumber']))));
$debtpayment->amount =$connect->real_escape_string(trim(addslashes(strtoupper($_POST['amount']))));
$debtpayment->paymode =$connect->real_escape_string(trim(addslashes(strtoupper($_POST['paymode']))));
$debtpayment->date =$connect->real_escape_string(trim(addslashes(strtoupper($_POST['date']))));

$connect ->query(" INSERT INTO debtrecords (PATIENTNUMBER,DETAILS,AMOUNT,PAYMENTMODE,DATE) VALUES('$debtpayment->patientnumber',' DEBITED ',-1*$debtpayment->amount,'$debtpayment->paymode','$debtpayment->date' )  "); 
$connect ->query("INSERT INTO events(user,session,action,date)  VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),'DEBITED DEBT WORTH $debtpayment->amount INTO PATIENT NUMBER $debtpayment->patientnumber ',DATE_ADD(NOW(), INTERVAL 10 HOUR))"); 



$_SESSION['message']=$debtpayment->date."POSTED";
?>