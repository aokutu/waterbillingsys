 <?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$quantity=$_POST['quantity'];
$batchnumber=$_POST['batchnumber'];
$expiredate=$_POST['expiredate'];
@$description=trim(strtoupper(addslashes($_POST['description'])));
foreach($quantity as $key =>$data)
{
if($data ==""){unset($quantity[$key]);}
}


foreach($batchnumber as $key =>$data)
{
if($data ==""){unset($batchnumber[$key]);}
}


foreach($expiredate as $key =>$data)
{
if($data ==""){unset($expiredate[$key]);}
}


$x="CREATE TEMPORARY TABLE STOCKBALANCE (ITEM TEXT,QUANTITY INT )"; 
mysqli_query($connect,$x)or die(mysqli_error($connect));
 
 foreach($expiredate as $key =>$data)
{
$x="UPDATE STOCKIN  TU, STOCKIN TS  SET TU.EXPIRE='$data' WHERE TU.ID=TS.ID  AND TU.ID=$key ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

}


 foreach($batchnumber as $key =>$data)
{
$x="UPDATE STOCKIN  TU, STOCKIN TS  SET TU.BATCHNUMBER='$data' WHERE TU.ID=TS.ID  AND TU.ID=$key ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}



 
foreach($quantity as $key =>$data)
{
$x="UPDATE STOCKIN  TU, STOCKIN TS  SET TU.STOCKBALANCE=TS.STOCKBALANCE+$data WHERE TU.ID=TS.ID  AND TU.ID=$key   ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE STOCKIN  TU, STOCKIN TS  SET TU.STOCKBALANCE=0 WHERE TU.ID=TS.ID  AND TU.ID=$key AND TU.STOCKBALANCE <0    ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO STOCKBALANCE ( ITEM,QUANTITY) SELECT ITEM,SUM(STOCKBALANCE) FROM STOCKIN WHERE ITEM  =(SELECT ITEM FROM STOCKIN WHERE ID =$key) AND STOCKBALANCE > 0 ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

}
$x="UPDATE INVENTORY  TU, STOCKBALANCE TS  SET TU.QUANTITY=TS.QUANTITY WHERE TU.ITEM=TS.ITEM";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DROP  TABLE STOCKBALANCE";
mysqli_query($connect,$x)or die(mysqli_error($connect));


foreach($quantity as $key =>$data)
{
$x="INSERT INTO ADJUSTMENT (ITEM,QUANTITY,DESCRIPTION,DATE)  SELECT ITEM,CONCAT('$data'),CONCAT('$description'),CURRENT_DATE FROM   STOCKIN  WHERE   ID ='$key'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']=$item."<br> RESTOCKED SUCCESSFULLY ";exit; 

$x="INSERT INTO events(user,session,action,date) 
SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('ADJUSTED STOCK OF  ',ITEM,' BY ',$data),CURRENT_DATE FROM STOCKIN  WHERE   ID ='$key'  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

}
$_SESSION['message']=" STOCK ADJUSTED";exit;
?>