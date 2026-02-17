<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'BILLING'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$account=$_SESSION['account'];
$x="SELECT *  FROM  $accountstable  WHERE  account='$account'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$location=$y[6];$name=$y['client']; $contact=$y['contact']; $lastreading=$y['email']; $meternumber=$y['meternumber'];  $category=$y['class']; $status=$y['status']; $size=$y['size']; $lastreadingdate=$y['date2'];  $idnumber=$y['idnumber'];$avg=$y['avg']; $avgunit=$y['avgunit'];  }}
?>
     <div class="container" id="accountdetails">
	 <h4   style="text-align:center"><strong>BILLING & IMAGING  </strong></h4>
  <div class="row">
  <div class="col-sm-10">  <br>
  
  <div >
  
   <div class="row">
  <div class="col-sm-6">METER NUMBER
  <input  style='text-transform:uppercase' name="meter" id="meter" type="text" size="15"    readonly  class="form-control input-sm"     autocomplete="off"  value="<?php  echo $meternumber;?>" ><br/>
ACCOUNT NUMBER
<input  style='text-transform:uppercase' name="account"  id="account" type="text" size="15"  readonly="readonly" value="<?php echo  $account;?>"   class="form-control input-sm"     autocomplete="off" ><br/></div>
<div class="col-sm-6">METER  READINGS
<input  style='text-transform:uppercase' name="previous" id="previous" type="text" size="15"  pattern="[0-9.]+"  title="INVALID ENTRIES"  required readonly  class="form-control input-sm"     autocomplete="off"   value="<?php  echo $lastreading ;?>"><br />
LAST BILLING DATE
<input  style='text-transform:uppercase' name="previous" type="text" size="15"     readonly  class="form-control input-sm"     autocomplete="off"   value="<?php  echo $lastreadingdate;?>"><br />


STATUS
  <input  style='text-transform:uppercase' id="status" name="status" type="text" size="15" pattern="[CONNECTED]"   readonly  class="form-control input-sm"     autocomplete="off"  value="<?php  echo $status;?>" ><br/></div></div>


  
BILLING MODE
<select class="form-control"   required= "on"  name="billingmode" id="billingmode">
			   <?php  if($avg =='AVG')
			   {print '<option value="'.$avg.'">'.$avg.'</option>
		   <option value="5">UNSET AVERAGE READING </option>
		   ';} 
else  {print '<option value=""> BILLING MODE</option>
			   <option value="1">SYTEM BILLING</option>
			  <option value="2">USER UNITS BILLING </option>
			  <option value="3">RESET LAST READING </option>
			  <option value="4">SET AVERAGE READING </option> ';}


		   ?>
			   
 			  </select>
			  
			  <br>
NEW READING/USER AVG UNITS 
<input  style='text-transform:uppercase'   <?php  if($avg =='AVG'){print 'value="'.$avgunit.'" readonly ';}   ?>  id="current"  name="current" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES"   size="15"   class="form-control input-sm"     autocomplete="off" ><br />
DEDUCTION 
<input  style='text-transform:uppercase' min="1"   name="deduction" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES"   size="15"   class="form-control input-sm"   disabled="on"  autocomplete="off" ><br />

READING DATE
<input  style='text-transform:uppercase' name="date" id="date"  value="<?php echo date("Y-m-d");?>"  type="date" size="15"   class="form-control input-sm"     autocomplete="off" ><br />
IMAGE UPLOAD
<input  disabled style='text-transform:uppercase' name="file" type="file"    size="15"  id="input"  class="form-control input-sm"  capture='enviroment'><br />
<!--    <input type="file" accept="image/*;capture=camera"> -->
</div>
<br/>
 
  </div><div class="col-sm-2"></div></div>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
  <input type='button' id="save" class="btn-info btn-sm" value='SAVE IMAGE' onclick='DownloadFile();'>
</div><br>