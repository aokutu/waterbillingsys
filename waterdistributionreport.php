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
 $x="CREATE TEMPORARY TABLE BILLSREPORT(UNITS FLOAT,MONTH INT,YEAR INT,BILLED FLOAT,DEDUCTION FLOAT,INFLOW FLOAT,ZONE TEXT,BALANCE FLOAT) ";
 mysqli_query($connect,$x)or die(mysqli_error($connect));
 
  if(($category =='company')  ||  ($category =='zones') )
	 {
	$x="SELECT * FROM zones ";
 $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
 if(mysqli_num_rows($x)>0)
		{
	while ($y=@mysqli_fetch_array($x))
		{
$i=$y['number'];$billstablex='bills'.$i;$nonwaterbillsx='nonwaterbills'.$i;
$b="INSERT INTO BILLSREPORT (UNITS,MONTH,YEAR,BILLED,DEDUCTION,INFLOW,ZONE,BALANCE) 
SELECT UNITS,MONTH(DATE),YEAR(DATE),BILLED,DEDUCTION,CONCAT('CUNSUMTION'),CONCAT($i),BALANCE FROM $billstablex WHERE  DATE >='$date1' AND  DATE <='$date2' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));

		}
	
	}	 
	 }
else {
	$billstablex='bills'.$category;$nonwaterbillsx='nonwaterbills'.$category;
	$b="INSERT INTO BILLSREPORT (UNITS,MONTH,YEAR,BILLED,DEDUCTION,INFLOW,ZONE,BALANCE) 
SELECT UNITS,MONTH(DATE),YEAR(DATE),BILLED,DEDUCTION,CONCAT('CUNSUMTION'),CONCAT($category),BALANCE FROM $billstablex WHERE  DATE >='$date1' AND  DATE <='$date2' ";

//$b="INSERT INTO BILLSREPORT (FLOW,UNITS,MONTH,YEAR,BILLED,DEDUCTION,INFLOW,ZONE,BALANCE) SELECT  ACCOUNT,UNITS,MONTH(DATE),YEAR(DATE),BILLED,DEDUCTION,CONCAT('CUNSUMTION'),CONCAT($category),BALANCE FROM $billstablex WHERE  DATE >='$date1' AND  DATE <='$date2' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));
}

 ?>
 <div  id="billsdatax" ><?php print $billstablex;?></div>
<div  id="billsdata">
<img src="letterhead.png"    id="letterhead"  width="50%"  height="50%"  />
 <h4   style="text-align:center"><strong><?php print $company;?>  WATER SALES  DISTRIBUTION  REPORT <?php print $_SESSION['date1']; ?> TO  <?php print $_SESSION['date2'];?>  </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		 <td class="theader"   valign="top">PERIOD</td>	
  <td   class="theader"  height="21" valign="top" >MODE </td>
 <td   class="theader"  height="21" valign="top" >METERED  </td>  
	<td   class="theader"  height="21" valign="top" >DEDUCTION  </td>
<td   class="theader"  height="21" valign="top" >AMOUNT  </td>   
<td   class="theader"  height="21" valign="top" >CHARGES  </td>   	
		
		
          </tr>
        </thead>
        <tbody>
        <?php
	 if($category =='company')
	 {
		 
		  $x="SELECT INFLOW,YEAR,MONTH,SUM(UNITS),SUM(BILLED),SUM(DEDUCTION),SUM(BALANCE),YEAR,ZONE  FROM  BILLSREPORT   GROUP BY YEAR,MONTH,INFLOW ORDER BY YEAR,MONTH";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>	
					<td >".$company."</td>			 
		<td >".number_format($y['SUM(BILLED)'],2)."</td>
		<td >".number_format($y['SUM(DEDUCTION)'],2)."</td>
		    <td >".number_format($y['SUM(UNITS)'],2)."</td>
			 <td >".number_format($y['SUM(BALANCE)'],2)."</td>
		  
           </tr>";
			
		}}
		 
		 
		 
	 }
	 
	 else  if($category =='zones')
	 {
		 
		  $x="SELECT INFLOW,YEAR,MONTH,SUM(UNITS),SUM(BILLED),SUM(DEDUCTION),SUM(BALANCE),YEAR,ZONE  FROM  BILLSREPORT   GROUP BY ZONE,YEAR,MONTH,INFLOW  ORDER BY YEAR,MONTH";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>	
					<td >ZONE".$y['ZONE']."</td>			 
		  <td >".number_format($y['SUM(BILLED)'],2)."</td>
		  		<td >".number_format($y['SUM(DEDUCTION)'],2)."</td>
		    <td >".number_format($y['SUM(UNITS)'],2)."</td>
			<td >".number_format($y['SUM(BALANCE)'],2)."</td>
		  
           </tr>";
			
		}}
		 
		 
		 
	 }
	 
	 else  
	 {
		 
		 
	$x="SELECT INFLOW,YEAR,MONTH,SUM(UNITS),SUM(BILLED),SUM(DEDUCTION),SUM(BALANCE),YEAR,ZONE  FROM  BILLSREPORT   GROUP BY ZONE,YEAR,MONTH,INFLOW  ORDER BY YEAR,MONTH";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>	
					<td >ZONE".$y['ZONE']."</td>			 
		  <td >".number_format($y['SUM(BILLED)'],2)."</td>
		  		<td >".number_format($y['SUM(DEDUCTION)'],2)."</td>
		    <td >".number_format($y['SUM(UNITS)'],2)."</td>
			<td >".number_format($y['SUM(BALANCE)'],2)."</td>
		  
           </tr>";
			
		}}
		 

		 
		 
		 
	 }

		 
	

//////////////////////
if($category =='company')
	 {
		 
		  $x="SELECT SUM(UNITS),SUM(BILLED),SUM(DEDUCTION),SUM(BALANCE)  FROM  BILLSREPORT ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	 echo"<tr class='btn-info btn-sm'>
             <td  ></td> 	  
		      <td >TOTAL</td>
			  <td >".number_format($y['SUM(BILLED)'],2)."</td>
			  <td >".number_format($y['SUM(DEDUCTION)'],2)."</td>
		    <td >".number_format($y['SUM(UNITS)'],2)."</td>
			<td >".number_format($y['SUM(BALANCE)'],2)."</td>
		  
           </tr>";
		 }
		 
		 } 
		 
		 
		 
	 }
	 
	 else  if($category =='zones')
	 {
		 
		  $x="SELECT SUM(UNITS),SUM(BILLED),SUM(DEDUCTION),SUM(BALANCE)  FROM  BILLSREPORT  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	 echo"<tr class='btn-info btn-sm'>
             <td  ></td>  	  
		      <td >TOTAL</td>
			  <td >".number_format($y['SUM(BILLED)'],2)."</td>
			  <td >".number_format($y['SUM(DEDUCTION)'],2)."</td>
		    <td >".number_format($y['SUM(UNITS)'],2)."</td>
			<td >".number_format($y['SUM(BALANCE)'],2)."</td>
		  
           </tr>";
		 }
		 
		 } 
		 
		 
		 
	 }
	 
	 else  
	 {
		 
		  $x="SELECT SUM(UNITS),COUNT(INFLOW),SUM(BILLED),SUM(DEDUCTION),SUM(BALANCE)  FROM  BILLSREPORT WHERE  BILLSREPORT.ZONE=$category  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	 echo"<tr class='btn-info btn-sm' >
	 <td  >TOTAL</td>
             <td  > ".$y['COUNT(FLOW)']."</td> 	  
		     <td >".number_format($y['SUM(BILLED)'],2)."</td>
<td >".number_format($y['SUM(DEDUCTION)'],2)."</td>			 
		    <td >".number_format($y['SUM(UNITS)'],2)."</td>
			<td >".number_format($y['SUM(BALANCE)'],2)."</td>
		  
           </tr>";
		 }
		 
		 } 
		 
		 
		 
	 }	
		 ?>
		 

  </tbody>
    </table>
<br />
</div>
