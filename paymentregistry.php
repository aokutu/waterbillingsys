<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
@$invoicenumber=$_SESSION['invoicenumber'];
@$supplier=$_SESSION['supplier'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND  ACCESS  REGEXP   'INVENTORY REG' ";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$searchmethod=$_SESSION['searchmethod'];$searchvalue=$_SESSION['searchvalue'];


//$x="SELECT SUPPLIER,PAYMODE,PAYREFFERENCE,AMOUNT,DATE,ID FROM SUPPLIERPAYMENT  WHERE  DATE >='".$_SESSION['date1']."'  AND DATE  <='".$_SESSION['date2']."'   AND  SUPPLIER REGEXP '".$_SESSION['supplier']."' ";
$x="SELECT SUPPLIER,PAYMODE,PAYREFFERENCE,AMOUNT,DATE,ID FROM SUPPLIERPAYMENT  WHERE  DATE >='".$_SESSION['date1']."'  AND DATE  <='".$_SESSION['date2']."'   AND  SUPPLIER REGEXP '".$_SESSION['supplier']."' ";

$x2="SELECT SUM(AMOUNT) FROM SUPPLIERPAYMENT  WHERE  DATE >='".$_SESSION['date1']."'  AND DATE  <='".$_SESSION['date2']."'    AND  SUPPLIER REGEXP '".$_SESSION['supplier']."'   ";
$head="<h4 style='text-align:center;font-weight:bold;'>SUPPLIER ".$_SESSION['supplier']."<br> PAYMENTS FROM:".$_SESSION['date1']."-TO:".$_SESSION['date2']."</h4>";


?>
<div id="payment">
 <table    class=" table table-hover">
	  <h4><strong><?php print $head; ?></strong></h4>
        <!--DWLayoutTable-->
        <thead>
          <tr>
		  <td  class="theader"   height="21" valign="top" >DATE	  </td>
            <td  class="theader" width="25%"   height="21" valign="top" >SUPPLIER	  </td>	
<td  class="theader"   height="21" valign="top" >PAYMENTMODE	  </td>
<td  class="theader"   height="21" valign="top" >PAYMENTREFF	  </td>			
		  <td  class="theader"   height="21" valign="top" >AMOUNT	  </td>
		   <td   class="theader"   height="21" valign="top" > DELETE  <input type="hidden" id="action" name="action" value="DELETEPAY"></td>
   
          </tr>
        </thead>
        <tbody>
       <?php


		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
		                    <td  >".$y['DATE']."</td>
                <td  width='25%'>".$y['SUPPLIER']."</td>
				<td  >".$y['PAYMODE']."</td>
				<td  >".$y['PAYREFFERENCE']."</td>
				  <td>". number_format($y['AMOUNT'],2)."</td>
				<td><input name='payment[]' disabled type='checkbox' value='".$y['ID']."'   class='form-control input-sm'> </td>      
           </tr>";
		   
		 }
		 }

		$x=mysqli_query($connect,$x2)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
		    <td></td>
                <td  width='25%'>TOTAL</td>	
<td></td><td></td>				
				  <td>". number_format($y['SUM(AMOUNT)'],2)."</td>
				  <td></td>
           </tr>";
	

		}
		 }
	?>
        </tbody>
		
      </table>
	  <br />
	  <button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 

</div>