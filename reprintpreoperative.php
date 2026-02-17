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

class preoperativerecord 
{
public $trackkey=null;

}
$preoperativerecord = new preoperativerecord;
$preoperativerecord->trackkey=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['trackkey']))));

$x=$connect->query("SELECT  preoperativerecord.ID,PATIENTNUMBER,DATE,CLIENT,PATIENTNUMBER, OPERATIONCATEGORY, OPERATIONSTATE, OPERATIONTECHNIQUE, OPERATIONROUTE, ANASTHESIATYPE, IVTHERAPY, POSTOPERATIONCOMPLICATIONS,PREOPERATIVEREMARKS,POSTOPERATIVEREMARKS  FROM  preoperativerecord,patientsrecord  WHERE preoperativerecord.ID='$preoperativerecord->trackkey'  AND preoperativerecord.PATIENTNUMBER=patientsrecord.ACCOUNT ");

while ($data = $x->fetch_object())
{ ?>
<style>
  @media print {.fas{ display: none;} }
</style>
<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" >p.NUMBER <?php print  $data->PATIENTNUMBER; ?> PRE OPERATIVE DETAILS   </h4>

<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >DATE </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->DATE; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >NAME</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->CLIENT; ?></td>
</tr>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >XXX</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->ID; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >PRE OPERATIVE STATE </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->OPERATIONSTATE; ?></td>
</tr>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >TECHNIQUE</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->OPERATIONTECHNIQUE; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >ROUTE </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->OPERATIONROUTE; ?></td>
</tr>

<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >TYPE OF ANASTHESIST</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->ANASTHESIATYPE; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >I.V THERAPY </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->IVTHERAPY; ?></td>
</tr>


<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >P.O COMPLICATIONS</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->POSTOPERATIONCOMPLICATIONS; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >XXXX </td>
<td class="w-1/6  border border-black px-4 py-2" >XXX</td>
</tr>
</tbody>
</table>
<br>
<div class=" grid grid-cols-2 gap-4 bg-blue-100 text-black-700 font-bold ">
<div class="square w-full border border-black px-4 py-2  flex justify-left items-left"><?php print "PRE OPERATIVE REMARKS<br>".$data->PREOPERATIVEREMARKS;?></div>
<div class=" square w-full border border-black px-4 py-2 flex justify-left items-left"><?php print "POST OPERATIVE REMARKS<br>".$data->POSTOPERATIVEREMARKS; ?></div>

</div>
<?php
} 
?>
<i class="fas fa-print"  onclick ="window.print();"style="font-size:160%;"></i>