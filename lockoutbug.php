<?php 
$connect=mysqli_connect('localhost','lawascoco','Stealmouse@355.','lawascoco_Lawasco');
$x="UPDATE USERS  SET  LOGGED ='SUSPEND' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
?>