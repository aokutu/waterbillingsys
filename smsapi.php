 <?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'SEND  SMS-EMAILS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ print"<h1>ACCESS DENIED</h1>";exit;}


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
$url = 'https://sms.textsms.co.ke/api/services/sendsms';
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header


  $curl_post_data = array(
          //Fill in the request parameters with valid values
		  
		  //Fill in the request parameters with valid values
         'partnerID' => '5622',
         'apikey' => '6b4a13f9a0e6413223b2871f5334d94b',
         'mobile' => $contact,
		 'clientsmsid' => '1110',
         'message' => $message,
         'shortcode' => 'LAKWAWATER',
		 'pass_type' =>'plain'
  );

  $data_string = json_encode($curl_post_data);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

  $curl_response = curl_exec($curl);
  print_r($curl_response);
	//////////////////////////
	

 //sleep(4);
 $x="DELETE  FROM OUTBOX WHERE ID=$id";mysqli_query($connect,$x)or die(mysqli_error($connect));
?>
<div   class="btn-info btn-sm"  id="clock">LAST SENT AT <?php echo $date;?> PENDING SMS:  <?php print $sms; ?> CONTACT <?php print $contact?> SMS:<?php print $message;?></div>