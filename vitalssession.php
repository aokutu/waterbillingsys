<?php 
@session_start();
$_SESSION['getpatientnumber']=$_GET['patientnumber'];

header('LOCATION:vitals.php');exit;

?>