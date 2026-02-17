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
if($searchvalue ==null){$searchvalue =" ";}
?>

<div  id="accountstable"  method="post" action="deleteaccount.php"> 
<h4   style="text-align:center"><strong>METERS  REGISTRY WHERE <?php print $searchmethod; ?>  IS LIKE  <?php print $searchvalue;?> </strong></h4>


<table class="table"  id="userstable">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
                <td  class="theader"  height="28" valign="top" >ACCOUNT</td>
		   <td  class="theader"  valign="top" >METER NUMBER</td>     
		    <td  class="theader"   style='text-align:left;' height="28" valign="top" >SERIAL NUMBER</td>  
			<td  class="theader"   style='text-align:center;margin-left;'  height="28" valign="top" >SIZE   </td> 			
			 <td  class="theader"  height="28" valign="top" >STATUS</td>
			
	
			 
		 			  
    </tr>
        </thead>
        <tbody>
        <?php
		 if($searchmethod=='account'){$x="SELECT * FROM clientmetersreg  WHERE ACCOUNT REGEXP '$searchvalue' AND ZONE ='$zone'  ";}
		else if($searchmethod=='meternumber'){$x="SELECT * FROM clientmetersreg  WHERE METERNUMBER REGEXP '$searchvalue' AND ZONE ='$zone'";}
		else if($searchmethod=='serial'){$x="SELECT * FROM clientmetersreg  WHERE SERIALNUMBER REGEXP '$searchvalue' AND ZONE ='$zone' ";}
		else if($searchmethod=='size'){$x="select *  from clientmetersreg  where  size = '$searchvalue' AND ZONE ='$zone' ";}
		else if($searchmethod=='status'){$x="select *  from clientmetersreg  where  status = '$searchvalue' AND ZONE ='$zone' ";}
		else if($searchmethod=='installed'){$x="select *  from clientmetersreg where exists (select account FROM $accountstable where    $accountstable.account=clientmetersreg.account) AND ZONE ='$zone' ";}
		else if($searchmethod=='notinstalled'){$x="select *  from clientmetersreg where not exists (select account FROM $accountstable where    $accountstable.account=clientmetersreg.account) AND ZONE ='$zone' ";}
		else if($searchmethod==null){$x="select *  from clientmetersreg  WHERE  ZONE ='$zone'  limit 50  ";}
		else if($searchmethod=='all'){$x="select *  from clientmetersreg WHERE  ZONE ='$zone'   ";}
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 		   echo"<tr class='filterdata'>
		  <td>".$y['account']."</td>
              <td>".$y['meternumber']."</td>  
			    <td    >".$y['serialnumber']."</td>
				 <td   style='text-align:center;' >  &nbsp;&nbsp;&nbsp; &nbsp;".$y['size']."</td>
			   <td>".$y['status']."</td>
			  
			  
           </tr>";
		 }
		 
		 } 
		?>
	 <tr>  <td    height="28" valign="top" ></td>     
		
		    <td    height="28"     valign="top" >
			<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button>
			<button type="reset" class="btn-info btn-sm">RESET</button></td>  
					
			 
				<td    height="28" valign="top" ><h4   style="text-align:center"> TOTAL</h4> </td>			  
			  <td    height="28" valign="top" ><h4   style="text-align:center"><?php   
		  if($searchmethod=='client'){$x="select count(clientmetersreg.id)  from clientmetersreg  where   client  REGXP '$searchvalue' AND ZONE ='$zone' "; }		
		else if($searchmethod=='account'){$x="select count(id)  FROM clientmetersreg  WHERE ACCOUNT REGEXP '$searchvalue'  AND ZONE ='$zone' ";}
		else if($searchmethod=='meternumber'){$x="select count(id)  FROM clientmetersreg  WHERE METERNUMBER REGEXP '$searchvalue'  AND ZONE ='$zone' ";}
		else if($searchmethod=='serial'){$x="select count(id)  FROM clientmetersreg  WHERE SERIALNUMBER REGEXP '$searchvalue'  AND ZONE ='$zone' ";}
		else if($searchmethod=='size'){$x="select count(id)  from clientmetersreg  where  size = '$searchvalue'  AND ZONE ='$zone' AND ZONE ='$zone'  ";}
		else if($searchmethod=='status'){$x="select count(id)  from clientmetersreg  where  status = '$searchvalue'  AND ZONE ='$zone'  ";}
		else if($searchmethod=='installed'){$x="select count(id)  from clientmetersreg where exists (select account FROM $accountstable where    $accountstable.account=clientmetersreg.account)  AND ZONE ='$zone' ";}
		else if($searchmethod=='notinstalled'){$x="select count(id)  from clientmetersreg where not exists (select account FROM $accountstable where    $accountstable.account=clientmetersreg.account)  AND ZONE ='$zone'  ";}
		else if($searchmethod==null){$x="select count(id)  from clientmetersreg  WHERE  ZONE ='$zone' limit 50  ";}
		else if($searchmethod=='all'){$x="select count(id)  from clientmetersreg   WHERE  ZONE ='$zone'   ";}
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  echo  $y['count(id)'];
		}}
			  
			  ?> </td>
			  
			 
		 			  
          </h4>
		  <td    height="28" valign="top" ></td> 	
		  
		  </tr>
	
        </tbody>
    </table>
 <br>
</div>