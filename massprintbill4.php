<?php 
 @session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];

include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  AND  ACCESS  REGEXP  'BILLING'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
$account= $_SESSION['account'];

 $x=" SELECT CONCAT(ACCOUNT,'-',DATE,'-',BALANCE,'-','$user')  AS REFF   FROM $billstable WHERE ACCOUNT='$account'  ORDER BY DATE DESC LIMIT 1  ";
	//$x=" SELECT CONCAT('$company/','$zone/',ID)  AS REFF FROM $billstable WHERE ACCOUNT='$account'  ORDER BY DATE DESC LIMIT 1  ";

	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ $reffnumber=$y['REFF']; }}
	
$x="SELECT * FROM $accountstable  WHERE  account='$account' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $_SESSION['client']=$y['client'];$account=$y['account']; $status=$y['status'];$size=$y['size']; $class=$y['class']; $lastreading=$y['email'];$location=$y['location'];  $contact=$y['contact'];}}
	

		
		   $x="SELECT *,YEAR(date),MONTH(date) FROM  $billstable WHERE ACCOUNT='$account'  order  by id desc limit 1";
	    	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$meternumber=$y['meternumber']; $previous=$y['previous']; $current=$y['current'];$units=$y['units']; $water=number_format($y['charges'],2); $metercharges=number_format($y['metercharges'],2); $monthlycharges=number_format($y['balance'],2);  $readingdate=$y['date']; $year=$y['YEAR(date)'];$month=$y['MONTH(date)'];}}
$x="TRUNCATE  TABLE  STATEMENT " ;mysqli_query($connect,$x)or die(mysqli_error($connect));
///////////////previous//////////////
$x="SELECT SUM(balance) FROM  $billstable WHERE account='$account' AND date <'$date1'  ";
		  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {$previousbill=$y['SUM(balance)'];}}

	  $x="SELECT SUM(credit) FROM $wateraccountstable  WHERE account='$account' AND depositdate <'$date1'   AND  code =(SELECT CODE FROM PAYMENTCODE WHERE NAME ='WATER BILL' LIMIT 1)";
		  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {$previousdepsit=$y['SUM(credit)'];}}
		  $previousbill= $previousnonwaterbill+ $previousbill-$previousdepsit;
			  
		  //////////////////////////////////////////
$x="TRUNCATE  TABLE  STATEMENT " ;mysqli_query($connect,$x)or die(mysqli_error($connect));		  
//$x="insert  into STATEMENT(A,B,H,transaction,G) select concat('$date1'),concat('PREVIOUS BAL'),concat($previousbill),concat('PREVIOUS BAL'),concat($previousbill)";	mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert  into STATEMENT(A,B,C,H,transaction) select depositdate,code,transaction,-1* credit,concat('DEBIT')  FROM  $wateraccountstable  WHERE  account='$account'  AND CODE =(SELECT CODE FROM PAYMENTCODE WHERE NAME REGEXP 'WATER BILL')";	mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert  into STATEMENT(A,B,C,D,E,F,G,H,transaction) select date,current,previous,units,metercharges,refuse,charges,balance,concat('CREDIT')    FROM   $billstable  WHERE  account='$account'   ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT IFNULL(MAX(ID),0) AS MAXID FROM STATEMENT ";
	  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$maxid=$y['MAXID'];}}
?>


<!DOCTYPE html>
<html>
	<head>
	
		<meta charset="utf-8" />
		<title>A simple, clean, and responsive HTML invoice template</title>

		<style>
			.invoice-box {
				max-width: 800px;
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
			
			
	@media print
    {
		#nonprint{ display: none; }
        #invoice-box { display: block; }
		
    }
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top"  style="font-weight:bold">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="letterhead.png" style="width: 100%; max-width: 900px" />
								</td>

								<td style="font-size:80%;">
									Rcpt #: <?php
	
	
	 
	 
	  $x=" SELECT CONCAT('$company/','$zone/',ACCOUNT,'/',ID)  AS REFF ,ID  FROM $billstable WHERE ACCOUNT='$account'  ORDER BY DATE DESC LIMIT 1  ";
	//$x=" SELECT CONCAT('$company/','$zone/',ID)  AS REFF FROM $billstable WHERE ACCOUNT='$account'  ORDER BY DATE DESC LIMIT 1  ";

	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{print $y['REFF']; $reffnumber=$y['REFF'];$identity=$y['ID']; }}	 
	 ?><br />
									<?php print $recieptdate; ?><br />
									<?php print  date('Y-M-d');?><br>
									<?php
	$x="SELECT CODE,NAME FROM PAYMENTCODE WHERE NAME REGEXP 'WATER BILL' LIMIT 1";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{print $y['NAME']."-".$y['CODE'];}}
	?><br>
	BILLING MONTH <?php 	
		$x="SELECT YEAR(DATE),MONTH(DATE),DATE FROM $billstable  WHERE ACCOUNT='$account'   ORDER BY DATE DESC LIMIT 1";
	 	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$imgdate=$y['DATE'];  $monthx=$y['MONTH(DATE)']; if(strlen($monthx)==1){$monthx='0'.$monthx;}  print $y['YEAR(DATE)'].'-'.$monthx;}}
	
	?><br>BILLING DATE 
	<?php
	$x="SELECT DATE FROM $billstable  WHERE ACCOUNT='$account'   ORDER BY DATE DESC LIMIT 1";
	 	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ print $y['DATE'];$readingdate=$y['DATE'];}}
	
	?><br>PREVIOUS BILLING DATE
	<?php
	$x="SELECT DATE FROM $billstable WHERE DATE <'$readingdate'  AND ACCOUNT='$account'   ORDER BY DATE DESC LIMIT 1";
	 	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ print $y['DATE'];}}
	
	?>
									
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2"   style="font-weight:bold" >
						<table>
							<tr>
								<td>
									LAKWA .<br />
									P.O.BOX 486-80500<br />
									Mpeketoni
								</td>

								<td>
									<?php print strtoupper($_SESSION['client']);?>.<br />
									AC-<?php print strtoupper($account);?>.<br />
									METER-<?php print strtoupper($meternumber);?>.<br />
									
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>ATTENDANT</td>

					<td><?php print $user;?></td>
				</tr>
				
				<tr>
					<td colspan="2"   style="font-size:80%;" >
						<table>
							<tr>
								<td>
									CURRENT READING
								</td>
								<td>
									PREVIOUS READING
								</td>
								<td>
									VOLUME
								</td>

								<td>
									DEDUCTION
								</td>
								<td>
									BILLED
								</td>
								
							</tr>
									<tr>
								<td>
									<?php print $current;?>
								</td>
								<td>
									<?php print $previous;?>
								</td>
								<td>
									VOLUME
								</td>

								<td>
									DEDUCTION
								</td>
								<td>
									<?php print $units;?> M &sup3;
								</td>
								
							</tr>
							
								<tr>
								<td>
									WATER CHARGES
								</td>
								<td>
									STANDING CHARGES
								</td>
								<td>
									TOTAL
								</td>

								<td>
									ARREARS
								</td>
								<td>
									TOTAL BAL
								</td>
								
							</tr>
							<tr>
								<td>
									<?php print $water;?>
								</td>
								<td>
									<?php print $metercharges;?>
								</td>
								<td>
									<?php print $monthlycharges;?>
								</td>

								<td>
									<?php
	
	
	 
	 
	//   $x=" SELECT (  SELECT IFNULL(SUM(BALANCE),0) FROM  $billstable WHERE ACCOUNT='$account'  AND DATE <'$readingdate' )-( SELECT IFNULL(SUM(CREDIT),0)  FROM  $wateraccountstable  WHERE ACCOUNT='$account' AND DATE <'$readingdate'  AND CODE =(SELECT CODE FROM PAYMENTCODE WHERE NAME REGEXP 'WATER BILL' LIMIT 1)) AS TTL";
	$x="SELECT IFNULL(SUM(H),0) AS TTL FROM STATEMENT WHERE  ID <$maxid ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{print number_format($y['TTL'],2); }}	 
	 ?>
								</td>
								<td>
										   <?php 

if(empty($maxid)){   print " <tr><td>NO</td><td>PENDING </td><td></td><td>BALANCE</td><td>ARREAS B/F</td><td></td></tr> ";exit;}
$x="SELECT SUM(H) FROM STATEMENT  WHERE A >'$date1' AND A < (SELECT A FROM STATEMENT WHERE ID=$maxid) ";
  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$currentbal=$y['SUM(H)'];}} 

$x="SELECT SUM(H) FROM STATEMENT ";
  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$totalbal=$y['SUM(H)'];}}   	
	   ?>

<?php

$x="SELECT *,YEAR(date),MONTH(date) FROM  $nonwaterbills WHERE ACCOUNT='$account' AND DATE >='".date("Y-m")."' order  by id desc ";
	    	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$meternumber=$y['meternumber'];$name=$y['name'];$charges=number_format($y['amount'],2);$ttlnonwater += $y['amount'];
	
	}}
	
	


 ?>
 <?php  print number_format($totalbal,2); ?>
								</td>
								
							</tr>
						</table>
					</td>
				</tr>

				<tr class="details" style="width:50%;">

				</tr>
	<tr class="total"   style="font-weight:bold">
					<td>TOTAL</td>

					<td>
					
<?php

				
print number_format($totalbal,2);
?>
					</td>
					
				</tr>
					<tr class="total"   style="font-weight:bold">
					<td>TOTAL IN WORDS</td>

					<td>
					
<?php
$_SESSION['total']=$totalbal;				
include_once("backup/reciept.php");
?>
					</td>
					
				</tr>
				<tr class="heading">
					<td>PAY BY MPESA NUMBER 52237 </td>

					<td></td>
				</tr>
			<tr class="item">
			
				<?php
				
		$x="SELECT $wateraccountstable.CODE,NAME,CREDIT FROM $wateraccountstable,PAYMENTCODE WHERE $wateraccountstable.CODE=PAYMENTCODE.CODE AND $wateraccountstable.RECIEPTNUMBER='$recieptnumber'";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
			
		print "<td>".$y['NAME']."</td>";	
		print "<td>".number_format($y['CREDIT'],2)."</td>";	
			
		}}
				
				?>
				</tr>

	

			
			</table>
		</div>
		<div  id="nonprint">
		<form method="post">
		<button class="btn-info btn-sm" onclick="window.print()">PRINT</button>
		<a href="reciepts.php" class="button">
		RECIEPTS TABLE
		</a>
		
		</form>
		
		
		</div>
	</body>
</html>



