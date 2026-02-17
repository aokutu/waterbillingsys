<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'NEW METER'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$meternumber=$_POST['meternumber'];$meternumber=strtoupper(addslashes($meternumber));
$ffdslash=strstr($meternumber,'/');if($ffdslash !=null ){$_SESSION['message']="INVALID METER NUMBER";exit;}
@$serialnumber=$_POST['serialnumber'];$serialnumber=strtoupper(addslashes($serialnumber));
@$size=$_POST['size'];$size=strtoupper(addslashes($size));
@$status=$_POST['status'];$status=strtoupper(addslashes($status));
$b="SELECT *  FROM clientmetersreg WHERE  METERNUMBER='$meternumber' OR SERIALNUMBER='$serialnumber'";
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){$_SESSION['message']="METER EXISTS ";exit;}

	$x="SELECT number FROM zones  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstablex='accounts'.$i;	

$b="SELECT * FROM $accountstablex WHERE METERNUMBER='$meternumber' ";
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){$_SESSION['message']="DUPLICATE ENTRIES IN ZONE".$i;exit; }
		}
		}	

$x="INSERT INTO clientmetersreg (METERNUMBER,SERIALNUMBER,SIZE,STATUS,ACCOUNT,ZONE) 
VALUES('$meternumber','$serialnumber','$size','$status','NOT INSTALLED','NOT INSTALLED')";mysqli_query($connect,$x)or die(mysqli_error($connect));


/*
$x="INSERT INTO metertrail (METERNUMBER,ACTIVITY,DATE) VALUES('$meternumber','NEW METER REGISTRATION',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));*/
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'NEW METER NO. $meternumber REGISTRATION ',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']="METER REGISTERED ";	 exit;
?>