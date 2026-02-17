<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'EDIT ACCOUNT'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ include_once("accessdenied.php");exit;}

$account=$_SESSION['account'];
$x="SELECT $accountstable.meternumber,$accountstable.status,$accountstable.contact,$accountstable.deposit,
$accountstable.email,$accountstable.meternumber,$meterstable.status as meterstatus,$accountstable.status as accountstatus,
$meterstable.serialnumber,$accountstable.size as metersize,class,location,client,idnumber,plotnumber,clientemail FROM  $accountstable,$meterstable
  WHERE  $accountstable.account='$account'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$location=$y['location'];$name=$y['client']; $contact=$y['contact'];$deposit=$y['deposit'];
	$lastreading=$y['email']; $meternumber=$y['meternumber'];$meterstatus=$y['meterstatus'];
    $category=$y['class']; 
	$status=$y['accountstatus']; $size=$y['metersize'];  $idnumber=$y['idnumber']; 
	$email=$y['clientemail'];$plotnumber=$y['plotnumber'];$serialnumber=$y['serialnumber']; }}
	
?>
     <div class="container" id="accountdetails">
  <div class="row">
  <div class="col-sm-4">  <br>
  
  <div class="frmSearch">
 
ACCOUNT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom">
<input  style='text-transform:uppercase' name="account" type="text" size="15" placeholder="ENTER ACCOUNT NO." pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES" ="" value="<?php echo  $account;?>" required="on"  class="form-control input-sm"   id="search-box" readonly   autocomplete="off" ></a><br/>
ACCOUNT NAME<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT NAME" data-placement="bottom">
<input  style='text-transform:uppercase' name="name" type="text" size="15" placeholder="ENTER ACCOUNT NAME."  required="on"  class="form-control input-sm"   value="<?php echo $name;?>"  id="search-box"    autocomplete="off" ></a><br/>
CONTACT<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  CONTACT" data-placement="bottom">
<input  style='text-transform:uppercase' name="contact" type="text" size="15" placeholder="ENTER CONTACT"   value="<?php echo  $contact;?>" class="form-control input-sm"   id="search-box"  pattern="254[0-9]{9}"  title="ENTER PHONE NUMBER WITH 254 CODE "  autocomplete="off" ></a><br/>

ID  NUMBER <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  METER READINGS" data-placement="bottom">
<input  style='text-transform:uppercase' name="idnumber" type="number"   value="<?php echo $idnumber; ?>"  size="15" placeholder="ENTER  ID NUMBER"  pattern="[0-9]+"   title ='INVALID ID NUMBER'   class="form-control input-sm"   id="search-box"  pattern="[0-9]+"  title="ENTER  NUMERIC CHARACTERS"  autocomplete="off" ></a><br />
LOCATION<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  LOCATION" data-placement="bottom">
<input  style='text-transform:uppercase' name="location"  value="<?php echo $location; ?>"  type="text" size="15" placeholder="LOCATION"  required="on"  class="form-control input-sm"   id="search-box"  pattern="[a-zA-Z0-9 ]+"  title="ENTER ALPHANUMERICALS CHARACTERS"  autocomplete="off" ></a><br />
<div id="suggesstion-box"></div>
</div>
<br/>

  </div><br><div class="col-sm-4">
ACCOUNT  CATEGORY 
 <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT ACCOUNT  CATEGORY" data-placement="bottom"> 
 <select class="form-control"   required= "on"  name="class" >
 
			   <option value="<?php echo $category;?>"><?php echo $category;?></option>
			 <option value="A">A(DOMESTIC)</option>
        <option value="B">B(COMMERCIAL/INSTITUTION/GOVERMENT)</option>
       <option value="C">C(SCHOOLS)</option>
        <option value="D">D(Kiosk)</option>
		
			  </select></a><br/>
			 ACCOUNT STATUS   <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT  ACCOUNT  STATUS" data-placement="bottom"> 
 <select class="form-control"   required= "on"  name="status"  id="action">
			  <option value="<?php echo $status;?>"><?php echo $status;?></option>
			   <option value='CONNECTED'>CONNECTED</option>
              <option value='COR'>COR</option>
			  <option value='CONP'>CONP</option>
			  <option value='MNOS'>MNOS(METER NOT ON SITE )</option>
			  <option value='STOLEN'>STOLEN(METER STOLEN )</option>
			  <option value='ILLEGAL'>ILLEGAL(ILLEGAL CONNECTION)</option>
			   <option value='VANDALISED'>VANDALISED(VANDALISED  METER)</option>
			  </select></a>
			  <br>
CONNECTION NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  CONNECT ION NUMBER" data-placement="bottom">
<input   name="plotnumber"  style='text-transform:uppercase' value="<?php print $plotnumber; ?>" type="text"  pattern="[0-9A-Za-z/ _- ]+"  title="INVALID CONNECTION NUMBER"   size="15" placeholder="ENTER  CONNECTION NUMBER."   class="form-control input-sm"     autocomplete="off" ></a>
<br>


EMAIL ADDRESS<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  EMAIL ADDRESS" data-placement="bottom">
<input   name="email" type="text"  pattern="[0-9A-Za-z@_- ]+"  title="INVALID EMAIL ADDRESS "  value="<?php print $email;?>" size="15" placeholder="ENTER  EMAIL ADDRESS."    class="form-control input-sm"     autocomplete="off" ></a>
<br />	<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
	  
</div><div class="col-sm-4">

  METER NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom">
  <input  style='text-transform:uppercase'  readonly name="meter" type="text" size="15" placeholder="ENTER METER NUMBER."    class="form-control input-sm"  pattern="[A-Za-z0-9]+"  title="ENTER ALPHANUMERIC CHARACTERS"  autocomplete="off"  value="<?php  echo $meternumber;?>" ></a><br/>

  SERIAL NUMBER NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom">
  <input  readonly  style='text-transform:uppercase' name="serialnumber" type="text" size="15" placeholder="ENTER SERIAL NUMBER."    class="form-control input-sm"  pattern="[A-Za-z0-9]+"  title="ENTER ALPHANUMERIC CHARACTERS"  autocomplete="off"  value="<?php  echo $serialnumber;?>" ></a><br/>

METER  READINGS<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  METER READINGS" data-placement="bottom">
<input  readonly style='text-transform:uppercase' name="meterreading" type="text" size="15" placeholder="ENTER METER READINGS"   class="form-control input-sm"   id="search-box"  pattern="[0-9.]+"  title="ENTER METER READINGS"  autocomplete="off"  required="on"  pattern="[0-9]+"  title="ENTER  NUMERIC CHARACTERS"  value="<?php  echo $lastreading ;?>"></a><br />
METER SIZE<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  METER SIZE" data-placement="bottom">
<input  readonly style='text-transform:uppercase' name="size" type="text" value="<?php print $size;?>"   pattern="[0-9.]+"  title="INVALID ENTRIES "  size="15" placeholder="METER SIZE"    class="form-control input-sm"      autocomplete="off" ></a>
<br>
METER STATUS<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  METER STATUS" data-placement="bottom">
<input  readonly style='text-transform:uppercase' name="meterstatus"  type="text" value="<?php print $meterstatus;?>"     title="INVALID ENTRIES "  size="15" placeholder="METER STATUS"    class="form-control input-sm"      autocomplete="off" ></a>
<br>

</div></div></div>