<?php
@session_start();
include_once("password2.php");
include_once("interface.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="NURSE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  


class  daterange
{
public $startdate=null;
public $enddate=null;

}
$daterange =new daterange;
$daterange->startdate=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date1']))));
$daterange->enddate=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date2']))));
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
  	<style>
table  td:nth-child(1){width: 2%;}
table  td:nth-child(2){width: 10%;}
table  td:nth-child(5),td:nth-child(6){width: 15%;}
table  td:nth-child(3),td:nth-child(4){width: 30%;}
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
$("#daterange").modal();
$('[data-toggle="popover"]').popover(); 
//$("#pricelisttable").load("registry.php #accountstable");	
 var $rows = $('.filterdata');
$('#searchtext').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});


$("#daterange").submit(function(){
$('#prepostmessage').modal('show');
$.post( "sessionregistry.php",
$("#daterange").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$('#prepostmessage').modal('hide');

$("#prescriptions").load("prescriptions.php #prescriptionstable");	
return false;
});
return false;
})

 })
  
  </script>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<div class="container" > 
  <a href="#" title="ENTER  " data-toggle="popover" data-trigger="hover" data-content="NEW  DETAILS" data-placement="bottom">
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#daterange"><i class="fas fa-calendar-alt" style="font-size:200%;" ></i>DATE RANGE</button></a>
 <button class="btn-info btn-sm" onclick="window.print()"> <i style="font-size:200%;" class="fas fa-print"></i>PRINT</button>
    <!-- Modal -->
   <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
 
 </div>
  <form class="modal fade" id="daterange" role="dialog" method="post"   action="sessionregistry.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">ENTER DATE RANGE<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">FROM 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM   NAME " data-placement="bottom">
<input style='text-transform:uppercase' required  name="date1" type="date"    title="INVALID ENTRIES"   size="15" placeholder="START DATE "   class="form-control input-sm"     autocomplete="off" ></a>
TO 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM PRICE" data-placement="bottom">
<input style='text-transform:uppercase' required list="patientnmberslist" name="date2" type="date"     size="15" placeholder="END DATE"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="daterange">CLOSE</button> 

 </div>
  

</div></div>

  
  </div></div></div></div>
  </form> 
  
   

<form id="prescriptions"   method="post"   >
<div id="prescriptionstable">
	<h3  style="text-align:center;font-weight:bold;text-decoration:underline;" >PRESSCRIPTIONS   <br>FROM  <?php print $daterange->startdate; ?> TO <?php print $daterange->enddate; ?></h3>
<table class="table"    style="text-align:center;font-size:90%;">
	

	  
        <!--DWLayoutTable-->
        <thead>
         	<tr>
		<td  class="theader"    height="28" valign="top"  style='text-align:left;' ># </td>
<td  class="theader"    height="28" valign="top"  style='text-align:left;' >PATIENT </td>
<td  class="theader"   height="28" valign="top"  style='text-align:left;' >PRESCRIPTION </td>
<td  class="theader"   height="28" valign="top"  style='text-align:left;' >DETAILS </td>
<td  class="theader"   height="28" valign="top"  style='text-align:left;' >MEDIC </td>

<td  class="theader"    height="28" valign="top"  style='text-align:right;' >DATE </td>
</tr>   
        </thead>
        <tbody>
	
      
				<?php
$number=0;
//$x=$connect->query("SELECT ID,TREATMENT,DATE,ATTENDANT,STATUS,PRESCRIPTION,ATTENDANT  FROM treatmentreport   ");

$x=$connect->query("SELECT PATIENTNUMBER,treatmentreport.ID,TREATMENT,treatmentreport.DATE,ATTENDANT,STATUS,PRESCRIPTION,CLIENT FROM treatmentreport,patientsrecord   
WHERE PATIENTNUMBER= ACCOUNT AND treatmentreport.DATE >='$daterange->startdate' AND treatmentreport.DATE <='$daterange->enddate' ORDER BY  treatmentreport.DATE,treatmentreport.ID DESC ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
<td  class="theader"    height="28" valign="top"  style='text-align:left;' ><?php print $number; ?></td>
<td  class="theader"    height="28" valign="top"  style='text-align:left;' ><?php print $data->PATIENTNUMBER."<br>".$data->CLIENT; ?> </td>
<td  class="theader"   height="28" valign="top"  style='text-align:left;' ><?php print $data->PRESCRIPTION; ?> </td>
<td  class="theader"   height="28" valign="top"  style='text-align:left;' ><?php print $data->TREATMENT; ?></td>
<td  class="theader"   height="28" valign="top"  style='text-align:left;' ><?php print $data->ATTENDANT; ?></td>
<td  class="theader"    height="28" valign="top"  style='text-align:right;' ><?php print $data->DATE; ?> </td>

	 </tr>
<?php }	?> 
</tbody>
 </table>
                      
	</div>				  
 </form>
 
 
 
   <form class="modal fade" id="accessrights" role="dialog" method="post" >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">ENTER DATE RANGE<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">NAME
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM   NAME " data-placement="bottom">
<input style='text-transform:uppercase' required  name="accessrightsname" type="text" id="accessrightsname"   title="INVALID ENTRIES"   size="15" placeholder="START DATE "   class="form-control input-sm"     autocomplete="off" ></a>
PASSWORD
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM PRICE" data-placement="bottom">
<input style='text-transform:uppercase' required list="patientnmberslist" name="password" type="password"     size="15" placeholder="END DATE"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
<button type="button" class="btn-info btn-sm" data-dismiss="modal" id="daterange">CLOSE</button> 

 </div>
  

</div></div>

  
  </div></div></div></div>
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