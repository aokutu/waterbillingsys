 <?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'      AND  ACCESS  REGEXP  'SEND  SMS-EMAILS'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$send=$_POST['send'];
if ($send=='EMAIL'){header("LOCATION:pendingemail.php");}
else if($send=='SMS'){header("LOCATION:pendingsms.php");}
?>