<?php
@session_start();
$_SESSION['message']="SEARCHING";
set_time_limit(0);
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$account1=$_SESSION['account1'];@$account2=$_SESSION['account2'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW SLIPS' OR  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW SLIPS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$x="CREATE TEMPORARY TABLE `currentbalance` (
  `id` INT NOT NULL,
  `account` TEXT NOT NULL,
  `previous` FLOAT NOT NULL,
  `current` FLOAT NOT NULL,
  `consumtion` FLOAT NOT NULL,
  `bill` FLOAT NOT NULL,
  `balbf` FLOAT NOT NULL,
  `totalbill` FLOAT NOT NULL,
  `date` date NOT NULL,
  `billid` text NOT NULL,
  `date2` date NOT NULL,
  RECIEPT TEXT DEFAULT NULL,
  AMNTRCPT FLOAT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `currentbalance`   ADD PRIMARY KEY (`id`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `currentbalance`   MODIFY `id` INT NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="CREATE TEMPORARY TABLE REPORT1(ACCOUNT TEXT,CREDIT  FLOAT,DEBIT FLOAT,CUBIC FLOAT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="CREATE TEMPORARY TABLE CHARGES(ACCOUNT TEXT,NAME TEXT,CURRENTREADING TEXT,CHARGES  FLOAT,DATE DATE);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO  REPORT1(account,credit)  SELECT $billstable.account,SUM($billstable.balance)  FROM  $billstable  WHERE $billstable.account >='$account1' AND  $billstable.account <='$account2'  GROUP BY $billstable.account ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  REPORT1(account,credit)  SELECT $nonwaterbills.account,SUM($nonwaterbills.amount)  FROM  $nonwaterbills  WHERE $nonwaterbills.account >='$account1' AND  $nonwaterbills.account <='$account2'  GROUP BY $nonwaterbills.account ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE REPORT1   SET   debit=0  WHERE  debit  IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  REPORT1(account,debit)  SELECT $wateraccountstable.account,SUM($wateraccountstable.credit)  FROM $wateraccountstable  WHERE    $wateraccountstable.account >='$account1'   AND $wateraccountstable.account <='$account2'  GROUP BY $wateraccountstable.account";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO  CHARGES(account,charges)  SELECT  account ,SUM(credit)-SUM(debit)  AS  total   FROM REPORT1  GROUP BY account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE REPORT1   SET   credit=0  WHERE  credit   IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE CHARGES AS U1, $accountstable AS U2  SET U1.name = U2.client,U1.currentreading=U2.email,  U1.date=U2.date2    WHERE U2.account = U1.account";mysqli_query($connect,$x)or die(mysqli_error($connect)); 
////////////////SMS////////////

$x="insert into currentbalance (account,date) select account,max(date) from $billstable where account >='$account1' AND account <='$account2' GROUP BY ACCOUNT ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, $billstable AS U2  SET U1.previous= U2.previous , U1.current= U2.current , U1.bill= U2.balance , U1.consumtion=U2.units       WHERE U2.account = U1.account AND U2.date=U1.date  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, CHARGES AS U2  SET U1.totalbill= U2.charges   WHERE U2.account = U1.account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance tu,currentbalance  ts SET tu.balbf = ts.totalbill-ts.bill where tu.id=ts.id";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, $wateraccountstable AS U2 SET U1.date2=U2.depositdate WHERE U2.account = U1.account
AND U2.DEPOSITDATE= ANY(SELECT MAX(DEPOSITDATE) FROM $wateraccountstable where $wateraccountstable.account=U1.account )";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, $wateraccountstable AS U2 SET U1.date2=U2.depositdate WHERE U2.account = U1.account AND U2.DEPOSITDATE= ANY(SELECT MAX(DEPOSITDATE) FROM $wateraccountstable where $wateraccountstable.account=U1.account )";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, $wateraccountstable AS U2 SET U1.RECIEPT=U2.RECIEPTNUMBER WHERE U2.account = U1.account AND U2.DEPOSITDATE= ANY(SELECT MAX(DEPOSITDATE) FROM $wateraccountstable where $wateraccountstable.account=U1.account )";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, $wateraccountstable AS U2 SET U1.AMNTRCPT =(SELECT SUM(U2.CREDIT)) WHERE U2.account = U1.account AND U1.RECIEPT=U2.RECIEPTNUMBER ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$csv_filename ='data.csv';
$file = fopen($csv_filename, 'w');

	$x="select  amntrcpt,$accountstable.account,$accountstable.idnumber,$accountstable.client,$accountstable.meternumber,$accountstable.contact,currentbalance.current ,currentbalance.current,currentbalance.previous,currentbalance.consumtion,currentbalance.bill,currentbalance.balbf,currentbalance.totalbill,currentbalance.reciept,currentbalance.date,currentbalance.date2,IFNULL(DATEDIFF(CURRENT_DATE,currentbalance.date2),'NEVER') AS DDYS FROM  
	$accountstable,currentbalance where  currentbalance.totalbill >0 AND  $accountstable.account=currentbalance.account order by  currentbalance.account,currentbalance.date asc ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
	fputcsv($file,array('DEBTORS REPORT FROM '.$account1. ' TO '.$account2.' '));
	fputcsv($file,array(' '));
	fputcsv($file,array('ACCOUNT ',' CLIENT ',' ACCUM TTL'));		    

		 while ($y=@mysqli_fetch_array($x))
		 { 
		   	fputcsv($file,array($y['account'],$y['client'],abs($y['totalbill'])));	 
		 }
		 }
	
	
		 $x="SELECT COUNT(currentbalance.ID),SUM(CONSUMTION),SUM(BILL),SUM(BALBF),SUM(TOTALBILL) FROM $accountstable,currentbalance where  currentbalance.totalbill >0 AND  $accountstable.account=currentbalance.account";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 { 
		fputcsv($file,array('TOTAL',' ',abs($y['SUM(TOTALBILL)'])));

		 }
		 }
		 
		 
fclose($file);
header("LOCATION:downloadbilltemplate.php");

 ?>