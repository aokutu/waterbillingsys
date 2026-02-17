<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'INVENTORY REG'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>


<h4><strong>STORE ISSUE NOTES  </strong></h4>
<h4><strong>TRANSACTION NUMBER :<?php print $_SESSION['transactionreff']; ?> </strong></h4>
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
		      
          </tr>
        </thead>
        <tbody>
       <?php
		
	$x="SELECT ISSUER,APPROVER,SERIALNUMBER,STATUS,ITEM,UNITS,SERIALNUMBER,QUANTITY,REQUISITIONER,AUTHORIZER,DATE(DATE),ID FROM REQUISITION WHERE TRANSACTIONREFF='".$_SESSION['transactionreff']."' ORDER BY DATE   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
		    <td>".$y['DATE(DATE)']."</td>
			<td>".$y['SERIALNUMBER']."</td>
			
                <td width='30%'>".$y['ITEM']."</td>
				<td>".$y['UNITS']."</td>
				<td>".$y['QUANTITY']."</td>			
				  <td>".$y['REQUISITIONER']."</td>
            <td>".$y['AUTHORIZER']."</td><td>".$y['ISSUER']."</td><td>".$y['APPROVER']."</td>
					
		
           </tr>";
		 }
	
		 
		 
		 }
	?>
        </tbody>
		
      </table>
	  <br />
<input type="hidden" name="action" id="action2" value="SEARCH"> 