<?php 
include 'conn.php';
$keycode = "";
$message = "";
if(isset($_REQUEST['insert_user']))
{
	//if(isset($_REQUEST['email']) && isset($_REQUEST['password']) && isset($_REQUEST['name']) && isset($_REQUEST['photo_url']))
	{
		$save['email'] 			= $_REQUEST['email'];
		$save['password'] 		= $_REQUEST['password'];
		$save['name'] 			= $_REQUEST['name'];
		$save['photo_url'] 		= $_REQUEST['photo_url'];
		$save['activated'] 		= 0;
		$c = date_create();
		$save['created_at'] 	= date_format($c,"Y-m-d H:i:s");
		//print_r($save);
		$field='';$values='';
		$sql = "insert into user (";
		foreach($save as $key=>$val){
			$field .= "`".mysql_real_escape_string($key)."`,";
			$values .= "'".mysql_real_escape_string($val)."',";
		}
		$sql = $sql.substr($field,0,-1).") values (".substr($values,0,-1).")";
			
		$res = mysql_query($sql);
		if($res)
		{	
			$keycode = "100";
			$message = "Registered Successfully";
		}else{
			$keycode = "300";
			$message = mysql_error();
		}
	}/*else{
		$keycode = "200";$message = "Parameter Missing";
	}*/
}else{
	$keycode = "200";$message = "Parameter Missing";
}
$res = array('keycode'=>$keycode,'message'=>$message);
echo json_encode($res);
//yourshoppingwizard.com/app/api.php?insert_user=1&email=niti@niti.com&password=niti&name=asd&photo_url=asd