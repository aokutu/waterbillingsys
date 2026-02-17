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
  var newItem = $('<div class="container"><div class="row">'+
  '<div class="col-sm-4 bg-blue-200 ">'+
  '<input  required style="text-transform:uppercase"  title="INVALID ENTRIES"  name="parameters[]" type="text" size="15" placeholder="ENTER PARAMETER" required="on" class="form-control input-sm" autocomplete="on" />'+
  '</div>'+
  '<div class="col-sm-4"><input  required style="text-transform:uppercase"  title="INVALID ENTRIES" id="item" name="results[]" type="text" size="15" placeholder="ENTER RESULTS" required="on" class="form-control input-sm" autocomplete="on" /></div><div class="col-sm-4 bg-blue-200">'+
    '<input  required style="text-transform:uppercase"  title="INVALID ENTRIES" id="item" name="range[]" type="text" size="15" placeholder="ENTER RANGE"  class="form-control input-sm" autocomplete="on" />'+
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

<form method="post" action="procedureresults3.php" id="procedureresultsx"  class="border border-gray-500 mr-4 ml-4 p-4" >



<?php



$x=$connect->query("SELECT CLIENT,BIRTHDATE,TIMESTAMPDIFF(YEAR, BIRTHDATE, DATE_ADD(NOW(), INTERVAL 10 HOUR)) AS YRS,
TIMESTAMPDIFF(MONTH,BIRTHDATE, DATE_ADD(NOW(), INTERVAL 10 HOUR)) % 12 AS  MONTHS,
pendingsales.DETAILS,GENDER,pendingsales.PATIENTNUMBER,patientsrecord.CLIENT,pendingsales.ID,pendingsales.DETAILS,pendingsales.DATE FROM pendingsales,services,patientsrecord WHERE 
pendingsales.DETAILS=services.DETAILS AND pendingsales.PATIENTNUMBER=patientsrecord.ACCOUNT AND pendingsales.ID=$postprocedureresults->id 
  ORDER BY  DATE,pendingsales.ID  LIMIT 1 ");
if(mysqli_num_rows($x)>0)
{

while ($data = $x->fetch_object())
{ 
$pateintnumber=$data->PATIENTNUMBER;
$procedureid =$postprocedureresults->id
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
<div class="col-sm-4">RESULTS</div>
<div class="col-sm-4 ">RANGE</div>
</div>
</div>


<div class="container"><div class="row">
<div class="col-sm-11"> 
<div id="itemdetails"></div>
</div>
<div class="col-sm-1">  
<button type="button" class="btn-info btn-sm"  id="labtestparameters"> <i class="fa-solid fa-microscope" style="font-size:160%;"  ></i></button> 
</div>
</div>
</div>


<div class="container"><div class="row">
<div class="col-sm-4">DATE</div>
<div class="col-sm-4">
<input  required style="text-transform:uppercase"  name="date" type="date" size="15" placeholder="SELECT DATE" required="on" class="form-control input-sm" autocomplete="off" />
</div>
<div class="col-sm-4"><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</div>
</div>
</div>

</form>

<form method="post" action="completebloodcounttest.php" id="procedureresultsx"  class="border border-gray-500 mr-4 ml-4 p-4" >
<h1 class="font-bold text-center underline text-5xl" >COMPLETE BLOOD COUNT RESULTS </h1>

<input type="hidden" value="<?php print $pateintnumber; ?>" name="patientnumber" >
<input type="hidden" value="<?php print $data->DETAILS; ?>" name="procedure" >
<input type="hidden" value="<?php print $data->YRS; ?>YEARS <?php print $data->MONTHS; ?>MONTHS" name="age" >
<input type="hidden" value="<?php print $data->GENDER; ?>" name="gender" >
<input type="hidden" value="<?php print $data->CLIENT; ?>" name="name" >
<input type="hidden" value="<?php print $postprocedureresults->id; ?>" name="procedureid" >

<div class="container">
<div class="row font-bold">
<div class="col-sm-1 bg-blue-200  p-2">PARAMETERS</div>
<div class="col-sm-2 bg-blue-200 p-2">RESULT</div>
<div class="col-sm-2 bg-blue-200 p-2">FLAG</div>
<div class="col-sm-1 bg-blue-200 p-2">REFF VALUE</div>

<div class="col-sm-1 bg-blue-200  p-2">PARAMETERS</div>
<div class="col-sm-2 bg-blue-200 p-2">RESULT</div>
<div class="col-sm-2 bg-blue-200 p-2">FLAG</div>
<div class="col-sm-1 bg-blue-200 p-2">REFF VALUE</div>



</div>

<div class="row font-bold">
<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="WBC"  readonly type="text" size="15" placeholder="ENTER WBC" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="wbc" type="text" size="15" placeholder="ENTER WBC" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="wbcflag" type="text" size="15" placeholder="ENTER WBC " required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="4.0-10.0"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="LYMPH%"  readonly type="text" size="15" placeholder="ENTER LYMPH%" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="lymphpercentage" type="text" size="15" placeholder="ENTER LYMPH%" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="lymphpercentageflag" type="text" size="15" placeholder="ENTER LYMPH% FLAG " required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="20.0-40.0"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>


<div class="row font-bold">
<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="GRAN %"  readonly type="text" size="15" placeholder="ENTER GRAN %" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="granpercentage" type="text" size="15" placeholder="ENTER GRAN %" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="granpercentageflag" type="text" size="15" placeholder="ENTER GRAN % FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="50.0-70.0"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="MID %"  readonly type="text" size="15" placeholder="ENTER MID %" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="midpercentage" type="text" size="15" placeholder="ENTER MID %" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="midpercentageflag" type="text" size="15" placeholder="ENTER MID % FLAG " required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="3.0-9.0"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>


<div class="row font-bold">
<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="LYMPH #"  readonly type="text" size="15" placeholder="ENTER LYMPH #" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="lymph" type="text" size="15" placeholder="ENTER LYMPH #" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="lymphflag" type="text" size="15" placeholder="ENTER LYMPH  # FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="0.8-4.00"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="GRAN #"  readonly type="text" size="15" placeholder="ENTER GRAN #" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="gran" type="text" size="15" placeholder="ENTER GRAN #" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="granflag" type="text" size="15" placeholder="ENTER GRAN # FLAG " required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="2.00-7.00"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>



<div class="row font-bold">
<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="MID #"  readonly type="text" size="15" placeholder="ENTER MID #" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="mid" type="text" size="15" placeholder="ENTER MID #" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="midflag" type="text" size="15" placeholder="ENTER MID  # FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="0.10-0.90"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="HCT %"  readonly type="text" size="15" placeholder="ENTER GRAN #" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="hctpercentage" type="text" size="15" placeholder="ENTER HCT %" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="hctpercentageflag" type="text" size="15" placeholder="ENTER HCT % FLAG " required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="35.0-50.0"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


</div>


<div class="row font-bold">
<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="RBC"  readonly type="text" size="15" placeholder="ENTER RBC" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="rbc" type="text" size="15" placeholder="ENTER RBC" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="rbcflag" type="text" size="15" placeholder="ENTER RBC FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="4.00-5.20"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="HGB"  readonly type="text" size="15" placeholder="ENTER HGB" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="hgb" type="text" size="15" placeholder="ENTER HGB" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="hgbflag" type="text" size="15" placeholder="ENTER HGB FLAG " required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="12.00-16.00"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


</div>


<div class="row font-bold">
<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="MCV"  readonly type="text" size="15" placeholder="ENTER MCV" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="mcv" type="text" size="15" placeholder="ENTER MCV" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="mcvflag" type="text" size="15" placeholder="ENTER MCV FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="82-100"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="MCH"  readonly type="text" size="15" placeholder="ENTER MCH" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="mch" type="text" size="15" placeholder="ENTER MCH" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="mchflag" type="text" size="15" placeholder="ENTER MCH FLAG " required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="27-34"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


</div>

<div class="row font-bold">
<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="RDW-CV%"  readonly type="text" size="15" placeholder="ENTER RDW-CV%" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="rdwcvpercentage" type="text" size="15" placeholder="ENTER RDW-CV%" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="rdwcvpercentageflag" type="text" size="15" placeholder="ENTER RDW-CV% FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="11.5-14.5"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="MCHC"  readonly type="text" size="15" placeholder="ENTER MCHC" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="mchc" type="text" size="15" placeholder="ENTER MCHC" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="mchcflag" type="text" size="15" placeholder="ENTER MCHC FLAG " required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="32-36"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


</div>

<div class="row font-bold">
<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="RW-SD"  readonly type="text" size="15" placeholder="ENTER RW-SD" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="rwsd" type="text" size="15" placeholder="ENTER RW-SD" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="rwsdflag" type="text" size="15" placeholder="ENTER RW-SD FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="35.0-56-0"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="PLT"  readonly type="text" size="15" placeholder="ENTER PLT" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="plt" type="text" size="15" placeholder="ENTER PLT" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="pltflag" type="text" size="15" placeholder="ENTER PLT FLAG " required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="150-450"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


</div>

<div class="row font-bold">
<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="MPV"  readonly type="text" size="15" placeholder="ENTER MPV" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="mpv" type="text" size="15" placeholder="ENTER MPV" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="mpvflag" type="text" size="15" placeholder="ENTER MPV FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="7.00-11.00"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="PDW"  readonly type="text" size="15" placeholder="ENTER PDW" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="pdw" type="text" size="15" placeholder="ENTER PDW" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="pdwflag" type="text" size="15" placeholder="ENTER PDW FLAG " required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="9.00-17.00"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


</div>

<div class="row font-bold">
<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="PCT"  readonly type="text" size="15" placeholder="ENTER PCT" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="pct" type="text" size="15" placeholder="ENTER PCT" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="pctflag" type="text" size="15" placeholder="ENTER PCT FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="0.108-0.282"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="P-LCR"  readonly type="text" size="15" placeholder="ENTER P-LCR" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="plcr" type="text" size="15" placeholder="ENTER P-LCR" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="plcrflag" type="text" size="15" placeholder="ENTER P-LCR FLAG " required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="11.00-45.00"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


</div>

<div class="row font-bold">
<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="PLCC"  readonly type="text" size="15" placeholder="ENTER P-LCC" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="plcc" type="text" size="15" placeholder="ENTER P-LCC" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="plccflag" type="text" size="15" placeholder="ENTER P-LCC FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-1 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="30-90"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>


<div class="col-sm-1 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="P-LCR"  readonly type="text" size="15" placeholder="ENTER P-LCR" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-2 bg-blue-200 p-2"> 
<input  required style="text-transform:uppercase"  name="date" type="date" size="15" placeholder="SELECT DATE" required="on" class="form-control input-sm" autocomplete="off" />
</div>
<div class="col-sm-2 bg-blue-200 p-2">
<button type="submit" class="btn-info btn-sm" >SUBMIT</button>
</div>
<div class="col-sm-1 bg-blue-200 p-2">
<button type="reset" class="btn-info btn-sm" >RESET</button>
</div>


</div>

</div>


</form>
 
<br>

<form method="post" action="urinalysis.php" id="procedureresultsx"  class="border border-gray-500 mr-4 ml-4 p-4" >
<h1 class="font-bold text-center underline text-5xl" >URINALYSIS RESULTS </h1>
<input type="hidden" value="<?php print $data->PATIENTNUMBER; ?>" name="patientnumber" >
<input type="hidden" value="<?php print $data->DETAILS; ?>" name="procedure" >
<input type="hidden" value="<?php print $postprocedureresults->id; ?>" name="procedureid" >
<input type="hidden" value="<?php print $data->YRS; ?>YEARS <?php print $data->MONTHS; ?>MONTHS" name="age" >
<input type="hidden" value="<?php print $data->GENDER; ?>" name="gender" >
<input type="hidden" value="<?php print $data->CLIENT; ?>" name="name" >

<div class="container">
<div class="row font-bold">
<div class="col-sm-3 bg-blue-200  p-2">PARAMETERS</div>
<div class="col-sm-3 bg-blue-200 p-2">RESULT</div>
<div class="col-sm-3 bg-blue-200 p-2">FLAG</div>
<div class="col-sm-3 bg-blue-200 p-2">REFF VALUE</div>

</div>

<div class="row font-bold">
<div class="col-sm-3 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="COLOR"  readonly type="text" size="15" placeholder="ENTER COLOR" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-3 bg-blue-200 p-2"> 
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="color" type="text" size="15" placeholder="ENTER COLOR" required="on" class="form-control input-sm" autocomplete="on" />
</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="colorflag" type="text" size="15" placeholder="ENTER COLOR FLAG " required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="AMBER"  readonly type="text" size="15" placeholder="ENTER COLOR" required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>
<div class="row font-bold">
<div class="col-sm-3 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="APPEARANCE"  readonly type="text" size="15" placeholder="ENTER APPEARANCE" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="appearance" type="text" size="15" placeholder="ENTER APPEARANCE" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="appearanceflag" type="text" size="15" placeholder="ENTER APPEARANCE FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="CLEAR"  readonly type="text" size="15" placeholder="ENTER CLEAR" required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>
<div class="row font-bold">
<div class="col-sm-3 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="LEUKOCYTES"  readonly type="text" size="15" placeholder="ENTER LEUKOCYTES" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="leukocytes" type="text" size="15" placeholder="ENTER LEUKOCYTES" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="leukocytesflag" type="text" size="15" placeholder="ENTER LEUKOCYTES FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="NIL"  readonly type="text" size="15" placeholder="ENTER NIL" required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>
<div class="row font-bold">
<div class="col-sm-3 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="NITRITE"  readonly type="text" size="15" placeholder="ENTER NITRITE" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="nitrite" type="text" size="15" placeholder="ENTER NITRITE" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="nitriteflag" type="text" size="15" placeholder="ENTER NITRITE FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="NEG"  readonly type="text" size="15" placeholder="ENTER NIL" required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>
<div class="row font-bold">
<div class="col-sm-3 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="UROBILINOGEN"  readonly type="text" size="15" placeholder="ENTER UROBILINOGEN" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="urobilinogen" type="text" size="15" placeholder="ENTER UROBILINOGEN" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="urobilinogenflag" type="text" size="15" placeholder="ENTER UROBILINOGEN FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="1.7-30 umol/L"  readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>


<div class="row font-bold">
<div class="col-sm-3 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="PROTEIN"  readonly type="text" size="15" placeholder="ENTER PROTEIN" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="protein" type="text" size="15" placeholder="ENTER PROTEIN" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="proteinflag" type="text" size="15" placeholder="ENTER PROTEIN FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="NIL"   readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>


<div class="row font-bold">
<div class="col-sm-3 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="PH"  readonly type="text" size="15" placeholder="ENTER PH" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="ph" type="text" size="15" placeholder="ENTER PH" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="phflag" type="text" size="15" placeholder="ENTER PH FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="4.5-8.0"   readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>



<div class="row font-bold">
<div class="col-sm-3 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="BLOOD"  readonly type="text" size="15" placeholder="ENTER BLOOD" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="blood" type="text" size="15" placeholder="ENTER BLOOD" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="bloodflag" type="text" size="15" placeholder="ENTER BLOOD FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="NIL"   readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>

<div class="row font-bold">
<div class="col-sm-3 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="SPECIFIC GRAVITY"  readonly type="text" size="15" placeholder="ENTER SPECIFIC GRAVITY" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="specificgravity" type="text" size="15" placeholder="ENTER SPECIFIC GRAVITY" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="specificgravityflag" type="text" size="15" placeholder="ENTER SPECIFIC GRAVITY FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="1.0005-1.030"   readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>

<div class="row font-bold">
<div class="col-sm-3 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="KETONE"  readonly type="text" size="15" placeholder="ENTER KETONE" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="ketone" type="text" size="15" placeholder="ENTER KETONE" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="ketoneflag" type="text" size="15" placeholder="ENTER KETONE FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="NIL"   readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>


<div class="row font-bold">
<div class="col-sm-3 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="BILIRUBIN"  readonly type="text" size="15" placeholder="ENTER BILIRUBIN" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="bilirubin" type="text" size="15" placeholder="ENTER BILIRUBIN" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="bilirubinflag" type="text" size="15" placeholder="ENTER BILIRUBIN FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="NIL"   readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>



<div class="row font-bold">
<div class="col-sm-3 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="GLUCOSE"  readonly type="text" size="15" placeholder="ENTER GLUCOSE" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="glucose" type="text" size="15" placeholder="ENTER GLUCOSE" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="glucoseflag" type="text" size="15" placeholder="ENTER GLUCOSE FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="NIL"   readonly type="text" size="15"  required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>

<div class="row font-bold">
<div class="col-sm-3 bg-blue-200  p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" value="MICROSCOPY"  readonly type="text" size="15" placeholder="ENTER MICROSCOPY" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="microscopy" type="text" size="15" placeholder="ENTER MICROSCOPY" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="microscopyflag" type="text" size="15" placeholder="ENTER MICROSCOPY FLAG" required="on" class="form-control input-sm" autocomplete="on" />

</div>
<div class="col-sm-3 bg-blue-200 p-2">
<input  required autocomplete="off"  style="text-transform:uppercase"  title="INVALID ENTRIES" name="date" type="date" size="15" placeholder="ENTER DATE" required="on" class="form-control input-sm" autocomplete="on" />

</div>

</div>
</div>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm" >RESET</button>
</form>

<?php 	
} 
}

?>

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