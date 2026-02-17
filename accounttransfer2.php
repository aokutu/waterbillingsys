<?php
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("password.php");
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  AND  ACCESS  REGEXP  'ACCOUNT TRANSFER'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="INVALID ENTRIES";exit;}

@$transfer=$_POST['transfer'];@$newzone=$_POST['newzone'];
 print "xx";
 foreach($transfer as $transferaccount)
 {
	 
$x="SELECT number FROM zones WHERE NUMBER !='$zone'";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstablex='accounts'.$i; $meterstablex='meters'.$i;	
	
	$b="SELECT * FROM $accountstablex WHERE ACCOUNT='$transfer'";
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){$_SESSION['message']=$transfer." EXISTS IN ".$accountstablex;$_SESSION['account']=0; exit;}

	$b="SELECT * FROM $meterstablex WHERE ACCOUNT='$transfer'";
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){$_SESSION['message']=$transfer." EXISTS IN ".$meterstablex;$_SESSION['account']=0; exit;}


		}
		}
		
	$newaccountstable='ACCOUNTS'.$newzone;$newmeterstable='METERS'.$newzone;$newstatushistory='STATUSHISTORY'.$newzone;$newbillstable='BILLS'.$newzone;
	$newwateraccounts='WATERACCOUNTS'.$newzone;
	
$x="INSERT  INTO $newaccountstable(ACCOUNT,CLIENT,CLASS,METERNUMBER,SIZE,LOCATION,CONTACT,STATUS,IDNUMBER,USER,DATE,DATE2,ID2,EMAIL,BALANCE,AVG,AVGUNIT,LONGITUDE,LATTITUDE,CLIENTEMAIL,PLOTNUMBER,DEPOSIT) 
SELECT  ACCOUNT,CLIENT,CLASS,METERNUMBER,SIZE,LOCATION,CONTACT,STATUS,IDNUMBER,USER,DATE,DATE2,ID2,EMAIL,BALANCE,AVG,AVGUNIT,LONGITUDE,LATTITUDE,CLIENTEMAIL,PLOTNUMBER,DEPOSIT FROM $accountstable WHERE ACCOUNT='$transferaccount'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="DELETE FROM $accountstable WHERE ACCOUNT='$transferaccount'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO $newmeterstable(METERNUMBER,SERIALNUMBER,SIZE,ACCOUNT,STATUS,DATE) SELECT METERNUMBER,SERIALNUMBER,SIZE,ACCOUNT,STATUS,DATE FROM $meterstable WHERE ACCOUNT='$transferaccount'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO $newstatushistory(ACCOUNT,METER,STATUS,TASK,DATE) SELECT ACCOUNT,METER,STATUS,TASK,DATE FROM $statushistorytable WHERE ACCOUNT ='$transferaccount'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM $statushistorytable WHERE ACCOUNT='$transferaccount'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO $newbillstable (METERNUMBER,CURRENT,PREVIOUS,ACCOUNT,BALANCE,BILLED,UNITS,DEDUCTION,CHARGES,METERCHARGES,REFUSE,STATUS,RECIEPT,DATE,USER) 
SELECT METERNUMBER,CURRENT,PREVIOUS,ACCOUNT,BALANCE,BILLED,UNITS,DEDUCTION,CHARGES,METERCHARGES,REFUSE,STATUS,RECIEPT,DATE,USER FROM $billstable WHERE ACCOUNT ='$transferaccount'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE  FROM $billstable WHERE ACCOUNT ='$transferaccount'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO $newwateraccounts(TRANSACTION,CREDIT,ACCOUNT,DEPOSITDATE,CODE,CREDIT2,DATE,STATUS,LINKED,RECIEPTNUMBER,RECIEPTDATE,PAYPOINT)
SELECT TRANSACTION,CREDIT,ACCOUNT,DEPOSITDATE,CODE,CREDIT2,DATE,STATUS,LINKED,RECIEPTNUMBER,RECIEPTDATE,PAYPOINT FROM $wateraccountstable   ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE  FROM $wateraccountstable WHERE ACCOUNT ='$transferaccount'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE ACCOUNTSREGISTRY SET ZONE ='$newzone' WHERE ACCOUNT ='$transferaccount'";
mysqli_query($connect2,$x)or die(mysqli_error($connect2));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'TRANSFERED ACC $transferaccount TO  ZONE $newzone ',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']="ACCOUNT  TRANSFERED";
$_SESSION['newaccount']=null;$_SESSION['account']=null;	 
	 

 }


$_SESSION['message']="ACCOUNT  TRANSFERED";exit;


?>
