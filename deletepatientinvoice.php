<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("interface.php");
include_once("password2.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'FINANCE'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class invoice 
{
public $invoicenumber=null;	
public $accessname=null;
public $accesspass=null;

}
$invoice =new invoice;
$invoice->invoicenumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['invoicenumber']))));
$invoice->accessname=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accessname']))));
$invoice->accesspass=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accesspass']))));





$x = $connect ->query("SELECT * FROM users  WHERE  name='$invoice->accessname' AND password='$invoice->accesspass' AND ACCESS REGEXP 'DELETE INVOICES' ");
if(mysqli_num_rows($x)>0)
{
$connect ->query("INSERT INTO events(user,session,action,date) 
VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('DELETED INVOICE NUMBER   $invoice->invoicenumber APPROVED BY $invoice->accessname'),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
$connect ->query("DELETE  FROM  invoicerecords  WHERE INVOICENUMBER='$invoice->invoicenumber' ");
$connect ->query("DELETE  FROM  invoicedetails  WHERE INVOICENUMBER='$invoice->invoicenumber' ");
$_SESSION['message']='INVOICE DELETED';exit;
}
else{
$_SESSION['message']="ACCESS  DENIED";exit;
} 

?>