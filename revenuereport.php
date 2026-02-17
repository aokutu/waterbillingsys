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
 $x="TRUNCATE TABLE WATERFLOW";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO WATERFLOW (OUTFLOW,MONTH,YEAR,REVENUE,BILLED) SELECT UNITS,MONTH(DATE),YEAR(DATE),-1*BALANCE,BALANCE FROM  $billstable WHERE  DATE >='$date1' AND  DATE <='$date2'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE WATERFLOW  SET FLOW='OUTFLOW'  WHERE  FLOW  =''  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO WATERFLOW (REVENUE,MONTH,YEAR,COLLECTION) SELECT CREDIT,MONTH(DEPOSITDATE),YEAR(DEPOSITDATE),CREDIT FROM $wateraccountstable WHERE  DEPOSITDATE >='$date1' AND  DEPOSITDATE <='$date2' AND  $wateraccountstable.CODE=(SELECT CODE FROM PAYMENTCODE WHERE NAME ='WATER BILL' LIMIT 1)";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE WATERFLOW  SET FLOW='REVENUE'  WHERE  FLOW  ='' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
?>

<div  id="productionmetertable">
<img src="letterhead.png"    id="letterhead"  width="50%"  height="50%"  />
 <h4   style="text-align:center"><strong>REVENUE DISTRIBUTION REPORT FROM <?php print $date1; ?> TO  <?php print  $date2;?>  </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		 <td class="theader"   valign="top">PERIOD</td>		
		  <td   class="theader"  height="21" valign="top" >BILLED</td>
			<td   class="theader"  height="21" valign="top" >PAYMENT</td>
			<td   class="theader"  height="21" valign="top" >BAL</td>
          </tr>
        </thead>
        <tbody>
        <?php
 $x="SELECT FLOW,SUM(INFLOW),SUM(OUTFLOW),YEAR,MONTH,SUM(INFLOW)-SUM(OUTFLOW) AS BAL,SUM(REVENUE),SUM(BILLED),SUM(COLLECTION)  FROM  WATERFLOW   GROUP BY YEAR,MONTH ORDER BY YEAR,MONTH";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {  
	 echo"<tr class='filterdata'>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>		  
		      <td >KSH. ".number_format($y['SUM(BILLED)'],2)."</td>
			  <td >KSH. ".number_format($y['SUM(COLLECTION)'],2)."</td>
		    <td >KSH. ".number_format($y['SUM(REVENUE)'],2)."</td>
		  	
           </tr>";
		 }
		 
		 } 

		 $x="SELECT SUM(INFLOW),SUM(OUTFLOW),YEAR,MONTH,SUM(INFLOW)-SUM(OUTFLOW) AS BAL,SUM(REVENUE),SUM(BILLED),SUM(COLLECTION)  FROM  WATERFLOW   ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {  
	 echo"<tr class='btn-info btn-sm '>
             <td  >TOTAL</td>		  
		  		     <td >KSH. ".number_format($y['SUM(BILLED)'],2)."</td>
			  <td >KSH. ".number_format($y['SUM(COLLECTION)'],2)."</td>
		    <td >KSH. ".number_format($y['SUM(REVENUE)'],2)."</td>
		  	
           </tr>";
		 }
		 
		 } 
		 ?>
		 

  </tbody>
    </table>
<br />
</div>
