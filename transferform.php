<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP 'ACCOUNT TRANSFER'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ include_once("accessdenied.php");exit;}

$account=$_SESSION['account'];$newaccount=$_SESSION['newaccount'];
$x="SELECT *  FROM  $accountstable  WHERE  account='$account'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$location=$y[6];$name=$y['client']; $contact=$y['contact']; $lastreading=$y['email']; $meternumber=$y['meternumber'];  $category=$y['class']; $status=$y['status']; $size=$y['size'];  $idnumber=$y['idnumber']; $email=$y['clientemail']; }}
?>
     <div class="container" id="accountdetails">
  <div class="row">
  <div class="col-sm-5">  <br>
  
  <div class="frmSearch">
ACCOUNT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom">
<input  style='text-transform:uppercase' name="oldaccount" type="text" size="15" placeholder="ENTER ACCOUNT XNO." pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES" readonly="readonly" value="<?php echo  $account;?>" required="on"  class="form-control input-sm"   id="search-box"    autocomplete="off" ></a><br/>
NEW  ACCOUNT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom">
<input  style='text-transform:uppercase' name="newaccount" type="text" size="15" placeholder="ENTER ACCOUNT NO." pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES" readonly="readonly" value="<?php echo  $newaccount;?>" required="on"  class="form-control input-sm"   id="search-box"    autocomplete="off" ></a><br/>
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

  </div><br><div class="col-sm-5">METER NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom">
  <input  style='text-transform:uppercase' name="meter" type="text" size="15" placeholder="ENTER METER NUMBER."  readonly  class="form-control input-sm" pattern="[A-Za-z0-9]+"  title="ENTER ALPHANUMERIC CHARACTERS"  autocomplete="off"  value="<?php  echo $meternumber;?>" ></a><br/>
ACCOUNT  CATEGORY 
 <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT ACCOUNT  CATEGORY" data-placement="bottom"> 
 <select class="form-control"   required= "on"  name="class" >
 
			   <option value="<?php echo $category;?>"><?php echo $category;?></option>
			  <option value="A">A(Individual)</option>
	      <option value="B">B(Institution)</option>
	      <option value="C">C(Industrial)</option>
	      <option value="D">D(Kiosk)</option>
		   <option value="E">E(BULKY)</option>
		<option value="F">F(UN BILLED)</option>
		  <option value="PRIVATE">PRIVATE</option>
			  </select></a><br/>
EMAIL ADDRESS<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  EMAIL ADDRESS" data-placement="bottom">
<input   name="email" type="text"  pattern="[0-9A-Za-z@_- ]+"  title="INVALID EMAIL ADDRESS "  value="<?php print $email;?>" size="15" placeholder="ENTER  EMAIL ADDRESS."    class="form-control input-sm"     autocomplete="off" ></a>
<br />	<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
	  
</div><div class="col-sm-2"></div></div></div>