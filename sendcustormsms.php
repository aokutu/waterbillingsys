<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'SEND  SMS-EMAILS'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$message=$_POST['message']; if($message==""){$_SESSION['message']="SMS/EMAILS MISSING  ";	 exit; }
$contacts=$_POST['contacts'];@$mode=$_POST['mode'];

foreach($contacts as $id)
{
$x="SET @MAXID=(SELECT MAX(ID) FROM outbox)";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));	

if($mode=='EMAIL')
{
$x="INSERT INTO outbox(account,contact,message,status,date,id)  SELECT ACCOUNT ,CLIENTEMAIL,CONCAT('$message'),CONCAT('PENDING'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT(@MAXID := 1 + @MAXID)  
FROM $accountstable  WHERE ID=$id ";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
	
}
else if($mode=='CELL')
{
$x="INSERT INTO outbox(account,contact,message,status,date,id)  SELECT ACCOUNT ,CONTACT,CONCAT('$message'),CONCAT('PENDING'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT(@MAXID := 1 + @MAXID)  
FROM $accountstable  WHERE ID=$id ";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
	
	
}
$x="SELECT ACCOUNT  FROM  $accountstable WHERE ID=$id";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$acc=$y['ACCOUNT'];}} 
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'SEND  CUSTORM  MESSAGE  TO ACC $acc',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}
$_SESSION['message']="SMS/EMAILS BEING POSTED  ";	 exit;

?>