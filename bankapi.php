<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
$zone=$_SESSION['zone'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'UPLOAD SLIPS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$connect2=mysqli_connect('localhost','root','','company');
$datex=date("YmdHis");$random=rand(99999,999999);
$code=$datex.$random;
///////////////////////////
///////////////////////////

$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{			
	$i=$y['number'];$accountstablex='accounts'.$i;
$b="INSERT INTO $company.deposituploads(TRANSACTION,CREDIT,account,DEPOSITDATE,STATUS) SELECT company.wateraccounts.TRANSACTION,CREDIT,company.wateraccounts.ACCOUNT,DEPOSITDATE,company.wateraccounts.STATUS FROM   company.wateraccounts  JOIN  $company.$accountstablex on wateraccounts.account =$accountstablex.account  AND wateraccounts.status !='PROCESSED' ";mysqli_query($connect,$b)or die(mysqli_error($connect));

		}
		}
		
/////////////////////////////

$b="UPDATE COMPANY.WATERACCOUNTS tu, COMPANY.WATERACCOUNTS ts SET tu.CREDIT2 =ts.CREDIT WHERE tu.ID=ts.ID";
mysqli_query($connect2,$b)or die(mysqli_error($connect2));
$b=" UPDATE company.wateraccounts SET paymentmode = 'CHEQUE' ,DATE =CURRENT_DATE  WHERE wateraccounts.status !='PROCESSED' AND TRANSACTION  LIKE 'S%' AND ACCOUNT REGEXP 'CHQ'"; 
mysqli_query($connect2,$b)or die(mysqli_error($connect2));

$b=" UPDATE company.wateraccounts SET paymentmode = 'MPESA' ,DATE =CURRENT_DATE  WHERE wateraccounts.status !='PROCESSED' AND TRANSACTION  LIKE 'S%' AND ACCOUNT NOT REGEXP 'CHQ'"; 
mysqli_query($connect2,$b)or die(mysqli_error($connect2));

$b=" UPDATE company.wateraccounts SET paymentmode = 'E.F.T' ,DATE =CURRENT_DATE  WHERE wateraccounts.status !='PROCESSED'  AND ACCOUNT LIKE 'B/O%'"; 
mysqli_query($connect2,$b)or die(mysqli_error($connect2));

$b=" UPDATE company.wateraccounts SET paymentmode = 'REVERSED' ,DATE =CURRENT_DATE  WHERE wateraccounts.status !='PROCESSED'  AND ACCOUNT LIKE 'REVERSE%'"; 
mysqli_query($connect2,$b)or die(mysqli_error($connect2));

$b="UPDATE company.wateraccounts tu, company.wateraccounts ts SET tu.date=CURRENT_DATE where tu.id=ts.id  AND tu.status !='PROCESSED' AND tu.PAYMENTMODE ='REVERSED'";mysqli_query($connect2,$b)or die(mysqli_error($connect2));

$b=" UPDATE company.wateraccounts SET paymentmode = 'BANK' ,DATE =CURRENT_DATE  WHERE wateraccounts.status !='PROCESSED' AND TRANSACTION  LIKE 'DC%' "; 
mysqli_query($connect2,$b)or die(mysqli_error($connect2));

$b=" UPDATE company.wateraccounts SET status = 'PROCESSED' ,DATE =CURRENT_DATE ,code='$code' WHERE wateraccounts.status ='' AND    wateraccounts.ACCOUNT  IN (SELECT ACCOUNT FROM $company.deposituploads) AND wateraccounts.TRANSACTION  IN(SELECT TRANSACTION FROM $company.deposituploads) AND wateraccounts.depositdate IN (SELECT depositdate FROM $company.deposituploads)  AND wateraccounts.CREDIT IN (SELECT CREDIT FROM $company.deposituploads) "; 
mysqli_query($connect2,$b)or die(mysqli_error($connect2));

////////////////////////////
$b=" UPDATE company.wateraccounts SET status = 'PROCESSED' ,DATE =CURRENT_DATE ,code='$code' WHERE wateraccounts.status ='' AND    wateraccounts.ACCOUNT  IN (SELECT ACCOUNT FROM $company.deposituploads) AND wateraccounts.TRANSACTION  IN(SELECT TRANSACTION FROM $company.deposituploads) AND wateraccounts.depositdate IN (SELECT depositdate FROM $company.deposituploads)  AND wateraccounts.CREDIT IN (SELECT CREDIT FROM $company.deposituploads) "; 
mysqli_query($connect2,$b)or die(mysqli_error($connect2));
	$x="SELECT dbcode FROM paymentcode  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	$p=$y['dbcode'];
mysqli_query($connect,$p)or die(mysqli_error($connect))	;	
			
		}}

///////////////
$x="UPDATE deposituploads SET depositdate = replace(depositdate, '/', '-')  WHERE  status !='PROCESSED'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE deposituploads  SET depositdate = str_to_date(depositdate,'%d-%m-%Y') WHERE   status !='PROCESSED'    ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE deposituploads tu, deposituploads ts SET tu.credit2 = ts.credit where tu.id=ts.id  AND tu.date  IS     NULL  AND tu.status !='PROCESSED' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x= "UPDATE deposituploads AS t1 INNER JOIN deposituploads AS t2 SET t1.account =(SELECT LEFT(t1.account, 11)) WHERE t1.date  IS   NULL AND t1.id=t2.id   AND t1.status !='PROCESSED'";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="UPDATE deposituploads  SET date=CURDATE() WHERE date  IS  NULL  AND status !='PROCESSED' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM deposituploads WHERE  CHAR_LENGTH(account) !=8  AND status !='PROCESSED' ";mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{			
	$i=$y['number'];$accountstablex='accounts'.$i;
$b="UPDATE deposituploads tu, $accountstablex ts SET tu.zone ='$i' where tu.account=ts.account";
mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="UPDATE deposituploads tu, $accountstablex ts SET tu.code =(SELECT CODE FROM PAYMENTCODE WHERE NAME REGEXP 'WATER BILL' LIMIT 1) where tu.account=ts.account   AND tu.transaction like 'S%' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));


		}
		}
		
		
$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{			
	$i=$y['number'];$wateraccountsx='wateraccounts'.$i;$accountstablex='accounts'.$i;$billstablex='bills'.$i; $nonwaterbillx='nonwaterbills'.$i;
$b="INSERT INTO $wateraccountsx(TRANSACTION,CREDIT,ACCOUNT,DEPOSITDATE,CODE,CREDIT2,DATE,STATUS) 
SELECT TRANSACTION,CREDIT,deposituploads.ACCOUNT,DEPOSITDATE,CODE,CREDIT2,deposituploads.DATE,deposituploads.STATUS from $accountstablex,deposituploads where $accountstablex.account=deposituploads.account  AND deposituploads.status !='PROCESSED';
  ";mysqli_query($connect,$b)or die(mysqli_error($connect));
   $b="INSERT INTO OUTBOX(ACCOUNT,CONTACT,MESSAGE,STATUS,DATE) 
SELECT deposituploads.ACCOUNT,CONTACT,CONCAT(TRANSACTION,' CONFIRMED LAMU WATER & SEWERAGE CO. LTD HAS RECIEVED Ksh.',CREDIT,' 
FROM ',deposituploads.ACCOUNT,' ON ',DEPOSITDATE,'NEW BAL. ',( select (SELECT IFNULL(sum(balance) ,0)from $billstablex where 
account=(select deposituploads.account)) + (SELECT IFNULL(sum(amount) ,0)
from $nonwaterbillx where account=(select deposituploads.account) )- ( SELECT IFNULL(sum(credit) ,0)
from $wateraccountsx where account=(select deposituploads.account) and code !=(SELECT  CODE FROM PAYMENTCODE WHERE NAME REGEXP 'DEPOSIT' LIMIT  1) ) )),CONCAT('PENDING'),CURRENT_TIMESTAMP FROM DEPOSITUPLOADS,$accountstablex WHERE deposituploads.account=$accountstablex.account";mysqli_query($connect,$b)or die(mysqli_error($connect));	
$b="DELETE n1 FROM $wateraccountsx n1, $wateraccountsx n2 WHERE  n1.id>n2.id AND n1.transaction =n2.transaction  AND n1.depositdate =n2.depositdate   ";
mysqli_query($connect,$b)or die(mysqli_error($connect));	
		}
		}
		
$x="UPDATE deposituploads SET status='PROCESSED' WHERE status =''";mysqli_query($connect,$x)or die(mysqli_error($connect));	

/////////////////DEBT MANAGEMENT\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$x="SELECT ZONE  FROM DEPOSITUPLOADS GROUP BY ZONE  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{			
	$i=$y['ZONE'];$wateraccountsx='wateraccounts'.$i; 
	
	//////////////////////////////////////////////////////
$x="SELECT  SUM(CREDIT),ZONE,ACCOUNT  FROM deposituploads WHERE CONCAT(TRANSACTION,depositdate) IN(SELECT CONCAT(transaction,depositdate) FROM $wateraccountsx) GROUP  BY ACCOUNT ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$ttldeposit=$y['SUM(CREDIT)']; 
	$zone=$y['ZONE'];
	$account=$y['ACCOUNT'];
	$wateraccountsx='wateraccounts'.$zone;
	$billstablex='bills'.$zone;
	$nonwaterbillsx='nonwaterbills'.$zone;
	$x="SELECT  CURRENTBAL,INSTALLMENT   FROM DEBTREGISTRY WHERE ACCOUNT ='$account'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$debt=$y['CURRENTBAL']; $installment=$y['INSTALLMENT'];
	$x="SELECT  SUM($wateraccountsx.CREDIT)  FROM $wateraccountsx,DEPOSITUPLOADS WHERE $wateraccountsx.ACCOUNT ='$account' AND $wateraccountsx.DEPOSITDATE >='$currentmonth' AND CONCAT($wateraccountsx.TRANSACTION,$wateraccountsx.DEPOSITDATE) !=CONCAT(DEPOSITUPLOADS.TRANSACTION,DEPOSITUPLOADS.DEPOSITDATE)  ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$deposit =$y['SUM(CREDIT)'];}}
	
	
	$x="SELECT  SUM(BALANCE)  FROM $billstablex WHERE ACCOUNT ='$account' AND DATE >='$currentmonth'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$waterbill=$y['SUM(BALANCE)'];}}
	
	
	$x="SELECT  SUM(AMOUNT)  FROM $nonwaterbillsx WHERE ACCOUNT ='$account' AND DATE >='$currentmonth'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$nonwaterbill=$y['SUM(AMOUNT)'];}}
	
	$currentbill=$waterbill+$nonwaterbill-$deposit;
$x="SELECT  SUM(CREDIT)  FROM $wateraccountsx WHERE ACCOUNT ='$account' ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$deposit3 =$y['SUM(CREDIT)'];}}
	
	
	$x="SELECT  SUM(BALANCE)  FROM $billstablex WHERE ACCOUNT ='$account' ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$waterbill3=$y['SUM(BALANCE)'];}}
	$x="SELECT  SUM(AMOUNT)  FROM $nonwaterbillsx WHERE ACCOUNT ='$account'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$nonwaterbill3=$y['SUM(AMOUNT)'];}}
	$finalbal=$waterbill3+$nonwaterbill3-$deposit3;
	
	
	$b="UPDATE DEBTREGISTRY tu, DEBTREGISTRY ts SET tu.CURRENTBAL = $finalbal,tu.DATE=CURRENT_DATE,tu.PERIOD=(SELECT TIMESTAMPDIFF(MONTH,CURRENT_DATE,ts.date2)),tu.INSTALLMENT=$finalbal/(SELECT TIMESTAMPDIFF(MONTH,CURRENT_DATE,ts.date2))   WHERE ts.ACCOUNT='$account'";
mysqli_query($connect,$b)or die(mysqli_error($connect));

if(($ttldeposit-$currentbill) >$installment)
{
$x="INSERT INTO DEBTPAY (ACCOUNT,AMOUNT,DETAILS,DATE) SELECT CONCAT('$account'),CONCAT($ttldeposit-$currentbill),CONCAT('ABOVE TARGET'),CONCAT(CURRENT_DATE)";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
}

else if(($ttldeposit-$currentbill) == $installment)
{
$x="INSERT INTO DEBTPAY (ACCOUNT,AMOUNT,DETAILS,DATE) SELECT CONCAT('$account'),CONCAT($ttldeposit-$currentbill),CONCAT('ON TARGET'),CONCAT(CURRENT_DATE)";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
}
else if(  ( ($ttldeposit-$currentbill) >0  )  && (  ($ttldeposit-$currentbill) <$installment  )  )
{
$x="INSERT INTO DEBTPAY (ACCOUNT,AMOUNT,DETAILS,DATE) SELECT CONCAT('$account'),CONCAT($ttldeposit-$currentbill),CONCAT('ABOVE TARGET'),CONCAT(CURRENT_DATE)";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
}
else {}

	}}
	}}
$x="DELETE FROM DEBTREGISTRY WHERE CURRENTBAL <=0 "; mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM DEBTPAY WHERE ACCOUNT NOT IN (SELECT ACCOUNT FROM DEBTREGISTRY)";mysqli_query($connect,$x)or die(mysqli_error($connect));
		}
		//////////////////////// 	
	
		$x="DELETE FROM deposituploads WHERE status ='PROCESSED'";mysqli_query($connect,$x)or die(mysqli_error($connect));

		}
		
		
?>
<div   class="btn-info btn-sm"  id="clock">LAST SENT AT <?php print date("Y-m-d-H-i-s");  ?></div>