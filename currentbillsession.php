<?php 
@session_start();
@$billaccount=$_POST['account'];
include_once("password.php");
@$date=$_POST['date'];

$_SESSION['billingdate']=$date;
$x="SELECT CONCAT('$date')  AS XX,YEAR('$date') AS YR,MONTH('$date') AS MNTH ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			$_SESSION['billdaytwo']=$y['XX'];$yr=$y['YR']; $mnth=$y['MNTH']; if(strlen($mnth)==1){$mnth='0'.$mnth;} $_SESSION['billmonth']=$yr."-".$mnth;$_SESSION['billdayone']=$yr."-".$mnth."-01"; }}	
$_SESSION['month']=$month;

@$_SESSION['account']=$_POST['account'];
$_SESSION['message']=$_SESSION['billdayone']."SEARCHING  ACCOUNT BALANCE";exit;
?>