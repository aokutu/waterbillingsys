<?php $url = 'https://sms.lamuwater.co.ke/api/services/sendsms/';
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header


  $curl_post_data = array(
          //Fill in the request parameters with valid values
         'partnerID' => '215',
         'apikey' => '094610704102e238472f243a61e6d152',
         'mobile' => '0741135535',
         'message' => 'This is a test message',
         'shortcode' => 'LAMU-WATER',
         'pass_type' => 'plain', //bm5 {base64 encode} or plain
  );

  $data_string = json_encode($curl_post_data);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

  $curl_response = curl_exec($curl);
  print_r($curl_response);
  ?>