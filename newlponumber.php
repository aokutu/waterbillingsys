<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$_SESSION['tenderreffnumber']=null;$_SESSION['action']=null;
$_SESSION['contractreffnumber']=null;$_SESSION['contractdate']=null;
$_SESSION['requisitionreffnumber']=null;$_SESSION['requisitiondate']=null;
$_SESSION['supplier']=null;
	$x="SELECT IFNULL(MAX(SERIALNUMBER)+1,1)  AS SERIALNUMBER   FROM LPOS  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['serialnumber']=strtoupper(str_pad($y['SERIALNUMBER'], 10, "0", STR_PAD_LEFT));	
	}}
	$_SESSION['message']="NEW REQUISITION # <br>".$_SESSION['serialnumber'];
?>