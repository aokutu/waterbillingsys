<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
@$account1=$_SESSION['account1'];
@$account2=$_SESSION['account2'];

  if($zone ==""){$zone=0;}
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'ACCOUNTS REG'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>

<div  id="contacttable">
<img src="letterhead.png"    id="letterhead"  width="50%"  height="50%"  /> 
<h4   style="text-align:center"><strong>METER NUMBERS   FOR ACC <?php print $account1 ;?> TO <?php print $account2;?></strong></h4>

<table class="table"  id="userstable">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class="theader"  height="28" valign="top" >ACCOUNT</td>     
		    <td  class="theader"  height="28" valign="top" >NAME</td>     
			 <td  class="theader"  height="28" valign="top" >CURRENT METER </td>
			 	
			  <td  class="theader"  height="28" valign="top" >
			  NEW METER NUMBER </td>  
		 			  
          </tr>
        </thead>
        <tbody>
        <?php
$x="SELECT DISTINCT(account),client,meternumber FROM $accountstable  WHERE  account >='$account1'  AND  account <='$account2' AND ACCOUNT NOT IN (SELECT ACCOUNT  FROM $meterstable) ORDER BY account   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 		   echo"<tr class='filterdata'>
              <td>".$y['account']."</td>  
			    <td>".$y['client']."</td>
			   <td>".$y['meternumber']."</td>
			  
<td>
<a href='#' title='INFO' data-toggle='popover' data-trigger='hover' data-content='ENTER NEW CONTACT' data-placement='bottom'>
<input  name='account[".$y['account']."]'  type='text'  placeholder='NEW METER NUMBER  '  pattern='[A-Z0-9a-z-_]+'  style='text-transform:uppercase'   title ='INVALID CHARACTERS'      class='form-control input-sm'   autocomplete='off' ></a>
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