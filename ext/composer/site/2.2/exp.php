<?php 

require_once("config.php");

$get = json_decode($_REQUEST['query']);

//print_r($get);exit;

$cat 		= "";
$group 		= "";
$group_alt 	= "";
$sort 		= "";
$productInfo 		= isset($get->query)?urldecode(strtolower($get->query)):"";

$cat_id	 			= isset($get->category_id)?$get->category_id:"";

$cat	 			= isset($get->cat)?strtolower($get->cat):"";

$group				= strtolower(isset($get->group)?strtolower($get->group):"");

$vendor				= isset($get->vendor)?$get->vendor:"";

$brand				= isset($get->brand)?strtolower($get->brand):"";

$brand_min_doc_count= isset($get->brand_min_doc_count)?$get->brand_min_doc_count:10;

$brand_size			= isset($get->brand_size)?$get->brand_size:0;

$size				= isset($get->size)?$get->size:30;
$from				= isset($get->from)?$get->from:0;
$saleprice_min		= isset($get->saleprice_min)?$get->saleprice_min:"";
$saleprice_max		= isset($get->saleprice_max)?$get->saleprice_max:"";
$order_by			= isset($get->order_by)?strtolower($get->order_by):"";
$sort_order			= isset($get->sort_order)?strtolower($get->sort_order):"";
$session_id			= isset($get->session_id)?$get->session_id:time();
$track_stock		= isset($get->track_stock)?$get->track_stock:1;


$camera				= isset($get->Camera)?($get->Camera):"";
$storage			= isset($get->storage)?($get->storage):"";
$ram				= isset($get->RAM)?($get->RAM):"";
$processor			= isset($get->processor)?($get->processor):"";
$screen_size		= isset($get->screen_size)?($get->screen_size):"";
$os					= isset($get->OS)?($get->OS):"";
$os_version			= isset($get->OS_version)?($get->OS_version):"";
$front_camera		= isset($get->front_camera)?($get->front_camera):"";
$battery			= isset($get->battery)?($get->battery):"";
$type				= isset($get->type)?($get->type):"";
$sim_type			= isset($get->SIM_type)?($get->sim_type):"";
$color				= isset($get->Color)?($get->Color):"";
$storage_type		= isset($get->storage_type)?($get->storage_type):"";






/************Small Fixes************/

if($group == 'all') {$group='';}

if($order_by=='null')

	$order_by = '';

if($sort_order=='null')

	$sort_order = '';



if(!empty($productInfo ))

{

	$productInfo = str_replace("/","-",$productInfo);

	$productInfo = str_replace(" AND ","",$productInfo);

	$productInfo = str_replace("AND ","",$productInfo);

	$productInfo = str_replace(" and ","",$productInfo);

	$productInfo = str_replace("and ","",$productInfo);

	$productInfo = str_replace(" OR ","",$productInfo);

	$productInfo = str_replace(" or ","",$productInfo);

}

/************Small Fixes************/





if(isset($order_by) && !empty($order_by))

{

	$sort = array(

		$order_by => array ('order' => $sort_order )

	);

}

$must =array();
$filter_applied = array();
$should =array();

/*************Search Query*******************/
$srchShould="";
if(!empty($productInfo))
{
	//$must[] = array('match' => array('name' => $productInfo));		

	//$srchShould[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'and')));		

	//$must[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'and')));	
	$srchShould[] = array('match' => array('name' => array('query' => $productInfo,'operator' => 'or','boost' => '2')));
	$srchShould[] = array('match' => array('category' => array('query' => $productInfo,'operator' => 'and','boost' => '2')));
	$srchShould[] = array('match' => array('tags' => array('query' => $productInfo,'operator' => 'and','boost' => '5')));
}

/*************Category*******************/

$catShould = "";

if(strpos($cat,','))
{	

	$cat = explode(",",$cat);	
	
	for($i=0;$i< count($cat);$i++)
	{

		$catShould[] = array('match' => array('category' => $cat[$i]));		

	}	

	

}else if(!empty($cat)){

	$must[] = array('match' => array('category' => $cat));	

}

$cat_idShould = "";

if(strpos($cat_id,','))
{	

	$cat_id = explode(",",$cat_id);	

	for($i=0;$i< count($cat_id);$i++)

	{

		$cat_idShould[] = array('match' => array('category_id' => $cat_id[$i]));		

	}	

	

}else if(!empty($cat_id)){

	$must[] = array('match' => array('category_id' => $cat_id));	

}

/*************Group*******************/

$grpShould="";

if(strpos($group,','))
{	

	$group = explode(",",$group);	

	

	for($i=0;$i< count($group);$i++)

	{

		$grpShould[] = array('match' => array('grp' => $group[$i]));		

	}	

}else if(!empty($group)){

	$must[] = array('match' => array('grp' => $group));		

}

/********************************************************Using POST-Filter**********************************/	 
/*************Price Range*******************/

if(!empty($saleprice_min) && !empty($saleprice_max))
{
	$filter_applied[] = "saleprice_min";
	$filter_applied[] = "saleprice_max";
	$range = array(
		'saleprice' => 	array ('gte' => $saleprice_min,'lte' => $saleprice_max )
	);	
	//$range_agg = array("range" =>'saleprice' =>array ('gte' => $saleprice_min,'lte' => $saleprice_max ))
}else if(!empty($saleprice_min)){
	$filter_applied[] = "saleprice_min";
	$range = array(
		'saleprice' => 	array ('gte' => $saleprice_min)
	);	
}else if(!empty($saleprice_max)){
	$filter_applied[] = "saleprice_max";
	$range = array(
		'saleprice' => 	array ('lte' => $saleprice_max)
	);	
}

/*************Brand*******************/


if(strpos($brand,','))
{
	$brand = explode(",",$brand);
	$filter_applied[] = "brand";
	for($i=0;$i< count($brand);$i++)
	{
		$brand_must[] = array('match' => array('brand' => $brand[$i]));
		$agg_filter['brand_agg'][] = array("term" =>array( "brand" => $brand[$i]));
	}
}else if(!empty($brand)){	
	$filter_applied[] = "brand";
	$brand_must = array('match' => array('brand' => $brand));	
	$agg_filter['brand_agg'] = (array("term" =>array( "brand" => $brand ))) ;
}





/*************Vendor*******************/

$vendShould = "";
if(strpos($vendor,','))
{
	$vendor = explode(",",$vendor);
	$filter_applied[] = "vendor";
	for($i=0;$i< count($vendor);$i++)
	{
		$vendor_must[] = array('match' => array('vendor' => $vendor[$i]));
		$agg_filter['vendor_agg'][] = array("term" =>array( "vendor" => $vendor[$i]));
	}
}else if(!empty($vendor)){
	$filter_applied[] = "vendor";
	$vendor_must = array('match' => array('vendor' => $vendor));	
	$agg_filter['vendor_agg'] = (array("term" =>array( "vendor" => $vendor)));
}



/*************Camera*******************/
if(strpos($camera,','))
{
	$camera = explode(",",$camera);
	$filter_applied[] = "camera";
	for($i=0;$i< count($camera);$i++)
	{
		$camera_must[] = array('match' => array('camera' => $camera[$i]));
		$agg_filter['camera_agg'] = (array("term" =>array( "camera" => $camera[$i] ))) ;
	}
}else if(!empty($camera)){	
	$filter_applied[] = "camera";
	$camera_must = array('match' => array('camera' => $camera));	
	$agg_filter['camera_agg'] = (array("term" =>array( "camera" => $camera ))) ;
}

/*************storage*******************/
if(strpos($storage,','))
{
	$storage = explode(",",$storage);
	$filter_applied[] = "storage";
	for($i=0;$i< count($storage);$i++)
	{
		$storage_must[] = array('match' => array('storage' => $storage[$i]));
		$agg_filter['storage_agg'] = (array("term" =>array( "storage" => $storage[$i] ))) ;
	}
}else if(!empty($storage)){	
	$filter_applied[] = "storage";
	$storage_must = array('match' => array('storage' => $storage));	
	$agg_filter['storage_agg'] = (array("term" =>array( "storage" => $storage ))) ;
}
/*************ram*******************/
if(strpos($ram,','))
{
	$ram = explode(",",$ram);
	$filter_applied[] = "ram";
	for($i=0;$i< count($ram);$i++)
	{
		$ram_must[] = array('match' => array('ram' => $ram[$i]));
		$agg_filter['ram_agg'] = (array("term" =>array( "ram" => $ram[$i] ))) ;
	}
}else if(!empty($ram)){	
	$filter_applied[] = "ram";
	$ram_must = array('match' => array('ram' => $ram));	
	$agg_filter['ram_agg'] = (array("term" =>array( "ram" => $ram ))) ;
}
/*************processor*******************/
if(strpos($processor,','))
{
	$processor = explode(",",$processor);
	$filter_applied[] = "processor";
	for($i=0;$i< count($processor);$i++)
	{
		$processor_must[] = array('match' => array('processor' => $processor[$i]));
		$agg_filter['processor_agg'] = (array("term" =>array( "processor" => $processor[$i] ))) ;
	}
}else if(!empty($processor)){	
	$filter_applied[] = "processor";
	$processor_must = array('match' => array('processor' => $processor));	
	$agg_filter['processor_agg'] = (array("term" =>array( "processor" => $processor ))) ;
}
/*************screen_size*******************/
if(strpos($screen_size,','))
{
	$screen_size = explode(",",$screen_size);
	$filter_applied[] = "screen_size";
	for($i=0;$i< count($screen_size);$i++)
	{
		$screen_size_must[] = array('match' => array('screen_size' => $screen_size[$i]));
		$agg_filter['screen_size_agg'] = (array("term" =>array( "screen_size" => $screen_size[$i] ))) ;
	}
}else if(!empty($screen_size)){	
	$screen_size_must = array('match' => array('screen_size' => $screen_size));	
	$filter_applied[] = "screen_size";
	$agg_filter['screen_size_agg'] = (array("term" =>array( "screen_size" => $screen_size ))) ;
}
/*************os*******************/
if(strpos($os,','))
{
	$os = explode(",",$os);
	$filter_applied[] = "os";
	for($i=0;$i< count($os);$i++)
	{
		$os_must[] = array('match' => array('os' => $os[$i]));
		$agg_filter['os_agg'] = (array("term" =>array( "os" => $os[$i] ))) ;
	}
}else if(!empty($os)){	
	$filter_applied[] = "os";
	$os_must = array('match' => array('os' => $os));	
	$agg_filter['os_agg'] = (array("term" =>array( "os" => $os ))) ;
}
/*************os_version*******************/
if(strpos($os_version,','))
{
	$os_version = explode(",",$os_version);
	$filter_applied[] = "os_version";
	for($i=0;$i< count($os_version);$i++)
	{
		$os_version_must[] = array('match' => array('os_version' => $os_version[$i]));
		$agg_filter['os_version_agg'] = (array("term" =>array( "os_version" => $os_version[$i] ))) ;
	}
}else if(!empty($os_version)){	
	$filter_applied[] = "os_version";
	$os_version_must = array('match' => array('os_version' => $os_version));	
	$agg_filter['os_version_agg'] = (array("term" =>array( "os_version" => $os_version ))) ;
}
/*************front_camera*******************/
if(strpos($front_camera,','))
{
	$front_camera = explode(",",$front_camera);
	$filter_applied[] = "front_camera";
	for($i=0;$i< count($front_camera);$i++)
	{
		$front_camera_must[] = array('match' => array('front_camera' => $front_camera[$i]));
		$agg_filter['front_camera_agg'] = (array("term" =>array( "front_camera" => $front_camera[$i] ))) ;
	}
}else if(!empty($front_camera)){	
	$filter_applied[] = "front_camera";
	$front_camera_must = array('match' => array('front_camera' => $front_camera));	
	$agg_filter['front_camera_agg'] = (array("term" =>array( "front_camera" => $front_camera ))) ;
}
/*************battery*******************/
if(strpos($battery,','))
{
	$battery = explode(",",$battery);
	$filter_applied[] = "battery";
	for($i=0;$i< count($battery);$i++)
	{
		$battery_must[] = array('match' => array('battery' => $battery[$i]));
		$agg_filter['battery_agg'] = (array("term" =>array( "battery" => $battery[$i] ))) ;
	}
}else if(!empty($battery)){
	$filter_applied[] = "battery";
	$battery_must = array('match' => array('battery' => $battery));	
	$agg_filter['battery_agg'] = (array("term" =>array( "battery" => $battery ))) ;
}
/*************type*******************/
if(strpos($type,','))
{
	$type = explode(",",$type);
	$filter_applied[] = "type";
	for($i=0;$i< count($type);$i++)
	{
		$type_must[] = array('match' => array('type' => $type[$i]));
		$agg_filter['type_agg'] = (array("term" =>array( "type" => $type[$i] ))) ;
	}
}else if(!empty($type)){	
	$filter_applied[] = "type";
	$type_must = array('match' => array('type' => $type));	
	$agg_filter['type_agg'] = (array("term" =>array( "type" => $type ))) ;
}
/*************sim_type*******************/
if(strpos($sim_type,','))
{
	$sim_type = explode(",",$sim_type);
	$filter_applied[] = "sim_type";
	for($i=0;$i< count($sim_type);$i++)
	{
		$sim_type_must[] = array('match' => array('sim_type' => $sim_type[$i]));
		$agg_filter['sim_type_agg'] = (array("term" =>array( "sim_type" => $sim_type[$i] ))) ;
	}
}else if(!empty($sim_type)){	
	$filter_applied[] = "sim_type";
	$sim_type_must = array('match' => array('sim_type' => $sim_type));	
	$agg_filter['sim_type_agg'] = (array("term" =>array( "sim_type" => $sim_type ))) ;
}

/*************color*******************/
if(strpos($color,','))
{
	$color = explode(",",$color);
	$filter_applied[] = "color";
	for($i=0;$i< count($color);$i++)
	{
		$color_must[] = array('match' => array('color' => $color[$i]));
		$agg_filter['color_agg'] = (array("term" =>array( "color" => $color[$i] ))) ;
	}
}else if(!empty($color)){	
	$filter_applied[] = "color";
	$color_must = array('match' => array('color' => $color));	
	$agg_filter['color_agg'] = (array("term" =>array( "color" => $color ))) ;
}

/*************storage_type*******************/
if(strpos($storage_type,','))
{
	$storage_type = explode(",",$storage_type);
	$filter_applied[] = "storage_type";
	for($i=0;$i< count($storage_type);$i++)
	{
		$storage_type_must[] = array('match' => array('storage_type' => $storage_type[$i]));
		$agg_filter['storage_type_agg'] = (array("term" =>array( "storage_type" => $storage_type[$i] ))) ;
	}
}else if(!empty($storage_type)){	
	$filter_applied[] = "storage_type";
	$storage_type_must = array('match' => array('storage_type' => $storage_type));	
	$agg_filter['storage_type_agg'] = (array("term" =>array( "storage_type" => $storage_type ))) ;
}
/*************graphics*******************/
if(strpos($graphics,','))
{
	$graphics = explode(",",$graphics);
	$filter_applied[] = "graphics";
	for($i=0;$i< count($graphics);$i++)
	{
		$graphics_must[] = array('match' => array('graphics' => $graphics[$i]));
		$agg_filter['storage_type_agg'] = (array("term" =>array( "graphics" => $graphics[$i] ))) ;
	}
}else if(!empty($graphics)){	
	$filter_applied[] = "graphics";
	$graphics_must = array('match' => array('graphics' => $graphics));	
	$agg_filter['graphics_agg'] = (array("term" =>array( "graphics" => $graphics ))) ;
}
































/********************************************************Using POST-Filter**********************************/	 

/*************Sort*******************/

$search = array();
$search['index'] = "shopping";
//$search['from']  = $data['from'];
$search['body'] = array(
	'size' => $size,
	'from' => $from,	
	'query' => array(
		'function_score' => array(
			'query' => array(
				'bool' => array(
					'minimum_should_match'=>'75%'
				)
			)
		)
	),
	'aggs' => array(
		'saleprice_min' => array(
			'min' => array(
				'field' => 'saleprice'
			)
		),
		'saleprice_max' => array(
			'max' => array(
				'field' => 'saleprice'
			)
		),

		'grp' => array(
			'terms' => array(
				'field' => 'grp',
				'size'	=>	0
				//'min_doc_count' => 2
			),
			'aggs' => array(
				'category_id' => array(
					'terms' => array(
						'field' => 'category_id',
						'size'	=>	0
						//'min_doc_count' => 2
					),
					'aggs' => array(
						'category' => array(
							'terms' => array(
								'field' => 'category',
								'size'	=>	0
							)
						)
					)
				)
			)
		)
		
	)
);

if($cat_id == 351)	//Mobile
{
	$search['index'] = "shopping";
	$laptops = array(
		'RAM' => array(
			'terms' => array(
				'field' => 'ram',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")				
			)
		),
		/*'ram_range' => array(
			'range' => array(
				'field' => 'ram',
				"ranges" : [
                    { "to" : 1  },
                    { "from" : 50, "to" : 100 },
                    { "from" : 100 }
                ]				
			)
		),*/
		'storage' => array(
			'terms' => array(
				'field' => 'storage',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")				
			)
		),
		'processor' => array(
			'terms' => array(
				'field' => 'processor',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")				
			)
		),
		'screen_size' => array(
			'terms' => array(
				'field' => 'screen_size',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")			
			)
		),
		'Camera' => array(
			'terms' => array(
				'field' => 'camera',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")		
			)
		),
		'OS' => array(
			'terms' => array(
				'field' => 'os',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")				
			)
		),
		'OS_version' => array(
			'terms' => array(
				'field' => 'os_version',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")				
			)
		),
		'front_camera' => array(
			'terms' => array(
				'field' => 'front_camera',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")				
			)
		),
		/*'screen_resolution' => array(
			'terms' => array(
				'field' => 'screen_resolution',
				'size'	=>	0				
			)
		),*/
		'battery' => array(
			'terms' => array(
				'field' => 'battery',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")				
			)
		),
		'type' => array(
			'terms' => array(
				'field' => 'type',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")			
			)
		),
		'SIM_type' => array(
			'terms' => array(
				'field' => 'sim_type',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")
			)
		)
	);
	$search['body']['aggs'] = array_merge($search['body']['aggs'],$laptops);
}
if($cat_id == 379)	//laptop
{
	$search['index'] = "shopping";
	$laptops = array(
		'RAM' => array(
			'terms' => array(
				'field' => 'ram',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")					
			)
		),
		'storage' => array(
			'terms' => array(
				'field' => 'storage',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")	
			)
		),
		'processor' => array(
			'terms' => array(
				'field' => 'processor',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")	
			)
		),
		'screen_size' => array(
			'terms' => array(
				'field' => 'screen_size',
				'size'	=>	0				
			)
		),
		'storage_type' => array(
			'terms' => array(
				'field' => 'storage_type',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")	
			)
		),
		'OS' => array(
			'terms' => array(
				'field' => 'os',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")	
			)
		),
		'Camera' => array(
			'terms' => array(
				'field' => 'camera',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")	
			)
		),
		'Color' => array(
			'terms' => array(
				'field' => 'color',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")	
			)
		),'battery' => array(
			'terms' => array(
				'field' => 'battery',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")				
			)
		),'graphics' => array(
			'terms' => array(
				'field' => 'graphics',
				'size'	=>	0,				
				'order'	=>	array('_term'=>"asc")				
			)
		)
	);
	$search['body']['aggs'] = array_merge($search['body']['aggs'],$laptops);
}




$search['body']['aggs']['vendor'] =	array(
	'terms' => array(
		'field' => 'vendor',
		'size' => 0
	)
);

$search['body']['aggs']['brand'] =	array( 
	'terms' => array(
		'field' => 'brand',
		'min_doc_count' => $brand_min_doc_count,
		'size' => $brand_size,
		
		'order' => array(
			'_term' => "asc"
		)
	)		
);

if(!empty($agg_filter))			//Adding filter for aggregation, as we're using Post-Filter
{
	if(count($agg_filter) > 1)	//If more than one filter is there
	{
		$fill = array();
		foreach($agg_filter as $key=>$value)
		{			
			if(count($value)>1)
			{
				$fill[] = array( "or" => $value);
			}else{
				$fill[] = $value;
			}
		}
		$filters['filter'] =	array(
			//"filters" => array("filters" => $fill)			
			"filter" => array("and" => $fill)			
		);
	
	}else{		//If single filter is applied
		foreach($agg_filter as $key=>$value)
		{			
			if(count($value) > 1)
			{
				$filters['filter'] =	array(
					"filter" => array( "or" => $value)
				);
			}else{
				$filters['filter'] = array(
					"filter" => $value
				);
			}
		}
	
	}
}
if(!empty($range))
{	
	$filters['filter'] =	array(
		   "filter" => array( "range" => $range)
	);	
}

$post_filter_aggs = array(		//Merge it with filter aggregation
	"aggs" => array(
		"brand" => array(
		  "terms" => array( "field" => "brand" ) 
		),
		"vendor" => array(
		  "terms" => array( "field" => "vendor" ) 
		),
		"saleprice_min" => array(
		  "min" => array( "field" => "saleprice" ) 
		),
		"saleprice_max" => array(
		  "max" => array( "field" => "saleprice" ) 
		)
	)	
);	
if($cat_id == 351)	//Mobile
{
	$post_filter_aggs_mob = array(		//Merge it with filter aggregation
		"aggs" => array(			
			"camera" => array(
			  "terms" => array( "field" => "camera" ) 
			),
			"storage" => array(
			  "terms" => array( "field" => "storage" ) 
			),
			"ram" => array(
			  "terms" => array( "field" => "ram" ) 
			),
			"processor" => array(
			  "terms" => array( "field" => "processor" ) 
			),
			"screen_size" => array(
			  "terms" => array( "field" => "screen_size" ) 
			),
			"os" => array(
			  "terms" => array( "field" => "os" ) 
			),
			"os_version" => array(
			  "terms" => array( "field" => "os_version" ) 
			),
			"front_camera" => array(
			  "terms" => array( "field" => "front_camera" ) 
			),
			"battery" => array(
			  "terms" => array( "field" => "battery" ) 
			),
			"type" => array(
			  "terms" => array( "field" => "type" ) 
			),
			"sim_type" => array(
			  "terms" => array( "field" => "sim_type" ) 
			)
		)	
	);
	$post_filter_aggs['aggs'] = array_merge($post_filter_aggs['aggs'],$post_filter_aggs_mob['aggs']);
}

if($cat_id == 379)	//Laptop
{
	$post_filter_aggs_mob = array(		//Merge it with filter aggregation
		"aggs" => array(			
			"camera" => array(
			  "terms" => array( "field" => "camera" ) 
			),
			"storage" => array(
			  "terms" => array( "field" => "storage" ) 
			),
			"ram" => array(
			  "terms" => array( "field" => "ram" ) 
			),
			"processor" => array(
			  "terms" => array( "field" => "processor" ) 
			),
			"screen_size" => array(
			  "terms" => array( "field" => "screen_size" ) 
			),
			"os" => array(
			  "terms" => array( "field" => "os" ) 
			),
			"storage_type" => array(
			  "terms" => array( "field" => "storage_type" ) 
			),
			"battery" => array(
			  "terms" => array( "field" => "battery" ) 
			),
			"graphics" => array(
			  "terms" => array( "field" => "graphics" ) 
			),
			"color" => array(
			  "terms" => array( "field" => "color" ) 
			)
		)	
	);
	$post_filter_aggs['aggs'] = array_merge($post_filter_aggs['aggs'],$post_filter_aggs_mob['aggs']);
}

//print_r($post_filter_aggs);
//Merging post_filter_aggs with filter aggregation
if(!empty($filters['filter']))
{
	//$search['body']['aggs']['filter_vendor'] = array_merge($search['body']['aggs']['filter_vendor'],$post_filter_aggs);
	$search['body']['aggs']['filters_all'] = array_merge($filters['filter'],$post_filter_aggs);
}





$must[] = array('match' => array('track_stock' => $track_stock));
$must[] = array('range' => array('saleprice' => array('gte' => 10)));

$search['body']['query']['function_score']['query']['bool']['must'] = $must;

if(!empty($catShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $catShould;

if(!empty($cat_idShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $cat_idShould;

if(!empty($grpShould))
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $grpShould;

if(!empty($srchShould))	
	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $srchShould;	

if(!empty($brand_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $brand_must;

if(!empty($vendor_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $vendor_must;
if(!empty($range))
	$search['body']['post_filter']['bool']['must'][]['bool']['should']['range'] = $range;


if(!empty($ram_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $ram_must;
if(!empty($os_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $os_must;
if(!empty($storage_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $storage_must;
if(!empty($camera_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $camera_must;
if(!empty($processor_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $processor_must;
if(!empty($screen_size_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $screen_size_must;
if(!empty($os_version_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $os_version_must;
if(!empty($front_camera_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $front_camera_must;
if(!empty($battery_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $battery_must;
if(!empty($type_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $type_must;
if(!empty($sim_type_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $sim_type_must;
if(!empty($storage_type_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $storage_type_must;
if(!empty($color_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $color_must;
if(!empty($graphics_must))		
	$search['body']['post_filter']['bool']['must'][]['bool']['should'] = $graphics_must;

	

if(!empty($sort))
{
	$search['body']['sort'] = $sort;
}


if(!empty($productInfo))
{

$functions = array(array('filter'=> array('match' => array('category_id' => 351)),'weight' => 4));

//$functions = array(array('filter'=> array('match' => array('vendor' => 0)),'weight' => 2));
$search['body']['query']['function_score']['functions'] = $functions;
$search['body']['query']['function_score']['max_boost'] = 8;
$search['body']['query']['function_score']['score_mode'] = 'max';
$search['body']['query']['function_score']['boost_mode'] = 'multiply';
$search['body']['query']['function_score']['min_score'] = 0.4;

}else{
	$search['body']['query']['function_score']['random_score']['seed'] = $session_id;
}

/*if(!empty($vendShould))

	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $vendShould;

if(!empty($brandShould))

	$search['body']['query']['function_score']['query']['bool']['must'][]['bool']['should'] = $brandShould;*/



if(isset($_REQUEST['pre']))
{
echo "<pre>";print_r(json_encode($search));
}

$result = $client->search($search);
$arr = array('return_txt' => $result,'filter_applied'=>$filter_applied);
if(isset($_REQUEST['pre']))
{
	print_r($arr);exit;
}


echo json_encode($arr);





?>	