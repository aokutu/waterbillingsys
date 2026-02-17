<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW REPORTS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$range=$_SESSION['range'];
@$range=$_SESSION['range'];$month=$_SESSION['month']."-01";


$x="SELECT YEAR('$month') AS YR1,MONTHNAME('$month') AS MONTH1,MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL $range MONTH)) AS MONTH2, YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL $range MONTH)) AS YR2, DATE_ADD(LAST_DAY('$month'), INTERVAL $range MONTH) AS FINALDATE ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $yr1=$y['YR1'];$month1=$y['MONTH1'];$yr2=$y['YR2'];$month2=$y['MONTH2'];$finaldate=$y['FINALDATE'];
	}}

 ?>
 <div  id="accbaldata">

 <h4   style="text-align:center"><strong><?php print $company;?>  ANNUAL REVENUE  REPORT FROM <?php print $yr1."-".$month1;?> TO <?php print $yr2."-".$month2; ?> </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		
  <td   class="theader"  height="21" valign="top" >PERIOD </td>
	<td   class="theader"  height="21" valign="top" >CODE</td>  
				<td   class="theader"  height="21" valign="top" >NAME </td>
					<td   class="theader"  height="21" valign="top" >AMOUNT </td>
		      </tr>
        </thead>
        <tbody>
        <?php
		
	$x="TRUNCATE OPENTABLE1 ";mysqli_query($connect,$x)or die(mysqli_error($connect));
	
	
	$x="SELECT NUMBER FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
		$i=$y['NUMBER'];$wateraccountsx='wateraccounts'.$i;
	$b="INSERT  INTO OPENTABLE1 (A,B,C,D,E,F,G) SELECT $wateraccountsx.CODE,CREDIT,YEAR(DEPOSITDATE),MONTH(DEPOSITDATE),MONTHNAME(DEPOSITDATE),DEPOSITDATE,NAME FROM $wateraccountsx,paymentcode WHERE DEPOSITDATE >='$month' AND DEPOSITDATE <='$finaldate' AND $wateraccountsx.code=paymentcode.code  ";
		mysqli_query($connect,$b)or die(mysqli_error($connect));
		}
		}
			  $x="SELECT A,C,E,SUM(B),G  FROM OPENTABLE1   GROUP BY C,D,A ORDER BY F ASC      ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ 	 echo"
		<tr class='filterdata'>            	
		<td >".$y['C']."-".$y['E']."</td>
		<td >".$y['A']."</td>
		<td >".$y['G']."</td>
		<td >".number_format($y['SUM(B)'],2)."</td>
		</tr>";
			
		}}
		
		
			  $x="SELECT SUM(B)  FROM OPENTABLE1   ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ 	 echo"
		<tr class='filterdata'>            	
		<td >TOTAL</td>
		<td ></td>
		<td ></td>
		<td >".number_format($y['SUM(B)'],2)."</td>
		</tr>";
			
		}}
		
		 
		$revenuereport = "revenuereport.txt"; 
$myFile = fopen($revenuereport , "w");
fputs($myFile,"----".$company."--ANNUAL REVENUE REPORT FROM---".$yr1."-".$month1." ---TO--- ".$yr2."-".$month2."--- "."\n");	

if($range==2 )
{
	$x="SELECT MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 1 MONTH)) AS MONTHB,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 1 MONTH)) AS YRB,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 1 MONTH)) AS MONTHB2,
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 2 MONTH)) AS MONTHC,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 2 MONTH)) AS MONTHC2,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 2 MONTH)) AS YRC  ";
				$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$monthb=$y['MONTHB']; $monthb2=$y['MONTHB2']; $yrb=$y['YRB']; $monthc=$y['MONTHC'];$monthc2=$y['MONTHC2']; $yrc=$y['YRC'];}}
	
fputs($myFile,$yr1."-".$yr2."\t  1ST QUOTER "."\n");
fputs($myFile,"MONTH  \t ".$month1."\t ".$monthb."\t".$monthc." \n");


////////////////////////////////////////////////
$b="SELECT CODE,NAME FROM PAYMENTCODE";
		$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
		if(mysqli_num_rows($b)>0)
		{
		
		 while ($y=@mysqli_fetch_array($b))
		{
		$code=$y['CODE'];$name=$y['NAME'];	
		
	$x="SELECT IFNULL(SUM(B),0) AS AMOUNT  FROM OPENTABLE1  WHERE F REGEXP '".$_SESSION['month']."'  AND A='$code' ";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount1 =round($y['AMOUNT'],2); 

		}}	
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1   WHERE C ='$yrb' AND D ='$monthb2' AND A='$code' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $amount2 =round($y['AMOUNT'],2);

	
		}}
	
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrc' AND D ='$monthc2' AND A='$code' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $amount3 =round($y['AMOUNT'],2);

	
		}}
		

		
	fputs($myFile,$code."--".$name."\t ".$amount1."\t ".$amount2."\t ".$amount3." \n");	
	
		}}
		
///////////////////////////
$x="SELECT IFNULL(SUM(B),0) AS AMOUNT  FROM OPENTABLE1  WHERE F REGEXP '".$_SESSION['month']."'   ";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $ttl1 =round($y['AMOUNT'],2); 

		}}	
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1   WHERE C ='$yrb' AND D ='$monthb2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl2 =round($y['AMOUNT'],2);

	
		}}
	
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrc' AND D ='$monthc2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl3 =round($y['AMOUNT'],2);

	
		}}
	fputs($myFile,"TOTAL \t ".$ttl1."\t ".$ttl2."\t ".$ttl3." \n");	
		
/////////////////////////////
}


else if($range==5 )
{
	
		$x="SELECT MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 1 MONTH)) AS MONTHB,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 1 MONTH)) AS YRB,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 1 MONTH)) AS MONTHB2,
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 2 MONTH)) AS MONTHC,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 2 MONTH)) AS MONTHC2,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 2 MONTH)) AS YRC,
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 3 MONTH)) AS MONTHD,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 3 MONTH)) AS YRD,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 3 MONTH)) AS MONTHD2,
	
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 4 MONTH)) AS MONTHE,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 4 MONTH)) AS YRE,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 4 MONTH)) AS MONTHE2,
	
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 5 MONTH)) AS MONTHF,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 5 MONTH)) AS YRF,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 5 MONTH)) AS MONTHF2
	";
				$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$monthb=$y['MONTHB']; $monthb2=$y['MONTHB2']; $yrb=$y['YRB']; $monthc=$y['MONTHC'];$monthc2=$y['MONTHC2']; $yrc=$y['YRC']; 
	$monthd=$y['MONTHD'];$monthd2=$y['MONTHD2']; $yrd=$y['YRD'];
	$monthe=$y['MONTHE'];$monthe2=$y['MONTHE2']; $yre=$y['YRE'];
	$monthf=$y['MONTHF'];$monthf2=$y['MONTHF2']; $yrf=$y['YRF']; }}
	
	////////////////////////////////////////////////////////
	fputs($myFile,$yr1."-".$yr2."\t  1ST QUOTER \t\t \t 2ND QUOTER"."\n");
fputs($myFile,"MONTH  \t ".$month1."\t ".$monthb."\t".$monthc."\t ".$monthd."\t ".$monthe."\t ".$monthf." \n");


$b="SELECT CODE,NAME FROM PAYMENTCODE";
		$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
		if(mysqli_num_rows($b)>0)
		{
		
		 while ($y=@mysqli_fetch_array($b))
		{
		$code=$y['CODE'];$name=$y['NAME'];	
	$x="SELECT IFNULL(SUM(B),0) AS AMOUNT  FROM OPENTABLE1  WHERE F REGEXP '".$_SESSION['month']."'  AND A='$code'  ";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount1 =round($y['AMOUNT'],2);
	
		}}
		
		
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1   WHERE C ='$yrb' AND D ='$monthb2'  AND A='$code'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $amount2 =round($y['AMOUNT'],2);
	
		}}
		
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrc' AND D ='$monthc2'  AND A='$code'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $amount3 =round($y['AMOUNT'],2);
	
		}}
		
			 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1  WHERE C ='$yrd' AND D ='$monthd2' AND A='$code'   ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount4=round($y['AMOUNT'],2);
	
		}}
		
				 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1 WHERE C ='$yre' AND D ='$monthe2' AND A='$code'  ";		
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount5=round($y['AMOUNT'],2);
	
		}}
		
					 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1  WHERE C ='$yrf' AND D ='$monthf2' AND A='$code' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount6=round($y['AMOUNT'],2);
	
		}}
		
		fputs($myFile,$code."--".$name."\t ".$amount1."\t ".$amount2."\t ".$amount3."\t ".$amount4."\t ".$amount5."\t ".$amount6." \n");		
		}}
		
		
		///////////////////////////
$x="SELECT IFNULL(SUM(B),0) AS AMOUNT  FROM OPENTABLE1  WHERE F REGEXP '".$_SESSION['month']."'   ";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $ttl1 =round($y['AMOUNT'],2); 

		}}	
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1   WHERE C ='$yrb' AND D ='$monthb2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl2 =round($y['AMOUNT'],2);

	
		}}
	
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrc' AND D ='$monthc2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl3 =round($y['AMOUNT'],2);

	
		}}		 
		
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrd' AND D ='$monthd2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl4 =round($y['AMOUNT'],2);

	
		}}
		
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yre' AND D ='$monthe2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl5 =round($y['AMOUNT'],2);

	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrf' AND D ='$monthf2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl6 =round($y['AMOUNT'],2);

	
		}}
	fputs($myFile,"TOTAL \t ".$ttl1."\t ".$ttl2."\t ".$ttl3."\t ".$ttl4."\t ".$ttl5."\t ".$ttl6." \n");	
		
/////////////////////////////


		///////////////////////////////
}

else if($range==8 )
{
		$x="SELECT MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 1 MONTH)) AS MONTHB,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 1 MONTH)) AS YRB,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 1 MONTH)) AS MONTHB2,
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 2 MONTH)) AS MONTHC,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 2 MONTH)) AS MONTHC2,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 2 MONTH)) AS YRC,
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 3 MONTH)) AS MONTHD,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 3 MONTH)) AS YRD,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 3 MONTH)) AS MONTHD2,
	
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 4 MONTH)) AS MONTHE,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 4 MONTH)) AS YRE,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 4 MONTH)) AS MONTHE2,
	
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 5 MONTH)) AS MONTHF,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 5 MONTH)) AS YRF,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 5 MONTH)) AS MONTHF2,
	
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 6 MONTH)) AS MONTHG,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 6 MONTH)) AS YRG,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 6 MONTH)) AS MONTHG2,
	
	
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 7 MONTH)) AS MONTHH,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 7 MONTH)) AS YRH,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 7 MONTH)) AS MONTHH2,
	
	
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 8 MONTH)) AS MONTHJ,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 8 MONTH)) AS YRJ,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 8 MONTH)) AS MONTHJ2
		";
				$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
	{$monthb=$y['MONTHB']; $monthb2=$y['MONTHB2'];$yrb=$y['YRB'];
    $monthc=$y['MONTHC'];$monthc2=$y['MONTHC2']; $yrc=$y['YRC']; 
	$monthd=$y['MONTHD'];$monthd2=$y['MONTHD2']; $yrd=$y['YRD'];
	$monthe=$y['MONTHE'];$monthe2=$y['MONTHE2']; $yre=$y['YRE'];
	$monthf=$y['MONTHF'];$monthf2=$y['MONTHF2']; $yrf=$y['YRF'];
	$monthg=$y['MONTHG'];$monthg2=$y['MONTHG2']; $yrg=$y['YRG'];
	$monthh=$y['MONTHH'];$monthh2=$y['MONTHH2']; $yrh=$y['YRH'];
	$monthj=$y['MONTHJ'];$monthj2=$y['MONTHJ2']; $yrj=$y['YRJ'];
	}}
	
	
	fputs($myFile,$yr1."-".$yr2."\t  1ST QUOTER \t\t \t 2ND QUOTER\t\t \t 3RD QUOTER"."\n");
fputs($myFile,"MONTH  \t ".$month1."\t ".$monthb."\t".$monthc."\t ".$monthd."\t ".$monthe."\t ".$monthf."\t ".$monthg."\t".$monthh." \t ".$monthj."\n");

	////////////////////////////////////////////////////////
	
$b="SELECT CODE,NAME FROM PAYMENTCODE";
		$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
		if(mysqli_num_rows($b)>0)
		{
		
		 while ($y=@mysqli_fetch_array($b))
		{
		$code=$y['CODE'];$name=$y['NAME'];	
	$x="SELECT IFNULL(SUM(B),0) AS AMOUNT  FROM OPENTABLE1  WHERE F REGEXP '".$_SESSION['month']."'  AND A='$code'  ";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount1 =round($y['AMOUNT'],2);
	
		}}
		
		
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1   WHERE C ='$yrb' AND D ='$monthb2'  AND A='$code'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $amount2 =round($y['AMOUNT'],2);
	
		}}
		
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrc' AND D ='$monthc2'  AND A='$code'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $amount3 =round($y['AMOUNT'],2);
	
		}}
		
			 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1  WHERE C ='$yrd' AND D ='$monthd2' AND A='$code'   ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount4=round($y['AMOUNT'],2);
	
		}}
		
				 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1 WHERE C ='$yre' AND D ='$monthe2' AND A='$code'  ";		
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount5=round($y['AMOUNT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1  WHERE C ='$yrf' AND D ='$monthf2' AND A='$code' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount6=round($y['AMOUNT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1  WHERE C ='$yrg' AND D ='$monthg2' AND A='$code' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount7=round($y['AMOUNT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1  WHERE C ='$yrh' AND D ='$monthh2' AND A='$code' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount8=round($y['AMOUNT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1  WHERE C ='$yrj' AND D ='$monthj2' AND A='$code' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount9=round($y['AMOUNT'],2);
	
		}}
		
		fputs($myFile,$code."--".$name."\t ".$amount1."\t ".$amount2."\t ".$amount3."\t ".$amount4."\t ".$amount5."\t ".$amount6."\t ".$amount7."\t ".$amount8."\t ".$amount9." \n");		
		}}
		
		
				///////////////////////////
$x="SELECT IFNULL(SUM(B),0) AS AMOUNT  FROM OPENTABLE1  WHERE F REGEXP '".$_SESSION['month']."'   ";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $ttl1 =round($y['AMOUNT'],2); 

		}}	
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1   WHERE C ='$yrb' AND D ='$monthb2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl2 =round($y['AMOUNT'],2);

	
		}}
	
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrc' AND D ='$monthc2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl3 =round($y['AMOUNT'],2);

	
		}}		 
		
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrd' AND D ='$monthd2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl4 =round($y['AMOUNT'],2);

	
		}}
		
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yre' AND D ='$monthe2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl5 =round($y['AMOUNT'],2);

	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrf' AND D ='$monthf2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl6 =round($y['AMOUNT'],2);

	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrg' AND D ='$monthg2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl7 =round($y['AMOUNT'],2);

	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrh' AND D ='$monthh2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl8 =round($y['AMOUNT'],2);

	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrj' AND D ='$monthj2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl9 =round($y['AMOUNT'],2);

	
		}}
	fputs($myFile,"TOTAL \t ".$ttl1."\t ".$ttl2."\t ".$ttl3."\t ".$ttl4."\t ".$ttl5."\t ".$ttl6."\t ".$ttl7."\t ".$ttl8."\t ".$ttl9." \n");	
		
/////////////////////////////


		
}

else if($range==11 )
{
$x="SELECT MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 1 MONTH)) AS MONTHB,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 1 MONTH)) AS YRB,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 1 MONTH)) AS MONTHB2,
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 2 MONTH)) AS MONTHC,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 2 MONTH)) AS MONTHC2,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 2 MONTH)) AS YRC,
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 3 MONTH)) AS MONTHD,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 3 MONTH)) AS YRD,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 3 MONTH)) AS MONTHD2,
	
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 4 MONTH)) AS MONTHE,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 4 MONTH)) AS YRE,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 4 MONTH)) AS MONTHE2,
	
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 5 MONTH)) AS MONTHF,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 5 MONTH)) AS YRF,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 5 MONTH)) AS MONTHF2,
	
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 6 MONTH)) AS MONTHG,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 6 MONTH)) AS YRG,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 6 MONTH)) AS MONTHG2,
	
	
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 7 MONTH)) AS MONTHH,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 7 MONTH)) AS YRH,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 7 MONTH)) AS MONTHH2,
	
	
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 8 MONTH)) AS MONTHJ,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 8 MONTH)) AS YRJ,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 8 MONTH)) AS MONTHJ2,
	
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 9 MONTH)) AS MONTHK,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 9 MONTH)) AS YRK,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 9 MONTH)) AS MONTHK2,
	
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 10 MONTH)) AS MONTHL,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 10 MONTH)) AS YRL,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 10 MONTH)) AS MONTHL2,
	
	MONTHNAME(DATE_ADD(LAST_DAY('$month'), INTERVAL 11 MONTH)) AS MONTHM,
	YEAR(DATE_ADD(LAST_DAY('$month'), INTERVAL 11 MONTH)) AS YRM,
	MONTH(DATE_ADD(LAST_DAY('$month'), INTERVAL 11 MONTH)) AS MONTHM2
		";
				$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	$monthb=$y['MONTHB']; $monthb2=$y['MONTHB2'];$yrb=$y['YRB'];
    $monthc=$y['MONTHC'];$monthc2=$y['MONTHC2']; $yrc=$y['YRC']; 
	$monthd=$y['MONTHD'];$monthd2=$y['MONTHD2']; $yrd=$y['YRD'];
	$monthe=$y['MONTHE'];$monthe2=$y['MONTHE2']; $yre=$y['YRE'];
	$monthf=$y['MONTHF'];$monthf2=$y['MONTHF2']; $yrf=$y['YRF'];
	$monthg=$y['MONTHG'];$monthg2=$y['MONTHG2']; $yrg=$y['YRG'];
	$monthh=$y['MONTHH'];$monthh2=$y['MONTHH2']; $yrh=$y['YRH'];
	$monthj=$y['MONTHJ'];$monthj2=$y['MONTHJ2']; $yrj=$y['YRJ'];
	$monthk=$y['MONTHK'];$monthk2=$y['MONTHK2']; $yrk=$y['YRK'];
	$monthl=$y['MONTHL'];$monthl2=$y['MONTHL2']; $yrl=$y['YRL'];
	$monthm=$y['MONTHM'];$monthm2=$y['MONTHM2']; $yrm=$y['YRM'];
	}}
	
fputs($myFile,$yr1."-".$yr2."\t  1ST QUOTER \t\t \t 2ND QUOTER\t\t \t 3RD QUOTER \t\t \t 4TH QUOTER "."\n");
fputs($myFile,"MONTH  \t ".$month1."\t ".$monthb."\t".$monthc."\t ".$monthd."\t ".$monthe."\t ".$monthf."\t ".$monthg."\t".$monthh." \t ".$monthj." \t ".$monthk." \t ".$monthl." \t ".$monthm.  "\n");
	
	////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////
	
$b="SELECT CODE,NAME FROM PAYMENTCODE";
		$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
		if(mysqli_num_rows($b)>0)
		{
		
		 while ($y=@mysqli_fetch_array($b))
		{
		$code=$y['CODE'];$name=$y['NAME'];	
	$x="SELECT IFNULL(SUM(B),0) AS AMOUNT  FROM OPENTABLE1  WHERE F REGEXP '".$_SESSION['month']."'  AND A='$code'  ";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount1 =round($y['AMOUNT'],2);
	
		}}
		
		
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1   WHERE C ='$yrb' AND D ='$monthb2'  AND A='$code'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $amount2 =round($y['AMOUNT'],2);
	
		}}
		
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrc' AND D ='$monthc2'  AND A='$code'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $amount3 =round($y['AMOUNT'],2);
	
		}}
		
			 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1  WHERE C ='$yrd' AND D ='$monthd2' AND A='$code'   ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount4=round($y['AMOUNT'],2);
	
		}}
		
				 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1 WHERE C ='$yre' AND D ='$monthe2' AND A='$code'  ";		
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount5=round($y['AMOUNT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1  WHERE C ='$yrf' AND D ='$monthf2' AND A='$code' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount6=round($y['AMOUNT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1  WHERE C ='$yrg' AND D ='$monthg2' AND A='$code' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount7=round($y['AMOUNT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1  WHERE C ='$yrh' AND D ='$monthh2' AND A='$code' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount8=round($y['AMOUNT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1  WHERE C ='$yrj' AND D ='$monthj2' AND A='$code' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount9=round($y['AMOUNT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1  WHERE C ='$yrk' AND D ='$monthk2' AND A='$code' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount10=round($y['AMOUNT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1  WHERE C ='$yrl' AND D ='$monthl2' AND A='$code' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount11=round($y['AMOUNT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1  WHERE C ='$yrm' AND D ='$monthm2' AND A='$code' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $amount12=round($y['AMOUNT'],2);
	
		}}
		
		fputs($myFile,$code."--".$name."\t ".$amount1."\t ".$amount2."\t ".$amount3."\t ".$amount4."\t ".$amount5."\t ".$amount6."\t ".$amount7."\t ".$amount8."\t ".$amount9."\t ".$amount10."\t ".$amount11."\t ".$amount12." \n");		
		}}
		
					///////////////////////////
$x="SELECT IFNULL(SUM(B),0) AS AMOUNT  FROM OPENTABLE1  WHERE F REGEXP '".$_SESSION['month']."'   ";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $ttl1 =round($y['AMOUNT'],2); 

		}}	
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT   FROM OPENTABLE1   WHERE C ='$yrb' AND D ='$monthb2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl2 =round($y['AMOUNT'],2);

	
		}}
	
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrc' AND D ='$monthc2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl3 =round($y['AMOUNT'],2);

	
		}}		 
		
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrd' AND D ='$monthd2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl4 =round($y['AMOUNT'],2);

	
		}}
		
		 $x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yre' AND D ='$monthe2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl5 =round($y['AMOUNT'],2);

	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrf' AND D ='$monthf2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl6 =round($y['AMOUNT'],2);

	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrg' AND D ='$monthg2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl7 =round($y['AMOUNT'],2);

	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrh' AND D ='$monthh2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl8 =round($y['AMOUNT'],2);

	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrj' AND D ='$monthj2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl9 =round($y['AMOUNT'],2);

	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrk' AND D ='$monthk2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl10 =round($y['AMOUNT'],2);

	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrl' AND D ='$monthl2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl11 =round($y['AMOUNT'],2);

	
		}}
		
		$x="SELECT IFNULL(SUM(B),0) AS AMOUNT FROM OPENTABLE1   WHERE C ='$yrm' AND D ='$monthm2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $ttl12 =round($y['AMOUNT'],2);

	
		}}
	fputs($myFile,"TOTAL \t ".$ttl1."\t ".$ttl2."\t ".$ttl3."\t ".$ttl4."\t ".$ttl5."\t ".$ttl6."\t ".$ttl7."\t ".$ttl8."\t ".$ttl9."\t ".$ttl10."\t ".$ttl11."\t ".$ttl12." \n");	
		
/////////////////////////////

}
passthru('revenuereportcsv.pyw');


 ?>
		 

  </tbody>
    </table>
<br />

<tr class='btn-info btn-sm'>
	   <td width='10%' ></td>
      <td  > 
	  <a href="revenuereport.csv" download="revenuereport.csv"   title="CLICK TO" data-toggle="popover" data-trigger="hover" data-content=" DOWNLOAD ANNUAL REVENUE  REPORT" data-placement="bottom"  ><input type="button"  class="btn-info btn-sm"  value="DOWNLOAD ANNUAL REVENUE REPORT"  /></a>
</td>	
	  <td ></td>
	  <td ></td>
	  <td ></td>
	  </tr>
	  
</div>
