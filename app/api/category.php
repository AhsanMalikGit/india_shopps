<?php 
include 'conn.php';
$keycode = "";
$message = "";
$sql = "select * from `gc_cat` where 1";
if(isset($_REQUEST['level']))
{
	$sql .= " and level=".$_REQUEST['level'];
}
if(isset($_REQUEST['name']))
{
	$sql .= " and name like '".$_REQUEST['name']."'";
}
if(isset($_REQUEST['id']))
{
	$sql .= " and id =".$_REQUEST['id'];
}
if(isset($_REQUEST['parent_id']))
{
	$sql .= " and parent_id =".$_REQUEST['parent_id'];
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
		$rows['category'][] = $row;
		 if(!isset($_REQUEST['level']))
		 {
			//Children
			foreach($rows['category'] as $key => $val)
			{
				//print_r( $val);exit;
				$q1 = "select * from gc_cat where parent_id=".$val->id;
				$res1 =  mysql_query($q1);
				$i=0;
				$rows['category'][$key]->children = array();
				if( mysql_num_rows($res1) > 0)
				{				
					while($row1 = mysql_fetch_object($res1))
					{					
						$rows['category'][$key]->children[] = $row1;
						$i++;
					}
				}
			}
		 }	
	}
	 if(isset($_REQUEST['parent_id']))
	 {		 
		 $q1 = "select image_url,refer_id as category_id,size,refer_url from `slider` where active=1 and home=0 and refer_id=".$_REQUEST['parent_id'];
		 $res1 =  mysql_query($q1);
		 $i=0;
		 $rows['slider'] = array();
		 if( mysql_num_rows($res1) > 0)
		 {				
			while($row1 = mysql_fetch_object($res1))
			{					
				$rows['slider'][] = $row1;
				$i++;
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
