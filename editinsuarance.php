<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("interface.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="INSUARANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class editinsuarance
{
public $insuarance=null;	
}
$editinsuarance=new editinsuarance;
$editinsuarance->insuarance=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['insuarance']))));

$x=$connect->query("SELECT ID,INSUARANCE,BOXADDRESS,PHONENUMBER,EMAIL   FROM insuarances  WHERE INSUARANCE='$editinsuarance->insuarance' " );
while ($data = $x->fetch_object())
{ 
?>
<form method="post" action="editinsuarance2.php" >
  <div class="container">
  <div class="row">

    <div class="col-sm-12" >
		<input type="hidden" class="form-control input-sm" value="<?php print $data->ID; ?>"   name="insuaranceid" style='text-transform:uppercase' required="on" autocomplete="off" />

	COMPANY NAME
	<input type="text" class="form-control input-sm" value="<?php print $data->INSUARANCE; ?>" pattern="[A-Z,a-z0-9 -.]+" title="INVALID ENTRIES" id="companyname" name="companyname" style='text-transform:uppercase' required="on" autocomplete="off" />
	<br> BOX ADDRESS
		<input type="text" style="text-transform:uppercase"  value="<?php print $data->BOXADDRESS; ?>" class="form-control input-sm"  pattern="[A-Z,a-z0-9 -.]+" title="INVALID ENTRIES" id="companyaddress" name="companyaddress" style='text-transform:uppercase' required="on" autocomplete="off" />
	 	<br> PHONE
		<input type="text"  style="text-transform:uppercase" value="<?php print $data->PHONENUMBER; ?>" class="form-control input-sm"  pattern="[0-9+]+" title="INVALID ENTRIES"  id="phonenumber" name="phonenumber" style='text-transform:uppercase'  autocomplete="off" />
		<br>
		EMAIL:
		<input type="email" class="form-control input-sm"  value="<?php print $data->EMAIL; ?>" id="email" name="email"   autocomplete="off" />
		<br>
		  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   

		<br>
	</div>
  </div>
</div>
</form>


<?php }
?>
