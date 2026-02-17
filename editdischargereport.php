<?php 
@session_start();
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="consultation";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class editdetails 
{
	
public $editid=null;

}
$editdetails =new editdetails;
$editdetails->editid=$connect->real_escape_string($_GET['editid']);


$x=$connect->query("SELECT patientdischargereport.ID,CLIENT,PATIENTNUMBER, AGE,patientdischargereport.GENDER, MEDICALOFFICER, ADMISSIONDATE, DISCHARGEDATE,DIAGNOSIS, 
CHIEFCOMPLAIN, PRESEMTINGILLNESS, ONEXAMINATION,SUMMARY 
FROM patientdischargereport,patientsrecord WHERE  patientdischargereport.ID='$editdetails->editid' AND PATIENTNUMBER =ACCOUNT ");
while ($data = $x->fetch_object())
{ 
?>
<style>

 textarea {line-height: 0.5; /* Adjust this value to reduce spacing */}
</style>
<script src='pluggins/jquery.autosize.js'></script>

<script>
$(function(){$('textarea').autosize();});

</script>
<form method="post" id="editdischargereport" action="editdischargereport2.php">
 <div class="grid grid-cols-3 gap-4">
  <!-- Row 1 -->
  <div class="square w-full h-20  flex justify-center items-center">
 ADMISSION DATE 
<input title="INFO" value="<?php print $data->ADMISSIONDATE; ?>" data-toggle="popover" data-trigger="hover" data-content="DATE OF ADMISSION" data-placement="top" style='text-transform:uppercase' name="admissiondate"  type="date"   required  title="INVALID ENTRIES"   size="15" placeholder="ADMISSION DATE"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
  <div class="square w-full h-20  flex justify-center items-center">
 DISCHARGE DATE
<input title="INFO" value="<?php print $data->DISCHARGEDATE; ?>" data-toggle="popover" data-trigger="hover" data-content="DISCHARGE DATE" data-placement="top" style='text-transform:uppercase' name="dischargedate"  type="date"   required  title="INVALID ENTRIES"   size="15" placeholder="DISCHARGE DATE"  required="on"  class="form-control input-sm"     autocomplete="off" >

  </div>
  
    <div class="square w-full h-20  flex justify-center items-center">
 </div>
</div>

 <?php 
 $numb=0;
$diagnosisarray =explode(",", $data->DIAGNOSIS);
foreach ($diagnosisarray as $diagnosis )
{

$numb+=1;  print 'DIAGNOSIS '.$numb; 	?>

<input title="INFO"  list="diagnosislist" data-toggle="popover" value="<?php print $diagnosis; ?>"  data-trigger="hover" data-content="DIAGNOSIS" data-placement="top" style='text-transform:uppercase' name="diagnosis[]"  type="text"   required    size="15" placeholder="DIAGNOSIS"  required="on"  class="form-control input-sm"     autocomplete="off" ><br>

<?php
}
 ?>
<br>
  <div class="container">
   <div class="row">
  <div class="col-sm-6">
  CHIEF COMPLAIN
<textarea placeholder="CHIEF COMPLAIN" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CHIEF COMPLAIN" data-placement="top" class="border-4 border-blue-500 p-2 rounded-lg"  name="chiefcomplain" style="width: 100%; height: 150px; line-height: 1.2; padding: 4px;">
    <?php 
	$chiefcomplain =preg_replace('/<br\s*\/?>/i', "\n", $data->CHIEFCOMPLAIN);
	echo htmlspecialchars($chiefcomplain); ?>
</textarea>
PRESENTING ILLNESS
<textarea placeholder="CHIEF COMPLAIN" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CHIEF COMPLAIN" data-placement="top" class="border-4 border-blue-500 p-2 rounded-lg"  name="presentingillness" style="width: 100%; height: 150px; line-height: 1.2; padding: 4px;">
    <?php 
	$presentingillness =preg_replace('/<br\s*\/?>/i', "\n", $data->PRESEMTINGILLNESS);
	echo htmlspecialchars($presentingillness); ?>
</textarea>
</div>
    <div class="col-sm-6">
ON EXAMINATION
<textarea placeholder="CHIEF COMPLAIN" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CHIEF COMPLAIN" data-placement="top" class="border-4 border-blue-500 p-2 rounded-lg"  name="onexamination" style="width: 100%; height: 150px; line-height: 1.2; padding: 4px;">
    <?php 
	$onexamination =preg_replace('/<br\s*\/?>/i', "\n", $data->ONEXAMINATION);
	echo htmlspecialchars($onexamination); ?>
</textarea>SUMMARY
<textarea placeholder="CHIEF COMPLAIN" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CHIEF COMPLAIN" data-placement="top" class="border-4 border-blue-500 p-2 rounded-lg"  name="summary" style="width: 100%; height: 150px; line-height: 1.2; padding: 4px;">
    <?php 
	$summary =preg_replace('/<br\s*\/?>/i', "\n", $data->SUMMARY);
	echo htmlspecialchars($summary,ENT_QUOTES, 'UTF-8'); ?>
</textarea>
	
	</div>
	</div></div>

<input type="hidden" name="editid" value="<?php print  $editdetails->editid; ?>" >
<input type="hidden" name="patientnumber" value="<?php print  $editdetails->PATIENTNUMBER; ?>" >

   <br><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>



</form>
<?php }  ?>
