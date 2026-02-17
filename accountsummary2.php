<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$accountzone=$_SESSION['accountzone'];
@$accountx=$_SESSION['accountx'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'VIEW BILLS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$acctbl='accounts'.$accountzone;
	$x="SELECT STATUS,ACCOUNT,CLIENT,METERNUMBER,CONTACT FROM $acctbl WHERE ACCOUNT='$accountx'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$statusx=$y['STATUS'];$account=$y['ACCOUNT'];$name=$y['CLIENT'];$meternumber=$y['METERNUMBER'];$contact=$y['CONTACT'];}}
$mtrtbl='meters'.$accountzone;
$x="SELECT STATUS FROM $mtrtbl WHERE ACCOUNT='$accountx'  AND METERNUMBER='$meternumber'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$statusy=$y['STATUS'];}}
	$billstblx='bills'.$accountzone;$nonwaterbillx='nonwaterbills'.$accountzone; $wateraccountstblx='wateraccounts'.$accountzone;
	$x="SELECT (SELECT IFNULL(SUM(BALANCE),0)  FROM $billstblx WHERE ACCOUNT='$accountx') +
		(SELECT IFNULL(SUM(AMOUNT),0) FROM $nonwaterbillx WHERE ACCOUNT='$accountx')-
		(SELECT IFNULL(SUM(CREDIT),0) FROM $wateraccountstblx  WHERE ACCOUNT='$accountx' AND CODE !=(SELECT CODE FROM PAYMENTCODE WHERE NAME REGEXP 'DEPOSIT' LIMIT 1 ))   AS BALANCEX";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$bal=$y['BALANCEX'];}}
	
	$x="SELECT IFNULL(MAX(DATE),'NOT BILLED') AS LSTDATE FROM $billstblx WHERE ACCOUNT='$accountx'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$lstdate=$y['LSTDATE'];}}
	
?>
<div id="details">
 <div class="container">
  <div class="row">
 
    <div class="col-sm-4" id="" >
	ACCOUNT :<?php print $account; ?><br>
	METER NUMBER  :<?php print $meternumber;?><br>
	NAME :<?php print $name;?><br>
	CONTACT <?php print $contact;?>
	</div>
	<div class="col-sm-4" id="" >
	STATUS:<?php print $statusx;?><br>
	STATUS:<?php print $statusy;?><br>
	BALANCE:<?php print number_format($bal,2);?><br>
	LAST BILLING DATE <?php print $lstdate;?>
		</div>
	<div class="col-sm-4" id="" ></div>
	</div>
	</div>
</div>

<select class="form-control input-sm"  disabled  id="slip2"  >
<option value=''></option>
</select>

<select name="slipid"  class="form-control input-sm" name="slipid" required="on"  id="slip3">


<?php 
//$x="SELECT * FROM  $wateraccountstblx WHERE ACCOUNT='$account'  AND CODE=(SELECT CODE FROM PAYMENTCODE WHERE NAME REGEXP 'RECONNECTION' LIMIT 1)  AND  LINKED !='CLR' OR account='$account' AND CODE=(SELECT CODE FROM PAYMENTCODE WHERE NAME REGEXP 'NEW CONNECTION' LIMIT 1)  AND  LINKED !='CLR'  ";
$x="SELECT * FROM $wateraccountstblx  WHERE ACCOUNT='$account' AND CODE=(SELECT CODE FROM PAYMENTCODE WHERE NAME REGEXP 'CONP' OR NAME REGEXP 'COR' LIMIT 1)  AND  LINKED !='CLR'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{ print "<option value=''>SELECT  RECONNECTION SLIP </option>";
		 while ($y=@mysqli_fetch_array($x))
		{print '
	<option value="'.$y['id'].'">CODE   '.$y['transaction'].'   DATE    '.$y['depositdate'].'  AMNT   '.number_format($y['credit'],2).'</option>
	';}}
	else if (mysqli_num_rows($x)<1){print "<option value=''>  PAYMENT SLIP MISSING</option>";}

?>
</select>

