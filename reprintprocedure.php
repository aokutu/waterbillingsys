<?php

@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="LAB & IMAGING";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class procedurereport 
{
public $trackkey=null;

}
$procedurereport = new procedurereport;
$procedurereport->trackkey=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['trackkey']))));


$x=$connect->query("SELECT  DISTINCT TRACKKEY,PROCEDURES,ATTENDANT,DATE,PATIENTNUMBER,NAME,GENDER,AGE  FROM  procedureresults  WHERE 
TRACKKEY='$procedurereport->trackkey'  ");

while ($data = $x->fetch_object())
{ 

$attendant=$data->ATTENDANT;
$date=$data->DATE;

?>

<div class="mr-5 ml-5  border border-black px-4  ">
<br>
 <div class="flex justify-center"><div style="text-align:center;"><img src="letterhead.png"    id="letterhead"   width="150%"  height="30%"   /></div></div>

<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" ><?php print $data->PROCEDURES;?> <br><?php print $data->PATIENTNUMBER; ?> </h4>

<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >NAMES</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->NAME; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >AGE</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->AGE; ?></td>
</tr>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >GENDER</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->GENDER; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >REFF NUMBER</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->TRACKKEY; ?></td>
</tr>
</tbody>
</table>

<?php 
 }  ?>
 
 <br>
<table class="min-w-full bg-white border border-black-300"  id="completebloodcount">
<thead>
<tr class="bg-blue-100 text-black-700 font-bold">
<th  class="w-1/3  border border-black px-4 py-2"><div >PARAMETERS</div></th>
<th  class="w-1/3  border border-black px-4 py-2"><div >RESULTS</div></th>
<th  class="w-1/3  border border-black px-4 py-2"><div >RANGE</div></th>

</tr>

</thead>
<tbody>


<?php 
$x=$connect->query(" SELECT  PARAMETERS,RESULTS,RANGES  FROM  procedureresults  WHERE TRACKKEY='$procedurereport->trackkey'  ");

while ($data = $x->fetch_object())
{ 
?>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/3  border border-black px-4 py-2"><div ><?php print $data->PARAMETERS; ?></div></td>
<td  class="w-1/3  border border-black px-4 py-2"><div ><?php print $data->RESULTS; ?></div></td>
<td  class="w-1/3  border border-black px-4 py-2"><div ><?php print $data->RANGES; ?></div></td>
</tr>

<?php } ?>
</tbody>
</table>
<br>
<style>
#testdetails td:nth-child(1),td:nth-child(2),td:nth-child(3),td:nth-child(4),td:nth-child(5){width: 18%;}
</style>

<table class="min-w-full bg-white border border-black-300"   >
<tbody class="bg-blue-100 text-black-700 font-bold" >
<tr  >
<td class="w-1/6  border border-black px-4 py-2" >DATE</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $date; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >ATTENDANT</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print strtoupper($attendant); ?></td>
<td class="w-1/6  border border-black px-4 py-2" >SIGN</td>
<td class="w-1/6  border border-black px-4 py-2" ><br><br></td>
</tr>
</tbody>
</table>
<br>
 <i style="font-size:200%;" onclick="window.print()" class="fas fa-print"></i>

</div>

 
 
