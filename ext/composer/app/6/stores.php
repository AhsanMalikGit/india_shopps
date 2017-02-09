<?php 
header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

require_once('../../vendor/autoload.php');
$params = array();
$params['hosts'] = array (    
    'localhost:9200'
);

$client = new Elasticsearch\Client($params);

$size				= intval(isset($_REQUEST['size'])?$_REQUEST['size']:0);
$min_doc_count		= intval(isset($_REQUEST['min_doc_count'])?$_REQUEST['min_doc_count']:0);

$search = array();
$search['index'] = "deals";

$search['body'] = array(
	'size' => 0,	
	'aggs' => array(		
		'vendor_name' => array(
			'terms' => array(
				'field' => 'vendor_name',
				'size' =>$size,				
				'order' => array('_count'=>'desc'),				
				'min_doc_count' => $min_doc_count
			),
			'aggs' => array(
				'vendor_logo' => array(
					'terms' => array(
						'field' => 'vendor_logo',
						'size'=>1					
					)			
				)
			)			
		)
		
	)
);

//echo "<pre>";print_r(json_encode($search));
$result = $client->search($search);
//echo "<pre>";print_r($result);exit;
$arr = array('return_txt' => $result);
echo json_encode($arr);
?>	