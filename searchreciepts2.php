<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE   name='$user' AND password='$password'        ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>

<div id="reciept">
<h4><strong>	TRANSCTIONS  FROM  <?php 	print $_SESSION['date1'];?>  TO <?php print $_SESSION['date2'];?> </strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
      <td  class="theader"   height="21" valign="top" >DATE </td>
	  <td  class="theader"   height="21" valign="top" >RECIEPT </td>
	  
	  <td  class="theader"   height="21" valign="top" >ITEM </td>
	  <td  class="theader"   height="21" valign="top" >QNTY </td>
		  <td  class="theader"   height="21" valign="top" >AMOUNT	  </td>
		  <td  class="theader"   height="21" valign="top" >DELETE	 <input type="hidden" id="action2" name="action" value="DELETEITEMS"> </td>
          </tr>
        </thead>
        <tbody>
       <?php
	   
$x="SELECT DATE,REFFERENCE,TOTAL,ITEM,ID,QUANTITY FROM RECIEPT    WHERE DATE >='".$_SESSION['date1']."' AND  DATE <='".$_SESSION['date2']."'   ORDER BY DATE ,REFFERENCE,ITEM  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x)) 
		 {
		   echo"<tr class='filterdata'>
		   		 <td>".$y['DATE']."</td>
				 <td>".$y['REFFERENCE']."</td>
				 <td>".$y['ITEM']."</td>
				 <td>".$y['QUANTITY']."</td>
				   <td>".number_format($y['TOTAL'],2)."</td>
				<td><input name='id[]' type='checkbox' value='".$y['ID']."'   class='form-control input-sm'> </td>      
				   
           </tr>";

		 }		 
		 }

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