<?php
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'UPDATE STATUS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$account=$_POST['account']; $account=strtoupper(addslashes($account)); $payrefference=$_POST['payrefference'];  $meternumber=$_POST['meter'];
$x="SELECT *  FROM $wateraccountstable WHERE id=$payrefference  AND  LINKED !='CLR' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x) <1)
{ $_SESSION['message']="SELECTED SLIP  INVALID";exit;}
$x="UPDATE $wateraccountstable SET  LINKED ='CLR' WHERE  ID=$payrefference";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE $accountstable SET  status='CONNECTED' WHERE ACCOUNT ='$account'";mysqli_query($connect,$x)or die(mysqli_error($connect)); 
$x="INSERT INTO $statushistorytable(account,meter,status,task,date) VALUES('$account','$meternumber','CONNECTED','CONNECT ACCOUNT',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE  FROM  DISCONNECTED WHERE ACCOUNT ='$account'";
mysqli_query($connect2,$x)or die(mysqli_error($connect2));		
$b="INSERT INTO statustrail(zone,account,status,date) VALUES('$zone','$account','CONNECTED',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$b)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'RECONNECTED A/C NO. $account',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']="A/C NO. ".$account."RECONNECTED";exit;
 ?>