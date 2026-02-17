 <?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$account1=$_SESSION['account1'];
$account2=$_SESSION['account2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'BACKUP DATABASE'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
print passthru("../php/php.exe backup.php");
print "xx";
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'BACKED UP DATABASE',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
  $_SESSION['message']="DATA  EXPORTED SUCCESSFULLY";
	?>