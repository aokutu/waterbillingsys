<!DOCTYPE html>
<?php 
 @session_start();
 require_once 'vendor/autoload.php';
use NumberToWords\NumberToWords;

// create the number to words "manager" class
$numberToWords = new NumberToWords();

// build a new number transformer using the RFC 3066 language identifier
$numberTransformer = $numberToWords->getNumberTransformer('en');

$user=$_SESSION['user'];
$password=$_SESSION['password'];

include_once("../password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  AND  ACCESS  REGEXP  'VIEW BILLS'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
$billingdate=$_SESSION['billingdate'];

$x="SELECT * FROM $accountstable  WHERE  account='$account' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $_SESSION['client']=$y['client'];$account=$y['account']; $status=$y['status'];$size=$y['size']; $class=$y['class']; $lastreading=$y['email'];$location=$y['location'];  $contact=$y['contact'];$deposit=number_format($y['deposit'],2);}}
	

		
		   $x="SELECT CONCAT(ACCOUNT,'-',DATE,'-',BALANCE,'-','$user')  AS REFF ,COMMISSION,METERNUMBER,PREVIOUS,CURRENT,UNITS,CHARGES,METERCHARGES,BALANCE,DATE,YEAR(DATE),MONTH(DATE),ID FROM  $billstable WHERE ACCOUNT='$account'  AND DATE <='".$_SESSION['billingdate']."' AND ID= (SELECT MAX(ID) FROM $billstable WHERE ACCOUNT='$account' AND DATE <='".$_SESSION['billingdate']."  ORDER BY DATE DESC LIMIT 1 '  ) ";
	    	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ $reffnumber=$y['REFF']; $billid=$y['ID'];$ttlx=number_format($y['CHARGES']+$y['COMMISSION'],2); $commissionx=$y['COMMISSION']; $meternumber=$y['METERNUMBER']; $previous=$y['PREVIOUS']; $current=$y['CURRENT'];$units=$y['UNITS']; $water=number_format($y['CHARGES'],2); $metercharges=number_format($y['METERCHARGES'],2);
	$monthlycharges=number_format($y['BALANCE'],2);  $readingdate=$y['DATE']; $year=$y['YEAR(DATE)'];$month=$y['MONTH(DATE)'];}}



$x="TRUNCATE  TABLE  statement " ;mysqli_query($connect,$x)or die(mysqli_error($connect));
///////////////previous//////////////
$x="SELECT SUM(balance) FROM  $billstable WHERE account='$account' AND date <='".$_SESSION['billingdate']."'   ";
		  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {$previousbill=$y['SUM(balance)'];}}

	  $x="SELECT SUM(credit) FROM $wateraccountstable  WHERE account='$account' AND depositdate <='".$_SESSION['billingdate']."'    AND  code =(SELECT CODE FROM paymentcode WHERE NAME ='WATER BILL' LIMIT 1)";
		  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {$previousdepsit=$y['SUM(credit)'];}}
		  $previousbill= $previousnonwaterbill+ $previousbill-$previousdepsit;
	  
		  //////////////////////////////////////////
$x="TRUNCATE  TABLE  statement " ;mysqli_query($connect,$x)or die(mysqli_error($connect));		  
//$x="insert  into STATEMENT(A,B,H,transaction,G) select concat('$date1'),concat('PREVIOUS BAL'),concat($previousbill),concat('PREVIOUS BAL'),concat($previousbill)";	mysqli_query($connect,$x)or die(mysqli_error($connect));
 $x="insert  into statement(A,B,C,H,transaction) select depositdate,code,transaction,-1* credit,concat('DEBIT')  FROM  $wateraccountstable  WHERE  DEPOSITDATE <='".$_SESSION['billingdate']."' AND account='$account'  AND CODE =(SELECT CODE FROM paymentcode WHERE NAME REGEXP 'WATER BILL')";	mysqli_query($connect,$x)or die(mysqli_error($connect));
 $x="insert  into statement(A,B,C,D,E,F,G,H,transaction) select date,current,previous,units,metercharges,refuse,charges,balance,concat('CREDIT')    FROM   $billstable  WHERE  account='$account'  AND DATE <='".$_SESSION['billingdate']."'   ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT IFNULL(MAX(ID),0) AS MAXID FROM statement ";
	  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$maxid=$y['MAXID'];}}
	
	$x="SELECT DATE  FROM $billstable  WHERE ACCOUNT='$account' AND DATE <='".$_SESSION['billingdate']."'  ORDER BY DATE DESC LIMIT 1,1";
	 	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$previusdate=$y['DATE']; }}
		else{$previusdate='NO PREVIOUS BILL';}
//	$x="SELECT DATE,BILLED,DEDUCTION,CURRENT,PREVIOUS,UNITS,LAST_DAY(DATE) AS LASTDAY,YEAR(DATE),MONTH(DATE),ID FROM $billstable  WHERE ACCOUNT='$account' AND DATE <='".$_SESSION['billingdate']."'  ORDER BY DATE DESC LIMIT 1";

$x="SELECT DATE,BILLED,DEDUCTION,CURRENT,PREVIOUS,UNITS,LAST_DAY(DATE) AS LASTDAY,YEAR(DATE),MONTH(DATE),ID FROM $billstable  WHERE ACCOUNT='$account' AND DATE <='".$_SESSION['billingdate']."' AND  ID = (SELECT MAX(ID) FROM $billstable WHERE ACCOUNT='$account' AND DATE <='".$_SESSION['billingdate']."  ORDER BY DATE DESC LIMIT 1 '  );";
	 	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ 
	$firstday=$y['YEAR(DATE)']."-".strtoupper(str_pad($y['MONTH(DATE)'], 2, "0", STR_PAD_LEFT))."-01";$lastday=$y['LASTDAY'];$duedate=$y['DATE'];$readingdate=$y['DATE']; $volume =number_format($y['BILLED'],2);$deduction=$y['DEDUCTION'];
	$current=number_format($y['CURRENT'],2);$deduction=number_format($y['DEDUCTION'],2);$units=number_format($y['UNITS'],2);
$billid=$y['ID'];$previous=number_format($y['PREVIOUS'],2);	
	}}
	
		  //////////////////////////////////////////
$x="TRUNCATE  TABLE  statement " ;mysqli_query($connect,$x)or die(mysqli_error($connect));		  
//$x="insert  into STATEMENT(A,B,H,transaction,G) select concat('$date1'),concat('PREVIOUS BAL'),concat($previousbill),concat('PREVIOUS BAL'),concat($previousbill)";	mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert  into statement(A,B,C,H,transaction) select depositdate,code,transaction,-1* credit,concat('DEBIT')  FROM  $wateraccountstable  WHERE DEPOSITDATE <='".$_SESSION['billingdate']."' AND  account='$account'  AND CODE =(SELECT CODE FROM paymentcode WHERE NAME REGEXP 'WATER BILL')";	mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert  into statement(A,B,C,D,E,F,G,H,I,transaction) select date,current,previous,units,metercharges,refuse,charges,balance,id,concat('CREDIT')    FROM   $billstable  WHERE  DATE <='".$_SESSION['billingdate']."' AND  account='$account'   ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT IFNULL(MAX(ID),0) AS MAXID FROM statement ";
	  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$maxid=$y['MAXID'];}}
	
	$x="SELECT SUM(H) FROM statement ";
  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$totalbal=$y['SUM(H)'];}} 
	
	$x="SELECT CREDIT,RECIEPTDATE,RECIEPTNUMBER FROM $wateraccountstable    WHERE ACCOUNT='$account' AND RECIEPTNUMBER !=''  AND DEPOSITDATE <='".$_SESSION['billingdate']."'   ORDER BY  ID DESC LIMIT 1 ";	
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
		//$recieptnumber=$y=['$wateraccountstable.RECIEPTNUMBER']; $lastamount=$y['CREDIT']; print $lastamount;
		$recieptamount=number_format($y['CREDIT'],2);$recieptnumber=strtoupper(str_pad($y['RECIEPTNUMBER'], 10, "0", STR_PAD_LEFT));  $recieptdate=$y['RECIEPTDATE'];  
			}}

?>

<html>
	<head>
		<meta charset="utf-8" />
		<title>LAWASCO SOFTWARES</title>

		<style>
			.invoice-box {
				max-width: 90%;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

  	<SCRIPT type="text/javascript">

    window.history.forward();

    function noBack() { window.history.forward(); }

</script>
<body  onLoad="noBackx();"  oncontextmenu="return false;"  >
		<div class="invoice-box">
			<table cellpadding="0.5" cellspacing="1">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="letterhead.png" style="width: 95%; max-width: 90%;text-align:center;" />
								</td>

								
							</tr>
						</table>
					</td>
				</tr>
				<tr >
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<h2 style="text-align:center;font-weight:bold;">WATER BILL  FOR MONTH OF 
								<?php 
		$x="SELECT YEAR('".$_SESSION['billingdate']."') AS YR,MONTHNAME('".$_SESSION['billingdate']."') AS MNTH ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
		    
	print  $y['YR'].'-'.$y['MNTH'];	    
		    
		}}
								
								?>	
									
									</h2>
								</td>

								
							</tr>
						</table>
					</td>
				</tr>


				<tr class="heading">
				<table  style="border: 1px solid black; border-collapse: collapse;" >
				<tr  style="font-size:120%;"  ><td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;">SERIAL NUMBER :<br><?php
	
	
	 
	 
	  $x=" SELECT CONCAT('$company/','$zone/',ACCOUNT,'/',ID)  AS REFF ,ID  FROM $billstable WHERE ACCOUNT='$account'  AND DATE <='".$_SESSION['billingdate']."'   ORDER BY DATE,ID DESC LIMIT 1  ";
	//$x=" SELECT CONCAT('$company/','$zone/',ID)  AS REFF FROM $billstable WHERE ACCOUNT='$account'  ORDER BY DATE,ID DESC LIMIT 1  ";

	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{print $y['REFF']; $reffnumber=$y['REFF'];$identity=$y['ID']; }}	 
	 ?> </td>
	 <td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >DATE <br><?php  
	/* $x="SELECT CURRENT_DATE ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		while ($y=@mysqli_fetch_array($x))
		{print $y['CURRENT_DATE'];}	
		
		}  */
		print $_SESSION['billingdate'];
?></td></tr>
				
				</table>
				
					
				</tr>

				
				<tr class="item">
				<table>
				<tr   >
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
									ACCOUNT NAME 
								</td>
								
									<td  style="text-decoration:underline;text-decoration-style: dotted;text-align:left;border: 1px solid black; border-collapse: collapse;" >
									<?php print strtoupper($_SESSION['client']);?>
								</td>
								
							</tr>
				</table>
					<table>
					
							<tr   >
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
									ACCOUNT NUMBER
								</td>
								
									<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
									<?php print strtoupper($account);?>
								</td>
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >
									CONSUMER TYPE
								</td>

								<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
									<?php
									
			if($class=='A'){$class='DOMESTIC';}
			else if($class=='B'){$class='COMMERCIAL';}
			else if($class=='c'){$class='SCHOOL';}
			else if($class=='D'){$class='KIOSK';}
									
									print $class;?>
									
								</td>
							</tr>
							
							<tr   >
								<td  style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >
									SUPPLY LOCATION
								</td>
								
									<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
									<?php print $location; ?>
								</td>
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >
									DEPOSIT
								</td>

								<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
									<?php print $deposit;?>
									
								</td>
							</tr>
							<tr   >
								<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >
									METER SIZE
								</td>
								
									<td   style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
									<?php print $size;?>
								</td>
								<td  style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >
									METER NUMBER
								</td>

								<td    style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;">
									<?php print strtoupper($meternumber);?>
									
								</td>
							</tr>
							
							<tr   >
								<td  style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
									CONSUMTION FROM 
								</td>
								
									<td   style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
									<?php print $previusdate;?>
								</td>
								<td  style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >
									TO
								</td>

								<td   style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
									<?php print $readingdate;?>
									
								</td>
							</tr>
							<tr style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;"   >
								<td style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >
									BILLING CONCEPT
								</td>
								
							</tr>
							
							
							
						</table>
				</tr>
				<table style="font-size:120%;border: 1px solid black; border-collapse: collapse;">
				<tr     >
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >CURRENT READING M<sup>3</sup></td>
					<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" ><?php print $current;?></td>
					</tr>
					<tr    >
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >PREVIOUS READING M<sup>3</sup></td>
					<td   style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" ><?php print $previous;?></td>
					</tr>
					<tr    >
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">UNIT PASSED M<sup>3</sup></td>
					<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" ><?php print $volume;?></td>
					</tr>
					<tr    >
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >DEDUCTIONS M<sup>3</sup></td>
					<td   style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;">  <?php print $deduction;?> </td>
					</tr>
					<tr    >
					<td  style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >NET UNITS M<sup>3</sup></td>
					<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" ><?php print $units;?></td>
					</tr>
				
					<tr    >
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">WATER CHARGES KSHS.</td>
					<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" ><?php print $ttlx;?></td>
					</tr>
				
					<tr    >
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >METER RENT  KSHS.</td>
					<td  style="text-decoration:underline;text-decoration-style: dotted;" ><?php print $metercharges;?></td>
					</tr>
					<tr    >
					<td   style="font-weight:bold;" >OTHERS  KSHS.</td>
					<td   style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;"></td>
					</tr>
					<tr    >
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">AMOUNT NOW DUES KSHS.</td>
					<td  style="text-decoration:underline;text-decoration-style: dotted;"  ><?php
$x=" SELECT (  SELECT IFNULL(SUM(BALANCE),0) FROM  $billstable WHERE ACCOUNT='$account'  AND DATE <='".$_SESSION['billingdate']."' )- ( SELECT IFNULL(SUM(CREDIT),0)  FROM  $wateraccountstable  WHERE  DEPOSITDATE  <='".$_SESSION['billingdate']."' AND ACCOUNT='$account'   AND CODE =(SELECT CODE FROM paymentcode WHERE NAME REGEXP 'WATER BILL' LIMIT 1) ) AS TTL";
//$x="SELECT(SELECT SUM(CREDIT) FROM $wateraccountstable WHERE  DEPOSITDATE <='".$_SESSION['billingdate']."' AND CODE =(SELECT CODE FROM paymentcode WHERE NAME REGEXP 'WATER BILL' LIMIT 1) AND ACCOUNT ='$account') AS TTL ";

$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		while ($y=@mysqli_fetch_array($x))
		{ $ttlpay=$y['TTL'];}}


	$x="SELECT BALANCE FROM $billstable WHERE ACCOUNT='$account'  AND ID ='$billid'  ORDER BY DATE DESC LIMIT 1";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		while ($y=@mysqli_fetch_array($x))
		{ $monthlycharges=$y['BALANCE'];}}



					print number_format($monthlycharges,2);?></td>
					</tr>
					<tr    >
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">BALANCE B/F KSHS.</td>
					<td   style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
					<?php 
	$balbf=$ttlpay-$monthlycharges;
print number_format($balbf,2);
	
					?>
					</td>
					</tr>
					<tr    >
					<td  style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">TOTAL AMOUNT DUE KSHS.</td>
					<td   style="text-decoration:underline;text-decoration-style: dotted;" > <?php  print number_format($totalbal,2); ?></td>
					</tr>
					<tr    >
					<td  style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">PREPARED BY </td>
					<td   style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;"><?php print $user;?></td>
					</tr>
					
					
							</table>
							<table>
					<tr>
				<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >YOUR LAST PAY WAS </td><td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;"><?php print $recieptamount; ?></td><td  style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >VIDE RECEIPT NO.</td><td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;"><?php  print $recieptnumber;?></td>
<td  style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >DATED </td><td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;"><?php  print $recieptdate;?></td>				
					</tr>
						
							</table>
						
							<table>
					<tr>
				<td style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;"  >Note:
(a) In accordance with the Water Act 2016 No, 43 and the Kenya Gazette Notice No. 7538 Charges are payable on Due Date or on Demand.
(b) LAWASCO must be notified of any change in tenancy or the vacation of premises. The Landlord or agent must ensure all bills have been cleared before
vacation, if not the last known occupier, the new tenant, the agent or the Landlord will be responsible for all charges.</td>	
					</tr>	
	<tr>
				<td style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;">WARNING NOTICE No……………<br>
Unless the total amount is received by LAWASCO on due date water will be cut off without further notice and proceedings taken for recovery of the amount.</td>	
					</tr>				
					
<tr>
				<td style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;">PAY BEFORE: 5 th Day of Every Month A fee of Kshs.1,000/= is payable for Re-connection or as described by Gazette Notice No. 7538.</td>	
					</tr>
<tr>
				<td style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;">PAY Through M-PESA PAY BILL NO. 4085631 or PAY to EQUITY BANK</td>	
					</tr>					
							
							</table>
							
			</table>
		</div>
	</body>
</html>
