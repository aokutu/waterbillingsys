<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
@$supplier=$_SESSION['supplier'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
	   $reff=$_SESSION['item']; 
$search=$_SESSION['action'];

?>
<div id="newstock">
<h4><strong>
<div  style='text-align:center'>
<?php print $search;?> NUMBER  LIKE <?php print  $reff;?>  <br><br>
 </div>
</strong></h4>
 <table    class=" table table-hover">
  <style type="text/css">
  table { font-size:80%;}
  </style>
	  
        <!--DWLayoutTable-->
   <thead>
           <tr>
		   <td  class="theader"   height="21" valign="top" >ITEM NO	  </td>
		   <td  class="theader"   height="21" valign="top" >ITEM CODE	  </td>
            <td  class="theader" width="30%"   height="21" valign="top" >ITEM	  </td>
			<td  class="theader"   height="21" valign="top" >UNIT	  </td>
		  <td  class="theader"   height="21" valign="top" >QNTY	  </td>
		  <td  class="theader"   height="21" valign="top" >UNIT PRICE	  </td>
         <td  class="theader"   height="21" valign="top" >PRICE	  </td>
         <td  class="theader"   height="21" valign="top" >BATCH/SERIAL #.	  </td>
		  
		  <td  class="theader"   height="21" valign="top" > DEL </td>
			   
          </tr>
        </thead>
        <tbody>
       <?php
$x="SELECT ITEM,UNITS,ITEMCODE,QUANTITY,UNITPRICE,PRICE,ID,BATCHNUMBER,EXPIRE,INVOICENUMBER,VOUCHERNUMBER,SUPPLIER,ID,DATE FROM STOCKIN  WHERE VOUCHERNUMBER REGEXP '01'  ";

if($search=='INVOICE')
{
	$x="SELECT ITEM,UNITS,ITEMCODE,QUANTITY,UNITPRICE,PRICE,ID,BATCHNUMBER,EXPIRE,INVOICENUMBER,VOUCHERNUMBER,SUPPLIER,ID,DATE  FROM STOCKIN  
	WHERE INVOICENUMBER REGEXP '$reff'     ";
}

else if($search=='VOUCHER')
{
$reff=sprintf('%06d',$reff);
$x="SELECT ITEM,UNITS,ITEMCODE,QUANTITY,UNITPRICE,PRICE,ID,BATCHNUMBER,EXPIRE,INVOICENUMBER,VOUCHERNUMBER,SUPPLIER,ID,DATE FROM STOCKIN  
 WHERE VOUCHERNUMBER REGEXP '$reff' ";
}

$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
		    <td>".sprintf('%04d',$number) ."</td>
		   <td>".$y['ITEMCODE']."</td>
                <td  width='30%'>".$y['ITEM']."</td>
				<td>".$y['UNITS']."</td>
				 <td>".$y['QUANTITY']."</td>
		 <td>". number_format($y['UNITPRICE'],2)."</td>
				  <td>". number_format($y['PRICE'],2)."</td>
				   <td>". $y['BATCHNUMBER']."</td>
				    
              <td >
			  
<input name='id[]' type='checkbox' value='".$y['ID']."'   class='form-control input-sm'></td> 
		
           </tr>";
		 }
		 }
		 
		 
if($search=='INVOICE')
{
	$x="SELECT SUM(PRICE)   FROM STOCKIN WHERE INVOICENUMBER REGEXP '$reff'     ";
}

else if($search=='VOUCHER')
{
$reff=sprintf('%06d',$reff);
$x="SELECT SUM(PRICE)   FROM STOCKIN WHERE VOUCHERNUMBER REGEXP '$reff' ";
}

$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
		    <td></td><td></td>
                <td  width='30%'>TOTAL</td>
				<td></td>
				 <td></td>
		 <td></td>
				  <td>". number_format($y['SUM(PRICE)'],2)."</td>
				   <td></td>
				   
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
