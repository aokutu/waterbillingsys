 <?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  AND  ACCESS  REGEXP  'REQUISITION'     ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

@$id=$_POST['id'];
foreach($id as $data)
{
$x="INSERT INTO events(user,session,action,date)  SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('DELETED ',ITEM,' ',QUANTITY,' ',UNITS,' ',' FROM PURCHASE REQ. # ',SERIALNUMBER),CURRENT_DATE  FROM   PURCHASESREQUISITION  WHERE ID= $data ";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="DELETE FROM PURCHASESREQUISITION WHERE ID= $data";mysqli_query($connect,$x)or die(mysqli_error($connect));
}
$_SESSION['message']=$item."<br> DELETED SUCCESSFULLY ";exit; 	
?>