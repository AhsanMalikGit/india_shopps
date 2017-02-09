<?php

// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AIzaSyC6F7_w6hwOqjQe4keqdP_wbFt_pryL9MI' );

if(isset($_REQUEST['push_id']))
{
$push_id = $_REQUEST['push_id'];
}else{
$push_id="fKdpYWwt1bY:APA91bFJMt6wVczVShENX6ewSjQMZaBLUzwSyR_Dh5uyqCRJWtj-xAOEm7iZZcxQjMM2Wmb2PpBiaj9yeMtIePrTqUdQa4CTQaNT1DQ26wS_kH-OCtQzXUgYVm2WNlvFCzlyq4P4UgQw";
}
$fields = array
(
	'registration_ids' 	=> array($push_id)
);
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
//print_r(json_encode( $fields ));exit;
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );

echo $result;