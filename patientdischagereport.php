<?php 
@session_start();
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="consultation";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

?>
<style>

  #dischargereportstable td:nth-child(1),td:nth-child(6){
    width: 5%;
  }


</style>
 <script>
       $(document).ready(function(){
          $('#adddiagnosis').click(function() {
  var newItem = $('<div class="container"><div class="row"><input list="diagnosislist" required style="text-transform:uppercase" pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES" id="item" name="diagnosis[]" type="text" size="15" placeholder="ENTER DIAGNOSIS" required="on" class="form-control input-sm" autocomplete="off" /></div></div>');
  var deleteButton = $('<i class="fas fa-trash-alt delete-btn"></i>');
  
  newItem.append(deleteButton);
  $('#addeddiagnosis').append(newItem);
  
  $('.delete-btn').click(function() {
    $(this).closest('.container').remove();
  });
});

$("#patientdischargereport").submit(function(){
$('#prepostmessage').modal('show');
$.post( "patientdischargereport.php",
$("#patientdischargereport").serialize(),
function(data){
$("#content").load("message.php #content");
//$("#loadprice").load("loadprices.php #itemdetails");
$('#prepostmessage').modal('hide'); $('#message').modal('show');
$("#dischargereportsx").load("patientdischagereport.php #dischargereportstablex ");

return false;});


return false;
})

});
</script>
<form method="post" id="patientdischargereport" action="patientdischargereport.php">
 <div class="grid grid-cols-3 gap-4">
  <!-- Row 1 -->
  <div class="square w-full h-20  flex justify-center items-center">
 ADMISSION DATE
  <input title="INFO" data-toggle="popover" data-trigger="hover" data-content="DATE OF ADMISSION" data-placement="top" style='text-transform:uppercase' name="admissiondate"  type="date"   required  title="INVALID ENTRIES"   size="15" placeholder="ADMISSION DATE"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
  <div class="square w-full h-20  flex justify-center items-center">
 DISCHARGE DATE
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="DISCHARGE DATE" data-placement="top" style='text-transform:uppercase' name="dischargedate"  type="date"   required  title="INVALID ENTRIES"   size="15" placeholder="DISCHARGE DATE"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
  
    <div class="square w-full h-20  flex justify-center items-center">
 <div id="adddiagnosis" ><i style="font-size:160%;" class="fa-solid fa-viruses"></i>DIAGNOSIS</div>

  </div>
</div>
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="DIAGNOSIS" data-placement="top" style='text-transform:uppercase' name="diagnosis[]"  type="text"   required    size="15" placeholder="DIAGNOSIS"  required="on"  class="form-control input-sm"     autocomplete="off" >
<br>
<div id="addeddiagnosis"></div>

 <div class="container">
   <div class="row">
  <div class="col-sm-6">
  CHIEF COMPLAIN
  <textarea placeholder="CHIEF COMPLAIN" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CHIEF COMPLAIN" data-placement="top" class="border-4 border-blue-500 p-2 rounded-lg"  name="chiefcomplain" style="width: 100%; height: 15%" ></textarea>
PRESENTING ILLNESS
  <textarea placeholder="PRESENTING ILLNESS" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PRESENTING ILLNESS" data-placement="top" class="border-4 border-blue-500 p-2 rounded-lg"  name="presentingillness" style="width: 100%; height: 15%" ></textarea>

  
  </div>
  <div class="col-sm-6">
  
  ON EXAMINATION
  <textarea placeholder="ON EXAMINATION" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ON EXAMINATION" data-placement="top" class="border-4 border-blue-500 p-2 rounded-lg"  name="onexamination" style="width: 100%; height: 15%" ></textarea>
SUMMARY
  <textarea placeholder="SUMMARY" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SUMMARY" data-placement="top" class="border-4 border-blue-500 p-2 rounded-lg"  name="summary" style="width: 100%; height: 15%" ></textarea>
   
  </div>
  </div>
  </div>
  
<br><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>



</form>

<div id="dischargereportsx" >
<div id="dischargereportstablex" >
<table class="generictable">
<thead></thead>
<tbody>
<tr><td  class="heading">PATIENT DISCHARGE REPORT  <?php 
$patient=$_SESSION['patientnumber'];

print $patient;
?></td></tr>
</tbody>
</table>

<table class="generictable" id="dischargereportstable" >
<tbody>
<tr>
<td>REFF</td>
<td>DIAGNOSIS</td>
<td>ADMISSION</td>
<td>DISCHARGE</td>
<td>MEDIC</td>

<td>ACTION</td>

</tr>
<?php 
$num=0;
$x=$connect->query("SELECT ID,ADMISSIONDATE,MEDICALOFFICER, DISCHARGEDATE,DIAGNOSIS FROM patientdischargereport WHERE  PATIENTNUMBER ='$patient' ");
while ($data = $x->fetch_object())
{ 
?>
<tr>
<td><?php $num+=1;
print $num; ?></td>
<td><?php print  $data->DIAGNOSIS; ?></td>
<td><?php print  $data->ADMISSIONDATE; ?></td>
<td><?php print  $data->DISCHARGEDATE; ?></td>
<td><?php print  $data->MEDICALOFFICER; ?></td>

<td>
<a title="<?php print  $data->ID; ?>" data-toggle="popover" data-trigger="hover" data-content="DELETE" data-placement="bottom"   href="dischargereport.php?reportid=<?php  print $data->ID; ?>"  onclick="return confirm('VIEW DETAILS ?')" ><div class="fas fa-file-download" style="font-size:160%;"> </div></a>
<a title="EDIT" data-toggle="popover" data-trigger="hover" data-content="REPORT" data-placement="bottom"   href="editdischargereport.php?editid=<?php  print $data->ID; ?>"  onclick="return confirm('EDIT REPORT ?')" ><div class="fas fa-file-edit" style="font-size:160%;"> </div></a>
<a title="DELETE" data-toggle="popover" data-trigger="hover" data-content="REPORT" data-placement="bottom" class="deleteid" data-deleteid="<?php print $data->ID; ?>" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>

</td>

</tr>


<?php }
?>
</tbody>
</table>
</div>
 </div>
