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

class theatreoperativenotes 
{
	
public $patientnumber=null;
public $date1=null;
public $date2=null; 

}

$theatreoperativenotes=new theatreoperativenotes;
$theatreoperativenotes->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));
$theatreoperativenotes->date1=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date1']))));
$theatreoperativenotes->date2=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date2']))));

?>	 
<style>
 #theatreoperationnotestable td:nth-child(1) {width: 2%;}
</style>
<script>
   $(document).ready(function(){
	   
	   
 $(document).on('click', '.deleteoperationnoteslink', function(event) {
        event.preventDefault();
        
        var deleteid = $(this).data('deleteid');
        var msg = 'DELETE OPERATION NOTES ';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'deletetheatreoperationnotes.php',
                data: {
                    deleteid:deleteid
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#theatrenotesdiv1").load("theatreoperativenotes.php #theatrenotesdiv2", function() {
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
	
	
$("#theatreoperationnotes").submit(function(){
$('#prepostmessage').modal('show');
$.post( "theatreoperationnotes2.php",
$("#theatreoperationnotes").serialize(),
function(data){
$("#content").load("message.php #content");
 $('#prepostmessage').modal('hide'); 
$('#message').modal('show'); 
$("#theatrenotesdiv1").load("theatreoperativenotes.php #theatrenotesdiv2");
return false;});
return false;
});

});
</script>
 
	<form method="post"  action="theatreoperationnotes2.php" id="theatreoperationnotes" >
<hr class="border-t-2 border-blue-500 my-4">
<div class="grid grid-cols-3 gap-4">

<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="DIAGNOSIS" data-placement="top" placeholder="DIAGNOSIS" class="form-control input-sm"  type="text"  autocomplete="off" required style='text-transform:uppercase' name="diagnosis">
</div>


<div class="square w-full h-20  flex justify-left items-left">DATE
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="DATE" data-placement="top" placeholder="DATE" class="form-control input-sm"  type="date" autocomplete="off" required  name="date">
</div>

<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="OPERATION" data-placement="top" placeholder="OPERATION" class="form-control input-sm"  type="text" autocomplete="off" required style='text-transform:uppercase'  name="operation">
</div>


</div>

<hr class="border-t-2 border-blue-500 my-4">
<div class="grid grid-cols-5 gap-4">

<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="SURGEON" data-placement="top" placeholder="SURGEON" class="form-control input-sm"  type="text"  autocomplete="off" required style='text-transform:uppercase'  name="surgeon">
</div>


<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="ASET SURGEON" data-placement="top" placeholder="ASET SURGEON" class="form-control input-sm"  type="text" autocomplete="off" required style='text-transform:uppercase'  name="asetsurgeon">
</div>

<div class="square w-full h-20  flex justify-left items-left">
<input title="NAME" data-toggle="popover" data-trigger="hover" data-content="OF THE SCRUB NURSE" data-placement="top" placeholder="NAME OF THE SCRUB NURSE" class="form-control input-sm"  type="text" autocomplete="off" required style='text-transform:uppercase'  name="scrubnurse">
</div>


<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="ANASTHESIST" data-placement="top" placeholder="ANASTHESIST" class="form-control input-sm"  type="text"  autocomplete="off" required style='text-transform:uppercase'  name="anasthesist">
</div>


<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="TYPE OF ANASTHESIA" data-placement="top" placeholder="TYPE OF ANASTHESIA" class="form-control input-sm"  type="text" autocomplete="off" required style='text-transform:uppercase'  name="anasthesiatype">
</div>



</div>
<hr class="border-t-2 border-blue-500 my-4">
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="INSISION (S)" data-placement="top" placeholder="INSISION (S)" class="form-control input-sm"  type="text"  autocomplete="off" style='text-transform:uppercase'  required name="insision">
<br>
  <textarea class="border-4 border-blue-500 p-2 rounded-lg" placeholder="OPERATION NOTES" name="operationprocedurenotes" style="width: 100%; height: 15%" ></textarea>
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>

		<hr class="border-t-2 border-blue-500 my-4">
		
</form>	


<div id="theatrenotesdiv1" >
<div id="theatrenotesdiv2" >
 <table   class="generictable">
<thead></thead>
<tbody>
<tr>
<td  class="heading">P.NO.<?php print $theatreoperativenotes->patientnumber; ?> THEATRE OPERATION  RECORDS FROM <?php print $theatreoperativenotes->date1; ?> TO <?php print $theatreoperativenotes->date2; ?>  
</td>
</tr>
</tbody>
</table><br>


 <table id="theatreoperationnotestable"   >
<thead></thead>
<tbody>
<tr>
<td  class="heading">REFF</td>
<td  class="heading">DATE</td>
<td  class="heading">OPERATION</td>
<td  class="heading">SURGEON</td>
<td  class="heading">ACTION</td>
</tr>
<?php 
$number=0;
//WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND DATE >='$bloodsugardetails->startdate' AND DATE <='$patientdetails->date2'
$x=$connect->query(" SELECT ID,DATE,OPERATION,SURGEON  FROM  theatreoperationnotes  WHERE PATIENTNUMBER='$theatreoperativenotes->patientnumber' AND DATE >='$theatreoperativenotes->date1' AND DATE <='$theatreoperativenotes->date2' ");

while ($data = $x->fetch_object())
{
	$number+=1;	?> 
	
	<tr>
<td   ><?php print $number; ?></td>
<td   ><?php print $data->DATE; ?> </td>
<td   ><?php print $data->OPERATION; ?></td>
<td   ><?php print $data->SURGEON; ?></td>
<td class="deletecolumn"  >
 <a   href="reprinttheatreoperationnotes.php?trackkey=<?php print $data->ID; ?>"   ><i class="fas fa-print" style="font-size:160%;"></i></a>
 <a title="DELETE" data-toggle="popover" data-trigger="hover" data-content="RECORD" data-placement="left" class="deleteoperationnoteslink" data-deleteid="<?php print $data->ID; ?>" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
 </td>

</tr>

<?php } 
?>


</tbody>
</table>

</div>
</div>




	  
	  
	