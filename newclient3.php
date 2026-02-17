<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
require_once 'backup/vendor/autoload.php'; // Include Dompdf autoload file
use Dompdf\Dompdf;
use Dompdf\Options;

include_once("password.php");
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];

@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'NEW CONNECTION'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}$class=$_POST['class'];
@$account=$_POST['account'];$account=trim(strtoupper(addslashes($account))); 
@$meternumber=trim(strtoupper(addslashes($_POST['meternumber'])));
$ffdslash=strstr($meternumber,'/');if($ffdslash !=null ){$_SESSION['message']="INVALID METER NUMBER";exit;}
@$serialnumber=$_POST['serialnumber'];$serialnumber=trim(strtoupper(addslashes($serialnumber)));
@$size=$_POST['metersize'];$size=trim(strtoupper(addslashes($size)));
@$meterreading=$_POST['meterreading'];$meterreading=trim(strtoupper(addslashes($meterreading)));
@$status=$_POST['status'];$status=trim(strtoupper(addslashes($status)));
@$name=$_POST['name'];$name=trim(strtoupper(addslashes($name))); 
$_SESSION['meter']=$meter;
@$status=$_POST['status']; @$bill=$_POST['bill'];
@$contact=$_POST['contact'];$contact=addslashes($contact);if(empty($contact)){$contact="";}
@$charges=addslashes($_POST['charges']);
@$idnumber=trim(strtoupper(addslashes($_POST['idnumber'])));if(empty($idnumber)){$idnumber="";}
@$location=trim(strtoupper(addslashes($_POST['location'])));
@$plotnumber=trim(strtoupper(addslashes($_POST['plotnumber'])));
@$deposit=trim(strtoupper(addslashes($_POST['deposit'])));
@$meterstatus=trim(strtoupper(addslashes($_POST['meterstatus'])));
@$email=$_POST['email'];if(empty($email)){$email="";}

$x="SELECT * FROM $accountstable  WHERE   account='$account'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){header("LOCATION:newaccount.php");exit;}

if (($account !=NULL)&&($name !=NULL))
{
	
	
	
	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstablex='accounts'.$i;$meterstablex='meters'.$i;	
$b="SELECT * FROM $accountstablex WHERE ACCOUNT='$account'";
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){header("LOCATION:newaccount.php");exit;}

$n="SELECT METERNUMBER FROM $meterstablex WHERE ACCOUNT ='$account'  AND ACCOUNT !='NOT INSTALLED'   ";
$n=mysqli_query($connect,$n)or die(mysqli_error($connect));
		if(mysqli_num_rows($n)>0)
		{header("LOCATION:newaccount.php");exit;}


	
		}
		}
$x="SELECT  MAX(id) FROM   $accountstable";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
{ $id=$y['MAX(id)']+1;	}}
	
$x="INSERT INTO $accountstable(id,client,location,status,date,user,class,account,contact,idnumber,meternumber,clientemail,plotnumber)
 VALUES($id,'$name','$location','$status',DATE_ADD(NOW(), INTERVAL 7 HOUR),'$user','$class','$account','$contact','$idnumber','NOT INSTALLED','$email','$plotnumber')";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO statustrail(zone,account,status,date) VALUES('$zone','$account','NEW CONNECTION',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$b)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'CREATED   NEW ACCOUNT $account',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['account']=$account;
header("LOCATION:newaccount.php");
 }

header("LOCATION:newaccount.php");exit; 

?>