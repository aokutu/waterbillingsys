<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>

<div id="receiveditems">

<script>
 $("#deletebutton > button").click(function() {
    var deleteitem = $(this).val();
		 var deleted=confirm("DELETE ITEM ?");   
	 if(deleted ==false){return false; }
	 $.post( "deleteclientquotation.php",
$("#receiveditems").serialize(),
function(data){$("#receiveditems").load("pendingquotations.php");
});  return true;

   return true;
   
   
});
</script>
<h4><strong>GOOD RECEIVED FROM  <?php print $_SESSION['date1']; ?> TO <?php print $_SESSION['date2']; ?> </strong></h4>
<div  id="scrolling">
 <table    class=" table table-hover"  style="font-size:75%;">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class="theader"   height="21" valign="top" >ITEM NO	  </td>
		    <td  class="theader"   height="21" valign="top" >SERIAL #	  </td>
		   <td  class="theader"   height="21" valign="top" >INV/DLV #	  </td>
		   <td  class="theader"   height="21" valign="top" >LPO/LSO #	  </td>
            <td  class="theader" width="15%"   height="21" valign="top" >ITEM	  </td>
			<td  class="theader"   height="21" valign="top" >UNIT	  </td>
		  <td  class="theader"   height="21" valign="top" >QNTY	  </td>
		  <td  class="theader"   height="21" valign="top" >UNIT PRICE	  </td>
         <td  class="theader"   height="21" valign="top" >PRICE	  </td>
		  <td  class="theader"   height="21" valign="top" >SHELVE</td>
         <td  class="theader"   height="21" valign="top" >SUPPLIER	  </td>
			
			 <td  class="theader"   height="21" valign="top" >
			  DELETE
			 
			 </td>
		 
			   
          </tr>
        </thead>
        <tbody>
       <?php
		$number=0;
	$x="SELECT VOUCHERNUMBER,LOCALITY,SUPPLIER,INVOICENUMBER,ITEMCODE,ORDERNUMBER,ITEM,UNITS,QUANTITY,UNITPRICE,PRICE,ID,BATCHNUMBER,EXPIRE FROM STOCKIN  WHERE  DATE >='".$_SESSION['date1']."' AND DATE <='".$_SESSION['date2']."' ORDER BY DATE,SUPPLIER ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {$number +=1;
		   echo"<tr class='filterdata'>
		    <td>".$number."</td>
			 <td>".$y['VOUCHERNUMBER']."</td>
		   <td>".$y['INVOICENUMBER']."</td> <td>".$y['ORDERNUMBER']."</td>
                <td  width='15%'>".$y['ITEM']."</td>
				<td>".$y['UNITS']."</td>
				 <td>".$y['QUANTITY']."</td>
		 <td>". number_format($y['UNITPRICE'],2)."</td>
				  <td>". number_format($y['PRICE'],2)."</td>
				  <td>". $y['LOCALITY']."</td>
				   <td>". $y['SUPPLIER']."</td>
				    
            
              <td ><input name='id[]' type='checkbox' value='".$y['ID']."'   class='form-control input-sm'></td> 
		
           </tr>";
		 }
	
		 
		 
		 }
		 
		 
		 	$x="SELECT SUM(PRICE) FROM STOCKIN  WHERE  DATE >='".$_SESSION['date1']."' AND DATE <='".$_SESSION['date2']."'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
		    <td></td><td></td><td></td><td></td>
                <td  width='15%'>TOTAL</td>
				<td></td>
				 <td></td>
		 <td></td>
				  <td>". number_format($y['SUM(PRICE)'],2)."</td>
				   <td></td> <td></td>
				   
              <td ></td> 
		
           </tr>";
		 }
		 }
	?>
        </tbody>
		
      </table>
	  </div>
	 	  <br />
	  <input type="hidden" id="action" name="action" value="DELETETRANSACTION2">
	  <button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 

</div>