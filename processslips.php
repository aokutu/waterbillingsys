<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'PROCESS BANK SLIPS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$id=$_POST['id'];
foreach($id as  $identity)
{
$x="DELETE FROM  WATERACCOUNTS2  WHERE ID=$identity";
$x=mysqli_query($connect2,$x)or die(mysqli_error($connect2));	
}
$_SESSION['message']="DELETED TRANSACTION SLIPS".$code;exit;
?>