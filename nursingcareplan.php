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

class   nursingcaredetails
{
public $startdate=null;
public $enddate=null;
public $nursingcarepnumber=null;

}
$nursingcaredetails =new nursingcaredetails;
$nursingcaredetails->startdate=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date1']))));
$nursingcaredetails->enddate=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date2']))));
$nursingcaredetails->nursingcarepnumber=$_SESSION['patientnumber'];



?>

<script>
   $(document).ready(function(){



 $(document).on('click', '.viewnursecarelink', function(event) {
        event.preventDefault();
        
        var viewid = $(this).data('viewid');
        var msg = 'VIEW NURSING CARE  RECORD';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'viewnursingcare.php',
                data: {
                    viewid:viewid
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#nursingplandiv1").load("nursingcareplan.php #nursingplandiv2", function() {
                    // Optional: Rebind event handlers if necessary
                });
                  $("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                 $('#message').modal('show');
            },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error(error);
                }
            });
        }
        
        return true;
    });




 $(document).on('click', '.deletenursecarelink', function(event) {
        event.preventDefault();
        
        var deleteid = $(this).data('deleteid');
        var msg = 'DELETE NURSING CARE  RECORD';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'deletenursingcare.php',
                data: {
                    deleteid:deleteid
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#nursingplandiv1").load("nursingcareplan.php #nursingplandiv2", function() {
                    // Optional: Rebind event handlers if necessary
                });
                  $("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                 $('#message').modal('show');
            },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error(error);
                }
            });
        }
        
        return true;
    });

	
$("#nursingcareplan").submit(function(){
$.post( "nursingcareplan2.php",
$("#nursingcareplan").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show'); 
$("#nursingplandiv1").load("nursingcareplan.php #nursingplandiv2");
return false;});
return false;
});

 });
</script>
<style>
#nursingcaretable td:nth-child(1),td:nth-child(11){width: 2%;}
#nursingcaretable td:nth-child(2){width: 4%;}
#nursingcaretable {font-weight: normal;}
</style>

	  <form method="post" id ="nursingcareplan" action="nursingcareplan2.php" >
	  <?php 
$x=$connect->query(" SELECT WARD,BEDNUMBER,ADMISSIONDATE,ADMITDATE2 FROM inpatientsrecord WHERE PATIENTNUMBER ='$nursingcaredetails->nursingcarepnumber' ");
while ($data = $x->fetch_object())
{ $ward = $data->WARD; $bednumber = $data->BEDNUMBER; $admissiondate = $data->ADMITDATE2; }
	  ?>
	  
	 <div class="grid grid-cols-3 gap-4">
  <!-- Row 1 -->
  <div class="square w-full h-20  flex justify-center items-center">
  D.O.A
  <input title="INFO" data-toggle="popover" data-trigger="hover" readonly value="<?php print $admissiondate; ?>"  data-content="DATE OF ADMISSION" data-placement="top" style='text-transform:uppercase' name="admissiondate"  type="date"   required  title="DATE  OF ADMISSION"   size="15" placeholder="TIME FROM"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
  <div class="square w-full h-20  flex justify-center items-center">
  DATE/TIME
<input title="TIME" data-toggle="popover" data-trigger="hover" data-content="DATE TIME" data-placement="top" style='text-transform:uppercase' name="datetime"  type="datetime-local"   required  title="DATE TIME"   size="15" placeholder="TIME FROM"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
  
    <div class="square w-full h-20  flex justify-center items-center">
  
  <input title="INFO" data-toggle="popover" list="diagnosislist" data-trigger="hover" data-content="DAIAGNOIS" data-placement="top" style='text-transform:uppercase' name="diagnosis"  type="text"   required  title="DIAGNOSIS"   size="15" placeholder="DIAGNOSIS"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
</div>

	 <div class="grid grid-cols-2 gap-4">
  <!-- Row 1 -->

  <div class="square w-full h-20  flex justify-center items-center">
  
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="WARD " data-placement="top" style='text-transform:uppercase' name="ward"  type="text" readonly value="<?php print $ward; ?>" required  title="WARD"   size="15" placeholder="WARD"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
  
  <div class="square w-full h-20   flex justify-center items-center">
  
 <input title="INFO" data-toggle="popover" data-trigger="hover" data-content="BED NUMBER" data-placement="top" style='text-transform:uppercase' name="bednumber"  type="number" readonly value="<?php print $bednumber; ?>"  min="1" required  title="BED"   size="15" placeholder="BED NUMBER"  required="on"  class="form-control input-sm"     autocomplete="off" >
 
  </div>
</div> 


	 <div class="grid grid-cols-3 gap-4">
  <!-- Row 1 -->
  <div class="square w-full h-20  flex justify-center items-center">
  
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="ASSESMENT" data-placement="top"   name="assesment"  type="text"   required  title="ASSESMENT"   size="15" placeholder="ASSESMENT"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
  <div class="square w-full h-20  flex justify-center items-center">

<input  list="diagnosislist" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NURSING DIAGNOSIS " data-placement="top" style='text-transform:uppercase' name="nursingdiagnosis"  type="text"   required  title="NURSING DIAGNOSIS"   size="15" placeholder="NURSING DIAGNOSIS"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
  
    <div class="square w-full h-20  flex justify-center items-center">
 
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="GOAL/EXPECTD OUTCOME" data-placement="top"  name="expectedoutcome"  type="text"   required  title="GOAL/EXPECTD OUTCOME"   size="15" placeholder="GOAL/EXPECTD OUTCOME"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
</div> 

 	 <div class="grid grid-cols-3 gap-4">
	 
	 
  <div class="square w-full h-20  flex justify-center items-center">

<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="INTERVENTION/PLAN OF ACTION" data-placement="top"  name="intervention"  type="text"   required  title="INTERVENTION/PLAN OF ACTION"   size="15" placeholder="INTERVENTION/PLAN OF ACTION"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
  <!-- Row 1 -->
  <div class="square w-full h-20  flex justify-center items-center">

<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="RATIONALE" data-placement="top" name="rationale"  type="text"   required  title="RATIONALE"   size="15" placeholder="RATIONALE"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
  <div class="square w-full h-20  flex justify-center items-center">

<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="IMPLEMENTATION" data-placement="top" name="implementation"  type="text"   required  title="IMPLEMENTATION"   size="15" placeholder="IMPLEMENTATION"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
</div> 
 	 <div class="grid grid-cols-2 gap-4">
  <!-- Row 1 -->
  <div class="square w-full h-20  flex justify-center items-center">

<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="EVALUATION" data-placement="top" name="evaluation"  type="text"   required  title="EVALUATION"   size="15" placeholder="EVALUATION"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
  <div class="square w-full h-20  flex justify-center items-center">

   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>

  </div>
</div> 

</form>

<div id="nursingplandiv1" >
<div id="nursingplandiv2" >
 <table   class="generictable">
<thead></thead>
<tbody>
<tr>
<td  class="heading">P.NO.<?php print $nursingcaredetails->nursingcarepnumber; ?> NURSING CARE  PLAN <?php print $nursingcaredetails->startdate; ?> TO <?php print $nursingcaredetails->enddate; ?>  
<i onclick="window.print()" style="font-size:200%;" class="fas fa-print"></i>
</td>
</tr>
</tbody>
</table><br>
<div class="overflow-x-auto">
 <table  id="nursingcaretable" class="generictable">
<thead></thead>
<tbody>
<tr>
<td  class="heading" ><div class ="mr-2 mL-2 " >REFF</div></td>
<td  class="heading" ><div class ="mr-2 mL-2 " >DATE/TIME</div></td>
<td  class="heading" ><div class ="mr-2 mL-2 " >DIAGNOSIS</div></td>
<td style ="font-weight: normal;text-align:center;"  class="heading" ><div class ="mr-2 mL-2 " >ATTENDANT</div></td>
<td style ="font-weight: normal;text-align:center;" class="deletecolumn" ><div class ="mr-2 mL-2 " >ACTION</div> </td>

</tr>

<?php 
$number=0;
//WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND DATE >='$bloodsugardetails->startdate' AND DATE <='$patientdetails->date2'
$x=$connect->query(" SELECT  ID,PATIENTNUMBER,ADMISSIONDATE,DATETIME, WARD, BEDNUMBER, DIAGNOSIS,
 ASSESMENT, NURSEDIAGNOSIS, EXPECTEDOUTCOME, INTERVENTIONS, RATIONALE, IMPLEMENTATION, EVALUATION, ATTENDANT  FROM  nursecareplan WHERE PATIENTNUMBER = '$nursingcaredetails->nursingcarepnumber' AND DATETIME  >= '$nursingcaredetails->startdate' AND DATETIME<= '$nursingcaredetails->enddate' ");

while ($data = $x->fetch_object())
{ 
$number+=1;
?>

<tr  class ="font-normal" >
<td  style ="font-weight: normal;" ><?php print $number; ?></td>
<td style ="font-weight: normal;"  ><?php print $data->DATETIME; ?></td>
<td style ="font-weight: normal;"  ><?php print $data->DIAGNOSIS; ?></td>
<td style ="font-weight: normal;text-align:center;"  ><?php print $data->ATTENDANT; ?></td>

<td  style ="font-weight: normal;text-align:center;" class="deletecolumn" >
			   <a   href="reprintnursingcareplan.php?viewid=<?php print $data->ID; ?>"   ><i class="fas fa-print" style="font-size:160%;"></i></a>
 <a title="DELETE" data-toggle="popover" data-trigger="hover" data-content="RECORD" data-placement="left" class="deletenursecarelink" data-deleteid="<?php print $data->ID; ?>" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>

 </td>

</tr>
<?php } ?>

</tbody>
</table>
</div>

</div></div>

