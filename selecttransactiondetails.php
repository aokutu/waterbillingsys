 <?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>

	<select readonly class="form-control input-sm"  id="transactiondetails2"  name="transactiondetails" required="on" >
<?php 
$x="SELECT ID,TRANSACTION,ACCOUNT,DEPOSITDATE,CREDIT,CREDIT2 FROM $wateraccountstable WHERE ID='".$_SESSION['transactionid']."'  AND CREDIT2 >0 AND CODE !='REVERSED' ";
$x="SELECT ID,TRANSACTION,ACCOUNT,DEPOSITDATE,CREDIT,CREDIT2 FROM $wateraccountstable  WHERE ID='".$_SESSION['transactionid']."' AND CREDIT2 >0 AND CODE !='REVERSED' ";
//	$x="SELECT ID,TRANSACTION,ACCOUNT,DEPOSITDATE,CREDIT,CREDIT2 FROM WATERACCOUNTS2  ";

	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "<option value='".$y['ID']."'>".$y['TRANSACTION']." ".$y['ACCOUNT']." ".$y['DEPOSITDATE']." ".number_format($y['CREDIT'],2)." ".number_format($y['CREDIT2'],2)."</option>";	
		}}
		

?>
    </select>	
	