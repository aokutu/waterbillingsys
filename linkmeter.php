
 <?php 

@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'METER REG'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

@$account=$_POST['account']; $meternumber=$_POST['meternumber'];

	$x="SELECT * from clientmetersreg where meternumber='$meternumber'   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$size= $y['size'];}}

	
	$x="SELECT number,zone FROM zones WHERE number !='$zone' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstablex='accounts'.$i;$zonenamex=$y['zone'];

$b="SELECT * FROM $accountstablex WHERE METERNUMBER='$meternumber' ";
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){ $_SESSION['message']="METER ".$meternumber." EXISTS   IN  ZONE ".$zonenamex; }
		}
		}
	
		$x="UPDATE clientmetersreg SET ACCOUNT ='$account' ,ZONE='$zone'  WHERE    METERNUMBER='$meternumber' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE $accountstable SET METERNUMBER='$meternumber' ,SIZE= '$size' WHERE ACCOUNT ='$account' ";mysqli_query($connect,$x)or die(mysqli_error($connect));


//exit;

$x="INSERT INTO metertrail (METERNUMBER,ACCOUNT,ACTIVITY,DATE) VALUES('$meternumber','$account','INSTALLED METER ',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));

$b="INSERT INTO $statushistorytable(account,meter,status,task,date) VALUES('$account','$meternumber','INSTALLED METER','INSTALLED METER',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$b)or die(mysqli_error($connect));


$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'ACC $account  INSTALLED  METER NUMBER TO $meternumber',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));

$_SESSION['message']="ACCOUNT ".$account."LINKED";
header("LOCATION:metersregistry2.php");exit;
?>