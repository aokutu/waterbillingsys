<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'INVENTORY REG'     ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>

<div id="pendingrequisition">
<h4><strong>DISPATCH ISSUE NOTE <?php print $_SESSION['issuenotenumber']; ?> </strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		  <td width="2%" class="theader"   height="21" valign="top" >NO.</td>
		  <td width='10%' class="theader"   height="21" valign="top" >DATE</td>
		   <td  class="theader"   width="30%" height="21" valign="top" >ITEM </td>
			 <td  class="theader"    height="21" valign="top" >UNITS </td>
		  <td  class="theader"   height="21" valign="top" >QNTY</td>
		   <td  class="theader"   height="21" valign="top" >STOCK</td>
          		  <td  class="theader"   height="21" valign="top" >REQUISITIONER </td>
		   <td  class="theader"   height="21" valign="top" >AUTHORIZER</td>			 
			 <td  class="theader"   height="21" valign="top" >
			 DISPATCH
			 
			 </td>
		 
			   
          </tr>
        </thead>
        <tbody>
       <?php
	$number=0;	
	$x="SELECT REQUISITION.ITEM,REQUISITION.UNITS,REQUISITION.SERIALNUMBER,REQUISITION.QUANTITY,REQUISITIONER,AUTHORIZER,DATE(REQUISITION.DATE) AS DATEX,REQUISITION.ID,INVENTORY.QUANTITY AS STORE FROM REQUISITION,INVENTORY  WHERE SERIALNUMBER='".$_SESSION['issuenotenumber']."'  AND STATUS !='ISSUED' AND INVENTORY.ITEM=REQUISITION.ITEM  ORDER BY REQUISITION.DATE   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { $number+=1;
		   echo"<tr class='filterdata'>
		   <td width='2%'>".$number."</td>
		    <td width='10%'>".$y['DATEX']."</td>
                <td width='30%'>".$y['ITEM']."</td>
				<td>".$y['UNITS']."</td>
				<td>".$y['QUANTITY']."</td>
				<td>".$y['STORE']."</td>					
				  <td>".$y['REQUISITIONER']."</td>
            <td>".$y['AUTHORIZER']."</td>";
			if($y['QUANTITY'] <= $y['STORE']){print "<td ><input name='id[]' type='checkbox' value='".$y['ID']."' class='form-control input-sm'></td>";}
			else if($y['QUANTITY'] > $y['STORE']){print "<td style='font-size:80%;background-color:skyblue;text-color:white;' >RESTOCK</td>";}
			
		
           print "</tr>";
		 }
	
		 
		 
		 }
	?>
        </tbody>
		
      </table>
	  <br />
<input id="action2" name="action"  value="DISPATCH"  type="hidden">  <button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>