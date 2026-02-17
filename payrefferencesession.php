<?php 
set_time_limit(0);
@session_start();
@$account=$_POST['account']; $account=strtoupper(addslashes($account));
$_SESSION['account']=$account; $_SESSION['message']="LOADING ACCOUNT DETAILS";
?>
