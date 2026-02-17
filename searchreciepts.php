<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE   name='$user' AND password='$password'       ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>

<div id="reciept">
<h4><strong>	RECIEPT  NUMBER  LIKE  <?php print  sprintf('%06d',$_SESSION['item']);?> </strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
      <td  class="theader"   height="21" valign="top" >DATE </td>
	  <td  class="theader"   height="21" valign="top" >RECIEPT </td>
	  <td  class="theader"   height="21" valign="top" >PAY MODE </td>
	  <td  class="theader"   height="21" valign="top" >REFFERENCE </td>
			
		  <td  class="theader"   height="21" valign="top" >AMOUNT	  </td>
		  <td  class="theader"   height="21" valign="top" >VIEW DETAILS	 <input type="hidden" id="action2" name="action" value="VIEWITEMS"> </td>
          </tr>
        </thead>
        <tbody>
       <?php
	   
$x="SELECT DATE,REFFERENCE,SUM(TOTAL),REFFERENCE,PAYMODE,PAYMODEREFFERENCE FROM RECIEPT    WHERE  REFFERENCE REGEXP '".sprintf('%06d',$_SESSION['item'])."' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x)) 
		 {
		   echo"<tr class='filterdata'>
		   		 <td>".$y['DATE']."</td>
				  <td>".$y['REFFERENCE']."</td>
				  <td>".$y['PAYMODE']."</td>
				  <td>".$y['PAYMODEREFFERENCE']."</td>
				   <td>".number_format($y['SUM(TOTAL)'],2)."</td>
				<td><input name='recieptnumber[]' type='checkbox' value='".$y['REFFERENCE']."'   class='form-control input-sm'> </td>      
				   
           </tr>";

		 }		 
		 }

$x="SELECT SUM(TOTAL) FROM RECIEPT    WHERE REFFERENCE REGEXP '".sprintf('%06d',$_SESSION['item'])."' ";

		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {  $total=$y['SUM(TOTAL)'];
	 
		   
		 }
		 }	

echo"<tr class='btn-info btn-sm'>
	  <td> </td><td> </td><td> </td>
	  
	  
	  
                <td  >TOTAL</td>
				 <td>".number_format($total,2)."</td>
<td> </td>				 
				 
           </tr>";
	?>
	<tr>
	<td>

	</td>
	<td></td>
	</tr>
        </tbody>
		
      </table>
	  <br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>