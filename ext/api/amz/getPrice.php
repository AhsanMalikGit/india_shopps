<?php 
require_once('nopro_load.php');
require_once('aws_signed_request.php');
if(isset($_REQUEST['pid']))
{  
	$public_key = 'AKIAJIHY6MKJZSFJE5VA';
	$private_key = 'icz4zmZFz4417c9FoTGBuwY415dU8jhk5z7Hh0uK';
	$associate_tag = 'yourshoppingw-21';
	
	$itemid = $_REQUEST['pid'];
	$region = 'in';
	$requestpro = aws_signed_request($region, array(
					  'Operation' => 'ItemLookup',
					  'ItemId' => $itemid,						 
					  'ResponseGroup' => 'OfferFull',						 
					  ),
	$public_key,
	$private_key,
	$associate_tag			   
	);
	/*	$requestpro = aws_signed_request($region, array(
					  'Operation' => 'ItemSearch',
					  'SearchIndex' => 'Books',						 
					  'Keywords' => 'harry+potter'					 
					  ),
	$public_key,
	$private_key,
	$associate_tag   
	);	*/

	$pxmlpro = nopro_load_xml($requestpro);
	$item = $pxmlpro->Items->Item;
	echo "<PRE>";
	print_r($pxmlpro);exit;
	// $amount = $item->OfferSummary->LowestNewPrice->Amount;
	$amount = (int)str_replace(",","",(str_replace("INR ","",$item->OfferSummary->LowestNewPrice->FormattedPrice)));
	//echo number_format((float)$amount,2,'.','');
	$ret_array['saleprice'] = $amount;
	$ret_array['inStock'] = 1;
	echo json_encode($ret_array);
}
 ?>


