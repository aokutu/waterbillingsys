<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'METER REG' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$id=$_POST['id'];

foreach($id as  $id2)
{ 

$b="INSERT INTO $statushistorytable(account,meter,status,task,date)  SELECT  ACCOUNT,METERNUMBER,CONCAT('DELINKED METER '),CONCAT('DELINKED METER'),CONCAT(CURRENT_DATE)  FROM $accountstable WHERE ID=$id2";
mysqli_query($connect,$b)or die(mysqli_error($connect));
$x="INSERT INTO METERTRAIL (METERNUMBER,ACCOUNT,ACTIVITY,DATE)  SELECT  METERNUMBER,ACCOUNT,CONCAT('DELINKED METER '),CONCAT(CURRENT_DATE)  FROM $accountstable WHERE ID=$id2";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE $accountstable SET METERNUMBER='NOT INSTALLED' WHERE ID=$id2 ";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	
$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),CONCAT(CURRENT_TIMESTAMP),CONCAT('DELINK METER ',(SELECT METERNUMBER FROM $accountstable WHERE ID =$id2),' FROM ACCOUNT',(SELECT ACCOUNT  FROM $accountstable WHERE ID =$id2)),CONCAT(CURRENT_DATE)";
mysqli_query($connect,$x)or die(mysqli_error($connect));

}
$_SESSION['message']="METERS DELINKED";exit;
?>