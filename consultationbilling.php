<?php

@session_start();
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="PHAMARCY";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class billing extends dbdetails
{
public $item=0;
public $price=null;
public $itemquantity=0;
public $total=null;
public $itembilling=null;
public $stock=null;
public $units=null;
public $taxation=null;
public $patientnumber=null;
public $batchnumber=null;

public $route=null;
public $dosage=null;
public $frequency=null;
public $period=null;
public $treatment=null;

public function ttl()
{
$this->total=$this->price*$this->itemquantity;
	
}

public function ttltax()
{
return $this->taxation*$this->itemquantity;
	
}

}


$billing =new billing;
//
$billing->item=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['selecteditem']))));
$billing->price=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['sellprice']))));
$billing->itemquantity=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['selectquantity']))));
$billing->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['patientnumber']))));
$billing->batchnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['batchnumber']))));
$billing->itembilling=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['sellprice']))));


$billing->treatment=$connect->real_escape_string (nl2br(htmlspecialchars(trim(addslashes($_POST['treatment'])))));
$billing->medication=$billing->item;
$billing->route=$connect->real_escape_string (trim(addslashes(strtoupper($_POST['route']))));
$billing->dosage=$connect->real_escape_string (trim(addslashes(strtoupper($_POST['dosage']))));
$billing->frequency=$connect->real_escape_string (trim(addslashes(strtoupper($_POST['frequency']))));
$billing->period=$connect->real_escape_string (trim(addslashes(strtoupper($_POST['period']))));
$billing->note='MEDICATION:'.$billing->medication.'<br>'.'ROUTE:'.$billing->route.'<br>'.'DOSAGE:'.$billing->dosage.' <br>'.'FREQUENCY:'.$billing->frequency.'<br> '.'PERIOD:'.$billing->period.' DAYS <br>';



$x=$connect->query("SELECT CLIENT FROM patientsrecord  WHERE ACCOUNT='$billing->patientnumber' ");
while ($data = $x->fetch_object())
{ 
$_SESSION['clientname']=$data->CLIENT;

}
$x=$connect->query("SELECT PRICE,QUANTITY,UNITS,TAXATION  FROM inventory  WHERE ITEM='$billing->item' AND QUANTITY >0 AND QUANTITY >=$billing->itemquantity AND  PRICE >0 ");

while ($data = $x->fetch_object())
{ 

$billing->stock=$data->QUANTITY;
$billing->units=$data->UNITS;
$billing->taxation=$data->TAXATION*$billing->itemquantity;
}
$billing->ttl();
if(($billing->price>0) && ($billing->stock>=$billing->itemquantity) &&($billing->stock>0))
{

$connect ->query("INSERT INTO treatmentreport(PATIENTNUMBER,PRESCRIPTION,TREATMENT,ATTENDANT,DATE) 
VALUES('$billing->patientnumber','$billing->note','$billing->treatment','$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR))");



$connect ->query("INSERT INTO pendingsales(DETAILS,UNIT,PRICE,QUANTITY,TOTAL,GROSSTOTAL,CASHIER,PATIENTNUMBER,BATCHNUMBER,STATUS,DATE) 
VALUES('$billing->item','$billing->units','$billing->itembilling','$billing->itemquantity','$billing->total','$billing->total','$dbdetails->user','$billing->patientnumber','$billing->batchnumber',CONCAT(''),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");

$connect ->query("UPDATE inventory AS TS,inventory AS  TV SET TS.QUANTITY=TV.QUANTITY-$billing->itemquantity  WHERE TS.ITEM='$billing->item' AND TS.ID=TV.ID; ");
$connect ->query("UPDATE expirydates AS TS,expirydates AS  TV SET TS.QUANTITY=TV.QUANTITY-$billing->itemquantity  WHERE TS.NAME='$billing->item' AND TS.ID=TV.ID; ");

$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('BILLED PATIENT NO. $billing->patientnumber  $billing->item  $billing->itemquantity  $billing->units AT KSH $billing->total'),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
$connect->query(" UPDATE consultation SET URGENCY='BILLING' WHERE PATIENTNUMBER='$billing->patientnumber' ");
$_SESSION['message']='POSTED <br>'.$billing->item."<br>";exit;


////////////////////
//$connect ->query("INSERT INTO treatmentreport(PATIENTNUMBER,PRESCRIPTION,TREATMENT,ATTENDANT,DATE) 
//VALUES('$billing->patientnumber','$billing->note','$billing->treatment','$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR))");



$connect ->query("UPDATE consultation SET  URGENCY='PHAMARCY' WHERE PATIENTNUMBER='$billing->patientnumber' ");
$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('UPDATED  TREATMENT REPORT   OF  PATIENT   MUMBER $billing->patientnumber '),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");

///////////////////////	
}

$_SESSION['message']='FAILED <br>'.$billing->item."<br>";exit;

?>