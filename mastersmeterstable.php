<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'PRODUCTION BILLING'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

 ?>
 

<div  id="mastermetertable">
<img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  /> 
 <h4 style="text-align:center"><strong>MASTERS  METERS  ZONE NUMBER <?php print $zone; ?> </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		 <td class="theader"   valign="top">METER NUMBER</td>
			<td class="theader"   valign="top">SERIAL NUMBER</td>		 
		  <td  class="theader" valign="top">LOCATION</td>
		   <td class="theader"   valign="top">LONGITUDES</td>
		    <td class="theader"   valign="top">LATTITUDE</td>
            <td   class="theader"  height="21" valign="top" >LAST READING </td>
			<td   class="theader"  height="21" valign="top" >DATE </td>
			<td class="theader"  valign="top">		
			<select class="form-control"   id="action" name="action" required="on">
 <option value="">SEARCH  ACTION</option>
 <option value="READING">NEW READINGS </option>
  <option value="EDIT">EDIT METER DETAILS </option>

 <option value="DELETE">DELETE</option>
 
 </select></td>
          </tr>
        </thead>
        <tbody>
        <?php
$x="SELECT METERNUMBER,SERIALNUMBER,LOCATION,LONGITUDE,LATTITUDE,READING,DATE,ID  FROM  $mastermeters   ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {  
	 echo"<tr class='filterdata'>
             <td  >".$y['METERNUMBER']."</td>
		   <td  >".$y['SERIALNUMBER']."</td>
		    <td  >".$y['LOCATION']."</td>
			 <td  >".$y['LONGITUDE']."</td>
		   <td >".$y['LATTITUDE']."</td>
		   <td  >".$y['READING']."</td>
           <td  >".$y['DATE']."</td>		    
			<td  ><input type='checkbox'   name ='meternumber[]'  value='".$y['METERNUMBER']."'   class='form-control input-sm'></td>  
				
           </tr>";
		 }
		 
		 }  ?>
		 

  </tbody>
    </table>
<br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>