<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="LAB & IMAGING";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class postprocedureresults 
{
public $id=null;	
}

$postprocedureresults =new postprocedureresults;
$postprocedureresults->id=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['id']))));

?>
<script src='pluggins/jquery.autosize.js'></script>
  <script type="text/javascript" >
  $(document).ready(function(){
 $('#labtestparameters').click(function() {
	 $(function(){$('textarea').autosize();});
  var newItem = $('<div class="container"><div class="row">'+
  '<div class="col-sm-4 bg-blue-200 ">'+
  '<input  required style="text-transform:uppercase"  title="INVALID ENTRIES"  name="parameters[]" type="text" size="15" placeholder="ENTER PARAMETER" required="on" class="form-control input-sm" autocomplete="on" />'+
  '</div>'+
  '<div class="col-sm-4"><textarea class="border-4 border-blue-500 p-2 rounded-lg"  name="results[]"  style="width: 100%; height: 15%" ></textarea></div>'+
  '<div class="col-sm-4 bg-blue-200">'+
    '<textarea class="border-4 border-blue-500 p-2 rounded-lg"  name="details[]"  style="width: 100%; height: 15%" ></textarea>'+
  '</div></div></div>');
  
  
  var deleteButton = $('<i class="fas fa-trash-alt delete-btn"></i>');
  
  newItem.append(deleteButton);
  $('#itemdetails').append(newItem);
  
  $('.delete-btn').click(function() {
    $(this).closest('.container').remove();
  });
});	  


  $("#procedureresults").submit(function(event) {
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
            url: 'procedureresults3.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                /* Update page content and hide modal
                $("#deletecompany").load("insuarancerececompanies.php #zones", function() {
                    // Optional: Rebind event handlers if necessary
                });*/
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

	
$(function(){$('textarea').autosize();});
  });
</script>
<style>
table {
    border-collapse: collapse;width:100%;  }
  td, th {
    border: 1px solid black;
    text-align:center;width:25%;
  }
</style>
<br><br>
<br>

<form method="post" action="imagingresults3.php" id="imagingresults"  enctype="multipart/form-data"  class="border border-gray-500 mr-4 ml-4 p-4" >



<?php



$x=$connect->query("SELECT CLIENT,BIRTHDATE,TIMESTAMPDIFF(YEAR, BIRTHDATE, DATE_ADD(NOW(), INTERVAL 10 HOUR)) AS YRS,
TIMESTAMPDIFF(MONTH,BIRTHDATE, DATE_ADD(NOW(), INTERVAL 10 HOUR)) % 12 AS  MONTHS,
pendingsales.DETAILS,GENDER,pendingsales.PATIENTNUMBER,patientsrecord.CLIENT,pendingsales.ID,pendingsales.DETAILS,pendingsales.DATE FROM pendingsales,imagingservices,patientsrecord WHERE 
pendingsales.DETAILS=imagingservices.DETAILS AND pendingsales.PATIENTNUMBER=patientsrecord.ACCOUNT AND pendingsales.ID=$postprocedureresults->id 
  ORDER BY  DATE,pendingsales.ID  ");
if(mysqli_num_rows($x)>0)
{

while ($data = $x->fetch_object())
{ 

 ?>
<h1 class="font-bold text-center underline text-5xl" >P NO.<?php print $data->PATIENTNUMBER.'<br>'.$data->DETAILS;?> RESULTS </h1>
<input type="hidden" value="<?php print $data->PATIENTNUMBER; ?>" name="patientnumber" >
<input type="hidden" value="<?php print $data->DETAILS; ?>" name="procedure" >
<input type="hidden" value="<?php print $postprocedureresults->id; ?>" name="procedureid" >
<input type="hidden" value="<?php print $data->YRS; ?>YEARS <?php print $data->MONTHS; ?>MONTHS" name="age" >
<input type="hidden" value="<?php print $data->GENDER; ?>" name="gender" >
<input type="hidden" value="<?php print $data->CLIENT; ?>" name="name" >


<div class="container"><div class="row font-bold">
<div class="col-sm-2 bg-blue-200  p-2">NAME</div>
<div class="col-sm-2 border border-gray-500 p-2"><?php print $data->CLIENT;   ?></div>
<div class="col-sm-2 bg-blue-200 p-2">GENDER</div>
<div class="col-sm-2 border border-gray-500 p-2"><?php print $data->GENDER; ?></div>
<div class="col-sm-2 bg-blue-200 p-2">AGE</div>
<div class="col-sm-2 border border-gray-500 p-2"><?php print $data->YRS; ?>YEARS <?php print $data->MONTHS; ?>MONTHS</div>


</div>
</div>
<br>
<div class="container"><div class="row font-bold bg-blue-200 p-4">
<div class="col-sm-4  ">PARAMETERS</div>
<div class="col-sm-4">OBSERVATION</div>
<div class="col-sm-4 ">CONCLUSION</div>
</div>
</div>


<div class="container"><div class="row">
<div class="col-sm-11"> 
<div id="itemdetails"></div>
</div>
<div class="col-sm-1">  
<button type="button" class="btn-info btn-sm"  id="labtestparameters"> <i class="fa-solid fa-radiation" style="font-size:160%;"  ></i></button> 
</div>
</div>
</div>

<?php 	
} 
}

?>
<div class="container"><div class="row">
<div class="col-sm-4">SCAN IMAGE
<input  required style="text-transform:uppercase"  name="image" type="file" size="15" placeholder="SELECT IMAGE" required="on" class="form-control input-sm" autocomplete="off" />

</div>
<div class="col-sm-4">DATE
<input  required style="text-transform:uppercase"  name="date" type="date" size="15" placeholder="SELECT DATE" required="on" class="form-control input-sm" autocomplete="off" />
</div>
<div class="col-sm-4"><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</div>
</div>
</div>

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