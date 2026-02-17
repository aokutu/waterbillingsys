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
<h4><strong>CLIENT QUOTATION # <?php print $_SESSION['serialnumber']; ?> </strong></h4>

 <table    class=" table table-hover"  style="font-size:75%;">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		    <td  class="theader"   height="21" valign="top" >NO.</td>
		  <td  class="theader"   height="21" valign="top" >DATE</td>
		   <td  class="theader"   width="20%" height="21" valign="top" >ITEM </td>
			 <td  class="theader"    height="21" valign="top" >UNITS </td>
		  <td  class="theader"   height="21" valign="top" >QNTY</td>
		  
           
		  <td  class="theader"   height="21" valign="top" >PRICE </td>
		   <td  class="theader"   height="21" valign="top" >AMOUNT</td>
		     <td  class="theader"   height="21" valign="top" >ACCOUNT</td>
			  <td  class="theader"  width="15%"   height="21" valign="top" >NAMES</td>
			   <td  class="theader"   height="21" valign="top" >CONTACT</td>
			   <td  class="theader"   height="21" valign="top" > DELETE</td>
			
			 
		 
			   
          </tr>
        </thead>
        <tbody>
       <?php
		
		$number=0;
	$x="SELECT SERIALNUMBER,ITEM,QUANTITY,PRICE,AMOUNT,ACCOUNT,NAMES,CONTACT,STATUS,DATE,ID FROM CLIENTQUOTATIONS WHERE  SERIALNUMBER='".$_SESSION['serialnumber']."' ORDER BY DATE   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
			 $number +=1;
		   echo"<tr class='filterdata'>
		    <td>".$number."</td>
		    <td>".$y['DATE']."</td>
                <td width='20%'>".$y['ITEM']."</td>
				<td>".$y['UNITS']."</td>
				<td>".$y['QUANTITY']."</td>			
				  <td>".number_format($y['PRICE'],2)."</td>
            <td>".number_format($y['AMOUNT'],2)."</td> <td>".$y['ACCOUNT']."</td> <td  width='15%'>".$y['NAMES']."</td>
			<td>".$y['CONTACT']."</td>
         		 <td id='deletebutton' ><button name='id2[]' type='submit'   value='".$y['ID']."' class='btn-info btn-sm'>DEL</button></td>
				 
		
           </tr>";
		 }
	
		 
		 
		 }
		 
		 
		 	$x="SELECT SUM(AMOUNT) FROM CLIENTQUOTATIONS WHERE  SERIALNUMBER='".$_SESSION['serialnumber']."'    ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
			
		   echo"<tr class='filterdata' >
		    <td></td>
		    <td></td>
                <td width='20%'>TOTAL </td>
				<td></td>
				<td></td>			
				  <td></td>
            <td>".number_format($y['SUM(AMOUNT)'],2)."</td> <td></td> <td  width='15%'></td>
			<td></td>
         		<td></td>
		
           </tr>";
		 }
	
		 
		 
		 }
	?>
        </tbody>
		
      </table>
	  <br />
</div>