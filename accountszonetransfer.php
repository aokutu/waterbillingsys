
<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("loggedstatus.php");
include_once("password.php");
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'ACCOUNT TRANSFER' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$newzone=$_POST['newzone'];
 
foreach ($_POST['transfer'] as $accounttransfer)
{
$x="INSERT  INTO ACCOUNTS".$newzone."(CLIENT,LOCATION,STATUS,DATE,USER,CLASS,ACCOUNT,CONTACT,IDNUMBER,METERNUMBER,CLIENTEMAIL,PLOTNUMBER,DATE2,ID2,EMAIL,BALANCE,AVGUNIT,LONGITUDE,LATTITUDE)
SELECT CLIENT,LOCATION,STATUS,DATE,USER,CLASS,ACCOUNT,CONTACT,IDNUMBER,METERNUMBER,CLIENTEMAIL,PLOTNUMBER,DATE2,ID2,EMAIL,BALANCE,AVGUNIT,LONGITUDE,LATTITUDE FROM $accountstable  WHERE ACCOUNT ='$accounttransfer'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO METERS".$newzone." (METERNUMBER,SERIALNUMBER,SIZE,STATUS,ACCOUNT) SELECT  METERNUMBER,SERIALNUMBER,SIZE,STATUS,ACCOUNT FROM $meterstable WHERE ACCOUNT ='$accounttransfer' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO BILLS".$newzone."(ACCOUNT,METERNUMBER,CURRENT,PREVIOUS,UNITS,CHARGES,METERCHARGES,BALANCE,STATUS,DATE,USER) 
SELECT ACCOUNT,METERNUMBER,CURRENT,PREVIOUS,UNITS,CHARGES,METERCHARGES,BALANCE,STATUS,DATE,USER FROM $billstable WHERE ACCOUNT ='$accounttransfer' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  NONWATERBILLS".$newzone." (ACCOUNT,METERNUMBER,NAME,AMOUNT,DATE) SELECT ACCOUNT,METERNUMBER,NAME,AMOUNT,DATE FROM   $nonwaterbills WHERE ACCOUNT ='$accounttransfer'  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO  STATUSHISTORY".$newzone." (ACCOUNT,METER,STATUS,TASK,DATE) SELECT ACCOUNT,METER,STATUS,TASK,DATE FROM   $statushistorytable WHERE ACCOUNT ='$accounttransfer'  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO  WATERACCOUNTS".$newzone." (TRANSACTION,CREDIT,ACCOUNT,DEPOSITDATE,CODE,CREDIT2,DATE,STATUS) SELECT TRANSACTION,CREDIT,ACCOUNT,DEPOSITDATE,CODE,CREDIT2,DATE,STATUS FROM   $wateraccountstable WHERE ACCOUNT ='$accounttransfer'  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="DELETE  FROM  $accountstable WHERE ACCOUNT ='$accounttransfer'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="DELETE  FROM  $meterstable WHERE ACCOUNT ='$accounttransfer'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE  FROM  $billstable WHERE ACCOUNT ='$accounttransfer'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="DELETE  FROM  $nonwaterbills WHERE ACCOUNT ='$accounttransfer'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="DELETE  FROM  $statushistorytable WHERE ACCOUNT ='$accounttransfer'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="DELETE  FROM  $wateraccountstable WHERE ACCOUNT ='$accounttransfer'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO EVENTS(USER,SESSION,ACTION,DATE) VALUES('$user',now(),'TRANSFERED ACCOUNT $accounttransfer FROM ZONE NUMBER $zone  TO ZONE NUMBER $newzone',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));

}
$_SESSION['message']="ACCOUNTS TRANSFERED";
header("LOCATION:accountstransfer.php");
?>
