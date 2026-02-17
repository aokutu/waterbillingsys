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

class preoperativedetails 
{
	
public $patientnumber=null;
public $date1=null;
public $date2=null; 

}

$preoperativedetails=new preoperativedetails;
$preoperativedetails->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));
$preoperativedetails->date1=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date1']))));
$preoperativedetails->date2=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date2']))));

$connect->query("UPDATE consultation  SET CHECKIN=CURRENT_TIME  WHERE PATIENTNUMBER='$preoperativedetails->patientnumber' AND  CHECKIN ='00:00:00' ");

?>
<script>
   $(document).ready(function(){
	   
 $(document).on('click', '.deletepreoperativelink', function(event) {
        event.preventDefault();
        var deleteid = $(this).data('deleteid');
        var msg = 'DELETE PRE OPERATIVE DETAILS  ';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'deletepreoperative.php',
                data: {
                    deleteid:deleteid
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#preoperativediv1").load("preoperative.php #preoperativediv2", function() {
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
	
	
$("#preoperative").submit(function(){
$('#prepostmessage').modal('show');
$.post( "preoperative2.php",
$("#preoperative").serialize(),
function(data){
$("#content").load("message.php #content");
 $('#prepostmessage').modal('hide'); 
$('#message').modal('show'); 
$("#preoperativediv1").load("preoperative.php #preoperativediv2");
return false;});
return false;
});

});
</script>

	
	<form action="preoperative2.php" method="post" class ="font-bold" id="preoperative">
<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>CATEGORY</h4> 

<div class="grid grid-cols-2 gap-4">
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm "  type="radio"   name="operationcategory" value="ELECTIVE OPERATION">ELECTIVE OPERATION </label> 

</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="radio"   name="operationcategory" value="EMERGENCY">EMERGENCY </label> 

</div>
</div>
<hr class="border-t-2 border-blue-500 my-4">
<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>PRE OPERATIVE STATE</h4>
<div class="grid grid-cols-3 gap-4">
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="radio"   name="operationstate" value="FAIR">FAIR STATE </label>
</div>

<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="radio"   name="operationstate" value="POOR">POOR</label>
</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="radio"   name="operationstate" value="BAD">BAD </label>
</div>
</div>
<hr class="border-t-2 border-blue-500 my-4">
<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>TECHNIQUE</h4>
<div class="grid grid-cols-3 gap-4">
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="radio"   name="operationtechnique" value="OPEN">OPEN </label>

</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="radio"   name="operationtechnique" value="SEMI CLOSED">SEMI CLOSED </label>

</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="radio"   name="operationtechnique" value="CLOSED">CLOSED </label>
</div>
</div>
<hr class="border-t-2 border-blue-500 my-4">
<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>ROUTE </h4>
<div class="grid grid-cols-3 gap-4">
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="radio"   name="operationroute" value="FAIR">RECTAL </label>
</div>

<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="radio"   name="operationroute" value="I.V">  VIV </label>

</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="radio"   name="operationroute" value="HYPOTENS">HYPOTENS </label>
</div>
</div>
<hr class="border-t-2 border-blue-500 my-4">
<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>TYPES  OF ANASTHESIA</h4>
<div class="grid grid-cols-3 gap-4">
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="radio"   name="anasthesiatype" value="REGIONAL SPINAL">REGIONAL SPINAL </label>
</div>

<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="radio"   name="anasthesiatype" value="EPIDURAL">EPIDURAL</label>
</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="radio"   name="anasthesiatype" value="LOCAL">LOCAL </label>
</div>
</div>
<hr class="border-t-2 border-blue-500 my-4">
<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>INSUFFLATION HYPOTHERM</h4>
<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>I.V THERAPY</h4>
<div class="grid grid-cols-6 gap-4">
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="ivtherapy[]" value="SALINE">SALINE </label>
</div>

<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="ivtherapy[]" value="GLUCOSE">GLUCOSE</label>
</div>

<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="ivtherapy[]" value="PLASMA">PLASMA </label>
</div>

<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="ivtherapy[]" value="BLOOD">BLOOD</label>
</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="ivtherapy[]" value="PLAS. SUBST.">PLAS. SUBST. </label>
</div>

<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="ivtherapy[]" value="OTHER">OTHER </label>
</div>
</div>
 <br>PRE OPERATIVE  REMARKS
   <textarea class="border-4 border-blue-500 p-2 rounded-lg" placeholder="PRE OPERATIVE REMARKS" name="preoperativeremarks" style="width: 100%; height: 15%" ></textarea>


<hr class="border-t-2 border-blue-500 my-4">
<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>POST OPERATIVE</h4>
<h4  class ="bg-blue-100 text-black-700 font-bold h-15" ><br>P.O COMPLICATIONS</h4>
<div class="grid grid-cols-7 gap-4">
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="postoperationcomplications[]" value="CIRCULATORY">CIRCULATORY </label>
</div>

<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="postoperationcomplications[]" value="RESP. MINOR">RESP. MINOR</label>
</div>

<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="postoperationcomplications[]" value="NEUROLOGY">NEUROLOGY </label>
</div>

<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="postoperationcomplications[]" value="UROLOGY">UROLOGY </label>
</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="postoperationcomplications[]" value="AILMENT">AILMENT </label>
</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="postoperationcomplications[]" value="VOMIT">VOMIT </label>
</div>
<div class="square w-full h-20  flex justify-left items-left">
 <label ><input   class="form-control input-sm"  type="checkbox"   name="postoperationcomplications[]" value="OTHERS">OTHERS </label>
</div>

</div>
 <br>POST OPERATIVE  REMARKS
   <textarea class="border-4 border-blue-500 p-2 rounded-lg" placeholder="POST OPERATIVE REMARKS" name="postoperativeremarks" style="width: 100%; height: 15%" ></textarea>

		<hr class="border-t-2 border-blue-500 my-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>

  </form>
  
  <div id="preoperativediv1" >
<div id="preoperativediv2" >
 <table   class="generictable">
<thead></thead>
<tbody>
<tr>
<td  class="heading">P.NO.<?php print $preoperativedetails->patientnumber; ?> PRE OPERATIVE  RECORDS FROM <?php print $preoperativedetails->date1; ?> TO <?php print $preoperativedetails->date2; ?>  
</td>
</tr>
</tbody>
</table><br>

<table   class="generictable">
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
$x=$connect->query(" SELECT ID,DATE  FROM  preoperativerecord  WHERE PATIENTNUMBER='$preoperativedetails->patientnumber' AND DATE >='$preoperativedetails->date1' AND DATE <='$preoperativedetails->date2' ");

while ($data = $x->fetch_object())
{
	$number+=1;	?> 
<tr>
<td  ><?php print $number;?></td>
<td  ><?php print $data->DATE;?></td>
<td  >
 <a   href="reprintpreoperative.php?trackkey=<?php print $data->ID; ?>"   ><i class="fas fa-print" style="font-size:160%;"></i></a>
 <a title="DELETE" data-toggle="popover" data-trigger="hover" data-content="RECORD" data-placement="left" class="deletepreoperativelink" data-deleteid="<?php print $data->ID; ?>" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>

</td>
</tr>

<?php } 
?>


</tbody>
</table>

</div>
</div>
  