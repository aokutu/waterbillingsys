<?php 
set_time_limit(0);
session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ include_once("accessdenied.php");exit;}
@$channel=$_POST['channel'];
@$lat4 =$_POST['latt4'];
@$lon4 = $_POST['long4'];
@$lat5 =$_POST['latt5'];
@$lon5 = $_POST['long5'];
$x="INSERT  INTO CHANNELS(NAME,LATTITUDE,LONGITUDE) VALUES('$channel','$lat4','$lon4') ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPDATED  MAP CHANNEL $channel',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']='ACCOUNT '.$account.' UPDATED';
header("LOCATION:mapping2.php");
?>