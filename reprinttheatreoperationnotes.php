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

class theatreoperationnotes 
{
public $trackkey=null;

}
$theatreoperationnotes = new theatreoperationnotes;
$theatreoperationnotes->trackkey=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['trackkey']))));

$x=$connect->query("SELECT  ID,PATIENTNUMBER, DIAGNOSIS, OPERATION, SURGEON, ASETSURGEON, SCRUBNURSE, ANASTHESIST, ANASTHESIATYPE,INSISION, OPERATIONPROCEDURENOTES, DATE   FROM  theatreoperationnotes  WHERE ID='$theatreoperationnotes->trackkey'  ");

while ($data = $x->fetch_object())
{ ?>
<style>
  @media print {.fas{ display: none;} }
</style>
<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" ><?php print $data->PATIENTNUMBER; ?> THEATRE OPERATION NOTES  </h4>

<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >DATE </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->DATE; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >DIAGNOSIS</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->DIAGNOSIS; ?></td>
</tr>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >SURGEON</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->SURGEON; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >ASET SURGEON</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->ASETSURGEON; ?></td>
</tr>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >NAME OF SCRUB NURSE</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->SCRUBNURSE; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >ANASTHESIST</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->ANASTHESIST; ?></td>
</tr>

<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >TYPE OF ANASTHESIST</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->ANASTHESIATYPE; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >INSISION</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->INSISION; ?></td>
</tr>
</tbody>
</table>
<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" >  THEATRE OPERATION  NOTES </h4>

<div class ="bg-blue-100 text-black-700 font-bold border border-black px-4 py-2 " >
<?php print $data->OPERATIONPROCEDURENOTES; ?>
</div>

<?php
} 
?>
<i class="fas fa-print"  onclick ="window.print();"style="font-size:160%;"></i>