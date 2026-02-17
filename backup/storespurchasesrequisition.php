<!DOCTYPE html>
<?php 
 @session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$serialnumber=$_SESSION['purchasereqnumber'];
include_once("../password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  AND  ACCESS  REGEXP  'INVENTORY REG'     ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}

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
									<h2 style="text-align:center;font-weight:bold;">STORES PURCHASES REQUISITION </h2>
								</td>

								
							</tr>
						</table>
					</td>
				</tr>


				<tr class="heading">
				<table  style="border: 1px solid black; border-collapse: collapse;" >
				<tr  style="font-size:80%;"  ><td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;">SERIAL NUMBER :<br><?php
	//SERIALNUMBER,ITEM,QUANTITY,UNITS,PREVBALANCE,PRICE,VALUE,PURPOSE,REQUESTER,REQUESTERTITLE,CHECKER,CHECKERTITLE,CONFIRMER,CONFIRMERTITLE,APPROVER,APPROVERTITLE,DATE
		  $x=" SELECT SERIALNUMBER,REQUESTER,REQUESTERTITLE,CHECKER,CHECKERTITLE,CONFIRMER,CONFIRMERTITLE,APPROVER,APPROVERTITLE,DATE   FROM  PURCHASESREQUISITION WHERE  
		  SERIALNUMBER='$serialnumber' ORDER  BY  ID  DESC LIMIT 1   ";

	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{print $y['SERIALNUMBER'];$date=$y['DATE'];$requester=$y['REQUESTER'];$requestertitle=$y['REQUESTERTITLE'];
$checker=$y['CHECKER'];$checkertitle=$y['CHECKERTITLE'];$confirmer=$y['CONFIRMER'];$confirmertitle=$y['CONFIRMERTITLE'];$approver=$y['APPROVER'];$approvertitle=$y['APPROVERTITLE'];

	}}
 
	 ?> </td>									
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
				<table style="font-size:80%;border: 1px solid black; border-collapse: collapse;">
				<tr     >
					<td width="5%"  style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >ITEM NO. </td>
					<td width='35%'  style="font-weight:bold;border: 1px solid black;text-align:left; border-collapse: collapse;" >ITEM DESCRIPTION </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >UNITS </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >STOCK <br>CARD BAL </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >QTY<br>REQUIRED</td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >UNIT COST<br>16% INC</td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >VALUE </td>
					<td  width='35%' style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >REMARKS </td>
					</tr>
					
					
					
					<?php 
$number=0;
		  $x=" SELECT SERIALNUMBER,ITEM,QUANTITY,UNITS,PREVBALANCE,PRICE,VALUE,PURPOSE,REQUESTER,REQUESTERTITLE,CHECKER,CHECKERTITLE,CONFIRMER,CONFIRMERTITLE,APPROVER,APPROVERTITLE,DATE
		  FROM PURCHASESREQUISITION WHERE  SERIALNUMBER='$serialnumber' ORDER  BY  ID  ASC   ";
		  $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ $number +=1;
	print "<tr ><td  width='5%'  style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$number." </td>
					<td width='35%'  style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;text-align:left;' >".$y['ITEM']."  </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['UNITS']." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['PREVBALANCE']." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['QUANTITY']."</td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".number_format($y['PRICE'],2)." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".number_format($y['VALUE'],2)." </td>
					<td  width='35%'  style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['PURPOSE']." </td>
					
					</tr>";
			
		}}
		
		
				  $x=" SELECT SUM(VALUE)		  FROM PURCHASESREQUISITION WHERE  SERIALNUMBER='$serialnumber'   ";
		  $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ 
	print "<tr ><td width='5%'  style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td width='35%'   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;text-align:left;' >TOTAL  </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' ></td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".number_format($y['SUM(VALUE)'],2)." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					
					</tr>";
			
		}}
					
					?>
					
					
					
					
									
					
					</table>
					<hr>
					
							<table>
					<tr>
				<td   style="font-weight:bold;" >REQUESTED BY  </td>
				<td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"><?php print $requester; ?></td>
				<td  style="font-weight:bold;" >DESIGNATION.</td>
				<td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"><?php  print $requestertitle;?></td>
<td   width="15%"  style="font-weight:bold;" >SIGN  </td><td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"><?php  print $recieptdate;?></td>				
					</tr>
				
				
				<tr>
				<td   style="font-weight:bold;" >CHECKED BY   </td>
				<td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"><?php print $checker; ?></td>
				<td  style="font-weight:bold;" >DESIGNATION.</td>
				<td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"><?php  print $checkertitle;?></td>
<td   width="15%"  style="font-weight:bold;" >SIGN  </td><td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"><?php  print $recieptdate;?></td>				
					</tr>
					
					<tr>
				<td   style="font-weight:bold;" >CONFIRMED  BY  </td>
				<td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"><?php print $confirmer; ?></td>
				<td  style="font-weight:bold;" >DESIGNATION.</td>
				<td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"><?php  print $confirmertitle;?></td>
<td   width="15%"  style="font-weight:bold;" >SIGN  </td><td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"> </td>				
					</tr>
					<tr>
				<td   style="font-weight:bold;" >APPROVED  BY  </td>
				<td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"><?php print $approver; ?></td>
				<td  style="font-weight:bold;" >DESIGNATION.</td>
				<td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"><?php  print $approvertitle;?></td>
<td   width="15%"  style="font-weight:bold;" >SIGN  </td><td  style="text-decoration:underline;text-align:left;text-decoration-style: dotted;"> </td>				
					</tr>
					
						
							</table>
						
							<table>

							
							</table>
							
			</table>
		</div>
	</body>
</html>
