<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
@$min=$_SESSION['min'];@$max=$_SESSION['max'];@$min2=$_SESSION['min2'];@$max2=$_SESSION['max2'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND  level >=1  AND  level ='ACTIVE'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{echo "ACCESS DENIED ";exit;}

$x="SELECT MAX(id) FROM   $billstable ";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){ while ($y=@mysqli_fetch_array($x)) {$maxid=$y['MAX(id)'];}}

@$meter=$_POST['meter']; @$balance=$_POST['balance'];

foreach($meter as $key =>$data)
{
if($data ==""){unset($meter[$key]);}
} 

foreach($meter as $key =>$data)
{
$data=addslashes($data);
$x="SELECT * FROM $accountstable WHERE meternumber='$data' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){  unset($meter[$key]);  }
else if( mysqli_num_rows($x)<1){$x="UPDATE $accountstable SET meternumber='$data' WHERE id=$key";mysqli_query($connect,$x)or die(mysqli_error($connect));}
} 

foreach($balance as $key =>$data)
{
if($data <=0){unset($balance[$key]);}
} 

foreach($balance as $key =>$data)
{ 
$data=addslashes($data);
$x="SELECT *   FROM  $billstable WHERE account=(SELECT account FROM $accountstable WHERE account='$key')  ORDER BY id DESC LIMIT 0,1  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
while ($y=@mysqli_fetch_array($x))
		 {$account=$y['account']; $meter=$y['meternumber'];$current=$y['current'];}}
$x="INSERT INTO $billstable (meternumber,current,previous,account,balance,status,date,user) VALUES ('$meter',$current,$current,'$account',$data,'CLEARED',now(),'$user')";
mysqli_query($connect,$x)or die(mysqli_error($connect));				 
}
echo "SUBMITTED  ";
?>