<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'DELETE BILLS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{echo "ACCESS DENIED";exit;}
@$action=$_POST['action'];
$del=$_POST['del'];
//////////////
foreach($del as $id)
{
  if($id <1){unset($del[$id]);}
}

foreach($del as $id)
{  
    print  $billstable;
//$x="INSERT INTO events(user,session,action,date)    SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),DELETED BILL REFF NO $id,DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM  $billstable    WHERE id=$id";
$x="INSERT INTO events(user,session,action,date)    SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('DELETED BILL OF AC',ACCOUNT,'BILLED ON',DATE),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM  $billstable    WHERE id=$id";
mysqli_query($connect,$x)or die(mysqli_error($connect));
//unlink("uploads/photos/".$acc."-".$meter."-".$date.".png");
//unlink("uploads/photos/".$acc."-".$meter."-".$date.".jpg");
//unlink("uploads/photos/".$acc."-".$meter."-".$date.".jpeg");
}

foreach($del as $id)
{
$x="DELETE FROM  $billstable   WHERE id=$id";mysqli_query($connect,$x)or die(mysqli_error($connect));

}
header("LOCATION:billsreport.php");
$_SESSION['message']="BILLS DELETED";
exit;
?>
