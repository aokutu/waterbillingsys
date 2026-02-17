<!DOCTYPE html>
<?php 
 @session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$quotationnumber=$_SESSION['quotationnumber'];
include_once("../password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND  ACCESS  REGEXP  'INVENTORY REG'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1){$_SESSION['message']="ACCESS  DENIED";exit;}


  $x=" SELECT SERIALNUMBER,SUPPLIER,DATE   FROM  QUOTATIONREQUESTS WHERE  SERIALNUMBER='$quotationnumber' ORDER  BY  ID  DESC LIMIT 1   ";

	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$quotationnumber=$y['SERIALNUMBER'];$date=$y['DATE'];$supplier=$y['SUPPLIER'];

	}}
	
  $x=" SELECT BOXADDRESS,PHONENUMBER    FROM  SUPPLIERS  WHERE SUPPLIER ='$supplier'  ";

	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$boxaddress=$y['BOXADDRESS'];$phonenumber=$y['PHONENUMBER'];

	}}
?>

<html>
	<head>
		<meta charset="utf-8" />
		<title>HADDASSAHSOFTWARES</title>

		<style>
			.invoice-box {
				max-width: 100%;
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
									<h3 style="text-align:center;font-weight:bold;">REQUEST FOR QUOTATION</h3>
								</td>

								
							</tr>
						</table>
						<table>
							<tr>
								<td class="heading" style="font-weight:bold;">
									<?php print $supplier;?><br>P.O.BOX :<?php print $boxaddress; ?><br>Mobile:<?php print $phonenumber;?>
								</td>
								<td class="heading"  style="font-weight:bold;" >
									DATE <br><?php  
		$x="SELECT  CONCAT(DAY(CURRENT_DATE),'-',MONTHNAME(CURRENT_DATE),'-',YEAR(CURRENT_DATE)) AS DATE , CURRENT_TIME AS TIME ";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ print $y['DATE'].":".$y['TIME'];}}
				?>
								</td>
								
							</tr>
						</table>
					</td>
				</tr>


				<tr class="heading">
				<table height="20px;" style="border: 1px solid black; border-collapse: collapse;font-size:77%;" >
				<tr  style="font-size:80%;"  >
				<td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;">SERIAL NUMBER :<br><?php print $quotationnumber;?> </td>									
	 <td width="80%" style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >You are invited to submit quotation on materials/services listed below.<br>
	 Notes:<br>
	 <ol type="1">
  <li>THIS IS NOT AN ORDER.Read the condition and instruction on reverse before quoting.</li>
  <li>Your Quotation should indicate final unit price which includes all taxes applicable.</li>
  
</ol>
	 </td></tr>
	 <tr>
	 </tr>
				
				</table>
				<hr>
				
					
				</tr>

				
				<tr class="item">				
				</tr>
				<table style="font-size:80%;border: 1px solid black; border-collapse: collapse;">
				<tr     >
					<td width='5%'  style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >ITEM NO. </td>
					<td  width='30%' style="font-weight:bold;border: 1px solid black;text-align:left; border-collapse: collapse;" >ITEM DESCRIPTION </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >UNITS </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >QTY<br>REQUIRED</td>
					
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >UNIT PRICE</td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >TTL AMOUNT </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >DAYS TO <br>DELIVER </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >BRAND</td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >COUNTRY OF <br>ORIGIN </td>
					<td  width='20%' style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >REMARKS </td>
					</tr>			
					
					
					<?php 
$number=0;
		  $x=" SELECT ITEM,UNITS,QUANTITY  FROM QUOTATIONREQUESTS WHERE  SERIALNUMBER='$quotationnumber' ORDER  BY  ID  ASC   ";
		  $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ $number +=1;
	print "<tr ><td width='5%'    style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$number." </td>
					<td  width='30%' style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;text-align:left;' >".$y['ITEM']."  </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['UNITS']." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['QUANTITY']."</td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td width='20%'  style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					</tr>";
			
		}}
					
					?>
					
					
					
					
									
					
					</table>
					<hr>
							<table>
					<tr>
				<td   style="font-weight:bold;" >SELLER'S SIGNATURE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
				<td  style="font-weight:bold;text-align:left;" >OPENED BY </td>
<td  style="font-weight:bold;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
					</tr>
				
				
				<tr>
				<td   style="font-weight:bold;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </td>
				<td  style="font-weight:bold;text-align:left;" >1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td  style="font-weight:bold;" >SIGN:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
					</tr>
					
					<tr>
				<td   style="font-weight:bold;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
				<td  style="font-weight:bold;text-align:left;" >2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td  style="font-weight:bold;" >SIGN:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
					</tr>
					<tr>
				<td   style="font-weight:bold;" >DATE.  </td>
				<td  style="font-weight:bold;text-align:left;" >3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td  style="font-weight:bold;" >SIGN:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
					</tr>
					<tr>
				<td   style="font-weight:bold;" >  </td>
				<td  style="font-weight:bold;text-align:left;" >DATE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td  style="font-weight:bold;" >TIME:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
					</tr>
					
						
							</table>
						
							<table>

							
							</table>
							
			</table>
		</div>
	</body>
</html>
