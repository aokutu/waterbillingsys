<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'ADD DEBT' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$account=$_POST['account'];  
@$debt=$_POST['debt'];@$installment=$_POST['installment']; @$period=$_POST['period']; 

$x="SELECT TIMESTAMPADD(MONTH,$period,(SELECT CURRENT_DATE)) date2";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$date2=$y['date2'];}}


if($debt !=$installment*$period){header("LOCATION:accessdenied4.php");exit;}	
$x="SELECT * FROM DEBTREGISTRY WHERE ACCOUNT ='$account' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1)
{
	
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'ADD DEBT' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
	
$x="INSERT INTO  DEBTREGISTRY (account,initialbal,installment,currentbal,period,date,date2,regdate,zone) 
VALUES('$account','$debt','$installment','$debt','$period',now(),'$date2',now(),'$zone')";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'REGISTERED NEW DEBT AGAINST  ACC .$account',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));	
header("LOCATION:newdebt.php");$_SESSION['message']='DEBT UPDATED'; exit;
}
header("LOCATION:newdebt.php");exit;
?>