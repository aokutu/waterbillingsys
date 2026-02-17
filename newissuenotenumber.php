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

$_SESSION['purpose']=null;
$_SESSION['requisitioner']=null;
$_SESSION['requisitionertitle']=null;
$_SESSION['authorizer']=null; 
$_SESSION['authorizertitle']=null;
$_SESSION['issuer']=null;
$_SESSION['issuertitle']=null;
$_SESSION['approver']=null;
$_SESSION['approvertitle']=null;
@$issuenotenumber=trim(addslashes(strtoupper($_POST['issuenotenumber'])));

	$x="SELECT IFNULL(MAX(SERIALNUMBER)+1,1)  AS SERIALNUMBER   FROM REQUISITION  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['issuenotenumber']=strtoupper(str_pad($y['SERIALNUMBER'], 10, "0", STR_PAD_LEFT));	
	}}
	$_SESSION['message']="NEW ISSUE NOTE # <br>".$_SESSION['issuenotenumber'];
?>