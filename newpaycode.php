<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'PAYMENT CODES' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$codenumber=$_POST['codenumber'];
$codename=$_POST['codename']; $codename=strtoupper($codename);$effect=$_POST['effect'];
@$charges=$_POST['charges']; if ($charges <=0 ){$charges=0;}
$x="SELECT * FROM paymentcode WHERE NAME ='$codename'  OR CODE='$codenumber'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){$_SESSION['message']="CODE EXISTS";exit;}
$cdx=addslashes("UPDATE deposituploads SET code='".$codenumber."'  WHERE  account  LIKE '%(".$codenumber.")%'   AND status !='PROCESSED'");
$x="INSERT INTO  paymentcode(NAME,CODE,EFFECT,DBCODE,CHARGES) VALUES('$codename','$codenumber','$effect','$cdx','$charges')";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'CREATED NEW PAYMENT CODE $codenumber',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$_SESSION['message']="CODE CREATED";exit;
?>