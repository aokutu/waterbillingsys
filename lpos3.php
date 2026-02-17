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
<div id="lpos">
<h2 style='text-align:center' ><strong><?php if($_SESSION['action']=='L.S.O'){print 'LOCAL SERVICE ORDER '.$_SESSION['serialnumber'];} else if($_SESSION['action']=='L.P.O'){print 'LOCAL PURCHASE ORDER '.$_SESSION['serialnumber'];} ?></strong></h2>
<h4><strong>
<div  style='text-align:center'>SUPPLIER <?php print $_SESSION['supplier'];?> </div>
</strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class="theader"   height="21" valign="top" >NO	  </td>
            <td  class="theader" width="30%"   height="21" valign="top" >ITEM</td>
			<td  class="theader"   height="21" valign="top" >UNITS </td>
			<td  class="theader"   height="21" valign="top" >QUANTITY</td>
			<td  class="theader"   height="21" valign="top" >UNIT COST</td>
			
			<td  class="theader"   height="21" valign="top" >TOTAL</td>
			
			<td  class="theader"   height="21" valign="top" >DATE </td>
		  <td  class="theader"   height="21" valign="top" > DEL </td>
			   
          </tr>
        </thead>
        <tbody>
       <?php
		$number=0;
	$x="SELECT ID,ITEM,UNITS,QUANTITY,PRICE,AMOUNT,DATE  FROM LPOS  WHERE SERIALNUMBER ='".$_SESSION['serialnumber']."' AND SUPPLIER='".$_SESSION['supplier']."'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { $number +=1;
		   echo"<tr class='filterdata'>
		   <td>".$number."</td>
                <td  width='30%'>".$y['ITEM']."</td>
				<td>".$y['UNITS']."</td>
				 <td>".$y['QUANTITY']."</td>
				<td>".number_format($y['PRICE'],2)."</td>
				<td>".number_format($y['AMOUNT'],2)."</td>
		 <td>". $y['DATE']."</td>
              <td >	  
<input name='id[]' type='checkbox' value='".$y['ID']."'   class='form-control input-sm'>
			</td> 
		
           </tr>";
		 }
		 }
		 
		 $x="SELECT SUM(AMOUNT)  FROM LPOS  WHERE SERIALNUMBER ='".$_SESSION['serialnumber']."' AND SUPPLIER='".$_SESSION['supplier']."'  ";
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
				<td>".number_format($y['SUM(AMOUNT)'],2)."</td>
		 <td></td>
              <td >	</td> 
		
           </tr>";
		 }
		 }
		 
		 
	?>
        </tbody>
		
      </table>
	  <br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>