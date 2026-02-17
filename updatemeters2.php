<?php @session_start();

$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$action=$_POST['action'];
@$id=$_POST['id'];
@$oldmeter=$_POST['oldmeter'];
@$meternumber=strtoupper($_POST['meternumber']);
@$serialnumber=strtoupper($_POST['serialnumber']);
@$size=$_POST['size'];
$status=$_POST['status'];
$zonex=$_POST['zonex'];

include_once("password.php");
 $x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'EDIT METER'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ include_once("accessdenied4.php");exit;}


	$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'EDITED METER NO. $oldmeter DETAILS ',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="SELECT number FROM zones  WHERE NUMBER !='$zone' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
	/*	{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstablex='accounts'.$i;

$b="SELECT * FROM $accountstablex WHERE METERNUMBER='$meternumber' ";
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){print "METER NUMBER ".$meternumber."EXISTS IN ZONE".i; $_SESSION['message']="METER NUMBER ".$meternumber."EXISTS IN ZONE".i;exit; }


		}
		} */
		

	$accountstablex='accounts'.$zonex;
	if($zonex >0 )
	{
	$b="UPDATE $accountstablex SET METERNUMBER='$meternumber' ,SIZE='$size' WHERE METERNUMBER =(SELECT METERNUMBER FROM     clientmetersreg WHERE ID =$id) ";
	mysqli_query($connect,$b)or die(mysqli_error($connect));
	 $x="UPDATE clientmetersreg SET METERNUMBER='$meternumber' ,SIZE='$size', SERIALNUMBER='$serialnumber', STATUS='$status'  WHERE ID =$id  ";
	mysqli_query($connect,$x)or die(mysqli_error($connect));

	$x="INSERT INTO $statushistorytable(account,meter,status,task,date) SELECT ACCOUNT,METERNUMBER,CONCAT('METER DETAILS EDITED'),CONCAT('EDITED METER DETAILS'),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM clientmetersreg WHERE  ID=$id ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="INSERT INTO metertrail (METERNUMBER,ACCOUNT,ACTIVITY,DATE) SELECT METERNUMBER,ACCOUNT,CONCAT('METER EDITED'),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM clientmetersreg WHERE  ID=$id ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('EDITED   METER ',METERNUMBER),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM clientmetersreg WHERE  ID  =$id ";mysqli_query($connect,$x)or die(mysqli_error($connect));
	    
	}
	
else 
{
 $x="UPDATE clientmetersreg SET METERNUMBER='$meternumber' ,SIZE='$size', SERIALNUMBER='$serialnumber', STATUS='$status'  WHERE ID =$id  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('EDITED   METER ',METERNUMBER),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM clientmetersreg WHERE  ID  =$id ";mysqli_query($connect,$x)or die(mysqli_error($connect));
    
    
}

header("LOCATION:metersregistry2.php"); exit;
	
		
?>