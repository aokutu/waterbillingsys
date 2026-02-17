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
}

$invoice =new invoice;
$invoice->invoicenumber=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['invoicenumber']))));
$x=$connect->query("SELECT INVOICENUMBER,PATIENTNUMBER FROM invoicedetails  WHERE INVOICENUMBER='$invoice->invoicenumber' ");
while ($data = $x->fetch_object())
{
$_SESSION['patientnumber']=$data->PATIENTNUMBER;
$_SESSION['invoicenumber']=$data->INVOICENUMBER;
}
header("LOCATION:patientsinvoice.php");exit;
?>