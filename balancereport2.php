 <?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW REPORTS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
	
$x="TRUNCATE TABLE BALANCE ";mysqli_query($connect,$x)or die(mysqli_error($connect));

//////////////////////////////
	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$billstable='bills'.$i;$wateraccountstable='wateraccounts'.$i;$nonwaterbills='nonwaterbills'.$i;
$b="INSERT INTO BALANCE (ACCOUNT,ZONE,CATEGORY,CATEGORY2,MONTH,YEAR,AMOUNT1,AMOUNT2) SELECT ACCOUNT,CONCAT($i),CONCAT('BILL'),CONCAT('WATER BILL'),MONTH(DATE),YEAR(DATE),BALANCE,BALANCE FROM  $billstable WHERE  DATE >='$date1' AND  DATE <='$date2'";mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="INSERT INTO BALANCE (ACCOUNT,ZONE,CATEGORY,CATEGORY2,MONTH,YEAR,AMOUNT1,AMOUNT2) SELECT ACCOUNT,CONCAT($i),CONCAT('BILL'),NAME,MONTH(DATE),YEAR(DATE),AMOUNT,AMOUNT FROM  $nonwaterbills WHERE  DATE >='$date1' AND  DATE <='$date2'";mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="INSERT INTO BALANCE (ACCOUNT,ZONE,CATEGORY,CATEGORY2,MONTH,YEAR,AMOUNT1,AMOUNT2) SELECT ACCOUNT,CONCAT($i),CONCAT('REVENUE'),NAME,MONTH(DATE),YEAR(DATE),CREDIT,-1*CREDIT FROM  $wateraccountstable,paymentcode WHERE  DATE >='$date1' AND  DATE <='$date2' AND $wateraccountstable.CODE=paymentcode.code ";mysqli_query($connect,$b)or die(mysqli_error($connect));

/*$b="INSERT INTO WATERFLOW (OUTFLOW,MONTH,YEAR,REVENUE,BILLED) SELECT ACCOUNT,MONTH(DATE),YEAR(DATE),AMOUNT,AMOUNT FROM  $nonwaterbills WHERE  DATE >='$date1' AND  DATE <='$date2'";mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="UPDATE WATERFLOW  SET FLOW='BILL' ,INFLOW='NON WATER BILL' WHERE  FLOW  =''  ";mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="INSERT INTO WATERFLOW (REVENUE,MONTH,YEAR,COLLECTION) SELECT CREDIT,MONTH(DEPOSITDATE),YEAR(DEPOSITDATE),CREDIT FROM $wateraccountstable WHERE  DEPOSITDATE >='$date1' AND  DEPOSITDATE <='$date2' AND  $wateraccountstable.CODE=(SELECT CODE FROM PAYMENTCODE WHERE NAME ='WATER BILL' LIMIT 1)";mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="UPDATE WATERFLOW  SET FLOW='REVENUE'  WHERE  FLOW  ='' ";mysqli_query($connect,$b)or die(mysqli_error($connect));*/

		
		}
		}


//////////////////////////////

?>

<div  id="productionmetertable">
<img src="letterhead.png"    id="letterhead"  width="50%"  height="50%"  />
 <h4   style="text-align:center"><strong><?php print $company;?>  WATER PRODUCTION CONSUMTION REPORT FROM <?php print $date1; ?> TO  <?php print  $date2;?>    </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		 <td class="theader"   valign="top">PERIOD</td>		
		  <td  class="theader" valign="top">INFLOW</td>
		   <td  class="theader" valign="top">OUTFLOW</td>
            <td   class="theader"  height="21" valign="top" >LEAKAGE</td>
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
		   <td >".$y['SUM(INFLOW)']."</td>
		    <td >".$y['SUM(OUTFLOW)']."</td>
           <td  >".$y['BAL']."</td>
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
		   <td >".$y['SUM(INFLOW)']."</td>
		    <td >".$y['SUM(OUTFLOW)']."</td>
           <td  >".$y['BAL']."</td>
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
