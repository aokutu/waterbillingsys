<?php
@session_start();
set_time_limit(0);
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");

$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'BALANCE  INQUERY' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{include_once("accessdenied.php");exit;}
print passthru("emailapi2.pyw");
//sleep(4);

$x="TRUNCATE  TABLE  BALANCE1 " ;mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="TRUNCATE  TABLE  BALANCE2 " ;mysqli_query($connect,$x)or die(mysqli_error($connect));		  

	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$wateraccountstablex='wateraccounts'.$i; $billstablex='bills'.$i;
$b="insert  into balance1(ACCOUNT,AMOUNT) select account,-1*CREDIT  FROM  $company.$wateraccountstablex   WHERE ACCOUNT=(SELECT ACCOUNT FROM COMPANY.EMAILS  WHERE emails.account=$wateraccountstablex.account)  and code !=(SELECT  CODE FROM PAYMENTCODE WHERE NAME REGEXP 'DEPOSIT' LIMIT  1) ";	mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="insert  into balance1(ACCOUNT,AMOUNT) select account,balance    FROM   $company.$billstablex  WHERE ACCOUNT=(SELECT ACCOUNT FROM COMPANY.EMAILS  WHERE emails.account=$billstablex.account)";mysqli_query($connect,$b)or die(mysqli_error($connect));

		}
		}
$x="INSERT INTO BALANCE2(ACCOUNT,AMOUNT) SELECT ACCOUNT,SUM(AMOUNT) FROM BALANCE1 GROUP BY ACCOUNT";mysqli_query($connect,$x)or die(mysqli_error($connect));
	
	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstablex='accounts'.$i;
$b="INSERT INTO OUTBOX ( ACCOUNT,CONTACT,MESSAGE,STATUS,DATE) SELECT BALANCE2.ACCOUNT,CONTACT,CONCAT('DEAR  ',$accountstablex.client,'A/C No. ',$accountstablex.account,' YOUR  CURRENT BALANCE IS Ksh ',AMOUNT),CONCAT('PENDING'),CURRENT_TIMESTAMP FROM BALANCE2,$accountstablex  WHERE $accountstablex.ACCOUNT=BALANCE2.ACCOUNT ";mysqli_query($connect,$b)or die(mysqli_error($connect));

		}
		}

		

$x="SELECT COUNT(ID) FROM OUTBOX WHERE STATUS ='PENDING' AND CONTACT NOT REGEXP '@'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$sms=$y['COUNT(ID)'];}}
	else if(mysqli_num_rows($x)<1){exit;}
	
	
	$x="SELECT CONTACT ,MESSAGE,ID FROM OUTBOX WHERE STATUS ='PENDING' AND CONTACT NOT REGEXP '@'  LIMIT 1";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=mysqli_fetch_array($x))
		{$contact=$y['CONTACT'];  $message=$y['MESSAGE'];$id=$y['ID'];}}
	
	//////////////////SMS CODE/////////
	$url = 'https://sms.lamuwater.co.ke/api/services/sendsms/';
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header


  $curl_post_data = array(
          //Fill in the request parameters with valid values
         'partnerID' => '215',
         'apikey' => '094610704102e238472f243a61e6d152',
         'mobile' => $contact,
         'message' => $message,
         'shortcode' => 'LAMU-WATER',
         'pass_type' => 'plain', //bm5 {base64 encode} or plain
  );

  $data_string = json_encode($curl_post_data);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

  $curl_response = curl_exec($curl);
  //print_r($curl_response);
	//////////////////////////
	

 //
 $x="DELETE  FROM OUTBOX WHERE ID=$id";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM COMPANY.EMAILS WHERE EMAILS.ACCOUNT IN (SELECT ACCOUNT FROM LAKWA.BALANCE2 )";mysqli_query($connect,$x)or die(mysqli_error($connect)); 
?>
<div   class="btn-info btn-sm"  id="clock">PROCESSING BALANCE INQUERY</div>