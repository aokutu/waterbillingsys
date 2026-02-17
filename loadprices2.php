<?php
session_start();
$_SESSION['item']=$_POST['selecteditem'];
$_SESSION['quantity']=$_POST['selectquantity'];
$_SESSION['patientnumber']=$_POST['patientnumber'];




?>