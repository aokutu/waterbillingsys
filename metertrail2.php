<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'VIEW REPORTS'  OR   name='$user' AND password='$password'    AND  ACCESS  REGEXP  'METER REG'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$meternumber=$_SESSION['meternumber']; $date1=$_SESSION['date1']; $date2=$_SESSION['date2'];
if (($meternumber ==null)  || ($meternumber=="") ){$meternumber ='-/-';}
 ?>
<div  id="ministatement">
<h4   style="text-align:center"><strong>METER TRAIL REPORT  METER NUMBER  <?php  print $meternumber; ?>  FROM  <?php print $date1;?>  TO   <?php print $date2;?></strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
	<td  class="theader"  width="20%" height="28"   valign="top" >ACTIVITY</td> 	
	<td  class="theader"  height="28" valign="top" >ACCOUNT </td>     
	
<td  class="theader"  height="28" valign="top" >DATE</td>

          </tr>
        </thead>
        <tbody>
        <?php
$x="SELECT * FROM metertrail WHERE METERNUMBER ='$meternumber' AND DATE >='$date1'  AND DATE <='$date2' ORDER BY  ID DESC ";
	
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 	  print  "<tr class='filterdata'>
	   <td width='20%' >".$y['activity']."</td>
			         <td  >".$y['account']."</td>  
			  
				  <td>".$y['date']."</td>
				</tr>";
			 
      
		 }
		 
		 }   
		 
	?> 
		 	
        </tbody>
    </table>
<br />

</div>