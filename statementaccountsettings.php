<?php 
include_once("password.php");
if(strtotime($_POST['date1'])>strtotime($_POST['date2'])){header("Location:invalidentries.php");exit;}
@$_SESSION['date1']=$_POST['date1'];@$_SESSION['date2']=$_POST['date2'];
@$_SESSION['min2']=addslashes($_POST['account']);
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
//header("Location:viewbill.php");
?>
