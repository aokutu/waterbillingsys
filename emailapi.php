 <?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'SEND  SMS-EMAILS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ print"<h1>ACCESS DENIED</h1>";exit;}
$x="INSERT INTO COMPANY.OUTBOX (STATUS,MESSAGE,CONTACT,ACCOUNT) SELECT ID,MESSAGE,CONTACT,ACCOUNT  FROM  $company.OUTBOX  WHERE STATUS ='PENDING' AND  CONTACT REGEXP '@' ";
mysqli_query($connect2,$x)or die(mysqli_error($connect2));
$x="DELETE n1 FROM $company.OUTBOX n1, COMPANY.OUTBOX n2 WHERE  n1.id=n2.STATUS AND n1.ACCOUNT =n2.ACCOUNT  AND n1.CONTACT =n2.CONTACT  AND n1.MESSAGE=n2.MESSAGE   ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
print passthru("emailapi.pyw ");
?>
<div   class="btn-info btn-sm"  id="clock">LAST SENT AT <?php echo $date;?> PENDING SMS:  <?php print $sms; ?> CONTACT <?php print $contact?> SMS:<?php print $message;?></div>