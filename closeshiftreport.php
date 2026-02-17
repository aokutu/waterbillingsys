<?php 
@session_start();
$_SESSION['message']=null;
include_once("password2.php");
include_once("interface2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="REGISTRATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'    ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIEDx"; header("LOCATION:accessdenied4.php");exit;}

$ttlcash=0;  
?>
<div id="report" >
<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" >END OF SHIFT  REPORT </h4>

<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >SHIFT  PERIOD</td>
<td class="w-1/6  border border-black px-4 py-2 text-right " >FROM <?php print $starttime; ?><br>TO    <?php print $endtime; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >RECEPTIONIST</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print strtoupper($registrationbooking->user2); ?></td>

</tr>

</tbody>
</table>
<Br>

<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >DETAILS</td>
<td class="w-1/6  border border-black px-4 py-2" >CASH </td>
<td class="w-1/6  border border-black px-4 py-2" >MPESA </td>
<td class="w-1/6  border border-black px-4 py-2" >INVOICED </td>
</tr>

<tr class="bg-white-900 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >OTC</td>
<td class="w-1/6  border border-black px-4 py-2" >
<?php 
$x=$connect->query(" SELECT SUM(GROSSTOTAL) AS AMOUNT FROM receiptsdetails WHERE DATE >='$starttime'  AND DATE <= '$endtime' AND PATIENTNUMBER ='00000' AND RECEIPTNUMBER IN(SELECT RECEIPTNUMBER FROM RECEIPTRECORDS WHERE PAYMODE ='CASH' )  ");
while ($data = $x->fetch_object())
{ 
print $data->AMOUNT;
$ttlcash =$ttlcash+$data->AMOUNT;
}
?>
 </td>
<td class="w-1/6  border border-black px-4 py-2" >
<?php 
$x=$connect->query(" SELECT SUM(GROSSTOTAL) AS AMOUNT FROM receiptsdetails WHERE  DATE >='$starttime'  AND DATE <= '$endtime' AND PATIENTNUMBER ='00000' AND RECEIPTNUMBER IN(SELECT RECEIPTNUMBER FROM RECEIPTRECORDS WHERE PAYMODE ='MPESA' )  ");
while ($data = $x->fetch_object())
{ 
print $data->AMOUNT;
$ttlcash =$ttlcash+$data->AMOUNT;
}
?> </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php 
$x=$connect->query(" SELECT SUM(GROSSTOTAL) AS AMOUNT FROM invoicedetails WHERE   DATE >='$starttime'  AND DATE <= '$endtime' AND PATIENTNUMBER ='00000' ");
while ($data = $x->fetch_object())
{ 
print $data->AMOUNT;
}
?> </td>
</tr>

<tr class="bg-white-900 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >CONSULTATION</td>
<td class="w-1/6  border border-black px-4 py-2" >
<?php 
$x=$connect->query(" SELECT SUM(GROSSTOTAL) AS AMOUNT FROM receiptsdetails WHERE  DETAILS='CONSULTATION' AND DATE >='$starttime'  AND DATE <= '$endtime' AND PATIENTNUMBER !='00000' AND RECEIPTNUMBER IN(SELECT RECEIPTNUMBER FROM RECEIPTRECORDS WHERE PAYMODE ='CASH' )  ");
while ($data = $x->fetch_object())
{ 
print $data->AMOUNT;
}
?> </td>
<td class="w-1/6  border border-black px-4 py-2" >
<?php 
$x=$connect->query(" SELECT SUM(GROSSTOTAL) AS AMOUNT FROM receiptsdetails WHERE  DETAILS='CONSULTATION' AND DATE >='$starttime'  AND DATE <= '$endtime' AND PATIENTNUMBER !='00000' AND RECEIPTNUMBER IN(SELECT RECEIPTNUMBER FROM RECEIPTRECORDS WHERE PAYMODE ='MPESA' )  ");
while ($data = $x->fetch_object())
{ 
print $data->AMOUNT;
}
?>
 </td>
<td class="w-1/6  border border-black px-4 py-2" >
<?php 
$x=$connect->query(" SELECT SUM(GROSSTOTAL) AS AMOUNT FROM invoicedetails WHERE  DETAILS='CONSULTATION' AND DATE >='$starttime'  AND DATE <= '$endtime' AND PATIENTNUMBER !='00000' ");
while ($data = $x->fetch_object())
{ 
print $data->AMOUNT;
}
?>

 </td>
</tr>
<tr class="bg-white-900 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >INSURANCE</td>
<td class="w-1/6  border border-black px-4 py-2" > </td>
<td class="w-1/6  border border-black px-4 py-2" > </td>
<td class="w-1/6  border border-black px-4 py-2" >
<?php 
$x=$connect->query(" SELECT SUM(GROSSTOTAL) AS AMOUNT FROM invoicedetails WHERE  DATE >='$starttime'  AND DATE <= '$endtime' AND PATIENTNUMBER !='00000'  ");
while ($data = $x->fetch_object())
{ 
print $data->AMOUNT;
}
?> </td>
</tr>
<tr class="bg-white-900 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >DEBT ACCRUED</td>
<td class="w-1/6  border border-black px-4 py-2" >
<?php 
//$x=$connect->query(" SELECT SUM(AMOUNT) AS AMOUNT FROM debtrecords  WHERE AMOUNT >0  AND DATE >='$starttime'  AND DATE <= '$endtime' ");

$x=$connect->query(" SELECT SUM(AMOUNT) AS AMOUNT FROM debtrecords  WHERE AMOUNT >0 ");
while ($data = $x->fetch_object())
{ 
print number_format($data->AMOUNT,2);
}
?>
 </td>
<td class="w-1/6  border border-black px-4 py-2" > </td>
<td class="w-1/6  border border-black px-4 py-2" > </td>
</tr>
<tr class="bg-white-900 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >DEBT PAID</td>
<td class="w-1/6  border border-black px-4 py-2" >
<?php 
//WHERE DETAILS ='DEBITED'  AND PAYMENTMODE ='CASH'
//$x=$connect->query(" SELECT SUM(AMOUNT) AS AMOUNT FROM debtrecords  WHERE AMOUNT <0 AND DATE >='$starttime'  AND DATE <= '$endtime' AND PAYMENTMODE ='CASH'  ");
$x=$connect->query(" SELECT SUM(AMOUNT) AS AMOUNT FROM debtrecords  WHERE PAYMENTMODE ='CASH'  AND DETAILS  REGEXP 'DEBITED' AND DATE >='$starttime'  AND DATE <= '$endtime'   ");
while ($data = $x->fetch_object())
{ 
print number_format($data->AMOUNT,2);
$ttlcash =$ttlcash+$data->AMOUNT;
}
?>

 </td>
<td class="w-1/6  border border-black px-4 py-2" >
<?php 
//WHERE DETAILS ='DEBITED'  AND PAYMENTMODE ='CASH'
//$x=$connect->query(" SELECT SUM(AMOUNT) AS AMOUNT FROM debtrecords  WHERE AMOUNT <0 AND DATE >='$starttime'  AND DATE <= '$endtime' AND PAYMENTMODE ='CASH'  ");
$x=$connect->query(" SELECT SUM(AMOUNT) AS AMOUNT FROM debtrecords  WHERE PAYMENTMODE ='M-PESA'  AND DETAILS  REGEXP 'DEBITED' AND DATE >='$starttime'  AND DATE <= '$endtime'   ");
while ($data = $x->fetch_object())
{ 
print number_format($data->AMOUNT,2);
}
?>
 </td>
<td class="w-1/6  border border-black px-4 py-2" > </td>
</tr>

<tr class="bg-white-900 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >EXPENCE</td>

<td class="w-1/6  border border-black px-4 py-2" > 
<?php 
$x=$connect->query(" SELECT SUM(AMOUNT) AS AMOUNT FROM miscexpences WHERE PAYMENTCHANNEL ='CASH' AND DATE >='$starttime'  AND DATE <= '$endtime' ");
while ($data = $x->fetch_object())
{ 
print number_format($data->AMOUNT,2);
$ttlcash =$ttlcash-$data->AMOUNT;
}
?></td>
<td class="w-1/6  border border-black px-4 py-2" ><?php 
$x=$connect->query(" SELECT SUM(AMOUNT) AS AMOUNT FROM miscexpences WHERE PAYMENTCHANNEL ='M-PESA' AND DATE >='$starttime'  AND DATE <= '$endtime' ");
while ($data = $x->fetch_object())
{ 
print number_format($data->AMOUNT,2);
}
?> </td>
<td class="w-1/6  border border-black px-4 py-2" >
<?php 
$x=$connect->query(" SELECT SUM(AMOUNT) AS AMOUNT FROM miscexpences WHERE PAYMENTCHANNEL ='INVOICE' AND DATE >='$starttime'  AND DATE <= '$endtime'  ");
while ($data = $x->fetch_object())
{ 
print $data->AMOUNT;
}
?>
 </td>
</tr>



<tr class="bg-white-900 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >TOTAL</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php
print number_format($ttlcash,2); 
?> </td>
<td class="w-1/6  border border-black px-4 py-2" > </td>
<td class="w-1/6  border border-black px-4 py-2" > </td>
</tr>

</tbody>
</table>

<Br>

<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class=" text-black-700 font-bold" >
<td class="w-1/6 bg-blue-100 border border-black px-4 py-2" >RECEPTION</td>
<td class="w-1/6  border border-black px-4 py-2" >SIGN  </td>
<td class="w-1/6 bg-blue-100 border border-black px-4 py-2" >ADMINISTRATIOR </td>
<td class="w-1/6  border border-black px-4 py-2" >SIGN  </td>
</tr>
</tbody>
</table>
</div>