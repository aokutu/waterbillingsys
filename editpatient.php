<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
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
?>

<form method="post" action="editpatient2.php">
<?php
$x=$connect->query("SELECT NEXTOFKINRELATION,ACCOUNT,CLASS,INSUARANCE,INSUARANCENUMBER,CLIENT,CONTACT,BIRTHDATE,IDNUMBER,NEXTKIN,NEXTKINCONTACT,EMAIL,GENDER,LOCATION  FROM patientsrecord WHERE ID='$clientid->id' ");
while ($data = $x->fetch_object())
{ ?>

  <div class="container">
  <div class="row">
  <div class="col-sm-6">  PATIENT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  PATIENT NAME" data-placement="bottom">
<input readonly  style='text-transform:uppercase' value="<?php print $data->ACCOUNT; ?>"  name="patientnumber" type="text"  pattern="[0-9A-Za-z ]+"  title="ENTER CAPITAL ALPHA NUMERIC "   size="15" placeholder="ENTER PATIENT NAME."  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

PATIENT NAME<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  PATIENT NAME" data-placement="bottom">
<input  style='text-transform:uppercase' value="<?php print $data->CLIENT; ?>"  name="name" type="text"  pattern="[0-9A-Za-z ]+"  title="ENTER CAPITAL ALPHA NUMERIC "   size="15" placeholder="ENTER PATIENT NAME."  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

BIRTH DATE <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  BIRTH DATE " data-placement="bottom">
<input  style='text-transform:uppercase'  value="<?php print $data->BIRTHDATE; ?>" name="birthdate" type="date"   size="15" required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

 GENDER <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT PATIENT  GENDER " data-placement="bottom"> 
 <select class="form-control"   required= "on"  name="gender" >
 <option value="<?php print $data->GENDER; ?>"><?php print $data->GENDER; ?></option>
	 <option value="MALE">MALE</option>
        <option value="FEMALE">FEMALE</option>
			  </select></a>
<br />
  CONTACT<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  CONTACT"   data-placement="bottom">
<input  value="<?php print $data->CONTACT; ?>" style='text-transform:uppercase' name="contact" type="text"  pattern="[0-9]{10}"  title="ENTER 10 DIGITS "   size="15" placeholder="ENTER CONTACT"   class="form-control input-sm"       autocomplete="off" ></a><br />

RESIDENCE<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="RESIDENCE" data-placement="bottom">
<input value="<?php print $data->LOCATION; ?>" style='text-transform:uppercase'  list="residencelist" name="residence" type="text"  pattern="[0-9A-Za-z@_' - ]+"  title="ENTER RESIDENCE "   size="15" placeholder="ENTER  RESIDENCE."   class="form-control input-sm"     autocomplete="off" ></a>

<br>

  ID NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ID NUMBER" data-placement="bottom">
<input  value="<?php print $data->IDNUMBER; ?>" style='text-transform:uppercase'  name="idnumber" type="text"  pattern="[0-9A-Za-z@_' - ]+"  title="ID NUMBER"   size="15" placeholder="ID NUMBER"   class="form-control input-sm"     autocomplete="off" ></a>

 </div>
  
  
  <div class="col-sm-6">


NEXT OF KIN 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEXT OF KIN" data-placement="bottom">
<input value="<?php print $data->NEXTKIN; ?>" style='text-transform:uppercase'  name="nextofkin" type="text"  pattern="[0-9A-Za-z@_' - ]+"  title="NEXT OF KIN "   size="15" placeholder="NEXT ON KIN"   class="form-control input-sm"     autocomplete="off" ></a>
<br>NEXT OF KIN  RELATION 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEXT OF KIN RELATIONSHIP" data-placement="bottom">
<input  style='text-transform:uppercase' value=" <?php print $data->NEXTOFKINRELATION; ?>" list="relationship" name="nextofkinrelation" type="text"  pattern="[0-9A-Za-z@_' - ]+"  title="INVALID ENTRIES"   size="15" placeholder="NEXT ON KIN RELATIONSHIP"   class="form-control input-sm"     autocomplete="off" ></a>
<datalist id="relationship" >
<?php 
$b=$connect->query("SELECT DISTINCT(NEXTOFKINRELATION) AS RELATIONSHIP  FROM patientsrecord ORDER BY LOCATION  ");
while ($datax = $b->fetch_object())
{
	
?>
	 <option value="<?php print $datax->RELATIONSHIP; ?> " > <?php print $data->RELATIONSHIP; ?></option>	
		
		<?php 	
	
	
}
		  
		

?>
</datalist>
<br>NEXT OF KIN CONTACTS
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEXT OF KIN  CONTACT" data-placement="bottom">
<input value="<?php print $data->NEXTKINCONTACT; ?>" style='text-transform:uppercase'  name="nextofkincontact" type="text"  pattern="[0-9]{10}"  title="ENTER 10 DIGITS "   size="15" placeholder="NEXT OF KIN  CONTACT"   class="form-control input-sm"     autocomplete="off" ></a>

<br>

PATIENT  CATEGORY 
 <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT PATIENT  CATEGORY" data-placement="bottom"> 
 <select class="form-control"   required= "on"  name="patienttype" >
	 <option value="<?php print $data->CLASS; ?>"><?php print $data->CLASS; ?></option>
	<option value="WALK IN">CASH PAY WALK IN</option>
        <option value="INSUARANCE">INSUARANCE  PAY </option>
		<option value="INVOICED">INVOICED CREDITED </option>
			  </select></a><br />

INSUARANCE /CREDIT COMPANY
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="INSUARANCE" data-placement="bottom">
<input value="<?php print $data->INSUARANCE; ?>"  style='text-transform:uppercase' list="insuarancelist" name="insuarance" type="text"  pattern="[0-9A-Za-z ]+"  title="ENTER INSUARANCE "   size="15" placeholder="ENTER  INSUARANCE."   class="form-control input-sm"     autocomplete="off" ></a>

<br>

REFF  NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="RESIDENCE" data-placement="bottom">
<input  value="<?php print $data->INSUARANCENUMBER; ?>" style='text-transform:uppercase'   name="refferencenumber" type="text"  pattern="[0-9A-Za-z@_' - ]+"  title="INSUARANCE/THIRD PARTY NUMBER "   size="15" placeholder="INSUARANCE/THIRD PARTY NUMBER."   class="form-control input-sm"     autocomplete="off" ></a>

<br><br>

<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="newpatient">CLOSE</button>   
  
</div>
</div></div>


<?php
}
?>

<datalist id="residencelist" >
<?php 
$x=$connect->query("SELECT DISTINCT(LOCATION) AS LOCATION  FROM patientsrecord ORDER BY LOCATION  ");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->LOCATION; ?> " > <?php print $data->LOCATION; ?></option>	
		
		<?php 	
	
	
}
		  
		

?>
</datalist>

<datalist id="insuarancelist" >
<?php 
$x=$connect->query("SELECT  INSUARANCE  FROM insuarances ORDER BY INSUARANCE  ");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->INSUARANCE; ?> " > <?php print $data->INSUARANCE; ?></option>	
		
		<?php 	
	
	
}
		  
		

?>
</datalist>

</form>
