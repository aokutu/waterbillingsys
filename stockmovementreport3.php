<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>

<div id="stock">
<h4><strong>STOCK CARD REPORT  FROM  <?php print $_SESSION['date1']; ?> TO <?php print $_SESSION['date1']; ?></strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		  <td  class="theader"   height="21" valign="top" >DATE  </td>
		  <td  class="theader"   height="21" valign="top" >INV/RCPT No.	  </td>
		  <td  class="theader"   height="21" valign="top" >REFF	  </td>
            <td  class="theader" width="40%"   height="21" valign="top" >ITEM	  </td>
			
		  <td  class="theader"   height="21" valign="top" >QNTY	  </td>
		   <td  class="theader"   height="21" valign="top" > CHARGES	  </td>
		   <td  class="theader"   height="21" valign="top" >AVAILABLE STOCK	  </td>
		   
          </tr>
        </thead>
        <tbody>
       <?php
		
	$x="SELECT E,TRANSACTION,D,A,B,C,F FROM STATEMENT ORDER BY E ASC  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{ 
		 while ($y=@mysqli_fetch_array($x))
		 {  if($y['TRANSACTION'] =='STOCK-OUT'){$qnty=$y['B']*-1;}
		 else if($y['TRANSACTION'] =='STOCK-IN'){$qnty=$y['B'];}
		   echo"<tr class='filterdata'>
                <td>".$y['E']."</td>
				<td>".$y['D']."</td>
				 <td>".$y['TRANSACTION']."</td>
				  <td  width='40%'>".$y['A']."</td>
				  <td>".$qnty."</td>
		        <td>".number_format($y['C'],2)."</td>
				 <td>".$y['F']."</td>
           </tr>";

		 }
		 
		 }

	?>
	<tr>
	<td></td>
	</tr>
        </tbody>
		
      </table>
	  <br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>