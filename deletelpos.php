 <?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

@$id=$_POST['id'];
foreach($id as $data)
{
$x="INSERT INTO events(user,session,action,date)  SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('DELETED ',ITEM,' ',QUANTITY,' ',UNITS,' ',' FROM ',CATEGORY,'  # ',SERIALNUMBER),DATE_ADD(NOW(), INTERVAL 7 HOUR)  FROM   LPOS  WHERE ID= $data ";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="DELETE FROM LPOS  WHERE ID= $data";mysqli_query($connect,$x)or die(mysqli_error($connect));
}
$_SESSION['message']=$item."<br> DELETED SUCCESSFULLY ";exit; 	
?>
 