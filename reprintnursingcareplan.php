<?php
@session_start();
include_once("password2.php");
include_once("interface2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="CONSULTATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' OR 
name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'NURSE' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class viewnursecareplan
{
public $viewid=null;
}
$viewnursecareplan = new viewnursecareplan;
$viewnursecareplan->viewid =$connect->real_escape_string(trim(addslashes(strtoupper($_GET['viewid']))));
?>

<?php 

$x=$connect->query("SELECT  nursecareplan.ID,PATIENTNUMBER,ADMISSIONDATE,DATETIME, WARD, BEDNUMBER, DIAGNOSIS,
 ASSESMENT, NURSEDIAGNOSIS, EXPECTEDOUTCOME, INTERVENTIONS, RATIONALE, IMPLEMENTATION, EVALUATION, ATTENDANT, CLIENT  FROM  nursecareplan,patientsrecord WHERE nursecareplan.ID ='$viewnursecareplan->viewid'  AND PATIENTNUMBER =ACCOUNT  ");

while ($data = $x->fetch_object())
{ 

?>
<div class="mr-5 ml-5  border border-black px-4  ">
<br>
 <div class="flex justify-center"><div style="text-align:center;">
 </div></div>

<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" > NURSE CARE PLAN <i style="font-size:150%;"  onclick="window.print()" class="fas fa-print"></i> </h4>

<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >P NUM</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->PATIENTNUMBER;  ?></td>
<td class="w-1/6  border border-black px-4 py-2" >NAME</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->CLIENT;  ?></td>
<td class="w-1/6  border border-black px-4 py-2" >D.O.A</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->ADMISSIONDATE; ?></td>
</tr>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >WARD</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->WARD; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >BED </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->BEDNUMBER; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >DATE/TIME </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->DATETIME; ?></td>
</tr>
</tbody>
</table>
 <br>
 <table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >DIAGNOSIS</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->DIAGNOSIS;  ?></td>
<td class="w-1/6  border border-black px-4 py-2" >ASSESSMENT</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->ASSESMENT; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >NURSE DIAGNOSIS</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->NURSEDIAGNOSIS;  ?></td>
</tr>
</tbody>
</table>
 <br>
 <table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold"> 
<td class="w-1/6  border border-black px-4 py-2" >GOAL <br>EXPECTED OUTCOME</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->EXPECTEDOUTCOME; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >INTERVENTION <br>ACTION PLAN</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->INTERVENTIONS; ?></td>

</tr>
<tr class="bg-blue-100 text-black-700 font-bold"> 
<td class="w-1/6  border border-black px-4 py-2" >RATIONALE</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->RATIONALE; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >IMPLEMENTATION</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->IMPLEMENTATION;  ?></td>

</tr>
<tr class="bg-blue-100 text-black-700 font-bold"> 
<td class="w-1/6  border border-black px-4 py-2" >EVALUATION</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->EVALUATION; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >ATTENDANT <?php print $data->ATTENDANT;  ?></td>
<td class="w-1/6  border border-black px-4 py-2" >SIGN </td>

</tr>
</tbody>
</table>
<br>
<?php 
}
?>
