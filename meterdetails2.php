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
		{$location=$y[6];$name=$y['client']; $contact=$y['contact']; $lastreading=$y['email']; $meternumber=$y['meternumber'];  $category=$y['class']; $status=$y['status']; $size=$y['size'];  $idnumber=$y['idnumber']; $avg=$y['avg']; $lastreadingdate=$y['date2'];$avgunit=$y['avgunit']; }}
?>
     <div class="container" id="accountdetails">
	 
	
	 
	<script type="text/javascript" >
  $(document).ready(function(){
    $("#avgunits").prop("disabled",true); })
    </script> 
	 
	  <h4   style="text-align:center"><strong>SINGULAR BILLING  </strong></h4>
  <div class="row">
  <div class="col-sm-10">  <br>
  
  <div >
METER NUMBER
  <input  style='text-transform:uppercase' name="meter" type="text" size="15"    readonly  class="form-control input-sm"     autocomplete="off"  value="<?php  echo $meternumber;?>" ><br/>
ACCOUNT NUMBER
<input  style='text-transform:uppercase' name="clientaccount"  size="15"  readonly="readonly" value="<?php echo  $account;?>"   class="form-control input-sm"     autocomplete="off" ><br/>
METER  READINGS
<input  style='text-transform:uppercase' name="previous" type="text" size="15"  pattern="[0-9.]+" title="INVALID ENTRIES"     readonly  class="form-control input-sm"      autocomplete="off"   value="<?php  echo $lastreading ;?>"><br />
LAST BILLING DATE
<input  style='text-transform:uppercase' name="previous" type="text" size="15"     readonly  class="form-control input-sm"     autocomplete="off"   value="<?php  echo $lastreadingdate;?>"><br />

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
<input   name="current" type="text" <?php  if($avg =='AVG'){print 'value="'.$avgunit.'" readonly ';}   ?>  pattern="[0-9.]+"  title="INVALID ENTRIES" size="15"   class="form-control input-sm"     autocomplete="off" ><br />
DEDUCTIONS
<input readonly  name="deduction" type="text"    pattern="[0-9.]+"  title="INVALID ENTRIES" size="15"   class="form-control input-sm"     autocomplete="off" ><br />

READING DATE
<input  style='text-transform:uppercase' name="date"    type="date" size="15"    class="form-control input-sm"     autocomplete="off" ><br />
</div>
<br/>
 
  </div><div class="col-sm-4"></div><div class="col-sm-4"></div></div><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button></div><br>