<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
<div id="zones">
<h4><strong>PENDING SALES </strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td  class="theader" width="50%"   height="21" valign="top" >ITEM</td>
			
		  <td  class="theader"   height="21" valign="top" >QNTY	  </td>
		  		  <td  class="theader"   height="21" valign="top" >SALE PRICE	  </td>
				  		  		  <td  class="theader"   height="21" valign="top" >TOTAL SALES	  </td>
		  <td  class="theader"   height="21" valign="top" >
		  <select class="form-control"   required= "on"  name="action2" id="action2">
		  <option value="PROCESS">PROCESS PAYMENTS </option>
		  <option value="DELSALES">REFUND ITEM </option>
		   </select>
	  </td>
			   
          </tr>
        </thead>
        <tbody>
       <?php
		
	$x="SELECT * FROM SALES  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
                <td  width='50%'>".$y['item']."</td>
				 <td>".$y['quantity']."</td>
				  <td>". number_format($y['price'],2)."</td>
				    <td>". number_format($y['total'],2)."</td>
              <td ><input name='id[]' type='checkbox' value='".$y['id']."'   class='form-control input-sm'></td> 
		
           </tr>";
		 }
	
		 
		 
		 }
		 $x="SELECT SUM(total) FROM SALES ";
		 	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $ttl=$y['SUM(total)'];
		print"  <tr class='filterdata'>
                <td  width='50%'>TOTAL SALES </td>
				 <td></td>
				  <td></td>
			 <td ><input name='total' type='text' value='".number_format($y['SUM(total)'],2)."' readonly   class='form-control input-sm'></td> 

				    <td></td>
		
           </tr>";	
			
		}}
		 
      	print"  <tr class='filterdata'>
                <td  width='30%'>DISCOUNT 
				
				</td>
				<td><input name='discount' autocomplete ='off'   type='text'   class='form-control input-sm'></td><td></td>
				<td>
				 
	  <label class='checkbox-inline'> 
        <input type='radio' name='paymode'   value='CASH' id='cashpayment'  checked > CASH.
     </label>
 
				 
				 
				 
				 </td>
				  <td> <label class='checkbox-inline'> 
        <input type='radio' name='paymode'   id='mpesapayment' value='MPESA'  > M-PESA.
     </label>	</td>
	  <td>	
	  <input type='text'  pattern='[0-9A-Za-z]+' title='INVALID ENTRIES' placeholder='PAYMENT REFFERENCE' style='text-transform:uppercase'  autocomplete ='off' class='form-control input-sm'  name='payrefference'   id='payrefference' />
</td>

 <td><input name='date'  type='date'  required  class='form-control input-sm'></td>
		
           </tr>";
	?>
        </tbody>
		
      </table>
	  <br />
	  <input  style='text-transform:uppercase'   name="action" type="hidden"  required="on"  class="form-control input-sm"   id="search-box" value="DELETE"   >

<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>