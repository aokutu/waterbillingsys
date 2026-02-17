<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'BACKUP DATABASE' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
 $wateraccounts = "export.txt"; 
   if(!($myFile = fopen($wateraccounts, "w"))) 
   { 
  $_SESSION['message']="DATA  EXPORTING FAILED";  exit; 
   }
$export="SELECT 'TRANSACTION','CREDIT','ACCOUNT','DEPOSITDATE','CODE','DATE'  UNION (SELECT transaction,credit,account,depositdate,code,date  FROM $wateraccountstable )";
  		$x=mysqli_query($export)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=mysqli_fetch_array($x))
		{ //foreach($y as $z){//print $z;//	fputs($myFile, $z."\n"); }
	fputs($myFile, $y[0]."\t".$y[1]."\t".$y[2]."\t".$y[3]."\t".$y[4]."\t".$y[5]."\n");
	}}
	copy('export.txt','uploads/backup/$wateraccounts.txt');
  $_SESSION['message']="DATA  EXPORTED SUCCESSFULLY";  exit; 
	?>