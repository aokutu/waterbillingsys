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

class postprocedureresults 
{
public $id=null;
public $patientnumber=null;
public $procedure=null;
public $parameters=null;
public $results =null;
public $rangex=null;	
public $finalresults=null;
public $age=null;
public $gender =null;
public $datex =null;
public $trackkey=null;
public $name=null;
}

$postprocedureresults =new postprocedureresults;
$postprocedureresults->id=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['procedureid']))));
$postprocedureresults->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['patientnumber']))));
$postprocedureresults->procedure=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['procedure']))));
$postprocedureresults->age=$_POST['age'];
$postprocedureresults->gender=$_POST['gender'];
$postprocedureresults->datex =$_POST['date'];
$postprocedureresults->name=$_POST['name'];
$postprocedureresults->trackkey=str_pad(rand(1,10000000),8, '0', STR_PAD_LEFT);
?>

<div class="mr-5 ml-5  border border-black px-4  ">
<br>
 <div class="flex justify-center"><div style="text-align:center;"><img src="letterhead.png"    id="letterhead"   width="150%"  height="30%"   /></div></div>

<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" ><?php print $postprocedureresults->procedure;?> <br><?php print $postprocedureresults->patientnumber; ?> </h4>

<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >NAMES</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $postprocedureresults->name; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >AGE</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $postprocedureresults->age; ?></td>
</tr>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >GENDER</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $postprocedureresults->gender; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >REFF NUMBER</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $postprocedureresults->trackkey; ?></td>
</tr>
</tbody>
</table>

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
  if (count($_POST['parameters']) === count($_POST['results']) && count($_POST['results']) === count($_POST['range']))
	  {
        // Loop through each iteme
	for ($i = 0; $i < count($_POST['parameters']); $i++) 
	{
		
$postprocedureresults->parameters = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['parameters'][$i]))));
$postprocedureresults->results = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['results'][$i]))));
$postprocedureresults->rangex = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['range'][$i]))));
$connect ->query("INSERT INTO procedureresults (TRACKKEY,PATIENTNUMBER,NAME,AGE,GENDER,PROCEDURES,PARAMETERS,RESULTS,RANGES,ATTENDANT,DATE) 
VALUES ('$postprocedureresults->trackkey','$postprocedureresults->patientnumber','$postprocedureresults->name','$postprocedureresults->age','$postprocedureresults->gender','$postprocedureresults->procedure',
'$postprocedureresults->parameters','$postprocedureresults->results','$postprocedureresults->rangex','$dbdetails->user','$postprocedureresults->datex')");

?>



<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/3  border border-black px-4 py-2"><div ><?php print $postprocedureresults->parameters; ?></div></td>
<td  class="w-1/3  border border-black px-4 py-2"><div ><?php print $postprocedureresults->results; ?></div></td>
<td  class="w-1/3  border border-black px-4 py-2"><div ><?php print $postprocedureresults->rangex; ?></div></td>
</tr>


<?php 

	}
$connect ->query("UPDATE  pendingsales SET STATUS ='ISSUED' WHERE  ID =$postprocedureresults->id ");	
$connect ->query("INSERT INTO events(user,session,action,date) 
VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),'POSTED  $postprocedureresults->procedure TRACK NUMBER  $postprocedureresults->trackkey PATIENT NUMBER $postprocedureresults->patientnumber',DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
	
	}



?>

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
<td class="w-1/6  border border-black px-4 py-2" ><?php print $postprocedureresults->datex; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >ATTENDANT</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $dbdetails->user; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >SIGN</td>
<td class="w-1/6  border border-black px-4 py-2" ><br><br></td>
</tr>
</tbody>
</table>
<br>
 <i style="font-size:200%;" onclick="window.print()" class="fas fa-print"></i>

</div>

