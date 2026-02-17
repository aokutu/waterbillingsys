<?php
@session_start();
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="FINANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights'
OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'PHAMARCY'  
OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'LAB & IMAGING' 
OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'POINT OF SALE' 
 ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


class invoicedetails
{
public $patient=null;
public $rinvoicenumber=null;
}
$invoicedetails=new invoicedetails;
$invoicedetails->patient=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));
$invoicedetails->invoicenumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['invoicenumber']))));

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
		#teller td:nth-child(1),td:nth-child(3),td:nth-child(2),td:nth-child(4){ width: 25%;}
		#paticulars td:nth-child(2){ width: 40%;}
		#paticulars td:nth-child(1){ width: 5%;}
	 @media print {
	  button{
	  display: none;}
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
								<td class="title" style="display: flex;justify-content: center;align-items: center;">
									<img src="letterhead.png" style="width: 65%; max-width: 60%;text-align:center;" />
								</td>

								
							</tr>
						</table>
					</td>
				</tr>
				<tr >
					<td colspan="2">
						<table  style="border: 1px solid black; border-collapse: collapse;" >
							<tr>
								<td style="font-weight:bold;font-decoration:underline;text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;" class="title">INVOICE   
								<button class="btn-info btn-sm" onclick="window.print()"> <i style="font-size:200%;" class="fas fa-print"></i>PRINT</button>
</h2>
								</td>

								
							</tr>
						</table>
					</td>
				</tr>


			
<?php 
$x=$connect->query("SELECT invoicerecords.ADMISSIONDATE,invoicerecords.DISCHARGEDATE,invoicerecords.CASHIER,invoicerecords.PATIENTCLASS,invoicerecords.INSUARANCE,invoicerecords.INSUARANCEREFF,
TIMESTAMPDIFF(YEAR, invoicerecords.BIRTHDATE, DATE_ADD(NOW(), INTERVAL 10 HOUR)) AS YRS,
TIMESTAMPDIFF(MONTH,invoicerecords.BIRTHDATE, DATE_ADD(NOW(), INTERVAL 10 HOUR)) % 12 AS  MONTHS,GENDER,CLIENT,ACCOUNT,invoicerecords.DATE,INVOICENUMBER  
FROM patientsrecord,invoicerecords WHERE invoicerecords.INVOICENUMBER='$invoicedetails->invoicenumber' 
AND ACCOUNT='$invoicedetails->patient' AND patientsrecord.ACCOUNT=invoicerecords.CLIENTNUMBER ");
while ($data = $x->fetch_object())
{
$cashier =$data->CASHIER;
	?>
	<tr class="heading">
				<table  style="border: 1px solid black; border-collapse: collapse;" >
				<tr  style="font-size:120%;"  ><td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;">INVOICE NUMBER :<br><?php print $data->INVOICENUMBER; ?>

</td>
	 <td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >DATE <br><?php print $data->DATE; ?>
	</td></tr>
				
				</table>
				
					
				</tr>
	<tr class="item">
				<table>
				<tr   >
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
									PATIENT  NAME 
								</td>
								
									<td  style="text-decoration:underline;text-decoration-style: dotted;text-align:left;border: 1px solid black; border-collapse: collapse;" >
<?php print $data->CLIENT; ?>									
								</td>
				<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
									PATIENT  NUMBER
								</td>
								
									<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
<?php print $data->ACCOUNT; ?>									
								</td>
								
							</tr>
				</table>
					<table>
					
							<tr   >
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
									GENDER
								</td>
								
									<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
<?php print $data->GENDER; ?>									
								</td>
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
									AGE
								</td>
								
									<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
<?php print $data->YRS;?> YEARS <?php print $data->MONTHS;?> MONTHS									
								</td>
								
							</tr>
							
	<tr   >
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
									PATIENT CLASS
								</td>
								
									<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
<?php print $data->PATIENTCLASS; ?>									
								</td>
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
									INSURANCE
								</td>
								
									<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
<?php print $data->INSUARANCE; ?>									
								</td>
								
							</tr>

<tr   >
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
									INSURANCE NUMBER
								</td>
								
									<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
<?php print $data->INSUARANCEREFF; ?>									
								</td>
							<?php 
		if(($data->ADMISSIONDATE !='0000-00-00' ) AND  ($data->DISCHARGEDATE !='0000-00-00') )
		{ ?>
		<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
								ADMITTED <br>
								<?php print $data->ADMISSIONDATE; ?>
								</td>
								
									<td  style=" font-weight:bold;border: 1px solid black; border-collapse: collapse;" >
									DISCHARGED<br>
									<?php print $data->DISCHARGEDATE; ?>
								</td>
			
	<?php 	} else 
	{ ?>

<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;"></td>
	<td  style=" font-weight:bold;border: 1px solid black; border-collapse: collapse;" ></td>
		
<?	}	?>
								
								
							</tr>							
							
							
							
						</table>
				</tr>
				
<?php }
?>				
			<table  id="paticulars" style="font-size:120%;border: 1px solid black; border-collapse: collapse;">
				<tr class="heading" style="font-weight: bold;text-align:center;" >
		<td  style='border: 1px solid black; border-collapse: collapse;text-align:left;'>#</td>
					<td  style='border: 1px solid black; border-collapse: collapse;text-align:left;'>Item</td>
<td  style='border: 1px solid black; border-collapse: collapse;text-align:right;'>Price</td>
<td  style='border: 1px solid black; border-collapse: collapse;text-align:right;'>Qnty</td>
		<td  style='border: 1px solid black; border-collapse: collapse;text-align:right;'>AMOUNT</td>
				</tr>
				
<?php 
$number=0;
$x=$connect->query("SELECT DETAILS,TOTAL,GROSSTOTAL,UNIT,QUANTITY,PRICE,CASHIER,DATE,INVOICENUMBER,PATIENTNUMBER FROM invoicedetails WHERE 
INVOICENUMBER='$invoicedetails->invoicenumber'  ");
while ($data = $x->fetch_object())
{
$number+=1;	
?>
	<tr style="font-weight: bold;text-align:center;" >
			<td  style='border: 1px solid black; border-collapse: collapse;text-align:left;'><?php print $number; ?></td>
					<td  style='border: 1px solid black; border-collapse: collapse;text-align:left;'><?php print $data->DETAILS; ?> <?php print $data->UNIT; ?></td>
<td  style='border: 1px solid black; border-collapse: collapse;text-align:right;'><?php print number_format($data->PRICE,2); ?></td>
<td  style='border: 1px solid black; border-collapse: collapse;text-align:right;'><?php print $data->QUANTITY; ?></td>
					<td  style='border: 1px solid black; border-collapse: collapse;text-align:right;'><?php print number_format($data->TOTAL,2); ?></td>
				</tr>
<?php
} 
?>
		

<?php 
$x=$connect->query("SELECT SUM(TOTAL) AS TTL   FROM invoicedetails WHERE INVOICENUMBER='$invoicedetails->invoicenumber'  ");
while ($data = $x->fetch_object())
{
?>
	<tr style="font-weight: bold;text-align:center;" >
			<td  style='border: 1px solid black; border-collapse: collapse;text-align:left;'></td>
					<td  style='border: 1px solid black; border-collapse: collapse;text-align:left;'>TOTAL </td>
<td  style='border: 1px solid black; border-collapse: collapse;text-align:right;'></td>
<td  style='border: 1px solid black; border-collapse: collapse;text-align:right;'></td>
					<td  style='border: 1px solid black; border-collapse: collapse;text-align:right;'><?php print number_format($data->TTL,2); ?></td>
				</tr>
<?php
} 
?>

		
				
				<tr     >

					
							</table>
						<table id="teller">
					
							<tr   >
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
									INVOICE GENERATED BY
								</td>
								
									<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
<?php print $cashier; ?>									
								</td>
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
									
								</td>
								
									<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
									
								</td>
								
							</tr>
							
							
							
							
							
						</table>
						
							<table id="teller">
					
							<tr   >
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;text-align:center;">
								wishing  you a quick recovery								
								</td>
								
							</tr>
							
							
							
							
							
						</table>
							
			</table>
		</div>
	</body>
</html>
 