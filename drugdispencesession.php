<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("interface.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'PHAMARCY'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class treatment 
{
public $patientnumber=null;	
}

$treatment =new treatment;
$treatment->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['patientnumber']))));
$_SESSION['patientnumber']=$treatment->patientnumber;	
header("LOCATION:drugdispence.php");exit;
?>