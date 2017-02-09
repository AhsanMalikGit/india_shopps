<?php
include("conn.php");
define( 'API_ACCESS_KEY', 'AIzaSyDaWkglzT3Ya9I1zd2L3I9z-LQ0I9XqRP8' );


$msg = array
(
	'message' 	=> 'Apple iphone',
	'title'		=> 'Buyt it NOW',
	//'subtitle'	=> 'This is a subtitle. subtitle',
	//'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
	'vibrate'	=> 1,
	'sound'		=> 1,
//	'link'		=> 'indiashopps',
	//'link'		=> 'http://www.amazon.in/gp/product/B014DYVWWS/',
	'_id'		=> '1',
	'cat_id'		=> '351',
	//'largeIcon'	=> 'http://img5a.flixcart.com/www/promos/new/20150827_000331_730x300_image-730-300.jpg',
	'largeIcon'	=> 'http://i2.sdlcdn.com/img/eventImage/12/endofyearsalewebplatinumnewhp31.jpg',
	'smallIcon'	=> 'http://www.indiashopps.com/images/logo1.jpg'
);



if(isset($_GET['id']))
{
	$fields = array
	(
		'registration_ids' 	=> array($_GET['id']),
		'data'			=> $msg
	);
	$res = send($fields);
	if($res)
		echo "Success";
	else
		echo "Failed";
}else{
	//$sql = "select * from and_device where active =1 order by id";
	$sql = "SELECT B.id,A.device_id,B.push_id FROM `and_install`A,and_device B where B.active=1 and  A.version=6 and A.device_id like B.device_id ORDER by A.id";
	$res = mysql_query($sql) or die(mysql_error());
	while($row = mysql_fetch_object($res))
	{		
//print_R($row);exit;
		$fields = array
		(
			'registration_ids' 	=> array($row->push_id),
			'data'			=> $msg
		);
		send($fields,$row->id);
	}
	echo "Success";
}	
function send($fields,$id=false)
{
	$headers = array
	(
		'Authorization: key=' . API_ACCESS_KEY,
		'Content-Type: application/json'
	);
	 
	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
	curl_setopt( $ch,CURLOPT_POST, true );
	curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch );
	curl_close( $ch );

	$result = json_decode($result);
//	print_r($result);exit;
	if($result->failure == 1)
	{
		if($id)
		{
			$upsql = "update and_device set active =0 where id=".$id;
			mysql_query($upsql) or die(mysql_error());
		}
		return false;
	}
	return true;
}


