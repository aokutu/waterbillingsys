<?php 
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="NURSE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class patient
{
public  $patientnumber=null;

}
$patient=new patient;
$patient->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['getpatientnumber']))));
?>
 
 
  
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>MEDI CLOUD</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
 <script src='pluggins/jquery.autosize.js'></script>
 <script src='pluggins/jquery.autosize.js'></script>
  <script type="text/javascript" >
  $(document).ready(function(){
$(function(){$('textarea').autosize();});
  });
</script>
 
  	<style>
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
 #mainbilling{ border-style:solid;border-radius:2%; width:80%; margin-left:2%; margin-right:2%;}
#searchaccounth{ border-style:solid;border-radius:2%; width:80%; margin-left:2%; margin-right:0%;}    .dropdown-menu{ overflow-y: scroll; height: 300%;        
   position: absolute;
}
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;      
   position: absolute;
}

	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	
#idnumber-list
{
	 overflow-y: scroll;      
  height: 90%;            
  width: 100%;
  position: absolute;
}
@media print {
  a[href]:after {
    content: none !important;
  }
}

@media print {
    /* Hide the last column in the printed version */
    table th:last-child,
    table td:last-child {
        display: none;
    }
}
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){   
$("#newvitals").modal();
$('[data-toggle="popover"]').popover(); 
//$("#registrytable").load("registry.php #accountstable");	
$("#newvitals").submit(function(){
$('#prepostmessage').modal('show');
$.post( "newvitals.php",
$("#newvitals").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$('#prepostmessage').modal('hide');
$("#patients").load("vitals.php #patientstable");
return false;
});
return false;
})

  })
  </script>
    <script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "nometersautocomplete.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>

  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#newvitals"><i class="fa-solid fa-thermometer" style="font-size:200%;" ></i>VITALS</button></a>
    <button class="btn-info btn-sm" onclick="window.print()"> <i style="font-size:200%;" class="fas fa-print"></i>PRINT</button>
     <br>
	 <div style="text-align:center;"><img src="letterhead.png"    id="letterhead"   width="50%"  height="10%"   /></div>

<h3 style=" text-align:center;font-decoration:underline;">VITAL PATIENT RECORDS<br><?php
$x=$connect->query("SELECT ACCOUNT,CLIENT,TIMESTAMPDIFF(YEAR, BIRTHDATE, CURDATE()) AS YRS,TIMESTAMPDIFF(MONTH,BIRTHDATE, CURDATE()) % 12 AS  MONTHS  FROM patientsrecord WHERE ACCOUNT='$patient->patientnumber'  ");
while ($data = $x->fetch_object())
{
$name=$data->CLIENT;
print 'NAMES:'.$data->CLIENT.' YRS '.$data->YRS.' MONTHS  '.$data->MONTHS.' PNUM '.$patient->patientnumber;}
 ?> </h3>
  <form class="modal fade" id="newvitals" role="dialog" method="post"   action="newvitals.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">VITAL SIGNS<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-6">PATIENT NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT NUMBER" data-placement="bottom">
<input style='text-transform:uppercase' required readonly  name="patientnumber"  value="<?php print $patient->patientnumber;?>" type="text"  pattern="[0-9 ]{6}"  title="PATIENT NUMBER"   size="15" placeholder="PATIENT NUMBER"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
PATIENT NAME
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT NAME" data-placement="bottom">
<input style='text-transform:uppercase' required readonly  name="name"  value="<?php print $name;?>" type="text"  title="PATIENT NAME"   size="15" placeholder="PATIENT NAME"   class="form-control input-sm"     autocomplete="off" ></a>

<br>DATE<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  DATE" data-placement="bottom">
<input  style='text-transform:uppercase' name="date"  type="date"   required  title="ENTER DATE "   size="15" placeholder="DATE."  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />
 TIME  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  TIME" data-placement="bottom">
<input  style='text-transform:uppercase' placeholder="ENTER  TIME"  name="time"  type="time"    title="INVALID ENTRIES "   size="15" placeholder="TIME"  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

TEMPRETURE<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  TEMPRETURE" data-placement="bottom">
<input  style='text-transform:uppercase' name="tempreture" type="text" pattern="[[0-9A-Za-z ./-]+" title="INVALID ENTRIES"    title="INVALID ENTRIES "   size="15" placeholder="ENTER  TEMPRATURE"  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

PULSE/HEART RATE <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  PULSE/HEART RATE " data-placement="bottom">
<input  style='text-transform:uppercase' name="pulserate" type="text"  title="ENTER PULSE RATE "  size="15" required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />
 </div>
  


<div class="col-sm-6">
RESPIRATION RATE <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  RESPIRATION RATE " data-placement="bottom">
<input  style='text-transform:uppercase'  title="ENTER RESPIRATION RATE " name="respiratoryrate"  type="text"  pattern="[0-9A-Za-z ./-]+"  title="INVALID ENTRIES"   size="15" placeholder="ENTER RESPIRATION RATE "  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

BLOOD PRESSURE<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  BLOOD  PRESSURE" data-placement="bottom">
<input  style='text-transform:uppercase'  title="ENTER BLOOD PRESSURE " name="bloodpressure"  type="text"  pattern="[0-9A-Za-z ./-]+"  title="INVALID ENTRIES "   size="15" placeholder="ENTER BLOOD PRESSURE"   class="form-control input-sm"     autocomplete="off" ></a><br />

WEIGHT <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  BLOOD  PRESSURE" data-placement="bottom">
<input  style='text-transform:uppercase'  title="ENTER BLOOD PRESSURE " name="weight"  type="text"  pattern="[0-9A-Za-z ./-]+"  title="INVALID ENTRIES"   size="15" placeholder="ENTER WEIGHT."   class="form-control input-sm"     autocomplete="off" ></a><br />

MEDICAL NOTES<textarea name="medicalnote"  style="width: 100%; height: 15%" ></textarea>
<label><input checked style="font-color:red;" type="radio" id="emergency"   name="status" value="REVIEW">REVIEW </label> 
 <label ><input   type="radio" id="emergency"   name="status" value="CONSULTATION">CONSULTATION  </label> 
 <label ><input   type="radio" id="emergency"   name="status" value="PRIORITY">PRIORITY  </label> 
 <br>
 
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="newadmission">CLOSE</button>   

</div>


</div></div>

  
  </div></div></div></div>
  </form> 
  
  
  <form id="patients"   method="post" action="deleteinpatient.php"  > 
 <table class="table"  id="patientstable"  style="text-align:center;font-size:90%;">
	

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
             <tr >
		  <td  class="theader" width="1%"  height="28" valign="top" style='text-align:center;' >NO.</td>   
			<td  class="theader"  height="28" valign="top" style='text-align:center;'  > DATE </td>
			<td  class="theader"  height="28" valign="top" style='text-align:center;'  > TIME </td>
			<td  class="theader"  style="text-align:left;" width='25%' height="28" valign="top" style='text-align:center;'  >VITALS </td>
			<td  class="theader"  style="text-align:left;" width="25%" height="28" valign="top" style='text-align:center;'  >MEDICAL NOTE </td>
			<td  class="theader"  height="28" valign="top" style='text-align:center;'  > ATTENDANT </td>
		 	 <td  class="theader"  height="28" valign="top" style='text-align:center;'  > DEL </td>
			 </tr>
        <?php
	$x=$connect->query("SELECT vitalsreport.NURSE,MEDICALNOTE,vitalsreport.WEIGHT,CLIENT,vitalsreport.ID,vitalsreport.PATIENTNUMBER,vitalsreport.DATE,vitalsreport.TIME,vitalsreport.TEMPRETURE,vitalsreport.PULSERATE,vitalsreport.RESPIRATORYRATE,vitalsreport.BLOODPRESSURE FROM vitalsreport,patientsrecord  WHERE vitalsreport.PATIENTNUMBER=patientsrecord.ACCOUNT AND  vitalsreport.PATIENTNUMBER='$patient->patientnumber'  ORDER  BY DATE  DESC,TIME DESC ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
<tr class='filterdata'  style='text-align:center;' >
				<td  width='1%'  style='text-align:center;' ><?php print $number; ?> </td>  
				<td   style='text-align:center;' ><?php print $data->DATE; ?> </td>
<td   style='text-align:center;' ><?php print $data->TIME; ?> </td> 
<td width='25%'  style='text-align:center;' >
<div style="text-align:left;">TEMPRETURE:<?php print $data->TEMPRETURE; ?><sup>0</sup><div><br>
PULSE RATE:<?php print $data->PULSERATE; ?><br>
RESPIRATORY RATE <?php print $data->RESPIRATORYRATE; ?><br>
BLOOD PRESSURE<?php print $data->BLOODPRESSURE; ?><br>
WEIGT <?php print $data->WEIGHT; ?><br>
 </td>
 
<td  width="25%" style='text-align:left;' ><?php print $data->MEDICALNOTE; ?> </td> 
<td   style='text-align:center;' ><?php print $data->NURSE; ?> </td>				
				            <td style='text-align:center;'  >
<a   href="deletevitals3.php?vitalsid=<?php print $data->ID; ?>"  onclick="return confirm('DELETE VITAL  SIGNS   ?')" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>

<?php }	?> 
 </tr>
 </tbody>
 </table>
                      
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

