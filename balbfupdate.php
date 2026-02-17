<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'      AND  ACCESS  REGEXP  'FINANCE ARCHIVE'     ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ header("LOCATION:accessdenied4.php");exit;}
@$date=$_POST['date'];  
 $x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{			
	$i=$y['number']; $wateraccountsx='wateraccounts'.$i;$billstablex='bills'.$i;$statushistorytablex='statushistory'.$i;$accountstablex='accounts'.$i;
	$r="DELETE FROM  $billstablex where user ='OPENING-BALANCE' ";mysqli_query($connect,$r)or die(mysqli_error($connect));
	$b="INSERT INTO FINANCEARCHIVE(ACCOUNT,ZONE,AMOUNT,DATE,ARCHIVED,TRANSACTION) SELECT ACCOUNT,CONCAT('$i'),-1*CREDIT,DATE,CONCAT('$date'),CONCAT('DEPOSIT')  FROM $wateraccountsx ";
	mysqli_query($connect,$b)or die(mysqli_error($connect));
	
	$b="INSERT INTO WATERACCOUNTSARCHIVE(ACCOUNT,CREDIT,TRANSACTION,DEPOSITDATE,CODE,STATUS,DATE,DATE2) SELECT ACCOUNT,CREDIT,TRANSACTION,DEPOSITDATE,CODE,STATUS,DATE,CONCAT('$date')  FROM WATERACCOUNTS ";
	mysqli_query($connect2,$b)or die(mysqli_error($connect2));
		
	$c="INSERT INTO FINANCEARCHIVE(ACCOUNT,ZONE,AMOUNT,DATE,ARCHIVED,TRANSACTION,METERNUMBER,CONSUMSION) SELECT ACCOUNT,CONCAT('$i'),BALANCE,DATE,CONCAT('$date'),CONCAT('BILL'),METERNUMBER,UNITS  FROM $billstablex    ";
	mysqli_query($connect,$c)or die(mysqli_error($connect));
$d="INSERT INTO FINANCEARCHIVE(ACCOUNT,ZONE,DATE,ARCHIVED,TRANSACTION,METERNUMBER) SELECT ACCOUNT,CONCAT('$i'),DATE,CONCAT('$date'),STATUS,METER  FROM $statushistorytablex ";
mysqli_query($connect,$d)or die(mysqli_error($connect));
	
$e="TRUNCATE $wateraccountsx";mysqli_query($connect,$e)or die(mysqli_error($connect));
$f="TRUNCATE $statushistorytablex";mysqli_query($connect,$f)or die(mysqli_error($connect));
$g="TRUNCATE $billstablex";mysqli_query($connect,$g)or die(mysqli_error($connect));
$g="TRUNCATE WATERACCOUNTS ";mysqli_query($connect2,$g)or die(mysqli_error($connect2));
$archiveuser=addslashes('OPENING-BALANCE');
$h="INSERT INTO $billstablex (ACCOUNT,BALANCE,DATE,USER) SELECT ACCOUNT,SUM(AMOUNT),CONCAT('$date'),CONCAT('$archiveuser') FROM FINANCEARCHIVE WHERE ACCOUNT  IN(SELECT ACCOUNT FROM $accountstablex  ) GROUP BY ACCOUNT ORDER BY ACCOUNT,ZONE,DATE ";
mysqli_query($connect,$h)or die(mysqli_error($connect));
$j="DELETE FROM $billstablex WHERE BALANCE =0 ";mysqli_query($connect,$j)or die(mysqli_error($connect));	
		}}
	$financearchives= "export.txt"; 
 $myFile = fopen($financearchives, "w");
	$export="SELECT 'ZONE','ACCOUNT','METERNUMBER','TRANSACTION','TR-DATE','AMOUNT','ARCHIVED DATE','UNITS'
UNION (SELECT ZONE,ACCOUNT,METERNUMBER,TRANSACTION,DATE,AMOUNT,ARCHIVED,CONSUMSION FROM  FINANCEARCHIVE )";
		$b=mysqli_query($connect,$export)or die(mysqli_error($connect));
    	if(mysqli_num_rows($b)>0)
		{
		
		 while ($c=mysqli_fetch_array($b))
		{ //foreach($y as $z){//print $z;//	fputs($myFile, $z."\n"); }
	fputs($myFile, $c[0]."\t".$c[1]."\t".$c[2]."\t".$c[3]."\t".$c[4]."\t".$c[5]."\t".$c[6]."\t".$c[7]."\t"."\n");
	}}
	copy('export.txt','uploads/backup/financearchive.txt'); 
	
	$bankslipsarchive= "export.txt"; 
 $myFile = fopen($financearchives, "w");
	$export="SELECT 'TRANSACTION','DEPOSITDATE','ACCOUNT','CREDIT','CODE','STATUS','DATE','ARCHIVED DATE'
UNION (SELECT TRANSACTION,DEPOSITDATE,ACCOUNT,CREDIT,CODE,STATUS,DATE,DATE2  FROM WATERACCOUNTSARCHIVE )";
		$b=mysqli_query($connect2,$export)or die(mysqli_error($connect2));
    	if(mysqli_num_rows($b)>0)
		{
		
		 while ($c=mysqli_fetch_array($b))
		{ //foreach($y as $z){//print $z;//	fputs($myFile, $z."\n"); }
	fputs($myFile, $c[0]."\t".$c[1]."\t".$c[2]."\t".$c[3]."\t".$c[4]."\t".$c[5]."\t".$c[6]."\t".$c[7]."\t"."\n");
	}}
	copy('export.txt','uploads/backup/bankslipsarchive.txt'); 
	
$financearchive=file_get_contents('uploads/backup/financearchive.txt');
$bankslipsarchive=file_get_contents('uploads/backup/bankslipsarchive.txt');


$backupfile = "backupfile.txt"; 
$myFile = fopen($backupfile, "w");
$myFile = fopen($backupfile, "w");
fputs($myFile,"--------BEGIN---FINANCEARCHIVE-----"."\n");
fputs($myFile,$financearchive);
fputs($myFile,"\n"."-----END------"."\n");

fputs($myFile,"--------BEGIN----WATERACCOUNTSARCHIVE----"."\n");
fputs($myFile,$bankslipsarchive);
fputs($myFile,"\n"."-----END------"."\n");
print passthru("compress2.py ");	
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'ARCHIVED THE SYSTEM ',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
 $_SESSION['message']=$date."UPDATED ";   exit;
?> 