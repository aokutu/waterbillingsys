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
// $x="TRUNCATE TABLE WATERFLOW";mysqli_query($connect,$x)or die(mysqli_error($connect));
 
  $x="CREATE TEMPORARY TABLE `REVENUEREPORT` (
 `flow` text NOT NULL,
  `inflow` text NOT NULL,
  `outflow` int(11) NOT NULL,
  `collection` float NOT NULL,
  `revenue` float NOT NULL,
  `billed` float NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `zone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_query($connect,$x)or die(mysqli_error($connect));

 
  if(($category =='company')  ||  ($category =='zones') )
	 {
	$x="SELECT *,zone FROM zones ";
 $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
 if(mysqli_num_rows($x)>0)
		{
	while ($y=@mysqli_fetch_array($x))
		{
$i=$y['number'];$wateraccountstablex='wateraccounts'.$i;$zonename=$y['zone'];
$b="INSERT INTO REVENUEREPORT (REVENUE,MONTH,YEAR,COLLECTION,INFLOW,ZONE) SELECT CREDIT,MONTH(DEPOSITDATE),YEAR(DEPOSITDATE),CREDIT,CODE,CONCAT('$zonename') FROM $wateraccountstablex WHERE  DEPOSITDATE >='$date1' AND  DEPOSITDATE <='$date2' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));			
			
		}
	
	}	 
	 }
else {$wateraccountstablex='wateraccounts'.$category;
$b="INSERT INTO REVENUEREPORT (FLOW,REVENUE,MONTH,YEAR,COLLECTION,INFLOW,ZONE) SELECT ACCOUNT,CREDIT,MONTH(DEPOSITDATE),YEAR(DEPOSITDATE),CREDIT,$wateraccountstablex.CODE,CONCAT($category) FROM $wateraccountstablex WHERE  DEPOSITDATE >='$date1' AND  DEPOSITDATE <='$date2' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));}
 ?>
<div  id="revenuedata">
<img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  />
 <h4   style="text-align:center"><strong><?php print $company;?>  REVENUE DISTRIBUTION  <?php print $_SESSION['date1']; ?> TO  <?php print $_SESSION['date2'];?>  </strong></h4>
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
		 
		  $x="SELECT INFLOW,YEAR,MONTH,SUM(REVENUE),NAME,ZONE  FROM  REVENUEREPORT,paymentcode  WHERE REVENUEREPORT.inflow=paymentcode.code GROUP BY YEAR,MONTH,INFLOW ORDER BY YEAR,MONTH";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>	
					<td >".$company."</td>			 
		      <td >".$y['NAME']."</td>
		    <td >KSH. ".number_format($y['SUM(REVENUE)'],2)."</td>
		  
           </tr>";
			
		}}
		 
		 
		 
	 }
	 
	 else  if($category =='zones')
	 {
		 
		  $x="SELECT INFLOW,YEAR,MONTH,SUM(REVENUE),CONCAT('$zonename'),ZONE  FROM  REVENUEREPORT,paymentcode  WHERE REVENUEREPORT.inflow=paymentcode.code GROUP BY ZONE,YEAR,MONTH,INFLOW  ORDER BY YEAR,MONTH";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>	
					<td >".$y['ZONE']."</td>			 
		      <td >".$y['NAME']."</td>
		    <td >KSH. ".number_format($y['SUM(REVENUE)'],2)."</td>
		  
           </tr>";
			
		}}
		 
		 
		 
	 }
	 
	 else  
	 {
		 
		  $x="SELECT FLOW,INFLOW,YEAR,MONTH,SUM(REVENUE),NAME,ZONE  FROM  REVENUEREPORT,paymentcode  where REVENUEREPORT.inflow=paymentcode.code AND REVENUEREPORT.ZONE=$category  GROUP BY YEAR,MONTH,FLOW ORDER BY YEAR,MONTH,FLOW";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>	
					<td >".$y['FLOW']."</td>			 
		      <td >".$y['NAME']."</td>
		    <td >KSH. ".number_format($y['SUM(REVENUE)'],2)."</td>
		  
           </tr>";
			
		}}
		 
		 
		 
	 }

		 

		 
	

//////////////////////
if($category =='company')
	 {
		 
		  $x="SELECT SUM(REVENUE)  FROM  REVENUEREPORT,paymentcode  where REVENUEREPORT.inflow=paymentcode.code  ";			
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
		 
		  $x="SELECT SUM(REVENUE)  FROM  REVENUEREPORT,paymentcode  where REVENUEREPORT.inflow=paymentcode.code  ";			
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
		 
		  $x="SELECT SUM(REVENUE),COUNT(FLOW)  FROM  REVENUEREPORT,paymentcode  where REVENUEREPORT.inflow=paymentcode.code   AND REVENUEREPORT.ZONE=$category  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	 echo"<tr class='filterdata'>
             <td >TOTAL</td>
			 <td  >".$y['COUNT(FLOW)']."</td>		  
		      <td  ></td>
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