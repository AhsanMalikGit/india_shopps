<?php 
/*
header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$server 	= 'localhost';
$login 		= 'wwwindia_main'; 
$password 	= 'india@1234'; 
$db 		= 'wwwindia_indiasho'; 
$conn = mysql_connect($server, $login, $password) or die(mysql_error());
mysql_select_db($db, $conn) or die(mysql_error($conn));
date_default_timezone_set("Asia/Kolkata");

$json_data = $_POST['json_data'];
//$json_data = '{"price":"6269","prod_img":"http://n4.sdlcdn.com/imgs/a/i/8/Sony-DSC-W810-SDL879998630-1-f21b4.jpg","track_stock":1,"enabled":1,"product_id":"148584525","vendor":16}';
//print_r($json_data);exit;
$json_data = json_decode($json_data);
//print_r($json_data);exit;
$save['product_id'] 	= $json_data->product_id;
$save['vendor'] 		= $json_data->vendor;
$save['saleprice'] 		= str_replace(",","",$json_data->price);
if($save['vendor'] !=3)
{
	//$save['image_url'] 		= $json_data->prod_img;
}
$save['track_stock'] 	= $json_data->track_stock;
$save['enabled'] 		= $json_data->enabled;
$save['last_update'] 	= time();
//echo "<pre>";print_r($save); exit;
if(empty($save['product_id']))
{
	exit;
}
switch($save['vendor'])
{
	case 1:
	{
		if($save['enabled'] ==0)
		{
			$sql = "update gc_products_flipkart set enabled=0 where product_id like '".mysql_real_escape_string($save['product_id'])."' and vendor =1";
			mysql_query($sql) or die(mysql_error());
			shell_exec("curl -XDELETE 'http://localhost:9200/shopping/product/_query?q=(product_id:'".$save['product_id'] ."')&&(vendor:'".$save['vendor'] ."')'");
			exit;
		}else{
			$ss = "select * from gc_products_flipkart where product_id like '".mysql_real_escape_string($save['product_id'])."'";
			$res = mysql_query($ss) or die(mysql_error());
			if(mysql_num_rows($res)>0)	//Product Exists
			{
				$sql = "update gc_products_flipkart set ";
				foreach($save as $key=>$val){
					if($key !='product_id' && $key != 'vendor')
					{					
						$sql .= "`".mysql_real_escape_string($key)."`='".mysql_real_escape_string($val)."',";				
					}			
				}
				$sql = substr($sql,0,-1)." where product_id like '".mysql_real_escape_string($save['product_id'])."'";		
				//echo $sql;exit;
				mysql_query($sql) or die(mysql_error());
			}
		}
	}
	break;
	case 3:
	{
		if($save['enabled'] ==0)
		{
			$sql = "update gc_products_amazon set enabled=0 where product_id like '".mysql_real_escape_string($save['product_id'])."' and vendor =1";
			mysql_query($sql) or die(mysql_error());
			shell_exec("curl -XDELETE 'http://localhost:9200/shopping/product/_query?q=(product_id:'".$save['product_id'] ."')&&(vendor:'".$save['vendor'] ."')'");
			exit;
		}else{
			$ss = "select * from gc_products_amazon where product_id like '".mysql_real_escape_string($save['product_id'])."'";
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
				//echo $sql;exit;
				mysql_query($sql) or die(mysql_error());
			}
		}
	}
	break;
	case 2:
	case 16:
	{
		if($save['enabled'] ==0)
		{
			$sql = "update gc_products_jms set enabled=0 where product_id like '".mysql_real_escape_string($save['product_id'])."' and vendor =".$save['vendor'];
			mysql_query($sql) or die(mysql_error());
			shell_exec("curl -XDELETE 'http://localhost:9200/shopping/product/_query?q=(product_id:'".$save['product_id'] ."')&&(vendor:'".$save['vendor'] ."')'");
			exit;
		}else{
			$ss = "select * from gc_products_jms where product_id like '".mysql_real_escape_string($save['product_id'])."' and vendor =".$save['vendor'];
			$res = mysql_query($ss) or die(mysql_error());
			if(mysql_num_rows($res)>0)	//Product Exists
			{
				$sql = "update gc_products_jms set ";
				foreach($save as $key=>$val){
					if($key !='product_id' && $key != 'vendor')
					{					
						$sql .= "`".mysql_real_escape_string($key)."`='".mysql_real_escape_string($val)."',";				
					}			
				}
				$sql = substr($sql,0,-1)." where product_id like '".mysql_real_escape_string($save['product_id'])."'";		
				//echo $sql;exit;
				mysql_query($sql) or die(mysql_error());
			}
		}
	}
	break;
	case 40:
	{		
		if($save['enabled'] ==0)
		{
			$sql = "update gc_products_others set enabled=0 where product_id like '".mysql_real_escape_string($save['product_id'])."' and vendor =".$save['vendor'];
			mysql_query($sql) or die(mysql_error());
			shell_exec("curl -XDELETE 'http://localhost:9200/shopping/product/_query?q=(product_id:'".$save['product_id'] ."')&&(vendor:'".$save['vendor'] ."')'");
			exit;
		}else{
			$ss = "select * from gc_products_others where product_id like '".mysql_real_escape_string($save['product_id'])."' and vendor =".$save['vendor'];
			$res = mysql_query($ss) or die(mysql_error());
			if(mysql_num_rows($res)>0)	//Product Exists
			{
				$sql = "update gc_products_others set ";
				foreach($save as $key=>$val){
					if($key !='product_id' && $key != 'vendor')
					{			
						
						$sql .= "`".mysql_real_escape_string($key)."`='".mysql_real_escape_string($val)."',";				
					}			
				}
				$sql = substr($sql,0,-1)." where product_id like '".mysql_real_escape_string($save['product_id'])."'";		
				//echo $sql;exit;
				mysql_query($sql) or die(mysql_error());		
			}
		}
	}
	break;
}
$row = mysql_fetch_object($res);
shell_exec("curl -XPOST 'localhost:9200/shopping/product/".$row->id."-".$save['vendor']."/_update?pretty' -d '{  \"doc\": { \"saleprice\": ".$save['saleprice']." , \"track_stock\": ".$save['track_stock']." }}'");*/