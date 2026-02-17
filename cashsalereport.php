<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE   name='$user' AND password='$password'     ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
if($_SESSION['date1']==null){$_SESSION['date1']=date('Y-m-d');}
if($_SESSION['date2']==null){$_SESSION['date2']=date('Y-m-d');}
?>

<div id="reports">
<h4><strong>SALES   <?php  print $_SESSION['date1']; ?> TO <?php print $_SESSION['date2']; ?> </strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
      <td  class="theader"   height="21" valign="top" >DATE </td>
			
		  <td  class="theader"   height="21" valign="top" >AMOUNT	  </td>
		  <td  class="theader"   height="21" valign="top" >VIEW DETAILS	 <input type="hidden" id="action2" name="action" value="VIEWRECIEPTS"> </td>
          </tr>
        </thead>
        <tbody>
       <?php
	$x="SELECT DATE,SUM(TOTAL) FROM RECIEPT    WHERE  DATE >='".$_SESSION['date1']."' AND DATE <='".$_SESSION['date2']."'  GROUP BY  DATE  ORDER BY  DATE ASC ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x)) 
		 {
		   echo"<tr class='filterdata'>
		   		 <td>".$y['DATE']."</td>
				   <td>".number_format($y['SUM(TOTAL)'],2)."</td>
				<td><input name='salesdate[]' type='checkbox' value='".$y['DATE']."'   class='form-control input-sm'> </td>      
				   
           </tr>";

		 }		 
		 }
 
		 	 $x="SELECT SUM(TOTAL)FROM  RECIEPT      WHERE DATE >='".$_SESSION['date1']."'  AND DATE <='".$_SESSION['date2']."'    ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$profit=$y['SUM(C)']-$y['SUM(D)'];
	 echo"<tr class='btn-info btn-sm'>
	  
                <td  >TOTAL</td>
				 <td>".number_format($y['SUM(TOTAL)'],2)."</td>	
				 <td> </td>
				 
           </tr>";
   
		}}
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