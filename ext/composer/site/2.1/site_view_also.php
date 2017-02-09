<?php 
require_once("config.php");

$cat 	= "";
$group 	= "";
$group_alt = "";
$productInfo 	= $_REQUEST['info'];
$prod 			= isset($_REQUEST['pid'])?$_REQUEST['pid']:"";
$cat 		= isset($_REQUEST['cat'])?$_REQUEST['cat']:"";
$cat_id 		= isset($_REQUEST['cat_id'])?$_REQUEST['cat_id']:"";
$group_post		= isset($_REQUEST['group'])?$_REQUEST['group']:"";
$vendor		= isset($_REQUEST['vendor_post'])?$_REQUEST['vendor_post']:"";
$size		= isset($_REQUEST['size'])?$_REQUEST['size']:"";
$len		= isset($_REQUEST['len'])?$_REQUEST['len']:"";


$productInfo = str_replace("/","-",$productInfo);
$productInfo = str_replace(" AND ","",$productInfo);
$productInfo = str_replace("AND ","",$productInfo);
$productInfo = str_replace(" and ","",$productInfo);
$productInfo = str_replace("and ","",$productInfo);
$productInfo = str_replace(" OR ","",$productInfo);
$productInfo = str_replace(" or ","",$productInfo);

$clickUrl = 'http://www.indiashopps.com/ext/log.php';
$search = array();

$search['index'] = "shopping";
if(isset($_REQUEST['isBook']) && $_REQUEST['isBook'] !== false )
{
	$search['index'] = "books";
}
	
//$search['from']  = $data['from'];
$search['body'] = array(
	'size' => 20,
	'query' => array(
		'bool' => array(
			'must' =>  array(
						array('match' => array('name' => $productInfo)),
						array('match' => array('track_stock' => 1)),
						array('range' => array('saleprice' => array('gte' => 10)))
					)			
		)
	)
);

//$search['body']['query']['bool'] = array( 'should' => new \stdClass());

if(!empty($cat) && !empty($group))
{
	if(!empty($group_alt))
	{
		$search['body']['query']['bool']['should'] = array(
			array('match' => array('category' => $cat)),
			array('match' => array('grp' => $group)),
			array('match' => array('grp' => $group_alt))
		);	

	}else{
		$search['body']['query']['bool']['should'] = array(
			array('match' => array('category' => $cat)),
			array('match' => array('grp' => $group))
		);	
	}
}else if(!empty($cat))
{ 	
	$search['body']['query']['bool']['should'] = array(
		array('match' => array('category' => $cat))		
	);	
}else if(!empty($group))
{	
	if(!empty($group_alt))
	{
		$search['body']['query']['bool']['should'] = array(
			array('match' => array('grp' => $group)),
			array('match' => array('grp' => $group_alt))
		);	

	}else{
		$search['body']['query']['bool']['should'] = array(
			array('match' => array('grp' => $group))
		);
	}
}

if(!empty($prod))
{				
	$search['body']['query']['bool']['must_not'] = array(
		array('match' => array('_id' => $prod))    
	);		
}
// echo "<PRE>";
// print_r( $search );exit;

//print_r(json_encode($search));
$result = $client->search($search);

//print_r($result['hits']['hits']);exit;
$arr = array('return_txt' => $result['hits']['hits']);
echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	//echo $return_txt;



function get_img( $img ) {
//print_r($img);exit;
if(strpos($img,',') || strpos($img,';'))
{
	if(strpos($img,','))
	{
		$img = explode(",",$img);
	}else if(strpos($img,';')){
		$img = explode(";",$img);
	}
	$img = (!empty($img[5])?$img[5]:(!empty($img[0])?$img[0]:""));
	//echo $img;exit;
	if(!strpos($img,'100x100') && strpos($img,'40x40'))
	{
		$img = str_replace("40x40","100x100",$img);
		
	}
	if(!strpos($img,'100x100') && strpos($img,'400x400'))
	{
		$img = str_replace("400x400","100x100",$img);
		
	}
	if(!strpos($img,'100x100') && strpos($img,'125x125'))
	{
		$img = str_replace("125x125","100x100",$img);
		
	}if(!strpos($img,'100x100') && strpos($img,'275x275'))
	{
		$img = str_replace("275x275","100x100",$img);
		
	}if(!strpos($img,'100x100') && strpos($img,'200x200'))
	{
		$img = str_replace("200x200","100x100",$img);
		
	}
}
	return $img;
}
function get_img1( $img ) {
//print_r($img);exit;
if(strpos($img,',') || strpos($img,';'))
{
	if(strpos($img,','))
	{
		$img = explode(",",$img);
	}else if(strpos($img,';')){
		$img = explode(";",$img);
	}
	$img = (!empty($img[5])?$img[5]:(!empty($img[0])?$img[0]:""));
	//echo $img;exit;
	if(!strpos($img,'200x200') && strpos($img,'40x40'))
	{
		$img = str_replace("40x40","200x200",$img);
		
	}
	if(!strpos($img,'200x200') && strpos($img,'400x400'))
	{
		$img = str_replace("400x400","200x200",$img);
		
	}
	if(!strpos($img,'200x200') && strpos($img,'125x125'))
	{
		$img = str_replace("125x125","200x200",$img);
		
	}if(!strpos($img,'200x200') && strpos($img,'275x275'))
	{
		$img = str_replace("275x275","200x200",$img);
		
	}if(!strpos($img,'200x200') && strpos($img,'100x100'))
	{
		
		$img = str_replace("100x100","200x200",$img);
		
	}if(!strpos($img,'200x200') && strpos($img,'700x700'))
	{
		
		$img = str_replace("700x700","200x200",$img);
		
	}
}
	return $img;
}
function get_img2( $img ) {
//print_r($img);exit;
if(strpos($img,',') || strpos($img,';'))
{
	if(strpos($img,','))
	{
		$img = explode(",",$img);
	}else if(strpos($img,';')){
		$img = explode(";",$img);
	}
	$img = (!empty($img[0])?$img[0]:(!empty($img[5])?$img[5]:""));
	//echo $img;exit;
	if(!strpos($img,'400x400') && strpos($img,'40x40'))
	{
		$img = str_replace("40x40","400x400",$img);
		
	}if(!strpos($img,'400x400') && strpos($img,'75x75'))
	{
		$img = str_replace("75x75","400x400",$img);
		
	}
	if(!strpos($img,'400x400') && strpos($img,'275x275'))
	{
		$img = str_replace("275x275","400x400",$img);
		
	}
	if(!strpos($img,'400x400') && strpos($img,'125x125'))
	{
		$img = str_replace("125x125","400x400",$img);
		
	}if(!strpos($img,'400x400') && strpos($img,'100x100'))
	{		
		$img = str_replace("100x100","400x400",$img);
		
	}if(!strpos($img,'400x400') && strpos($img,'125x167'))
	{		
		$img = str_replace("125x167","400x400",$img);
		
	}
}
	return $img;
}
function is_file_exists($filePath)
{
      return is_file($filePath) && file_exists($filePath);
}

?>