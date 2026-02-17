<?php 
 set_time_limit(0);
session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'ACCOUNTS REG' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

if(mysqli_num_rows($x)>0){}
else{ include_once("accessdenied.php");exit;}
$accounts=$_POST['account'];
foreach($accounts as $key =>$data)
{   
if($data ==null ){unset($accounts[$key]);}
$ffdslash=strstr($data,'/');
if($ffdslash !=null ){unset($account[$key]);}
}

$x="SELECT number FROM zones  WHERE NUMBER !='$zone' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number']; $meterstablex='meters'.$i; $accountstablex='accounts'.$i;

foreach($accounts as $key =>$data)
{
$b="SELECT * FROM   $meterstablex WHERE METERNUMBER='$data' AND ACCOUNT !='NOT INSTALLED'  ";
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){unset($accounts[$key]);  $_SESSION['message']="METER ".$data."REGISTERED IN ZONE". $i; exit;}		
}

foreach($accounts as $key =>$data)
{
$b="SELECT * FROM   $accountstablex WHERE METERNUMBER='$data' OR ACCOUNT='$key' ";
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){unset($accounts[$key]); $_SESSION['message']="METER ".$data."REGISTERED IN ACCOUNT". $key; exit;}		
}

foreach($accounts as $key =>$data)
{ $data=strtoupper($data);
$b="INSERT INTO $meterstable(ACCOUNT,METERNUMBER,SERIALNUMBER,STATUS,SIZE,DATE)  SELECT CONCAT('$key'),METERNUMBER,SERIALNUMBER,STATUS,SIZE,CURRENT_DATE  FROM   $meterstablex WHERE METERNUMBER='$data'  ";
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="DELETE FROM $meterstablex WHERE METERNUMBER='$data'";mysqli_query($connect,$b)or die(mysqli_error($connect));

}


	}
}


foreach($accounts as $key =>$data)
{ 


$b="INSERT INTO $statushistorytable(account,meter,status,task,date) VALUES('$key','$data','REPLACED METER','REPLACED METER',now())";
mysqli_query($connect,$b)or die(mysqli_error($connect));

$b="UPDATE $accountstable SET METERNUMBER ='$data' WHERE ACCOUNT ='$key' AND ACCOUNT IN (SELECT ACCOUNT FROM $meterstable WHERE METERNUMBER ='$data')";mysqli_query($connect,$b)or die(mysqli_error($connect));
//$b="DELETE FROM $meterstablex WHERE METERNUMBER='$data'";mysqli_query($connect,$b)or die(mysqli_error($connect));

}


foreach($accounts as $key =>$data)
{ 
$data=strtoupper(addslashes($data)); 
$x="SELECT *  FROM   $meterstable WHERE METERNUMBER='$data'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$size=$y['size'];}}


$x="SELECT *  FROM   $accountstable WHERE ACCOUNT='$key'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$oldmeter=$y['meternumber'];}}
$x="UPDATE $meterstable SET account ='$key', DATE=(SELECT CURRENT_DATE) WHERE meternumber='$data'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE $accountstable SET meternumber ='$data' ,size='$size' WHERE account='$key'  AND ACCOUNT IN (SELECT ACCOUNT FROM $meterstable WHERE METERNUMBER ='$data') ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO METERTRAIL (METERNUMBER,ACCOUNT,ACTIVITY,DATE) VALUES('$data','$key','INSTALLED METER ',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));
$b="INSERT INTO $statushistorytable(account,meter,status,task,date) VALUES('$key','$data','INSTALLED METER','INSTALLED METER',now())";
mysqli_query($connect,$b)or die(mysqli_error($connect));
//$x="UPDATE $meterstable SET account ='NOT INSTALLED' WHERE meternumber='$oldmeter'";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'ACC $key  INSTALLED  METER NUMBER TO $data',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
} 
$_SESSION['message']="UPDATED"; 
?>