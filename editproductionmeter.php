<?php
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
@$date=$_POST['date'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'PRODUCTION BILLING'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$action=$_POST['action']; @$id=$_POST['id']; @$location=strtoupper(addslashes($_POST['location']));  @$refferencenumber=strtoupper(addslashes($_POST['refferencenumber']));
@$units=$_POST['current']-$_POST['previous']; $current=$_POST['current'];$previous=$_POST['previous'];@$chlorine=$_POST['chlorine'];@$price=$_POST['price'];



if($action =='DELETE')
{ 
foreach ($_POST['id'] as $identity){
	
$x="SELECT refferencenumber FROM  productionmeters WHERE id =$identity";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$refferencenumber=$y['refferencenumber']; }}
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'DELETED WATER PRODUCTION METER  A/C $refferencenumber',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="DELETE  FROM productionmeters WHERE  id=$identity ";mysqli_query($connect,$x)or die(mysqli_error($connect));
}
$_SESSION['message']="PRODUCTION A/C DELETED"; exit;
}

if($action =='DELETE2')
{ 
foreach ($_POST['id'] as $identity){
	
$x="SELECT refferencenumber,date FROM  waterproduction WHERE id =$identity";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$refferencenumber=$y['refferencenumber'];$date=$y['date']; }}
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'DELETED WATER PRODUCTION METER  A/C $refferencenumber  BILLED ON $date',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="DELETE  FROM waterproduction WHERE  id=$identity ";mysqli_query($connect,$x)or die(mysqli_error($connect));
}
$_SESSION['message']="PRODUCTION BILL  DELETED"; exit;
}

else if (($action =='LOAD') ||($action=='EDIT')){$_SESSION['id']=reset($_POST['id']); $_SESSION['message']="LOADING DETAILS";exit;}
else if(($action =='UPDATE')&&($units >1 )&&($location !=null ) && ($refferencenumber  !=null ))
{
$x="SELECT * FROM productionmeters   WHERE  refferencenumber ='$refferencenumber' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1){  $_SESSION['message']="REFFERENCE NUMBER ".$refferencenumber."MISSING ";exit;}
$x="INSERT INTO WATERPRODUCTION(REFFERENCENUMBER,LOCATION,PREVIOUS,CURRENT,UNITS,CHLORINE,PRICE,DATE) 
VALUES ('$refferencenumber','$location',$previous,$current,$units,$chlorine,'$price','$date')";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'BILLED PRODUCTION ACOUNT    $refferencenumber',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="UPDATE productionmeters  SET READING='$current' ,DATE='$date'  WHERE refferencenumber ='$refferencenumber'";mysqli_query($connect,$x)or die(mysqli_error($connect));	
	$_SESSION['message']="ACCOUNT ".$refferencenumber."UPDATED ";exit;
	}
	

	else if($action =='UPDATE2')
{ $id=$_SESSION['id'];
$x="SELECT * FROM productionmeters   WHERE  id =$id ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1){  $_SESSION['message']="REFFERENCE NUMBER ".$refferencenumber."MISSING ";exit;}
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'EDITED PRODUCTION ACC  $refferencenumber ',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="UPDATE productionmeters  SET READING='$current' ,refferencenumber='$refferencenumber' location='$location' WHERE id =id";mysqli_query($connect,$x)or die(mysqli_error($connect));	
	$_SESSION['message']="ACCOUNT ".$refferencenumber."UPDATED ";exit;
	}
print   "xxx";	
	
?>