<?php
@session_start();
$month=strtoupper(addslashes($_POST['month']));
@$zone=strtoupper(addslashes($_POST['zone']));
@$account1=$_POST['account1'];  @$account2=$_POST['account2'];
$_SESSION['account1']=$account1;$_SESSION['account2']=$account2;
$_SESSION['month']=$month; $_SESSION['date1']=$date."01";$_SESSION['date2']=$date."31";
$_SESSION['message']="BALANCE AS AT  $month ";
include_once("currentbal.php");
exit;
?>