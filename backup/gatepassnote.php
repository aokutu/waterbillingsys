<!DOCTYPE html>
<?php 
 @session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$serialnumber=$_SESSION['gatepassnumber'];
include_once("../password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND ACCESS  REGEXP  'INVENTORY REG'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else { header("LOCATION:../dashboard.php");exit;}
	$x="SELECT ITEM,UNITS,QUANTITY,ISSUENOTE,ISSUER,ISSUERTITLE,RECEIVER,RECEIVERTITLE,TRANSPORTER,TRANSPORTERTITLE,VEHICLE,VEHICLENUMBER,POINTOFUSE,DATE  FROM GATEPASS WHERE SERIALNUMBER ='$serialnumber'  LIMIT 1    ";
		  $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ $issuer=$y['ISSUER'];$issuertitle=$y['ISSUERTITLE'];$receiver=$y['RECEIVER'];$receivertitle=$y['RECEIVERTITLE'];
	$transporter=$y['TRANSPORTER'];$transportertitle=$y['TRANSPORTERTITLE'];$vehicle=$y['VEHICLE']; $vehiclenumber=$y['VEHICLENUMBER'];$date=$y['DATE'];
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

	<body style="font-size:50%;" >
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
									<h2 style="text-align:center;font-weight:bold;">
								GATE PASS 	
									</h2>
								</td>

								
							</tr>
						</table>
						
					</td>
				</tr>


				<tr class="heading">
				<table  style="border: 1px solid black; border-collapse: collapse;" >
				<tr  style="font-size:75%;"  ><td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;">SERIAL NUMBER :<br><?php print $serialnumber;?> </td>									
	 <td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >DATE <br><?php  
		$x="SELECT  CONCAT(DAY(CURRENT_DATE),'-',MONTHNAME(CURRENT_DATE),'-',YEAR(CURRENT_DATE)) AS DATE , CURRENT_TIME AS TIME ";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ print $y['DATE'].":".$y['TIME'];}}
				?>
	 </td></tr>
	 <tr>
	 </tr>
				
				</table>
				<hr>
				
					
				</tr>

				
				<tr class="item">				
				</tr>
				<table style="font-size:75%;border: 1px solid black; border-collapse: collapse;">
				<tr     >
					<td  style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >ITEM NO. </td>
					<td  width='40%' style="font-weight:bold;border: 1px solid black;text-align:left; border-collapse: collapse;" >  DESCRIPTION </td>
					<td  width='5%'  style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >UNITS </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >QUANTITY</td>
					<td  width='40%' style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >POINT OF  USE</td>
		</tr>			
					
					
					<?php 
					//WHERE SERIALNUMBER ='$serialnumber' AND SUPPLIER='$supplier'
$number=0;
	$x="SELECT ITEM,UNITS,QUANTITY,ISSUENOTE,ISSUER,ISSUERTITLE,RECEIVER,RECEIVERTITLE,TRANSPORTER,TRANSPORTERTITLE,VEHICLE,VEHICLENUMBER,POINTOFUSE,DATE  FROM GATEPASS WHERE SERIALNUMBER ='$serialnumber'    ";
		  $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ $number +=1; 
	print "<tr ><td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$number." </td>
					<td  width='40%' style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;text-align:left;' >".$y['ITEM']."  </td>
					<td width='5%'  style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['UNITS']." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['QUANTITY']."</td>
					<td width='40%'  style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['POINTOFUSE']."</td>
					</tr>";
			
		}}
		
		?>
					
					
					
					
									
					
					</table>
					<hr>
							
							
							<table>
							<tr>								
								<td style='text-align:left;font-weight:bold;' >ISSUED BY </td>
								<td  style='text-align:left;font-weight:bold;' >RECEIVED  BY</td>
								<td  style='text-align:left;font-weight:bold;' >TRANSPORTED BY </td>
							</tr>
							<tr>								
								<td style='text-align:left;font-weight:bold;' ><?php print $issuer; ?> </td>
								<td  style='text-align:left;font-weight:bold;' ><?php print $receiver; ?></td>
								<td  style='text-align:left;font-weight:bold;' ><?php print $transporter; ?> </td>
							</tr>
							
							
							<tr>								
								<td style='text-align:left;font-weight:bold;' ><?php print $issuertitle; ?> </td>
								<td  style='text-align:left;font-weight:bold;' ><?php print $receivertitle; ?></td>
								<td  style='text-align:left;font-weight:bold;' ><?php print $transportertitle; ?> </td>
							</tr>
							
							<tr>								
								<td style='text-align:left;font-weight:bold;' > </td>
								<td  style='text-align:left;font-weight:bold;' ></td>
								<td  style='text-align:left;font-weight:bold;' > </td>
							</tr>
							<tr>								
								<td style='text-align:left;font-weight:bold;' >  SIGN.................... </td>
								<td  style='text-align:left;font-weight:bold;' >  SIGN ..................</td>
								<td  style='text-align:left;font-weight:bold;' >  SIGN ................... </td>
							</tr>
							
						</table>
						
						
						
							<table  >
							<tr>								
								<td style='text-align:left;font-weight:bold;' >VEHICLE: <?php print $vehicle; ?>  </td>
								<td  style='text-align:left;font-weight:bold;' >NO: <?php print $vehiclenumber; ?> </td>
							</tr>
							
													
							</table>
							
			</table>
		</div>
	</body>
</html>
