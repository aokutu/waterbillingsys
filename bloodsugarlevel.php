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

class  bloodsugardetails
{
public $startdate=null;
public $enddate=null;
public $bloodsugarpnumber=null;

}
$bloodsugardetails =new bloodsugardetails;
$bloodsugardetails->startdate=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date1']))));
$bloodsugardetails->enddate=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date2']))));
$bloodsugardetails->bloodsugarpnumber=$_SESSION['patientnumber'];



?>

<script>
   $(document).ready(function(){

 $(document).on('click', '.deletebloodsugarlink', function(event) {
        event.preventDefault();
        
        var deleteid = $(this).data('deleteid');
        var msg = 'DELETE BLOODSUGAR RESULTS';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'deletebloodsugarrresults.php',
                data: {
                    deleteid:deleteid
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#bloodsugardiv1").load("bloodsugarlevel.php #bloodsugardiv2", function() {
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
	
	
$("#bloodsugarlog").submit(function(){
$.post( "bloodsugarlog2.php",
$("#bloodsugarlog").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show'); 
$("#bloodsugardiv1").load("bloodsugarlevel.php #bloodsugardiv2");
return false;});
return false;
});


 });
</script>

<style>
#bloodsugartable td:nth-child(1),td:nth-child(5) { width: 5%;}
#bloodsugartable td:nth-child(2),td:nth-child(3),td:nth-child(4) { width: 25%;}

</style>


<form method="post" id="bloodsugarlog" action="bloodsugarlog.php">
	  <div class="container">
  <div class="row">
  <div class="col-sm-12">
DATE
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  DATE" data-placement="bottom"  style='text-transform:uppercase' name="date"  type="date"   required  title="ENTER DATE "   size="15" placeholder="DATE."  required="on"  class="form-control input-sm"     autocomplete="off" ><br />
 TIME 
<input  title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  TIME" data-placement="bottom" style='text-transform:uppercase' placeholder="ENTER  TIME"  name="time"  type="time"    title="INVALID ENTRIES "   size="15" placeholder="TIME"  required="on"  class="form-control input-sm"     autocomplete="off" ><br />
  BLOOD SUGAR mg/dL
<input  style='text-transform:uppercase' name="bloodsugarlevel"  type="text"   required  title="ENTER BLOOD SUGAR LEVEL "   size="15" placeholder="BLOOD SUGAR LEVEL"  required="on"  class="form-control input-sm"     autocomplete="off" >
<br />
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>

</div>

 
  </div></div>

	  
	  

</form>
<div id="bloodsugardiv1" >
<div id="bloodsugardiv2" >
 <table   class="generictable">
<thead></thead>
<tbody>
<tr>
<td  class="heading">P.NO.<?php print $bloodsugardetails->bloodsugarpnumber; ?> BLOOD SUGAR LEVELS RECORDS FROM <?php print $bloodsugardetails->startdate; ?> TO <?php print $bloodsugardetails->enddate; ?>  
<i onclick="window.print()" style="font-size:200%;" class="fas fa-print"></i>
</td>
</tr>
</tbody>
</table><br>

 <table  id="bloodsugartable" class="generictable">
<thead></thead>
<tbody>
<tr>
<td  class="heading" >REFF</td>
<td  class="heading" >DATE </td>
<td  class="heading" >TIME</td>
<td  class="heading" >BLOOD SUGAR LEVEL</td>
<td  class="deletecolumn" >DELETE </td>

</tr>
<?php 
$number=0;
//WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND DATE >='$bloodsugardetails->startdate' AND DATE <='$patientdetails->date2'
$x=$connect->query(" SELECT ID,DATE,TIME,BLOODSUGARLEVEL  FROM  bloodsugarrecord  WHERE 
DATE>='$bloodsugardetails->startdate' AND DATE <='$bloodsugardetails->enddate' AND PATIENTNUMBER ='$bloodsugardetails->bloodsugarpnumber' ");

while ($data = $x->fetch_object())
{
	$number+=1;	?> 
	
	<tr>
<td   ><?php print $number; ?></td>
<td   ><?php print $data->DATE; ?> </td>
<td   ><?php print $data->TIME; ?></td>
<td   ><?php print $data->BLOODSUGARLEVEL; ?></td>
<td class="deletecolumn"  >
 <a title="DELETE" data-toggle="popover" data-trigger="hover" data-content="RECORD" data-placement="left" class="deletebloodsugarlink" data-deleteid="<?php print $data->ID; ?>" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
 </td>

</tr>

<?php } 
?>
</tbody>
</table>

</div>
</div>