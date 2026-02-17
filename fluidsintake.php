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


class  fluidsintake
{
public $startdate=null;
public $enddate=null;
public $fluidsintakepatientnumber=null;

}
$fluidsintake =new fluidsintake;
$fluidsintake->startdate=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date1']))));
$fluidsintake->enddate=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date2']))));
$fluidsintake->fluidsintakepatientnumber=$_SESSION['patientnumber'];




?>

<script>
   $(document).ready(function(){
$("#fluidsintake").submit(function(){
$.post( "fluidsintake2.php",
$("#fluidsintake").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show'); 
//$("#bloodsugardiv1").load("bloodsugarlevel.php #bloodsugardiv2");
return false;});
return false;
});

});
</script>
	  <form method="post" id="fluidsintakexx" action="fluidsintake2.php">
	  <div class="container">
   <div class="row">
  <div class="col-sm-6">
  <input style='text-transform:uppercase' readonly required  name="patientnumber"  value="<?php print $_SESSION['patientnumber'];?>" type="hidden"    size="15" placeholder="PATIENT NUMBER"   class="form-control input-sm"     autocomplete="off" >
DATE/TIME
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="DATE" data-placement="top" style='text-transform:uppercase' name="datetime"  type="datetime-local"   required  title="ENTER DATE-TIME "   size="15" placeholder="DATE- TIME"  required="on"  class="form-control input-sm"     autocomplete="off" ><br />
 WEIGHT 
<input title="INFO" data-toggle="popover" data-trigger="hover" data-content="BODY WEIGHT" data-placement="top" style='text-transform:uppercase' name="bodyweight"  type="text"   required  title="ENTER BODY WEIGHT"   size="15" placeholder="BODY WEIGHT"  required="on"  class="form-control input-sm"     autocomplete="off" >
<br>

   systolic B.P
<input  title="INFO" data-toggle="popover" data-trigger="hover" data-content="SYSTOLIC B.P" data-placement="top" style='text-transform:uppercase' name="systolicbp"  type="text"   required  title="SYSTOLIC B.P"   size="15" placeholder="SYSTOLIC B.P"  required="on"  class="form-control input-sm"     autocomplete="off" >
<hr class="border-t-2 border-blue-500 my-4">TYPE OF FLUID
<br>
<input title="INTAKE" data-toggle="popover" data-trigger="hover" data-content="FLUID TYPE" data-placement="top" style='text-transform:uppercase' name="fluidtype"  type="text"   required  title="TYPE OF FLUID"   size="15" placeholder="TYPE OF FLUID"  required="on"  class="form-control input-sm"     autocomplete="off" >


</div>
  <div class="col-sm-6"> 
  <input title="INFO" data-toggle="popover" data-trigger="hover" data-content="INTRA VENOUS  INTAKE" data-placement="top" style='text-transform:uppercase' name="intravenousintake"  type="text"   required  title="INTRA VENOUS INTAKE"   size="15" placeholder="INTRA VENOUS INTAKE"  required="on"  class="form-control input-sm"     autocomplete="off" >
<br>
INSTRUCTION  FOR  INTRA VENUS   INFUSION
  <textarea title="INSTRUCTION FOR" data-toggle="popover" data-trigger="hover" data-content="INTRA VENUS INFUSION" data-placement="top" class="border-4 border-blue-500 p-2 rounded-lg"  name="instruction" style="width: 100%; height: 15%" ></textarea>
<br>
<br>
 <input title="INFO" data-toggle="popover" data-trigger="hover" data-content="ORAL INTAKE" data-placement="top" style='text-transform:uppercase' name="oralintake"  type="text"   required  title="ORAL INTAKE"   size="15" placeholder="ORAL INTAKE"  required="on"  class="form-control input-sm"     autocomplete="off" >
<br>
INSTRUCTION  FOR  ORAL FLUIDS
  <textarea title="INSTRUCTION FOR" data-toggle="popover" data-trigger="hover" data-content="ORAL FLUIDS" data-placement="top" class="border-4 border-blue-500 p-2 rounded-lg"  name="oralfluidsinstruction" style="width: 100%; height: 15%" ></textarea>
<br>
 INSTRUCTION  FOR  THE  NASOGASTRIC SECTION
  <textarea title="INSTRUCTION FOR" data-toggle="popover" data-trigger="hover" data-content="ORAL FLUIDS" data-placement="top" class="border-4 border-blue-500 p-2 rounded-lg"  name="nasogastricinstruction" style="width: 100%; height: 15%" ></textarea>
<hr class="border-t-2 border-blue-500 my-4">
INTAKE
  <div class="grid grid-cols-2 gap-4">
  <!-- Row 1 -->
  <div class="square w-full h-20  flex justify-center items-center">
xxx
  </div>
  <div class="square w-full h-20   flex justify-center items-center">
 
  </div>
</div>
<br>
<br>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>


  </div>
  
  </div>

  </div>
</form>

<div id="fluidsintake1" >
<div id="fluidsintake2" >
 <table   class="generictable">
<thead></thead>
<tbody>
<tr>
<td  class="heading">P.NO.<?php print $fluidsintake->fluidsintakepatientnumber; ?> FLUIDS INTAKE RECORDS FROM <?php print $fluidsintake->startdate; ?> TO <?php print $fluidsintake->enddate; ?>  
<i onclick="window.print()" style="font-size:200%;" class="fas fa-print"></i>
</td>
</tr>
</tbody>
</table><br>


 <table   >
<thead></thead>
<tbody>
<tr>
<td  class="heading">REFF</td>
<td  class="heading">DATE TIME</td>
<td  class="heading">BODY WEIGHT</td>



</tr>
</tbody>
</table>

</div>
</div>


