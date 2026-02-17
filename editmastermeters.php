<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'PRODUCTION BILLING'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
 
 
if($_POST['action']=='DELETE')
{
foreach($_POST['meternumber'] as $meternumber)
{


$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'DELETED MASTER METER ".$_POST['meternumber']."',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="DELETE   FROM  $mastermeters WHERE   METERNUMBER='$meternumber'";	
mysqli_query($connect,$x)or die(mysqli_error($connect));

}	
$_SESSION['message']=$companyname."DELETED SELECTED <br> MASTER  METERS";exit; 
	
}


 
if($_POST['action']=='DELETE2')
{
foreach($_POST['id'] as $id)
{


$x="INSERT INTO events(user,session,action,date)  SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('DELETED READING  FROM MASTER METER NUMBER ',(SELECT METERNUMBER FROM $mastermeterbill WHERE ID ='$id')),CURRENT_DATE  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE   FROM  $mastermeterbill WHERE   ID='$id'";	
mysqli_query($connect,$x)or die(mysqli_error($connect));

}	
$_SESSION['message']=$companyname."DELETED SELECTED <br> READINGS";exit; 
	
}

if($_POST['action']=='READING')
{
$_SESSION['mastermeter']=reset($_POST['meternumber']);
$_SESSION['message']="LOAD DETAILS OF METER ".reset($_POST['meternumber']);exit; 
	
}

if($_POST['action']=='EDIT')
{
$_SESSION['mastermeter']=reset($_POST['meternumber']);
$_SESSION['message']="LOAD DETAILS OF METER ".reset($_POST['meternumber']);exit; 
	
}

if($_POST['action']=='EDIT2')
{
$x="UPDATE $mastermeters SET  READING ='".$_POST['current']."' ,DATE ='".$_POST['date']."',LONGITUDE='".$_POST['longittude']."',LATTITUDE='".$_POST['lattitude']."',SERIALNUMBER ='".$_POST['serialnumber']."', LOCATION ='".$_POST['location']."' WHERE  METERNUMBER='".$_POST['meternumber']."'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPDATED MASTER METER ".$_POST['meternumber']." DETAILS',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
	
$_SESSION['message']="METER UPDATED ";exit; 

}
if($_POST['action']=='NEWREADING')
{
$units=$_POST['current']-$_POST['previous'];
	
$x="INSERT INTO $mastermeterbill (METERNUMBER,CURRENT,PREVIOUS,UNITS,DATE) 
VALUES('".$_POST['meternumber']."','".$_POST['current']."','".$_POST['previous']."','".$units."','".$_POST['date']."')";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE $mastermeters SET  READING ='".$_POST['current']."' WHERE  METERNUMBER='".$_POST['meternumber']."'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPDATED MASTER METER ".$_POST['meternumber']." READING TO  ".$_POST['current']."',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$_SESSION['message']="METER UPDATED ";exit; 
	
}
?>