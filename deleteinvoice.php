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
	$x="UPDATE INVENTORY tu, INVENTORY ts SET tu.quantity = ts.quantity -(SELECT QUANTITY FROM STOCKIN WHERE ID =$data)  
	where tu.id=ts.id  AND tu.item =(SELECT ITEM FROM STOCKIN WHERE ID =$data)";mysqli_query($connect,$x)or die(mysqli_error($connect));
	
$x="INSERT INTO events(user,session,action,date)  SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('DELETED ',QUANTITY,' ',ITEM,' REFF NO.',INVOICENUMBER,'  FROM',SUPPLIER),DATE_ADD(NOW(), INTERVAL 7 HOUR)  FROM   STOCKIN  WHERE ID= $data ";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="DELETE FROM STOCKIN WHERE ID= $data";mysqli_query($connect,$x)or die(mysqli_error($connect));
}
$_SESSION['message']=$item."<br> DELETED SUCCESSFULLY ";exit; 	
?>
 