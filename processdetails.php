<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'ACCOUNTS REG'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$action=$_POST['action'];
$account=$_SESSION['account'];
if($action =='next')
{
$x="SELECT account FROM $accountstable  WHERE account  >'$account'   order by account asc  LIMIT 1 ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
while ($y=@mysqli_fetch_array($x))
{
$_SESSION['account']=$y['account'];
  }}	
  header("LOCATION:newaccountdetails2.php"); exit;	
}

else if($action =='previous')
{
$x="SELECT account FROM $accountstable  WHERE account<'$account'   order by account desc   LIMIT 1 ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
while ($y=@mysqli_fetch_array($x))
{
$_SESSION['account']=$y['account'];
  }}
header("LOCATION:newaccountdetails2.php"); exit;	  
}

else if($action =='print')
{
header("LOCATION:newaccountdetails.php"); exit;	
}

?>
