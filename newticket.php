<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];

include_once("password.php");
@$mode=$_POST['mode'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'GENERATE TICKETS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$account=$_POST['account'];@$category=$_POST['category'];@$complain=$_POST['complain'];$complain=strtoupper(addslashes(nl2br($complain)));
$ticket=rand(0,9999);


$ticket=rand(0,9999);

for ($counter = 0; $counter < 9999; $counter++)
{
	$x="SELECT * FROM TICKETS WHERE  TICKET=$ticket";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{ $ticket=rand(0,9999);} else {$ticket2=$ticket; print $ticket2 ;
	
	$x="SET @complain='$complain'";mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="SET @category='$category'";mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="SET @ticket='$ticket2'";mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="SET @user='$user'";mysqli_query($connect,$x)or die(mysqli_error($connect));
if($mode=='SMS')
{
$x="INSERT INTO TICKETS (account,contact,complain,category,ticket,date) SELECT account,contact,concat(@complain),concat(@category),concat(@ticket),now() FROM $accountstable WHERE ACCOUNT='$account'";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
}
else if($mode=='EMAIL')
{
$x="INSERT INTO TICKETS (account,contact,complain,category,ticket,date) SELECT account,clientemail,concat(@complain),concat(@category),concat(@ticket),now() FROM $accountstable WHERE ACCOUNT='$account'";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
}	

$x="INSERT INTO events(user,session,action,date) SELECT concat(@user),CURRENT_TIMESTAMP ,concat(concat('GENERATE TICKET NO '),concat(@ticket)),CURRENT_DATE";
mysqli_query($connect,$x)or die(mysqli_error($connect));
	$_SESSION['message']="TICKET NUMBER  ".$ticket2;exit;}
}

?>
