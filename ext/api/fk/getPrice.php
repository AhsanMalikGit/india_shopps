<?php 
include "clusterdev.flipkart-api.php";
if(isset($_REQUEST['pid']))
{
	$time_start = microtime(true);

	$pid = $_REQUEST['pid'];
	$ids = array('BLBE99DTRYZHCZQT','BLBE99DTYZKEYPGH','BLBECG4WM5M2RPHQ','BLBE7YWMVEZRZNNS','BLBE7YWMEZZBBADX','BLBE6TUCEY97RY7Q','BLBE7YWMQSGRFPJ7','BLBE6TUCWE5JRWUM','BLBE7YWMHUGCV5UC','BLBE6TUCG8SRHZQG','BLBECA7EJA9QM2PK','BLBEB5EXYHRAXUQ9','BLBE4G6MWGSF2SZR','BLBE7YWMGZJFZCXN','IMMDMMXT8H2NXV4Z','IMMDMK9GCHBRTMSX','BLBEB9KZFAGG5BU4','BLBE8BZ9ZJGRHRME','BLBEDB4ZAVHT9AYU','BLBEBPYCGQYPZ2SV');

	// $_REQUEST['pid'];
	$flipkart = new \clusterdev\Flipkart("dealzunli", "d831a6762b8c43ba9ed0bfe8496d7d60", "json");

	foreach( $ids as $id )
	{
		$details = $flipkart->call_update($id);
		//$details = $flipkart->call_update("SARDXVBHCGZFYZSC");
		if(!$details){
			echo 0;
			// exit();
		}
		// echo "<pre>";
		
		$details = json_decode($details, TRUE);
		$products = $details['productBaseInfo'];
		echo $products['productAttributes']['sellingPrice']['amount']."<br/>";
	}

	$time_end = microtime(true);
    $time = $time_end - $time_start;
    echo "Process Time: {$time}";exit;
	var_dump( $ids );
	// print_r( $details );exit;

	//$products = $details['productBaseInfo']['productAttributes']['inStock'];
	$products = $details['productBaseInfo'];
	//print_r($products['productAttributes']['inStock'] );exit;
	$saleprice = $products['productAttributes']['sellingPrice']['amount'];
	$inStock = $products['productAttributes']['inStock'];
	$ret_array['saleprice'] = $saleprice;
	$ret_array['inStock'] = $inStock;
	echo json_encode($ret_array);
}
