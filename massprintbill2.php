<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$searchvalue=$_SESSION['searchvalue'];$searchmethod=$_SESSION['searchmethod'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'BILLING' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;} 

if($searchvalue ==null){$searchvalue =" ";}
?>

<div  id="accountstable"  method="post" action="deleteaccount.php"> 

<h4   style="text-align:center"><strong>ACCOUNTS  REGISTRY WHERE <?php print $searchmethod; ?>  IS LIKE  <?php print $searchvalue;?> </strong></h4>

  

	

<table class="table"  id="userstable">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class="theader"  height="28" valign="top" >ACCOUNT</td>     
		    <td  class="theader"  width="20%"  height="28" valign="top" >NAME</td>  
			  <td  class="theader"  height="28" valign="top" >METER </td>	
			  <td  class="theader"  height="28" valign="top" >STATUS </td>
			   <td  class="theader"  height="28" valign="top" >LOCATION</td>
			   <td  class="theader"  height="28" valign="top" >PLOT No.</td>
			   <td  class="theader"  height="28" valign="top" >SELECT
			   </td>
			 
		 			  
          </tr>
        </thead>
        <tbody>
        <?php
	$x="select *  FROM  $accountstable   WHERE STATUS ='CONNECTED'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 		   echo"<tr class='filterdata'>
              <td>".$y['account']."</td>  
			    <td   width='20%' >".$y['client']."</td>
			   <td>".$y['meternumber']."</td>
				  <td>".$y['status']."</td>
				   <td>".$y['location']."</td>
				    <td>".$y['plotnumber']."</td>
				   <td><input name='printbill[]' type='checkbox' value='".$y['account']."'   class='form-control input-sm'> </td>  
           </tr>";
		 }
		 
		 } 
		 
		?>
	 <tr>
		   <td    height="28" valign="top" ></td>     
		    <td    height="28"  width="30%"   valign="top" >
			<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button>
			<button type="reset" class="btn-info btn-sm">RESET</button></td>  
			  <td    height="28" valign="top" > </td>
				<td    height="28" valign="top" ><h4   style="text-align:center"> TOTAL</h4> </td>			  
			  <td    height="28" valign="top" ><h4   style="text-align:center"><?php 
				if($searchmethod==null){$x="select count(account)  FROM  $accountstable   limit 50  ";}
		else if($searchmethod=='client'){$x="select count(account)  FROM  $accountstable  where   client  REGEXP '$searchvalue' "; }		
		else if($searchmethod=='account'){$x="select count(account)  FROM  $accountstable  where   account  REGEXP '$searchvalue' ";}
		else if($searchmethod=='meternumber'){$x="select count(account)  FROM  $accountstable  where  meternumber  REGEXP '$searchvalue' ";}
		else if($searchmethod=='status'){$x="select count(account) FROM  $accountstable  where  status  REGEXP '$searchvalue' ";}
		else if($searchmethod=='idnumber'){$x="select count(account)  FROM  $accountstable  where  idnumber  REGEXP '$searchvalue' ";}
		else if($searchmethod=='size'){$x="select count(account)  FROM  $accountstable  where  size = '$searchvalue' ";}
		else if($searchmethod=='contact'){$x="select count(account)  FROM  $accountstable  where  contact REGEXP '$searchvalue' ";}
		else if($searchmethod=='email'){$x="select count(account)  FROM  $accountstable  where  clientemail REGEXP '$searchvalue' ";}
		else if($searchmethod=='class'){$x="select count(account)  FROM  $accountstable  where  class REGEXP '$searchvalue' ";}
		else if($searchmethod=='location'){$x="select count(account)  FROM  $accountstable  where  location REGEXP '$searchvalue' ";}
		else if($searchmethod=='avg'){$x="select count(account)  FROM  $accountstable  where  avg = 'AVG' ";}
		else if($searchmethod=='stalled'){$x="select count(account)   FROM $accountstable  where    avg='AVG'  ";}
		else if($searchmethod==null){$x="select count(account)  FROM  $accountstable   limit 50  ";}
		else if($searchmethod=='unregisteredmeter'){$x="select count(account) FROM $accountstable  where not exists (select account FROM   $meterstable where    $accountstable.account=$meterstable.account) ";}
			else if($searchmethod=='double'){$x="SELECT NULL   "; }		

	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=mysqli_fetch_array($x))
		{  echo  $y['count(account)'];
	///$y['count(id)'];
	}}
			  
			  ?> </td>
			   <td    height="28" valign="top" > </td>
			  <td    height="28" valign="top" ></td>
			   <td    height="28" valign="top" ></td>
			 
		 			  
          </h4></tr>
	
        </tbody>
    </table>
 <br>
</div>