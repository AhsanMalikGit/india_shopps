<?php die;

exit; 
header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$server 	= 'localhost';
$login 		= 'wwwindia_main'; 
$password 	= 'I_ndia@1234'; 
$db 		= 'wwwindia_indiasho'; 
$conn = mysql_connect($server, $login, $password) or die(mysql_error());
mysql_select_db($db, $conn) or die(mysql_error($conn));
date_default_timezone_set("Asia/Kolkata");

$json_data = $_POST['json_data'];


//$json_data = '{"mrp":"39000","price":"24440","discount":"37","track_stock":1,"enabled":1,"product_id":"TVSEAFGFJBWZ8HPH","vendor":1}';
$json_data = json_decode($json_data);

$save['product_id'] 	= $json_data->product_id;
$save['vendor'] 		= $json_data->vendor;

if(!empty($json_data->price))
	$save['saleprice'] 		= str_replace(",","",$json_data->price);
if(!empty($json_data->mrp))
	$save['price'] 		= str_replace(",","",$json_data->mrp);

if(!empty($json_data->mrp))
	$save['discount'] 		= str_replace("%","",$json_data->discount);



/*if($save['vendor'] ==2 || $save['vendor'] ==44|| $save['vendor'] ==16)
{
	$save['image_url'] 		= $json_data->prod_img;
}*/
$save['track_stock'] 	= $json_data->track_stock;
if($json_data->track_stock == true)
	$save['track_stock'] = 1;
else if($json_data->track_stock == false)
	$save['track_stock'] = 0;
$save['enabled'] 		= $json_data->enabled;
$save['last_update'] 	= time();
//echo "<pre>";print_r($save);

if(empty($save['product_id']))
{
	exit;
}
switch($save['vendor'])
{
	case 1:
	{		
		$sschk = "select * from gc_products_vendorlist where product_id like '".mysql_real_escape_string($save['product_id'])."' and vendor =".$save['vendor'];
		$reschk = mysql_query($sschk) or die(mysql_error());		
		if(mysql_num_rows($reschk) == 0)
		{
			$ss = "select * from gc_products_flipkart where product_id like '".mysql_real_escape_string($save['product_id'])."' and category_id not in(301,311,313,317,318,319,320,321,322,323,324,325,326,327,328,330,331,332,333,334,335,337,338,339,340,341,342,344,347,348,351,345,346,352,359,360,361,364,365,366,370,371,372,374,379,381,382,384,390,392,407,435,436,437,445,446,447,448,471,472,473,476,489,622,623,624,626,336,628,635,636,633,637,627,638,632,640,639)";
			$res = mysql_query($ss) or die(mysql_error());
			if(mysql_num_rows($res)>0)	//Product Exists
			{
				$sql = "update gc_products_flipkart set ";
				foreach($save as $key=>$val)
				{
					if($key !='product_id' && $key != 'vendor')
					{					
						$sql .= "`".mysql_real_escape_string($key)."`='".mysql_real_escape_string($val)."',";				
					}			
				}
				$sql = substr($sql,0,-1)." where product_id like '".mysql_real_escape_string($save['product_id'])."'";		
				$row = mysql_fetch_object($res);
				if(!isset($save['saleprice']))
					$save['saleprice'] = $row->saleprice;	
				shell_exec ("curl -XPOST 'localhost:9200/shopping/product/".$row->id."-".$save['vendor']."/_update?pretty' -d '{  \"doc\": { \"saleprice\": ".$save['saleprice']." , \"track_stock\": ".$save['track_stock']." }}'");
				//echo $sql;exit;
				mysql_query($sql) or die(mysql_error());
				if($save['enabled'] ==0)
				{
					shell_exec("curl -XDELETE 'http://localhost:9200/shopping/product/_query?q=(product_id:'".$save['product_id'] ."')&&(vendor:'".$save['vendor'] ."')'");
				}
			}			
		}elseif(mysql_num_rows($reschk) > 0){	
				$rowchk = mysql_fetch_object($reschk);
				$sql = "update gc_products_vendorlist set ";
				foreach($save as $key=>$val){
					if($key !='product_id' && $key != 'vendor' && $key != 'image_url')
					{					
						$sql .= "`".mysql_real_escape_string($key)."`='".mysql_real_escape_string($val)."',";				
					}			
				}
				$sql = substr($sql,0,-1)." where product_id like '".mysql_real_escape_string($save['product_id'])."'";	
			//echo $sql;exit;	
				shell_exec ("curl -XPOST 'localhost:9200/test_sec/vendors/".$rowchk->ref_id."/_update?pretty' -d '{  \"doc\": { \"saleprice\": ".$save['saleprice']." , \"track_stock\": ".$save['track_stock']." }}'");					
				
				mysql_query($sql) or die(mysql_error());				
		}
	
	}
	break;
	case 3:
	{
		$sschk = "select * from gc_products_vendorlist where product_id like '".mysql_real_escape_string($save['product_id'])."' and vendor =".$save['vendor'];
		$reschk = mysql_query($sschk) or die(mysql_error());		
		if(mysql_num_rows($reschk) == 0)
		{		
			$ss = "select * from gc_products_amazon where product_id like '".mysql_real_escape_string($save['product_id'])."' and category_id not in(301,311,313,317,318,319,320,321,322,323,324,325,326,327,328,330,331,332,333,334,335,337,338,339,340,341,342,344,347,348,351,345,346,352,359,360,361,364,365,366,370,371,372,374,379,381,382,384,390,392,407,435,436,437,445,446,447,448,471,472,473,476,489,622,623,624,626,336,628,635,636,633,637,627,638,632,640,639)";
			$res = mysql_query($ss) or die(mysql_error());
			if(mysql_num_rows($res)>0)	//Product Exists
			{
				$sql = "update gc_products_amazon set ";
				foreach($save as $key=>$val){
					if($key !='product_id' && $key != 'vendor')
					{					
						$sql .= "`".mysql_real_escape_string($key)."`='".mysql_real_escape_string($val)."',";				
					}			
				}
				$sql = substr($sql,0,-1)." where product_id like '".mysql_real_escape_string($save['product_id'])."'";
				$row = mysql_fetch_object($res);
				if(!isset($save['saleprice']))
					$save['saleprice'] = $row->saleprice;	
				shell_exec ("curl -XPOST 'localhost:9200/shopping/product/".$row->id."-".$save['vendor']."/_update?pretty' -d '{  \"doc\": { \"saleprice\": ".$save['saleprice']." , \"track_stock\": ".$save['t