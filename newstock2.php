<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
@$invoicenumber=$_SESSION['invoicenumber'];
@$supplier=$_SESSION['supplier'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


?>
<div id="newstock">
<h2 style='text-align:center' ><strong>GOODS RECEIVED NOTE</strong></h2>
<h4><strong>
<div  style='text-align:center'>SUPPLIER :<?php print $_SESSION['supplier'];?><br><br>
INVOICE/DELIVERY NOTE # :<?php print $_SESSION['invoicenumber'];?>

<br>  SERIAL NUMBER :<?php

$x="SELECT VOUCHERNUMBER FROM STOCKIN  WHERE INVOICENUMBER='".$_SESSION['invoicenumber']."' AND SUPPLIER='".$_SESSION['supplier']."'  LIMIT 1   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$vouchernumber= $y['VOUCHERNUMBER'];}
	
	}
	else if(mysqli_num_rows($x)<1)
	{


$x="SELECT IFNULL((MAX(VOUCHERNUMBER)+1),1) FROM STOCKIN  WHERE INVOICENUMBER='".$_SESSION['invoicenumber']."' AND SUPPLIER='".$_SESSION['supplier']."'  LIMIT 1   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$vouchernumber= $y['VOUCHERNUMBER'];}}
	
	}

 print $vouchernumber; $_SESSION['vouchernumber']=$vouchernumber;?>  </div>
</strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class="theader"   height="21" valign="top" >ITEM NO	  </td>
            <td  class="theader" width="30%"   height="21" valign="top" >ITEM	  </td>
			<td  class="theader"   height="21" valign="top" >UNIT	  </td>
		  <td  class="theader"   height="21" valign="top" >QNTY	  </td>
		  <td  class="theader"   height="21" valign="top" >UNIT PRICE	  </td>
         <td  class="theader"   height="21" valign="top" >AMOUNT	  </td>
			 <td  class="theader"   height="21" valign="top" >
			  DELETE
			 
			 </td>
			   
          </tr>
        </thead>
        <tbody>
       <?php
		$number=0;
	$x="SELECT ITEM,UNITS,QUANTITY,UNITPRICE,PRICE,ID FROM STOCKIN  WHERE INVOICENUMBER='".$_SESSION['invoicenumber']."' AND SUPPLIER='".$_SESSION['supplier']."' ORDER BY ITEM   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {$number +=1;
		   echo"<tr class='filterdata'>
		    <td>".$number ."</td>		   
                <td  width='30%'>".$y['ITEM']."</td>
				<td>".$y['UNITS']."</td>
				 <td>".$y['QUANTITY']."</td>
		 <td>". number_format($y['UNITPRICE'],2)."</td>
				  <td>". number_format($y['PRICE'],2)."</td>
              <td ><input name='id[]' type='checkbox' value='".$y['ID']."'   class='form-control input-sm'></td> 
           </tr>";
		 }
		 }

	$x="SELECT SUM(PRICE) FROM STOCKIN  WHERE INVOICENUMBER='$invoicenumber' AND SUPPLIER='$supplier'";
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
		 <td></td>
				  <td>". number_format($y['SUM(PRICE)'],2)."</td>
				   <td></td>
				   
            
		
           </tr>";
		 }
		 }
		 
	?>
        </tbody>
		
      </table>
	  <br />
	  <input type="hidden" id="action" name="action" value="DELETETRANSACTION">
	  <button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 

</div>