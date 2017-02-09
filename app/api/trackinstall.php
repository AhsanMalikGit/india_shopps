<?php 
require_once 'conn.php';
//$ip = $_SERVER['REMOTE_ADDR'];
$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
$date = date_create();
$date = date_format($date,'Y-m-d H:i:s');
$sql = "insert into track_install values (null,'$ip','$date')";
mysql_query($sql) or die(mysql_error());
?>
<script>
window.location.href="https://play.google.com/store/apps/details?id=com.indiashopps.android&referrer=source%3Dcmaster";
</script>