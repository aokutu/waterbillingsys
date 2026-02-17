<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW REPORTS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$date1=$_SESSION['date1'];
$date2=$_SESSION['date2'];
$category=$_SESSION['category'];
 $x="CREATE TEMPORARY TABLE MASTERMETERFLOW(UNITS FLOAT,YEAR TEXT,MONTH  TEXT,ZONE TEXT,COMPANY TEXT,METER TEXT);  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
 
  if(($category =='company')  ||  ($category =='zones') )
	 {
	$x="SELECT * FROM zones ";
 $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
 if(mysqli_num_rows($x)>0)
		{
	while ($y=@mysqli_fetch_array($x))
		{
$i=$y['number'];$billstablex='bills'.$i;$nonwaterbillsx='nonwaterbills'.$i;$mastermeterbill='mastermeterbill'.$i;
$b="INSERT INTO MASTERMETERFLOW (UNITS,MONTH,YEAR,COMPANY,ZONE,METER) SELECT UNITS,MONTH(DATE),YEAR(DATE),CONCAT('$company'),CONCAT($i),METERNUMBER FROM $mastermeterbill WHERE  DATE >='$date1' AND  DATE <='$date2' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));


		}
	
	}	 
	 }
else {$mastermeterbill='mastermeterbill'.$category;

$b="INSERT INTO MASTERMETERFLOW (UNITS,MONTH,YEAR,COMPANY,ZONE,METER) SELECT UNITS,MONTH(DATE),YEAR(DATE),CONCAT('$company'),CONCAT($category),METERNUMBER FROM $mastermeterbill WHERE  DATE >='$date1' AND  DATE <='$date2' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));


}

 ?>
<div  id="billsdata">
<img src="letterhead.png"    id="letterhead"  width="50%"  height="50%"  />
 <h4 style="text-align:center;"><strong><?php print $company.$category;?> MASTER METERS DISTRIBUTION  REPORT <?php print $_SESSION['date1']; ?> TO  <?php print $_SESSION['date2'];?>  </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		 <td class="theader"   valign="top">PERIOD</td>	
  <td   class="theader"  height="21" valign="top" >MODE </td>		 
	<td   class="theader"  height="21" valign="top" >METER </td>	
			<td   class="theader"  height="21" valign="top" >CUBIC METERS</td>
		
          </tr>
        </thead>
        <tbody>
        <?php
	 if($category =='company')
	 {
		 
		  $x="SELECT COMPANY,ZONE,YEAR,MONTH,SUM(UNITS),METER  FROM  MASTERMETERFLOW   GROUP BY YEAR,MONTH,METER ORDER BY YEAR,MONTH,METER";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>	
					<td >".$company."</td>			 
		<td >".$y['METER']."</td>
		    <td >".$y['SUM(UNITS)']."</td>
		  
           </tr>";
			
		}}
		 
		 
		 
	 }
	 
	 else  if($category =='zones')
	 {
		 
		  $x="SELECT  COMPANY,ZONE,YEAR,MONTH,SUM(UNITS),METER  FROM  MASTERMETERFLOW  GROUP BY YEAR,MONTH,METER ORDER BY YEAR,MONTH,METER";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>	
					<td >ZONE".$y['ZONE']."</td>			 
		   <td >".$y['METER']."</td>
		    <td >".$y['SUM(UNITS)']."</td>
		  
           </tr>";
			
		}}
		 
		 
		 
	 }
	 
	 else  
	 {
		 
		  $x="SELECT  COMPANY,ZONE,YEAR,MONTH,SUM(UNITS),METER  FROM  MASTERMETERFLOW GROUP BY YEAR,MONTH,METER ORDER BY YEAR,MONTH,METER ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>	
					<td >".$y['ZONE']."</td>			 
		   <td >".$y['METER']."</td>
		    <td >".$y['SUM(UNITS)']."</td>
		  
           </tr>";
			
		}}
		 
		 
		 
	 }

		 
	

//////////////////////
$x="DROP TABLE MASTERMETERFLOW";
mysqli_query($connect,$x)or die(mysqli_error($connect));	 
		 ?>
		 

  </tbody>
    </table>
<br />
</div>