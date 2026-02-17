<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("interface.php");
include_once("password2.php");

$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

print $_SESSION['receiptnumber']."<br>";
class receipt 
{
public $receiptnumber=null;	
public $sessionreceiptnumber=null;
}

$receipt =new receipt;
$receipt->receiptnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['receiptnumber']))));
$receipt->sessionreceiptnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['sessionreceiptnumber']))));
$x=$connect->query("SELECT PATIENTNUMBER,RECEIPTNUMBER FROM receiptsdetails  WHERE RECEIPTNUMBER='$receipt->receiptnumber' ");
while ($data = $x->fetch_object())
{
$_SESSION['patientnumber']=$data->PATIENTNUMBER;
$_SESSION['receiptnumber']=$data->RECEIPTNUMBER;
header("LOCATION:patientsreceipt.php");exit;
}

$x=$connect->query("SELECT PATIENTNUMBER,RECEIPTNUMBER FROM receiptsdetails  WHERE RECEIPTNUMBER='$receipt->sessionreceiptnumber' ");
while ($data = $x->fetch_object())
{
$_SESSION['patientnumber']=$data->PATIENTNUMBER;
$_SESSION['receiptnumber']=$data->RECEIPTNUMBER;
header("LOCATION:patientsreceipt.php");exit;
}
?>