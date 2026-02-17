 <?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ include_once("accessdenied.php");exit;}
@$_SESSION['date1']=addslashes($_POST['date1']);
@$_SESSION['date2']=addslashes($_POST['date2']);
echo "SEARCH DATA....";
?>