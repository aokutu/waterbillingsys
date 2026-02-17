<?php 
@session_start();
$connect=mysqli_connect('localhost','root','','jeep');

/* @$account=$_SESSION['account'];$date1=$_SESSION['billdayone'];$date2=$_SESSION['billdaytwo'];

$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'VIEW REPORTS'   OR name='$user' AND password='$password'     AND  ACCESS  REGEXP  'BILLING'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
  if($account ==null){$account=1;}   
 //$date1=date("Y-m")."-01"; $date2=date("Y-m")."-20"; $date3=date("Y-m")."-30";
 
 $x=" SELECT CONCAT(ACCOUNT,'-',DATE,'-',BALANCE,'-','$user')  AS REFF   FROM $billstable WHERE ACCOUNT='$account'  ORDER BY DATE DESC LIMIT 1  ";
	//$x=" SELECT CONCAT('$company/','$zone/',ID)  AS REFF FROM $billstable WHERE ACCOUNT='$account'  ORDER BY DATE DESC LIMIT 1  ";

	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ $reffnumber=$y['REFF']; }}
	
$x="SELECT * FROM $accountstable  WHERE  account='$account' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $_SESSION['client']=$y['client'];$account=$y['account']; $status=$y['status'];$size=$y['size']; $class=$y['class']; $lastreading=$y['email'];$location=$y['location'];  $contact=$y['contact'];}}
	

		
		   $x="SELECT *,YEAR(date),MONTH(date) FROM  $billstable WHERE ACCOUNT='$account' order  by id desc limit 1";
	    	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$meternumber=$y['meternumber']; $previous=$y['previous']; $current=$y['current'];$units=$y['units']; $water=number_format($y['charges'],2); $metercharges=number_format($y['metercharges'],2); $monthlycharges=number_format($y['balance'],2);  $readingdate=$y['date']; $year=$y['YEAR(date)'];$month=$y['MONTH(date)'];}}
$x="TRUNCATE  TABLE  STATEMENT " ;mysqli_query($connect,$x)or die(mysqli_error($connect));
///////////////previous//////////////
$x="SELECT SUM(balance) FROM  $billstable WHERE account=$account AND date <'$date1'  ";
		  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {$previousbill=$y['SUM(balance)'];}}

	  $x="SELECT SUM(credit) FROM $wateraccountstable  WHERE account='$account' AND depositdate <'$date1'   AND  code =(SELECT CODE FROM PAYMENTCODE WHERE NAME ='WATER BILL' LIMIT 1)";
		  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {$previousdepsit=$y['SUM(credit)'];}}
		  $previousbill= $previousnonwaterbill+ $previousbill-$previousdepsit;
			  
		  //////////////////////////////////////////
$x="TRUNCATE  TABLE  STATEMENT " ;mysqli_query($connect,$x)or die(mysqli_error($connect));		  
//$x="insert  into STATEMENT(A,B,H,transaction,G) select concat('$date1'),concat('PREVIOUS BAL'),concat($previousbill),concat('PREVIOUS BAL'),concat($previousbill)";	mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert  into STATEMENT(A,B,C,H,transaction) select depositdate,code,transaction,-1* credit,concat('DEBIT')  FROM  $wateraccountstable  WHERE  account='$account'  AND CODE =(SELECT CODE FROM PAYMENTCODE WHERE NAME REGEXP 'WATER BILL')";	mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert  into STATEMENT(A,B,C,D,E,F,G,H,transaction) select date,current,previous,units,metercharges,refuse,charges,balance,concat('CREDIT')    FROM   $billstable  WHERE  account='$account'   ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT IFNULL(MAX(ID),0) AS MAXID FROM STATEMENT ";
	  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$maxid=$y['MAXID'];}}

/*require_once 'vendor/autoload.php';

use Dompdf\Dompdf as Dompdf;

$dompdf = new Dompdf();
@$dompdf->loadHtml('hello world');

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream();*/
?>


<?php
ob_start(); 
// Load autoloader (using Composer)
require __DIR__ . '/.vendor/autoload.php';
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->AddPage();
 
$html = '<h1>Welcome to <a href="http://techbriefers.com/" style="text-decoration:none;padding: 10px;"> <span style="background-color:#ef3e47;color:#fff;"> Tech</span><span style="background-color:#fff1f0;color:#000;">Briefers</span> </a>!</h1>
<i>This is the two minute example of TCPDF library by <a href="http://techbriefers.com/">techbriefers</a>.</i>
<h2>What is Lorem Ipsum?</h2>
<h1>xxxx</h1>
<img src="tap.png" alt="Girl in a jacket" width="200" height="200">
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>';
 
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->Output('five-min-pdf.pdf', 'I');
?>