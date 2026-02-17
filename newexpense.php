<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="FINANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND  ACCESS  REGEXP  '$dbdetails->userrights'   ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class miscexpence
{
public $expencename= null;
public $description	 = null;
public $paymentmode= null;
public $paymentreff= null;
public $paymentdate= null;
public $paidto= null;
public $details= null;
public $quantity= null;
public $unitprice= null;
public $paymentchannel=null;
public $paymentchanneltreff=null;
}
$miscexpence= new miscexpence;
$miscexpence->expencename=$connect->real_escape_string(trim(addslashes(strtoupper( $_POST['expencename']))));
$miscexpence->description=$connect->real_escape_string(trim(addslashes(strtoupper( $_POST['description']))));
$miscexpence->paymentmode=$connect->real_escape_string(trim(addslashes(strtoupper( $_POST['paymentmode']))));
$miscexpence->paymentreff=$connect->real_escape_string(trim(addslashes(strtoupper( $_POST['paymentreff']))));
$miscexpence->paymentdate=$connect->real_escape_string(trim(addslashes(strtoupper( $_POST['paymentdate']))));
$miscexpence->paidto=$connect->real_escape_string(trim(addslashes(strtoupper( $_POST['paidto']))));
$miscexpence->paymentchannel=$connect->real_escape_string(trim(addslashes(strtoupper( $_POST['paymentchannel']))));
$miscexpence->paymentchanneltreff=$connect->real_escape_string(trim(addslashes(strtoupper( $_POST['paymentchanneltreff']))));

 if (count($_POST['details']) === count($_POST['quantity']) && count($_POST['details']) === count($_POST['unitprice']))
	  {
        // Loop through each iteme
	for ($i = 0; $i < count($_POST['details']); $i++) 
	  {
$miscexpence->details = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['details'][$i]))));
$miscexpence->quantity = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['quantity'][$i]))));
$miscexpence->unitprice = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['unitprice'][$i]))));
$connect ->query(" INSERT INTO miscexpences (DESCRIPTION,UNITPRICE,QUANTITY, AMOUNT, PAYMENTMODE, PAYMENTREFF,PAYMENTCHANNEL,PAYMENTCHANNELREFF,PAIDTO, DATE) 
VALUES ('$miscexpence->details','$miscexpence->unitprice','$miscexpence->quantity',$miscexpence->unitprice*$miscexpence->quantity, '$miscexpence->paymentmode', '$miscexpence->paymentreff','$miscexpence->paymentchannel','$miscexpence->paymentchanneltreff','$miscexpence->paidto', '$miscexpence->paymentdate')");
  }
 $connect ->query("INSERT INTO events(USER,SESSION,ACTION,DATE) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),' POSTED EXPENCE  $miscexpence->paymentmode RFF NUMBER $miscexpence->paymentreff ',DATE_ADD(NOW(), INTERVAL 10 HOUR))");
 $_SESSION['message']=$miscexpence->expencename." POSTED"; 
  }
  else
{
 $_SESSION['message']='NOT  POSTED'; 
}
  ?>
  


