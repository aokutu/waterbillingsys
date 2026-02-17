
 <tbody id="pricelisttable2" style="font-weight:bold;text-decoration:underline;height:80%;">
		 
<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="REGISTRATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND  ACCESS  REGEXP  '$dbdetails->userrights'   ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class itemdetails
{
public $searchitem=null;
}
$itemdetails=new itemdetails;
$itemdetails->searchitem=$_POST['searchitem'];

$x=$connect->query("SELECT ITEM,PRICE,COPRATEPRICE,QUANTITY FROM inventory   WHERE ITEM REGEXP '$itemdetails->searchitem' 
UNION SELECT DETAILS AS ITEM,PRICE,COPRATEPRICE,CONCAT('1') AS QUANTITY FROM services   WHERE DETAILS REGEXP '$itemdetails->searchitem'  " );
while ($data = $x->fetch_object())
{ 
?>
   <tr>
	  <td><?php print $data->ITEM;?></td> 
	  <td><?php print number_format($data->PRICE,2);?></td>
	  <td><?php print number_format($data->COPRATEPRICE,2);?></td>
	 <td>NHIF</td>
	   <td><?php print $data->QUANTITY;?></td>
	  </tr>
		<?php 
}	
		?>
		
		 
		
		</tbody>
