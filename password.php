<?php 
session_start();
session_regenerate_id();
if (session_status() == PHP_SESSION_ACTIVE) {}
else {
  header("LOCATION:accessdenied4.php");exit;   
}
error_reporting(0);
set_time_limit(0);
$zone=$_SESSION['zone'];
$zonename=$_SESSION['zonename'];
if($_SESSION['days'] <0)
{$_SESSION['message']="LICENSE EXPIRED";
session_unset();
$_SESSION['user']='no name';
session_destroy();
$_SESSION=array();
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: Mon,26 Jul 1980 05:00:00 GMT');
 header("LOCATION:trialexpired.php");exit;}
///////////////database details

$company=$_SESSION['company'];
$accountstable=$_SESSION['accountstable'];
$billstable=$_SESSION['billstable'];
$meterstable=$_SESSION['meterstable'];
$wateraccountstable=$_SESSION['wateraccountstable'];
$statushistorytable=$_SESSION['statushistorytable'];
$account1=$_SESSION['account1'];$account2=$_SESSION['account2'];
$nonwaterbills=$_SESSION['nonwaterbills'];
$mastermeters=$_SESSION['mastermeters'];
$mastermeterbill=$_SESSION['mastermeterbill'];
$date1=$_SESSION['date1'];$date2=$_SESSION['date2'];
$zonename=$_SESSION['zonename'];
$connect2=mysqli_connect('localhost','lawascoco','Stealmouse@355.','lawascoco_Company');

$connect=mysqli_connect('localhost','lawascoco','Stealmouse@355.',$company);


//////////////////
if(empty($zone)){header("Location:loggin.php");exit;}
if (!isset($zone)){header("Location:loggin.php");exit;}
$x=isset($_SERVER['HTTP_REFERER']);
if($x==1){$connect=mysqli_connect('localhost','lawascoco','Stealmouse@355.',$company);}  
else {header("Location:accessdenied2.php");exit;}
error_reporting(0);
 $user=$_SESSION['user'];	
 $password=$_SESSION['password'];
?>
<style>
table{font-size:65%;}
</style>