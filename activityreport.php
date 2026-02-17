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
 $x="TRUNCATE TABLE WATERFLOW";mysqli_query($connect,$x)or die(mysqli_error($connect));
 
    if(($category =='company')  ||  ($category =='zones') )
	 {
	$x="SELECT * FROM zones ";
 $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
 if(mysqli_num_rows($x)>0)
		{
	while ($y=@mysqli_fetch_array($x))
		{
$i=$y['number'];$statushistorytablex='statushistory'.$i;$nonwaterbillsx='nonwaterbills'.$i;
$b="INSERT INTO WATERFLOW (FLOW,MONTH,YEAR,INFLOW,ZONE) SELECT ACCOUNT,MONTH(DATE),YEAR(DATE),TASK,CONCAT($i) FROM $statushistorytablex WHERE  DATE >='$date1' AND  DATE <='$date2' AND TASK !='PRINT BILL' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="INSERT INTO WATERFLOW (FLOW,MONTH,YEAR,INFLOW,ZONE) SELECT ACCOUNT,MONTH(DATE),YEAR(DATE),NAME,CONCAT($i) FROM $nonwaterbillsx WHERE  DATE >='$date1' AND  DATE <='$date2'";
mysqli_query($connect,$b)or die(mysqli_error($connect));

		}
	
	}	 
	 }
else {$statushistorytablex='statushistory'.$category;$nonwaterbillsx='nonwaterbills'.$category;
$b="INSERT INTO WATERFLOW (FLOW,MONTH,YEAR,INFLOW,ZONE) SELECT ACCOUNT,MONTH(DATE),YEAR(DATE),TASK,CONCAT($category) FROM $statushistorytablex WHERE  DATE >='$date1' AND  DATE <='$date2' AND TASK !='PRINT BILL' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="INSERT INTO WATERFLOW (FLOW,MONTH,YEAR,INFLOW,ZONE) SELECT ACCOUNT,MONTH(DATE),YEAR(DATE),NAME,CONCAT($category) FROM $nonwaterbillsx WHERE  DATE >='$date1' AND  DATE <='$date2'";
mysqli_query($connect,$b)or die(mysqli_error($connect));
}

 ?>
 <div  id="revenuedatax"><?php print $category;?></div>
<div  id="revenuedata">
<img src="letterhead.png"    id="letterhead"  width="50%"  height="50%"  />
 <h4   style="text-align:center"><strong><?php print $company;?>  REVENUE DISTRIBUTION  <?php print $_SESSION['date1']; ?> TO  <?php print $_SESSION['date2'];?>  </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		 <td class="theader"   valign="top">PERIOD</td>	
  <td   class="theader"  height="21" valign="top" >MODE </td>		 
		  <td   class="theader"  height="21" valign="top" >TASK</td>
			<td   class="theader"  height="21" valign="top" >FREQUENCY</td>
		
          </tr>
        </thead>
        <tbody>
        <?php
	 if($category =='company')
	 {
		 
		  $x="SELECT INFLOW,YEAR,MONTH,COUNT(FLOW),ZONE  FROM  WATERFLOW GROUP BY YEAR,MONTH,INFLOW ORDER BY YEAR,MONTH";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>	
					<td >".$company."</td>			 
		      <td >".$y['INFLOW']."</td>
		    <td >".$y['COUNT(FLOW)']."</td>
		  
           </tr>";
			
		}}
		 
		 
		 
	 }
	 
	 else  if($category =='zones')
	 {
		 
		  $x="SELECT INFLOW,YEAR,MONTH,COUNT(FLOW),INFLOW,ZONE  FROM  WATERFLOW GROUP BY ZONE,YEAR,MONTH,INFLOW  ORDER BY YEAR,MONTH";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>	
					<td >ZONE".$y['ZONE']."</td>			 
		      <td >".$y['INFLOW']."</td>
		    <td >".$y['COUNT(FLOW)']."</td>
		  
           </tr>";
			
		}}
		 
		 
		 
	 }
	 
	 else  
	 {
		 
		  $x="SELECT FLOW,INFLOW,YEAR,MONTH,COUNT(FLOW),INFLOW,ZONE  FROM  WATERFLOW WHERE  WATERFLOW.ZONE=$category  GROUP BY YEAR,MONTH,FLOW ORDER BY YEAR,MONTH,FLOW";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>	
					<td >".$y['FLOW']."</td>			 
		      <td >".$y['INFLOW']."</td>
		    <td >".$y['COUNT(FLOW)']."</td>
		  
           </tr>";
			
		}}
		 
		 
		 
	 }

		 

		 
	

//////////////////////
if($category =='company')
	 {
		 
		  $x="SELECT COUNT(FLOW)  FROM  WATERFLOW  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	 echo"<tr class='filterdata'>
             <td  ></td>  <td  ></td>		  
		      <td >TOTAL</td>
		    <td >".$y['COUNT(FLOW)']."</td>
		  
           </tr>";
		 }
		 
		 } 
		 
		 
		 
	 }
	 
	 else  if($category =='zones')
	 {
		 
		  $x="SELECT COUNT(FLOW)  FROM  WATERFLOW  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	 echo"<tr class='filterdata'>
             <td  ></td>  <td  ></td>		  
		      <td >TOTAL</td>
		    <td >".$y['COUNT(FLOW)']."</td>
		  
           </tr>";
		 }
		 
		 } 
		 
		 
		 
	 }
	 
	 else  
	 {
		 
		  $x="SELECT COUNT(FLOW)  FROM  WATERFLOW   WHERE WATERFLOW.ZONE=$category  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	 echo"<tr class='filterdata'>
             <td >TOTAL</td>
			 <td  >".$y['COUNT(FLOW)']."</td>		  
		      <td  ></td>
		    <td >".$y['COUNT(FLOW)']."</td>
		  
           </tr>";
		 }
		 
		 } 
		 
		 
		 
	 }	
		 ?>
		 

  </tbody>
    </table>
<br />
</div>