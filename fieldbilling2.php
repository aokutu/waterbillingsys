<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$currentreading=$_POST['current'];@$previousreading=$_SESSION['previousreading'];@$deduction=$_POST['deduction']; 
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'BILLING'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{header("LOCATION:accessdenied.php");exit;}
$file=$_FILES['file']; @$billingmode=$_POST['billingmode'];
$meter=$_POST['meter'];
$account=$_SESSION['account'];
$date=$_POST['date']; 


if($billingmode=='1')
{
	 
$x="SELECT $accountstable.*  FROM $accountstable,$meterstable WHERE $accountstable.account ='$account' AND  $accountstable.STATUS='CONNECTED' AND $accountstable.account=$meterstable.account AND $meterstable.status='FUNCTION' LIMIT 1 ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
{while ($y=@mysqli_fetch_array($x))
{ $_SESSION['account']=$y['account'];}}
else if(mysqli_num_rows($x)<1){$_SESSION['message']="INVALID ACCOUNT-METER DETAILS";exit;}


$x="SELECT *  FROM $accountstable WHERE account='$account' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
{
	
	while ($y=@mysqli_fetch_array($x))
{
	
	$meternumber=$y['meternumber'];$size=$y['size'];$class=strtoupper($y['class']);$status=$y['status'];  $avg=$y['avg']; $avgunits=$y['avgunit']; 
$previous=$y['email'];  if($previous ==null){$_SESSION['message']="SET  PREVIOUS   METER READING ON \n".$account; exit;}


$billed=$currentreading-$previous;
$units=$billed-$deduction;

if($units <0){$_SESSION['message']="INVALID ENTRIES \n".$account; exit;}
$a="SELECT STANDINGCHARGES FROM WATERBILLINGRATES WHERE CLASS =(SELECT CLASS FROM $accountstable WHERE ACCOUNT ='$account' LIMIT 1 ) LIMIT 1 ";
$a=mysqli_query($connect,$a)or die(mysqli_error($connect));
		if(mysqli_num_rows($a)>0)
{while ($y=@mysqli_fetch_array($a))
{
	$standingcharges=$y['STANDINGCHARGES'];}}

$x="SELECT ID  FROM  $billstable WHERE  YEAR(DATE)=(SELECT YEAR('$date')) AND  
MONTH (DATE)=(SELECT MONTH('$date')) AND ACCOUNT ='$account' AND  METERCHARGES >0 ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){$standingcharges=0;}

	
$a="SELECT RATE,COMMISSION FROM WATERBILLINGRATES WHERE CLASS =(SELECT CLASS FROM $accountstable WHERE ACCOUNT ='$account' LIMIT 1 ) LIMIT 1 ";
$a=mysqli_query($connect,$a)or die(mysqli_error($connect));
		if(mysqli_num_rows($a)>0)
{while ($y=@mysqli_fetch_array($a))
{
	$rates=$y['RATE'];$commission=$y['COMMISSION'];}}
	
$charges=$rates*$units*(1-$commission);
$commission=$rates*$units*$commission;
$total=$standingcharges+$charges;
	
	
$x="INSERT INTO $billstable(account,meternumber,current,previous,billed,units,deduction,charges,metercharges,commission,balance,status,date,user) 
VALUES('$account','$meternumber','$currentreading','$previous','$billed','$units','$deduction','$charges','$standingcharges','$commission','$total','PENDING','$date','$user')";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE $accountstable  SET email='$currentreading',DATE2='$date'  WHERE  account='$account' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('BILLED ACCOUNT  ON $date'),CURRENT_DATE";
mysqli_query($connect,$x)or die(mysqli_error($connect));


} 
}
	
$_SESSION['message']="ACCOUNT UPDATED";	
	
}

if($billingmode=='2')
{
	
	 
$x="SELECT $accountstable.*  FROM $accountstable,$meterstable WHERE $accountstable.account ='$account' AND  $accountstable.STATUS='CONNECTED' AND $accountstable.account=$meterstable.account AND $meterstable.status='FUNCTION' LIMIT 1 ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
{while ($y=@mysqli_fetch_array($x))
{ $_SESSION['account']=$y['account'];}}
else if(mysqli_num_rows($x)<1){$_SESSION['message']="INVALID ACCOUNT-METER DETAILS";exit;}


$x="SELECT *  FROM $accountstable WHERE account='$account' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
{
	
	while ($y=@mysqli_fetch_array($x))
{
	
	$meternumber=$y['meternumber'];$size=$y['size'];$class=strtoupper($y['class']);$status=$y['status'];  $avg=$y['avg']; $avgunits=$y['avgunit']; 
$previous=$y['email'];  if($previous ==null){$_SESSION['message']="SET  PREVIOUS   METER READING ON \n".$account; exit;}

$billed=$currentreading;
$units=$billed-$deduction;if($units <0){$_SESSION['message']="INVALID ENTRIES \n".$account; exit;}
$a="SELECT STANDINGCHARGES FROM WATERBILLINGRATES WHERE CLASS =(SELECT CLASS FROM $accountstable WHERE ACCOUNT ='$account' LIMIT 1 ) LIMIT 1 ";
$a=mysqli_query($connect,$a)or die(mysqli_error($connect));
		if(mysqli_num_rows($a)>0)
{while ($y=@mysqli_fetch_array($a))
{
	$standingcharges=$y['STANDINGCHARGES'];}}
	

$x="SELECT ID  FROM  $billstable WHERE  YEAR(DATE)=(SELECT YEAR('$date')) AND  
MONTH (DATE)=(SELECT MONTH('$date')) AND ACCOUNT ='$account' AND  METERCHARGES >0 ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){$standingcharges=0;}


$a="SELECT RATE,COMMISSION FROM WATERBILLINGRATES WHERE CLASS =(SELECT CLASS FROM $accountstable WHERE ACCOUNT ='$account' LIMIT 1 ) LIMIT 1 ";
$a=mysqli_query($connect,$a)or die(mysqli_error($connect));
		if(mysqli_num_rows($a)>0)
{while ($y=@mysqli_fetch_array($a))
{
	$rates=$y['RATE'];$commission=$y['COMMISSION'];}}
	
$charges=$rates*$units*(1-$commission);
$commission=$rates*$units*$commission;
$total=$standingcharges+$charges;
	

$x="INSERT INTO $billstable(account,meternumber,current,previous,billed,units,deduction,charges,metercharges,balance,status,date,user) 
VALUES('$account','$meternumber','$previousreading','$previousreading','$billed','$units','$deduction','$charges','$standingcharges','$total','PENDING','$date','$user')";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE $accountstable  SET email='$previousreading',DATE2='$date'  WHERE  account='$account' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('BILLED ACCOUNT  $account ON $date'),CURRENT_DATE";
mysqli_query($connect,$x)or die(mysqli_error($connect));


} 
}
	
$_SESSION['message']="ACCOUNT  UPDATED";	
}


if($billingmode=='AVG')
{
	 
$x="SELECT $accountstable.*  FROM $accountstable,$meterstable WHERE $accountstable.account ='$account' AND  $accountstable.STATUS='CONNECTED' AND $accountstable.account=$meterstable.account AND $meterstable.status='FUNCTION' LIMIT 1 ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
{while ($y=@mysqli_fetch_array($x))
{ $_SESSION['account']=$y['account'];}}
else if(mysqli_num_rows($x)<1){$_SESSION['message']="INVALID ACCOUNT-METER DETAILS";exit;}


$x="SELECT *  FROM $accountstable WHERE account='$account' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
{
	
	while ($y=@mysqli_fetch_array($x))
{
	
	$meternumber=$y['meternumber'];$size=$y['size'];$class=strtoupper($y['class']);$status=$y['status'];  $avg=$y['avg']; $avgunits=$y['avgunit']; 
$previous=$y['email'];  if($previous ==null){$_SESSION['message']="SET  PREVIOUS   METER READING ON \n".$account; exit;}


$billed=$avgunits;
$units=$billed-$deduction;

if($units <0){$_SESSION['message']="INVALID ENTRIES \n".$account; exit;}
$a="SELECT STANDINGCHARGES FROM WATERBILLINGRATES WHERE CLASS =(SELECT CLASS FROM $accountstable WHERE ACCOUNT ='$account' LIMIT 1 ) LIMIT 1 ";
$a=mysqli_query($connect,$a)or die(mysqli_error($connect));
		if(mysqli_num_rows($a)>0)
{while ($y=@mysqli_fetch_array($a))
{
	$standingcharges=$y['STANDINGCHARGES'];}}

$x="SELECT ID  FROM  $billstable WHERE  YEAR(DATE)=(SELECT YEAR('$date')) AND  
MONTH (DATE)=(SELECT MONTH('$date')) AND ACCOUNT ='$account' AND  METERCHARGES >0 ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){$standingcharges=0;}


$a="SELECT RATE,COMMISSION FROM WATERBILLINGRATES WHERE CLASS =(SELECT CLASS FROM $accountstable WHERE ACCOUNT ='$account' LIMIT 1 ) LIMIT 1 ";
$a=mysqli_query($connect,$a)or die(mysqli_error($connect));
		if(mysqli_num_rows($a)>0)
{while ($y=@mysqli_fetch_array($a))
{
	$rates=$y['RATE'];$commission=$y['COMMISSION'];}}
	
$charges=$rates*$units*(1-$commission);
$commission=$rates*$units*$commission;
$total=$standingcharges+$charges;
	

$x="INSERT INTO $billstable(account,meternumber,current,previous,billed,units,deduction,charges,metercharges,balance,status,date,user) 
VALUES('$account','$meternumber','$previousreading','$previousreading','$billed','$units','$deduction','$charges','$standingcharges','$total','PENDING','$date','$user')";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE $accountstable  SET email='$previousreading',DATE2='$date'  WHERE  account='$account' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('BILLED ACCOUNT  ON $date'),CURRENT_DATE";
mysqli_query($connect,$x)or die(mysqli_error($connect));


} 
}
	
	
	$_SESSION['message']="ACCOUNT  UPDATED";	

}


if($billingmode=='3')
{
$x="UPDATE $accountstable  SET email='$currentreading' ,DATE2='$date'  WHERE  account='$account' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPDATE METER READING OF ACCOUNT $account',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect)); $_SESSION['message']="UPDATED";
$_SESSION['message']="ACCOUNT  UPDATED";

header("LOCATION:fieldbilling.php");exit;
	
	
}
if($billingmode=='4'){ 
$x="UPDATE $accountstable  SET avgunit=$currentreading ,avg='AVG' WHERE  account='$account' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'SET AVERAGE  UNIT TO $currentreading ON ACC. $account',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect)); $_SESSION['message']="UPDATED";
$_SESSION['message']="ACCOUNT  UPDATED";	

header("LOCATION:fieldbilling.php");exit;
}

if($billingmode=='5'){ 
$x="UPDATE $accountstable  SET avgunit =null ,avg=null WHERE  account='$account' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'SET AVERAGE  UNIT TO $currentreading ON ACC. $account',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect)); $_SESSION['message']="UPDATED";
$_SESSION['message']="ACCOUNT  UPDATED";	

header("LOCATION:fieldbilling.php");exit;
}


if(!isset($FILES['file'])){header("LOCATION:fieldbilling.php");exit;}
$newname=$account."-".$meter."-".$date;
$newPath = 'uploads/photos/' . basename($_FILES['file']['name']);
$path = $_FILES['file']['name'];
$extension= pathinfo($path, PATHINFO_EXTENSION);
switch($extension) {
case "png":move_uploaded_file($_FILES['file']['tmp_name'], $newPath);rename("uploads/photos/".$path."","uploads/photos/".$newname.".".$extension."");
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPLOADED BILL IMAGE $newname',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));
header("LOCATION:fieldbilling.php");break;
case "jpeg":move_uploaded_file($_FILES['file']['tmp_name'], $newPath);rename("uploads/photos/".$path."","uploads/photos/".$newname.".".$extension."");
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPLOADED BILL IMAGE $newname',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));
header("LOCATION:fieldbilling.php");break;
case "jpg":move_uploaded_file($_FILES['file']['tmp_name'], $newPath);rename("uploads/photos/".$path."","uploads/photos/".$newname.".".$extension."");
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPLOADED BILL IMAGE $newname',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));
header("LOCATION:fieldbilling.php");break;
case "gif":move_uploaded_file($_FILES['file']['tmp_name'], $newPath);rename("uploads/photos/".$path."","uploads/photos/".$newname.".".$extension."");
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPLOADED BILL IMAGE $newname',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));
header("LOCATION:fieldbilling.php");break;
default:header("Location:fieldbilling.php");exit;
            }
			
			
header("LOCATION:fieldbilling.php");exit;
?>