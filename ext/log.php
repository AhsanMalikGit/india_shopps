<?php 
$save['vendor'] 		= $_GET['vendor'];
if($save['vendor'] == 16 ||$save['vendor'] == 4 || $save['vendor'] ==21|| $save['vendor'] ==22|| $save['vendor'] ==5)
{
	$save['product_url'] 	= $_GET['url'];
	//$save['product_url'] = str_replace("{affiliate_id}","32558",$save['product_url']);
}else{
	$save['product_url'] 	= urldecode($_GET['url']);
}
/*include_once "conn.php";

$save['ip'] 			= $_SERVER['REMOTE_ADDR'];
$save['product_url'] 	= urldecode($_GET['url']);
$save['vendor'] 		= $_GET['vendor'];
$save['date'] 			= time();
//$save['referer'] 		= 2;
if(isset($_GET['referer']))
	$save['referer'] 			= $_GET['referer'];	//FF
else
	$save['referer'] 			= 1;				//Chrome
$save['distributer_id'] = (isset($_GET['distributer_id'])?$_GET['distributer_id']:0);

if($save['ip'] != '115.112.138.198')
{
	$field='';$values='';
	$sql = "insert into gc_log (";
	foreach($save as $key=>$val){
		$field .= "`".mysql_real_escape_string($key)."`,";
		$values .= "'".mysql_real_escape_string($val)."',";
	}
	$sql = $sql.substr($field,0,-1).") values (".substr($values,0,-1).")";
		
	mysql_query($sql) or die(mysql_error());
}*/

?>

<script lang="javascript" type="text/javascript">
	window.location.href="<?php echo $save['product_url']; ?>"
</script>
