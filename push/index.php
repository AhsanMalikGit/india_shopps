<?php
include("conn.php");
define( 'API_ACCESS_KEY', 'AIzaSyDaWkglzT3Ya9I1zd2L3I9z-LQ0I9XqRP8' );


$msg = array
(
	'message' 	=> 'MotoG4 plus with high end specs launched!! Exclusive offers, Grab now!!',
	'title'		=> 'Latest motoG4 plus at cheapest prices!',
	//'subtitle'	=> 'This is a subtitle. subtitle',
	//'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
	'vibrate'	=> 1,
	'sound'		=> 1,
	//'link'		=> 'accessibility',
	//'link'		=> 'indiashopps',
	'link'		=> 'http://linksredirect.com/?pub_id=4618CL4384&url=http%3A%2F%2Fwww.amazon.in%2Fb%2Fref%3DG4Plus%3F_encoding%3DUTF8%26node%3D10213866031%26pf_rd_m%3DA1VBAL9TL5WCBF%26pf_rd_s%3Ddesktop-hero-kindle-A%26pf_rd_r%3D0PSMBPX7PHN7ECTDJ26E%26pf_rd_t%3D36701%26pf_rd_p%3D942331087%26pf_rd_i%3Ddesktop',
	//'_id'		=> '1',
	//'cat_id'		=> '351',
	//'largeIcon'	=> 'http://img5a.flixcart.com/www/promos/new/20150827_000331_730x300_image-730-300.jpg',
	'largeIcon'	=> 'http://app.indiashopps.com/images/notification/gcm_banner11.jpg',
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
exit;
	$pass=0;$fail=0;
	//$sql = "SELECT * FROM `and_install` where push_id is not null";
	$sql = "SELECT DISTINCT(device_id),push_id FROM `and_device` where push_id is not null";
	//$sql = "SELECT DISTINCT(device_id),push_id FROM `and_install` where push_id is not null";
	$res = mysql_query($sql) or die(mysql_error());
	while($row = mysql_fetch_object($res))
	{		
		//echo $row->push_id;
		$fields = array
		(
			'registration_ids' 	=> array($row->push_id),
			'data'			=> $msg
		);
		if(send($fields))
		{
			$pass++;
		}else{
			$fail++;
			$up = "update `and_device` set active=0 where device_id like '".$row->device_id."'";
			mysql_query($up) or die(mysql_error());
		}
		
	}
	echo "Success: ".$pass."<br>";
	echo "Failure: ".$fail."<br>";
}	
function send($fields)
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
	if($result->failure == 1)
	{		
		return false;
	}
	return true;
}


