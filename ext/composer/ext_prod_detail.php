<?php 
header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

require_once('vendor/autoload.php');
$params = array();
$params['hosts'] = array (    
    'localhost:9200'
);
//$params['serializerClass'] = 'Elasticsearch\Serializers\ArrayToJSONSerializer';
$client = new Elasticsearch\Client($params);

if(isset($_REQUEST['id']) || isset($_REQUEST['_id']))
{	
	$search = array();
	$search['index'] = "shopping";
	//echo $_REQUEST['_id'];
	if(isset($_REQUEST['id']))
	{
		$id 	= $_REQUEST['id'];
		$search['body'] = array(
			'size' => 1,
			'query' => array(
				'bool' => array(
					'must' =>  array(
								array('match' => array('id' => $id))    
							)			
				)
			)
		);
	}else if(isset($_REQUEST['_id'])){ 	
		$id 	= $_REQUEST['_id'];		
		$search['body'] = array(
			'size' => 1,
			'query' => array(
				'bool' => array(
					'must' =>  array(
								array('match' => array('_id' => $id))
							)			
				)
			)
		);
	}

	
	//$search['from']  = $data['from'];
	
//print_r($search);exit;
	$result = $client->search($search);//print_r($result);exit;
	$res = $result['hits']['hits'][0]['_source'];
	$arr = array('return_txt' => $res);
	echo json_encode($arr);
}
?>

	