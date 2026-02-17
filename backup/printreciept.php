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

$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'VIEW RECIEPTS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
  else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:../dashboard.php");exit;}
  
  
 @$payid= $_SESSION['payid'];$recieptnumber=$_SESSION['recieptnumber'];
 $recieptdate=$_SESSION['recieptdate'];

  $x="SELECT CLIENT,$wateraccountstable.ACCOUNT,$wateraccountstable.DEPOSITDATE,$wateraccountstable.PAYPOINT,$wateraccountstable.TRANSACTION FROM $wateraccountstable,$accountstable WHERE $wateraccountstable.ACCOUNT=$accountstable.ACCOUNT AND $wateraccountstable.RECIEPTNUMBER='".$_SESSION['recieptnumber']."'";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ 	$client=$y['CLIENT'];$account=$y['ACCOUNT'];$depositdate=$y['DEPOSITDATE'];$paypoint=$y['PAYPOINT'];$transaction=$y['TRANSACTION'];	   }}


	
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
									<img src="letterhead.png" style="width: 95%; max-width: 90%;text-align:center;" />
									<?php print $client;?>
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
									<h2 style="text-align:center;font-weight:bold;">PAYMENT RECEIPT</h2>
								</td>

								
							</tr>
						</table>
					</td>
				</tr>


				<tr class="heading">
				<table  style="border: 1px solid black; border-collapse: collapse;" >
				<tr  style="font-size:120%;"  ><td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;">SERIAL NUMBER :<br>

<?php print strtoupper(str_pad($recieptnumber, 10, "0", STR_PAD_LEFT)); ?>				</td>
	 <td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >DATE <br>
	 <?php print $recieptdate; ?></td></tr>
				
				</table>
				
					
				</tr>

				
				<tr class="item">
				<table>
				<tr   >
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
									ACCOUNT NAME 
								</td>
								
									<td  style="text-decoration:underline;text-decoration-style: dotted;text-align:center;border: 1px solid black; border-collapse: collapse;" >
									<?php print strtoupper($client);?>
								</td>
								
							</tr>
							<tr >
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
									ACCOUNT NUMBER
								</td>
								
									<td  style="text-align:center;text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
									<?php print strtoupper($account);?>
								</td>
								
							</tr>
				</table>
					
				</tr>
				<table style="font-size:120%;border: 1px solid black; border-collapse: collapse;">
				<tr class="heading" style="font-weight: bold;text-align:center;" >
					<td  style='border: 1px solid black; border-collapse: collapse;text-align:center;'>Item</td>

					<td  style='border: 1px solid black; border-collapse: collapse;text-align:center;'>AMOUNT</td>
				</tr>
						
				<?php
				
		$x="SELECT $wateraccountstable.CODE,NAME,CREDIT FROM $wateraccountstable,paymentcode WHERE $wateraccountstable.CODE=paymentcode.CODE AND $wateraccountstable.RECIEPTNUMBER='$recieptnumber'";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
		print "<tr class='item' style='text-align:center;'>";	
		print "<td  style='border: 1px solid black; border-collapse: collapse;'>".$y['NAME']."</td>";	
		print "<td  style='border: 1px solid black; border-collapse: collapse;text-align:center;' >".number_format($y['CREDIT'],2)."</td>";	
		print "</tr>";	
		}}
		
		
		$x="SELECT SUM(CREDIT) FROM $wateraccountstable WHERE  $wateraccountstable.RECIEPTNUMBER='$recieptnumber'";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$totalbal=$y['SUM(CREDIT)'];
		print "<tr class='item' style='text-align:center;'>";	
		print "<td  style='border: 1px solid black; border-collapse: collapse;font-weight: bold;'>TOTAL</td>";	
		print "<td  style='border: 1px solid black; border-collapse: collapse;text-align:center;font-weight: bold;' >".number_format($y['SUM(CREDIT)'],2)."</td>";	
		print "</tr>";	
		}}
				
				?>
	<tr  class='item' style='text-align:center;' >
	<td style='border: 1px solid black; border-collapse: collapse;font-weight: bold;' >TOTAL IN WORDS</td>
	<td style='border: 1px solid black; border-collapse: collapse;font-weight: bold;text-align:center;' >
<?php


$totalbal=round($totalbal,2);
$whole=intval($totalbal);
$decimal1 = $totalbal - $whole;
$decimal2 = round($decimal1, 2)*100; 
if($decimal2==0){
print strtoupper($numberTransformer->toWords($whole));
}
else if($decimal2 !=0){
print strtoupper($numberTransformer->toWords($whole))." AND ".strtoupper($numberTransformer->toWords(abs($decimal2)))." CENTS";
}


?>	
	
	</td>
				
				</tr>
				
				<tr     >
<tr class="heading" style="font-weight: bold;text-align:center;" >
<table>
<tr>
					<td  style='border: 1px solid black; border-collapse: collapse;text-align:center;font-weight: bold;'>CLERK</td>

					<td  style='border: 1px solid black; border-collapse: collapse;text-align:center;font-weight: bold;'><?php print $user; ?></td>
					<td  style='border: 1px solid black; border-collapse: collapse;text-align:center;font-weight: bold;'>SIGN</td>
					<td  style='border: 1px solid black; border-collapse: collapse;text-align:center;font-weight: bold;'><br>......................</td>
					</tr>
					<table>
				</tr>	
				
					
					
							</table>
							
			</table>
		</div>
	</body>
</html>
