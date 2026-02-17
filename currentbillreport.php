<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
@$date=$_POST['date']; @$account=$_SESSION['account'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'BILLING'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$account=$_SESSION['account'];

$x="SELECT * FROM $accountstable  WHERE  account='$account' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $name=$y['client'];$account=$y['account']; $status=$y['status'];$contact=$y['contact'];$meter=$y['meternumber'];$size=$y['size'];}}
	
$x="SELECT * FROM  $billstable  WHERE  account='$account' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ }}
?>
<div id="currentbillreporttable" >
<style>
	</style>
 <table class="table table-bordered"  id="tbl1" >
  <tr>
 <td    height="21" valign="top" ><div class="bold">ACCOUNT NAME :<?php echo $name;?>	</div>  </td>
</tr>
 </table>ACCOUNT DETAILS
	<table class="table table-bordered" >
 
		  <tr>
            <td    height="21" valign="top" ><div class="bold">ACCOUNT NUMBER	</div>  </td>
			 <td    height="21" valign="top" ><?php echo $account;?></td> 
			 <td    height="21" valign="top" ><div class="bold">METER NUMBER</div></td>            
			  <td   valign="top"><?php echo $meter;?></td>
		</tr>
<tr>		
			 <td    height="21" valign="top" ><div class="bold">METER SIZE.</div></td>            
			  <td   valign="top"><?php echo $size;?></td>
			  <td    height="21" valign="top" ><div class="bold">METER STATUS </div></td>            
			  <td   valign="top"><?php echo $status;?></td> 
			  
			   
          </tr> 
		  
		 	  
		  
	</table>
	
</div>