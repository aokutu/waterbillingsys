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
$meternumber1=$_SESSION['meternumber1'];
$meternumber2=$_SESSION['meternumber2'];
?>

<div  id="masterbills">
<img src="letterhead.png"    id="letterhead"  width="50%"  height="50%"  /> 
 <h4 style="text-align:center"><strong>MASTER METERS   FROM <?php print $date1; ?> TO  <?php print  $date2;?> METER NUMBER <?php print $meternumber1?> TO <?php print $meternumber2; ?> </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		 <td class="theader"   valign="top">METER NUMBER </td>		
            <td   class="theader"  height="21" valign="top" >CURRENT </td>
            <td  class="theader" valign="top">PREVIOUS</td>
			 <td  class="theader" valign="top">UNITS</td>
			  <td  class="theader" valign="top">DATE</td>
			<td class="theader"  valign="top">
			<input type="hidden" class="form-control input-sm"  value="DELETE2" style='text-transform:uppercase' readonly   name="action" id="action"  required  autocomplete ="off">		
			DELETE</td>
          </tr>
        </thead>
        <tbody>
        <?php
$x="SELECT METERNUMBER,CURRENT,PREVIOUS,UNITS,DATE,ID  FROM  $mastermeterbill    WHERE  DATE >='$date1'   AND  DATE <='$date2' AND  METERNUMBER >='$meternumber1' AND METERNUMBER <='$meternumber2' ORDER BY DATE,METERNUMBER  DESC  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {  
	 echo"<tr class='filterdata'>
             <td  >".$y['METERNUMBER']."</td>		  
           <td  >".$y['CURRENT']."</td>
		    <td  >".$y['PREVIOUS']."</td>
			 <td  >".$y['UNITS']."</td>
		    <td  >".$y['DATE']."</td>
			<td  ><input type='checkbox'   name ='id[]'  value='".$y['ID']."'   class='form-control input-sm'></td>  
				
           </tr>";
		 }
		 
		 } 


$x="SELECT COUNT(METERNUMBER),SUM(UNITS)   FROM  $mastermeterbill  WHERE  DATE >='$date1'   AND  DATE <='$date2' AND  METERNUMBER >='$meternumber1' AND METERNUMBER <='$meternumber2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {  
	 echo"<tr   class='btn-info btn-sm' >
             <td  >TOTAL</td>		  
		   <td >METERS  ".$y['COUNT(METERNUMBER)']."</td>
           <td  ></td>		   
			 <td  > ".$y['SUM(UNITS)']."</td>
			  <td  ></td>
		    <td  ></td>
				
           </tr>";
		 }
		 
		 } 
		 ?>
		 

  </tbody>
    </table>
<br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>
