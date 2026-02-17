<?php
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'      AND  ACCESS  REGEXP  'TASKS AUTOMATION'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$action=$_POST['action'];@$smsemail=$_POST['SMSEMAIL'];@$balance=$_POST['BALANCE'];@$backup=$_POST['BACKUP'];@$payment=$_POST['PAYMENT'];
if($action =='START')
{$_SESSION['message']="TASKS AUTOMATED"; 	

if($smsemail=='SMSEMAIL')
{
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'ACTIVATED SMS-EMAIL TASK AUTOMATION',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));	

	header("LOCATION:startsmsapi.php");}
if($payment =='PAYMENT'){
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'ACTIVATED PAYMENT  TASK AUTOMATION',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));	
	
	header("LOCATION:startbankapi.php");}	
if($balance =='BALANCE'){
	$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'ACTIVATED BALANCE INQUERY  TASK AUTOMATION',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));	
	header("LOCATION:startbalinquery.php");}
	
if($backup =='BACKUP'){
	$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'ACTIVATED BACKUP  TASK AUTOMATION',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));	
	header("LOCATION:startbackup.php");}
exit;
}
else if($action =='STOP')
{
passthru("smsdown.lnk");
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'DEACTIVATED  TASK AUTOMATION',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));	
	
$_SESSION['message']="TASKS STOP";
}
exit;
?>