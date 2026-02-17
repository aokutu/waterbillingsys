 <?php 
 @session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'PRODUCTION METER'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

 ?>
 

<div  id="productionmetertable">
<img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  /> 
 <h4   style="text-align:center"><strong>PRODUCTION METERS   </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		 <td class="theader"   valign="top">REFFERENCE</td>		
		  <td  class="theader" valign="top">LOCATION</td>
            <td   class="theader"  height="21" valign="top" >LAST READING </td>
            <td  class="theader" valign="top">LAST READING DATE</td>
			<td class="theader"  valign="top">		
			</td>
          </tr>
        </thead>
        <tbody>
        <?php
$x="SELECT *  FROM  productionmeters ORDER BY  REFFERENCENUMBER  ASC ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {  
	 echo"<tr class='filterdata'>
             <td  >".$y['refferencenumber']."</td>
		  
		   <td >".$y['location']."</td>
           <td  >".$y['reading']."</td>
		    <td  >".$y['date']."</td>
		     <td >" ?> <a   href="productionmeterdetails.php?id=<?php print $y['id'];?>" >
 <button type="button" >READINGS</button> 
                       </a><a   href="deleteproductionmeters.php?id=<?php print $y['id'];?>" >
 <button type="button" >DEL</button> 
                       </a> <?php 
 print " </td> 
				
           </tr>";
		 }
		 
		 }  ?>
		 

  </tbody>
    </table>
<br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>