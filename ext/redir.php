<?php 

$url = $_GET['url'];
/*if(strpos($url,"&url=") !== false && strpos($url,"vcommission") !== false)
{
	$url = explode("&url=",$url);
	$url = urldecode($url[1]);
}
if(strpos($url,"?utm_source=") !== false && strpos($url,"snapdeal") !== false)
{
	$url = explode("?utm_source=",$url);
	$url = $url[0];
}
if(strpos($url,"affid=affiliate7") !== false)
{
	$url = str_replace("?affid=affiliate7&affExtParam1=campaign","",$url);
	$url = str_replace("&affid=affiliate7&affExtParam1=campaign","",$url);
}*/
//echo $url;exit;
?>

<script type="text/javascript">
	window.location.href="<?php echo $url;?>";
</script>