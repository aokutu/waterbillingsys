<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$zonex=$_POST['zone'];
@$account=$_POST['account'];$account=trim(addslashes($account));
@$action=$_POST['action'];
@$date=$_POST['date'];
include_once("password.php");

 if($action=='CONP')
{
	$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'UPDATE STATUS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACESS DENIED ";	 exit;}


$accounttblx='accounts'.$zonex;$nonwaterbillsx='nonwaterbills'.$zonex;
$x="INSERT INTO $nonwaterbillsx(ACCOUNT,NAME,METERNUMBER,AMOUNT,DATE) 
SELECT ACCOUNT,CONCAT('CONP'),METERNUMBER,(SELECT CHARGES FROM PAYMENTCODE WHERE NAME REGEXP 'CONP' LIMIT 1),CONCAT('$date') FROM $accounttblx WHERE ACCOUNT='$account'   AND STATUS='CONNECTED'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('UPDATE ACCOUNT  STATUS OF ACCOUNT  $account TO $action'),CURRENT_DATE FROM $accounttblx  WHERE ACCOUNT='$account' AND STATUS='CONNECTED'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE $accounttblx SET STATUS='CONP' WHERE ACCOUNT='$account' AND STATUS='CONNECTED'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT  INTO DISCONNECTED (ACCOUNT,DATE) VALUES('$account',$date)";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$_SESSION['message']="UPDATED STATUS";	exit;
}

else if($action=='CONNECTED')
{
$payrefference=$_POST['slipid'];$wateraccountstblx='wateraccounts'.$zonex;$accounttblx='accounts'.$zonex;
$statushistorytblx='statushistory'.$zonex;
$x="UPDATE $wateraccountstblx SET  LINKED ='CLR' WHERE  ID=$payrefference";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE $accounttblx SET  status='CONNECTED' WHERE ACCOUNT ='$account' ";mysqli_query($connect,$x)or die(mysqli_error($connect)); 
$x="INSERT INTO $statushistorytblx(account,meter,status,task,date) SELECT ACCOUNT,METERNUMBER,STATUS,CONCAT('CONNECT ACCOUNT'),CONCAT('$date')
FROM $accounttblx WHERE  ACCOUNT ='$account' AND STATUS='CONNECTED' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'RECONNECTED A/C NO. $account',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));

$_SESSION['message']="UPDATED STATUS";	exit;
}

else if($action=='COR')
{

$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'UPDATE STATUS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACESS DENIED ";	 exit;}

$accounttblx='accounts'.$zonex;$nonwaterbillsx='nonwaterbills'.$zonex;
$x="INSERT INTO $nonwaterbillsx(ACCOUNT,NAME,METERNUMBER,AMOUNT,DATE) 
SELECT ACCOUNT,CONCAT('COR'),METERNUMBER,(SELECT CHARGES FROM PAYMENTCODE WHERE NAME REGEXP 'COR' LIMIT 1),CONCAT('$date') FROM $accounttblx WHERE ACCOUNT='$account'   AND STATUS='CONNECTED'";
mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('UPDATE ACCOUNT  STATUS OF ACCOUNT  $account TO $action'),CURRENT_DATE FROM $accounttblx  WHERE ACCOUNT='$account' AND STATUS='CONNECTED'";
mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="UPDATE $accounttblx SET STATUS='COR' WHERE ACCOUNT='$account' AND STATUS='CONNECTED'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$_SESSION['message']="UPDATED STATUS";	exit;
}
else if($action=='FUNCTION')
{
	$meterstblx='meters'.$zonex;$statushistoryx='statushistory'.$zonex;
$x="UPDATE  $meterstblx SET STATUS='FUNCTION'  WHERE ACCOUNT='$account'  AND STATUS !='FUNCTION'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO $statushistoryx(account,meter,status,task,date) SELECT ACCOUNT,METERNUMBER,CONCAT('METER FUNCTION'),CONCAT('UPDATE METER STATUS'),CURRENT_DATE FROM $meterstblx WHERE ACCOUNT='$account'  AND STATUS ='FUNCTION'  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
	$x="INSERT INTO METERTRAIL (METERNUMBER,ACCOUNT,ACTIVITY,DATE) SELECT METERNUMBER,ACCOUNT,CONCAT('METER FUNCTION'),CONCAT('$date') FROM $meterstblx WHERE ACCOUNT='$account' AND STATUS ='FUNCTION' ";
	mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('RECORD METER',METERNUMBER,'FUNCTION'),CONCAT('$date')  FROM $meterstblx WHERE ACCOUNT='$account'  AND STATUS ='FUNCTION' ";
	mysqli_query($connect,$x)or die(mysqli_error($connect));
	$_SESSION['message']="UPDATED STATUS";	exit;
}

else if($action=='STOLEN')
{
	$meterstblx='meters'.$zonex;$statushistoryx='statushistory'.$zonex;
$x="UPDATE  $meterstblx SET STATUS='STOLEN'  WHERE ACCOUNT='$account'  AND STATUS !='STOLEN'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO $statushistoryx(account,meter,status,task,date) SELECT ACCOUNT,METERNUMBER,CONCAT('METER STOLEN'),CONCAT('UPDATE METER STATUS'),CONCAT('$date') FROM $meterstblx WHERE ACCOUNT='$account'  AND STATUS ='STOLEN'  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
	$x="INSERT INTO METERTRAIL (METERNUMBER,ACCOUNT,ACTIVITY,DATE) SELECT METERNUMBER,ACCOUNT,CONCAT('METER STOLEN'),CONCAT('$date') FROM $meterstblx WHERE ACCOUNT='$account' AND STATUS ='STOLEN' ";
	mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('RECORD METER',METERNUMBER,'STOLEN'),CONCAT('$date')  FROM $meterstblx WHERE ACCOUNT='$account'  AND STATUS ='STOLEN' ";
	mysqli_query($connect,$x)or die(mysqli_error($connect));
	$_SESSION['message']="UPDATED STATUS";	exit;
}



else if($action=='MALFUNCTION')
{
	$meterstblx='meters'.$zonex;$statushistoryx='statushistory'.$zonex;
$x="UPDATE  $meterstblx SET STATUS='MALFUNCTION'  WHERE ACCOUNT='$account'  AND STATUS !='MALFUNCTION'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO $statushistoryx(account,meter,status,task,date) SELECT ACCOUNT,METERNUMBER,CONCAT('METER MALFUNCTION'),CONCAT('UPDATE METER STATUS'),CONCAT('$date') FROM $meterstblx WHERE ACCOUNT='$account'  AND STATUS ='MALFUNCTION'  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
	$x="INSERT INTO METERTRAIL (METERNUMBER,ACCOUNT,ACTIVITY,DATE) SELECT METERNUMBER,ACCOUNT,CONCAT('METER MALFUNCTION'),CONCAT('$date') FROM $meterstblx WHERE ACCOUNT='$account' AND STATUS ='MALFUNCTION' ";
	mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('RECORD METER',METERNUMBER,'MALFUNCTION'),CONCAT('$date')  FROM $meterstblx WHERE ACCOUNT='$account'  AND STATUS ='MALFUNCTION' ";
	mysqli_query($connect,$x)or die(mysqli_error($connect));
	$_SESSION['message']="UPDATED STATUS";	exit;
}

?>
