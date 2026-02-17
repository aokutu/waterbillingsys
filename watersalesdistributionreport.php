<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'VIEW BILLS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$date1=$_SESSION['date1'];
$date2=$_SESSION['date2'];
$category=$_SESSION['category'];

 $x="CREATE TEMPORARY TABLE BILLSREPORT(ZONE TEXT,REFF TEXT,ACCOUNT TEXT,YEAR INT,MONTH INT,METERED FLOAT,BILLED FLOAT,DEDUCTION FLOAT,AMOUNT FLOAT,STDCHARGES FLOAT,TOTAL FLOAT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


	$x="SELECT * FROM zones ";
 $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
 if(mysqli_num_rows($x)>0)
		{
	while ($y=@mysqli_fetch_array($x))
		{
$i=$y['number'];$billstablex='bills'.$i;$nonwaterbillsx='nonwaterbills'.$i;


		}
	
	}

	 
	 

// $x="TRUNCATE TABLE WATERFLOW";mysqli_query($connect,$x)or die(mysqli_error($connect));
 

  if(($category =='company')  ||  ($category =='zones') )
	 {
	$x="SELECT * FROM zones ";
 $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
 if(mysqli_num_rows($x)>0)
		{
	while ($y=@mysqli_fetch_array($x))
		{
$i=$y['number'];$billstablex='bills'.$i;$nonwaterbillsx='nonwaterbills'.$i;$zonename=$y['zone'];
$b="INSERT INTO BILLSREPORT (ZONE,REFF,ACCOUNT,YEAR,MONTH,METERED,BILLED,DEDUCTION,AMOUNT,STDCHARGES,TOTAL) 
SELECT CONCAT($i),ACCOUNT,ACCOUNT,YEAR(DATE),MONTH(DATE),BILLED,UNITS,DEDUCTION,CHARGES,METERCHARGES,BALANCE  FROM $billstablex WHERE  DATE >='$date1' AND  DATE <='$date2' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));

		}
	
	}	 
	 }
else {$billstablex='bills'.$category;$nonwaterbillsx='nonwaterbills'.$category;
$b="INSERT INTO BILLSREPORT (ZONE,REFF,ACCOUNT,YEAR,MONTH,METERED,BILLED,DEDUCTION,AMOUNT,STDCHARGES,TOTAL) 
SELECT CONCAT($i),ACCOUNT,ACCOUNT,YEAR(DATE),MONTH(DATE),BILLED,UNITS,DEDUCTION,CHARGES,METERCHARGES,BALANCE  FROM $billstablex WHERE  DATE >='$date1' AND  DATE <='$date2' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));
}

 ?>
<div  id="billsdata">
    <style>
 table {
    border-collapse: collapse;
    overflow-y: scroll; 
  }
  td, th {
    border: 1px solid black;
    padding: 8px; /* Adjust padding as needed */
    text-align:right;
  }        
        
    </style>
<img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  />
 <h4   style="text-align:center"><strong><?php print $company;?>  WATER CONSUMPTION REPORT FOR <?php  if(($category =='COMPANY')||($category =='ZONES')){print $category;} else 
 {
$x="SELECT ZONE  FROM  zones  WHERE NUMBER ='$category' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{   print $y['ZONE']; }}	 
	 
 } ?> <?php print $_SESSION['date1']; ?> TO  <?php print $_SESSION['date2'];?>  </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          
        </thead>
        <tbody>
            
            <tr>
		  <td class="theader"   valign="top">REFF</td>
		   <td class="theader"   valign="top">ACCOUNTS </td>
		  <td class="theader"   valign="top">METERED M &sup3 </td>
		  
 <td class="theader"   valign="top">DEDUCTION &sup3</td>
<td class="theader"   valign="top">UNITS &sup3</td> 
		 <td class="theader"   valign="top">BILLED &sup3 </td>	
  <td   class="theader"  style='text-align:left;'  height="21" valign="top" >MTR </td>		 
		
			<td   class="theader" style='text-align:left;' height="21" valign="top" >TOTAL</td>
		
          </tr>
        <?php
	 if($category =='company')
	 {
		 
		 
		 
		  $x="SELECT YEAR,MONTH,REFF,COUNT(REFF),SUM(METERED),SUM(BILLED),SUM(DEDUCTION),SUM(AMOUNT),SUM(STDCHARGES),SUM(TOTAL)  FROM  BILLSREPORT   ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
	<td >".$company."</td>
		<td >".$y['COUNT(REFF)']."</td>
	<td >".number_format($y['SUM(METERED)'],2)."</td>
	<td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(DEDUCTION)'],2)."</td>
	<td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(BILLED)'],2)."</td>
             <td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(AMOUNT)'],2)."</td>	
			 <td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(STDCHARGES)'],2)."</td>			 
		
		    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(TOTAL)'],2)."</td>
		  
           </tr>";
			
		}}
		
				 
	 }
	 
	 else  if($category =='zones')
	 {
		 
		 
		 
	
		  $x="SELECT ZONE,REFF,YEAR,MONTH,REFF,COUNT(REFF),SUM(METERED),SUM(BILLED),SUM(DEDUCTION),SUM(AMOUNT),SUM(STDCHARGES),SUM(TOTAL)   FROM  BILLSREPORT  GROUP BY ZONE  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ 
	$b="SELECT ZONE  FROM zones  WHERE NUMBER ='".$y['ZONE']."' ";
	$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
		if(mysqli_num_rows($b)>0)
		{
		
		while ($c=@mysqli_fetch_array($b)){
		$zonename=$c['ZONE'];	
		}}
	
	 echo"<tr class='filterdata'>
	<td >".$zonename."</td>
		<td >".$y['COUNT(REFF)']."</td>
	<td >".number_format($y['SUM(METERED)'],2)."</td>
	<td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(DEDUCTION)'],2)."</td>
	<td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(BILLED)'],2)."</td>
             <td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(AMOUNT)'],2)."</td>	
			 <td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(STDCHARGES)'],2)."</td>			 
		
		    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(TOTAL)'],2)."</td>
		  
           </tr>";
			
		}}
		
		 

		 
		 
		 
	 }
	 
	 else  
	 {
		 
		  $x="SELECT REFF,YEAR,MONTH,REFF,COUNT(REFF),SUM(METERED),SUM(BILLED),SUM(DEDUCTION),SUM(AMOUNT),SUM(STDCHARGES),SUM(TOTAL)  FROM  BILLSREPORT  GROUP BY REFF ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
	<td >".$y['REFF']."</td>
		<td >".$y['COUNT(REFF)']."</td>
	<td >".number_format($y['SUM(METERED)'],2)."</td>
	<td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(DEDUCTION)'],2)."</td>
	<td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(BILLED)'],2)."</td>
             <td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(AMOUNT)'],2)."</td>	
			 <td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(STDCHARGES)'],2)."</td>			 
		
		    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(TOTAL)'],2)."</td>
		  
           </tr>";
			
		}}
		 
		 
		 
	 }

		 
	

//////////////////////

  $x="SELECT YEAR,MONTH,REFF,COUNT(REFF),SUM(METERED),SUM(BILLED),SUM(DEDUCTION),SUM(AMOUNT),SUM(STDCHARGES),SUM(TOTAL)  FROM  BILLSREPORT   ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='btn-info btn-sm' >
	<td >TOTAL</td>
		<td >".$y['COUNT(REFF)']."</td>
	<td >".number_format($y['SUM(METERED)'],2)."</td>
	<td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(DEDUCTION)'],2)."</td>
	<td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(BILLED)'],2)."</td>
             <td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(AMOUNT)'],2)."</td>	
			 <td >&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(STDCHARGES)'],2)."</td>			 
		
		    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['SUM(TOTAL)'],2)."</td>
		  
           </tr>";
			
		}}
		 ?>
		 

  </tbody>
    </table>
<br />
</div>