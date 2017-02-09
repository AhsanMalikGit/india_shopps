<?php
  $cur_url = Request::url();
  if( empty( $c_name ) )
   $c_name = "";

?>
@if ( !isset($ajax) )
   @extends('v1.layouts.master')
   @section('meta')
      <meta name="skills" content="Developer" />
      <?php if( $book ):?>
         <link rel="alternate" href="android-app://com.indiashopps.android/indiashopps/store--c--<?=$scat?>--576" />
      <?php else: ?>
         <link rel="alternate" href="android-app://com.indiashopps.android/indiashopps/store--c--<?=$scat?>" />
      <?php endif; ?>
   @endsection
   @section('content')

   <!--==============All product=============-->	
   <div class="container">
   	<div class="row">
   		<div class="col-sm-3 hidden-xs">
   			@include('v1.common.detail_filter', ['aggr' => $facet ] )
   		</div>
           <!-------------------right------------------------>			
           <div class="col-sm-9 col-xs-12" id="right-container">
           	<!-----------------right category---------------------->
            <div class="col-sm-12 col-xs-12 row"><div class="alert alert-success" id="message-div" style="display: none;"></div></div>
            <div class="clearfix"></div>
            {!! Breadcrumbs::render() !!}
            <?php if( $book ):?>
               <?php if( !empty( $product ) ):?>
                  @include('v1.common.books_desc', [ 'book' => $product[0]  ] )
               <?php endif; ?>
            <?php else: ?>
               @include('v1.common.list_desc', ['c_name' => $c_name ] )
            <?php endif; ?>

            @if (count($product) > 0)
           	<div class="hidden-xs hidden-sm ">
           		<div id='product-list-cat-menu'>
           			<ul>
           			<li><h4 class="sort-by">Sort By:</h4></li>
                   <?php $qstr = ( Request::getQueryString() ) ? Request::getQueryString()."&" : "";

                        $qstr = str_replace("&sort=f", "", $qstr);
                        $qstr = str_replace("&sort=s-a", "", $qstr);
                        $qstr = str_replace("&sort=s-d", "", $qstr);
                        $qstr = str_replace("&sort=d-d", "", $qstr);
                   ?>
           			   <li class='<?=( $sort == "f" || $sort == "" ) ? "active" : ""?>'><a href='?<?=$qstr?>sort=f'><h4>Fresh Arrivals</h4></a></li>
           			   <li class='<?=( $sort == "s-a" ) ? "active" : ""?>'><a href='?<?=$qstr?>sort=s-a'><h4>Price Low to High </h4></a></li>
           			   <li class='<?=( $sort == "s-d" ) ? "active" : ""?>'><a href='?<?=$qstr?>sort=s-d'><h4>Price High to Low </h4></a></li>
           			   <li class='<?=( $sort == "d-d" ) ? "active" : ""?>'><a href='?<?=$qstr?>sort=d-d'><h4>Discount</h4></a></li>
           			</ul>
           		</div>
               <div id="appliedFilter"></div>
           	</div>
            @else
                <?php $type = ( @$book ) ? "Book" : "Product"; ?>
                <h3>Sorry!! No <?=$type ?> found!!!</h3>
                <script type="text/javascript">
                  var $no_products = true;
                </script>
            @endif  
           	<!-----------------Product 1---------------------->
           	<div class="row" id="product_wrapper">
   @endif
            @include('v1.common.products', [ 'product' => $product, 'book' => @$book ] )
   @if ( !isset($ajax) )
           	</div>
           </div>
       </div>
   </div>
   @endsection
   @section('script')
   <script type="text/javascript">
      var load_image = "<?=newUrl('images/loading.gif')?>"; // This variable will be used by ProductList.js file
      var sort_by = "<?=$sort?>"; // This variable will be used by ProductList.js file 
      var product_wrapper = $( "#product_wrapper" ); // This variable will be used by ProductList.js file 
      var filter_url = "<?=$cur_url?>"; // This variable will be used by ProductList.js file 
      var pro_min = <?=($facet['minPrice'])? $facet['minPrice']: 0 ?>; // This variable will be used by ProductList.js file 
      var pro_max = <?=($facet['maxPrice'])? $facet['maxPrice']: 0?>; // This variable will be used by ProductList.js file 
   </script>
   <link rel="stylesheet" type="text/css" href="<?=newUrl('/css/jquery-ui.css')?>" />
   <script type="text/javascript" src="<?=newUrl('/js/jquery.lazyload.min.js')?>"></script>
   <script type="text/javascript" src="<?=newUrl('/js/jquery-ui-1.10.3.slider.js')?>"></script>
   <script type="text/javascript" src="<?=newUrl('/js/v1/productlist.js')?>"></script>
   <script type="text/javascript" src="<?=newUrl('/js/compare.js')?>"></script>
   <style type="text/css">
   div#appliedFilter {
      background: #f2f2f2 none repeat scroll 0 0;
      margin-top: 10px;
      width: auto;
   }
   h1{ font-size: 25px; color: #D70D00; }
   .wishlist-icon.wish-added{ color: #D70D00  }
   div#message-div{ margin-top: 10px; width: auto; }
   div#appliedFilter.applied{  padding: 10px; }
   div#appliedFilter div { display: inline; margin-left: 10px; }
   div#appliedFilter div:last-child{ margin-right: 10px;  }
   div#appliedFilter .fltr-label { font-weight: bolder;  }
   div#appliedFilter .clear-all{ cursor: pointer; text-decoration: underline;  }
   div#appliedFilter .single-fltr div:hover{ cursor: pointer; text-decoration: line-through;  }
   div#appliedFilter .fltr-remove{ margin-left:  5px; }
   </style>
   @endsection
@endif