<?php
@session_start();
set_time_limit(600);
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND  ACCESS  REGEXP  'ARCHIVE' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$date= $_POST['archivedate'];

 $x="CREATE  TEMPORARY TABLE `BALANCEREPORTZ` (
  `transactionname` text NOT NULL,
 `account` text NOT NULL,
  `zone` text NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL,
  `archived` date NOT NULL,
  `transaction` text NOT NULL,
  `paypoint` text NOT NULL,
  `meternumber` text NOT NULL,
  `consumsion` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;";
 mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="TRUNCATE financearchive";
 mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT NUMBER,ZONE FROM zones ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{
 while ($y=@mysqli_fetch_array($x))
 {
 $billstablex='bills'.$y['NUMBER'];$zonename=$y['ZONE'];$wateraccountstablex='wateraccounts'.$y['NUMBER']; $nonwaterbillsx='nonwaterbills'.$y['NUMBER'];
 $n="INSERT INTO BALANCEREPORTZ(TRANSACTIONNAME,ACCOUNT,AMOUNT,DATE,METERNUMBER,CONSUMSION,ZONE) SELECT CONCAT('WATER BILL'),ACCOUNT,BALANCE,DATE,METERNUMBER,UNITS,CONCAT('$zonename') FROM  $billstablex WHERE DATE <='$date' ";
mysqli_query($connect,$n)or die(mysqli_error($connect));

 $n="INSERT INTO BALANCEREPORTZ(TRANSACTIONNAME,ACCOUNT,ZONE,AMOUNT,DATE) SELECT NAME,ACCOUNT,CONCAT('$zonename'),AMOUNT,DATE FROM $nonwaterbillsx WHERE DATE <='$date'   ";
mysqli_query($connect,$n)or die(mysqli_error($connect));

$n="INSERT INTO BALANCEREPORTZ(TRANSACTIONNAME,ACCOUNT,ZONE,DATE,AMOUNT) SELECT TRANSACTION,ACCOUNT,CONCAT('$zonename'),DEPOSITDATE,-1*CREDIT FROM $wateraccountstablex WHERE DEPOSITDATE <='$date' ";
mysqli_query($connect,$n)or die(mysqli_error($connect)); 
 }} 
$x="DELETE FROM BALANCEREPORTZ WHERE (SELECT SUM(AMOUNT) FROM BALANCEREPORTZ) = 0;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO financearchive(TRANSACTION,ACCOUNT,AMOUNT,DATE,ARCHIVED,ZONE,METERNUMBER,CONSUMSION) SELECT TRANSACTIONNAME,ACCOUNT,AMOUNT,DATE,DATE_ADD(NOW(), INTERVAL 7 HOUR),ZONE,METERNUMBER,CONSUMSION  FROM BALANCEREPORTZ ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="SELECT NUMBER,ZONE FROM zones ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{
 while ($y=@mysqli_fetch_array($x))
 {
$billstablex='bills'.$y['NUMBER'];$zonename=$y['ZONE'];$wateraccountstablex='wateraccounts'.$y['NUMBER']; $nonwaterbillsx='nonwaterbills'.$y['NUMBER'];
 $n="DELETE FROM $billstablex WHERE DATE <='$date' ";
 mysqli_query($connect,$n)or die(mysqli_error($connect)); 
 
  $n="DELETE FROM  $nonwaterbillsx WHERE DATE <='$date' ";
 mysqli_query($connect,$n)or die(mysqli_error($connect));
 
   $n="DELETE FROM  $wateraccountstablex WHERE DATE <='$date' ";
 mysqli_query($connect,$n)or die(mysqli_error($connect));

 
}}

$x="SELECT NUMBER,ZONE FROM zones ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{
 while ($y=@mysqli_fetch_array($x))
 {
 $billstablex='bills'.$y['NUMBER'];

$x="INSERT INTO $billstable(account,balance,status,date,user) 
SELECT ACCOUNT,SUM(AMOUNT),CONCAT('ADJUSTMENT'),CONCAT('$date'),CONCAT('$user') FROM BALANCEREPORTZ GROUP BY ACCOUNT  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

}}

$x="INSERT INTO events(user,session,action,date) 
SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('ACCOUNT ADJUSTMENT ACC ',ACCOUNT),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM BALANCEREPORTZ GROUP BY ACCOUNT ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']="ARCHIVED";
?>