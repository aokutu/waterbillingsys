<?php
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'PRODUCTION BILLING'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

@$refferencenumber=strtoupper(addslashes($_POST['refferencenumber']));
@$units=$_POST['current']-$_POST['previous']; $current=$_POST['current'];$previous=$_POST['previous'];@$chlorine=$_POST['chlorine'];@$price=$_POST['price'];$date=$_POST['date'];

$x="SELECT * FROM productionmeters   WHERE  refferencenumber ='$refferencenumber' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1){  $_SESSION['message']="REFFERENCE NUMBER ".$refferencenumber."MISSING ";exit;}
$x="INSERT INTO waterproduction(REFFERENCENUMBER,LOCATION,PREVIOUS,CURRENT,UNITS,CHLORINE,DATE) 
VALUES ('$refferencenumber','$location',$previous,$current,$units,$chlorine,'$date')";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'BILLED PRODUCTION ACOUNT    $refferencenumber',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="UPDATE productionmeters  SET READING='$current' ,DATE='$date'  WHERE refferencenumber ='$refferencenumber'";mysqli_query($connect,$x)or die(mysqli_error($connect));	
header("LOCATION:productionbilling.php");exit;
	?>