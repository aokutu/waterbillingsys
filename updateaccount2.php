<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'MULTI EDIT' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ include_once("accessdenied.php");exit;}
@$account=$_POST['account']; @$date=$_POST['date'];
@$action=$_POST['action'];
foreach($account as $key =>$data)
{
if($data =='' ){unset($account[$key]);}
$ffdslash=strstr($data,'/');
if($ffdslash !=null ){unset($account[$key]);}

}


 if($action==2)
{
foreach($account as $key =>$data)
{
$x="UPDATE $accountstable SET email ='$data' ,date2='$date'  WHERE account='$key'";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'ACC $key EDITED METER READINGS',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}
	
	
}

else if($action==3)
{
	
	foreach($account as $key =>$data)
{
	$data=strtoupper($data);
if(($data !='A' ) &&($data !='B') &&($data !='C') &&($data !='D') &&($data !='E') &&($data !='F') &&($data !='PRIVATE')){unset($account[$key]);}

}


foreach($account as $key =>$data)
{
$data=strtoupper($data);
$x="UPDATE $accountstable SET class ='$data'  WHERE account='$key'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'ACC $key EDITED METER CLASS',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));	

}
	
	
}

else if($action==5)
{
	
	foreach($account as $key =>$data)
{
	
	$data=addslashes(strtoupper($data));
if(($data !='CONNECTED' ) &&($data !='CONP') &&($data !='COR')&&($data !='MNOS')&&($data !='STOLEN')&&($data !='ILLEGAL')&&($data !='VANDALISED')){unset($account[$key]);}

}


foreach($account as $key =>$data)
{
	$data=strtoupper($data);
$x="UPDATE $accountstable SET STATUS ='$data'  WHERE account='$key'";mysqli_query($connect,$x)or die(mysqli_error($connect));
 $x=" UPDATE accountsstatus SET status ='$data' WHERE ACCOUNT ='$key' AND MONTH(DATE)=MONTH('$date'); ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'ACC $key EDITED ACCOUNT STATUS TO $data',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));	

}
	
	
}


else if($action==4)
{
foreach($account as $key =>$data)
{
$x="INSERT INTO $billstable(account,balance,status,meterstatus,class,date,user) SELECT CONCAT('$key'),CONCAT('$data'),CONCAT('ADJUSTMENT'),CONCAT('RUNNING'),CLASS,CONCAT('$date'),CONCAT('$user')  FROM $accountstable WHERE ACCOUNT='$key' LIMIT 1 ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT MAX(id) FROM  $billstable ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
{while ($y=@mysqli_fetch_array($x)){$identity=$y['MAX(id)']+1;}}

$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'ACCOUNT ADJUSTMENT ACC $key  AMNT $data',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$accountbalance=$accountbalance-$balance;
}
	
	
}


else if($action==6)
{

foreach($account as $key =>$data)
{

$strlen=strlen($data);
if((strlen($strlen) <7 ) AND  (strlen($strlen)>8) )  {unset($account[$key]);}

}

	
$x="SELECT number,zone FROM zones  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
$i=$y['number'];$accountstablex='accounts'.$i;$zone=$y['zone'];	

foreach($account as $key =>$data)
{
$b="SELECT ACCOUNT FROM $accountstablex WHERE ACCOUNT ='$data'  LIMIT 1";$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){ $_SESSION['message']="ACCOUNT ".$data."<br>REGISTERED IN ZONE". $zone."ACCOUNTS"; print $_SESSION['message'];exit;}

}		
		
		}}	
	
$x="UPDATE  $accountstable SET ACCOUNT='$data' WHERE ACCOUNT='$key' LIMIT 1";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE  clientmetersreg SET ACCOUNT='$data' WHERE ACCOUNT='$key' LIMIT 1";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'ACC NUMBER $key CHANGED TO NUMBER $data',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
}


$_SESSION['message']="UPDATE"; exit;
?>