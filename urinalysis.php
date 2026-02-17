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

class urinalysis 
{
public $patientnumber=null;
public $age=null;
public $gender=null;
public $trackkey=null;
public $name=null;
public $transactionid=null;	
public $color=null;
public $colorflag=null;
public $appearance=null;
public $appearanceflag=null;
public $leukocytes=null;
public $leukocytesflag=null;
public $nitrite=null;
public $nitriteflag=null;
public $urobilinogen=null;
public $urobilinogenflag=null;
public $protein=null;
public $proteinflag=null;
public $ph=null;
public $phflag=null;
public $blood=null;
public $bloodflag=null;
public $specificgravity=null;
public $specificgravityflag=null;
public $ketone=null;
public $ketoneflag=null;
public $bilirubin=null;
public $bilirubinflag=null;
public $glucose=null;
public $glucoseflag=null;
public $microscopy=null;
public $microscopyflag=null;
public $date=null;
}
$urinalysis=new urinalysis;
$urinalysis->color=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['color']))));
$urinalysis->colorflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['colorflag']))));
$urinalysis->appearance=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['appearance']))));
$urinalysis->appearanceflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['appearanceflag']))));
$urinalysis->leukocytes=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['leukocytes']))));
$urinalysis->leukocytesflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['leukocytesflag']))));
$urinalysis->nitrite=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['nitrite']))));
$urinalysis->nitriteflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['nitriteflag']))));
$urinalysis->urobilinogen=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['urobilinogen']))));
$urinalysis->urobilinogenflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['urobilinogenflag']))));
$urinalysis->protein=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['protein']))));
$urinalysis->proteinflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['proteinflag']))));
$urinalysis->ph=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['ph']))));
$urinalysis->phflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['phflag']))));
$urinalysis->blood=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['blood']))));
$urinalysis->bloodflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['bloodflag']))));
$urinalysis->specificgravity=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['specificgravity']))));
$urinalysis->specificgravityflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['specificgravityflag']))));
$urinalysis->ketone=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['ketone']))));
$urinalysis->ketoneflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['ketoneflag']))));
$urinalysis->bilirubin=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['bilirubin']))));
$urinalysis->bilirubinflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['bilirubinflag']))));
$urinalysis->glucose=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['glucose']))));
$urinalysis->glucoseflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['glucoseflag']))));
$urinalysis->microscopy=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['microscopy']))));
$urinalysis->microscopyflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['microscopyflag']))));
$urinalysis->trackkey=str_pad(rand(1,10000000),8, '0', STR_PAD_LEFT);
$urinalysis->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['patientnumber']))));
$urinalysis->age=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['age']))));
$urinalysis->gender=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['gender']))));
$urinalysis->name=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['name']))));
$urinalysis->transactionid=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['procedureid'])))); 
$urinalysis->date=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['date']))));

$connect->query(" INSERT INTO urinalysis (TRACKKEY,PATIENTNUMBER, AGE, GENDER, COLOR, COLORFLAG, APPEARANCE, APPEARANCEFLAG, LEUKOCYTES, LEUKOCYTESFLAG, NITRITE, NITRITEFLAG, UROBILINOGEN, UROBILINOGENFLAG, PROTEIN, PROTEINFLAG, PH, PHFLAG, BLOOD, BLOODFLAG, SPECIFICGRAVITY, SPECIFICGRAVITYFLAG, KETONE, KETONEFLAG,BILIRUBIN,BILIRUBINFLAG, GLUCOSE, GLUCOSEFLAG, MICROSCOPY, MICROSCOPYFLAG, ATTENDANT, DATE) 
VALUES ('$urinalysis->trackkey','$urinalysis->patientnumber', '$urinalysis->age', '$urinalysis->gender', '$urinalysis->color', '$urinalysis->colorflag', '$urinalysis->appearance', '$urinalysis->appearanceflag', '$urinalysis->leukocytes', '$urinalysis->leukocytesflag', '$urinalysis->nitrite', '$urinalysis->nitriteflag', '$urinalysis->urobilinogen', '$urinalysis->urobilinogenflag', '$urinalysis->protein',
'$urinalysis->proteinflag', '$urinalysis->ph', '$urinalysis->phflag', '$urinalysis->blood', '$urinalysis->bloodflag', '$urinalysis->specificgravity', '$urinalysis->specificgravity', '$urinalysis->ketone', '$urinalysis->ketoneflag','$urinalysis->bilirubin', '$urinalysis->bilirubinflag', '$urinalysis->glucose', '$urinalysis->glucoseflag', '$urinalysis->microscopy', '$urinalysis->microscopyflag', '$dbdetails->user', '$urinalysis->date'); ");
$connect ->query("UPDATE consultation SET  URGENCY='CONSULTATION' WHERE PATIENTNUMBER='$urinalysis->patientnumber' ");
$connect->query("INSERT INTO events(USER,ACTION,SESSION,DATE) VALUES('$dbdetails->user','ENTER URINALYSIS RESULTS FOR PATIENT NUMBER $urinalysis->patientnumber',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR) ) ");
$connect ->query("UPDATE pendingsales SET STATUS='ISSUED' WHERE ID=$urinalysis->transactionid ");
?>

<div class="mr-5 ml-5  border border-black px-4  ">
<br>
 <div class="flex justify-center"><div style="text-align:center;"><img src="letterhead.png"    id="letterhead"   width="150%"  height="30%"   /></div></div>

<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" >URINALYSIS  </h4>


<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >NAMES</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $urinalysis->name; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >AGE</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $urinalysis->age; ?></td>
</tr>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >GENDER</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $urinalysis->gender; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >REFF NUMBER</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php  print $urinalysis->trackkey; ?></td>
</tr>
</tbody>
</table>

<br>
<table class="min-w-full bg-white border border-black-300"  id="urinalysis">
<thead>
<tr class="bg-blue-100 text-black-700 font-bold">
<th  class="w-1/6  border border-black px-4 py-2"><div >PARAMETERS</div></th>
<th  class="w-1/6  border border-black px-4 py-2"><div >RESULTS</div></th>
<th  class="w-1/6  border border-black px-4 py-2"><div >FLAG</div></th>
<th  class="w-1/6  border border-black px-4 py-2"><div >VALUE</div></th>

</tr>

</thead>
<tbody>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >COLOR</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->color; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->colorflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >AMBER</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >APPEARANCE</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->appearance; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->appearanceflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >CLEAR</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >LEUKOCYTES</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->leukocytes; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->leukocytesflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >NIL</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >NITRITE</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->nitrite; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->nitriteflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >NEG</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >UROBILINOGEN</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->urobilinogen; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->urobilinogenflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >1.7-30 umol/L</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >PROTEIN</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->protein; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->proteinflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >NIL</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >PH</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->ph; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->phflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >4.5-8.0</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >BLOOD</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->blood; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->bloodflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >NIL</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >SPECIFIC GRAVITY</div></td>
s<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->specificgravity; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->specificgravityflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >1.0005-1.030</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >KETONE</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->ketone; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->ketoneflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >NIL</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >GLUCOSE</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->glucose; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->glucoseflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >NIL</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >MICROSCOPY</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->microscopy; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $urinalysis->microscopyflag; ?></div></td>
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
<td class="w-1/6  border border-black px-4 py-2" ><?php print $urinalysis->date; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >ATTENDANT</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print strtoupper($dbdetails->user); ?></td>
<td class="w-1/6  border border-black px-4 py-2" >SIGN</td>
<td class="w-1/6  border border-black px-4 py-2" ><br><br></td>
</tr>
</tbody>
</table>
<br>
 <i style="font-size:200%;" onclick="window.print()" class="fas fa-print"></i>

</div>