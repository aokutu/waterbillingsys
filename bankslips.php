<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("password.php");
$meternumber=$_SESSION['meternumber'];@$balance=$_POST['balance'];
$meternumber=reset($meternumber);
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  AND  STATUS ='ACTIVE'  AND   LEVEL  >=5 ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{include_once("accessdenied.php");exit;} 
@$slipnumber=$_POST['slip'];  $slipnumber=addslashes($slipnumber); 
 @$amount=$_POST['amount']; $amount=addslashes($amount);
$date=$_POST['date']; $date=addslashes ($date);
$x="SELECT * FROM $accountstable  WHERE meternumber='$meternumber'  ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		while ($y=@mysqli_fetch_array($x))
		 {$account=$y['account'];
		 
		 }}
$x="SELECT MAX(id) FROM $wateraccountstable ";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){ while ($y=@mysqli_fetch_array($x)) {$maxid=$y['MAX(id)'];}}
	 
if($slipnumber !==""){
$x="SELECT * FROM $wateraccountstable  WHERE transaction='$slipnumber'  AND  depositdate='$date'  ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{echo $slipnumber ."Failed";exit;}else
{$x="INSERT INTO  $wateraccountstable (transaction,credit,date,credit2,account,depositdate) VALUES('$slipnumber',$amount,now(),$amount,'$account','$date')";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO cashflow (account,amount,date,user) SELECT account,credit,date,id FROM $wateraccountstable WHERE id>$maxid ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE cashflow SET transaction='DEPOSIT' WHERE transaction IS NULL";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'Recieved Slip  $slipnumber-$date  To $account account',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}
echo $slipnumber."-".$date."Updated";
}

?>