<?php //////////////////SMS CODE/////////
 /*$curl = curl_init();
  curl_setopt_array( $curl,array( CURLOPT_URL => 'https://sms.textsms.co.ke/api/services/sendsms/?',
  CURLOPT_RETURNTRANSFER =>true,
  CURLOPT_ENCODING =>'',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT =>0,
  CURLOPT_FOLLOWLOCATION =>true,
  CURLOPT_HTTP_VERSION =>CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST =>'POST',
  CURLOPT_POSTFIELDS =>"{
	     'partnerID':'5622',
         'apikey' : '6b4a13f9a0e6413223b2871f5334d94b',
         'mobile':'254735392412',
         'message' : 'TERST',
		 'clientsmsid':'1110'
         'shortcode' : 'LAKWAWATER',
		'pass_type':'plain'
	  
  }",
  CURLOPT_HTTPHEADER =>array( 'Content-Type:application/json','Cookie:PHPSESSID =cvgdj97dihgll583l0omvlaco'),
  )); 

 $curl_response = curl_exec($curl);
  print_r($curl_response); */
$url = 'https://sms.textsms.co.ke/api/services/sendsms';
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header


  $curl_post_data = array(
          //Fill in the request parameters with valid values
         'partnerID' => '5622',
         'apikey' => '6b4a13f9a0e6413223b2871f5334d94b',
         'mobile' => '+254735392412',
		 'clientsmsid' => '1110',
         'message' => 'new data2',
         'shortcode' => 'LAKWAWATER',
		 'pass_type' =>'plain'
  );

  $data_string = json_encode($curl_post_data);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

  $curl_response = curl_exec($curl);
  print_r($curl_response);
	////////////////////////// */
	?>