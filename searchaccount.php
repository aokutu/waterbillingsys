<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
@$min=$_SESSION['min'];@$max=$_SESSION['max'];@$min2=$_SESSION['min2'];@$max2=$_SESSION['max2'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{include_once("accessdenied.php");exit;}
$account=$_POST['account']; $account=strtoupper(addslashes($account));
if($_POST['date1'] !=''){@$_SESSION['date1']=$_POST['date1'];} if($_POST['date2'] !='' ){@$_SESSION['date2']=$_POST['date2'];}
if($account==""){echo "ENTER ACCOUNT "; exit;}
$account=strtoupper(addslashes($account));
if($account >0 )
{
$x="SELECT account FROM $accountstable WHERE account='$account' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
$_SESSION['min2']=$account;
$_SESSION['max2']=$account;
echo $account."  SELECTED";exit;
}

}
echo "ACCOUNT MISSING ";exit;


?>
