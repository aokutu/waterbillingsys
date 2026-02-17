<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$account1=$_SESSION['account1'];$account2=$_SESSION['account2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'EDIT CONTACTS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ include_once("accessdenied.php");exit;}
?>

<div  id="contacttable"> 

<h4   style="text-align:center"><strong>CONTACTS   FOR ACC <?php print $account1 ;?> TO <?php print $account2;?></strong></h4>
<select class="form-control" name="newcontact" required="on">
 <option value="">SELECT CONTACT TYPE </option>
 <option value="EMAIL">EMAIL </option>
 <option value="CELL">MOBILE PHONE </option>
  </select>
<table class="table"  id="userstable">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class="theader"  height="28" valign="top" >ACCOUNT</td>     
		    <td  class="theader"  height="28" valign="top" >NAME</td>     
			 <td  class="theader"  height="28" valign="top" >CELL </td>
			 <td  class="theader"  height="28" valign="top" >EMAIL </td>	
			  <td  class="theader"  height="28" valign="top" >
			  NEW CONTACT </td>  
		 			  
          </tr>
        </thead>
        <tbody>
        <?php
$x="SELECT DISTINCT(account),client,contact,clientemail FROM $accountstable  WHERE  account  >='$account1' AND  account <='$account2'  ORDER BY account   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 		   echo"<tr class='filterdata'>
              <td>".$y['account']."</td>  
			    <td>".$y['client']."</td>
			   <td>".$y['contact']."</td>
			   <td>".$y['clientemail']."</td>
<td>
<a href='#' title='INFO' data-toggle='popover' data-trigger='hover' data-content='ENTER NEW CONTACT' data-placement='bottom'>
<input  name='phone[".$y['account']."]'  pattern='[0-9A-Za-z@_- ]+'  title='INVALID CONTACT ' type='text'  placeholder='NEW CONTACT  '    class='form-control input-sm'   autocomplete='off' ></a>
</td> 
				
           </tr>";
		 }
		 
		 } 
		?>
	
	
        </tbody>
    </table>
 <br><br>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
	  <button class="btn-info btn-sm" onclick="window.print()">PRINT</button></div>