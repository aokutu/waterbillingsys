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

class fluidsoutput 
{
	
public $patientnumber=null;
public $date1=null;
public $date2=null; 

}

$fluidsoutput=new fluidsoutput;
$fluidsoutput->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));
$fluidsoutput->date1=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date1']))));
$fluidsoutput->date2=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date2']))));


?>
<style>
 #fluidsoutputtable td:nth-child(1),td:nth-child(2),td:nth-child(3),td:nth-child(9) {width: 2%;}
 
</style>

<script>
   $(document).ready(function(){
	   
	   
 $(document).on('click', '.deletefluidsoutputlink', function(event) {
        event.preventDefault();
        
        var deleteid = $(this).data('deleteid');
        var msg = 'DELETE OPERATION NOTES ';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'deletefluidsoutput.php',
                data: {
                    deleteid:deleteid
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#fluidsoutputdiv1").load("fluidsoutput.php #fluidsoutputdiv2", function() {
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
	
	
$("#fluidsoutput").submit(function(){
$('#prepostmessage').modal('show');
$.post( "fluidsoutput2.php",
$("#fluidsoutput").serialize(),
function(data){
$("#content").load("message.php #content");
 $('#prepostmessage').modal('hide'); 
$('#message').modal('show'); 
$("#fluidsoutputdiv1").load("fluidsoutput.php #fluidsoutputdiv2");
return false;});
return false;
});

});
</script>

  <form method="post" id="fluidsoutput" action="fluidsoutput2.php">
	  <div class="container">
   <div class="row">
  <div class="col-sm-6">
  <input style='text-transform:uppercase' readonly required  name="patientnumber"  value="<?php print $_SESSION['patientnumber'];?>" type="hidden"    size="15" placeholder="PATIENT NUMBER"   class="form-control input-sm"     autocomplete="off" >
DATE
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="DATE" data-placement="top" style='text-transform:uppercase' name="date"  type="date"   required  title="ENTER DATE "   size="15" placeholder="DATE."  required="on"  class="form-control input-sm"     autocomplete="off" ><br />
 TIME  
<input  title="INFO" data-toggle="popover" data-trigger="hover" data-content="TIME" data-placement="top"style='text-transform:uppercase' placeholder="ENTER  TIME"  name="time"  type="time"    title="INVALID ENTRIES "   size="15" placeholder="TIME"  required="on"  class="form-control input-sm"     autocomplete="off" ><br />
  WEIGHT 
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="BODY WEIGHT" data-placement="top" style='text-transform:uppercase' name="bodyweight"  type="text"   required  title="ENTER BODY WEIGHT"   size="15" placeholder="BODY WEIGHT"  required="on"  class="form-control input-sm"     autocomplete="off" >
<hr class="border-t-2 border-blue-500 my-4">


</div>
  <div class="col-sm-6"> 
  NASTRO-GASTRIC-SUCTION
<input title="NASTRO" data-toggle="popover" data-trigger="hover" data-content="GASTRIC SUCTION" data-placement="top"  style='text-transform:uppercase' name="nastrogastricsuction"  type="text"   required  title="NASTRO-GASTRIC-SUCTION"   size="15" placeholder="NASTRO-GASTRIC-SUCTION"  required="on"  class="form-control input-sm"     autocomplete="off" >
<hr class="border-t-2 border-blue-500 my-4">VOMITUS
<input  title="INFO" data-toggle="popover" data-trigger="hover" data-content="VOMITUS" data-placement="top"  style='text-transform:uppercase' name="vomitus"  type="text"   required  title="VOMITUS"   size="15" placeholder="VOMITUS"  required="on"  class="form-control input-sm"     autocomplete="off" >

<hr class="border-t-2 border-blue-500 my-4">DRAIN STOOL OR FISTULA
<input title="DRAIN STOOL" data-toggle="popover" data-trigger="hover" data-content="OR FISTULA" data-placement="top"  style='text-transform:uppercase' name="drainstoolfistula"  type="text"   required  title="DRAIN STOOL OR FISTULA"   size="15" placeholder="DRAIN STOOL OR FISTULA"  required="on"  class="form-control input-sm"     autocomplete="off" >
<hr class="border-t-2 border-blue-500 my-4">
URINE
  <div class="grid grid-cols-2 gap-4">
  <!-- Row 1 -->
  <div class="square w-full h-20  flex justify-center items-center">AMOUNT
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="URINE VOLUME (mls)" data-placement="top"  style='text-transform:uppercase' name="urinevolume"  type="text"   required  title="URINE AMOUNT"   size="15" placeholder="URINE AMOUNT"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
  <div class="square w-full h-20   flex justify-center items-center">S.P,GR
 <input title="INFO" data-toggle="popover" data-trigger="hover" data-content="S.P,GR" data-placement="top"   style='text-transform:uppercase' name="oralintake"  type="text"   required  title="ORAL INTAKE"   size="15" placeholder="ORAL INTAKE"  required="on"  class="form-control input-sm"     autocomplete="off" >
 
  </div>
</div>
<br>
<br>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>


  </div>
  
  </div>

  </div>
</form>

<div id="fluidsoutputdiv1" >
<div id="fluidsoutputdiv2" >
 <table   class="generictable">
<thead></thead>
<tbody>
<tr>
<td  class="heading">P.NO.<?php print $fluidsoutput->patientnumber; ?> FLUIDS OUTPUT  RECORDS FROM <?php print $fluidsoutput->date1; ?> TO <?php print $fluidsoutput->date2; ?>  <i onclick="window.print()" style="font-size:200%;" class="fas fa-print"></i>
</td>
</tr>
</tbody>
</table><br>




 <table id="fluidsoutputtable"   >
<thead></thead>
<tbody>
<tr>
<td  class="heading">REFF</td>
<td  class="heading">DATE</td>
<td  class="heading">TIME</td>
<td  class="heading">WEIGHT</td>
<td  class="heading">NASTRO-GASTRIC-SUCTION</td>
<td  class="heading">VOMITUS</td>
<td  class="heading">DRAIN STOOL OR FISTULA</td>
<td  class="heading">URINE </td>

<td  class="deletecolumn">ACTION</td>
</tr>

<?php 
$number=0;
// WHERE PATIENTNUMBER='$fluidsoutput->patientnumber' AND DATE >='$fluidsoutput->date1' AND DATE <='$fluidsoutput->date2'
$x=$connect->query(" SELECT ID,PATIENTNUMBER, DATE, TIME, WEIGHT,
 NASTROGASTRICSUCTION, VOMITUS, DRAINSTOOLFISTULA, URINEVOLUME  FROM  fluidsoutput WHERE PATIENTNUMBER='$fluidsoutput->patientnumber' AND DATE >='$fluidsoutput->date1' AND DATE <='$fluidsoutput->date2'  ");

while ($data = $x->fetch_object())
{
	$number+=1;	?>
<tr>
<td  class="heading"><?php print $number; ?></td>
<td  class="heading"><?php print $data->DATE; ?></td>
<td  class="heading"><?php print $data->TIME; ?></td>
<td  class="heading"><?php print $data->WEIGHT; ?></td>
<td  class="heading"><?php print $data->NASTROGASTRICSUCTION; ?></td>
<td  class="heading"><?php print $data->VOMITUS; ?></td>
<td  class="heading"><?php print $data->DRAINSTOOLFISTULA; ?></td>
<td  class="heading"><?php print $data->URINEVOLUME; ?></td>
<td  class="deletecolumn">
 <a title="DELETE" data-toggle="popover" data-trigger="hover" data-content="RECORD" data-placement="left" class="deletefluidsoutputlink" data-deleteid="<?php print $data->ID; ?>" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>


</td>
</tr>	
	
	<?php } 
?>

</tbody>
</table>
</div>
</div>

