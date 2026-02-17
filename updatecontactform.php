<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'EDIT CONTACTS'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$phone=$_POST['phone'];@$newcontact=$_POST['newcontact'];

foreach($phone as $key =>$data)
{
if($data =='' ){unset($phone[$key]);}
} 


foreach($phone as $key =>$data)
{
if($newcontact=='CELL')
{
	$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'EDITED PHONE NUMBER IN ACC $key',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE $accountstable SET contact ='$data' WHERE account='$key'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO outbox(ACCOUNT,CONTACT,MESSAGE,STATUS,DATE) VALUES('$key','$data','SMS ALERT ACTIVATED','PENDING',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));
}
else if($newcontact=='EMAIL')
{
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'EDITED EMAIL ADDRESS IN ACC $key',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE $accountstable SET clientemail ='$data' WHERE account='$key'";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="INSERT INTO outbox(ACCOUNT,CONTACT,MESSAGE,STATUS,DATE) VALUES('$key','$data','EMAIL ALERT ACTIVATED','PENDING',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));
	
}

} 
$_SESSION['message']="CONTACTS UPDATED"; exit;
?>