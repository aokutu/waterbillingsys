<?php 
 @session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$action=$_POST['action'];  
@$del=$_POST['del'];
@$date=$_POST['date'];
$_SESSION['date']=$date;
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'ACCOUNTS REG'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

foreach($del as $id)
{
  if($id <1){unset($del[$id]);}
}

foreach($del as $id)
{
$x="SELECT  ACCOUNT   FROM $accountstable  WHERE ID=$id   AND STATUS ='$action'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));	
		if(mysqli_num_rows($x)>0)
		{
	while ($y=@mysqli_fetch_array($x))
		{
				$_SESSION['message']="ACCOUNT".$y['ACCOUNT']."  <br>ALREADY  ".$action;	 exit;		
			
		}		

			} 
	}




if($action =='DETAILS'){
$id=reset($del);
$x="SELECT ACCOUNT  FROM $accountstable  WHERE ID=$id";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['account']=$y['ACCOUNT'];}}
header("LOCATION:newaccountdetails.php");exit;
}

if($action =='DEPOSIT'){
$id=reset($del);
$x="SELECT ACCOUNT  FROM $accountstable  WHERE ID=$id";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['account']=$y['ACCOUNT'];}}
header("LOCATION:depositreceipts.php");exit;
}

if($action =='BALANCE'){ 
$id=reset($del);
$x="SELECT ACCOUNT  FROM $accountstable  WHERE ID=$id";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['account']=$y['ACCOUNT']; $acc=$y['ACCOUNT'];}}
	
$x="SELECT SUM(CREDIT) FROM $wateraccountstable WHERE ACCOUNT='$acc' AND CODE !=(SELECT  CODE FROM paymentcode WHERE NAME REGEXP 'DEPOSIT' LIMIT  1) ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$deposit=$y['SUM(CREDIT)'];}}
	 
$x="SELECT SUM(BALANCE) FROM $billstable WHERE ACCOUNT='$acc'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$waterbill=$y['SUM(BALANCE)'];}}
	 
	 $x="SELECT SUM(AMOUNT) FROM $nonwaterbills WHERE ACCOUNT='$acc'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$nonwaterbill=$y['SUM(AMOUNT)'];}}
	
		$bal=$waterbill+$nonwaterbill-$deposit;
$_SESSION['message']="ACC ".$acc." BALANCE ".number_format($bal,2);exit;
}

if($action =='CONNECTED'){
$id=reset($del);
$x="SELECT ACCOUNT  FROM $accountstable  WHERE ID=$id";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['account']=$y['ACCOUNT'];}}
header("LOCATION:reconnect.php");exit;
}

if($action =='CONNECT'){
$id=reset($del);
$x="SELECT ACCOUNT  FROM $accountstable  WHERE ID=$id";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['account']=$y['ACCOUNT'];}}
header("LOCATION:newaccountdetails.php");exit;
}
if($action=="DELETE")
{
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'DELETE ACCOUNT'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACESS DENIED ";	 exit;}


foreach($del as $data)
{
 $x="DELETE  FROM  debtregistry  WHERE  ACCOUNT = (SELECT ACCOUNT FROM $accountstable WHERE  ID =$data)";mysqli_query($connect,$x)or die(mysqli_error($connect));
   $x="DELETE  FROM  debtpay  WHERE  ACCOUNT = (SELECT ACCOUNT FROM $accountstable WHERE  ID =$data)";mysqli_query($connect,$x)or die(mysqli_error($connect));
 $x="DELETE  FROM  $billstable  WHERE  ACCOUNT = (SELECT ACCOUNT FROM $accountstable WHERE  ID =$data)"; mysqli_query($connect,$x)or die(mysqli_error($connect));
 $x="DELETE  FROM  $wateraccountstable  WHERE  ACCOUNT = (SELECT ACCOUNT FROM $accountstable WHERE  ID =$data)";mysqli_query($connect,$x)or die(mysqli_error($connect));
 $x="DELETE  FROM  $nonwaterbills  WHERE  ACCOUNT = (SELECT ACCOUNT FROM $accountstable WHERE  ID =$data)";mysqli_query($connect,$x)or die(mysqli_error($connect));
 $x="DELETE  FROM $statushistorytable  WHERE  ACCOUNT = (SELECT ACCOUNT FROM $accountstable WHERE  ID =$data)";mysqli_query($connect,$x)or die(mysqli_error($connect));
 $x=" UPDATE clientmetersreg SET ACCOUNT ='NOT INSTALLED' WHERE ACCOUNT =(SELECT ACCOUNT FROM $accountstable WHERE  ID =$data)";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date)  SELECT CONCAT('$user'),CONCAT(DATE_ADD(NOW(), INTERVAL 7 HOUR)),CONCAT('DELETED ACCOUNT NUMBER ',(SELECT ACCOUNT FROM $accountstable WHERE  ID =$data)),CONCAT(DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM  $accountstable WHERE  ID =$data ";mysqli_query($connect,$x)or die(mysqli_error($connect));

}
$_SESSION['message']="ACCOUNT(S) DELETED";	 

}

if(($action =="CONP") || ($action =="COR") ||($action =="MNOS")||($action =="ILLEGAL")||($action =="STOLEN")||($action =="VANDALISED"))
{

$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'UPDATE STATUS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}

else{ $_SESSION['message']="ACESS DENIED ";	 exit;}

foreach($del as $id)
{




$x="SELECT  *  FROM $accountstable  WHERE ID=$id   AND STATUS ='CONNECTED'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$acc=$y['account']; $meternumber=$y['meternumber'];}}
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'UPDATE ACCOUNT  STATUS OF ACCOUNT $acc  TO $action',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE  $accountstable  SET STATUS='$action' WHERE id=$id";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO metertrail (METERNUMBER,ACCOUNT,ACTIVITY,DATE) VALUES('$meternumber','$acc','DELINK METER ',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));

$b="INSERT INTO $statushistorytable(account,meter,status,task,date) VALUES('$acc','$meternumber','$action','$action',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$b)or die(mysqli_error($connect));

$b="INSERT INTO statustrail(zone,account,status,date) VALUES('$zone','$acc','$action',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$b)or die(mysqli_error($connect));

 $x=" UPDATE clientmetersreg SET ACCOUNT ='NOT INSTALLED' WHERE ACCOUNT =(SELECT ACCOUNT FROM $accountstable WHERE  ID =$id)";mysqli_query($connect,$x)or die(mysqli_error($connect));
 $x=" UPDATE accountsstatus SET status ='$action' WHERE ACCOUNT =(SELECT ACCOUNT FROM $accountstable WHERE  ID =$id) AND MONTH(DATE)=MONTH('$date'); ";mysqli_query($connect,$x)or die(mysqli_error($connect));

}
$_SESSION['message']="ACCOUNT(S) STATUS UPDATED ";	 exit;
}

if($action =='NEW CONNECTION'){
$id=reset($del);
$x="SELECT ACCOUNT  FROM $accountstable  WHERE ID=$id";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['account']=$y['ACCOUNT'];}}
header("LOCATION:reconnect.php");exit;
}

 print  "xx"; exit;
?>