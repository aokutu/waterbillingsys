<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'DELETE SLIPS'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS DENIED";exit;}

@$action=$_POST['action'];
$del=$_POST['del'];

foreach($del as $id)
{
  if($id <1){unset($del[$id]);}
}



foreach($del as $id)
{
	
$x="SELECT transaction,code,account,credit FROM $wateraccountstable   WHERE id=$id";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{ while ($y=@mysqli_fetch_array($x)){ $acc=$y['account'];$amnt=$y['credit'];$reff=$y['transaction'];$code=$y['code'];}}
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'DELETED SLIP  REFF NO .$id',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));
}


foreach($del as $id)
{
$x="DELETE FROM $wateraccountstable   WHERE id=$id";mysqli_query($connect,$x)or die(mysqli_error($connect));
}
$_SESSION['message']="SLIPS  DELETED ";exit;

?>
