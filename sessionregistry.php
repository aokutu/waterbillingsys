<?php 
set_time_limit(0);
session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}


else{ include_once("accessdenied.php");exit;}
@$accounts=$_POST['account'];$_SESSION['accounts']=$accounts;
@$balance=$_POST['balance']; $_SESSION['balance']=$balance;
@$_SESSION['account1']=$_POST['account1'];@$_SESSION['account2']=$_POST['account2'];
@$meternumber=$_POST['meternumber']; $_SESSION['meternumber']=$meternumber; 
@$_SESSION['supplier']=$_POST['supplier'];
@$_SESSION['transactionreff']=trim(addslashes(strtoupper($_POST['transactionreff'])));
@$date1=$_POST['date1']; $_SESSION['date1']=$date1;
@$date2=$_POST['date2']; $_SESSION['date2']=$date2;
@$slipid=$_POST['slipid']; $_SESSION['slipid']=$slipid;
@$search=$_POST['search']; $_SESSION['search']=trim($search);
@$range=$_POST['range']; @$_SESSION['range']=$range;
@$month=$_POST['month']; @$_SESSION['month']=$month;
@$searchcategory=$_POST['searchcategory']; $_SESSION['searchcategory']=$searchcategory;
@$searchregistry=$_POST['searchregistry']; $_SESSION['searchregistry']=$searchregistry;
@$action=$_POST['action'];$_SESSION['action']=$action;
@$lat1 =$_POST['latt1'];$_SESSION['lat1']=$lat1;
@$lon1 = $_POST['long1'];$_SESSION['lon1']=$lon1;
@$lat2 = $_POST['latt2'];$_SESSION['lat2']=$lat2;
@$lon2 =$_POST['long2'];$_SESSION['lon2']=$lon2;
@$units=$_POST['units'];$_SESSION['units']=$units;
@$category=$_POST['category'];$_SESSION['category']=$category;
@$_SESSION['item ']=$_POST['item'];
@$transactionid=$_POST['slipid'];$_SESSION['transactionid']=$transactionid;
@$issuenotenumber=$_POST['issuenotenumber'];$_SESSION['issuenotenumber']=$issuenotenumber;
$_SESSION['message']='PROCESSED'.$_SESSION['$account2'];
$_SESSION['loadedyear']=$_POST['loadedyear'];
@$payslippaticular=$_POST['payslippaticular'];$_SESSION['payslippaticular']=$payslippaticular; 
//header('LOCATION:archivedstatements2.php');

?>