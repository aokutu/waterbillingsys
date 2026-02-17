<?php
$connect=mysqli_connect('localhost','lawascoco','Stealmouse@355.','lawascoco_Lawasco');
$x="SELECT *,CURRENT_DATE AS DUEDATE FROM zones ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
   {
 while ($y=@mysqli_fetch_array($x))
   { 
   $zone=$y['number'];$accountstablex='accounts'.$zone;
   $b="INSERT INTO accountsstatus(ACCOUNT,ZONE,STATUS,DATE,CLASS) SELECT ACCOUNT,CONCAT('$zone'),STATUS,DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY),CLASS FROM $accountstablex  ";
   mysqli_query($connect,$b)or die(mysqli_error($connect));
   }}  
   
   
   $connect=mysqli_connect('localhost','lawascoco','Stealmouse@355.','lawascoco_mokowe');
$x="SELECT *,CURRENT_DATE AS DUEDATE FROM zones ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
   {
 while ($y=@mysqli_fetch_array($x))
   { 
   $zone=$y['number'];$accountstablex='accounts'.$zone;
   $b="INSERT INTO accountsstatus(ACCOUNT,ZONE,STATUS,DATE,CLASS) SELECT ACCOUNT,CONCAT('$zone'),STATUS,DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY),CLASS FROM $accountstablex  ";
   mysqli_query($connect,$b)or die(mysqli_error($connect));
   }}
   
   
   $connect=mysqli_connect('localhost','lawascoco','Stealmouse@355.','lawascoco_shella');
$x="SELECT *,CURRENT_DATE AS DUEDATE FROM zones ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
   {
 while ($y=@mysqli_fetch_array($x))
   { 
   $zone=$y['number'];$accountstablex='accounts'.$zone;
   $b="INSERT INTO accountsstatus(ACCOUNT,ZONE,STATUS,DATE,CLASS) SELECT ACCOUNT,CONCAT('$zone'),STATUS,DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY),CLASS FROM $accountstablex  ";
   mysqli_query($connect,$b)or die(mysqli_error($connect));
   }} 
?>

