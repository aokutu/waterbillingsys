<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
@$invoicenumber=$_SESSION['invoicenumber'];
@$supplier=$_SESSION['supplier'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  AND  ACCESS  REGEXP  'REQUISITION'   ";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


?>
<div id="newrequisitions">
<h2 style='text-align:center' ><strong>STORES PURCHASES REQUISITION</strong></h2>
<h4><strong>
<div  style='text-align:center'>SERIAL NUMBER :<?php print $_SESSION['purchasereqnumber'];?>  </div>
</strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class="theader"   height="21" valign="top" >NO	  </td>
            <td  class="theader" width="30%"   height="21" valign="top" >ITEM	  </td>
			<td  class="theader"   height="21" valign="top" >UNIT	  </td>
		  <td  class="theader"   height="21" valign="top" >STOCK CARD BAL.	  </td>
		  <td  class="theader"   height="21" valign="top" >QUANTITY REQUIRED	  </td>
         <td  class="theader"   height="21" valign="top" >PRICE + 16% VAT	  </td>
         <td  class="theader"   height="21" valign="top" >AMOUNT </td>
		  <td  class="theader"   height="21" valign="top" >REMARKS </td>
		  <td  class="theader"   height="21" valign="top" >DATE</td>
		  <td  class="theader"   height="21" valign="top" > DEL </td>
			   
          </tr>
        </thead>
        <tbody>
       <?php
		$number=0;
	$x="SELECT ID,ITEM,QUANTITY,UNITS,DATE(DATE),PREVBALANCE,PRICE,VALUE,PURPOSE  FROM PURCHASESREQUISITION  WHERE SERIALNUMBER ='".$_SESSION['purchasereqnumber']."'   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { $number +=1;
		   echo"<tr class='filterdata'>
		   <td>".$number."</td>
                <td  width='30%'>".$y['ITEM']."</td>
				<td>".$y['UNITS']."</td>
				 <td>".$y['PREVBALANCE']."</td>
		 <td>". $y['QUANTITY']."</td>
				  <td>". number_format($y['PRICE'],2)."</td>
				   <td>". number_format($y['VALUE'],2)."</td>
				   <td>". $y['PURPOSE']."</td> 
				   <td>". $y['DATE(DATE)']."</td> 
              <td >	  
<input name='id[]' type='checkbox' value='".$y['ID']."'   class='form-control input-sm'>
			</td> 
		
           </tr>";
		 }
		 }

	$x="SELECT SUM(VALUE) FROM PURCHASESREQUISITION  WHERE SERIALNUMBER ='".$_SESSION['purchasereqnumber']."' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
		    <td></td>
                <td  width='30%'>TOTAL</td>
				<td></td>
				 <td></td>
		 <td></td><td></td>
				  <td>". number_format($y['SUM(VALUE)'],2)."</td>
				   
				   
              <td ></td> 
			  <td ></td> 
				<td ></td> 
           </tr>";
		 }
		 }
		 
	?>
        </tbody>
		
      </table>
	  <br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>