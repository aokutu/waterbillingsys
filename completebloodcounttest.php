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

class completebloodcount 
{
public $gender=null;
public $age=null;
public $procedure =null;
public $name =null;
public $trackkey=null;	
public $wbc=null;
public $wbcflag=null;
public $lymphpercentage=null;
public $lymphpercentageflag=null;
public $granpercentage=null;
public $granpercentageflag=null;
public $midpercentage=null;	
public $midpercentageflag=null;	
public $lymph=null;
public $lymphflag=null;
public $gran=null;
public $granflag=null;
public $mid=null;
public $midflag=null;
public $rbc=null;
public $rbcflag=null;
public $hgb=null;
public $hgbflag=null;
public $hctpercentage=null;
public $hctpercentageflag=null;
public $mcv=null;
public $mcvflag=null;
public $mch=null;
public $mchflag=null;
public $mchc=null;
public $mchcflag=null;
public $rdwcvpercentage=null;
public $rdwcvpercentageflag=null;
public $rwsd=null;
public $rwsdflag=null;
public $plt=null;
public $pltflag=null;
public $mpv=null;
public $pdw=null;
public $pdwflag=null;
public $pct=null;
public $pctflag=null;
public $plcr=null;
public $plcrflag=null;
public $plcc=null;
public $plccflag=null;
public $patientnumber=null;
public $transactionid =null;
public $date=null;	
}
$completebloodcount=new completebloodcount;
$completebloodcount->wbc=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['wbc']))));
$completebloodcount->wbcflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['wbcflag']))));
$completebloodcount->lymphpercentage=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['lymphpercentage']))));
$completebloodcount->lymphpercentageflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['lymphpercentageflag']))));
$completebloodcount->granpercentage=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['granpercentage']))));
$completebloodcount->granpercentageflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['granpercentageflag']))));
$completebloodcount->midpercentage=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['midpercentage']))));
$completebloodcount->midpercentageflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['midpercentageflag']))));
$completebloodcount->lymph=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['lymph']))));
$completebloodcount->lymphflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['lymphflag']))));
$completebloodcount->gran=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['gran']))));
$completebloodcount->granflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['granflag']))));
$completebloodcount->mid=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['mid']))));
$completebloodcount->midflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['midflag']))));
$completebloodcount->rbc=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['rbc']))));
$completebloodcount->rbcflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['rbcflag']))));
$completebloodcount->hgb=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['hgb']))));
$completebloodcount->hgbflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['hgbflag']))));
$completebloodcount->hctpercentage=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['hctpercentage']))));
$completebloodcount->hctpercentageflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['hctpercentageflag']))));
$completebloodcount->mcv=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['mcv']))));
$completebloodcount->mcvflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['mcvflag']))));
$completebloodcount->mch=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['mch']))));
$completebloodcount->mchflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['mchflag']))));
$completebloodcount->mchc=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['mchc']))));
$completebloodcount->mchcflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['mchcflag']))));
$completebloodcount->rdwcvpercentage=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['rdwcvpercentage']))));
$completebloodcount->rdwcvpercentageflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['rdwcvpercentageflag']))));
$completebloodcount->rwsd=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['rwsd']))));
$completebloodcount->rwsdflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['rwsdflag']))));
$completebloodcount->plt=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['plt']))));
$completebloodcount->pltflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['pltflag']))));
$completebloodcount->mpv=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['mpv']))));
$completebloodcount->mpvflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['mpvflag']))));
$completebloodcount->pdw=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['pdw']))));
$completebloodcount->pdwflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['pdwflag']))));
$completebloodcount->pct=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['pct']))));
$completebloodcount->pctflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['pctflag']))));
$completebloodcount->plcr=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['plcr']))));
$completebloodcount->plcrflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['plcrflag']))));
$completebloodcount->plcc=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['plcc']))));
$completebloodcount->plccflag=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['plccflag']))));
$completebloodcount->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['patientnumber']))));
$completebloodcount->transactionid=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['procedureid']))));
$completebloodcount->name=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['name']))));
$completebloodcount->age=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['age']))));
$completebloodcount->gender=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['gender']))));
$completebloodcount->procedure=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['procedure']))));
$completebloodcount->date=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['date']))));

$completebloodcount->trackkey=str_pad(rand(1,10000000),8, '0', STR_PAD_LEFT);


$connect ->query( " INSERT INTO completebloodcountresults (TRACKKEY,PATIENTNUMBER,GENDER,AGE, WBC, WBCFLAG, LYMPHPERCENTAGE, LYMPHPERCENTAGEFLAG, GRANPERCENTAGE, GRANPERCENTAGEFLAG, MIDPERCENTAGE, MIDPERCENTAGEFLAG,
LYMPH, LYMPHFLAG, GRAN, GRANFLAG, MID, MIDFLAG, RBC, RBCFLAG, HGB, HGBFLAG, HCTPERCENTAGE, HCTPERCENTAGEFLAG, MCV, MCVFLAG, MCH, MCHFLAG, MCHC, MCHCFLAG, 
RDWCVPERCENTAGE, RDWCVPERCENTAGEFLAG, RWSD, RWSDFLAG, PLT, PLTFLAG, MPV, MPVFLAG, PDW, PDWFLAG, PCT, PCTFLAG, PLCR, PLCRFLAG, PLCC, PLCCFLAG,ATTENDANT, DATE) 
VALUES ('$completebloodcount->trackkey','$completebloodcount->patientnumber','$completebloodcount->gender','$completebloodcount->age','$completebloodcount->wbc','$completebloodcount->wbcflag', '$completebloodcount->lymphpercentage', '$completebloodcount->lymphpercentageflag', '$completebloodcount->granpercentage', '$completebloodcount->granpercentageflag', 
'$completebloodcount->midpercentage', '$completebloodcount->midpercentageflag', '$completebloodcount->lymph', '$completebloodcount->lymphflag', '$completebloodcount->gran', '$completebloodcount->granflag', '$completebloodcount->mid', '$completebloodcount->midflag', '$completebloodcount->rbc', 
'$completebloodcount->rbcflag', '$completebloodcount->hgb', '$completebloodcount->hgbflag', '$completebloodcount->hctpercentage', '$completebloodcount->hctpercentageflag', '$completebloodcount->mcv', '$completebloodcount->mcvflag', '$completebloodcount->mch', '$completebloodcount->mchflag', '$completebloodcount->mchc', '$completebloodcount->mchcflag', '$completebloodcount->rdwcvpercentage', '$completebloodcount->rdwcvpercentageflag',
 '$completebloodcount->rwsd', '$completebloodcount->rwsdflag', '$completebloodcount->plt', '$completebloodcount->pltflag', '$completebloodcount->mpv', '$completebloodcount->mpvflag', '$completebloodcount->pdw', '$completebloodcount->pdwflag', '$completebloodcount->pct', '$completebloodcount->pctflag', '$completebloodcount->plcr', '$completebloodcount->plcrflag', '$completebloodcount->plcc', '$completebloodcount->plccflag','$dbdetails->user','$completebloodcount->date')");

$connect ->query("UPDATE consultation SET  URGENCY='CONSULTATION' WHERE PATIENTNUMBER='$completebloodcount->patientnumber' ");
$connect->query("INSERT INTO events(USER,ACTION,SESSION,DATE) VALUES('$dbdetails->user','ENTER COMPLETE BLOOD COUNT RESULTS FOR PATIENT NUMBER $completebloodcount->patientnumber',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR) ) ");
$connect ->query("UPDATE pendingsales SET STATUS='ISSUED' WHERE ID=$completebloodcount->transactionid ");

?>
<div class="mr-5 ml-5  border border-black px-4  ">
<br>
 <div class="flex justify-center"><div style="text-align:center;"><img src="letterhead.png"    id="letterhead"   width="150%"  height="30%"   /></div></div>

<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" >COMPLETE BLOOD COUNT </h4>


<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >NAMES</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $completebloodcount->name; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >AGE</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $completebloodcount->age; ?></td>
</tr>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >GENDER</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $completebloodcount->gender; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >REFF NUMBER</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php  print $completebloodcount->trackkey; ?></td>
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
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->wbc; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->wbcflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >4.0-10.0</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >LYMPH %</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->lymphpercentage; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->lymphpercentageflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >20.0-40.0</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >GRAN %</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->granpercentage; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->granpercentageflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >50.0-70.0</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >MID %</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->midpercentage; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->midpercentageflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >3.0-9.0</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >LYMPH #</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->lymph; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->lymphflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >0.8-4.00</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >GRAN #</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->gran; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->granflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >2.00-7.00</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >MID #</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->mid; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->midflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >0.10-0.90</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >HCT %</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->hctpercentage; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->hctpercentageflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >35.0-50.0</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >RBC</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->rbc; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->rbcflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >4.00-5.20</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >HGB</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->hgb; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->hgbflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >12.00-16.00</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >MCV</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->mcv; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->mcvflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >82-100</div></td>

</tr>

<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >MCH</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->mch; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->mchflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >27-34</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >RDW-CV%</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->rdwcvpercentage; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->rdwcvpercentageflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >11.5-14.5</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >MCHC</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->mchc; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->mchcflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >32-36</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >RW-SD</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->rwsd; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->rwsdflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >35.0-56-0</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >PLT</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->plt; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->pltflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >150-450</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >MPV</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->mpv; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->mpvflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >7.00-11.00</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >PDW</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->pdw; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->pdwflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >9.00-17.00</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >PCT</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->pct; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->pctflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >0.108-0.282</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >P-LCR</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->plcr; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->plcrflag; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div >11.00-45.00</div></td>

</tr>
<tr class="hover:bg-green-100 text-center" >
<td  class="w-1/6  border border-black px-4 py-2"><div >PLCC</div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->plcc; ?></div></td>
<td  class="w-1/6  border border-black px-4 py-2"><div ><?php print $completebloodcount->plccflag; ?></div></td>
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
<td class="w-1/6  border border-black px-4 py-2" ><?php print $completebloodcount->date; ?></td>
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