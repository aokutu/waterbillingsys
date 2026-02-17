<?php 


class  daterange
{
public $startdate=null;
public $enddate=null;

}
$daterange =new daterange;
$daterange->startdate=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date1']))));
$daterange->enddate=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date2']))));

?>
   <script>
       $(document).ready(function(){
   /*       $('#additemx').click(function() {
  var newItem = $('<div class="container"><div class="row">'+
  '<div class="col-sm-6">'+
  '<input list="itemlist" required style="text-transform:uppercase" pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES" id="item" name="procedure[]" type="text" size="15" placeholder="ENTER ITEM" required="on" class="form-control input-sm" autocomplete="off" />'+
  '</div>'+
  '<div class="col-sm-6">'+
    '<input  required style="text-transform:uppercase" pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES" id="item" name="freaquency[]" type="text" size="15" placeholder="ENTER FREQUENCY" required="on" class="form-control input-sm" autocomplete="off" />'+
  '</div></div></div>');
  var deleteButton = $('<i class="fas fa-trash-alt delete-btn"></i>');
  
  newItem.append(deleteButton);
  $('#itemdetails').append(newItem);
  
  $('.delete-btn').click(function() {
    $(this).closest('.container').remove();
  });
});*/


     $('#transfusionobservation').click(function(){
 $('#periodictransfusionobservationresults').append('<div class="grid grid-cols-7 gap-4">'+
'<div class="square w-full h-20  flex justify-center items-center"><input title="INFO " data-toggle="popover" data-trigger="hover" data-content="MINUTES " data-placement="top" style="text-transform:uppercase" name="minutes[]"  type="text"    title="MINUTES ELAPSED"   size="15" placeholder="MINUTES ELAPSED"  required="on"  class="form-control input-sm"     autocomplete="off" ></div>'+
'<div class="square w-full h-20  flex justify-center items-center"><input title="INFO " data-toggle="popover" data-trigger="hover" data-content="EXACT TIME " data-placement="top" style="text-transform:uppercase" name="time[]"  type="time"    title="EXACT TIME"   size="15" placeholder="EXACT TIME"  required="on"  class="form-control input-sm"     autocomplete="off" ></div>'+
'<div class="square w-full h-20  flex justify-center items-center"><input title="INFO " data-toggle="popover" data-trigger="hover" data-content="BLOOD PRESSURE " data-placement="top" style="text-transform:uppercase" name="bloodpressure[]"  type="text"    title="BLOOD PRESSURE"   size="15" placeholder="BLOOD PRESSURE"  required="on"  class="form-control input-sm"     autocomplete="off" ></div>'+
'<div class="square w-full h-20  flex justify-center items-center"><input title="INFO " data-toggle="popover" data-trigger="hover" data-content="BODY  TEMPRETURE " data-placement="top" style="text-transform:uppercase" name="bodytempreture[]"  type="text"    title="BODY TEMPRETURE"   size="15" placeholder="BODY TEMPRETURE"  required="on"  class="form-control input-sm"     autocomplete="off" ></div>'+
'<div class="square w-full h-20  flex justify-center items-center"><input title="INFO " data-toggle="popover" data-trigger="hover" data-content="PR" data-placement="top" style="text-transform:uppercase" name="pr[]"  type="text"    title="PR"   size="15" placeholder="PR"  required="on"  class="form-control input-sm"     autocomplete="off" ></div>'+
'<div class="square w-full h-20  flex justify-center items-center"><input title="INFO " data-toggle="popover" data-trigger="hover" data-content="RR" data-placement="top" style="text-transform:uppercase" name="rr[]"  type="text"    title="RR"   size="15" placeholder="RR"  required="on"  class="form-control input-sm"     autocomplete="off" ></div>'+
'<div class="square w-full h-20  flex justify-center items-center"><input title="INFO " data-toggle="popover" data-trigger="hover" data-content="REMARKS" data-placement="top" style="text-transform:uppercase" name="remarks[]"  type="text"    title="REMARKS"   size="15" placeholder="REMARKS"  required="on"  class="form-control input-sm"     autocomplete="off" ></div>'+
'</div>');
            });

			
        });
    </script>
<style>
#pendingprocedures td:nth-child(3){ width: 60%;}
#pendingprocedures td:nth-child(1),td:nth-child(4){ width: 10%;}
</style>
 <table   class="generictable">
<thead></thead>
<tbody>
<tr><td  class="heading" >PENDING LAB & IMAGING PROCEDURES</td></tr>
</tbody>
</table>
<div id="pendingproceduresdiv" >
<table id="pendingprocedures" class="generictable">
<tbody>
<tr>
<td width="1%">REFF #</td>
<td width="1%">DATE</td>
<td width="49%" style="text-align:left;"><div style="margin-left:2%;">DETAILS </div></td>
<td class="deletecolumn">DELETE</td>
</tr>

<?php
$num=0;
$x=$connect->query("SELECT pendingsales.ID,pendingsales.DETAILS,pendingsales.DATE FROM pendingsales,services WHERE pendingsales.DETAILS=services.DETAILS AND pendingsales.STATUS ='' AND 
PATIENTNUMBER ='$patientdetails->patientnumber' ORDER BY  DATE,pendingsales.ID DESC ");
while ($data = $x->fetch_object())
{
$num +=1;	?>
<tr>
<td width="1%"><?php print $num;?></td>
<td width="1%"><?php print $data->DATE;?></td>
<td width="49%" style="text-align:left;"><div style="margin-left:2%;"><?php print $data->DETAILS;?></div></td>
<td class="deletecolumn">
 <a   href="deletependingprocedures.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
<div class="fas fa-trash" style="font-size:160%;"></div>
</a>
</td>
</tr>
<?php } ?>
</tbody>

</table>
</div>
<br ><br ><br >
<div id="dischargereportsx" >
<div id="dischargereportstablex" >

<table class="generictable">
<thead></thead>
<tbody>
<tr><td  class="heading"><?php print $patientdetails->patientnumber; ?> LAB & IMAGING REPORTS FROM <?php print $patientdetails->date1; ?> TO <?php print $patientdetails->date2; ?>  <?php 
$patient=$_SESSION['patientnumber'];

print $patient;
?></td></tr>
</tbody>
</table>

<table class="generictable" id="dischargereportstable" >
<tbody>
<tr>
<td>REFF</td>
<td>PROCEDURE</td>
<td>DATE</td>
<td>ACTION</td>

</tr>
<?php 
//$x=$connect->query("SELECT PROCEDUREID,procedurehistory.ID,procedurehistory.PATIENTNUMBER,procedurehistory.PROCEDURES,procedurehistory.DATE,procedurehistory.ATTENDANT,CLIENT   FROM procedurehistory,patientsrecord  WHERE procedurehistory.DATE >='$daterange->startdate' AND procedurehistory.DATE <='$daterange->enddate' AND procedurehistory.PATIENTNUMBER=patientsrecord.ACCOUNT AND procedurehistory.PROCEDURES='COMPLETE BLOOD COUNT' ");

$x=$connect->query("SELECT  DISTINCT TRACKKEY,PROCEDURES,ATTENDANT,DATE,PATIENTNUMBER,NAME,GENDER,AGE  FROM  procedureresults  
WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND DATE >='$patientdetails->date1' AND DATE <='$patientdetails->date2' ");

while ($data = $x->fetch_object())
{
	$number+=1;	?>
  <tr >
	<td  ><?php print $data->TRACKKEY; ?> </td>	
	<td  ><?php print $data->PROCEDURES; ?></td>	  
	<td  ><?php print $data->DATE; ?></td>
	<td  >
			   <a   href="reprintprocedure.php?trackkey=<?php print $data->TRACKKEY; ?>"   ><i class="fas fa-print" style="font-size:160%;"></i></a>
 </td> </tr>	
<?php }
?>	
</tbody>
</table>

<br>
<table class="generictable">
<thead></thead>
<tbody>
<tr><td  class="heading"><?php print $patientdetails->patientnumber; ?> COMPLETE BLOOD COUNT RESULTS <?php print $patientdetails->date1; ?> TO <?php print $patientdetails->date2; ?>  <?php 
$patient=$_SESSION['patientnumber'];

print $patient;
?></td></tr>
</tbody>
</table>



<table class="generictable" id="dischargereportstable" >
<tbody>
<tr>
<td>REFF</td>
<td>DATE</td>
<td>ACTION</td>

</tr>
<?php 
$x=$connect->query("SELECT  completebloodcountresults.ID,TRACKKEY,PATIENTNUMBER,completebloodcountresults.DATE  FROM  completebloodcountresults WHERE DATE >='$patientdetails->date1' AND DATE <='$patientdetails->date2'  AND PATIENTNUMBER='$patientdetails->patientnumber'  ");

while ($data = $x->fetch_object())
{
	$number+=1;	?>
  <tr >
	<td  ><?php print $data->TRACKKEY; ?> </td>	
	<td  ><?php print $data->DATE; ?></td>
	<td  >
 <a   href="reprintcompletebloodcount.php?trackkey=<?php print $data->TRACKKEY; ?>"   ><i class="fas fa-print" style="font-size:160%;"></i></a>
 </td> </tr>	
<?php }
?>	
</tbody>
</table>


<br>
<table class="generictable">
<thead></thead>
<tbody>
<tr><td  class="heading"><?php print $patientdetails->patientnumber; ?> URINALYSIS RESULTS <?php print $patientdetails->date1; ?> TO <?php print $patientdetails->date2; ?>  <?php 
$patient=$_SESSION['patientnumber'];

print $patient;
?></td></tr>
</tbody>
</table>



<table class="generictable" id="dischargereportstable" >
<tbody>
<tr>
<td>REFF</td>
<td>DATE</td>
<td>ACTION</td>

</tr>
<?php 
$x=$connect->query("SELECT  urinalysis.ID,TRACKKEY,PATIENTNUMBER,urinalysis.DATE  FROM  urinalysis WHERE DATE >='$patientdetails->date1' AND DATE <='$patientdetails->date2'  AND PATIENTNUMBER='$patientdetails->patientnumber'  ");

while ($data = $x->fetch_object())
{
	$number+=1;	?>
  <tr >
	<td  ><?php print $data->TRACKKEY; ?> </td>	
	<td  ><?php print $data->DATE; ?></td>
	<td  >
 <a   href="reprinturinalysis.php?trackkey=<?php print $data->TRACKKEY; ?>"   ><i class="fas fa-print" style="font-size:160%;"></i></a>
 </td> </tr>	
<?php }
?>	
</tbody>
</table>
</div>
 </div>
