<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>

<div id="pendingrequisition">
<script>
 $("#deletebutton > button").click(function() {
    var deleteitem = $(this).val();
		 var deleted=confirm("DELETE ITEM ?");   
	 if(deleted ==false){return false; }
	 $.post( "deleteclientquotation.php",
$("#pendingrequisition").serialize(),
function(data){$("#pendingrequisition").load("pendingquotations.php");
});  return true;

   return true;
   
   
});
</script>
<h4><strong>CLIENT QUOTATIONS FROM <?php print $_SESSION['date1']; ?> TO <?php print $_SESSION['date2']; ?> </strong></h4>

 <table    class=" table table-hover"  style="font-size:75%;">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		    <td  class="theader"   height="21" valign="top" >NO.</td>
		  <td  class="theader"   height="21" valign="top" >DATE</td>
		   <td  class="theader"   height="21" valign="top" >SERIAL #</td>
		   <td  class="theader"   width="20%" height="21" valign="top" >ITEM </td>
			 <td  class="theader"    height="21" valign="top" >UNITS </td>
		  <td  class="theader"   height="21" valign="top" >QNTY</td>
		  
           
		  <td  class="theader"   height="21" valign="top" >PRICE </td>
		   <td  class="theader"   height="21" valign="top" >AMOUNT</td>
		     <td  class="theader"   height="21" valign="top" >ACCOUNT</td>
			  <td  class="theader"  width="15%"   height="21" valign="top" >NAMES</td>
			   <td  class="theader"   height="21" valign="top" >CONTACT</td>
			    <td  class="theader"   width="10%"  height="21" valign="top" >PREPARER</td>
			
			 <td  class="theader"   height="21" valign="top" >
			  DELETE
			 
			 </td>
		 
			   
          </tr>
        </thead>
        <tbody>
       <?php
		
		$number=0;
	$x="SELECT PREPARER,SERIALNUMBER,ITEM,QUANTITY,PRICE,AMOUNT,ACCOUNT,NAMES,CONTACT,STATUS,DATE,ID FROM CLIENTQUOTATIONS WHERE DATE >='".$_SESSION['date1']."' AND DATE <='".$_SESSION['date2']."' ORDER BY DATE  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
			 $number +=1;
		   echo"<tr class='filterdata'>
		    <td>".$number."</td>
		    <td>".$y['DATE']."</td>
			<td>".$y['SERIALNUMBER']."</td>
                <td width='20%'>".$y['ITEM']."</td>
				<td>".$y['UNITS']."</td>
				<td>".$y['QUANTITY']."</td>			
				  <td>".number_format($y['PRICE'],2)."</td>
            <td>".number_format($y['AMOUNT'],2)."</td> <td>".$y['ACCOUNT']."</td> <td  width='15%'>".$y['NAMES']."</td>
			<td>".$y['CONTACT']."</td><td  width='10%'>".$y['PREPARER']."</td>
         		
         		 <td id='deletebutton' ><button name='id2[]' type='submit'   value='".$y['ID']."' class='btn-info btn-sm'>DEL</button></td>
		
           </tr>";
		 }
	
		 
		 
		 }
		 
		 
		 	$x="SELECT SUM(AMOUNT) FROM CLIENTQUOTATIONS WHERE DATE >='".$_SESSION['date1']."' AND DATE <='".$_SESSION['date2']."' ORDER BY DATE    ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
			
		   echo"<tr class='filterdata' >
		    <td></td>
		    <td></td>
			 <td></td>
                <td width='20%'>TOTAL </td>
				<td></td>
				<td></td>			
				  <td></td>
            <td>".number_format($y['SUM(AMOUNT)'],2)."</td> <td></td> <td  width='15%'></td>
			<td></td>
         		
			  <td  width='10%' ></td>  <td ></td>			
		
           </tr>";
		 }
	
		 
		 
		 }
	?>
        </tbody>
		
      </table>
	  <br />
</div>