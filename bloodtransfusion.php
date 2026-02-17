<?php
@session_start();
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="CONSULTATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  


class bloodtransfusion 
{
	
public $patientnumber=null;
public $date1=null;
public $date2=null; 

}

$bloodtransfusion=new bloodtransfusion;
$bloodtransfusion->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));
$bloodtransfusion->date1=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date1']))));
$bloodtransfusion->date2=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date2']))));


?>
<script>
$(document).ready(function()
{

 $(document).on('click', '.deletebloodtransfusionslink', function(event) {
        event.preventDefault();
        
        var deleteid = $(this).data('deleteid');
        var msg = 'DELETE OPERATION NOTES ';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'deletebloodtransfusion.php',
                data: {
                    deleteid:deleteid
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#bloodtransfusiondiv1").load("bloodtransfusion.php #bloodtransfusiondiv2 ", function() {
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
	
	
   $("#bloodtransfusionxx").submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Collect form data
       /* var companyname = $("#companyname").val();
        var companyaddress = $("#companyaddress").val();
        var phonenumber = $("#phonenumber").val();
        var email = $("#email").val(); */
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'bloodtransfusion2.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
               //Update page content and hide modal
                $("#bloodtransfusiondiv1").load("bloodtransfusion.php #bloodtransfusiondiv2 ", function() {
                    // Optional: Rebind event handlers if necessary
                });
		 $("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                 $('#message').modal('show');
				 
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(error);
                $('#prepostmessage').modal('hide'); // Hide modal in case of error
            }
        });

        // Return false to prevent default form submission (this is the correct place)
        return false;
    });
	

});

</script>

<form method="post" id="bloodtransfusionxx" action="bloodtransfusion2.php">
	 <div class="grid grid-cols-2 gap-4">
  <!-- Row 1 -->

  <div class="square w-full h-20  flex justify-center items-center">
 <h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br> TRANSFUSION DATE-TIME </h4>
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="TRANSFUSION DATE" data-placement="top" style='text-transform:uppercase' name="transfusiondatetime"  type="datetime-local"   required  title="TRANSFUSION DATE"   size="15" placeholder="TRANSFUSION DATE"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
  
    <div class="square w-full h-20  flex justify-center items-center">
 <h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br> DIAGNOSIS </h4>
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="DIAGNOSIS" data-placement="top" style='text-transform:uppercase' name="diagnosis"  required  type="text"   required  title="INVALID ENTRIES"   size="15" placeholder="DIAGNOSIS "  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
  
  
</div>
<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>TYPE  OF BLOOD TRANSFUSED </h4>
 <div class="grid grid-cols-5 gap-4">
  <!-- Row 1 -->

  <div class="square w-full h-20  flex justify-center items-center">
 <label ><input   class="form-control input-sm"  type="radio"    name="transfusedbloodtype" value="Whole blood">Whole blood  </label> 

	  </div>
  <div class="square w-full h-20  flex justify-center items-center">
 <label ><input   class="form-control input-sm"  type="radio"   name="transfusedbloodtype" value="Packed red cells">Packed red cells </label> 

	  </div>
	   <div class="square w-full h-20  flex justify-center items-center">
  <label ><input   class="form-control input-sm"  type="radio"   name="transfusedbloodtype" value="FFP">FFP </label> 


	  </div>
	   <div class="square w-full h-20  flex justify-center items-center">
 <label ><input   class="form-control input-sm"  type="radio"   name="transfusedbloodtype" value="Platelets">Platelets </label> 

	  </div>
	   <div class="square w-full h-20  flex justify-center items-center">
 <label ><input   class="form-control input-sm"  type="radio"   name="transfusedbloodtype" value="Others">Others </label> 

	  </div>
</div> 
	<hr class="border-t-2 border-blue-500 my-4">  
 <div class="grid grid-cols-5 gap-4">
  <!-- Row 1 -->

  <div class="square w-full h-20  flex justify-center items-center">
 <input title="BLOOD UNIT" data-toggle="popover" data-trigger="hover" data-content="DONOR NUMBER" data-placement="top" style='text-transform:uppercase' name="bloodunitdonornumber"  type="text"    title="BLOOD UNIT DONOR NUMBER"   size="15" placeholder="BLOOD UNIT DONOR NUMBER"  required="on"  class="form-control input-sm"     autocomplete="off" >

	  </div>
  <div class="square w-full h-20  flex justify-center items-center">
 <input title="COUNTER" data-toggle="popover" data-trigger="hover" data-content="CHECKED BY" data-placement="top" style='text-transform:uppercase' name="counterchecker"  type="text"    title="COUNTER CHECKED BY"   size="15" placeholder="COUNTER CHECKED BY"  required="on"  class="form-control input-sm"     autocomplete="off" >

	  </div>
	   <div class="square w-full h-20  flex justify-center items-center">
 <input title="TRANSFUSION" data-toggle="popover" data-trigger="hover" data-content="STARTED BY" data-placement="top" style='text-transform:uppercase' name="startedby"  type="text"    title="TRANSFUSION STARTED BY"   size="15" placeholder="TRANSFUSION STARTED BY"  required="on"  class="form-control input-sm"     autocomplete="off" >

	  </div>
	   <div class="square w-full h-20  flex justify-center items-center">
 <input title="TRANSFUSION " data-toggle="popover" data-trigger="hover" data-content="START TIME" data-placement="top" style='text-transform:uppercase' name="starttime"  type="time"    title="TRANSFUSION START TIME"   size="15" placeholder="TRANSFUSION START TIME"  required="on"  class="form-control input-sm"     autocomplete="off" >

	  </div>
	   <div class="square w-full h-20  flex justify-center items-center">
 <input title="INFO " data-toggle="popover" data-trigger="hover" data-content="TRANSFUSION RATE" data-placement="top" style='text-transform:uppercase' name="transfusionrate"  type="text"    title="TRANSFUSION RATE ml/minute"   size="15" placeholder="TRANSFUSION RATE ml/minute"  required="on"  class="form-control input-sm"     autocomplete="off" >

	  </div>
</div> 
<hr class="border-t-2 border-blue-500 my-4">
<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>
<div title="CLICK TO ADD" data-toggle="popover" data-trigger="hover" data-content="PERIODIC OBSERVATIONS" data-placement="top"  id="transfusionobservation" class="text-red-500" ><i class="fas fa-user-md"  style="font-size:160%;" ></i>OBSERVATIONS  </div>
<br></h4>

 <div class="grid grid-cols-7 gap-4">
  <!-- Row 1 -->
<div class="square w-full h-20  flex justify-center items-center">
 <input title="INFO " data-toggle="popover" data-trigger="hover" data-content="MINUTES " data-placement="top" style='text-transform:uppercase' name="minutes[]"  type="text"    title="MINUTES ELAPSED"   size="15" placeholder="MINUTES ELAPSED"  required="on"  class="form-control input-sm"     autocomplete="off" >
</div>
<div class="square w-full h-20  flex justify-center items-center">
 <input title="INFO " data-toggle="popover" data-trigger="hover" data-content="EXACT TIME " data-placement="top" style='text-transform:uppercase' name="time[]"  type="time"    title="EXACT TIME"   size="15" placeholder="EXACT TIME"  required="on"  class="form-control input-sm"     autocomplete="off" >

</div>
<div class="square w-full h-20  flex justify-center items-center">
 <input title="INFO " data-toggle="popover" data-trigger="hover" data-content="BLOOD PRESSURE " data-placement="top" style='text-transform:uppercase' name="bloodpressure[]"  type="text"    title="BLOOD PRESSURE"   size="15" placeholder="BLOOD PRESSURE"  required="on"  class="form-control input-sm"     autocomplete="off" >

</div>
<div class="square w-full h-20  flex justify-center items-center">
 <input title="INFO " data-toggle="popover" data-trigger="hover" data-content="BODY  TEMPRETURE " data-placement="top" style='text-transform:uppercase' name="bodytempreture[]"  type="text"    title="BODY TEMPRETURE"   size="15" placeholder="BODY TEMPRETURE"  required="on"  class="form-control input-sm"     autocomplete="off" >

</div>
<div class="square w-full h-20  flex justify-center items-center">
 <input title="INFO " data-toggle="popover" data-trigger="hover" data-content="PR" data-placement="top" style='text-transform:uppercase' name="pr[]"  type="text"    title="PR"   size="15" placeholder="PR"  required="on"  class="form-control input-sm"     autocomplete="off" >

</div>
<div class="square w-full h-20  flex justify-center items-center">
 <input title="INFO " data-toggle="popover" data-trigger="hover" data-content="RR" data-placement="top" style='text-transform:uppercase' name="rr[]"  type="text"    title="RR"   size="15" placeholder="RR"  required="on"  class="form-control input-sm"     autocomplete="off" >

</div>
<div class="square w-full h-20  flex justify-center items-center">
 <input title="INFO " data-toggle="popover" data-trigger="hover" data-content="REMARKS" data-placement="top" style='text-transform:uppercase' name="remarks[]"  type="text"    title="REMARKS"   size="15" placeholder="REMARKS"  required="on"  class="form-control input-sm"     autocomplete="off" >

</div>

</div> 

<div id="periodictransfusionobservationresults">
 </div>
 <hr class="border-t-2 border-blue-500 my-4">
  <div class="grid grid-cols-2 gap-4">
  <div class="square w-full h-20  flex justify-center items-center">
   <input title="TIME " data-toggle="popover" data-trigger="hover" data-content="TRANSFUSION ENDED" data-placement="top" style='text-transform:uppercase' name="transfusionendtime"  type="time"    title="TRANSFUSION END TIME"   size="15" placeholder="TRANSFUSION END TIME"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
    <div class="square w-full h-20  flex justify-center items-center">
   <input title="INFO" data-toggle="popover" data-trigger="hover" data-content="AMOUNT TRANSFUSED " data-placement="top" style='text-transform:uppercase' name="amounttransfused"  type="text"    title="AMOUNT TRANSFUSED"   size="15" placeholder="AMOUNT TRANSFUSED"  required="on"  class="form-control input-sm"     autocomplete="off" >
	
	</div>

  </div>
  <h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>GENERAL</h4>
  <hr class="border-t-2 border-blue-500 my-4">
   <div class="grid grid-cols-4 gap-4">
  <!-- Row 1 -->
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="general[]" value="GENERAL FEVER">GENERAL FEVER </label> 
</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="general[]" value="CHILLS/RIGORS">CHILLS/RIGORS </label> 

</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="general[]" value="FLUSHING">FLUSHING </label> 

</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="general[]" value="NAUSEA/VOMITING">NAUSEA/VOMITING </label> 

</div>
</div>
 <hr class="border-t-2 border-blue-500 my-4">
<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>DERMATOLOGICAL</br></h4>
<div class="grid grid-cols-2 gap-4">
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="dermatological[]" value="URTICARIA">URTICARIA </label> 

</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="dermatological[]" value="OTHER SKIN RASHES">OTHER SKIN RASHES </label> 

</div>
</div>  


<hr class="border-t-2 border-blue-500 my-4">
<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>CARDIAC' RESPIRATORY </br></h4>
<div class="grid grid-cols-4 gap-4">
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="cardiac[]" value="CHEST PAIN">CHEST PAIN </label> 

</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="cardiac[]" value="DYSPNOEA">DYSPNOEA </label> 

</div>

<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="cardiac[]" value="HYPOTENSION">HYPOTENSION </label> 

</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="cardiac[]" value="TACHYCARDIA">TACHYCARDIA </label> 

</div>

</div> 



<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>RENAL </h4>
<div class="grid grid-cols-3 gap-4">
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="renal[]" value="HAEMOGLOBINURIA">HAEMOGLOBINURIA </label> 

</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="renal[]" value="OLIGURIA">OLIGURIA </label> 

</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="renal[]" value="ANURIA">ANURIA </label> 

</div>
</div> 
<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>HAEMATOLOGICAL</h4>
<div class="grid grid-cols-2 gap-4">
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="unexplainedbleeding" value="UNEXPLAINED BLEEDIN">UNEXPLAINED BLEEDING </label> 

</div>

<div class="square w-full h-20  flex justify-left items-left">
 <h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br> OTHER COMPLICATIONS</h4> 
 <input title="OTHER " data-toggle="popover" data-trigger="hover" data-content="COMPLICATIONS " data-placement="top" style='text-transform:uppercase' name="othercomplications"  type="text"    title="OTHER COMPLICATIONS "   size="15" placeholder="OTHER COMPLICATIONS "  required="on"  class="form-control input-sm"     autocomplete="off" >

</div>

</div> 
<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>INTERVENTION DRUGS GIVEN</h4>
  <textarea class="border-4 border-blue-500 p-2 rounded-lg"  name="intervention" style="width: 100%; height: 15%" ></textarea>
  



  <hr class="border-t-2 border-blue-500 my-4">DATE
  <input  class="form-control input-sm" required type="date"    name="date">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</form>

<div id="bloodtransfusiondiv1" >
<div id="bloodtransfusiondiv2" >
 <table   class="generictable">
<thead></thead>
<tbody>
<tr>
<td  class="heading">P.NO.<?php print $bloodtransfusion->patientnumber; ?> BLOOD TRANSFUSION  RECORDS FROM <?php print $bloodtransfusion->date1; ?> TO <?php print $bloodtransfusion->date2; ?>  
</td>
</tr>
</tbody>
</table><br>

 <table id="bloodtransfusiontable"   >
<thead></thead>
<tbody>
<tr>
<td  class="heading">REFF</td>
<td  class="heading">DATE</td>
<td  class="heading">ACTION</td>
</tr>
<?php 
$number=0;
//WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND DATE >='$bloodsugardetails->startdate' AND DATE <='$patientdetails->date2'
$x=$connect->query(" SELECT ID,DATE FROM  bloodtransfusion  WHERE PATIENTNUMBER='$bloodtransfusion->patientnumber' AND DATE >='$bloodtransfusion->date1' AND DATE <='$bloodtransfusion->date2' ");

while ($data = $x->fetch_object())
{
	$number+=1;	?> 
	
	<tr>
<td   ><?php print $number; ?></td>
<td   ><?php print $data->DATE; ?> </td>
<td class="deletecolumn"  >
 <a   href="reprintbloodtransfusion.php?trackkey=<?php print $data->ID; ?>"   ><i class="fas fa-print" style="font-size:160%;"></i></a>
 <a title="DELETE" data-toggle="popover" data-trigger="hover" data-content="RECORD" data-placement="left" class="deletebloodtransfusionslink" data-deleteid="<?php print $data->ID; ?>" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
 </td>

</tr>

<?php } 
?>


</tbody>
</table>



</div>
</div>


