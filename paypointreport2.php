<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW SLIPS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$date=$_SESSION['date'];
$date1=$_SESSION['date1'];
$date2=$_SESSION['date2'];

$x="SELECT DATEDIFF('$date2','$date1') AS DIFF ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{
 while ($y=@mysqli_fetch_array($x))
 { if($y['DIFF'] <0 ){$_SESSION['message']="INVALID DATES";exit;};  }}
$category=trim(addslashes(strtoupper($_SESSION['category'])));
$x="CREATE TEMPORARY TABLE PAYPOINT(REFF TEXT,PAYPOINT TEXT,AMOUNT FLOAT,DATE DATE)";
mysqli_query($connect,$x)or die(mysqli_error($connect));

//////////////////////

if ($category=='ALL')
{
 $x="SELECT NUMBER,ZONE FROM zones ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{
 while ($y=@mysqli_fetch_array($x))
 {
$wateraccountstablex='wateraccounts'.$y['NUMBER']; $zone=$y['ZONE'];

$n="INSERT INTO PAYPOINT(REFF,PAYPOINT,AMOUNT,DATE) SELECT ACCOUNT,PAYPOINT,CREDIT,DEPOSITDATE FROM $wateraccountstablex WHERE DEPOSITDATE   >= '$date1' AND DEPOSITDATE <='$date2' ";
mysqli_query($connect,$n)or die(mysqli_error($connect));  
  }}    
}
else if($category !='ALL')
{
 $x="SELECT NUMBER,ZONE FROM zones ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{
 while ($y=@mysqli_fetch_array($x))
 {
$wateraccountstablex='wateraccounts'.$y['NUMBER']; $zone=$y['ZONE'];

$n="INSERT INTO PAYPOINT(REFF,PAYPOINT,AMOUNT,DATE) SELECT ACCOUNT,PAYPOINT,CREDIT,DEPOSITDATE FROM $wateraccountstablex WHERE DEPOSITDATE   >= '$date1' AND DEPOSITDATE <='$date2' AND PAYPOINT='$category' ";
mysqli_query($connect,$n)or die(mysqli_error($connect));  
  }}    
}

?>
<div id="accbaldata">
    <style>
        
        table {
    border-collapse: collapse;
    overflow-y: scroll; 
  }
  td, th {
    border: 1px solid black;
    padding: 8px; /* Adjust padding as needed */
    text-align:left;
  } 
        
    </style>
	<h4 align="center" style="text-decoration:underline;"><strong>PAYPOINT REPORT FROM <?php print $date1; ?> TO <?php print $date2; ?></strong></h4>
<table class="table">
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
             <tr>
              <td  class="theader"  height="21" valign="top" >YEAR</td>
             
			  <td  class="theader"  height="21" valign="top" > PAYPOINT</td> 
			   
			   <td  class="theader"  style="text-align:left;"  height="21" valign="top" >AMOUNT</td> 
			      
				 
		</tr>
       <?php
       
  /*     
  if($category =='COMPANY'){
    $x="SELECT YEAR,MONTH,PAYPOINT,AMOUNT  AS TTL FROM PAYPOINT GROUP BY  YEAR,MONTH,PAYPOINT  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	if(mysqli_num_rows($x)>0)
	{
	 while ($y=@mysqli_fetch_array($x))
	 { 
	   echo"<tr   class='filterdata'  >
			<td  >".$y['YEAR']."-".$y['MONTH']."</td>
			<td  >".$company."L</td>
			<td  >".$y['PAYPOINT']."</td>
				
				<td   >".number_format($y['TTL'],2)."</td>
	   </tr>";
	 }
	 }    
       } 
       
       
else   if($category =='ZONES'){
           
                 $x="SELECT YEAR,MONTH,PAYPOINT,ZONE,AMOUNT  AS TTL FROM PAYPOINT GROUP BY  YEAR,MONTH,ZONE,PAYPOINT ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	if(mysqli_num_rows($x)>0)
	{
	 while ($y=@mysqli_fetch_array($x))
	 { 
	   echo"<tr   class='filterdata'  >
			<td  >".$y['YEAR']."-".$y['MONTH']."</td>
			<td  >".$y['ZONE']."</td>
			<td  >".$y['PAYPOINT']."</td>
				
				<td   >".number_format($y['TTL'],2)."</td>
	   </tr>";
	 }
	 } 
           
           
       }
       
    else {
         $x="SELECT YEAR,MONTH,PAYPOINT,REFF,AMOUNT  AS TTL FROM PAYPOINT GROUP BY  YEAR,MONTH,REFF,PAYPOINT ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	if(mysqli_num_rows($x)>0)
	{
	 while ($y=@mysqli_fetch_array($x))
	 { 
	   echo"<tr   class='filterdata'  >
			<td  >".$y['YEAR']."-".$y['MONTH']."</td>
			<td  >".$y['REFF']."</td>
			<td  >".$y['PAYPOINT']."</td>
				
				<td   >".number_format($y['TTL'],2)."</td>
	   </tr>";
	 }
	 } 
        
    }
       
       */
       
  $x="SELECT DATE,PAYPOINT,AMOUNT  AS TTL FROM PAYPOINT GROUP BY  DATE,PAYPOINT  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	if(mysqli_num_rows($x)>0)
	{
	 while ($y=@mysqli_fetch_array($x))
	 { 
	   echo"<tr   class='filterdata'  >
			<td  >".$y['DATE']."</td>
		
			<td  >".$y['PAYPOINT']."</td>
				
				<td   > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['TTL'],2)."</td>
	   </tr>";
	 }
	 }



      $x="SELECT SUM(AMOUNT) AS TTL FROM PAYPOINT  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	if(mysqli_num_rows($x)>0)
	{
	 while ($y=@mysqli_fetch_array($x))
	 { 
	   echo"<tr   class='filterdata'  >
			<td  ></td>
				<td style='font-weight:bold;' >TOTAL</td>
				<td  style='font-weight:bold;'  > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['TTL'],2)."</td>
	   </tr>";
	 }
	 }

	?>
        </tbody>
    </table>
	</div>