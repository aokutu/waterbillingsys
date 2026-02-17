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
 ?>
 
<div  id="slipstable">
<img src="letterhead.png"    id="letterhead"  width="50%"  height="50%"  />
<h4   style="text-align:center"><strong>ARCHIVED BANK TRANSACTION  <?php  print $searchmethod; ?>  LIKE  <?php print $searchvalue;?></strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		
	<td  class="theader" width="20%"  height="28" valign="top" >ACCOUNT </td>     
	<td  class="theader"  height="28"   valign="top" >TRANSACTION</td> 
<td  class="theader"  height="28" valign="top" >DEPOSITDATE</td>
<td  class="theader"  height="28" valign="top" >UPLOADDATE</td>	
<td  class="theader"  height="28" valign="top" >ARCHIVED DATE</td>					
	<td  class="theader" width='15%' height="28" valign="top" >SLIP CODE</td>	
<td  class="theader"  height="28" valign="top" >AMOUNT</td>				 

          </tr>
        </thead>
        <tbody>
        <?php
	if($searchmethod==null){$x="SELECT * FROM WATERACCOUNTSARCHIVE  ORDER BY  ID DESC LIMIT 50   ";}
else if($searchmethod=='processed'){$x="SELECT * FROM WATERACCOUNTSARCHIVE WHERE STATUS ='PROCESSED' ORDER BY  ID DESC   ";}
else if($searchmethod=='unprocessed'){$x="SELECT * FROM WATERACCOUNTSARCHIVE WHERE STATUS !='PROCESSED' ORDER BY  ID DESC   ";}
else if($searchmethod=='slipcode'){$x="SELECT * FROM WATERACCOUNTSARCHIVE WHERE CODE REGEXP '$searchvalue' ORDER BY  ID DESC   ";}
else if($searchmethod=='uploaddate'){$x="SELECT * FROM WATERACCOUNTSARCHIVE WHERE DATE >='$date1'  AND DATE  <='$date2'  ORDER BY  ID DESC   ";}
else if($searchmethod=='depositdate'){$x="SELECT * FROM WATERACCOUNTSARCHIVE WHERE DEPOSITDATE REGEXP '$searchvalue' ORDER BY  ID DESC   ";}
else if($searchmethod=='transactioncode'){$x="SELECT * FROM WATERACCOUNTSARCHIVE WHERE TRANSACTION REGEXP '$searchvalue' ORDER BY  ID DESC   ";}
else if($searchmethod=='account'){$x="SELECT * FROM WATERACCOUNTSARCHIVE WHERE ACCOUNT REGEXP '$searchvalue' ORDER BY  ID DESC   ";}


		
			$x=mysqli_query($connect2,$x)or die(mysqli_error($connect2));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 	$process=$y['status'];	   print  "<tr class='filterdata'>
			         <td  width='20%'>".$y['account']."</td>  
			    <td  >".$y['transaction']."</td>
				  <td>".$y['depositdate']."</td>
					<td>".$y['date']."</td>
					<td>".$y['date2']."</td>
			   <td  width='15%' >".$y['code']."</td>
			    <td>".number_format($y['credit'],2)."</td>	 </tr>";
		 }
		 
		 }   
		 
		 $x="SELECT COUNT(ID), SUM(credit) FROM WATERACCOUNTSARCHIVE  WHERE CODE  LIKE '$processid%' ";
		 
		 	if($searchmethod==null){$x="SELECT COUNT(ID), SUM(credit) FROM WATERACCOUNTSARCHIVE   LIMIT 50   ";}
else if($searchmethod=='processed'){$x="SELECT COUNT(ID), SUM(credit) FROM WATERACCOUNTSARCHIVE WHERE STATUS ='PROCESSED'    ";}
else if($searchmethod=='unprocessed'){$x="SELECT COUNT(ID), SUM(credit) FROM WATERACCOUNTSARCHIVE WHERE STATUS !='PROCESSED'    ";}
else if($searchmethod=='slipcode'){$x="SELECT COUNT(ID), SUM(credit) FROM WATERACCOUNTSARCHIVE WHERE CODE REGEXP '$searchvalue'    ";}
else if($searchmethod=='uploaddate'){$x="SELECT COUNT(ID), SUM(credit) FROM WATERACCOUNTSARCHIVE WHERE DATE >='$date1'  AND DATE  <='$date2'     ";}
else if($searchmethod=='depositdate'){$x="SELECT COUNT(ID), SUM(credit) FROM WATERACCOUNTSARCHIVE WHERE DEPOSITDATE REGEXP '$searchvalue'    ";}
else if($searchmethod=='transactioncode'){$x="SELECT COUNT(ID), SUM(credit) FROM WATERACCOUNTSARCHIVE WHERE TRANSACTION REGEXP '$searchvalue'    ";}
else if($searchmethod=='account'){$x="SELECT COUNT(ID), SUM(credit) FROM WATERACCOUNTSARCHIVE WHERE ACCOUNT REGEXP '$searchvalue'    ";}


			$x=mysqli_query($connect2,$x)or die(mysqli_error($connect2));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 		
	 echo"<tr class='filterdata'>
			         <td  width='20%'>TOTAL ACC'S ".$y['COUNT(ID)']."</td>  
			    <td  ></td>
				  <td></td>
					<td></td><td></td>
			   <td  width='15%'>TOTAL</td>
			    <td>".number_format($y['SUM(credit)'],2)."</td>	
		
           </tr>";
		 }
		 
		 }   
		?> 
		 	
        </tbody>
    </table>
<br />

</div>