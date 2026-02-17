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

 $x="CREATE TEMPORARY TABLE STATUSREPORT(ZONE TEXT,REFF TEXT,ACCOUNT TEXT,STATUS TEXT,YEAR INT,MONTH TEXT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


// $x="TRUNCATE TABLE WATERFLOW";mysqli_query($connect,$x)or die(mysqli_error($connect));
 

  //if(($category =='company')  ||  ($category =='zones') )
  if(($category =='company')  ||  ($category =='zones') )
  {
 $b="INSERT INTO STATUSREPORT (ZONE,REFF,ACCOUNT,STATUS,YEAR,MONTH) 
SELECT zones.ZONE,ACCOUNT,ACCOUNT,STATUS,YEAR(DATE),MONTHNAME(DATE) FROM statustrail,zones WHERE  DATE >='$date1' AND  DATE <='$date2' AND zones.NUMBER=statustrail.ZONE";
mysqli_query($connect,$b)or die(mysqli_error($connect));     
      
      
  }
  else {
$b="INSERT INTO STATUSREPORT (ZONE,REFF,ACCOUNT,STATUS,YEAR,MONTH) 
SELECT ZONE,ACCOUNT,ACCOUNT,STATUS,YEAR(DATE),MONTHNAME(DATE) FROM statustrail WHERE  DATE >='$date1' AND  DATE <='$date2' AND ZONE='$category' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));
      
  }

 ?>
<div  id="statusdata">
<img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  />
 <h4   style="text-align:center"><strong> ACCOUNT STATUS TALLY ON FROM <?php  if(($category =='COMPANY')||($category =='ZONES')){print $category;} else 
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
          <tr>
               <td class="theader"   valign="top">REFF</td>
              <td class="theader"   valign="top">YEAR</td>
		<td class="theader"   valign="top">MONTH</td>
              <td class="theader"   valign="top">STATUS</td>
		
 <td class="theader"   valign="top">TALLY</td>
 
 </tr>
        </thead>
        <tbody>
        <?php
	 if($category =='company')
	 {
		 
		  $x="SELECT STATUS,COUNT(STATUS),YEAR,MONTH FROM  STATUSREPORT GROUP BY STATUS,YEAR,MONTH  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{

	 echo"<tr class='filterdata'>
	 	<td >".str_replace("lawascoco_","",$company)."</td>
	 	<td >".$y['YEAR']."</td>
	 		<td >".$y['MONTH']."</td>
	 			<td >".$y['STATUS']."</td>
	 <td >".$y['COUNT(STATUS)']."</td>
	


           </tr>";
			
		}}		 

		
				 
	 }
	 
	 else  if($category =='zones')
	 {
	     
		  $x="SELECT ZONE,STATUS,COUNT(STATUS),ZONE,YEAR,MONTH FROM  STATUSREPORT  GROUP BY ZONE,STATUS,YEAR,MONTH ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{

	 echo"<tr class='filterdata'>
	 <td >".$y['ZONE']."</td>
	 	<td >".$y['YEAR']."</td>
	 		<td >".$y['MONTH']."</td>
	 			<td >".$y['STATUS']."</td>
	 <td >".$y['COUNT(STATUS)']."</td>
	


           </tr>";
			
		}}
		    
	     
	     
 }
	 
	 else  
	 {
  $x="SELECT zones.ZONE AS ZONENAME,REFF,STATUS,COUNT(STATUS),STATUSREPORT.ZONE,YEAR,MONTH FROM  STATUSREPORT,zones WHERE  zones.NUMBER=STATUSREPORT.ZONE GROUP BY STATUS,YEAR,MONTH ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{

	 echo"<tr class='filterdata'>
	 <td >".$y['ZONENAME']."</td>
	 	<td >".$y['YEAR']."</td>
	 	<td >".$y['MONTH']."</td>
	 	<td >".$y['STATUS']."</td>
	 <td >".$y['COUNT(STATUS)']."</td>
	


           </tr>";
			
		}}
		 
		 
		 
	 }

		 
	

//////////////////////

		
		  $x="SELECT COUNT(STATUS) FROM  STATUSREPORT   ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{

	 echo"<tr class='filterdata'>
	 	<td >TOTAL</td>
	 	<td >TOTAL</td>
	 		<td ></td>
	 			<td ></td>
	 <td >".$y['COUNT(STATUS)']."</td>
	


           </tr>";
			
		}}
		 ?>
		 

  </tbody>
    </table>
<br />
</div>