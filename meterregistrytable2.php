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
<style>
    
    table {
    border-collapse: collapse;
    overflow-y: scroll; 
  }
  td, th {
    border: 1px solid black;
    padding: 8px; /* Adjust padding as needed */
    text-align:right;
  }
    
</style>
<h4   style="text-align:center"><strong>METERS  REGISTRY WHERE <?php print $searchmethod; ?>  IS LIKE  <?php print $searchvalue;?> </strong></h4>


<table class="table"  id="userstable">
	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody style="text-align:center;" >
             <tr>
              
		   <td  class="theader"  valign="top" >METER NUMBER</td>     
		    <td  class="theader"   height="28" valign="top" >SERIAL NUMBER</td>  
			<td  class="theader"  width='5%' height="28" valign="top" >SIZE</td> 			
			 <td  class="theader"  width='8%' height="28" valign="top" >STATUS</td>
			  <td  class="theader"  width='8%'  height="28" valign="top" >ACCOUNT</td>
		
			  <td  class="theader"  width='5%'   height="28" valign="top" >EDIT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			   <td  class="theader"  height="28" valign="top" >
			   <select class='form-control'   name='action' required="on"   id="selectaction" >
 <option value=''>SELECT ACTION</option>

			  
			  <option value='UNINSTALL'>DELINK METER</option>
			   <option value='STOLLEN'>STOLLEN</option>
			    <option value='MALFUNCTION'>MALFUNCTION</option>
				 <option value='FUNCTION'>FUNCTION</option>
				  <option value='DELETE'>DELETE</option>
			   
			   
			  </select>
			   </td>
			 
		 			  
          </tr>
        <?php
		 //if($searchmethod=='account'){$x="SELECT clientmetersreg.*,zones.ZONE FROM clientmetersreg,zones  WHERE ACCOUNT REGEXP '$searchvalue'  AND zones.number=clientmetersreg.zone   ";}
		 
		 if($searchmethod=='account'){$x="SELECT clientmetersreg.* FROM clientmetersreg WHERE ACCOUNT REGEXP '$searchvalue'  ";}
		else if($searchmethod=='meternumber'){$x="SELECT clientmetersreg.* FROM clientmetersreg  WHERE METERNUMBER REGEXP '$searchvalue'  ";}
		else if($searchmethod=='serial'){$x="SELECT clientmetersreg.* FROM clientmetersreg WHERE SERIALNUMBER REGEXP '$searchvalue'  ";}
		else if($searchmethod=='size'){$x="select clientmetersreg.*  from clientmetersreg  where  size = '$searchvalue'  ";}
		else if($searchmethod=='status'){$x="select clientmetersreg.*  from clientmetersreg  where  status = '$searchvalue'  ";}
		else if($searchmethod=='installed'){$x="select clientmetersreg.*  from clientmetersreg where ACCOUNT !='NOT INSTALLED'   ";}
		else if($searchmethod=='notinstalled'){$x="select clientmetersreg.*  from clientmetersreg where account='NOT INSTALLED'   ";}
		else if($searchmethod==null){$x="select clientmetersreg.*  from clientmetersreg    limit 50  ";}
		else if($searchmethod=='all'){$x="select clientmetersreg.*  from clientmetersreg        ";}
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 	   echo"<tr class='filterdata'>
		 
              <td>".$y['meternumber']."</td>  
			    <td    >".$y['serialnumber']."</td>
				 <td  width='5%' >".$y['size']."</td>
			   <td width='8%' >".$y['status']."</td>
			   <td  width='8%'>".$y['account']."</td>
			  
			      <td   width='5%' > " ; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                 <a   href="editmeterform.php?id=<?php print $y['id'];?>"  onclick="return confirm('EDIT ?')" >
EDIT
                       </a>
                       
                       <?php               
                         print "</td>  
				   <td><input name='del[]'  type='checkbox' value='".$y['id']."'   class='form-control input-sm'> </td>  
           </tr>";
		 }
		 
		 } 
		?>
	 <tr> </td>    <td    height="28" valign="top" ></td>     
		   <td    height="28" valign="top" ><button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button></td>     
		    <td      height="28"     valign="top" >
			
			<button type="reset" class="btn-info btn-sm">RESET</button></td>  
					
			 
				<td   width='8%'  height="28" valign="top" ><h4   style="text-align:center"> TOTAL</h4> </td>			  
			  <td    width='8%'  height="28" valign="top" ><h4   style="text-align:center"><?php   
		  if($searchmethod=='client'){$x="select count(clientmetersreg.id)  from clientmetersreg  where   client  REGXP '$searchvalue' "; }		
		else if($searchmethod=='account'){$x="select count(id)  FROM clientmetersreg  WHERE ACCOUNT REGEXP '$searchvalue' ";}
		else if($searchmethod=='meternumber'){$x="select count(id)  FROM clientmetersreg  WHERE METERNUMBER REGEXP '$searchvalue' ";}
		else if($searchmethod=='serial'){$x="select count(id)  FROM clientmetersreg  WHERE SERIALNUMBER REGEXP '$searchvalue' ";}
		else if($searchmethod=='size'){$x="select count(id)  from clientmetersreg  where  size = '$searchvalue' ";}
		else if($searchmethod=='status'){$x="select count(id)  from clientmetersreg  where  status = '$searchvalue' ";}
		else if($searchmethod=='installed'){$x="select count(id)  from clientmetersreg where account !='NOT INSTALLED'  ";}
		else if($searchmethod=='notinstalled'){$x="select count(id)  from clientmetersreg where account='NOT INSTALLED' ";}
		else if($searchmethod==null){$x="select count(id)  from clientmetersreg   limit 50  ";}
		else if($searchmethod=='all'){$x="select count(id)  from clientmetersreg    ";}
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  echo  $y['count(id)'];
		}}
			  
			  ?> </td>
			  
			 
		 			  
          </h4>
		  <td   width='5%'  height="28" valign="top" ></td> 
		   
		    <td    height="28" valign="top" ></td> 	
		  
		  </tr>
	
        </tbody>
    </table>
 <br>
</div>