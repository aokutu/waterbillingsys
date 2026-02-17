<h2 style="text-align:center;">NON WATER BILL </h2>
 <div class="container">
  <div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-8"><img  src="letterhead.png"   id="letterhead"  width="100%"  height="50%"  align="middle" /></div>
  <div class="col-sm-2"></div>
  </div>
  </div>
<table style="width:100%" border="2" >

  <tr  bordercolor="#000000" >
     	<th  colspan="7">REFF NO.</th>
    <td style="text-align:center;" colspan="7"><?php
	
	
	 
	 
	   $x=" SELECT CONCAT('$company/','$zone/',ID)  AS REFF FROM $nonwaterbills WHERE ACCOUNT='$account'  ORDER BY DATE DESC LIMIT 1  ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{print $y['REFF']; }}	 
	 ?></td>

  </tr>
  
  <tr  bordercolor="#000000" >
    <th width="16%"  >DATE</th>
	<td width="9%" style="text-align:center;"><?php print  date('Y-M-d');?></td>
	<th width="14%">A/C No</th>
	<td style="text-align:center;" colspan="4"><?php print $account;?></td>
    <th width="7%" style="text-align:center;"></th> 
    <td width="8%" style="text-align:center;"></td>
  </tr>
  <tr>
    <th colspan="2">A/C NAME</th>
	<td style="text-align:center;" colspan="3"><?php print $_SESSION['client'];?></td>
    <th colspan="2">PAYMENT FOR</th>
	<td style="text-align:center;" colspan="2">NON WATER BILL</td>
   	</tr>
	<tr>
    <th>METER No</th>
	<td style="text-align:center;" colspan="4"><?php print $meternumber;?></td>
    <th width="13%">BILLING MONTH</th>
	<td style="text-align:center;" colspan="3"><?php 	
		$x="SELECT YEAR(DATE),MONTH(DATE),DATE FROM $nonwaterbills  WHERE ACCOUNT='$account'   ORDER BY DATE DESC LIMIT 1";
	 	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$imgdate=$y['DATE'];  $monthx=$y['MONTH(DATE)']; if(strlen($monthx)==1){$monthx='0'.$monthx;}  print $y['YEAR(DATE)'].'-'.$monthx;}}
	
	?> </td>
   	</tr>
     	<th  colspan="5">PARTICULARS </th>
		 <td style="text-align:center;" colspan="2">CODE</td>
    <td style="text-align:center;" colspan="5">CHARGES</td>

  </tr>
	<?php	
	  $x="SELECT C,B,SUM(H) FROM  STATEMENT GROUP BY C  ";
		  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {$ttlbill=$y['SUM(H)'];
		print '<tr>
   	<th colspan="5">'.$y['C'].'</th>
	    <td style="text-align:center;" colspan="2">'.$y['B'].'</td>
    <td style="text-align:center;" colspan="5">'.number_format($y['SUM(H)'],2).'</td>

	</tr>';
		 
		 }}
		//$ttlbill=
		 ?>
		 
		 
		   <?php 

if(empty($maxid)){   print " <tr><td>NO</td><td>PENDING </td><td></td><td>BALANCE</td><td>ARREAS B/F</td><td></td></tr> ";exit;}
$x="SELECT SUM(H) FROM STATEMENT  WHERE A >'$date1' AND A < (SELECT A FROM STATEMENT WHERE ID=$maxid) ";
  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$currentbal=$y['SUM(H)'];}} 

$x="SELECT SUM(H) FROM STATEMENT ";
  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$totalbal=$y['SUM(H)'];}}   	
	   ?>

<?php

$x="SELECT *,YEAR(date),MONTH(date) FROM  $nonwaterbills WHERE ACCOUNT='$account' AND DATE >='".date("Y-m")."' order  by id desc ";
	    	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$meternumber=$y['meternumber'];$name=$y['name'];$charges=number_format($y['amount'],2);$ttlnonwater += $y['amount'];
	
	}}
	
	


 ?>
	<tr>
    <th>BILLING OFFICER </th>
	<td style="text-align:center;" colspan="4"><?php print $user;?></td>
    <th colspan="2">TOTAL KSHS</th>
	<td style="text-align:center;" colspan="2"><?php  print number_format($totalbal,2); ?></td>
   	</tr>
	<tr>
	<th colspan="9">
	<dl>
	<dt style="text-align:left;">Note:</dt>
    <dd style="text-align:left;">(a) In accordance with the Water Act 2016 No, 43 and the Kenya Gazette Notice No. 7538 Charges are payable on Due Date or on Demand.</dd>
	<dd style="text-align:left;">(b) LAKWA must be notified of any change in tenancy or the vacation of premises, if not the last known occupier will be responsible for all charges.</dd>
	<dd style="text-align:left;">(c)  Incase of  any  complain  kindly report  within 7 working days.</dd>

	</dl>	</th>
    </tr>
	<tr>
   	<td colspan="9">
	<p> <b>WARNING NOTICE No……………</b> 
Unless the total amount is received by LAKWA on due date water will be cut off without further notice and proceedings taken for recovery of the amount..</p></td>
	</tr>
	<tr>
	<th colspan="3">
PAY BEFORE: 5th Day of Every Month	</th>
    <td style="text-align:center;" colspan="6">A fee of Kshs.1,000/= is payable for Re-connection And  an extra 2000/= if it exceeds 3 Months.</td>
	</tr>
	<tr>
   	<th colspan="9">
PAY Through M-PESA PAY BILL NO. 522237	</tr>
</table>