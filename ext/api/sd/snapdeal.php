<?php
	include('conn.php');
	ini_set( "max_execution_time",-1 );

	$cats = simplexml_load_file("category.xml");

	// echo "<PRE>";
	$categories = $cats->apiGroups->entry->value->listingsAvailable->entry;

	$c_count = get_categories();
	// print_r( $cats->apiGroups->entry->value->listingsAvailable );
	$i = 0;

	foreach( $categories as $cat )
	{
		if( $i <= $c_count )
		{
			$i++;
			continue;
		}

		$next_url = (string)$cat->value->listingVersions->entry->value->get;

		$count = 0;

		while( !empty( $next_url ) )
		{
			$result = get_product_by_cat_curl( $next_url );

			if( isset( $result->nextUrl ) && !empty( $result->nextUrl ) )
			{
				$next_url = $result->nextUrl;
			}
			else
			{
				$next_url = "";
			}

			add_new_fk_products( $result->products );

			unset( $result );
		}
	}

	echo "Product Upload Done..";
	
	function get_product_by_cat_curl( $url )
	{
		$ch = curl_init( $url );   
                                                                 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/xml',                                                                                
			'Snapdeal-Affiliate-Id: 19215',
			'Snapdeal-Token-Id: 2d003b05eb3d6b337444e7b365d9a1')                                                                      
		);

		$result = curl_exec($ch);
		return json_decode( $result );
		// print_r( json_decode( $result ) );exit;
	}

	function add_new_fk_products( $products = array() )
	{
		if( !empty( $products ) )
		{
			foreach( $products as $product )
			{
				if( is_exists( $product->id ) )
				{
					if( $product->availability != "in stock" )
						$in_stock = 0;
					else
						$in_stock = 1;

					$product->title 			= str_replace("'", "\'", $product->title );
					$product->description 		= str_replace("'", "\'", $product->description );
					$product->categoryName 		= str_replace("'", "\'", $product->categoryName );
					$product->subCategoryName 	= str_replace("'", "\'", $product->subCategoryName );
					$product->brand 			= str_replace("'", "\'", $product->brand );

					$sql = "INSERT INTO gc_stage_snapdeal SET 	product_url 	= '".urlencode( $product->link )."',
																product_id 		= '".$product->id."',
																name 			= '".$product->title."',
																description 	= '".$product->description."',
																image_url 		= '".$product->imageLink."',
																mrp 			= ".$product->mrp.",
																price 			= ".$product->effectivePrice.",
																categories 		= '".$product->categoryName."',
																subCategory 	= '".$product->subCategoryName."',
																productBrand 	= '".$product->brand."',
																in_stock 		= ".$in_stock;
					mysql_query($sql) or die($sql);
					// echo $sql;exit;
				}
			}
		}
		else
		{
			return false;
		}
	}

	function is_exists( $product_id )
	{
		$sql = "select * from  gc_stage_snapdeal where product_id like '$product_id' ";

		$res = mysql_query($sql) or die(mysql_error());

		if( mysql_num_rows($res) == 0 )
		{
			return true;
		}

		return false;
	}

	function get_categories()
	{
		$sql = "SELECT DISTINCT(categories) as cat from  gc_stage_snapdeal";

		$res = mysql_query($sql) or die(mysql_error());

		$count = mysql_num_rows($res);

		if( !isset( $count ) || empty( $count )  )
		{
			return 0;
		}
		else
		{
			return $count - 1;
		}
	}
?>