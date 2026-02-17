<?php
@session_start();
include_once("password2.php");
include_once("interface2.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="LAB & IMAGING";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  
class proceduredetails
{
public $trackkey=null;
	
}
$proceduredetails=new proceduredetails;
$proceduredetails->trackkey=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['trackkey']))));



$x=$connect->query("SELECT  urinalysis.ID,TRACKKEY,PATIENTNUMBER,CLIENT,AGE, urinalysis.GENDER, COLOR, COLORFLAG, APPEARANCE, APPEARANCEFLAG, LEUKOCYTES, LEUKOCYTESFLAG, NITRITE, NITRITEFLAG, UROBILINOGEN, UROBILINOGENFLAG, PROTEIN, PROTEINFLAG, PH, PHFLAG, BLOOD, BLOODFLAG,
 SPECIFICGRAVITY, SPECIFICGRAVITYFLAG, KETONE, KETONEFLAG, GLUCOSE, GLUCOSEFLAG, MICROSCOPY, MICROSCOPYFLAG, ATTENDANT, urinalysis.DATE 
  FROM  urinalysis,patientsrecord WHERE TRACKKEY ='$proceduredetails->trackkey'  AND urinalysis.PATIENTNUMBER=patientsrecord.ACCOUNT ");

while ($data = $x->fetch_object())
{
	
?>

<div class="mr-5 ml-5  border border-black px-4  ">
<br>
 <div class="flex justify-center"><div style="text-align:center;"><img src="letterhead.png"    id="letterhead"   width="150%"  height="30%"   /></div></div>

<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" >URINALYSIS  RESULTS </h4>


<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >NAMES</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->CLIENT; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >AGE</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->AGE; ?></td>
</tr>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >GENDER</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->GENDER; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >REFF NUMBER</td>
<td class="w-1/6  border border-black px-4 py-2" > <?php print $data->TRACKKEY; ?> </td>
</tr>
</tbody>
</table>

<br>
<table class="min-w-full bg-white border border-black-300"  id="completebloodcount">
<thead>
<tr class="bg-blue-100 text-black-700 font-bold">
<th  class="w-1/6  border border-black px-4 py-2"><div >PARAMETERS</div></th>
<th  class="w-1/6  border border-black px-4 py-2"><div >RESULTS</div></th>
<th  class="w-1/6  border border-black px-4 py-2"><div >FLAG</div></th>
<th  class="w-1/6  border border-black px-4 py-2"><div >VALUE</div></th>

</tr>

</thead>
<tbody>

<?php 

?>



<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >COLOR</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->COLOR; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->COLORFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >AMBER</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >APPEARANCE</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->APPEARANCE; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->APPEARANCEFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >CLEAR</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >LEUKOCYTES</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->LEUKOCYTES; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->LEUKOCYTESFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >NIL</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >NITRITE</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->NITRITE; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->NITRITEFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >NEG</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >UROBILINOGEN</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->UROBILINOGEN; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->UROBILINOGENFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >1.7-30 umol/L</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >PROTEIN</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->PROTEIN; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->PROTEINFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >NIL</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >PH</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->PH; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->PHFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >4.5-8.0</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >BLOOD</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->BLOOD; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->BLOODFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >NIL</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >SPECIFIC GRAVITY</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->SPECIFICGRAVITY; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->SPECIFICGRAVITYFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >1.0005-1.030</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >KETONE</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->KETONE; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->KETONEFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >NIL</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >BILIRUBIN</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->BILIRUBIN; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->BILIRUBINFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >NIL</div></td>

</tr>



<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >GLUCOSE</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->GLUCOSE; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->GLUCOSEFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >NIL</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >MICROSCOPY</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->MICROSCOPY; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->MICROSCOPYFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ></div></td>

</tr>

<?php 

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
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->DATE; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >ATTENDANT</td>
<td class="w-1/6  border border-black px-4 py-2" > <?php print $data->ATTENDANT; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >SIGN</td>
<td class="w-1/6  border border-black px-4 py-2" ><br><br></td>
</tr>
</tbody>
</table>
<br>
 <i style="font-size:200%;" onclick="window.print()" class="fas fa-print"></i>

</div>
<?php 
}
?>