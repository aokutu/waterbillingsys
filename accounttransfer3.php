<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2']; 
include_once("password.php");
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];

$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'ACCOUNT TRANSFER'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="INVALID ENTRIES";exit;}$class=$_POST['class'];
@$newaccount=$_POST['newaccount'];$newaccount=addslashes($newaccount);if($newaccount <1){$_SESSION['message']="INVALID ENTRIES";exit;}
@$oldaccount=$_POST['oldaccount'];$oldaccount=addslashes($oldaccount);if($oldaccount <1){$_SESSION['message']="INVALID ENTRIES";exit;}
@$name=$_POST['name'];$name=strtoupper(addslashes($name));if($name==""){$_SESSION['message']="INVALID ENTRIES";exit;}
@$meter=$_POST['meter'];$meter=addslashes($meter);
@$contact=$_POST['contact'];$contact=addslashes($contact);if($contact==""){ $contact='2547';} 


@$idnumber=strtoupper(addslashes($_POST['idnumber']));  @$email=$_POST['email'];
@$location=strtoupper(addslashes($_POST['location']));

$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstablex='accounts'.$i; $meterstablex='meters'.$i;	
	$b="SELECT * FROM $accountstablex WHERE ACCOUNT='$newaccount'";
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){$_SESSION['message']=$newaccount." EXISTS IN ".$accountstablex;$_SESSION['account']=0; exit;}

	$b="SELECT * FROM $meterstablex WHERE ACCOUNT='$newaccount'";
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){$_SESSION['message']=$newaccount." EXISTS IN ".$meterstablex;$_SESSION['account']=0; exit;}


		}
		}
		
if(mysqli_num_rows($x)<1){$_SESSION['message']="ACCOUNT ".$account."MISSING IN ZONE".$zone;exit;}
$x="DELETE FROM $wateraccountstable WHERE ACCOUNT ='$oldaccount'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM $billstable WHERE ACCOUNT ='$oldaccount'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM $nonwaterbills WHERE ACCOUNT ='$oldaccount'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM $statushistorytable WHERE ACCOUNT ='$oldaccount'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE $accountstable  SET client='$name' ,location='$location',idnumber='$idnumber',contact='$contact',
clientemail='$email',class='$class' ,account='$newaccount' WHERE account='$oldaccount' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE clientmetersreg  SET account='$newaccount'  WHERE account='$oldaccount' ";mysqli_query($connect,$x)or die(mysqli_error($connect));

if($meter !="")
{
$x="INSERT INTO metertrail (METERNUMBER,ACCOUNT,ACTIVITY,DATE) VALUES('$meter','$newaccount','TRANSFER ACC $oldaccount ',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));
}
if (($meter =="") || ($meter ==null )){$meter ='NOT INSTALLED';}
$x="INSERT INTO $statushistorytable(account,meter,status,task,date) VALUES('$newaccount','$meter','TRANSFER ACC $oldaccount','ACCOUNT TRANSFER',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'$oldaccount  ACC TRANSFER TO  $newaccount ',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']="ACCOUNT  TRANSFERED";
$_SESSION['newaccount']=null;$_SESSION['account']=null;


exit; 


?>
