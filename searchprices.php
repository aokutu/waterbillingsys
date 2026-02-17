<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE   name='$user' AND password='$password'      ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$x="SELECT PRICE,BPRICE FROM  INVENTORY WHERE  ITEM ='".$_SESSION['item']."' LIMIT 1 ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$price=$y['PRICE'];$bprice=$y['BPRICE'];}}
	
?>
<div id='sprice'>
<input type="text"  pattern="[0-9.]+" title="INVALID ENTRIES"  class="form-control input-sm" style='text-transform:uppercase' value="<?php print $price ;?>" name="sprice"   id="unitprice" required="on" />
</div>


<div id='bprice'>
		<input type="text"  required="on"   pattern="[0-9.]+" title="INVALID ENTRIES"  class="form-control input-sm"  name="buyprice"  value="<?php print $bprice;?>" id="unitbuyprice" required="on" />
</div>


