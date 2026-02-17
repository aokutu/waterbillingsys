<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'VIEW BILLS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$date1=$_SESSION['date1'];
$date2=$_SESSION['date2'];
$category=$_SESSION['category'];
 
 $x="CREATE TEMPORARY TABLE `BILLSREPORT` (
 `flow` text NOT NULL,
  `inflow` text NOT NULL,
  `outflow` int(11) NOT NULL,
  `collection` float NOT NULL,
  `revenue` float NOT NULL,
  `billed` float NOT NULL,
  `month` text NOT NULL,
  `year` int(11) NOT NULL,
  `zone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
 
  if(($category =='company')  ||  ($category =='zones') )
	 {
	$x="SELECT * FROM zones ";
 $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
 if(mysqli_num_rows($x)>0)
		{
	while ($y=@mysqli_fetch_array($x))
		{
$i=$y['number'];$billstablex='bills'.$i;$nonwaterbillsx='nonwaterbills'.$i;$zonename=$y['zone'];
$b="INSERT INTO BILLSREPORT (REVENUE,MONTH,YEAR,COLLECTION,INFLOW,ZONE) SELECT BALANCE,MONTHNAME(DATE),YEAR(DATE),BALANCE,CONCAT('WATER BILL'),CONCAT('$zonename') FROM $billstablex WHERE  DATE >='$date1' AND  DATE <='$date2' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));

$b="INSERT INTO BILLSREPORT (REVENUE,MONTH,YEAR,COLLECTION,INFLOW,ZONE) SELECT AMOUNT,MONTHNAME(DATE),YEAR(DATE),AMOUNT,NAME,CONCAT('$zonename') FROM $nonwaterbillsx WHERE  DATE >='$date1' AND  DATE <='$date2' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));

			
			
		}
	
	}	 
	 }
else {$billstablex='bills'.$category;$nonwaterbillsx='nonwaterbills'.$category;
$b="INSERT INTO BILLSREPORT (FLOW,REVENUE,MONTH,YEAR,COLLECTION,INFLOW,ZONE) SELECT ACCOUNT,BALANCE,MONTHNAME(DATE),YEAR(DATE),BALANCE,CONCAT('WATER BILL'),CONCAT($category) FROM $billstablex WHERE  DATE >='$date1' AND  DATE <='$date2' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="INSERT INTO BILLSREPORT (FLOW,REVENUE,MONTH,YEAR,COLLECTION,INFLOW,ZONE) SELECT ACCOUNT,AMOUNT,MONTHNAME(DATE),YEAR(DATE),AMOUNT,NAME,CONCAT($category) FROM $nonwaterbillsx WHERE  DATE >='$date1' AND  DATE <='$date2' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));
}

 ?>
<div  id="billsdata">
<img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  />
 <h4   style="text-align:center"><strong><?php print $company;?>  BILLS DISTRIBUTION  <?php print $_SESSION['date1']; ?> TO  <?php print $_SESSION['date2'];?>  </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		 <td class="theader"   valign="top">PERIOD</td>	
  <td   class="theader"  height="21" valign="top" >MODE </td>		 
		  <td   class="theader"  height="21" valign="top" >CATEGORY</td>
			<td   class="theader"  height="21" valign="top" >AMOUNT</td>
		
          </tr>
        </thead>
        <tbody>
        <?php
	 if($category =='company')
	 {
		 
		  $x="SELECT INFLOW,YEAR,MONTH,SUM(REVENUE),YEAR,ZONE  FROM  BILLSREPORT   GROUP BY YEAR,MONTH,INFLOW ORDER BY YEAR,MONTH";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>	
					<td >".$company."</td>			 
		      <td >".$y['INFLOW']."</td>
		    <td >KSH. ".number_format($y['SUM(REVENUE)'],2)."</td>
		  
           </tr>";
			
		}}
		 
		 
		 
	 }
	 
	 else  if($category =='zones')
	 {
		 
		  $x="SELECT INFLOW,YEAR,MONTH,SUM(REVENUE),YEAR,ZONE  FROM  BILLSREPORT   GROUP BY ZONE,YEAR,MONTH,INFLOW  ORDER BY YEAR,MONTH";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>	
					<td >".$y['ZONE']."</td>			 
		      <td >".$y['INFLOW']."</td>
		    <td >KSH. ".number_format($y['SUM(REVENUE)'],2)."</td>
		  
           </tr>";
			
		}}
		 
		 
		 
	 }
	 
	 else  
	 {
		 
		  $x="SELECT FLOW,INFLOW,YEAR,MONTH,SUM(REVENUE),YEAR,ZONE  FROM  BILLSREPORT  WHERE  BILLSREPORT.ZONE=$category  GROUP BY YEAR,MONTH,FLOW ORDER BY YEAR,MONTH,FLOW ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>	
					<td >".$y['FLOW']."</td>			 
		      <td >".$y['INFLOW']."</td>
		    <td >KSH. ".number_format($y['SUM(REVENUE)'],2)."</td>
		  
           </tr>";
			
		}}
		 
		 
		 
	 }

		 

		 
	

//////////////////////
if($category =='company')
	 {
		 
		  $x="SELECT SUM(REVENUE)  FROM  BILLSREPORT ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	 echo"<tr class='filterdata'>
             <td  ></td>  <td  ></td>		  
		      <td >TOTAL</td>
		    <td >KSH. ".number_format($y['SUM(REVENUE)'],2)."</td>
		  
           </tr>";
		 }
		 
		 } 
		 
		 
		 
	 }
	 
	 else  if($category =='zones')
	 {
		 
		  $x="SELECT SUM(REVENUE)  FROM  BILLSREPORT  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	 echo"<tr class='filterdata'>
             <td  ></td>  <td  ></td>		  
		      <td >TOTAL</td>
		    <td >KSH. ".number_format($y['SUM(REVENUE)'],2)."</td>
		  
           </tr>";
		 }
		 
		 } 
		 
		 
		 
	 }
	 
	 else  
	 {
		 
		  $x="SELECT SUM(REVENUE),COUNT(FLOW)  FROM  BILLSREPORT WHERE  BILLSREPORT.ZONE=$category  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	 echo"<tr class='filterdata'>
            <td >TOTAL</td> <td  >".$y['COUNT(FLOW)']."</td>  <td  ></td>		  
		      
		    <td >KSH. ".number_format($y['SUM(REVENUE)'],2)."</td>
		  
           </tr>";
		 }
		 
		 } 
		 
		 
		 
	 }	
		 ?>
		 

  </tbody>
    </table>
<br />
</div>