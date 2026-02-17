<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="REGISTRATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class clientid extends dbdetails
{
public $id=null;	
}

$clientid =new clientid;
$clientid->id=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['clientid']))));

$x=$connect->query("SELECT NEXTOFKINRELATION,GENDER,ACCOUNT,CLIENT,CONTACT,CLASS,INSUARANCE,INSUARANCENUMBER,NEXTKIN,NEXTKINCONTACT,LOCATION,IDNUMBER,CLASS,EMAIL,
BIRTHDATE,TIMESTAMPDIFF(YEAR, BIRTHDATE, DATE_ADD(NOW(), INTERVAL 10 HOUR)) AS YRS,
TIMESTAMPDIFF(MONTH,BIRTHDATE, DATE_ADD(NOW(), INTERVAL 10 HOUR)) % 12 AS  MONTHS
  FROM patientsrecord WHERE ID='$clientid->id' ");
while ($data = $x->fetch_object())
{ ?>
<style>table {
    border-collapse: collapse;width:100%;  }
  td, th {
    border: 1px solid black;
    text-align:center;width:25%;
  }
  
.heading{ text-decoration:underline;font-weight:bold;font-size:110%;}
</style>

<table width="100%">
<thead></thead>
<tbody>
<tr><td class="heading" ><div style="text-align:center;"><img src="letterhead.png"    id="letterhead"   width="50%"  height="10%"   /></div></td></tr>
</tbody>

</table>

<table width="100%">
<thead></thead>
<tbody>
<tr><td class="heading" >PATIENT DETAILS</td></tr>
</tbody>

</table>

<table >
<thead></thead>
<tbody>
<tr><td   class="heading" >PATIENT BIO DATA</td></tr>
</tbody>

</table>
<table>
<thead>

</thead>
<tbody>
<tr>
<td>PATIENT NAMES</td>
<td><?php print $data->CLIENT;?></td>
<td></td>
<td></td>
</tr>
<tr>
<td>PATIENT NUMBER</td>
<td><?php print $data->ACCOUNT;?></td>
<td>IDNUMBER</td>
<td><?php print $data->IDNUMBER;?></td>
</tr>

<tr>
<td>DATE OF BIRTH</td>
<td><?php print $data->BIRTHDATE;?></td>
<td>AGE </td>
<td><?php print $data->YRS;?> YEARS <?php print $data->MONTHS;?> MONTHS</td>
</tr>

<tr>
<td>GENDER</td>
<td><?php print $data->GENDER;?></td>
<td>RESIDENCE</td>
<td><?php print $data->LOCATION;?></td>
</tr>

</tbody>
</table>

<table >
<thead></thead>
<tbody>
<tr><td   class="heading" >CONTACT DETAILS </td></tr>
</tbody>

</table>

<table >
<thead></thead>
<tbody>
<tr>
<td>CONTACT DETAILS </td>
<td><?php print $data->CONTACT;?> </td>
</tr>
</tbody>
</table>
<table >
<thead></thead>
<tbody>
<tr>
<td>NEXT OF KIN</td>
<td><?php print $data->NEXTKIN;?> </td>
<td>NEXT OF  KIN  RELATION  </td>
<td><?php print $data->NEXTOFKINRELATION;?> </td>

</tr>

<tr>

<td>NEXT OF  KIN  CONTACT </td>
<td><?php print $data->NEXTKINCONTACT;?> </td>
<td></td>
<td> </td>
</tr>
</tbody>
</table>

<table >
<thead></thead>
<tbody>
<tr><td   class="heading" >OTHER INFORMATION </td></tr>
</tbody>

</table>


<table >
<thead></thead>
<tbody>
<tr>
<td>PATIENT CLASS </td>
<td><?php print $data->CLASS;?></td>
<td>INSUARANCE NUMBER </td>
<td><?php print $data->INSUARANCENUMBER;?> </td>
</tr>
</tbody>

</table>
<table >
<thead></thead>
<tbody>
<tr>
<td>INSUARANCE COMPANY </td>
<td><?php print $data->INSUARANCE;?></td>
</tr>
</tbody>



</table>
  <button class="btn-info btn-sm" onclick="window.print()"> <i style="font-size:200%;" class="fas fa-print"></i>PRINT</button>


<?php
}
?>