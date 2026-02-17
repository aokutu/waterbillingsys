<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'EDIT SLIPS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['slipsid']=-1;}

$slipsid=$_SESSION['slipsid'];
$x="SELECT *  FROM  $wateraccountstable   WHERE  id=$slipsid;  ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$account=$y['account'];$transactioncode=$y['transaction'];$paypoint=$y['paypoint']; $amount=$y['credit']; $code=$y['code']; $depositdate=$y['depositdate'];$date=$y['date'];}}
?>
     <div class="container" id="slipdetails">
	  <h4   style="text-align:center"><strong>EDIT PAYMENT  </strong></h4>
  <div class="row">
  <div class="col-sm-4">  <br>
PAY POINT 
<select class="form-control"  readonly  required= "on"  name="paypoint"  >
                 <option value="<?php print $paypoint; ?> "><?php print $paypoint; ?> </option>
			    <option value="">PAY POINT </option>
			   <option value="KCB">K.C.B DEPOSIT </option>
			   <option value="KCBMPESA">K.C.B MPESA </option>
			   <option value="EQUITY">EQUITY DEPOSIT</option>
			   <option value="EQUITYMPESA">EQUITY MPESA </option>
			   <option value="COOP">COOP DEPOSIT </option>
			   
			   
		
			  </select>
			  <br>

TRANSACTION CODE
  <input  readonly style='text-transform:uppercase' name="transactioncode" type="text" size="15"  pattern="[0-9A-Za-z]+"  title="ENTER ALPHANUMERIC CHARACTERS"     class="form-control input-sm"  required   autocomplete="off"  value="<?php  echo $transactioncode;?>" ><br/>
CODE
<select readonly  class="form-control"   required= "on"  name="code"  >
			   <option value="">CODE</option>
			   
			   <?php 
	$x="SELECT * FROM paymentcode  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ print " <option value='".$y['code']."'>CODE".$y['code']."-".$y['name']."-".$y['effect']."</option>";}}		   
			   
			   ?>
			  </select><br>
 		  
  </div><div class="col-sm-4"><br>
DEPOSIT DATE
<input readonly  style='text-transform:uppercase' name="depositdate"  required   type="date" size="15"   value="<?php echo $depositdate;?>" class="form-control input-sm"     autocomplete="off" ><br />
TRANSACTION DATE
<input readonly  style='text-transform:uppercase' name="date"  required   type="date" size="15"   value="<?php echo $date;?>" class="form-control input-sm"     autocomplete="off" ><br />

 AMOUNT 
<input  style='text-transform:uppercase'  name="amount"  type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES " size="15"  pattern="[0-9]+"  title="ENTER NUMERIC CHARACTERS"     class="form-control input-sm"   required  autocomplete="off"   value="<?php  echo $amount ;?>"><br />

 
  </div>   
  
  <div class="col-sm-4"><br>
  NEW ACCOUNT ZONE 
<select class="form-control input-sm"   name="newzone" required="on" >
<option value='<?php print $zone;?>'><?php print $zonename;?></option>

<option value=''>SELECT  ZONE  FROM <?php  print $company;?></option>

<?php 
$x="SELECT * FROM zones";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "<option value='".$y['number']."'>".$y['zone']."</option>";	
		}}

?>
    </select><br>
			  
  ACCOUNT NUMBER
<input type="text"   style='text-transform:uppercase' name="clientaccount" required  size="15"   value="<?php echo  $account;?>"   class="form-control input-sm"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"   autocomplete="off" ><br/>

  REFF NUMBER 
<input   type="text" style='text-transform:uppercase' name="reffnumber"  size="15"  readonly="readonly" value="<?php echo  $slipsid;?>"   class="form-control input-sm"      ><br/>
<input type="hidden" style='text-transform:uppercase' name="action"  size="15" required  readonly="readonly" value="SLIPSEDIT" id="slipsaction"  class="form-control input-sm"     ><br/>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button>
  <button type="reset" class="btn-info btn-sm">RESET</button>
 
  
  </div>
  </div>
  </div><br> 