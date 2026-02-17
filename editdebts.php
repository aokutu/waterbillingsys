<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'ADD DEBT' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$account=$_SESSION['accounts'];@$action=$_POST['action'];

@$debt=$_POST['debt'];@$installment=$_POST['installment']; @$period=$_POST['period']; 
$id=$_POST['id'];
if($action =='DELETE')
{
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'DELETE DEBT' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


	
	foreach ($id as $data )
{
$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),CONCAT(CURRENT_TIMESTAMP),CONCAT('DELETED DEBT OF ACC NO ',ACCOUNT),CURRENT_DATE FROM DEBTREGISTRY WHERE ID =$data";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="DELETE  FROM  DEBTPAY WHERE ACCOUNT =(SELECT ACCOUNT FROM  DEBTREGISTRY WHERE ID =$data)";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="DELETE  FROM DEBTREGISTRY WHERE ID =$data ";mysqli_query($connect,$x)or die(mysqli_error($connect));	
}
	$_SESSION['message']='DEBT DELETED';
//header("LOCATION:debtregistry.php");
exit;
}

else if($action =='DELETE2')
{
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'DELETE DEBT' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


	
	foreach ($id as $data )
{
$x="DELETE  FROM  DEBTPAY WHERE ID=$data";mysqli_query($connect,$x)or die(mysqli_error($connect));	
}
	$_SESSION['message']='DEBT ENTRY DELETED';
//header("LOCATION:debtregistry.php");
}

else if ($action =='NEWDEBT')
{
if($debt !=$installment*$period){$_SESSION['message']='INVALID DEBT DETAILS'; exit;}	
	$account=$_POST['accounts'];
$x="SELECT * FROM DEBTREGISTRY WHERE ACCOUNT ='$account' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1)
{
	
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'ADD DEBT' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
	
$x="INSERT INTO  DEBTREGISTRY (account,initialbal,installment,currentbal,period,date) VALUES('$account','$debt','$installment','$debt','$period',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM DEBTPAY WHERE ACCOUNT ='$account'";	mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'REGISTERED NEW DEBT AGAINST  ACC .$account',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));	
header("LOCATION:debtregistry.php");$_SESSION['message']='DEBT UPDATED'; exit;
}
else if(mysqli_num_rows($x)>0)
{
	
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'EDIT DEBT' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
	
$x="UPDATE DEBTREGISTRY SET INITIALBAL='$debt', INSTALLMENT='$installment' ,PERIOD='$period',DATE =CURRENT_DATE,CURRENTBAL ='$debt' WHERE ACCOUNT='$account'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM DEBTPAY WHERE ACCOUNT ='$account'";	mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'REGISTERED NEW DEBT AGAINST  ACC .$account',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$_SESSION['message']='DEBT UPDATED'; exit;
}	
	
}
else if ($action =='STATEMENT')
{
$id=reset($id);
$x="SELECT ACCOUNT FROM  DEBTREGISTRY WHERE ID =$id ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0){ while ($y=@mysqli_fetch_array($x)){$_SESSION['account']=$y['ACCOUNT'];}}	
		$_SESSION['message']='LOAD DEBT STATEMENT '; exit;
		//header("LOCATION:debtstatement.php");
}
?>