<?php 
  @session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
$account1=$_SESSION['account1'];
$account2=$_SESSION['account2'];
$currentmonth=date('Y-m-').'01';
include_once("password.php");
@$depositdate1=$_SESSION['depositdate1'];@$depositdate2=$_SESSION['depositdate2'];
if($depositdate1 == NULL ){$depositdate1=date('Y-m-d');}
 $datex=date("YmdHis");$random=rand(99999,999999);
$codexx=$datex.$random; $_SESSION['processid']=$code; 
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'ADD SLIPS' ";  
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ header("LOCATION:accessdenied4.php");exit;}
@$amount=$_POST['amount']; 

  @$slip=strtoupper(addslashes($_POST['slip']));
  @$postdate=$_POST['postdate'];@$code=$_POST['code'];
  @$link=$_POST['link']; @$transaction=$_POST['transaction'];
  @$reversalslip=$_POST['reversalslip'];@$reversal=$_POST['reversal'];
  @$paypoint=$_POST['paypoint'];
@$account=strtoupper(addslashes($_POST['account']));

$x="SELECT ACCOUNT  FROM $accountstable  WHERE ACCOUNT ='$account' ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)<1)
		{$_SESSION['message']="ACCOUNT ".$account." MISSING";header("LOCATION:accessdenied4.php");exit;}
/////////////////////////



$deposit=0;$deposit=0;$nonwaterbill=0;

$x="SELECT * FROM DEBTREGISTRY WHERE ACCOUNT ='$account' ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
		
	$currentdebtbal=$y['currentbal']; $monthlyinstallment =$y['installment'];
	
///////////////////
	$b="SELECT IFNULL(SUM(CREDIT),0) FROM $wateraccountstable WHERE ACCOUNT='$account' AND DEPOSITDATE >='$currentmonth' AND CODE !=(SELECT  CODE FROM PAYMENTCODE WHERE NAME REGEXP 'DEPOSIT' LIMIT  1) ";
		$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
		if(mysqli_num_rows($b)>0)
		{
		
		 while ($y=@mysqli_fetch_array($b))
		{$deposit=$y['IFNULL(SUM(CREDIT),0)'];}}
	
$b="SELECT IFNULL(SUM(BALANCE),0) FROM $billstable WHERE ACCOUNT ='$account'  AND DATE >='$currentmonth' ";

$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
		if(mysqli_num_rows($b)>0)
		{
		
		 while ($y=@mysqli_fetch_array($b))
		{$waterbill=$y['IFNULL(SUM(BALANCE),0)'];}}
	  $b="SELECT IFNULL(SUM(AMOUNT),0) FROM $nonwaterbills WHERE ACCOUNT='$account'   AND DATE >='$currentmonth'  ";
		$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
		if(mysqli_num_rows($b)>0)
		{
		
		 while ($y=@mysqli_fetch_array($b))
		{$nonwaterbill=$y['IFNULL(SUM(AMOUNT),0)'];}}
	
		$currentbal=$waterbill+$nonwaterbill-$deposit;
	$debtpay=$amount-$currentbal;

	$x="SELECT  IFNULL(SUM(CREDIT),0)  FROM $wateraccountstable WHERE ACCOUNT ='$account' AND CODE !=(SELECT  CODE FROM PAYMENTCODE WHERE NAME REGEXP 'DEPOSIT' LIMIT  1) ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$deposit3 =$y['IFNULL(SUM(CREDIT),0)'];}}
	

	$x="SELECT  IFNULL(SUM(BALANCE),0)  FROM $billstable WHERE ACCOUNT ='$account' ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$waterbill3=$y['IFNULL(SUM(BALANCE),0)'];}}
		 
	$x="SELECT  IFNULL(SUM(AMOUNT),0)  FROM $nonwaterbills WHERE ACCOUNT ='$account'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$nonwaterbill3=$y['IFNULL(SUM(AMOUNT),0)'];}}
	$finalbal=$waterbill3+$nonwaterbill3-$deposit3;
if($debtpay >$monthlyinstallment )
{
$b="INSERT INTO DEBTPAY(ACCOUNT,AMOUNT,DETAILS,DATE) VALUES('$account',$debtpay,'ABOVE TARGET',now())";
mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="UPDATE DEBTREGISTRY tu, DEBTREGISTRY ts SET tu.CURRENTBAL =((select IFNULL(SUM(balance),0) FROM $billstable WHERE ACCOUNT=TS.ACCOUNT)+
(SELECT IFNULL(SUM(AMOUNT),0) FROM $nonwaterbills WHERE ACCOUNT=TS.ACCOUNT)-
(SELECT IFNULL(SUM(CREDIT),0) FROM $wateraccountstable WHERE ACCOUNT=TS.ACCOUNT  AND CODE !=(SELECT  CODE FROM PAYMENTCODE WHERE NAME REGEXP 'DEPOSIT' LIMIT  1) ) ),tu.DATE=CURRENT_DATE,tu.PERIOD=
(SELECT TIMESTAMPDIFF(MONTH,CURRENT_DATE,ts.date2)),
 tu.INSTALLMENT=$finalbal/(SELECT TIMESTAMPDIFF(MONTH,CURRENT_DATE,ts.date2))
 WHERE ts.ACCOUNT='$account'  AND ts.DATE2>=ts.DATE";
mysqli_query($connect,$b)or die(mysqli_error($connect));
}
else if($debtpay == $monthlyinstallment )
{
$b="INSERT INTO DEBTPAY(ACCOUNT,AMOUNT,DETAILS,DATE) VALUES('$account',$debtpay,'ON TARGET',now())";
mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="UPDATE DEBTREGISTRY tu, DEBTREGISTRY ts SET tu.CURRENTBAL =((select IFNULL(SUM(balance),0) FROM $billstable WHERE ACCOUNT=TS.ACCOUNT)+
(SELECT IFNULL(SUM(AMOUNT),0) FROM $nonwaterbills WHERE ACCOUNT=TS.ACCOUNT)+
(SELECT IFNULL(SUM(CREDIT),0) FROM $wateraccountstable WHERE ACCOUNT=TS.ACCOUNT AND CODE !=(SELECT  CODE FROM PAYMENTCODE WHERE NAME REGEXP 'DEPOSIT' LIMIT  1) ) ),tu.DATE=CURRENT_DATE,tu.PERIOD=(SELECT TIMESTAMPDIFF(MONTH,CURRENT_DATE,ts.date2)),tu.INSTALLMENT=$finalbal/(SELECT TIMESTAMPDIFF(MONTH,CURRENT_DATE,ts.date2)) WHERE ts.ACCOUNT='$account'  AND ts.DATE2>=ts.DATE  ";
mysqli_query($connect,$b)or die(mysqli_error($connect));
}

else if (($debtpay >0 ) &&($debtpay < $monthlyinstallment) )
{
$b="INSERT INTO DEBTPAY(ACCOUNT,AMOUNT,DETAILS,DATE) VALUES('$account',$debtpay,'BELOW TARGET',now())";
mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="UPDATE DEBTREGISTRY tu, DEBTREGISTRY ts SET tu.CURRENTBAL = ((select IFNULL(SUM(balance),0) FROM $billstable WHERE ACCOUNT=TS.ACCOUNT)+
(SELECT IFNULL(SUM(AMOUNT),0) FROM $nonwaterbills WHERE ACCOUNT=TS.ACCOUNT)+
(SELECT IFNULL(SUM(CREDIT),0) FROM $wateraccountstable WHERE ACCOUNT=TS.ACCOUNT AND CODE !=(SELECT  CODE FROM PAYMENTCODE WHERE NAME REGEXP 'DEPOSIT' LIMIT  1) ) ),tu.DATE=CURRENT_DATE,tu.PERIOD=(SELECT TIMESTAMPDIFF(MONTH,CURRENT_DATE,ts.date2)),tu.INSTALLMENT=$finalbal/(SELECT TIMESTAMPDIFF(MONTH,CURRENT_DATE,ts.date2))  WHERE ts.ACCOUNT='$account' AND ts.DATE2>=ts.DATE ";
mysqli_query($connect,$b)or die(mysqli_error($connect));
}	
$x="DELETE FROM DEBTREGISTRY WHERE CURRENTBAL <=0 "; mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM DEBTPAY WHERE ACCOUNT NOT IN (SELECT ACCOUNT FROM DEBTREGISTRY)";mysqli_query($connect,$x)or die(mysqli_error($connect));
	
}}
  if(($link =='link')  &&($transaction >0 ) && ($amount >0) )  
{
$x="SELECT * FROM COMPANY.WATERACCOUNTS WHERE ID =$transaction AND CREDIT >=CREDIT2 AND CREDIT2 >= $amount ";
$x=mysqli_query($connect2,$x)or die(mysqli_error($connect2));
		if(mysqli_num_rows($x)< 1)
		{$_SESSION['message']="INVALID AMOUNT ";header("LOCATION:bankstatements.php"); exit; }
$x="INSERT INTO  $company.deposituploads (transaction,credit,credit2,account,code,depositdate,date) SELECT TRANSACTION,CONCAT('$amount'),CONCAT('$amount'),CONCAT('$account'),CONCAT('$code'),DEPOSITDATE,DATE FROM COMPANY.WATERACCOUNTS WHERE ID =$transaction  AND CREDIT2 >='$amount' AND CREDIT >=CREDIT2 ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE deposituploads SET depositdate = replace(depositdate, '/', '-')  WHERE  status !='PROCESSED'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE deposituploads  SET depositdate = str_to_date(depositdate,'%d-%m-%Y') WHERE   status !='PROCESSED'    ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$random=rand(9999,99999);
$x="INSERT INTO $wateraccountstable(TRANSACTION,CREDIT,ACCOUNT,DEPOSITDATE,CODE,CREDIT2,DATE) 
SELECT CONCAT(TRANSACTION,'$random'),CREDIT,ACCOUNT,DEPOSITDATE,CODE,CREDIT2,DATE FROM DEPOSITUPLOADS WHERE  STATUS!='PROCESSED' AND ACCOUNT ='$account';";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date)  
SELECT CONCAT('$user'),CONCAT(CURRENT_TIMESTAMP),CONCAT('ENTERED NEW SLIP REFF ',TRANSACTION,'- $random ACC $account WORTH $amount' ),CONCAT(CURRENT_DATE) FROM DEPOSITUPLOADS WHERE  STATUS!='PROCESSED' AND ACCOUNT ='$account';";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="DELETE FROM DEPOSITUPLOADS WHERE ACCOUNT ='$account'";mysqli_query($connect,$x)or die(mysqli_error($connect));
//$x="UPDATE COMPANY.WATERACCOUNTS SET POSTED='POSTED' ,DATE =CURRENT_DATE ,code='$codexx' WHERE ID =$transaction";mysqli_query($connect2,$x)or die(mysqli_error($connect2));
$x="UPDATE COMPANY.WATERACCOUNTS tu, COMPANY.WATERACCOUNTS ts SET tu.CREDIT2 = ts.CREDIT2-$amount, tu.POSTED ='POSTED',tu.DATE=CURRENT_DATE,tu.CODE='$codexx' where tu.ID=ts.ID and ts.ID=$transaction and ts.credit >=$amount and ts.credit2 >=$amount";
mysqli_query($connect2,$x)or die(mysqli_error($connect2));
$_SESSION['message']="BANK PROCESSING ID ".$codexx;exit;	
}

//if(   ($reversal =='reversal') &&(reversalslip >0 ) && (!empty($code))  )
if (($reversal =='reversal') && (!empty($code))  && (!empty($reversalslip)) )
{
 $x="INSERT INTO  $company.deposituploads (transaction,credit,credit2,account,code,depositdate,date) SELECT TRANSACTION,CREDIT,CREDIT,CONCAT('$account'),CONCAT('$code'),DEPOSITDATE,DATE FROM COMPANY.WATERACCOUNTS WHERE ID =$reversalslip ";mysqli_query($connect,$x)or die(mysqli_error($connect));

 $x="UPDATE deposituploads SET depositdate = replace(depositdate, '/', '-')  WHERE  status !='PROCESSED'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE deposituploads  SET depositdate = str_to_date(depositdate,'%d-%m-%Y') WHERE   status !='PROCESSED'    ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO $wateraccountstable(TRANSACTION,CREDIT,ACCOUNT,DEPOSITDATE,CODE,CREDIT2,DATE) 
SELECT TRANSACTION,-1*CREDIT,ACCOUNT,DEPOSITDATE,CODE,-1* CREDIT2,DATE FROM DEPOSITUPLOADS WHERE  STATUS!='PROCESSED' AND ACCOUNT ='$account';";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date)  
SELECT CONCAT('$user'),CONCAT(CURRENT_TIMESTAMP),CONCAT('ENTERED NEW REVERSAL SLIP REFF ',TRANSACTION,'ACC $account WORTH ',CREDIT ),CONCAT(CURRENT_DATE) FROM DEPOSITUPLOADS WHERE  STATUS!='PROCESSED' AND ACCOUNT ='$account';";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="DELETE FROM DEPOSITUPLOADS WHERE ACCOUNT ='$account'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE COMPANY.WATERACCOUNTS SET POSTED='POSTED' ,DATE =CURRENT_DATE ,code='$code' WHERE ID =$reversalslip";mysqli_query($connect2,$x)or die(mysqli_error($connect2));
$_SESSION['message']="REVERSED SLIP  ";exit; 	
}

////////////////////////
/*$x="SELECT number FROM zones WHERE NUMBER !=$zone ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{			
$i=$y['number']; $wateraccountstable2='wateraccounts'.$i;
$b="SELECT * FROM $wateraccountstable2  WHERE    transaction='$slip'   AND depositdate='$postdate' ";$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){ $_SESSION['message']="SLIP EXISTING  IN  ZONE ".$i;header("LOCATION:bankstatements.php");exit;}

	
		}
		} */
	

//$x="SELECT * FROM $wateraccountstable  WHERE    transaction='$slip'   AND depositdate='$postdate' ";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
//if(mysqli_num_rows($x)>0){ $_SESSION['message']="SLIP EXISTING IN  ZONE ".$zone;header("LOCATION:bankstatements.php");exit;}	
///////////////////////////////		

$x="INSERT INTO  $wateraccountstable (transaction,credit,date,credit2,account,code,depositdate,paypoint) 
VALUES('$slip',$amount,now(),$amount,'$account','$code','$postdate','$paypoint')";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT MAX(id) FROM $wateraccountstable ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$reff=$y['MAX(id)'];}}

$x="UPDATE $accountstable SET id2='$slip'  WHERE  account='$account'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'ENTER NEW SLIP REFF $reff TR-NUMBER $slip  ACC $account Worth $amount',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect)); 
$_SESSION['message']="SLIP UPDATED";header("LOCATION:bankstatements.php");
exit;
?>