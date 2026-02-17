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

$x=$connect->query("SELECT  completebloodcountresults.ID,TRACKKEY,PATIENTNUMBER,CLIENT,completebloodcountresults.DATE,TRACKKEY,PATIENTNUMBER, WBC, WBCFLAG, LYMPHPERCENTAGE, LYMPHPERCENTAGEFLAG, GRANPERCENTAGE, GRANPERCENTAGEFLAG, MIDPERCENTAGE, MIDPERCENTAGEFLAG,
LYMPH, LYMPHFLAG, GRAN, GRANFLAG, MID, MIDFLAG, RBC, RBCFLAG, HGB, HGBFLAG, HCTPERCENTAGE, HCTPERCENTAGEFLAG, MCV, MCVFLAG, MCH, MCHFLAG, MCHC, MCHCFLAG, 
RDWCVPERCENTAGE, RDWCVPERCENTAGEFLAG, RWSD,completebloodcountresults.GENDER,RWSDFLAG, PLT, PLTFLAG, MPV, MPVFLAG, PDW, PDWFLAG, PCT, PCTFLAG, PLCR, PLCRFLAG, PLCC, PLCCFLAG,ATTENDANT  FROM  completebloodcountresults,patientsrecord WHERE TRACKKEY ='$proceduredetails->trackkey'  AND completebloodcountresults.PATIENTNUMBER=patientsrecord.ACCOUNT ");

while ($data = $x->fetch_object())
{
	
?>

<div class="mr-5 ml-5  border border-black px-4  ">
<br>
 <div class="flex justify-center"><div style="text-align:center;"><img src="letterhead.png"    id="letterhead"   width="150%"  height="30%"   /></div></div>

<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" >COMPLETE BLOOD COUNT </h4>


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
<td  class="w-1/6  border border-black px-4 py-2"><div >WBC</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->WBC; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->WBCFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >4.0-10.0</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >LYMPH %</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->LYMPHPERCENTAGE; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->LYMPHPERCENTAGEFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >20.0-40.0</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >GRAN %</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->GRANPERCENTAGE; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->GRANPERCENTAGEFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >50.0-70.0</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >MID %</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->MID; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->MIDFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >3.0-9.0</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >LYMPH #</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->LYMPH; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->LYMPHFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >0.8-4.00</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >GRAN #</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->GRAN; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->GRANFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >2.00-7.00</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >MID #</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->MID; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->MIDFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >0.10-0.90</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >HCT %</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->HCTPERCENTAGE; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->HCTPERCENTAGEFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >35.0-50.0</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >RBC</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->RBC; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->RBCFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >4.00-5.20</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >HGB</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->HGB; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->HGBFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >12.00-16.00</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >MCV</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->MCV; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->MCVFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >82-100</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >MCH</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->MCH; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->MCHFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >27-34</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >RDW-CV%</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->RDWCVPERCENTAGE; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->RDWCVPERCENTAGEFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >11.5-14.5</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >MCHC</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->MCHC; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->MCHCFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >32-36</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >RW-SD</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->RWSD; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->RWSDFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >35.0-56-0</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >PLT</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->PLT; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->PLTFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >150-450</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >MPV</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->MPV; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->MPVFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >7.00-11.00</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >PDW</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->PDW; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->PDWFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >9.00-17.00</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >PCT</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->PCT; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->PCTFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >0.108-0.282</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >P-LCR</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->PLCR; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->PLCRFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >11.00-45.00</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >PLCC</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->PLCC; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $data->PLCCFLAG; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >30-90</div></td>

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