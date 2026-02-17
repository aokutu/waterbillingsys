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

 ?>
 <div  id="accbaldata">

 <h4   style="text-align:center"><strong><?php print $company;?>  ANNUAL DISCONNECTION REPORT FROM <?php print $yr1."-".$month1;?> TO <?php print $yr2."-".$month2; ?> </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		
  <td   class="theader"  height="21" valign="top" >PERIOD </td>		 
			<td   class="theader"  height="21" valign="top" >DISCONNECTIONS </td>
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
		$i=$y['NUMBER'];$nonwaterbillsx='nonwaterbills'.$i;
	$b="INSERT  INTO OPENTABLE1 (A,B,C,D,E) SELECT ACCOUNT,YEAR(DATE),MONTH(DATE),MONTHNAME(DATE),DATE FROM $nonwaterbillsx WHERE NAME REGEXP 'CONP'  OR NAME REGEXP 'COR'";
		mysqli_query($connect,$b)or die(mysqli_error($connect));
		}
		}
			  $x="SELECT B,D,COUNT(ID)  FROM OPENTABLE1  WHERE E >='$month'  AND E <='$finaldate' GROUP BY B,D ORDER BY E ASC      ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ 	 echo"
		<tr class='filterdata'>            	
		<td >".$y['B']."-".$y['D']."</td>
		<td >".$y['COUNT(ID)']."</td>
		</tr>";
			
		}}
		 
		$disconnectionreport = "disconnectionreport.txt"; 
$myFile = fopen($disconnectionreport , "w");
fputs($myFile,"----".$company."--ANNUAL DISCONNECTION REPORT FROM---".$yr1."-".$month1." ---TO--- ".$yr2."-".$month2."--- "."\n");	


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
$x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE E REGEXP '".$_SESSION['month']."' ";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection1 =$y['DISCONNECTION'];
	
		}}
		
	
		 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE B ='$yrb' AND C ='$monthb2'   ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $disconnection2 =$y['DISCONNECTION'];
	
		}}
		
			 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE B ='$yrc' AND C ='$monthc2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $disconnection3 =$y['DISCONNECTION'];
	
		}} 
		
	///////////////////////////////////////////////////////	
fputs($myFile,$yr1."-".$yr2."\t  1ST QUOTER "."\n");
fputs($myFile,"MONTH  \t ".$month1."\t ".$monthb."\t".$monthc." \n");
fputs($myFile,"NEW CONNECTIONS  \t ".$disconnection1."\t ".$disconnection2."\t".$disconnection3." \n");	
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
$x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE E REGEXP '".$_SESSION['month']."' ";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection1 =$y['DISCONNECTION'];
	
		}}
		
	
		 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE B ='$yrb' AND C ='$monthb2'   ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $disconnection2 =$y['DISCONNECTION'];
	
		}}
		
			 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE B ='$yrc' AND C ='$monthc2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $disconnection3 =$y['DISCONNECTION'];
	
		}} 
		
			 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1   WHERE B ='$yrd' AND C ='$monthd2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection4=$y['DISCONNECTION'];
	
		}}
		
				 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE B ='$yre' AND C ='$monthe2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection5=$y['DISCONNECTION'];
	
		}}
		
					 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1   WHERE B ='$yrf' AND C ='$monthf2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection6=$y['DISCONNECTION'];
	
		}}
		
		////////////////////////////////////////////////
	
fputs($myFile,$yr1."-".$yr2."\t  1ST QUOTER \t\t \t 2ND QUOTER"."\n");
fputs($myFile,"MONTH  \t ".$month1."\t ".$monthb."\t".$monthc."\t ".$monthd."\t ".$monthe."\t ".$monthf." \n");
fputs($myFile,"RE CONNECTIONS  \t ".$disconnection1."\t ".$disconnection2."\t".$disconnection3."\t".$disconnection4."\t".$disconnection5."\t".$disconnection6." \n");			
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
	 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE E REGEXP '".$_SESSION['month']."' ";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection1 =$y['DISCONNECTION'];
	
		}}
		
	
		 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE B ='$yrb' AND C ='$monthb2'   ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $disconnection2 =$y['DISCONNECTION'];
	
		}}
		
			 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE B ='$yrc' AND C ='$monthc2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $disconnection3 =$y['DISCONNECTION'];
	
		}} 
		
			 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1   WHERE B ='$yrd' AND C ='$monthd2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection4=$y['DISCONNECTION'];
	
		}}
		
				 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE B ='$yre' AND C ='$monthe2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection5=$y['DISCONNECTION'];
	
		}}
		
					 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1   WHERE B ='$yrf' AND C ='$monthf2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection6=$y['DISCONNECTION'];
	
		}}
		
		
		
		$x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1   WHERE B ='$yrg' AND C ='$monthg2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection7=$y['DISCONNECTION'];
	
		}}
		
		$x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1   WHERE B ='$yrh' AND C ='$monthh2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection8=$y['DISCONNECTION'];
	
		}}
		
		$x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE B ='$yrj' AND C ='$monthj2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection9=$y['DISCONNECTION'];
	
		}}
		
		////////////////////////////////////////////////
		
		
fputs($myFile,$yr1."-".$yr2."\t  1ST QUOTER \t\t \t 2ND QUOTER\t\t \t 3RD QUOTER"."\n");
fputs($myFile,"MONTH  \t ".$month1."\t ".$monthb."\t".$monthc."\t ".$monthd."\t ".$monthe."\t ".$monthf."\t ".$monthg."\t".$monthh." \t ".$monthj."\n");
fputs($myFile,"RE CONNECTIONS  \t ".$disconnection1."\t ".$disconnection2."\t".$disconnection3."\t".$disconnection4."\t".$disconnection5."\t".$disconnection6."\t".$disconnection7."\t".$disconnection8."\t".$disconnection9." \n");		
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
	 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE E REGEXP '".$_SESSION['month']."' ";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection1 =$y['DISCONNECTION'];
	
		}}
		
	
		 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE B ='$yrb' AND C ='$monthb2'   ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $disconnection2 =$y['DISCONNECTION'];
	
		}}
		
			 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE B ='$yrc' AND C ='$monthc2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $disconnection3 =$y['DISCONNECTION'];
	
		}} 
		
			 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1   WHERE B ='$yrd' AND C ='$monthd2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection4=$y['DISCONNECTION'];
	
		}}
		
				 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE B ='$yre' AND C ='$monthe2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection5=$y['DISCONNECTION'];
	
		}}
		
					 $x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1   WHERE B ='$yrf' AND C ='$monthf2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection6=$y['DISCONNECTION'];
	
		}}
		
		
		
		$x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1   WHERE B ='$yrg' AND C ='$monthg2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection7=$y['DISCONNECTION'];
	
		}}
		
		$x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1   WHERE B ='$yrh' AND C ='$monthh2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection8=$y['DISCONNECTION'];
	
		}}
		
		$x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1  WHERE B ='$yrj' AND C ='$monthj2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection9=$y['DISCONNECTION'];
	
		}}
		
		$x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1     WHERE B ='$yrk' AND C ='$monthk2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection10=$y['DISCONNECTION'];
	
		}}
		
		$x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1     WHERE B ='$yrl' AND C ='$monthl2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection11=$y['DISCONNECTION'];
	
		}}
		
		$x="SELECT IFNULL(COUNT(ID),0) AS DISCONNECTION FROM OPENTABLE1    WHERE B ='$yrm' AND C ='$monthm2' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $disconnection12=$y['DISCONNECTION'];
	
		}}
		
		
		
		////////////////////////////////////////////////
		
		
fputs($myFile,$yr1."-".$yr2."\t  1ST QUOTER \t\t \t 2ND QUOTER\t\t \t 3RD QUOTER \t\t \t 4TH QUOTER "."\n");
fputs($myFile,"MONTH  \t ".$month1."\t ".$monthb."\t".$monthc."\t ".$monthd."\t ".$monthe."\t ".$monthf."\t ".$monthg."\t".$monthh." \t ".$monthj." \t ".$monthk." \t ".$monthl." \t ".$monthm.  "\n");
fputs($myFile,"RE CONNECTIONS \t ".$disconnection1."\t ".$disconnection2."\t".$disconnection3."\t".$disconnection4."\t".$disconnection5."\t".$disconnection6."\t".$disconnection7."\t".$disconnection8."\t".$disconnection9."\t".$disconnection10."\t".$disconnection11."\t".$disconnection12." \n");

}
passthru('disconnectionreportcsv.pyw');

 ?>
		 

  </tbody>
    </table>
<br />
<tr class='btn-info btn-sm'>
	   <td width='10%' ></td>
      <td  > 
	  <a href="disconnectionreport.csv" download="disconnectionreport.csv"   title="CLICK TO" data-toggle="popover" data-trigger="hover" data-content=" DOWNLOAD ANNUAL DISCONNECTION  REPORT" data-placement="bottom"  ><input type="button"  class="btn-info btn-sm"  value="DOWNLOAD ANNUAL DISCONNECTION REPORT"  /></a>
</td>	
	  <td ></td>
	  <td ></td>
	  <td ></td>
	  </tr>
</div>
