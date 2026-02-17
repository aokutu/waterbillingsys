<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'PRODUCTION BILLING'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$x="SELECT METERNUMBER,SERIALNUMBER,DATE,READING,LOCATION,LONGITUDE,LATTITUDE FROM $mastermeters WHERE  METERNUMBER ='".$_SESSION['mastermeter']."'";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
$currentreading=$y['READING'];$serial=$y['SERIALNUMBER'];$lastdate=$y['DATE'];$location=$y['LOCATION'];$longitude=$y['LONGITUDE'];$lattitude=$y['LATTITUDE'];
$longittude=$y['LONGITUDE'];
			}}
?>


<div id="content">

  <div class="container">
  <div class="row">
  <div class="col-sm-4">METER NUMBER <input type="text" name="meternumber" value="<?php print $_SESSION['mastermeter'];?>" readonly style='text-transform:uppercase'  class="form-control input-sm" autocomplete="off"><br>
  SERIAL NUMBER<input type="text"  value="<?php print $serial;?>" readonly style='text-transform:uppercase'  class="form-control input-sm" autocomplete="off"> <br> 
  CURRENT READING<input type="text" name="previous" value="<?php print $currentreading; ?>" readonly style='text-transform:uppercase'  class="form-control input-sm" autocomplete="off"><br>
  LAST READING DATE 
  <input type="text"  value="<?php print $lastdate;?>" readonly style='text-transform:uppercase'  class="form-control input-sm" autocomplete="off"><br>
  
  <input type="hidden"  name="action" id="action"  value="NEWREADING" readonly style='text-transform:uppercase'  class="form-control input-sm" autocomplete="off"></div>
  <div class="col-sm-4">NEW READING<input type="text"  name="current"  pattern="[0-9.]+"  title="ENTER  ALPHANUMERIC CHARACTERS"    style='text-transform:uppercase'  class="form-control input-sm"  autocomplete="off"><br>DATE<input type="date"  name="date"   class="form-control input-sm" autocomplete="off" ><br>
  <br><button type="submit" class="btn-info btn-sm" >SUBMIT</button>
  <button type="reset" class="btn-info btn-sm">RESET</button> 

  </div>
  <div class="col-sm-4"></div>
  </div></div>
</div>



<div id="content2">

  <div class="container">
  <div class="row">
  <div class="col-sm-4">METER NUMBER <input  required  pattern="[0-9a-zA-Z.]+"  title="ENTER  ALPHANUMERIC CHARACTERS"  type="text" name="meternumber" value="<?php print $_SESSION['mastermeter'];?>" readonly style='text-transform:uppercase'  class="form-control input-sm" autocomplete="off"><br>
  SERIAL NUMBER<input required type="text" name="serialnumber" pattern="[0-9a-zA-Z.]+"  title="ENTER  ALPHANUMERIC CHARACTERS" value="<?php print $serial;?>"  style='text-transform:uppercase'  class="form-control input-sm" autocomplete="off"> <br> 
  LOCATION<input type="text"  required name="location" pattern="[0-9a-zA-Z.]+"  title="ENTER  ALPHANUMERIC CHARACTERS"   value="<?php print $location;?>"  style='text-transform:uppercase'  class="form-control input-sm" autocomplete="off"> <br> 
 CURRENT READING<input required type="text" pattern="[0-9.]+"  title="INVALID ENTRIES"  name="current" value="<?php print $currentreading; ?>"  style='text-transform:uppercase'  class="form-control input-sm" autocomplete="off"><br>
  
  <input type="hidden"  name="action" id="action"  value="EDIT2" readonly style='text-transform:uppercase'  class="form-control input-sm"></div>
  <div class="col-sm-4">
  LONGITTUDES <input type="text"  name="longittude" value="<?php print $longittude; ?>" pattern="[0-9.-]+"  title="ENTER  ALPHANUMERIC CHARACTERS"    style='text-transform:uppercase'  class="form-control input-sm"  autocomplete="off"><br>
  LATTITUDE <input type="text"  value="<?php print $lattitude; ?>" name="lattitude"  pattern="[0-9.-]+"  title="ENTER  ALPHANUMERIC CHARACTERS"    style='text-transform:uppercase'  class="form-control input-sm"  autocomplete="off"><br>
 
   LAST READING DATE 
  <input type="date"   name="date" required value="<?php print $lastdate;?>"  style='text-transform:uppercase'  class="form-control input-sm" autocomplete="off"><br>
<br>
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
  <button type="reset" class="btn-info btn-sm">RESET</button> 

  </div>
  <div class="col-sm-4"></div>
  </div></div>
</div>

