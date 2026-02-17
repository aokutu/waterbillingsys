<?php
@session_start();
include_once("password2.php");

class deletemessages
{
public $deleteid=null;	
}
$deletemessages=new deletemessages;
$deletemessages->deleteid=$_POST['deleteid'];
 $connect ->query(" DELETE FROM notification  WHERE ID='$deletemessages->deleteid'");
 ?>