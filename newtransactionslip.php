<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
$account1=$_SESSION['account1'];
$account2=$_SESSION['account2'];
include_once("loggedstatus.php");
include_once("password.php");

$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'VIEW SLIPS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
  else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

 @$account=trim(strtoupper(addslashes($_POST['account'])));
 @$transactioncode=trim(strtoupper(addslashes($_POST['transactioncode'])));
  @$postdate=$_POST['postdate'];
  @$code=$_POST['code'];
  @$paypoint=$_POST['paypoint'];
  
  
  $x="SELECT ACCOUNT  FROM $accountstable  WHERE ACCOUNT ='$account' ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)<1)
		{$_SESSION['message']="ACCOUNT ".$account." MISSING";header("LOCATION:accessdenied4.php");exit;}
	
	
	$x="SELECT number,zone FROM zones WHERE NUMBER !=$zone ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{			
$i=$y['number']; $wateraccountstable2='wateraccounts'.$i;$zonename=$y['zone'];
$b="SELECT * FROM $wateraccountstable2  WHERE    transaction='$transactioncode'   AND depositdate='$postdate' ";$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0){ $_SESSION['message']="SLIP EXISTING  IN  ZONE ".$zonename;header("LOCATION:bankstatements.php");exit;}

	
		}
		}
	
$x="SELECT * FROM $wateraccountstable  WHERE    transaction='$transactioncode'   AND depositdate='$postdate' ";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){ $_SESSION['message']="SLIP EXISTING IN  ZONE ".$_SESSION['zonename'];header("LOCATION:bankstatements.php");exit;}
	
		
  foreach($code as $key =>$data)
{
	if($data <0){unset($code[$key]);}
	if($data ==null ){unset($code[$key]);}
}


  foreach($code as $key =>$data)
{

$x="INSERT INTO  $wateraccountstable (transaction,credit,date,credit2,account,code,depositdate,paypoint) 
VALUES('$transactioncode',$data,now(),$data,'$account','$key','$postdate','$paypoint')";mysqli_query($connect,$x)or die(mysqli_error($connect));



}
$x="INSERT INTO events(user,session,action,date) 
SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('ENTER NEW SLIP NUMBER $transactioncode WORTH ',SUM(CREDIT),' TO ACC $account'),CURRENT_DATE FROM $wateraccountstable WHERE TRANSACTION ='$transactioncode'
 AND ACCOUNT ='$account'  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$_SESSION['message']="SLIP NUMBER <br> $transactioncode <br>UPDATED";header("LOCATION:bankstatements.php");
exit;
?>