<!DOCTYPE html>
<?php 
 @session_start();

$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$serialnumber=$_SESSION['serialnumber'];
include_once("../password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; exit;}


  $x=" SELECT SERIALNUMBER,SUPPLIER,TENDERNUMBER,CONTRACTNUMBER,CONTRACTDATE,REQUISITIONNUMBER,REQUISITIONDATE,CATEGORY,DATE   FROM  LPOS WHERE  SERIALNUMBER='$serialnumber' ORDER  BY  ID  DESC LIMIT 1   ";

	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$serialnumber=$y['SERIALNUMBER'];$date=$y['DATE'];$supplier=$y['SUPPLIER'];$category=$y['CATEGORY'];


$_SESSION['tenderreffnumber']=$y['TENDERNUMBER'];$_SESSION['action']=$category;
$_SESSION['contractreffnumber']=$y['CONTRACTNUMBER'];$_SESSION['contractdate']=$y['CONTRACTDATE'];
$_SESSION['requisitionreffnumber']=$y['REQUISITIONNUMBER'];$_SESSION['requisitiondate']=$y['REQUISITIONDATE'];
$_SESSION['supplier']=$supplier;
}}
	
  $x=" SELECT BOXADDRESS,PHONENUMBER,EMAIL    FROM  SUPPLIERS  WHERE SUPPLIER ='$supplier'  ";

	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$boxaddress=$y['BOXADDRESS'];$phonenumber=$y['PHONENUMBER'];$email=$y['EMAIL'];

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
								<?php if($category=='L.S.O'){print 'LOCAL SERVICE ORDER ';} else if($category=='L.P.O'){print 'LOCAL PURCHASE ORDER ';} ?>	
									</h2>
								</td>

								
							</tr>
						</table>
						<table>
							<tr>
								<td class="heading" style="font-weight:bold;">
									<?php print $supplier;?><br>P.O.BOX :<?php print $boxaddress; ?><br>Mobile:<?php print $phonenumber;?><br>EMAIL:<?php print $email; ?>
								</td>
								<td class="heading">
									
								</td>
								
							</tr>
							
								<tr>
								<td class="heading" style="font-weight:bold;font-size:90%;" >
								Please deliver the <?php if($category=='L.S.O'){print 'Services ';} else if($category=='L.P.O'){print ' Goods  ';} ?> listed here below to ..................................................................................................................
								<br>On terms and conditions stated on the back of this order ,on or before ............................................................. and send thr invoices immediately.
								</td>
								
							</tr>
							
							
						</table>
					</td>
				</tr>


				<tr class="heading">
				<table  style="border: 1px solid black; border-collapse: collapse;" >
				<tr  style="font-size:80%;"  ><td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;">SERIAL NUMBER :<br><?php print $serialnumber;?> </td>									
	 <td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >DATE <br><?php print  $date; ?>
	 </td></tr>
	 <tr>
	 </tr>
				
				</table>
				<br>
				
					
				</tr>

				
				<tr class="item">				
				</tr>
				<table style="font-size:80%;border: 1px solid black; border-collapse: collapse;">
				<tr     >
					<td   style="font-weight:bold;border: 1px solid black;text-align:left; border-collapse: collapse;" >ITEM NO. </td>
					<td   style="font-weight:bold;border: 1px solid black;text-align:left; border-collapse: collapse;" > <?php if($category=='L.S.O'){print 'Services ';} else if($category=='L.P.O'){print ' Goods  ';} ?> DESCRIPTION </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >UNITS </td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >QUANTITY</td>
					
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >UNIT COST</td>
					<td   style="font-weight:bold;border: 1px solid black; border-collapse: collapse;" >TTL AMOUNT </td>
					</tr>			
					
					
					<?php 
$number=0;
	$x="SELECT ITEM,UNITS,QUANTITY,PRICE,AMOUNT,DATE  FROM LPOS  WHERE SERIALNUMBER ='$serialnumber' AND SUPPLIER='$supplier'  ";
		  $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ $number +=1;
	print "<tr ><td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$number." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;text-align:left;' >".$y['ITEM']."  </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['UNITS']." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".$y['QUANTITY']."</td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".number_format($y['PRICE'],2)." </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".number_format($y['AMOUNT'],2)." </td>
					</tr>";
			
		}}
		
		
			$x="SELECT SUM(AMOUNT)  FROM LPOS  WHERE SERIALNUMBER ='$serialnumber' AND SUPPLIER='$supplier'  ";
		  $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ 
	print "<tr ><td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;text-align:left;' >TOTAL KSHS.  </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' ></td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' > </td>
					<td   style='font-weight:narrow;border: 1px solid black; border-collapse: collapse;' >".number_format($y['SUM(AMOUNT)'],2)." </td>
					</tr>";
			
		}}
		
		
					
					?>
					
					
					
					
									
					
					</table>
					<br>
							
							
							<table  style="font-size:70%;">
							<tr>								
								<td style='text-align:left;font-weight:bold;' >PREPARED BY </td>
								<td  style='text-align:left;font-weight:bold;' >CHECKED BY</td>
								<td  style='text-align:left;font-weight:bold;' >CONFIRMED BY </td>
							</tr>
							<tr>								
								<td style='text-align:left;font-weight:bold;' >STORE KEEPER .................................. </td>
								<td  style='text-align:left;font-weight:bold;' >ACCOUNTS ...................................</td>
								<td  style='text-align:left;font-weight:bold;' >MANAGER ................................... </td>
							</tr>
							
							
							
						</table>
						
						
						
							<table style='font-size:70%;' >
							<tr>								
								<td style='text-align:left;font-weight:bold;' >We confirm that the  funds are available and that the order has been noted</td>
								<td  style='text-align:left;font-weight:bold;' >Acknowledgment</td>
							</tr>
							<tr>								
								<td style='text-align:left;font-weight:bold;' >Approved by </td>
								<td  style='text-align:left;font-weight:bold;' >Supplier ................................................................Date.............................</td>
							</tr>
							<tr>								
								<td style='text-align:left;font-weight:bold;' > </td>
								<td  style='text-align:left;font-weight:bold;' ></td>
							</tr>
							<tr>								
								<td style='text-align:left;font-weight:bold;' > </td>
								<td  style='text-align:left;font-weight:bold;' ></td>
							</tr>
							
							<tr>
							<br>
							<table  >
							<tr>								
								<td style='text-align:left;font-weight:bold;' >SECRETARY </td>
								<td  style='text-align:left;font-weight:bold;' >TREASURER</td>
								<td  style='text-align:left;font-weight:bold;' >CHAIRPERSON</td>
								<td   width="40%" style='text-align:left;font-weight:bold;' > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </td>
								
							</tr>
							
							</table>					
								
							</tr>
							
							</table>
							
			</table>
		</div>
	</body>
</html>
