<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$item=$_POST['item']; $item=strtoupper(addslashes($item));
@$description=trim(strtoupper(addslashes($_POST['description'])));
@$quantity=$_POST['quantity'];
@$record=$_POST['record'];

$x="SELECT * FROM INVENTORY WHERE  ITEM ='$item'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1 ){$_SESSION['message']=$item."<br> NOT REGISTERED ";exit;}

 if($record=='STANDARD') {
	 $x="UPDATE INVENTORY  TU, INVENTORY TS  SET TU.QUANTITY=TS.QUANTITY+$quantity WHERE TU.ITEM=TS.ITEM  AND  TU.ITEM='$item'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE INVENTORY SET QUANTITY ='0' WHERE ITEM ='$item' AND QUANTITY < '0'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
	 $x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'STANDARD ADJUSTMENT  OF $item QNTY $quantity ',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO ADJUSTMENT (ITEM,QUANTITY,DESCRIPTION,DATE)  VALUES('$item','$quantity','$description',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
	 $_SESSION['message']=$item."<br> STOCK ADJUSTED <br> SUCCESSFULLY ";exit;
	 }

else  if($record=='INVENTORY') {
	 $x="UPDATE INVENTORY  TU, INVENTORY TS  SET TU.QUANTITY=TS.QUANTITY+$quantity WHERE TU.ITEM=TS.ITEM  AND  TU.ITEM='$item'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE INVENTORY SET QUANTITY ='0' WHERE ITEM ='$item' AND QUANTITY < '0'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
	 $x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'STOCK  ADJUSTMENT  OF $item QNTY $quantity ',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
	 $_SESSION['message']=$item."<br> STOCK ADJUSTED <br> SUCCESSFULLY ";exit;
	 }
else if($record=='RECORDS') {
	 $x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'RECORDS ADJUSTMENT  OF $item QNTY $quantity ',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO ADJUSTMENT (ITEM,QUANTITY,DESCRIPTION,DATE)  VALUES('$item','$quantity','$description',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
	 $_SESSION['message']=$item."<br> STOCK ADJUSTED <br> SUCCESSFULLY ";exit;
	 } 






?>