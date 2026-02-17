<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  AND  ACCESS  REGEXP  'INVENTORY REG'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>

<div id="pendingrequisition">
<h4><strong>STORE ISSUE NOTES  </strong></h4>
<h4><strong>FROM <?php print $_SESSION['date1'];?>  TO <?php print $_SESSION['date2'];?> </strong></h4>
 <table    class=" table table-hover" style="font-size;70%;">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr style="font-weight:bold;">
		  <td  class="theader"   height="21" valign="top" >DATE</td>
		   <td  class="theader"    height="21" valign="top" >SERIAL # </td>
		   
		   <td  class="theader"   width="30%" height="21" valign="top" >ITEM </td>
			 <td  class="theader"    height="21" valign="top" >UNITS </td>
		  <td  class="theader"   height="21" valign="top" >QNTY</td>
		  
           
		  <td  class="theader"   height="21" valign="top" >REQUESTER </td>
		   <td  class="theader"   height="21" valign="top" >AUTHORIZER</td>
		    <td  class="theader"   height="21" valign="top" >ISSUER</td>
			 <td  class="theader"   height="21" valign="top" >APPROVER</td>
		     <td  class="theader"   height="21" valign="top" >STATUS</td>
			 
			 <td  class="theader"   height="21" valign="top" >
			  DELETE
			 
			 </td>
		 
			   
          </tr>
        </thead>
        <tbody>
       <?php
		
	$x="SELECT ISSUER,APPROVER,SERIALNUMBER,STATUS,ITEM,UNITS,SERIALNUMBER,QUANTITY,REQUISITIONER,AUTHORIZER,DATE,ID FROM REQUISITION WHERE DATE >='".$_SESSION['date1']."' AND DATE <='".$_SESSION['date2']."' ORDER BY DATE   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
		    <td>".$y['DATE']."</td>
			<td>".$y['SERIALNUMBER']."</td>
			
                <td width='30%'>".$y['ITEM']."</td>
				<td>".$y['UNITS']."</td>
				<td>".$y['QUANTITY']."</td>			
				  <td>".$y['REQUISITIONER']."</td>
            <td>".$y['AUTHORIZER']."</td><td>".$y['ISSUER']."</td><td>".$y['APPROVER']."</td>
         		<td>".$y['STATUS']."</td>
			 <td ><input name='id[]' type='checkbox'   value='".$y['ID']."' "; 
			 
			 if(($y['STATUS']=='ISSUED') ||($y['STATUS']=='GATEPASSED')){print "disabled ";}
			 print "  class='form-control input-sm'></td> 			
		
           </tr>";
		 }
	
		 
		 
		 }
	?>
        </tbody>
		
      </table>
	  <br />
<input type="hidden" name="action" id="action2" value="DELETE"> <button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>