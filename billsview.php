<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'EDIT BILLS'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['billsid']=-1;}

$billsid=$_SESSION['billsid'];
$x="SELECT *,billed,deduction,previous,current,units,balance,metercharges  FROM   $billstable   WHERE  id=$billsid";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$account=$y['account'];$meternumber=$y['meternumber']; $previous=$y['previous'];
	$current=$y['current'];$billed=$y['billed']; $bal=$y['balance'];$standingcharges=$y['metercharges']; $units=$y['units'];$deduction=$y['deduction'];  $date=$y['date'];}}
?>
     <div class="container" id="billsdetails">
	  <h4   style="text-align:center"><strong>EDIT BILL  </strong></h4>
  <div class="row">
  <div class="col-sm-4">  <br>
 ACCOUNT NUMBER
<input type="text" readonly style='text-transform:uppercase' name="clientaccount" required  size="15"   value="<?php echo  $account;?>" pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"   class="form-control input-sm"     autocomplete="off" ><br/>
REFF NUMBER 
<input type="text" style='text-transform:uppercase' name="reffnumber"  size="15"  readonly="readonly" value="<?php echo  $billsid;?>"   class="form-control input-sm"      ><br/>
<input type="hidden" style='text-transform:uppercase' name="action"  size="15" required  readonly="readonly" value="BILLEDIT" id="billsaction"  class="form-control input-sm"     >


METER NUMBER
  <input  style='text-transform:uppercase' name="meter" type="text" size="15"  pattern="[A-Za-z0-9 -]+"  title="ENTER ALPHANUMERIC CHARACTERS"     class="form-control input-sm"  required   autocomplete="off"  value="<?php  echo  trim($meternumber);?>" ><br/>
PREVIOUS  READING 
<input  style='text-transform:uppercase'  name="previous"  type="text" size="15"   pattern="[0-9.]+"  title="INVALID ENTRIES"     class="form-control input-sm"   required  autocomplete="off"   value="<?php  echo $previous ;?>"><br />
CURRENT  READINGS
<input  style='text-transform:uppercase' required name="current" id="current" type="text" size="15"   pattern="[0-9.]+"  title="INVALID ENTRIES"     class="form-control input-sm"     autocomplete="off"   value="<?php  echo $current ;?>"><br />

 </div>
<div class="col-sm-4"><br>
BILLED
<input  style='text-transform:uppercase'  name="billed" id="billed" type="text" size="15"    pattern="[0-9.]+"  title="INVALID ENTRIES"    class="form-control input-sm"     autocomplete="off"  required value="<?php  echo $billed;?>"><br />
DEDUCTION
<input  style='text-transform:uppercase'  name="deduction" id="deduction" type="text" size="15"    pattern="[0-9.]+"  title="INVALID ENTRIES"    class="form-control input-sm"     autocomplete="off"  required value="<?php  echo $deduction;?>"><br />
 
 UNITS
<input  style='text-transform:uppercase'  name="units" id="units" type="text" size="15"    pattern="[0-9.]+"  title="INVALID ENTRIES"    class="form-control input-sm"     autocomplete="off"  required value="<?php  echo $units ;?>"><br />
   READING DATE
<input  style='text-transform:uppercase' name="date"  required   type="date" size="15"   value="<?php echo $date;?>" class="form-control input-sm"     autocomplete="off" ><br />

 
 
  </div>   
  
  <div class="col-sm-4"><br>
  STANDING CHARGES<input  style='text-transform:uppercase' name="standingcharges" type="text" size="15"   pattern="[0-9.-]+"  title="INVALID ENTRIES"  required   class="form-control input-sm"     autocomplete="off"   value="<?php  echo $standingcharges;?>"><br />

WATER CHARGES<input  style='text-transform:uppercase' name="watercharges" type="text" size="15"   pattern="[0-9.-]+"  title="INVALID ENTRIES"  required   class="form-control input-sm"     autocomplete="off"   value="<?php  echo $bal;?>"><br />

TTL CHARGES<input  style='text-transform:uppercase' name="ttlcharges" type="text" size="15"   pattern="[0-9.-]+"  title="INVALID ENTRIES"  required   class="form-control input-sm"     autocomplete="off"   value="<?php  echo $bal;?>"><br />


 <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
  <button type="reset" class="btn-info btn-sm">RESET</button> 
  </div>
  </div>
 
  </div><br>