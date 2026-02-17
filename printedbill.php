<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
@$account=$_POST['account'];@$month=$_POST['month'];@$meter=$_POST['meter'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'VIEW REPORTS'  OR name='$user' AND password='$password'     AND  ACCESS  REGEXP  'BILLING'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
if(!empty($account))
{
$x="INSERT INTO $statushistorytable(account,meter,status,task,date) VALUES('$account','$meter','PRINTED MONTH $month BILL ','PRINT BILL',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'PRINTED BILL ACC :$account',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']="PRINTED BILL ACC".$account; exit;	
}
else {$_SESSION['message']="SELECT THE ACCOUNT"; exit;	
}


?>