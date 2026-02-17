<?php
@session_start();
include_once("password2.php");
include_once("interface.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="CONSULTATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'NURSE'");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>HADDASSAH SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style type="text/css">
    @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;} #searchtext{display:none;}}
#levelchart{ width:80%;}
#newuser{ width:98%; margin-right:1%;margin-left:1%; border-radius:3%;}
#message{ width:50%;border-radius:3%; margin-right:20%; margin-left:20%}
#results{ font-size:90%;}
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;      
   position: absolute;
}
  </style>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover();
  var $rows = $('.filterdata');
$('#searchtext').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});
 })
  
  </script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body   onLoad="noBack();"    oncontextmenu="return false;"  >
  <h4  style="text-align:center;text-decoration:underline;font-weight:bold;" >CONSULTATION REGISTRY</h4>
 	  <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
 
  <form id="processbill" method="post" action="processbill.php">
   <div id="billtable" >
 
  
   
  <table style="font-size:75%;"  class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
		
		 <tr>
		   <td  class="theader"  width="5%" height="21" valign="top" >NO </td>
		   <td  class="theader"   height="21" valign="top" >PATIENT # </td>
            <td  class="theader" width="20%"   height="21" valign="top" >NAME	  </td>
			<td  class="theader"   height="21" valign="top" >DATE 	  </td>
			<td  class="theader"  height="21" valign="top" >BOOKED TIME  </td>
			<td  class="theader"  height="21" valign="top" >CHECK IN  </td>
			<td  class="theader"  height="21" valign="top" >DEPARTMENT</td>
	  
		   <td  class="theader" width="20%"  height="21" valign="top" >ACTION </td>			   
          </tr>
		  
	
       <?php
$number=0;
$x=$connect->query("SELECT consultation.URGENCY,consultation.ID,consultation.PATIENTNUMBER,CLIENT,BOOKEDIN,CHECKIN,CHECKOUT,DATE FROM consultation,patientsrecord WHERE consultation.PATIENTNUMBER=patientsrecord.ACCOUNT  ");
while ($data = $x->fetch_object())
{
$number +=1;
	?> <tr  class='filterdata' >
		   <td    width="5%" height="21" valign="top" ><?php print $number; ?> </td>
		   <td     height="21" valign="top" ><?php print $data->PATIENTNUMBER; ?>  </td>
            <td   width="20%"   height="21" valign="top" ><?php print $data->CLIENT;  ?>  </td>
			<td     height="21" valign="top" ><?php print $data->DATE; ?>	  </td>
			<td    height="21" valign="top" ><?php print $data->BOOKEDIN; ?>  </td>
			<td    height="21" valign="top" ><?php print $data->CHECKIN; ?>  </td>
		  <td    height="21" valign="top" ><?php 
		if($data->URGENCY=='PRIORITY')
		{print '<div style="color:red;font-weight:bold;" >PRIORITY</div>';}
else {print '<div >'.$data->URGENCY.'</div>';} 
			?> </td>
		   <td   width="20%"  height="21" valign="top" >
		    <a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="TRAIGE" data-placement="bottom"  href="vitalssession.php?patientnumber=<?php print $data->PATIENTNUMBER ;?>"  >
			 <div   class="fa-solid fa-temperature-three-quarters" style="font-size:260%;"> </div>
				 </a>&nbsp;&nbsp;&nbsp;
			
		   		 <a  title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="CHECK UP" data-placement="bottom" href="setpatientsession.php?patientnumber=<?php print $data->PATIENTNUMBER ;?>"  >
				 <div class="fas fa-user-md" style="font-size:260%;"> </div>
				 </a>&nbsp;&nbsp;&nbsp;
				  <a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="CHARGE SERVICES PATIENT" data-placement="bottom" onclick="return confirm('CHARGE SERVICE(S)  ?')" href="chargeproceduresession.php?patientnumber=<?php print $data->PATIENTNUMBER ;?>"  >
				 <div class="fas fa-file-invoice-dollar" style="font-size:260%;"> </div>
				 </a>&nbsp;&nbsp;&nbsp;
				 <a  title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="IMMUNIZATION" data-placement="bottom" href="deleteconsultation.php?id=<?php print $data->ID; ?>"  onclick="return confirm('IMMUNIZATION  ?')" > 
<div class="fa-solid fa-syringe" aria-hidden="true"  style="font-size:260%;"> </div> &nbsp;
</a>&nbsp;&nbsp;&nbsp;
<a title="CLEAR " data-toggle="popover" data-trigger="hover" data-content="<?php print $data->CLIENT;?>" data-placement="bottom"  href="deleteconsultation.php?id=<?php print $data->ID; ?>"  onclick="return confirm('CLEAR PATIENT  ?')" > 
<div class="fas fa-check" aria-hidden="true"  style="font-size:260%;"> </div> &nbsp;
</a>


				 </td>			   
          </tr>

<?php }	


$x=$connect->query(" SELECT CLIENT,CONCAT('INPATIENT') AS URGENCY,inpatientsrecord.ID,inpatientsrecord.PATIENTNUMBER,WARD,BEDNUMBER,ADMISSIONDATE AS BOOKEDIN,
ADMISSIONDATE AS CHECKIN,ADMISSIONDATE AS CHECKOUT,ADMISSIONDATE AS DATE  
FROM inpatientsrecord,patientsrecord WHERE inpatientsrecord.PATIENTNUMBER=patientsrecord.ACCOUNT AND
 inpatientsrecord.PATIENTNUMBER NOT IN(SELECT PATIENTNUMBER FROM consultation);  ");
while ($data = $x->fetch_object())
{
$number +=1;
	?> <tr  class='filterdata'>
		   <td    width="5%" height="21" valign="top" ><?php print $number; ?> </td>
		   <td     height="21" valign="top" ><?php print $data->PATIENTNUMBER; ?>  </td>
            <td   width="20%"   height="21" valign="top" ><?php print $data->CLIENT;  ?>  </td>
			<td     height="21" valign="top" ><?php print $data->DATE; ?>	  </td>
			<td    height="21" valign="top" ><?php print $data->BOOKEDIN; ?>  </td>
			<td    height="21" valign="top" ><?php print $data->CHECKIN; ?>  </td>
		  <td    height="21" valign="top" ><?php 
		if($data->URGENCY=='PRIORITY')
		{print '<div style="color:red;font-weight:bold;" >PRIORITY</div>';}
else {print '<div >'.$data->URGENCY.'</div>';} 
			?> </td>
		   <td   width="20%"  height="21" valign="top" >
		    <a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="TRAIGE" data-placement="bottom"  href="vitalssession.php?patientnumber=<?php print $data->PATIENTNUMBER ;?>"  >
			 <div   class="fa-solid fa-temperature-three-quarters" style="font-size:260%;"> </div>
				 </a>&nbsp;&nbsp;&nbsp;
			
		   		 <a  title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="CHECK UP" data-placement="bottom" href="setpatientsession.php?patientnumber=<?php print $data->PATIENTNUMBER ;?>"  >
				 <div class="fas fa-user-md" style="font-size:260%;"> </div>
				 </a>&nbsp;&nbsp;&nbsp;
				  <a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="CHARGE SERVICES PATIENT" data-placement="bottom" onclick="return confirm('CHARGE SERVICE(S)  ?')" href="chargeproceduresession.php?patientnumber=<?php print $data->PATIENTNUMBER ;?>"  >
				 <div class="fas fa-file-invoice-dollar" style="font-size:260%;"> </div>
				 </a>&nbsp;&nbsp;&nbsp;
				 <a  title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="IMMUNIZATION" data-placement="bottom" href="deleteconsultation.php?id=<?php print $data->ID; ?>"  onclick="return confirm('IMMUNIZATION  ?')" > 
<div class="fa-solid fa-syringe" aria-hidden="true"  style="font-size:260%;"> </div> &nbsp;
</a>&nbsp;&nbsp;&nbsp;
</td>			   
          </tr>

<?php }
?>



	
        </tbody>
		
      </table>
	
  <style>
    label {
      display: inline-block;
      margin-right: 20px;
    }
  </style>
  

</div>
 </form>
  

<div class="modal fade" id="prepostmessage" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="prepostcontent"> <img src ='giphy.gif'><h2></div></div></div>
  </div>
  <div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="content"> </div></div></div>
  </div>
</body>
</html>
