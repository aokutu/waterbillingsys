<?php
@session_start();
include_once("password2.php");

?>

<div id="notificaions2" >
 <?php
$x = $connect->query("SELECT SENDER,MESSAGE,DATETIME FROM notification");

// Initialize an array to hold all notifications
$notifications = array();

// Loop through the query results and add to the array
while ($data = $x->fetch_object()) {
    $notifications[] = "FROM: " . $data->SENDER."\nMSG:".$data->MESSAGE."\nTIME:".$data->DATETIME."\n--------CLICK OK TO  CLEAR  MESSAGES----------- \n";
}

// Encode the notifications array into JSON
$notification_json = json_encode($notifications);

?>
</div>