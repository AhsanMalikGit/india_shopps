<?php namespace indiashopps\Http\Controllers;

use DB;
use indiashopps\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Cookie\CookieJar;
use indiashopps\Helpers\Helper;
use Jenssegers\Agent\Agent as Agent;
use indiashopps\Logs;

class ListingController extends Controller {

	/**
	* PRODUCT LISTING Page.... for Comparitive and Non-comparitive categories..
	*
	* @var \Illuminate\Http\Request
	* @var Parent Category Name
	* @var Middle Category Name
	* @var Child Category Name
	* @var Page Number
	*/

	public function productList( Request $request, $parent = false, $cname = false, $child =false, $page=0 )
	{
		//Create a unique token from the current user session to send the UNIQUE ID to solr for consistance product listing.. 
		//print_r($parent);echo "<br>cname - ";print_r($cname);echo "<br>child - ";print_r($child);exit;

		$token 		= $request->session()->get('_token');
		$session_id = preg_replace("/[^0-9,.]/", '', $token );
		$parent_id 	= false; // Parent ID is made false for the search page, so that it doesn't redirect.. 
		$cat 		= false;

/**********************Redirects SEO Purpose****************************************/
		if( $parent == 'home' )
		{			
			return redirect(url('home-decor/'.$cname));
		}
		if($cname == 'sports-shoe-price-list-in-india')
		{
			return redirect(url($parent.'/shoes/sports-shoes-price-list-in-india.html'));
		}
		else if($cname == 'led-price-list-in-india')
		{
			return redirect(url($parent.'/lcd-led-tvs/led-tv-price-list-in-india.html'));
		}
		else if($cname == 'plasma-price-list-in-india')
		{
			return redirect(url($parent.'/lcd-led-tvs/led-tv-price-list-in-india.html'));
		}
		else if($cname == 'lcd-price-list-in-india')
		{
			return redirect(url($parent.'/lcd-led-tvs/led-tv-price-list-in-india.html'));
		}
		else if($cname == 'security-systems-price-list-in-india')
		{
			return redirect(url($parent.'/security-system-gadgets-price-list-in-india.html'));
		}
		else if($cname == 'mobile-chargers-price-list-in-india')
		{
			return redirect(url($parent.'/mobile-accessories/chargers-price-list-in-india.html'));
		}
		else if($cname == 'mobile-battery-price-list-in-india')
		{
			return redirect(url($parent.'/mobile-accessories/battery-price-list-in-india.html'));
		}
		else if($cname == 'smart-watches-price-list-in-india' and $parent == "mobile")
		{
			return redirect(url('electronics/smart-wearable/smart-watches-price-list-in-india.html'));
		}
		else if($cname == 'smart-bands-price-list-in-india' and $parent == "mobile")
		{
			return redirect(url('electronics/smart-wearable/smart-bands-price-list-in-india.html'));
		}
		else if($cname == 'networking-price-list-in-india' and $parent == "computers")
		{
			return redirect(url('computers/networking-devices-price-list-in-india.html'));
		}
		else if($cname == 'gear-price-list-in-india' and $parent == "kids")
		{
			return redirect(url('kids/baby-gear-price-list-in-india.html'));
		}
		else if($cname == 'accessories-price-list-in-india' and $parent == "kids")
		{
			return redirect(url('kids/kid-accessories-price-list-in-india.html'));
		}
		else if($cname == 'sports-price-list-in-india' and $parent == "sports-fitness")
		{
			return redirect(url('sports-fitness/sports-products-goods-price-list-in-india.html'));
		}

		if($child == "networking" and $parent == "computers")
		{
			return redirect(url($parent.'/networking-devices/'.$cname.".html"));
		}
		elseif($child == "gear" and $parent == "kids")
		{
			return redirect(url($parent.'/baby-gear/'.$cname.".html"));
		}
		elseif($child == "accessories" and $parent == "kids")
		{
			return redirect(url($parent.'/kid-accessories/'.$cname.".html"));
		}
		elseif($child == "sports" and $parent == "sports-fitness")
		{
			return redirect(url($parent.'/sports-products-goods/'.$cname.".html"));
		}

/**********************Redirects SEO Purpose****************************************/
		if( $parent == 'product' || $parent == 'coupon'  || $parent == 'cdn-cgi'  || $parent == 'category' )
		{		
			abort(404);
		}
		//Checks whether SEO URL is enabled or not and redirect according to the listing page.
		if( config('app.seoEnable') && $parent )
		{
			$cname = explode( config('app.seoURL'), $cname);

			if( !isset( $cname[1] ) )
			{
				return redirect('/'.$parent."/".$cname[0].config('app.seoURL').".html" );
			}
			else
			{
				$cname = $cname[0];
			}
		}
		else
		{
			$cname = explode( config('app.seoURL'), $cname);

			if( isset( $cname[1] ) )
			{
				return redirect('/'.$parent."/".$cname[0] );
			}

			$cname = $cname[0];
		}
		$data['parent'] = $parent;
		$data['child'] = $child;
		//print_r($parent);echo "<br>cname - ";print_r($cname);echo "<br>child - ";print_r($child);exit;
		
		/// GET the category IDs with CATEGORY Name ( Third Level Categories )
		if( $parent && $child && $cname )
		{
			$parent_id 	= $this->getCatIDByName( $parent );
			$child_id 	= $this->getCatIDByName( $child, $parent_id );
			$cat 		= $this->getCatIDByName( $cname, $child_id );
		}
		/// GET the category IDs with CATEGORY Name ( Second Level Categories )
		elseif( $parent && $cname )
		{
			$parent_id 	= $this->getCatIDByName( $parent );
			$cat 		= $this->getCatIDByName( $cname, $parent_id );
		}
		$data['isSearch']   = true;
		if(in_array($cat,config('vendor.comparitive_category')))
		{
			$data['isSearch']   = false;
		}

		/// GET the category IDs if BRAND name is provided with the CATEGORY Name..
		if( empty( $cat ) && $parent_id )
		{
			$cname 	= str_replace("---","--",$cname );
			$parts 	= explode("--",$cname );
			if($parts[0] == "smartphone")
			{
				$data['type'] = "Smartphone";
			}elseif($parts[0] == "dual-sim-phones")
			{
				$data['SIM_type'] = "Dual";
			}elseif($parts[0] == "android_phones")
			{
				$data['OS'] = "Android";
			}elseif($parts[0] == "windows_phones")
			{
				$data['OS'] = "Windows";
			}elseif( !$request->has('ajax') )
			{				
				$brand 	= str_replace("-"," ",$parts[0]);	
			}
			//echo $brand;exit;
			unset($parts[0]);
			$part = implode("-",$parts);
			if($part == "mobile-battery")
			{
				return redirect(url($parent.'/mobile-accessories/'.$brand.'--battery-price-list-in-india.html'));
			}elseif($part == "mobile-chargers")
			{
				return redirect(url($parent.'/mobile-accessories/'.$brand.'--chargers-price-list-in-india.html'));
			}elseif($part == 'sports-shoe')
			{
				return redirect(url($parent.'/shoes/'.$brand.'--sports-shoes-price-list-in-india.html'));
			}else if($part == 'smart-watches' and $parent == "mobile")
			{
				return redirect(url('electronics/smart-wearable/'.$brand.'--smart-watches-price-list-in-india.html'));
			}else if($part == 'smart-bands' and $parent == "mobile")
			{
				return redirect(url('electronics/smart-wearable/'.$brand.'--smart-bands-price-list-in-india.html'));
			}
			if( !empty( $child_id ) )
				$cat 	= $this->getCatIDByName($part , $child_id );
			else
				$cat 	= $this->getCatIDByName( $part, $parent_id );
		}
		//echo $parent_id.":$child_id:".$cat;exit;
		if( ( $parent_id || isset($child_id) ) && empty( $cat ) )
		{	
			abort(404);
		}
		if(isset($cat))
		{			
			$list_desc 		= DB::table('gc_cat')->where('id',$cat)->select('meta','seo_title')->first();
			//dd($list_desc);
			if(!empty( $list_desc->meta))
				$data['list_desc'] = json_decode($list_desc->meta);
			//echo "<pre>";print_r($data);exit;
			if(isset($data['list_desc']->description) && !empty($data['list_desc']->description) )
				$data['description'] = $data['list_desc']->description;
			if(!empty( $list_desc->seo_title))
				$data['title'] = $list_desc->seo_title;
			
		}
		
		//Adds all the FILTER FIELDS to an ARRAY to be send to SOLR query..
		if( $request->has('price_filter') || $request->has('ajax') )
		{ 
			$data['isSearch']   = true;
			foreach( $request->all() as $field => $value )
			{
				$data[$field] = $value;
			}
		}

		// Search Page Query fields.. 
		if( $request->has('search_text') )
		{
			$data['query'] 	    			= urlencode($request->input('search_text'));
			if( $request->has('group') )
				$data['group'] 	    		= ($request->input('group'));	
			if( $request->has('parent_category') )		
				$data['parent_category'] 	= ($request->input('parent_category'));	
			

			//print_r($data);exit;		
		}
		

		if( $request->has('cat_id') )
		{
			$data['category_id'] = $request->cat_id;
		}

		if( !empty( $session_id ) && is_numeric( $session_id ) )
		{
			$data['session_id'] = $session_id;
		}
		 //dd($cat);
		//Create the Category Chain and send it to view for nested Categories 
		if($cat)
		{
			$controller 		= new ProductController;
			$cats 				= $controller->createChain($cat);		
			$data['category_id']= $cats;
			$data['c_name']		= $controller->getCatName( $cats )[0];
		}

		$data['size'] 			= 30;
		$data['page'] 			= $page;
		$data['from'] 			= ($data['size']*$page);

		//If the CATEGORY belong to books, then change the SOLR index... 

		if( $parent == "books" || $request->input('group') == "Books" )
		{
			$searchAPI 			= composer_url( 'books.php' );
			$data['group'] 		= "Books";
		}
		else
		{
			$searchAPI 			= composer_url( 'search.php' );
		}

		//Adding the Sorting parameters for PRODUCT LIST.. 
		if( $request->has('sort') )
		{
			$sort = $request->input('sort');
			$sort = explode("-", $sort );

			if( $sort[0] != "f" && $sort[0] != "d" )
			{
				$field= array( "s" => "saleprice", "d" => "discount" );
				$order= array( "a" => "asc", "d" => "desc" );

				$data['order_by'] 	= $field[$sort[0]];
				$data['sort_order'] = $order[$sort[1]];
			}else if ($sort[0] == "f")
			{
				$data['order_by'] 	= "id";
				$data['sort_order'] = "desc";
			}
		}else if(!$data['isSearch']){ 
			$data['order_by'] 	= "id";
			$data['sort_order'] = "desc";
		}

		if( $request->has('vendor') )
		{
			$data['vendor'] = $request->vendor;
		}
	//echo $data['type'];exit;
		if(!$child && (strpos($cname, 'mobiles')===false) && (strpos($cname, 'tablets')===false) && (strpos($cname, 'laptops')===false))
		{
			$data['brand_min_doc_count'] = 500;
		}
		$data['sort'] 		= $request->input('sort');
		$data['term'] 		= json_encode($data); // Preparing data to be sent to SOLR..

		// GET PRODUCT Data from SOLR..
	//print_r($data);exit;
		// echo $searchAPI.'?query='.urlencode($data['term']);exit;
		$result			 	= file_get_contents($searchAPI.'?query='.urlencode($data['term']));
		//echo "<pre>";print_r($result);exit;
	if(!$request->has('ajax'))
	{
		/*****Snippet Data******/
			$data['order_by'] 		= "id"; 
			$data['sort_order'] 	= "desc"; 
			$data['size'] 			= 10; 
			$data['snippet'] 		= true; 
			$data['brand'] 			= ( isset($brand) ) ? $brand : "";
	//print_r($data);exit;
			$data['term'] 			= json_encode($data);
			//echo $searchAPI.'?query='.urlencode($data['term']);exit;
			$snippet					= file_get_contents($searchAPI.'?query='.urlencode($data['term']));
			if(json_decode($snippet) != NULL)
			{
				$snippet 			= json_decode( $snippet );			
				$data['snippet'] 	= $snippet->return_txt->hits->hits;
				$data['sn_numberOfItems']	= $snippet->return_txt->hits->total;
			}
			
			//echo "<pre>";print_r($snippet);exit;
		/*****Snippet Data******/
	}
		$return 			= json_decode( $result );
		$result 			= $return->return_txt;
		if( $request->has('description') || $request->has('title') )
		{
			$data['description'] = $request->input('description');
			$data['title'] = $request->input('title');
		}
		// Pre-defined price filter for price comparition in below funcitons.. bBrandPhone, bbetPhones, bestPhone..
		if( $request->has('price_filter') && isset( $result->aggregations->filters_all ) && !$request->has('ajax') )
		{
			unset( $result->aggregations->filters_all->doc_count );
			$data['facets'] 	= $result->aggregations->filters_all;
		}
		else
		{
			$data['facets'] 	= $result->aggregations;
		}

		//Sending Product data to VIEWS.....
		$data['product'] 	= $result->hits->hits;
		$data['minPrice'] 	= $result->aggregations->saleprice_min->value;
		$data['maxPrice'] 	= $result->aggregations->saleprice_max->value;
		$data['scat'] 		= $cat;
		
		if( @$data['group'] != "Books" )
		{
			$facet['group']		= $result->aggregations->grp->buckets;
			$data['book'] 		= false;
		}
		else
		{
			$data['book'] 		= true;
			$data['isSearch'] = false;
		}
		if( $data['isSearch'] && !$request->has('cat_id') )
		{
			
			$data['facets']->categories = $result->aggregations->grp->buckets;
		}
		else
		{
			$data['facets']->categories = "";
		}
		
		
		//Preparing AJAX response once filter is applied.... JSON Response
		if( $request->has('filter') && $request->input( 'filter' ) == "true" )
		{
			
			$json['products'] = (string)view("v1.productlist",$data);
			$json['products'] = preg_replace( '/(\v)+/', '', $json['products'] );
			$json['products'] = str_replace("\t", "", $json['products']);
			$json['facet'] = $result->aggregations;
			
			if( isset( $return->filter_applied ) )
			{
				$json['facet']->filter_applied = $return->filter_applied;
			}
			echo json_encode( $json );
		}
		else
		{
			// echo "<pre>";print_r($data);exit;
			// Render the product listing page.. 
			return view("v1.productlist",$data);
		}
	}

	/**
	* Custom Snippets.. 
	*
	* @var \Illuminate\Http\Request
	* @var Page Number
	*/
	public function brandwise_sports_shoes_for( Request $request, $brand =false,$group=false,$page=0 )
	{
		switch($brand)
		{
			case 'nike':
				# code...
				if($group == 'men')
				{
					$title = "Nike Shoes For Men";
				$description = "When it comes to sneakers and sportswear shoes there is only one name that resounds in everyone's mind. NIKE.
The brand has become synonymous with sportswear. Especially with youth of India embracing the NIKE brand since its launch in India several years back.
Earlier the brand was premium but now with increasing income and online shopping at fast pace. Now users search for free coupons like Amazon coupons or Flipkart coupons which they eventually use for buying Nike Shoes. Nike brand especially Nike Shoes are no more considered a premium. Nike Sports Shoes have become into necessity for everyday user. Top 10 Nike Sports Shoes for Men or Women will definitely be in the Best selling shoes across India. Nike is known for comfort and quality of its products. ";
				}elseif($group == 'women')
				{
					$title = "Nike Shoes For Women";
				$description = "Urban women have embraced into fitness regime more than anyone. Nike has encashed the same with lot many launches across the board. Right from sports shoes for women to sports wear. All ranges from Nike are available in most of the sizes keeping in mind the Indian body type. These days the launches are happening for online shopping more frequently. Top 10 Nike Shoes for Women will also be the Best 10 Sports Shoes for Women and are the most selling shoes across any Sports Shoe brand.";
				}
			break;
			case 'adidas':
				if($group == 'men')
				{
					$title = "Adidas Shoes For Men";
				$description = "Adidas has created a brand for itself in last few years. Its in the top 2 sportswear brand across India. Adidas with its good online shopping strategy have created a niche for them. The consumer becomes loyalists for Adidas which further drives sales growth. Top 10 Adidas Sports Shoes for Men are the ones which they have launched globally. Best 10 Adidas Sports shoes for Men compete in a big way across other know brands.";
				}elseif($group == 'women')
				{
					$title = "Adidas Shoes For Women";
				$description = "When it comes to a premium sportswear brand for women and girls Adidas score right on the top. Adidas have launched a huge line of products aiming for Indian Women and Girls. The products are both into premium and normal ranges. With Olympic medals being won by girls , there is a renewed push amongst girls to be fit via adopting sports. Adidas come right handy by passing the message across. Top 10 Adidas Sports Shoes for Women do come from the premium category. Best 10 Adidas Sports Shoes for Women and Girls also compete fairly well with other big brands.";
				}
			break;
		}
		
		if(isset($description) && isset($title))
		{
			$request->request->add(['description' => $description,'title'=>$title]);
		}else{
			$title = ucwords($brand)." Shoes For ".ucwords($group);
			$request->request->add(['title'=>$title]);
		}	
		return $this->productList( $request,$group, $brand."--sports-shoes-price-list-in-india", "shoes", $page);
	}
	/**
	* Custom Links
	*
	* @var \Illuminate\Http\Request
	* @var Page Number
	*/
	public function smartphone( Request $request, $page=0 )
	{
		if(isset($description) && isset($title))
		{
			$request->request->add(['description' => $description,'title'=>$title]);
		}else{
			$title = "SmartPhone";
			$request->request->add(['title'=>$title]);
		}		
		return $this->productList( $request,"mobile", "smartphone--mobiles-price-list-in-india", false, $page);
	}
	/**
	* Custom Links
	*
	* @var \Illuminate\Http\Request
	* @var Page Number
	*/
	public function dual_sim( Request $request, $page=0 )
	{
		if(isset($description) && isset($title))
		{
			$request->request->add(['description' => $description,'title'=>$title]);
		}else{
			$title = "Dual SIM Phones";
			$request->request->add(['title'=>$title]);
		}		
		return $this->productList( $request,"mobile", "dual-sim-phones--mobiles-price-list-in-india", false, $page);
	}/**
	* Custom Links
	*
	* @var \Illuminate\Http\Request
	* @var Page Number
	*/
	public function android_phones( Request $request, $page=0 )
	{
		if(isset($description) && isset($title))
		{
			$request->request->add(['description' => $description,'title'=>$title]);
		}else{
			$title = "Android Phones";
			$request->request->add(['title'=>$title]);
		}		
		return $this->productList( $request,"mobile", "android_phones--mobiles-price-list-in-india", false, $page);
	}/**
	* Custom Links
	*
	* @var \Illuminate\Http\Request
	* @var Page Number
	*/
	public function windows_phones( Request $request, $page=0 )
	{
		if(isset($description) && isset($title))
		{
			$request->request->add(['description' => $description,'title'=>$title]);
		}else{
			$title = "Windows Phones";
			$request->request->add(['title'=>$title]);
		}		
		return $this->productList( $request,"mobile", "windows_phones--mobiles-price-list-in-india", false, $page);
	}
/**
	* Flipkart big billionSale Page.. 
	*
	* @var \Illuminate\Http\Request
	* @var Page Number
	*/
	public function bbillionSale( Request $request, $page = 0 )
	{
		$data['title'] = "Flipkart | The Big Billion Day Sale is back. Itne mein Itnaa.";
		
		return view("v1.sale.bbillion-sale",$data);
	}
	/**
	* Amazon The Great Indian Festival Sale Page.. 
	*
	* @var \Illuminate\Http\Request
	* @var Page Number
	*/
	public function amazonfestivalSale( Request $request, $page = 0 )
	{
		$data['title'] = "Amazon | The Great Indian Festival Sale";
		
		return view("v1.sale.amazonfestival-sale",$data);
	}
/**
	* Flipkart Sale Page.. 
	*
	* @var \Illuminate\Http\Request
	* @var Page Number
	*/
	public function flipkartSale( Request $request, $page = 0 )
	{
		$data['title'] = "Flipkart Freedom Sale | Great offers and Extra 10% Discount Via HDFC Credit & Debit Cards on all the shopping offers at IndiaShopps.com";
		
		return view("v1.flipkart-sale",$data);
	}

	/**
	* Amazon The Great Indian Sale Page.. 
	*
	* @var \Illuminate\Http\Request
	* @var Page Number
	*/
	public function amazonSale( Request $request, $page = 0 )
	{
		$token 		= $request->session()->get('_token');
		$session_id = preg_replace("/[^0-9,.]/", '', $token );
		$cat = false;

		if( $request->has('autojs') || $request->has('ajax') )
		{
			foreach( $request->all() as $field => $value )
			{
				$data[$field] = $value;
			}
		}

		$data['isSearch']   = false;

		if( !empty( $session_id ) && is_numeric( $session_id ) )
		{
			$data['session_id'] = $session_id;
		}

		$data['size'] 			= 30;
		$data['from'] 			= ($data['size']*$page);
		$data['category_id'] 	= 351;
		$searchAPI 				= composer_url( 'amz_sale.php' );

		$data['term'] 		= json_encode($data);
		$result			 	= file_get_contents($searchAPI.'?query='.urlencode($data['term']));
		$return 			= json_decode( $result );
		$result 			= $return->return_txt;

		$data['facets'] 	= $result->aggregations;
		$data['product'] 	= $result->hits->hits;
		$data['minPrice'] 	= $result->aggregations->saleprice_min->value;
		$data['maxPrice'] 	= $result->aggregations->saleprice_max->value;
		$data['scat'] 		= $cat;
		$data['brand'] 		= "";
		$data['book'] 		= false;

		$data['facets']->categories = "";
		
		$data['isSearch']   = true;
		// dd($result);
		if( $request->has('filter') && $request->input( 'filter' ) == "true" )
		{
			
			$json['products'] = (string)view("v1.amazon-productlist",$data);
			$json['products'] = preg_replace( '/(\v)+/', '', $json['products'] );
			$json['products'] = str_replace("\t", "", $json['products']);
			$json['facet'] = $result->aggregations;
			
			if( isset( $return->filter_applied ) )
			{
				$json['facet']->filter_applied = $return->filter_applied;
			}

			echo json_encode( $json );
		}
		else
		{
			return view("v1.amazon-productlist",$data);
		}
	}

	/**
	* CategoryWise ProductLisint Page for Two Level Category Lisint.. 
	*
	* @var \Illuminate\Http\Request
	* @var Parent Category
	* @var 2nd Level Category
	* @var Page Number
	*/
	public function subCategoryList( Request $request, $parent = false, $cname = false, $page=0 )
	{
		//print_r($parent);print_r($cname);exit;
		return $this->productList( $request, $parent, $cname, false, $page );
	}

	/**
	* CategoryWise ProductListing Page for 3rd Level Category Listing.. 
	*
	* @var \Illuminate\Http\Request
	* @var Parent Category
	* @var 2nd Level Category
	* @var 3rd Level Category
	* @var Page Number
	*/
	public function categoryList( Request $request, $parent = false, $child =false, $cname = false, $page=0 )
	{
		return $this->productList( $request, $parent, $cname, $child, $page );
	}

	/**
	* Search wise Product Listing.. 
	*
	* @var \Illuminate\Http\Request
	* @var Page Number
	*/
	public function searchList( Request $request, $page=0 )
	{
		if( $request->has('search_text') )
		{
			if(config('app.searchLogEnable'))
			{
				/*Logging search text to table*/
				DB::table('gc_search')->insert(
				    ['term' => $request->input('search_text')]
				);
				/*Logging search text to table*/
			}
			return $this->productList( $request, false, false, false, $page );
		}
		else
		{
			abort(404);
		}
		
	}	
	/**
	* Mobile phone listing Under a given Price & Brand.. 
	*
	* @var \Illuminate\Http\Request
	* @var Mobile Brand.. 
	* @var Maximum Price.. 
	* @var Page Number
	*/
	public function bBrandPhones( Request $request, $brand, $price = 0, $page = 0 )
	{
		if( empty( $price ) || !is_numeric( $price ) )
		{
			return redirect("/");
		}
		else
		{
			if( !$request->has('saleprice_max') )
			{
				//Add price to Request Object Manually and enabling price filter for Listing Controller.
				$request->request->add([ 'saleprice_max' => $price  ]);
				$request->request->add([ 'saleprice_min' => 0  ]);
				$request->request->add([ 'price_filter' => 1  ]);
			}

			if( $request->has('brand') )
			{
				//Add brand to Request Object Manually.
				$request->request->add([ 'brand' => implode( ",", array( $brand, $request->get('brand') ) )  ]);
			}
			else
			{
				//Add brand to Request Object Manually.
				$request->request->add([ 'brand' => $brand  ]);
			}

			$request->request->add([ 'bbphones' => true  ]);

			// Specifies Parent, and 2nd Level Category name for MOBILES.. 
			return $this->productList( $request, "mobile", "mobiles-price-list-in-india", false, $page );
		}
	}

	/**
	* Mobile phone listing Under given Min & Max Price
	*
	* @var \Illuminate\Http\Request
	* @var Minimum Price.. 
	* @var Maximum Price.. 
	* @var Page Number
	*/
	public function bbetPhones( Request $request, $minprice = 0, $maxprice = 0, $page = 0 )
	{
		
		if( empty( $maxprice ) || !is_numeric( $maxprice ) )
		{
			return redirect("/");
		}
		else
		{
			if( !$request->has('saleprice_max') )
			{
				//Add price to Request Object Manually and enabling price filter for Listing Controller.
				$request->request->add([ 'saleprice_min' => $minprice  ]);
				$request->request->add([ 'saleprice_max' => $maxprice  ]);
				$request->request->add([ 'price_filter' => 1  ]);
			}

			$request->request->add([ 'bbetphones' => true  ]);

			return $this->productList( $request, "mobile", "mobiles-price-list-in-india", false, $page );
		}
	}


	/**
	* Mobile phone listing Under a any given Max Price..  
	*
	* @var \Illuminate\Http\Request
	* @var Maximum Price.. 
	* @var Page Number
	*/
	public function bestPhones( Request $request, $price = 0, $page = 0 )
	{
		if( empty( $price ) || !is_numeric( $price ) )
		{
			return redirect("/");
		}
		else
		{
			if( !$request->has('saleprice_max') )
			{
				//Add price to Request Object Manually and enabling price filter for Listing Controller.
				$request->request->add([ 'saleprice_max' => $price  ]);
				$request->request->add([ 'saleprice_min' => 0  ]);
				$request->request->add([ 'price_filter' => 1  ]);
			}

			$request->request->add([ 'bestphones' => true  ]);

			return $this->productList( $request, "mobile", "mobiles-price-list-in-india", false, $page );
		}
	}

	/**
	* Get category ID by name and Category ID
	*
	* @var Category Name
	* @var Parent Category ID
	*/
	public function getCatIDByName( $cat_name, $parent_id = 0 )
	{
		$cat_name = create_slug($cat_name);

		// DB::enableQueryLog();
		$db = DB::table('gc_cat');

		if( !empty( $parent_id ) )
		{
			$db = $db->where('parent_id',$parent_id);
		}
		else
		{
			$db = $db->where( 'parent_id', 0 );
		}

		$row = $db->where(DB::raw(" create_slug(name) "), $cat_name )->lists('id');
		// echo "<PRE>";
		// print_r(DB::getQueryLog());
		return @$row[0];
	}
	public function getParentIDByName( $cat_name, $level = false, $group=false )
	{
		$cat_name = create_slug($cat_name);

		// DB::enableQueryLog();
		$db = DB::table('gc_cat AS a')->select("b.name AS name");

		if( $level )
		{
			$db = $db->where('a.level',$level);
		}
		if($group)
		{
			$db = $db->where( 'a.group_name','like', $group );
		}
		$db = $db->join('gc_cat AS b', 'a.parent_id', '=', 'b.id');
		$row = $db->where(DB::raw(" create_slug(a.name) "),"like", $cat_name )->get();
		// echo "<PRE>";
		// print_r(DB::getQueryLog());
		return @$row[0];
	}

	/**
	* Create Category Chain.. 
	*
	* @var Category ID
	*/
	function createChain($id, $except = null)
	{	
		$cats 		= array();
		$cc 		= $id.",";
		$result1 	= array();
		$result		= $this->get_categoryParent($id);

		if(count($result)>0)
		{
			foreach($result as $val)
			{			
				$cc.=$val.",";
				$result1[] = $this->createChain($val);
			}
		}

		$imm 	= implode(",",$result1);
		$cc 	= substr($cc,0,-1);	
		
		return $cc;
	}
	function error_404()
	{
		abort(404);
	}

}
