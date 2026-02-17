<?php
@session_start();
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);

class patientname
{
public $name=null;	
}
$patientname=new patientname;
$patientname->name=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));
$x=$connect->query("SELECT CLIENT  FROM patientsrecord WHERE ACCOUNT='$patientname->name'  ");
while ($data = $x->fetch_object())
{ ?>
<a href="#" id="patientname" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT NAME" data-placement="bottom">
<input style='text-transform:uppercase' readonly name="name"  value="<?php print $data->CLIENT; ?>" type="text"   size="15" placeholder="PATIENT NAME"   class="form-control input-sm"     autocomplete="off" ></a>
<?php
	
}



?>