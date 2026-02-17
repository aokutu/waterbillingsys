<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'PRODUCTION BILLING'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$date1=$_SESSION['date1'];
$date2=$_SESSION['date2'];

?>

<div  id="productionmetertable">
<img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  /> 
 <h4   style="text-align:center"><strong>WATER PRODUCTION  FROM <?php print $date1; ?> TO  <?php print  $date2;?>  </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		 <td class="theader"   valign="top">REFFERENCE</td>		
		  <td  class="theader" valign="top">LOCATION</td>
            <td   class="theader"  height="21" valign="top" >CURRENT </td>
            <td  class="theader" valign="top">PREVIOUS</td>
			 <td  class="theader" valign="top">UNITS</td>
			 <td  class="theader" valign="top">CHLORINE (g)</td>
			  <td  class="theader" valign="top">DATE</td>
			<td class="theader"  valign="top">
			<input type="hidden" class="form-control input-sm"  value="DELETE2" style='text-transform:uppercase' readonly   name="action" id="action"  required  autocomplete ="off">		
			DELETE</td>
          </tr>
        </thead>
        <tbody>
        <?php
$x="SELECT *  FROM  waterproduction    WHERE  DATE >='$date1'   AND  DATE <='$date2' ORDER BY  REFFERENCENUMBER  ASC ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {  
	 echo"<tr class='filterdata'>
             <td  >".$y['refferencenumber']."</td>		  
		   <td >".$y['location']."</td>
           <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$y['current']."</td>
		    <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$y['previous']."</td>
			 <td  >&nbsp;&nbsp;&nbsp;".$y['units']."</td>
			  <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$y['chlorine']."</td>
		    <td  >".$y['date']."</td>
			<td  ><input type='checkbox'   name ='id[]'  value='".$y['id']."'   class='form-control input-sm'></td>  
				
           </tr>";
		 }
		 
		 } 


$x="SELECT count(refferencenumber),SUM(UNITS),SUM(CHLORINE)  FROM  waterproduction  WHERE  DATE >='$date1'   AND  DATE <='$date2'  ORDER BY  REFFERENCENUMBER  ASC ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {  
	 echo"<tr   class='btn-info btn-sm' >
             <td  >TOTAL</td>		  
		   <td >METERS  ".$y['count(refferencenumber)']."</td>
           <td  ></td>
		    <td  ></td>
			 <td  >&nbsp;&nbsp;&nbsp;".$y['SUM(UNITS)']."</td>
		    <td  >&nbsp;&nbsp;&nbsp;&nbsp;".$y['SUM(CHLORINE)']."</td><td  ></td>
			<td  >  </td>  
				
           </tr>";
		 }
		 
		 } 
		 ?>
		 

  </tbody>
    </table>
<br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>
