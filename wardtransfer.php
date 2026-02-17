<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="NURSE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class inpatientid extends dbdetails
{
public $id=null;	
}

$inpatientid =new inpatientid;
$inpatientid->id=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['inpatientid']))));
?>

<form method="post" action="wardtransfer2.php">
<h3 style="text-align:center;font-decoration:underline;">WARD TRANSFER</h3>
<?php
$x=$connect->query("SELECT PATIENTNUMBER,WARD,BEDNUMBER FROM inpatientsrecord WHERE ID='$inpatientid->id' ");
while ($data = $x->fetch_object())
{ ?>

  <div class="container">
  <div class="row">
  <div class="col-sm-8">  PATIENT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  PATIENT NAME" data-placement="bottom">
<input readonly  style='text-transform:uppercase' value="<?php print $data->PATIENTNUMBER; ?>"  name="patientnumber" type="text"  pattern="[0-9A-Za-z]+"  title="ENTER CAPITAL ALPHA NUMERIC "   size="15" placeholder="ENTER PATIENT NAME."  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

<br>
WARD <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT WARD " data-placement="bottom"> 
 <select class="form-control"   required="on"  name="ward" >
  <option value="<?php print $data->WARD; ?>"><?php print $data->WARD; ?></option>
	 <option value="MALE">MALE</option>
        <option value="FEMALE">FEMALE</option>
		<option value="PAEDIATRIC">PAEDIATRIC</option>
			  </select></a>
	<br>
	BED NUMBER <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  PATIENT NAME" data-placement="bottom">
<input   style='text-transform:uppercase' value="<?php print $data->BEDNUMBER; ?>"  name="bednumber" type="number"  min="1" max="10" pattern="[0-9]{2}"  title="ENTER NUMERIC "  required size="15" placeholder="ENTER BED NUMBER."  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

	
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="newpatient">CLOSE</button>   

 </div>
  

<div class="col-sm-4">
</div>
</div></div>


<?php
}
?>

</form>
