<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$searchvalue=$_SESSION['searchvalue'];$searchmethod=$_SESSION['searchmethod'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'POST SMS-EMAILS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>

<div  id="accountstable"  method="post" action="deleteaccount.php"> <br>
 <div class="container">
  <div class="row">
  <div class="col-sm-6" ><textarea  name="message" required  class='form-control' rows="3"   placeholder="TYPE THE  MESSAGE HERE "></textarea>
  <br><select class="form-control" name="mode" required="on">
 <option value="">SELECT CONTACT TYPE </option>
 <option value="EMAIL">EMAIL </option>
 <option value="CELL">MOBILE PHONE </option>
  </select>
  </div>
 <div class="col-sm-6" ><h4   style="text-align:center"><strong>SELECT THE ACCOUNTS TO SEND THE  MESSAGE </strong></h4><button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button>
			<button type="reset" class="btn-info btn-sm">RESET</button></div>
  </div></div>

  
  
<br>


<table class="table"  id="userstable">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class="theader"  height="28" valign="top" >ACCOUNT</td>     
		    <td  class="theader"  width="20%"  height="28" valign="top" >NAME</td>  
			<td  class="theader" width="20%" height="28" valign="top" >EMAIL</td> 			
			 <td  class="theader"  height="28" valign="top" >CELL</td>
			  <td  class="theader"  height="28" valign="top" >METER </td>	
			  <td  class="theader"  height="28" valign="top" >STATUS </td>
			   <td  class="theader"  height="28" valign="top" >CLASS</td>
			  <td  class="theader"  height="28" valign="top" >SIZE</td>
			   <td  class="theader"  height="28" valign="top" >LOCATION</td>
			   <td  class="theader"  height="28" valign="top" >SELECT
			   </td>
			 
		 			  
          </tr>
        </thead>
        <tbody>
        <?php
if($searchmethod=='client'){$x="select *  FROM  $accountstable  where   client  like '$searchvalue%' "; }		
		else if($searchmethod=='account'){$x="select *  FROM  $accountstable  where   account  like '$searchvalue%' ";}
		else if($searchmethod=='meternumber'){$x="select *  FROM  $accountstable  where  meternumber  like '$searchvalue%' ";}
		else if($searchmethod=='status'){$x="select *  FROM  $accountstable  where  status  like '$searchvalue%' ";}
		else if($searchmethod=='email'){$x="select *  FROM  $accountstable  where  clientemail  like '$searchvalue%' ";}
		else if($searchmethod=='size'){$x="select *  FROM  $accountstable  where  size like '$searchvalue%' ";}
		else if($searchmethod=='contact'){$x="select *  FROM  $accountstable  where  contact like '$searchvalue%' ";}
		else if($searchmethod=='class'){$x="select *  FROM  $accountstable  where  class like '$searchvalue%' ";}
		else if($searchmethod=='location'){$x="select *  FROM  $accountstable  where  location like '$searchvalue%' ";}
		else if($searchmethod=='avg'){$x="select *  FROM  $accountstable  where  avg = 'AVG' ";}
		else if($searchmethod=='nonrespondant'){$x="select  $accountstable.* FROM $accountstable,$billstable  where    $accountstable.account=$billstable.account and $accountstable.date2=$billstable.date and $accountstable.email=$billstable.current  and $billstable.current=$billstable.previous ";}
		else if($searchmethod=='unregisteredmeter'){$x="select * FROM $accountstable  where not exists (select account FROM   $meterstable where    $accountstable.account=meters.account) ";}
		else if($searchmethod==null){$x="select *  FROM  $accountstable   limit 50  ";}
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 		   echo"<tr class='filterdata'>
              <td>".$y['account']."</td>  
			    <td   width='20%' >".$y['client']."</td>
				 <td  width='20%' >".$y['clientemail']."</td>
			   <td>".$y['contact']."</td>
			   <td>".$y['meternumber']."</td>
				  <td>".$y['status']."</td>
				  <td>".$y['class']."</td>
				   <td>".$y['size']."</td>
				   <td>".$y['location']."</td>
				   <td><input name='contacts[]' type='checkbox' value='".$y['id']."'   class='form-control input-sm'> </td>  
           </tr>";
		 }
		 
		 } 
		?>
	 
        </tbody>
    </table>
 <br>
 
</div>