<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("interface.php");
include_once("password2.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'INVENTORY' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


class updatestock 
{
public $updateitem=null;
public $quantity=null;
public $batchnumber=null;
public $stock=null;
public $oldstock=null;
public $oldbatchstock=null;
public $finalbatchstock=null;
public $finalstock=null;

public function newstock()
{
if($this->stock=='STOCK UP')
{
$this->finalstock=$this->oldstock+$this->quantity;
$this->finalbatchstock=$this->oldbatchstock+$this->quantity;

}

else if($this->stock=='STOCK DOWN')
{
$this->finalstock=$this->oldstock-$this->quantity;
$this->finalbatchstock=$this->oldbatchstock-$this->quantity;

}

	
}	
}



$updatestock=new  updatestock;

$updatestock->updateitem=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['updateitem'])))); 
$updatestock->quantity=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['quantity'])))); 
$updatestock->batchnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['batchnumber'])))); 
$updatestock->stock=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['stock'])))); 
;
$x=$connect->query("SELECT QUANTITY FROM inventory WHERE ITEM='$updatestock->updateitem'  ");
while ($data = $x->fetch_object())
{
$updatestock->oldstock=$data->QUANTITY;
}

$x=$connect->query("SELECT QUANTITY FROM expirydates  WHERE NAME='$updatestock->updateitem'  AND BATCH='$updatestock->batchnumber'  ");
while ($data = $x->fetch_object())
{
$updatestock->oldbatchstock=$data->QUANTITY;
}
$updatestock->newstock();
$connect ->query(" UPDATE inventory SET QUANTITY='$updatestock->finalstock' WHERE ITEM='$updatestock->updateitem' ");
$connect ->query(" UPDATE expirydates SET QUANTITY='$updatestock->finalstock' WHERE NAME='$updatestock->updateitem'  AND BATCH='$updatestock->batchnumber'  ");
$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),'$updatestock->updateitem   $updatestock->stock ADJUSTMENT  OF $updatestock->item QNTY $updatestock->quantity ',DATE_ADD(NOW(), INTERVAL 10 HOUR))");
$_SESSION['message']=$updatestock->updateitem."<br> POSTED SUCCESSFULLY "; 
?>