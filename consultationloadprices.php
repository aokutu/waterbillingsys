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

class price extends dbdetails
{
public $item=null;
public $itemprice=0;
public $itemquantity=0;
public $total=null;
public $patientnumber=null;
public $patientclass=null;


}

$price =new price;
$price->item=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['item']))));
$price->itemquantity=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['quantity']))));
$price->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));

$x=$connect->query("SELECT CLASS AS CLS  FROM patientsrecord WHERE ACCOUNT='$price->patientnumber' ");
while ($data = $x->fetch_object())
{$price->patientclass=$data->CLS; }
//$price->setprice();
$x=$connect->query("SELECT COPRATEPRICE,PRICE,QUANTITY  FROM inventory WHERE ITEM='$price->item' ");
while ($data = $x->fetch_object())
{ 
$price->itemprice=$data->PRICE;
if($price->patientclass=='INSUARANCE')
{
$price->itemprice=$data->COPRATEPRICE;	
}
?>
<div id="itemdetails">
  <div class="row">
  <div class="col-sm-6">
PRICE 
<input type="text" name="sellprice" value="<?php print $price->itemprice;?>" id="priceloaded" readonly class="form-control input-sm" required placeholder="PRICE" autosearch="off">
</div>
<div class="col-sm-6">MAX QNTY
<input type="text" readonly  value="<?php print $data->QUANTITY;?>" id="maxquantity" class="form-control input-sm" required placeholder="MAX QNTY" autosearch="off">

</div>
</div></div>


<?php
}

?>



<div id="totalload">
<input type="text" value="<?php print  number_format(($price->itemprice*$_SESSION['quantity']),2); //number_format($price->itemprice*$price->itemquantity,2);
?>"  readonly class="form-control input-sm" required placeholder="TOTAL" autosearch="off">
</div>
