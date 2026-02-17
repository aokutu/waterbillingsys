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
@$serialnumber=$_SESSION['serialnumber'];
include_once("../password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
@$serialnumber=$_SESSION['serialnumber'];

			$x="SELECT   CONTACT,NAMES,PLOTNUMBER,PREPARER,LOCATION  FROM CLIENTQUOTATIONS WHERE SERIALNUMBER='$serialnumber' LIMIT 1  ";
					$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ $names=$y['NAMES'];$plotnumber=$y['PLOTNUMBER'];$preparer=$y['PREPARER'];$location=$y['LOCATION'];$contact=$y['CONTACT'];}}
?>

<html>
	<head>
		<meta charset="utf-8" />
		<title>HADDASSAHSOFTWARES</title>

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
			body{ margin-right:2%;margin-left:2%;}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0.5" cellspacing="1">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="letterhead3.png" style="width: 95%; max-width: 90%;text-align:center;" />
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
									<h2 style="text-align:center;font-weight:bold;">CLIENT'S QUOTATION </h2>
								</td>

								
							</tr>
						</table>
					</td>
				</tr>


				<tr class="heading">		
					
				</tr>

				
				<tr class="item">
			
					<table  style="font-size:80%;">
					
							</tr>
							
				
							<tr    >
								<td  style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;"  >
									DATE
								</td>
								<td  style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;"  >
									<?php  
		$x="SELECT  CONCAT(DAY(CURRENT_DATE),'-',MONTHNAME(CURRENT_DATE),'-',YEAR(CURRENT_DATE)) AS DATE , CURRENT_TIME AS TIME ";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ print $y['DATE'].":".$y['TIME'];}}
				?>
								</td>
								<td  style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;"  >
									QUOTATION SERIAL NUMBER
								</td>
								<td  style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;"  >
									<?php  print strtoupper(str_pad($_SESSION['serialnumber'], 10, "0", STR_PAD_LEFT));?>
								</td>
								
								
							</tr>
							<tr    >
								<td  style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;"  >
									PLOT NO.<?php  print $plotnumber;?>
								</td>
								<td  style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;"  >
									CONTACT:<?php print $contact; ?>
								</td>
								<td  style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;"  >
								NAME: <?php print $names; ?>
								</td>
								<td  style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;"  >
									LOCATION :<?php  print $location;;?>
								</td>
								
								
							
							
						</table>
						<hr>
				</tr>
				<table style="font-size:80%;border: 1px solid black; border-collapse: collapse;">
				<tr     >
				<td width="6%"  style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >ITEM </td>
					<td   style="font-weight:bold;border: 1px solid black;text-align:left; border-collapse: collapse;" >ITEM DESCRIPTION </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >UNIT </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >QTY </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >PRICE </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >VALUE </td>
					
					</tr>
					
					
					
					<?php 
					$number=0;
					$x="SELECT   ITEM,UNITS,PRICE,QUANTITY,AMOUNT  FROM CLIENTQUOTATIONS WHERE SERIALNUMBER='$serialnumber' AND ITEM NOT LIKE 'WAIVER%'  ";
					$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ $number +=1;
		$requisitionertitle=$y['REQUISITIONERTITLE'];$authorizer=$y['AUTHORIZER'];$authorizertitle=$y['AUTHORIZERTITLE'];	
	print "<tr >	
					<td  width='6%' style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$number." </td>
					<td   style='font-weight:narrow;border: 1px solid black;text-align:left; border-collapse: collapse;' >".$y['ITEM']."  </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['UNITS']." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['QUANTITY']." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".number_format($y['PRICE'],2)." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".number_format($y['AMOUNT'],2)." </td>
					</tr>";
			
		}}
		
					$x="SELECT  SUM(AMOUNT)  FROM CLIENTQUOTATIONS WHERE SERIALNUMBER='$serialnumber' AND ITEM NOT LIKE 'WAIVER%'  ";
					$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
		$requisitionertitle=$y['REQUISITIONERTITLE'];$authorizer=$y['AUTHORIZER'];$authorizertitle=$y['AUTHORIZERTITLE'];	
	print "<tr ><td  width='6%' style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>	
				<td   style='font-weight:bold;border: 1px solid black;text-align:left; border-collapse: collapse;' >PREPARED BY: ".$preparer."</td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' ></td>
					<td   style='font-weight:bold;border: 1px solid black; border-collapse: collapse;' >TOTAL</td>
					<td   style='font-weight:bold;border: 1px solid black; border-collapse: collapse;' >".number_format($y['SUM(AMOUNT)'],2)." </td></tr>";
			
		}}
		
		
				
		
		
		
					
					?>
					
					
					
					
									
					
					</table><h4 style="font-weight:bold;text-align:center;">WAIVERS </h4>
			<table>
			<?php 
	$number=0;
					$x="SELECT   ITEM,ABS(AMOUNT)  FROM CLIENTQUOTATIONS WHERE SERIALNUMBER='$serialnumber' AND ITEM  LIKE 'WAIVER%'  ";
					$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ $number +=1;
			
	print "<tr >	
					<td  width='6%' style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$number." </td>
					<td   style='font-weight:narrow;border: 1px solid black;text-align:left; border-collapse: collapse;' >".$y['ITEM']."  </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".number_format($y['ABS(AMOUNT)'],2)." </td>
					</tr>
					";
			
		}}		
			
			$x="SELECT   ABS(SUM(AMOUNT))  FROM CLIENTQUOTATIONS WHERE SERIALNUMBER='$serialnumber' AND ITEM  LIKE 'WAIVER%'  ";
					$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ 
		$requisitionertitle=$y['REQUISITIONERTITLE'];$authorizer=$y['AUTHORIZER'];$authorizertitle=$y['AUTHORIZERTITLE'];	
	print "<tr >	
					<td  width='6%' style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:bold;border: 1px solid black;text-align:left; border-collapse: collapse;' >TOTAL WAIVER  </td>
					<td   style='font-weight:bold;border: 1px solid black; border-collapse: collapse;' >".number_format($y['ABS(SUM(AMOUNT))'],2)." </td>
					</tr>
					";
			
		}}				
		
			?>
			
			
			</table>
			<hr>
<table>
<?php
$x="SELECT PREPARER,SUM(AMOUNT)  FROM CLIENTQUOTATIONS WHERE SERIALNUMBER='$serialnumber'   ";
					$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ 
	print "<tr >	
					
					<td   style='font-weight:bold;border: 1px solid black;text-align:left; border-collapse: collapse;' >PREPARED BY : ".$y['PREPARER']."</td>
					<td   style='font-weight:bold;border: 1px solid black;text-align:left; border-collapse: collapse;' >ACTUAL CHARGES  </td>
					<td   style='font-weight:bold;border: 1px solid black; border-collapse: collapse;' >".number_format($y['SUM(AMOUNT)'],2)." </td>
					</tr>
					";
			
		}}

?>
</table>

<table  style="font-size:70%;font-weight:bold;" >
			
<tr><td style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;">PAY TO:K.C.B ACCOUNT NUMBER 1108110320---Equity Account Number 1270298313208---Co-op Account Number 01136561808400---M-pesa Pay Bill No.522237 ---EQUITY PAYBILL 4040391---CO-OP PAY BILL 400222 Business Code 538199#A/c No.</td>	
</tr>
	</table>
							
					
					
					
					<br><br>
							<table >
							<tr >
							<td   style="font-weight:bold;text-align:left;" >MANAGER </td>
							<td   style="font-weight:bold;text-alig:center;" >TREASURER </td>
							<td   style="font-weight:bold;text-align:right;" >CHAIRPERSON </td>
							</tr>
							</table>
							
			</table>
		</div>
	</body>
</html>
