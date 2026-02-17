 <?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'VIEW REPORTS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$searchvalue=$_SESSION['searchvalue'];$searchmethod=$_SESSION['searchmethod']; $date1=$_SESSION['date1']; $date2=$_SESSION['date2'];
$searchvalue=trim(addslashes($searchvalue));
 ?>
 
<div  id="slipstable">

<h4 style="text-align:center;"><strong>UNPROCESSSED  NOTIFICATION  FROM <?php  print $date1; ?>  TO   <?php print $date2;?></strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		<td  class="theader"  height="28"   valign="top" >DATE</td> 
	
	<td  class="theader" width="30%"  height="28" valign="top" >MESSAGE </td>     
	<td  class="theader"  height="28"   valign="top" >AMOUNT</td> 
          </tr>
        </thead>
        <tbody>
        <?php


$x="SELECT MESSAGE,AMOUNT,DATE,ACCOUNT FROM NOTIFICATION WHERE  DATE >='$date1' AND  DATE <='$date2'";		
			$x=mysqli_query($connect2,$x)or die(mysqli_error($connect2));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 	$process=$y['status'];	   print  "<tr class='filterdata'>
	  <td  >".$y['DATE']."</td>
	<td  width='30%'>".$y['MESSAGE']."</td>  
		<td>".number_format($y['AMOUNT'],2)."</td>";}}
		
		$x="SELECT COUNT(MESSAGE),SUM(AMOUNT) FROM NOTIFICATION WHERE  DATE >='$date1' AND  DATE <='$date2'";		
			$x=mysqli_query($connect2,$x)or die(mysqli_error($connect2));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 	 print  "<tr class='btn-info btn-sm'>
	  <td  >TOTAL</td>
	<td  width='30%'>".$y['COUNT(MESSAGE)']."</td>  
		<td>".number_format($y['SUM(AMOUNT)'],2)."</td>";}}
		?> 
		 	
        </tbody>
    </table>
<br />

</div>