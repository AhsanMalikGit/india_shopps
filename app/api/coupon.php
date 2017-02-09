<?php 
include 'conn.php';
$keycode = "";
$message = "";

$sql = "select * from `and_deals_cat` where active=1";
if(isset($_REQUEST['vendor_name']))
{
	$sql = "select a.* from `gc_deals` a,and_deals_cat b where curdate() <= expiry_date and vendor_name like '".$_REQUEST['vendor_name']."' and a.cat_id=b.id";
}
if(isset($_REQUEST['promo']))
{
	$sql = "select * from `gc_deals` where promo like '".$_REQUEST['promo']."'";
	//$res = mysql_query($q_coupon);
}


$res = mysql_query($sql);
if($res)
{	
	$keycode = "100";
	$message = "Fetched Successfully";
	while($row = mysql_fetch_object($res))
	{		
		$rows['status'] = true;
		$rows['keycode'] = 100;
		if(isset($_REQUEST['vendor_name']))
		{
			$rows['coupon'][] = $row;		
		}else if(isset($_REQUEST['promo']))
		{
			$rows['deal_detail'][] = $row;		
		}else{
			$rows['coupon_category'][] = $row;
		
			foreach($rows['coupon_category'] as $key => $val)
			{
				//print_r( $val);exit;
				$q1 = "select * from gc_deals where cat_id=".$val->id." group by vendor_name";
				$res1 =  mysql_query($q1);
				$i=0;
				$rows['coupon_category'][$key]->children = array();
				if( mysql_num_rows($res1) > 0)
				{				
					while($row1 = mysql_fetch_object($res1))
					{					
						$rows['coupon_category'][$key]->children[] = $row1;
						$i++;
					}
				}
			}
		}
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
