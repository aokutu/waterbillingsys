<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP 'ACCOUNT TRANSFER' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{include_once("accessdenied4.php");exit;}
$account=$_POST['account']; $account=strtoupper(addslashes($account)); $account2=$_POST['account2']; $account2=addslashes($account2);
$x="SELECT SUM(CREDIT) FROM $wateraccountstable WHERE ACCOUNT='$account'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$deposit=$y['SUM(CREDIT)'];}}
	 
$x="SELECT SUM(BALANCE) FROM $billstable WHERE ACCOUNT='$account'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$waterbill=$y['SUM(BALANCE)'];}}
	 
	 $x="SELECT SUM(AMOUNT) FROM $nonwaterbills WHERE ACCOUNT='$account'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$nonwaterbill=$y['SUM(AMOUNT)'];}}
		$bal=$waterbill+$nonwaterbill-$deposit;
if ($bal !=0 ){$_SESSION['message']="ACC ".$account." BILL ".number_format($bal,2);$_SESSION['account']=0;exit;}

	/////////////////////////
	
$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstablex='accounts'.$i; $meterstablex='meters'.$i;	
	$b="SELECT * FROM $accountstablex WHERE ACCOUNT='$account2'";
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){$_SESSION['message']=$account2." EXISTS IN ".$accountstablex;$_SESSION['account']=0; exit;}

	$b="SELECT * FROM $meterstablex WHERE ACCOUNT='$account2'";
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){$_SESSION['message']=$account2." EXISTS IN ".$meterstablex;$_SESSION['account']=0; exit;}


		}
		}	

$_SESSION['account']=$account;
$_SESSION['newaccount']=$account2;
$_SESSION['message']="ACCOUNT SEARCH";exit;
?>
