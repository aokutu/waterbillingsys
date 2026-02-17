<?php 
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$_SESSION['user'];
$dbdetails->password=$_SESSION['password'];
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'PAYROLL' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
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
									<img src="letterhead.png" style="width: 95%; max-width: 90%;text-align:center;" />
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
									<h3 style="text-align:center;font-weight:bold;">
								PAY SLIP.
									</h3>
								</td>

								
							</tr>
						</table>
						
					</td>
				</tr>
<tr>
<table  style="border: 1px solid black; border-collapse: collapse;" >
				
				<?php
$x = $connect ->query("SELECT ID,IDNUMBER,NAMES,BASICSALARY,MONTH,POSTINGDATE FROM  PAYROLL WHERE ID='$id' ");
while ($data = $x->fetch_object())
{
    
    ?>
 
 
    <tr  style="font-size:75%;"  >
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >ID NUMBER </td>
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >  <?php print $data->IDNUMBER;?> </td>
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >NAMES </td>
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >  <?php print $data->NAMES;?> </td>

</tr>

<tr  style="font-size:75%;"  >
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >MONTH </td>
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >  <?php print $data->MONTH;?> </td>
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >POSTING DATE </td>
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >  <?php print $data->POSTINGDATE;?> </td>

</tr>

 <?php

}
?>
				</table>

        </tr>
        <hr>
        <table  style="border: 1px solid black; border-collapse: collapse;" >
				
				<?php
$x = $connect ->query("SELECT ID,BASICSALARY,HOUSEALLOWANCE,TRAVELALLOWANCE,PAYEE,NHIF,NSSF,HARDSHIPALLOWANCE FROM  PAYROLL WHERE ID= '$id' ");
while ($data = $x->fetch_object())
{
    
    ?>
 
 
    <tr  style="font-size:75%;"  >
<td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >BASIC SALARY </td>
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >  <?php print number_format($data->BASICSALARY,2);?> </td>
<td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >PAYEE </td>
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >  <?php print number_format($data->PAYEE,2);?> </td>

</tr>
<tr  style="font-size:75%;"  >
<td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >HOUSE ALLOWANCE </td>
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >  <?php print number_format($data->HOUSEALLOWANCE,2);?> </td>
<td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >NHIF </td>
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >  <?php print number_format($data->NHIF,2);?> </td>

</tr>

<tr  style="font-size:75%;"  >
<td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >TRAVELLING ALLOWANCE </td>
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >  <?php print number_format($data->TRAVELALLOWANCE,2);?> </td>
<td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >NSSF </td>
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >  <?php print number_format($data->NSSF,2);?> </td>

</tr>

<tr  style="font-size:75%;"  >
<td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >HARDSHIP ALLOWANCE ALLOWANCE </td>
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >  <?php print number_format($data->HARDSHIPALLOWANCE,2);?> </td>
<td  style="text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >NET SALARY </td>
<td  style="text-align:right;font-weight:bold;border: 1px solid black; border-collapse: collapse;" >  <?php print number_format($data->BASICSALARY+$data->HOUSEALLOWANCE+$data->TRAVELALLOWANCE+$data->HARDSHIPALLOWANCE-$data->PAYEE-$data->NHIF-$data->NSSF,2);?> </td>

</tr>


    <?php

}
?>
				</table>
                
                </table>		

		</div>
	</body>
</html>
