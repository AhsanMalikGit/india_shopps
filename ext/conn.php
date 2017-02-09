<?php 
if($_SERVER['HTTP_HOST']=='localhost')
{
	$server = 'localhost';
	$login = 'root'; 
	$password = ''; 
	$db = 'indiashopps'; 
}else{
	// you can change the following details as per your database configuration
	$server = 'localhost';
	$login = 'wwwindia_admin'; 
	$password = 'yTxAQ}x^_RS)'; 
	$db = 'wwwindia_extension';  
	$db2 = 'wwwindia_indiasho';  	
}

// establish database connection

$conn = mysql_connect($server, $login, $password);
$conn1 = mysqli_connect($server, $login, $password,$db) or die(mysql_error());
$conn2 = mysqli_connect($server, $login, $password,$db2) or die(mysql_error());

//if(!$conn && isset($_GET['url']) && isset($_GET['vendor']))
if(mysql_errno() == 1203 && isset($_GET['url']) && isset($_GET['vendor']))
{
if($_GET['vendor'] == 4 || $_GET['vendor'] == 2|| $_GET['vendor'] ==16|| $_GET['vendor'] ==5)
{
	$save['product_url'] 	= $_GET['url'];
	//$save['product_url'] = str_replace("{affiliate_id}","32558",$save['product_url']);
}else{
	$save['product_url'] 	= urldecode($_GET['url']);
}

?>
	
<script lang="javascript" type="text/javascript">
	window.location.href="<?php echo $save['product_url']; ?>"
</script>

	<?php 
}
mysql_select_db($db, $conn) or die(mysql_error($conn));
date_default_timezone_set("Asia/Kolkata");

$vendor_name = array(
"1" => "Flipkart",
"2" => "Jabong",
"3" => "Amazon",
"4" => "Myntra",
"5" => "Homeshop18",
"6" => "naaptol",
"7" => "shopclues",
"8" => "Indiatimes",
"9" => "maniacstore",
"10" => "Play Rummy",
"11" => "Dominos",
"12" => "Expedia",
"13" => "MakeMyTrip",
"14" => "rediff",
"15" => "yebhi",
"16" => "Snapdeal",
"17" => "pepperfry",
"18" => "infibeam",
"19" => "saholic",
"20" => "croma",
"21" => "trendin",
"22" => "zovi",
"23" => "firstcry",
"24" => "lenskart",
"25" => "fashionara",
"26" => "fashionandyou",
"27" => "americanswan",
"28" => "babyoye",
"29" => "shopperzville",
"30" => "fabfurnish",
"31" => "urbandazzle",
"32" => "healthkart",
"33" => "urbanladder",
"34" => "koovs",
"35" => "Zivame",
"36" => "prettysecrets",
"37" => "100bestbuy",
"38" => "freecultr",
"39" => "FoodPanda",
"40" => "Ebay",
"41" => "limeroad",
"42" => "stalkbuylove",
"43" => "yepme"
);

$vendor_logo = array(
"1" => "http://www.yourshoppingwizard.com/images/fk.jpg",
"2" => "http://www.yourshoppingwizard.com/images/jabong.jpg",
"3" => "http://www.yourshoppingwizard.com/images/am.jpg",
"4" => "http://www.yourshoppingwizard.com/images/myntra.jpg",
"5" => "http://www.yourshoppingwizard.com/images/hs_logo.gif",
"6" => "http://images5.naptol.com/usr/local/csp/staticContent/images_layout-html5/naaptol.png",
"7" => "http://cdn.shopclues.com/images/skin/shopclues_logo.gif",
"8" => "http://www.yourshoppingwizard.com/images/logo_6298524_112.jpg",
"9" => "http://www.maniacstore.com/images/FW/logo.png",
"11" => "http://sasstag.com/wp-content/uploads/2013/05/dominos-pizza-inc-logo.jpg",
"12" => "http://www.userlogos.org/files/logos/jumpordie/expedia_01.png",
"13" => "http://www.userlogos.org/files/logos/Karmody/makemytrip_01.png",
"14" => "http://imshopping.rediff.com/shopping/homepix/rediffshop-logo_220609.gif",
"15" => "http://www.indiashopps.com/assets/img/Yebhi-Logo.png",
"16" => "http://www.yourshoppingwizard.com/images/logo_snapdeal.jpg",
"17" => "http://i1.pepperfry.com/img/pf_header_logo.jpg?v=3",
"18" => "http://www.infibeam.com/assets/skins/common/images/infibeam_logo.png",
"19" => "http://www.saholic.com/images/saholic-logo-5648.jpg",
"20" => "http://www.cromaretail.com/images/croma-retail-logo.png",
"21" => "http://cdn1.cdntrendin.com/img/logo_v3.jpg",
"22" => "http://d32vlg867bsa1v.cloudfront.net/z/prod/w/2/i/zovi-logo2.png",
"23" => "http://www.yourshoppingwizard.com/images/logo_b66be5e_161.jpg",
"24" => "http://dxq0awx9u4n5p.cloudfront.net/skin/frontend/default/blanco_sun/images/logo_lens.png",
"25" => "http://www.yourshoppingwizard.com/images/logo_17e7b61_500.jpg",
"26" => "http://www.fashionandyou.com/assets/4229/app/components/fny_logo_new.png",
"27" => "http://img.americanswan.com/skin/frontend/enterprise/lecom/images/logo.gif",
"28" => "http://media.babyoye.com/images/babyoye-logo.png",
"29" => "http://fostelo.com/image/data/banners/fostelologo.png",
"30" => "http://www.yourshoppingwizard.com/images/logo_2dcc6fe_456.jpg",
"31" => "http://www.urbandazzle.com/skin/frontend/default/default/images/logo1.png",
"32" => "http://static.healthkart.com/assets/images/HK-Logo.png",
"33" => "http://s.urbanladder.com/skin/frontend/default/urbanladder/images/logo.png",
"34" => "http://images.kooves.com/images/kv/KOOVS-Fashion-logo-new.jpg",
"35" => "http://www.yourshoppingwizard.com/images/logo_a427da1_320.jpg",
"36" => "http://www.yourshoppingwizard.com/images/prettysecrets.jpg",
"37" => "http://images.100bestbuy.com/menu/new/bestbuy.jpg",
"38" => "http://grabbestoffers.com/wp-content/themes/couponpress/thumbs/freecultr_logo.png",
"39" => "http://www.yourshoppingwizard.com/images/fp_logo.png",
"40" => "http://www.yourshoppingwizard.com/ext/img/ebay.png",
"41" => "http://www.yourshoppingwizard.com/ext/img/limeroad.jpg",
"42" => "http://www.stalkbuylove.com/skin/frontend/galaeva/default/images/logo.png",
"43" => "http://staticaky.yepme.com/images/yepme-logo.gif"
);
?>