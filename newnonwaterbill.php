<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'BILLING'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$account=$_POST['account']; @$amount=$_POST['amount']; @$trdate=$_POST['trdate'];
@$billid=$_POST['billid']; 
$_SESSION['date1']=$trdate;$_SESSION['date2']=$trdate;
$x="SELECT ACCOUNT FROM $accountstable  WHERE ACCOUNT ='$account'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCOUNT MISSING"; header("LOCATION:accessdenied4.php");exit;}
if ($amount >0 )
{
$x="INSERT INTO $nonwaterbills(ACCOUNT,NAME,METERNUMBER,AMOUNT,DATE) SELECT CONCAT('$account'),NAME,(SELECT METERNUMBER FROM $accountstable WHERE ACCOUNT='$account' LIMIT 1),CONCAT('$amount'),CONCAT('$trdate') FROM paymentcode WHERE CODE='$billid'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}
else 
{
$x="INSERT INTO $nonwaterbills(ACCOUNT,NAME,METERNUMBER,AMOUNT,DATE) SELECT CONCAT('$account'),NAME,(SELECT METERNUMBER FROM $accountstable WHERE ACCOUNT='$account' LIMIT 1),CHARGES,CONCAT('$trdate') FROM paymentcode WHERE CODE='$billid'";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
	
}

$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('BILLED ',NAME,'ON ACC.','$account'),CURRENT_DATE FROM paymentcode WHERE CODE='$billid'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']="SUCCESS"; 

?>
