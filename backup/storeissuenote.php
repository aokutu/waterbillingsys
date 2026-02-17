<!DOCTYPE html>
<?php 
 @session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("../password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'INVENTORY REG'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
@$serialnumber=$_SESSION['issuenotenumber'];
?>

<html>
	<head>
		<meta charset="utf-8" />
		<title>HADDASSAHSOFTWARES</title>

		<style>
			.invoice-box {
				max-width: 99%;
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
			body{margin-right:1%;margin-left:1%;font-size:80%;}
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
									<h4 style="text-align:center;font-weight:bold;text-decoration:underline;">STORES  ISSUE NOTE </h4>
								</td>

								
							</tr>
						</table>
					</td>
				</tr>


				<tr class="heading">		
					
				</tr>

				
				<tr class="item">
			
					<table>
				
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
									SERIAL #
								</td>
								<td  style="text-align:center;font-weight:bold;border: 1px solid black; border-collapse: collapse;"  >
									<?php  print strtoupper(str_pad($_SESSION['issuenotenumber'], 10, "0", STR_PAD_LEFT));?>
								</td>
								
								
							</tr>
							
							
							
						</table><br>
						
				</tr>
				<table style="font-size:80%;border: 1px solid black; border-collapse: collapse;">
				<tr     >
				<td  width="3%" style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >ITEM NO. </td>
					<td  width="5%" style="font-weight:bold;border: 1px solid black;text-align:left; border-collapse: collapse;" >CODE </td>
					<td   style="font-weight:bold;border: 1px solid black;text-align:left; border-collapse: collapse;" >DESCRIPTION </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >UNIT </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >QTY </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >PRICE </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >VALUE </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >PURPOSE </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >TR NO.</td>
					
					</tr>
					
					
					
					<?php 
					$number=0;
					$x="SELECT   TRANSACTIONREFF,REQUISITION.ITEMCODE,PURPOSE,REQUISITION.ITEM,REQUISITION.UNITS,REQUISITION.QUANTITY,VALUE ,REQUISITIONERTITLE,AUTHORIZER,AUTHORIZERTITLE FROM REQUISITION WHERE SERIALNUMBER='$serialnumber'  ";
					$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ $number +=1;
		$requisitionertitle=$y['REQUISITIONERTITLE'];$authorizer=$y['AUTHORIZER'];$authorizertitle=$y['AUTHORIZERTITLE'];
			if($y['TRANSACTIONREFF']==''){$y['TRANSACTIONREFF']='NOT ISSUED';}
	print "<tr  style='' >
	<td width='3%'  style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$number." </td>	
	<td  width='5%' style='font-weight:narrow;border: 1px solid black;text-align:left; border-collapse: collapse;' >".$y['ITEMCODE']." </td>
					<td   style='font-weight:narrow;border: 1px solid black;text-align:left; border-collapse: collapse;' >".$y['ITEM']."  </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['UNITS']." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['QUANTITY']." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".number_format($y['VALUE'],2)." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".number_format($y['VALUE']*$y['QUANTITY'],2)." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['PURPOSE']." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['TRANSACTIONREFF']."</td>
					</tr>";
			
		}}
			
			$x="SELECT SUM(VALUE*QUANTITY) AS TTL FROM REQUISITION WHERE SERIALNUMBER='$serialnumber'   ";
					$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
	print "<tr  style='' >	
					<td  width='3%' style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td  width='5%' style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:bold;border: 1px solid black;text-align:left; border-collapse: collapse;' >TOTAL </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:bold;border: 1px solid black; border-collapse: collapse;' >".number_format($y['TTL'],2)." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' ></td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' ></td>
					</tr>";
			
		}}
		
					?>
					
					
					
					
									
					
					</table>
							<table>
					<?php 
	$x="SELECT   PURPOSE,REQUISITIONER,REQUISITIONERTITLE,AUTHORIZER,AUTHORIZERTITLE,ISSUER,ISSUERTITLE,APPROVER,APPROVERTITLE FROM REQUISITION WHERE SERIALNUMBER='$serialnumber' LIMIT 1   ";
					$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
	$purpose=$y['PURPOSE'];$requisitioner=$y['REQUISITIONER'];$requisitionertitle=$y['REQUISITIONERTITLE'];$authorizer=$y['AUTHORIZER'];$authorizertitle=$y['AUTHORIZERTITLE'];
	$issuer=$y['ISSUER'];$issuertitle=$y['ISSUERTITLE'];$approver=$y['APPROVER'];$approvertitle=$y['APPROVERTITLE'];
		}}				
					
					?>			


					
					<tr>
<br>
	<table style="font-size:90%;">
	
	<tr>
				<td   style="font-weight:bold;" >REQUISITION BY  </td>
				<td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"><?php print $requisitioner; ?></td>
				<td   style="font-weight:bold;" >TITLE  </td>
				<td  style="text-decoration:underline;text-decoration-style: dotted;"><?php print $requisitionertitle; ?></td>
				<td   width="20%"  style="font-weight:bold;" >SIGN  </td>
				<td   width="20%"  style="font-weight:bold;" >DATE :</td>
	</tr>
	<tr>
				<td   style="font-weight:bold;" >AUTHORIZED BY  </td>
				<td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"><?php print $authorizer; ?></td>
				<td   style="font-weight:bold;" >TITLE  </td>
				<td  style="text-decoration:underline;text-decoration-style: dotted;"><?php print $authorizertitle; ?></td>
				<td   width="20%"  style="font-weight:bold;" >SIGN  </td>
				<td   width="20%"  style="font-weight:bold;" >DATE :</td>
	</tr>
	<tr>
				<td   style="font-weight:bold;" >ISSUED BY  </td>
				<td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"><?php print $issuer; ?></td>
				<td   style="font-weight:bold;" >TITLE  </td>
				<td  style="text-decoration:underline;text-decoration-style: dotted;"><?php print $issuertitle; ?></td>
				<td   width="20%"  style="font-weight:bold;" >SIGN  </td>
				<td   width="20%"  style="font-weight:bold;" >DATE :</td>
	</tr>
	<tr>
				<td   style="font-weight:bold;" >APPROVED  BY  </td>
				<td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"><?php print $approver; ?></td>
				<td   style="font-weight:bold;" >TITLE  </td>
				<td  style="text-decoration:underline;text-decoration-style: dotted;"><?php print $approvertitle; ?></td>
				<td   width="20%"  style="font-weight:bold;" >SIGN  </td>
				<td   width="20%"  style="font-weight:bold;" >DATE :</td>
	</tr>
	
	</table>
				
					</tr>
						
							</table>
						
							<table>

							
							</table>
							
			</table>
		</div>
	</body>
</html>
