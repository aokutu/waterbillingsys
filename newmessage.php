<?php
@session_start();
include_once("password2.php");

class newmessage
{
public $sender=null;
public $message=null;
public $receiever=null;
}
$newmessage =  new newmessage;
$newmessage->sender=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['sender']))));
$newmessage->message=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['message']))));

	foreach($_POST['receiever'] as $reciever )
{
$newmessage->receiever =$reciever;
$connect ->query(" INSERT INTO  notification(SENDER,RECEPIENT,MESSAGE,DATETIME) VALUES('$newmessage->sender','$newmessage->receiever','$newmessage->message',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR)) ");
}

?>