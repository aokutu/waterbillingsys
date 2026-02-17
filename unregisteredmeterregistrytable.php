<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$searchvalue=$_SESSION['searchvalue'];$searchmethod=$_SESSION['searchmethod'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'METER REG'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>

<div  id="accountstable"  method="post" action="deleteaccount.php"> 

<h4   style="text-align:center"><strong>ZONE <?php print $zone; ?> UNREGISTERED  METERS REPORT  </strong></h4>


<table class="table"  id="userstable">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		    <td  class="theader"  height="28" valign="top" >ACCOUNT</td>
		   <td  class="theader"  valign="top" >METER NUMBER</td>     
			<td  class="theader"  height="28" valign="top" >AC STATUS</td> 			
			<td  class="theader"  height="28" valign="top" >ZONE</td> 		
		 <td  class="theader"  height="28" valign="top" >RESET </td> 
          </tr>
        </thead>
        <tbody>
        <?php
$x="SELECT * FROM $accountstable  WHERE $accountstable.account NOT IN(SELECT ACCOUNT FROM $meterstable ) AND   $accountstable.meternumber  NOT REGEXP 'NOT INSTALLED' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 		   echo"<tr class='filterdata'>
	    <td>".$y['account']."</td>
              <td>".$y['meternumber']."</td>  
				 <td>".$y['status']."</td>
			 <td>ZONE".$zone."</td>
			 <td><input name='id[]' type='checkbox' value='".$y['id']."'   class='form-control input-sm'> </td> 
           </tr>";
		 }
		 
		 }

		?>
	 <tr  >    
						
			 
				<td    height="28" valign="top" ><h4   style="text-align:center"> TOTAL</h4> </td>			  
			  <td    height="28" valign="top" ><h4   style="text-align:center"><?php   
		$x="SELECT COUNT(ID) FROM $accountstable  WHERE $accountstable.account NOT IN(SELECT ACCOUNT FROM $meterstable ) AND   $accountstable.meternumber  NOT REGEXP 'NOT INSTALLED'  ";

	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  echo  $y['COUNT(ID)'];
		}}
			  
			  ?> </td>
			<td    height="28" valign="top" ><button type="submit" class="btn-info btn-sm" >SUBMIT</button></td>     
			 <td    height="28" valign="top" ><button type="reset" class="btn-info btn-sm">RESET</button></td> 
		 		<td    height="28" valign="top" ></td>    	  
          </h4>
		  
		  </tr>
	
        </tbody>
    </table>
 <br>
</div>