 <?php 
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="LAB & IMAGING";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

if($_SESSION['patientnumber']=='')
{
	?>
	
<div id="procedurestable"  >
   <h3 style="text-align:center;text-decoration:underline;font-weight:bold;">CUMULATIVE  PROCEDURES REPORT </h3>
  <h3 style="text-align:center;text-decoration:underline;font-weight:bold;">REFF <?php print $_SESSION['date1']; ?>:<?php  print $_SESSION['date2']; ?></h3>
<table class="table"   style="text-align:center;font-size:90%;">
	

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
             <tr >
		  <td  class="theader"  width="2%" height="28" valign="top" style='text-align:center;' >NO.</td>
		  <td  class="theader"  width="5%" height="28" valign="top" style='text-align:center;' >PATIENT</td>
		   <td  class="theader"  height="28" valign="top" style='text-align:center;'  > DATE  </td>
			<td  class="theader" width='10%'   height="28" valign="top"  style='text-align:center;' >PROCEDURE</td>		  
		    <td  class="theader"    height="28" valign="top" style='text-align:center;'  >SUMMARY</td> 
			 <td  class="theader"  width='25%'  height="28" valign="top"  style='text-align:left;' >DETAILS</td>
			   <td  class="theader" width='25%'  height="28" valign="top" style='text-align:left;'  > CONCLUSION  </td>
			   <td  class="theader"  height="28" valign="top" style='text-align:center;'  >DEL  </td>
			   </tr>
 		
		
				<?php
$x=$connect->query("SELECT CONCLUSION,OBSERVATION,SUMMARY,PROCEDURES,PROCEDUREREPORTS.DATE,PROCEDUREREPORTS.ID,PATIENTNUMBER,CLIENT  FROM PROCEDUREREPORTS,PATIENTSRECORD WHERE   PROCEDUREREPORTS.DATE >='".$_SESSION['date1']."' AND PROCEDUREREPORTS.DATE <='".$_SESSION['date2']."' AND PROCEDUREREPORTS.PATIENTNUMBER=PATIENTSRECORD.ACCOUNT ORDER  BY  PROCEDUREREPORTS.DATE DESC ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
				<td  width="2%"  style='text-align:center;' ><?php print $number; ?> </td> 
<td  width="5%"  style='text-align:center;' ><?php print $data->PATIENTNUMBER; ?> </td>  				
			    <td    height="28" valign="top" style='text-align:center;'  ><?php print $data->DATE; ?></td>
				
			   <td   width='10%' style='text-align:center;'  ><?php print $data->PROCEDURES; ?></td>
				<td    style='text-align:center;'  ><?php print $data->SUMMARY; ?></td>
				<td  width='25%' style='text-align:left;'  ><?php print $data->OBSERVATION; ?></td>
				<td width='25%' style='text-align:left;'  ><?php print $data->CONCLUSION; ?></td>
							<td style='text-align:center;'  >
			 <a   href="deleteprocedures2.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE  ROCEDURE ?')" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
						
							
							</td>
	 </tr>
<?php }	
?>


	 
	 
 </tbody>
 </table>
 </div>
	
<?php 	
	
}

else {
	
	?>
<div id="procedurestable"  >
   <h3 style="text-align:center;text-decoration:underline;font-weight:bold;">CUMULATIVE  PROCEDURES REPORT </h3>
  <h3 style="text-align:center;text-decoration:underline;font-weight:bold;">REFF <?php print $_SESSION['patientnumber']; ?>:<?php 
  $x=$connect->query("SELECT CLIENT  FROM  PATIENTSRECORD WHERE ACCOUNT='".$_SESSION['patientnumber']."' ");
while ($data = $x->fetch_object())
{
print $data->CLIENT;	
}
 ?></h3>
<table class="table"   style="text-align:center;font-size:90%;">
	

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
             <tr >
		  <td  class="theader"  width="2%" height="28" valign="top" style='text-align:center;' >NO.</td>
		   <td  class="theader"  height="28" valign="top" style='text-align:center;'  > DATE  </td>
			<td  class="theader" width='10%'   height="28" valign="top"  style='text-align:center;' >PROCEDURE</td>		  
		    <td  class="theader"    height="28" valign="top" style='text-align:center;'  >SUMMARY</td> 
			 <td  class="theader"  width='25%'  height="28" valign="top"  style='text-align:left;' >DETAILS</td>
			   <td  class="theader" width='25%'  height="28" valign="top" style='text-align:left;'  > CONCLUSION  </td>
			   <td  class="theader"  height="28" valign="top" style='text-align:center;'  >DEL  </td>
			   </tr>
 		
		
				<?php
$x=$connect->query("SELECT CONCLUSION,OBSERVATION,SUMMARY,PROCEDURES,PROCEDUREREPORTS.DATE,PROCEDUREREPORTS.ID,PATIENTNUMBER,CLIENT  FROM PROCEDUREREPORTS,PATIENTSRECORD WHERE ACCOUNT=PATIENTNUMBER   AND PATIENTNUMBER='".$_SESSION['patientnumber']."' ORDER  BY  PROCEDUREREPORTS.DATE DESC ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
				<td  width="2%"  style='text-align:center;' ><?php print $number; ?> </td>  
			    <td    height="28" valign="top" style='text-align:center;'  ><?php print $data->DATE; ?></td>
				
			   <td   width='10%' style='text-align:center;'  ><?php print $data->PROCEDURES; ?></td>
				<td    style='text-align:center;'  ><?php print $data->SUMMARY; ?></td>
				<td  width='25%' style='text-align:left;'  ><?php print $data->OBSERVATION; ?></td>
				<td width='25%' style='text-align:left;'  ><?php print $data->CONCLUSION; ?></td>
							<td style='text-align:center;'  >
			 <a   href="deleteprocedures2.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE  ROCEDURE ?')" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
						
							
							</td>
	 </tr>
<?php }	
?>


	 
	 
 </tbody>
 </table>
 </div>
	
	<?php
}
?>
 
 