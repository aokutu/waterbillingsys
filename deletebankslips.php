  <?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS    REGEXP  'UPLOAD SLIPS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$slipname=$_POST['filename'];@$action=$_POST['action'];
if($action=='DELETE')
{
	$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS    REGEXP  'DELETE UPLOAD SLIPS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

foreach($slipname as $slip)
{
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'DELETED BANLSLIP ".$slip."  FROM ARCHIVES',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$filepath='uploads/backup/banksuploads/'.$slip;
unlink($filepath);

}
header("LOCATION:backuprestore.php");	
exit;
}
else if($action=="EXPORT")
{
$slip=reset($slipname);
copy('uploads/backup/banksuploads/'.$slip,'uploadreport.txt');
passthru('uploadreportcsv.pyw');
$_SESSION['message']="EXPORTED SLIPS ";
}


?>