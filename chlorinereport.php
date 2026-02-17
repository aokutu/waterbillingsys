 <?php 
 @session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
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

	
	//if($range==1){$range='1ST QUOTER';}
 ?>
 <div  id="accbaldata">

 <h4   style="text-align:center"><strong><?php print $company;?>  ANNUAL CHLORINE REPORT FROM <?php print $yr1."-".$month1;?> TO <?php print $yr2."-".$month2; ?> </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		
  <td   class="theader"  height="21" valign="top" >PERIOD </td>		 
			<td   class="theader"  height="21" valign="top" >QUANTITY (KGS)</td>
		<td   class="theader"  height="21" valign="top" >TOTAL CHARGES</td>
          </tr>
        </thead>
        <tbody>
        <?php
		 $x="SELECT YEAR(DATE),MONTHNAME(DATE),SUM((CHLORINE/1000)*PRICE) AS TTLCHARGES,SUM(CHLORINE/1000) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >='$month'  AND DATE <='$finaldate' GROUP BY YEAR(DATE),MONTHNAME(DATE) ORDER BY DATE ASC    ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight =round($y['WEIGHT'],2);
	 echo"<tr class='filterdata'>
            	
					<td >".$y['YEAR(DATE)']."-".$y['MONTHNAME(DATE)']."</td>
		<td >".$weight."</td>
			<td >".number_format($y['TTLCHARGES'],2)."</td>
					</tr>";
			
		}}
		$chlorinereport = "chlorinereport.txt"; 
$myFile = fopen($chlorinereport , "w");
fputs($myFile,"----".$company."--ANNUAL CHLORINE REPORT FROM---".$yr1."-".$month1." ---TO--- ".$yr2."-".$month2."--- "."\n");	
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
	
	////////////////////////////////////////////////
	 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >='".$_SESSION['month'].'-01'."'  AND  DATE <='".$_SESSION['month'].'-31'."' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight1 =round($y['WEIGHT'],2);
	
		}}
		
		
		 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrb','-','$monthb2','-01'))  AND DATE <= (SELECT CONCAT('$yrb','-','$monthb2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight2 =round($y['WEIGHT'],2);
	
		}}
		
		 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrc','-','$monthc2','-01'))  AND DATE <= (SELECT CONCAT('$yrc','-','$monthc2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight3=round($y['WEIGHT'],2);
	
		}}
	///////////////////////////////////////////////////////	
fputs($myFile,$yr1."-".$yr2."\t  1ST QUOTER "."\n");
fputs($myFile,"AMOUNT USED IN KGS  \t ".$month1."\t ".$monthb."\t".$monthc." \n");
fputs($myFile,"AMOUNT USED IN KGS  \t ".$weight1."\t ".$weight2."\t".$weight3." \n");	
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
	 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >='".$_SESSION['month'].'-01'."'  AND  DATE <='".$_SESSION['month'].'-31'."' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight1 =round($y['WEIGHT'],2);
	
		}}
		 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrb','-','$monthb2','-01'))  AND DATE <= (SELECT CONCAT('$yrb','-','$monthb2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight2 =round($y['WEIGHT'],2);
	
		}}
		
		 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrc','-','$monthc2','-01'))  AND DATE <= (SELECT CONCAT('$yrc','-','$monthc2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight3=round($y['WEIGHT'],2);
	
		}}
		
			 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrd','-','$monthd2','-01'))  AND DATE <= (SELECT CONCAT('$yrd','-','$monthd2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight4=round($y['WEIGHT'],2);
	
		}}
		
				 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yre','-','$monthe2','-01'))  AND DATE <= (SELECT CONCAT('$yre','-','$monthe2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight5=round($y['WEIGHT'],2);
	
		}}
		
					 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrf','-','$monthf2','-01'))  AND DATE <= (SELECT CONCAT('$yrf','-','$monthf2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight6=round($y['WEIGHT'],2);
	
		}}
		
		////////////////////////////////////////////////
	
fputs($myFile,$yr1."-".$yr2."\t  1ST QUOTER \t\t \t 2ND QUOTER"."\n");
fputs($myFile,"AMOUNT USED IN KGS  \t ".$month1."\t ".$monthb."\t".$monthc."\t ".$monthd."\t ".$monthe."\t ".$monthf." \n");
fputs($myFile,"AMOUNT USED IN KGS  \t ".$weight1."\t ".$weight2."\t".$weight3."\t".$weight4."\t".$weight5."\t".$weight6." \n");			
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
	
	////////////////////////////////////////////////////////
	 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >='".$_SESSION['month'].'-01'."'  AND  DATE <='".$_SESSION['month'].'-31'."' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight1 =round($y['WEIGHT'],2);
	
		}}
		 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrb','-','$monthb2','-01'))  AND DATE <= (SELECT CONCAT('$yrb','-','$monthb2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight2 =round($y['WEIGHT'],2);
	
		}}
		
		 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrc','-','$monthc2','-01'))  AND DATE <= (SELECT CONCAT('$yrc','-','$monthc2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight3=round($y['WEIGHT'],2);
	
		}}
		
			 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrd','-','$monthd2','-01'))  AND DATE <= (SELECT CONCAT('$yrd','-','$monthd2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight4=round($y['WEIGHT'],2);
	
		}}
		
				 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yre','-','$monthe2','-01'))  AND DATE <= (SELECT CONCAT('$yre','-','$monthe2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight5=round($y['WEIGHT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrf','-','$monthf2','-01'))  AND DATE <= (SELECT CONCAT('$yrf','-','$monthf2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight6=round($y['WEIGHT'],2);
	
		}}
		
		
		$x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrg','-','$monthg2','-01'))  AND DATE <= (SELECT CONCAT('$yrg','-','$monthg2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight7=round($y['WEIGHT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrh','-','$monthh2','-01'))  AND DATE <= (SELECT CONCAT('$yrh','-','$monthh2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight8=round($y['WEIGHT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrj','-','$monthj2','-01'))  AND DATE <= (SELECT CONCAT('$yrj','-','$monthj2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight9=round($y['WEIGHT'],2);
	
		}}
		
		////////////////////////////////////////////////
		
		
fputs($myFile,$yr1."-".$yr2."\t  1ST QUOTER \t\t \t 2ND QUOTER\t\t \t 3RD QUOTER"."\n");
fputs($myFile,"AMOUNT USED IN KGS  \t ".$month1."\t ".$monthb."\t".$monthc."\t ".$monthd."\t ".$monthe."\t ".$monthf."\t ".$monthg."\t".$monthh." \t ".$monthj."\n");
fputs($myFile,"AMOUNT USED IN KGS  \t ".$weight1."\t ".$weight2."\t".$weight3."\t".$weight4."\t".$weight5."\t".$weight6."\t".$weight7."\t".$weight8."\t".$weight9." \n");		
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
	
	
	////////////////////////////////////////////////////////
	 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >='".$_SESSION['month'].'-01'."'  AND  DATE <='".$_SESSION['month'].'-31'."' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight1 =round($y['WEIGHT'],2);
	
		}}
		 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrb','-','$monthb2','-01'))  AND DATE <= (SELECT CONCAT('$yrb','-','$monthb2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight2 =round($y['WEIGHT'],2);
	
		}}
		
		 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrc','-','$monthc2','-01'))  AND DATE <= (SELECT CONCAT('$yrc','-','$monthc2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight3=round($y['WEIGHT'],2);
	
		}}
		
			 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrd','-','$monthd2','-01'))  AND DATE <= (SELECT CONCAT('$yrd','-','$monthd2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight4=round($y['WEIGHT'],2);
	
		}}
		
				 $x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yre','-','$monthe2','-01'))  AND DATE <= (SELECT CONCAT('$yre','-','$monthe2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight5=round($y['WEIGHT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrf','-','$monthf2','-01'))  AND DATE <= (SELECT CONCAT('$yrf','-','$monthf2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight6=round($y['WEIGHT'],2);
	
		}}
		
		
		$x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrg','-','$monthg2','-01'))  AND DATE <= (SELECT CONCAT('$yrg','-','$monthg2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight7=round($y['WEIGHT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrh','-','$monthh2','-01'))  AND DATE <= (SELECT CONCAT('$yrh','-','$monthh2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight8=round($y['WEIGHT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrj','-','$monthj2','-01'))  AND DATE <= (SELECT CONCAT('$yrj','-','$monthj2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight9=round($y['WEIGHT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrk','-','$monthk2','-01'))  AND DATE <= (SELECT CONCAT('$yrk','-','$monthk2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight10=round($y['WEIGHT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrl','-','$monthl2','-01'))  AND DATE <= (SELECT CONCAT('$yrl','-','$monthl2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight11=round($y['WEIGHT'],2);
	
		}}
		
		$x="SELECT IFNULL(SUM(CHLORINE/1000),0) AS WEIGHT   FROM WATERPRODUCTION  WHERE DATE >= (SELECT CONCAT('$yrm','-','$monthm2','-01'))  AND DATE <= (SELECT CONCAT('$yrm','-','$monthm2','-31')) ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $weight12=round($y['WEIGHT'],2);
	
		}}
		
		
		
		////////////////////////////////////////////////
		
		
fputs($myFile,$yr1."-".$yr2."\t  1ST QUOTER \t\t \t 2ND QUOTER\t\t \t 3RD QUOTER \t\t \t 4TH QUOTER "."\n");
fputs($myFile,"AMOUNT USED IN KGS  \t ".$month1."\t ".$monthb."\t".$monthc."\t ".$monthd."\t ".$monthe."\t ".$monthf."\t ".$monthg."\t".$monthh." \t ".$monthj." \t ".$monthk." \t ".$monthl." \t ".$monthm.  "\n");
fputs($myFile,"AMOUNT USED IN KGS  \t ".$weight1."\t ".$weight2."\t".$weight3."\t".$weight4."\t".$weight5."\t".$weight6."\t".$weight7."\t".$weight8."\t".$weight9."\t".$weight10."\t".$weight11."\t".$weight12." \n");

}
passthru('chlorinecsv.pyw');
?>
		 

  </tbody>
    </table>
<br />

<tr class='btn-info btn-sm'>
	   <td width='10%' ></td>
      <td  > 
	  <a href="chlorinereport.csv" download="chlorinereport.csv"   title="CLICK TO" data-toggle="popover" data-trigger="hover" data-content=" DOWNLOAD ANNUAL CHLORINE  REPORT" data-placement="bottom"  ><input type="button"  class="btn-info btn-sm"  value="DOWNLOAD ANNUAL CHLORINE REPORT"  /></a>
</td>	
	  <td ></td>
	  <td ></td>
	  <td ></td>
	  </tr>
</div>
