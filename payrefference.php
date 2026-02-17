
<select class='form-control' name="payrefference"  id="payrefference2"  required="on"  >
 <?php
  @session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'UPDATE STATUS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


 $account =$_SESSION['account'];
//  $x="SELECT *  FROM $wateraccountstable  WHERE account='$account' AND  LINKED !='CLR'  AND CODE=(SELECT CODE FROM PAYMENTCODE WHERE NAME REGEXP 'CONP' LIMIT 1)  OR  account='$account' AND  LINKED !='CLR'  AND CODE=(SELECT CODE FROM PAYMENTCODE WHERE NAME REGEXP 'CONNECTION' LIMIT 1)  OR  account='$account' AND  LINKED !='CLR'  AND CODE=(SELECT CODE FROM PAYMENTCODE WHERE NAME REGEXP 'COR' LIMIT 1)  ";
 //$x="SELECT *  FROM $wateraccountstable  WHERE account='$account' AND  LINKED !='CLR'";
 $x="SELECT *  FROM $wateraccountstable WHERE account='$account' AND  LINKED !='CLR'  ";

 $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
print  '<option value="'.$y['id'].'">CODE   '.$y['transaction'].'   DATE    '.$y['depositdate'].'  AMNT   '.number_format($y['credit'],2).'</option>';	}
 print  '<option value=""></option>';  	
	}
else { print  '<option value="">RECONNECTING PAY SLIP MISSING</option>';  }
	 ?>
</select> 




