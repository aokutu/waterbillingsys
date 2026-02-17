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

class reportdetails 
{
	
public $reportid=null;

}
$reportdetails =new reportdetails;
if(isset($_GET['reportid']))
{
$reportdetails->reportid=$connect->real_escape_string($_GET['reportid']);

}
else if(isset($_SESSION['editid']))
{
$reportdetails->reportid=$connect->real_escape_string($_SESSION['editid']);

}
?>
<script   src="pluggins/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src='pluggins/jquery.autosize.js'></script>
 <link rel="stylesheet" href="icons/css/all.css">
  <link href="stylesheets/tailwind.css" rel="stylesheet">
  <script>
$(document).ready(function() {
$('[data-toggle="popover"]').popover();
   $(document).on('click', '.deleteid', function(event) {
        event.preventDefault();
        
        var deleteid = $(this).data('deleteid');
        var msg = 'DELETE REPORT ';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        return false;
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'deletedischargereport.php',
                data: {
                    deleteid: deleteid
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                
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
	
	   });

</script>
	
<h4 class="text-2xl md:text-3xl font-bold text-gray-800 bg-gray-100 p-4 mb-4 border-b-2 border-gray-300 shadow-md text-center">
  PATIENT DISCHARGE REPORT
</h4>
<table class="min-w-full bg-white border border-gray-300">
<tr>
      <td class="border border-gray-300 px-4 py-2">


<?php 
 
$x=$connect->query("SELECT patientdischargereport.ID,CLIENT,PATIENTNUMBER, AGE,patientdischargereport.GENDER, MEDICALOFFICER, ADMISSIONDATE, DISCHARGEDATE,DIAGNOSIS, 
CHIEFCOMPLAIN, PRESEMTINGILLNESS, ONEXAMINATION,SUMMARY 
FROM patientdischargereport,patientsrecord WHERE  patientdischargereport.ID='$reportdetails->reportid' AND PATIENTNUMBER =ACCOUNT ");
while ($data = $x->fetch_object())
{ 
?>

<table class="min-w-full bg-white border border-gray-300">
  <thead>
    <tr class="bg-blue-300 text-white">
      <th class="w-1/4  border border-gray-300 px-4 py-2"></th>
      <th class="w-1/4  border border-gray-300 px-4 py-2">PERSONAL INFORMATION</th>
      <th class="w-1/4  border border-gray-300 px-4 py-2"></th>
    </tr>
  </thead>
  <tbody>
    <tr class="hover:bg-green-100">
      <td class="w-1/4  border border-gray-300 px-4 py-2"><div class="font-bold" >NAMES</div><br><?php print $data->CLIENT; ?></td>
      <td class="w-1/4  border border-gray-300 px-4 py-2"><div class="font-bold" >PATIENT NUMBER</div><br><?php print $data->PATIENTNUMBER; ?></td>
      <td class="w-1/4  border border-gray-300 px-4 py-2"><div class="font-bold" >ADMISSIONDATE</div><br><?php print $data->ADMISSIONDATE; ?></td>
    </tr>
    <tr class="hover:bg-green-100">
      <td class="w-1/4  border border-gray-300 px-4 py-2"><div class="font-bold" >AGE</div><br><?php print $data->AGE; ?></td>
      <td class="w-1/4  border border-gray-300 px-4 py-2"><div class="font-bold" >SEX</div><br><?php print $data->GENDER; ?></td>
      <td class="w-1/4  border border-gray-300 px-4 py-2"><div class="font-bold" >DISCHARGEDATE</div><br><?php print $data->DISCHARGEDATE; ?></td>
    </tr>
  </tbody>
</table>


<table class="min-w-full bg-white border border-gray-300">
  <thead>
    <tr class="bg-blue-300 text-white">
      <th class="w-1/4  border border-gray-300 px-4 py-2"></th>
      <th class="w-1/4  border border-gray-300 px-4 py-2">MEDICAL DETAILS</th>
      <th class="w-1/4  border border-gray-300 px-4 py-2"></th>
    </tr>
  </thead>
  <tbody>
    <tr class="hover:bg-green-100">
      <td class="w-1/4  border border-gray-300 px-4 py-2 align-top"><div class="font-bold " >DIAGNOSIS</div><br><?php print $data->DIAGNOSIS; ?><br></td>
      <td class="w-1/4  border border-gray-300 px-4 py-2"><div class="font-bold" >CHIEF COMPLAIN</div><br><?php print $data->CHIEFCOMPLAIN; ?></td>
      <td class="w-1/4  border border-gray-300 px-4 py-2"><div class="font-bold" >PRESENTING ILLNESS</div><br><?php print $data->PRESEMTINGILLNESS; ?></td>
    </tr>
    <tr class="hover:bg-green-100">
      <td class="w-1/4  border border-gray-300 px-4 py-2"><div class="font-bold" >ON EXAINATION</div><br><?php print $data->ONEXAMINATION; ?></td>
      <td class="w-1/4  border border-gray-300 px-4 py-2"><div class="font-bold" >SUMMARY</div><br><?php print $data->SUMMARY; ?></td>
      <td class="w-1/4  border border-gray-300 px-4 py-2">
	 <div class="font-bold mr-2">MEDICAL ATTENDANT<br>
	<?php print $data->MEDICALOFFICER; ?>
	</div><br>
    <div class="font-bold" ><div class="flex items-center">
    <div class="font-bold mr-2">SIGN:</div>
    <hr class="border-t-2 border-gray-300 flex-1">
  </div></div><br>
    <div class="font-bold" ><div class="flex items-center">
    <div class="font-bold mr-2">DATE:</div>
    <hr class="border-t-2 border-gray-300 flex-1">
  </div></div><br>
 <i style="font-size:200%;" onclick="window.print()" class="fas fa-print"></i>

	  </td>
    </tr>
  </tbody>
</table>
<?php
}
?>
</td>
</tr>
 </tbody>
</table>