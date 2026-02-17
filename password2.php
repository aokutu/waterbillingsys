<?php 
@session_start();
session_regenerate_id();
error_reporting(0);
set_time_limit(0);

class loggindetails
{
public $zone=null;
public $zonename=null;
public $accountstable=null;
public $billstable=null;
public $meterstable=null;
public $wateraccountstable=null;
public $statushistorytable=null;
public $account1=null;
public $account2 =null;
public $nonwaterbills=null;
public $mastermeters=null;
public $mastermeterbill=null;
public $date1 =null;
public $date2=null;
}


$loggindetails=new loggindetails;
$loggindetails->zone=$_SESSION['zone'];
$loggindetails->zonename=$_SESSION['zonename'];
$loggindetails->accountstable=$_SESSION['accountstable'];
$loggindetails->billstable=$_SESSION['billstable'];
$loggindetails->meterstable=$_SESSION['meterstable'];
$loggindetails->wateraccountstable=$_SESSION['wateraccountstable'];
$loggindetails->statushistorytable=$_SESSION['statushistorytable'];
$loggindetails->account1=$_SESSION['account1'];
$loggindetails->account2=$_SESSION['account2'];
$loggindetails->nonwaterbills=$_SESSION['nonwaterbills'];
$loggindetails->mastermeters=$_SESSION['mastermeters'];
$loggindetails->nonwaterbills=$_SESSION['nonwaterbills'];
$loggindetails->mastermeterbill=$_SESSION['mastermeterbill'];
$loggindetails->date1=$_SESSION['date1'];
$loggindetails->date2=$_SESSION['date2'];

class dbdetails
{
public $company=null;
public $user=null;
public $password=null;
}
$dbdetails =new dbdetails;
$dbdetails->company=$_SESSION['company'];
$dbdetails->user=$_SESSION['user'];
$dbdetails->password=$_SESSION['password'];
$connect=mysqli_connect('localhost','lawascoco','Stealmouse@355.',$company);
$connect2=mysqli_connect('localhost','lawascoco','Stealmouse@355.','lawascoco_Company');

if (mysqli_connect_errno()) {
 echo("Failed to connect, the error message is : ".
 mysqli_connect_error());
exit();}

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
//////////////////
if(empty($loggindetails->zone)){header("Location:loggin.php");exit;}
if (!isset($loggindetails->zone)){header("Location:loggin.php");exit;}
$x=isset($_SERVER['HTTP_REFERER']);
if($x==1){new mysqli("localhost",$dbdetails ->sudouser,$dbdetails ->sudopassword, "$myuser->company");}  
else {header("Location:accessdenied2.php");exit;}
error_reporting(0);
	

?>