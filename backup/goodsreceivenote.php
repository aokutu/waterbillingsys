<!DOCTYPE html>
<?php 
 @session_start();
 require_once 'vendor/autoload.php';


$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$serialnumber=$_SESSION['serialnumber'];
include_once("../password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND ACCESS  REGEXP  'INVENTORY REG'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:../dashboard.php");exit;}

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
									<h2 style="text-align:center;font-weight:bold;">GOODS RECEIVED NOTE </h2>
								</td>

								
							</tr>
						</table>
					</td>
				</tr>


				<tr class="heading">
				<table  style="border: 1px solid black; border-collapse: collapse;" >
				<tr  style="font-size:120%;"  ><td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;">SERIAL NUMBER :<br><?php
	
		  $x=" SELECT VOUCHERNUMBER,DATE,SUPPLIER,DEPARTMENT,INVOICENUMBER,ORDERNUMBER  FROM  STOCKIN WHERE  VOUCHERNUMBER='$serialnumber' LIMIT 1  ";

	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{print $y['VOUCHERNUMBER'];$deliverydate=$y['DATE'];$supplier=$y['SUPPLIER'];$department=$y['DEPARTMENT']; $ordernumber=$y['ORDERNUMBER'];$invoicenumber=$y['INVOICENUMBER'];	}}
	$_SESSION['invoicenumber']=$invoicenumber;$_SESSION['supplier']=$supplier;
	 

	 ?> </td>
	 
	 
	 <td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >
									DELIVERY/INVOICE <br><?php print $invoicenumber;?>
								</td>
 <td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >
									L.P.O/L.S.O  <br><?php print $ordernumber;?>
								</td>
								
									
									
	 <td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >DATE <br><?php print  $deliverydate; ?>
	 </td></tr>
	 <tr>
	 </tr>
				
				</table>
				
					
				</tr>

				
				<tr class="item">
				<table>
				<tr >
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;">
									SUPPLIER NAME 
								</td>
								
									<td  style="text-decoration:underline;text-decoration-style: dotted;text-align:left;border: 1px solid black; border-collapse: collapse;" >
									<?php print $supplier;?>
								</td>
								<td style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >
									DEPARTMENT
								</td>

								<td  style="text-decoration:underline;text-decoration-style: dotted;border: 1px solid black; border-collapse: collapse;" >
									<?php print $department;?>
									
								</td>
								
									
								</td>
								
							</tr>
				</table>
				
				</tr>
				<hr>
				<table style="font-size:120%;border: 1px solid black; border-collapse: collapse;">
				<tr     >
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >ITEM CODE </td>
					<td   style="font-weight:bold;border: 1px solid black;text-align:left; border-collapse: collapse;" >ITEM DESCRIPTION </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >UNIT </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >QTY </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >UNIT COST</td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >VALUE </td>
					</tr>
					
					
					
					<?php 
					$x="SELECT  ITEMCODE,ITEM,UNITS,QUANTITY,UNITPRICE,PRICE FROM STOCKIN WHERE VOUCHERNUMBER='$serialnumber' ";
					$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	print "<tr ><td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['ITEMCODE']." </td>
					<td   style='font-weight:narrow;border: 1px solid black;text-align:left; border-collapse: collapse;' >".$y['ITEM']."  </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['UNITS']." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['QUANTITY']." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".number_format($y['UNITPRICE'],2)."</td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".number_format($y['PRICE'],2)." </td></tr>";
			
		}}
		
		$x="SELECT   SUM(PRICE) FROM STOCKIN WHERE VOUCHERNUMBER='$serialnumber' ";
					$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
	print "<tr ><td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black;text-align:left; border-collapse: collapse;' >TOTAL  </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' ></td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".number_format($y['SUM(PRICE)'],2)." </td></tr>";
			
		}}
		
		
		
			$x="SELECT  DELIVERY,DELIVERYDESIGNATION,RECEIPIENT,RECEIPIENTDESIGNATION  FROM STOCKIN WHERE VOUCHERNUMBER='$serialnumber' LIMIT 1  ";
					$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{	
		$delivery=$y['DELIVERY'];$deliverydesignation=$y['DELIVERYDESIGNATION'];$receipient=$y['RECEIPIENT'];$receipientdesignation=$Y['RECEIPIENTDESIGNATION'];	
		
		}}
					
					?>
					
					
					
					
									
					
					</table>
							<table>
					<tr>
				<td   style="font-weight:bold;" >DELIVERED BY  </td>
				<td  style="text-decoration:underline;text-decoration-style: dotted;"><?php print $delivery; ?></td>
				<td  style="font-weight:bold;" >DESIGNATION.</td>
				<td  style="text-decoration:underline;text-decoration-style: dotted;"><?php  print $deliverydesignation;?></td>
<td  style="font-weight:bold;" >SIGN  </td>
<td width="20%" style="text-decoration:underline;text-decoration-style: dotted;"><?php  print $recieptdate;?></td>				
					</tr>
				<tr>
				<td   style="font-weight:bold;" >RECEIVED  BY  </td>
				<td  style="text-decoration:underline;text-decoration-style: dotted;"><?php print $receipient; ?></td>
				<td  style="font-weight:bold;" >DESIGNATION.</td>
				<td  style="text-decoration:underline;text-decoration-style: dotted;"><?php  print $receipientdesignation;?></td>
<td  style="font-weight:bold;" >SIGN  </td>
<td width="20%" style="text-decoration:underline;text-decoration-style: dotted;"> </td>				
					</tr>
				
				<tr>
				<td   style="font-weight:bold;" >CHECKED BY   </td>
				<td  style="text-decoration:underline;text-decoration-style: dotted;"><?php print $recieptamount; ?></td>
				<td  style="font-weight:bold;" >DESIGNATION.</td>
				<td  style="text-decoration:underline;text-decoration-style: dotted;"><?php  print $recieptnumber;?></td>
<td  style="font-weight:bold;" >SIGN  </td>
<td width="20%" style="text-decoration:underline;text-decoration-style: dotted;"><?php  print $recieptdate;?></td>				
					</tr>
					
						
							</table>
						
							<table>

							
							</table>
							
			</table>
		</div>
	</body>
</html>
