<?php session_start();
$user =$_SESSION['user'];
$password=$_SESSION['password'];
$priv =$_SESSION['priv'];

mysql_connect('localhost','root'); 
mysql_select_db('waterbilling');
$x="TRUNCATE TABLE events";
mysql_query($x)or die(mysql_error());
header("Location:main.php"); 
?>