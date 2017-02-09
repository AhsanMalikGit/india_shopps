<?php 
include 'conn.php';
$keycode = "";
$message = "";
$sql = "select * from `gc_cat` where level=0 order by sequence";
$res = mysql_query($sql);

$sql1 = "select * from `slider` where active=1 and home=1 and app=1";
$res1 = mysql_query($sql1);

$q_coupon = "select * from `gc_deals` where 1 order by sequence limit 0,10";
$res_coupon = mysql_query($q_coupon);

$q_top_offers = "select * from `gc_deals` where 1 order by sequence limit 10,8";
$res_top_offers = mysql_query($q_top_offers);

$sql_cat = "select * from `gc_cat` where level=0 and shown=1 order by sequence";
$res_cat = mysql_query($sql_cat);

//Trending
$sql_trending = "select * from `gc_log` where referer=1 order by log_id desc limit 0,15";
$res_trending = mysql_query($sql_trending);


if(isset($_REQUEST['device_id']))
{
	$data = $_REQUEST;
	$save['device_id'] 		= $data['device_id'];
	$save['push_id'] 		= $data['push_id'];
	$save['active'] 		= 1;
	$save['create_date'] 	= date_create();
	$save['create_date'] 	= date_format($save['create_date'],'Y-m-d H:i:s');
	//print_r($save);exit;
	$field='';$values='';
	$q = "select * from and_device where device_id like '".$save['device_id']."' and push_id like '".$save['push_id']."'";
	$resp = mysql_query($q);
	if(mysql_num_rows($resp) == 0)
	{
		$sql = "insert into and_device (";
		foreach($save as $key=>$val){
			$field .= "`".mysql_real_escape_string($key)."`,";
			$values .= "'".mysql_real_escape_string($val)."',";
		}
		$sql = $sql.substr($field,0,-1).") values (".substr($values,0,-1).")";
		$res_device_id = mysql_query($sql);
	}
}





if($res)
{	
	$keycode = "100";
	$message = "Successfully";
	while($row = mysql_fetch_object($res))
	{
		$rows['status'] = true;
		$rows['keycode'] = 100;
		$rows['category'][] = $row;		
	}
	while($row1 = mysql_fetch_object($res1))
	{		
		$rows['slider'][] = $row1;		
	}	
	while($row_coupon = mysql_fetch_object($res_coupon))
	{		
		$rows['deals'][] = $row_coupon;		
	}
	while($row_top_offers = mysql_fetch_object($res_top_offers))
	{		
		$rows['top_offers'][] = $row_top_offers;		
	}	
	while($row_cat = mysql_fetch_object($res_cat))
	{		
		$rows['cat'][] = $row_cat;		
	}
	
	while($row_trending = mysql_fetch_object($res_trending))
	{			
		$trnd = json_decode(getData("http://www.indiashopps.com/ext/composer/ind_andr_detail.php?_id=".$row_trending->product_id."-".$row_trending->vendor));		
		if(!empty($trnd) && $trnd != null)
		{
			$rows['trending'][] = ($trnd);		
		}
	}
	
	$rows['product_offer'][0] ['image_url']= "http://app.indiashopps.com/images/300x250/prod_off1.png";
	$rows['product_offer'][0] ['refer_url']= "http://www.amazon.in/s/ref=nb_sb_ss_c_0_5?url=search-alias%3Delectronics&field-keywords=intex+mobile&sprefix=intex%2Caps%2C272&tag=indiashopps-21";
	$rows['product_offer'][1] ['image_url']= "http://app.indiashopps.com/images/300x250/prod_off2.png";
	$rows['product_offer'][1] ['refer_url']= "http://www.flipkart.com/search?q=saree&affid=affiliate7";
	
	
	if(isset($_REQUEST['recent_prod']) && !empty($_REQUEST['recent_prod']))
	{
		$data = $_REQUEST;
		$id = $data['recent_prod'];
		$id = explode(",",$id);
		//print_r($id);exit;
		foreach($id as $val)
		{
			$recent = json_decode(getData("http://www.indiashopps.com/ext/composer/ind_andr_detail.php?_id=".$val));
			if(!empty($recent) && $recent != null)
			{
				$rows['recent'][] = $recent;
			}
		}
		//print_r($rows['recent']);exit;
	}
	header("Content-type:application/json"); 
	if(isset($_REQUEST['pretty']))
	{
		echo json_encode($rows, JSON_PRETTY_PRINT);
	}else{
		echo json_encode($rows);
	}
}else{
	$keycode = "200";
	$message = mysql_error();
	$res = array('keycode'=>$keycode,'status'=>false,'message'=>$message);
	echo json_encode($res);
}

function getData($url)
{
	$curl_handle=curl_init();
	curl_setopt($curl_handle, CURLOPT_URL,$url);
	//curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	$userAgent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13";
	curl_setopt($curl_handle, CURLOPT_USERAGENT, $userAgent);
	$query = curl_exec($curl_handle);
	curl_close($curl_handle);
	return $query;
}