<?php

@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="CONSULTATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class bloodtransfusion 
{
public $trackkey=null;

}
$bloodtransfusion = new bloodtransfusion;
$bloodtransfusion->trackkey=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['trackkey']))));

$x=$connect->query("SELECT  bloodtransfusion.ID,TRACKKEY,CLIENT,
    PATIENTNUMBER,AGE,bloodtransfusion.GENDER,DIAGNOSIS, TRANSFUSIONDATETIME, TRANSFUSEDBLOODTYPE, BLOODUNITDONORNUMBER,
    COUNTERCHECKER, STARTEDBY, STARTTIME, TRANSFUSIONRATE, MINUTES, TIME,CARDIAC,OTHERCOMPLICATIONS,
     bloodtransfusion.DATE  FROM  bloodtransfusion,patientsrecord  WHERE bloodtransfusion.ID='$bloodtransfusion->trackkey' AND PATIENTNUMBER=ACCOUNT ");

while ($data = $x->fetch_object())
{
	?>
<style>
  @media print {.fas{ display: none;} }
</style>
<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" ><?php print $data->PATIENTNUMBER; ?> BLOOD  TRANSFUSION REPORT   </h4>
<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >NAME </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->CLIENT; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >AGE</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->AGE; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >GEDER</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->GENDER; ?></td>

</tr>
</table><br>
<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >DIAGNOSIS </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->DIAGNOSIS; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >DATE  OF TRANSFUSION </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->DATE; ?></td>
</tr>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >TYPE OF BLOOD TRANSFUSED</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->TRANSFUSEDBLOODTYPE; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >BLOOD UNIT DONOR NUMBER</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->BLOODUNITDONORNUMBER; ?></td>
</tr>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >COUNTER CHECKED BY</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->COUNTERCHECKER; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >TRANSFUSION STARTED BY </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->STARTEDBY; ?></td>
</tr>

<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >TIME TRANSFUSION STARTED </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->STARTTIME; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >RATE OF TRANSFUSION </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->TRANSFUSIONRATE; $data->TRANSFUSIONENDTIME;?></td>

</tr>
</tbody>
</table>
<?php
} 
?>

<!---------DETAILS  --------->
<br>
<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" >  TRANSFUSION OBSERVATIONS </h4>

<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/12  border border-black px-4 py-2" >MINUTES </td>
<td class="w-1/12  border border-black px-4 py-2" >EXACT TIME </td>
<td class="w-1/12  border border-black px-4 py-2" >BP </td>
<td class="w-1/12  border border-black px-4 py-2" >TEMP C </td>
<td class="w-1/12  border border-black px-4 py-2" >PR </td>
<td class="w-1/12  border border-black px-4 py-2" >RR </td>
<td class="w-1/4  border border-black px-4 py-2" >REMARKS </td>
</tr>
<?php
$x=$connect->query("SELECT TRANSFUSIONID, MINUTESELAPSED, EXACTTIME, BLOODPRESSURE, BODYTEMPRETURE, PR, RR, REMARKS  FROM bloodtransfusionobservation WHERE TRANSFUSIONID =(SELECT TRACKKEY FROM  bloodtransfusion WHERE bloodtransfusion.ID='$bloodtransfusion->trackkey') ");
while ($data = $x->fetch_object())
{ ?> 
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/12  border border-black px-4 py-2" ><?php print $data->MINUTESELAPSED; ?> </td>
<td class="w-1/12  border border-black px-4 py-2" ><?php print $data->EXACTTIME; ?> </td>
<td class="w-1/12  border border-black px-4 py-2" ><?php print $data->BLOODPRESSURE; ?> </td>
<td class="w-1/12  border border-black px-4 py-2" ><?php print $data->BODYTEMPRETURE; ?> </td>
<td class="w-1/12  border border-black px-4 py-2" ><?php print $data->PR; ?></td>
<td class="w-1/12  border border-black px-4 py-2" ><?php print $data->RR; ?> </td>
<td class="w-1/4  border border-black px-4 py-2" ><?php print $data->REMARKS; ?> </td>
</tr>

<?php 
} 

?>
</tbody>
</table>
<!---------DETAILS  --------->

<br>

<?php 

$x=$connect->query("SELECT TRANSFUSIONENDTIME, AMOUNTTRANSFUSED, GENERAL,
    DEMATOLOGICAL, RENAL, HAEMETOLOGICAL, INTERVENTION,DATE  FROM  bloodtransfusion  WHERE bloodtransfusion.ID='$bloodtransfusion->trackkey' ");

while ($data = $x->fetch_object())
{
	?>
<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >TIME TRANSFUSION ENDED</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->TRANSFUSIONENDTIME; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >AMOUNT TRANSFUSED </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->AMOUNTTRANSFUSED; ?></td>
</tr>

</tbody>
</table>


<br>
<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" > SYMTOMS OR SIGNS OF TRANSFUSION REACTION OBSERVED  </h4>

<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/12  border border-black px-4 py-2" >GENERAL</td>
<td class="w-1/4  border border-black px-4 py-2" ><?php print $data->GENERAL; ?></td>
<td class="w-1/12  border border-black px-4 py-2" >DERMATOLOGICAL </td>
<td class="w-1/4  border border-black px-4 py-2" ><?php print $data->DEMATOLOGICAL; ?></td>
</tr>

<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/12  border border-black px-4 py-2" >CARDIAC</td>
<td class="w-1/4  border border-black px-4 py-2" ><?php print $data->CARDIAC; ?></td>
<td class="w-1/12  border border-black px-4 py-2" >RENAL </td>
<td class="w-1/4  border border-black px-4 py-2" ><?php print $data->RENAL; ?></td>
</tr>

<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/12  border border-black px-4 py-2" >HAEMATOLOGICAL</td>
<td class="w-1/4  border border-black px-4 py-2" ><?php print $data->HAEMETOLOGICAL; ?></td>
<td class="w-1/12  border border-black px-4 py-2" >OTHERS </td>
<td class="w-1/4  border border-black px-4 py-2" ><?php print $data->OTHERCOMPLICATIONS; ?></td>
</tr>
</tbody>
</table>
<br>
<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" > INTERVENTION GIVEN   </h4>

<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/12  border border-black px-4 py-2" >INTERVENTION</td>
<td class="w-1/2  border border-black px-4 py-2" ><?php print $data->INTERVENTION; ?></td>
</tr>
</tbody>
</table>

<?php
} 
?>

<br>
<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >NAME  OF  NURSE/DOCTOR/ANASTHESIST</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $dbdetails->user; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >SIGNATURE</td>
<td class="w-1/6  border border-black px-4 py-2" ></td>
<td class="w-1/6  border border-black px-4 py-2" >DATE</td>
<td class="w-1/6  border border-black px-4 py-2" ></td>

</tr>
</tbody>
</table>

<i class="fas fa-print"  onclick ="window.print();"style="font-size:160%;"></i>