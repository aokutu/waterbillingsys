<?php
@session_start();
set_time_limit(0);
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'SEND  SMS-EMAILS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{include_once("accessdenied.php");exit;}
@$id=$_POST['id'];  @$mode=$_POST['mode'];


 
foreach($id as $id2)
{

$x="SET @MAXID=(SELECT MAX(ID) FROM outbox)";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	
if($mode=='EMAIL')
{
	
$x="INSERT INTO outbox(account,contact,message,status,date,id)  
select  $accountstable.account,$accountstable.clientemail,
concat('DEAR ',$accountstable.client,'A/C NO ',sms.account,' BALB/F ',balbf,' Curr rdng ',current,' Prev rdng ',previous,'Cons: ',consumtion,'Monthly Bill:',bill,' Total Bill: ',totalbill,'Reading Date: ',sms.date,' Due Date ',DATE_ADD($accountstable.date2,INTERVAL 10 DAY), 'Any Comlplain be reported within 7 days' )
,' DUE DATE ',DATE_ADD($accountstable.date2,INTERVAL 10 DAY))
,concat('PENDING'),CURRENT_TIMESTAMP,CONCAT(@MAXID := 1 + @MAXID) from sms,$accountstable WHERE sms.account=$accountstable.account AND sms.id=$id2 ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
	
}

else if($mode=='CELL')
{
$x="INSERT INTO outbox(account,contact,message,status,date,id)  
select  $accountstable.account,$accountstable.contact,
concat('DEAR ',$accountstable.client,' A/C NO ',sms.account,' BILL DATED ',sms.date,' CURRENT READING  ',current,' PREVIOUS READING  ',previous,' UNITS ',consumtion,' CUBIC M  STANDING CHARGE  ',standingcharges,'  COMMISSION ',commission,' WATER CHARGES ',bill,'  PREVIOUS BALANCE ',balbf,' ',' TOTAL AMOUNT DUE  ',totalbill,' PAYMENT DUE DATE ',DATE_ADD($accountstable.date2,INTERVAL 10 DAY), ' THANK YOU' )
,concat('PENDING'),CURRENT_TIMESTAMP,CONCAT(@MAXID := 1 + @MAXID) from sms,$accountstable WHERE sms.account=$accountstable.account AND $accountstable.contact LIKE '254%'  AND  CHAR_LENGTH($accountstable.contact) =12   AND sms.id=$id2 ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
	
	
}
/*	
$x="SELECT ACCOUNT  FROM  SMS WHERE ID=$id2";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$acc=$y['ACCOUNT'];}} 
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'POSTED BILLING MESSAGES  TO  ACC $acc',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM sms   WHERE id=$id2";mysqli_query($connect,$x)or die(mysqli_error($connect));
   */
}
$_SESSION['message']="BILLING MESSAGES POSTED";	 exit;
?>