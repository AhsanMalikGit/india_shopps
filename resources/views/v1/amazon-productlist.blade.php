<?php
  $cur_url = Request::url();
  if( empty( $c_name ) )
   $c_name = "";
?>
@if ( !isset($ajax) )
   @extends('v1.layouts.master')
   @section('meta')
      <meta name="news_keywords" content="amazon great india sale, amazon india sale, amazon prime, internet, sale, shopping sale"/>
      <meta name="taboola:title" content="Amazon Great India Sale Starts August 8; Prime Members Will Get Early Access to Deals"/>
      <link rel="canonical" href="{{Request::URL()}}"/>
      <meta name="description" content="Amazon India has announced that its Great India Sale will take place from August 8-10 and will give an early-access to its Prime members."/>
      <?php if( $book ):?>
         <link rel="alternate" href="android-app://com.indiashopps.android/indiashopps/store--c--<?=$scat?>--576" />
      <?php else: ?>
         <link rel="alternate" href="android-app://com.indiashopps.android/indiashopps/store--c--<?=$scat?>" />
      <?php endif; ?>
   @endsection
   @section('content')
   <div class="container-fliud">
       <div class="amazon_slider">
         <a href="http://www.amazon.in/Great-Indian-Sale/b?ie=UTF8&node=5731634031" target="_blank">
            <img class="img-responsive" src="http://www.indiashopps.com/images/v1/amazon_slider.jpg" alt="" />
         </a>
      </div>
   </div>
   <!--==============All product=============-->	
   <div class="container">
   	<div class="row" style="margin-top:10px;">
   		<div class="col-sm-4 col-md-3 hidden-xs">
   			@include('v1.common.amazon_filter', ['aggr' => $facets ] )
   		</div>
           <!-------------------right------------------------>			
           <div class="col-md-9 col-sm-8 col-xs-12" id="right-container"style="min-height: 709px;">
           	<!-----------------right category---------------------->
            {!! Breadcrumbs::render() !!}
            <div class="moredata">
               <p></p>
            </div>
            <div class="great_indian_sale block_product">
               <div class="title_block">
               <h3>Great Indian Sale</h3>
                  <div class="navi">
                     <a class="prevtab">
                        <i class="fa fa-angle-left"></i>
                     </a>
                     <a class="nexttab">
                        <i class="fa fa-angle-right"></i>
                     </a>
                  </div>
               </div>
               <div class="block_content">
                  <div class="row_edited">
                     <div class="great_deals slider_product">
                     <!---------item 1-------->
                     <?php $i = 0;?>
                     @foreach( $product as $key => $single )
                     <?php $pro = $single->_source; 
                        if(json_decode($pro->image_url) != NULL)
                         {
                            $img = json_decode($pro->image_url);
                         }else{
                            $img = $pro->image_url;
                         }
                         if(is_array($img))
                            $img = $img[0];
                         
                         $img = getImageNew($img,'S');
                     ?>
                        <div class="item_out">
                           <div class="item">
                              <div class="home_tab_img">
                                 <a class="product_img_link" href="{{$pro->product_url}}" target="_blank">
                                    <img src="{{$img}}" alt="{{$pro->name}} image" class="img-responsive product-item-img" />
                                 </a>
                              </div>
                              <div class="home_tab_info">
                                 <a class="product-name" href="{{$pro->product_url}}" target="_blank">
                                    {{$pro->name}}
                                 </a>
                                 <div class="row">
                                    @if( !empty( $pro->price ) )
                                    <div class="col-md-6  btn-product">
                                       <del>Rs. {{number_format($pro->price)}}</del>
                                    </div>
                                    @endif
                                    <div class="col-md-6  btn-product">
                                       <a href="{{$pro->product_url}}" target="_blank">Rs. {{number_format($pro->saleprice)}}</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php unset( $product[$key] ); ?>
                     <?php
                        if( $i++ >= 11 )
                        {
                           break;
                        }
                     ?>
                     @endforeach
                     </div>
                  </div>
               </div>
            </div>
            <div class="clearfix"></div>
            <!-----------------Product 1---------------------->
            <h1 class="great_deals_heading">Great Indian Sale</h1>
            <div class="hidden-xs hidden-sm">
               <div id="appliedFilter"></div>
            </div>
            <hr>
            <div class="row" id="product_wrapper" style="min-height: 150px; margin-top: 10px;">
            <!-----------------Product 1---------------------->
   @endif
            @include('v1.common.products-amazon', [ 'product' => $product, 'book' => @$book ] )
   @if ( !isset($ajax) )
           	</div>
           </div>
       </div>
   </div>
   @endsection
   @section('script')
   <script type="text/javascript">
      var load_image = "<?=newUrl('images/loading.gif')?>"; // This variable will be used by ProductList.js file
      var sort_by = "<?=@$sort?>"; // This variable will be used by ProductList.js file 
      var product_wrapper = $( "#product_wrapper" ); // This variable will be used by ProductList.js file
      var pro_min = <?=($minPrice)? $minPrice: 0 ?>; // This variable will be used by ProductList.js file 
      var pro_max = <?=($maxPrice)? $maxPrice: 0?>; // This variable will be used by ProductList.js file
      $( document ).ready(function(){
         $(document).on("mouseenter",".product-items",function(){
            $(this).addClass("hovered");
         });
         $(document).on("mouseleave",".product-items",function(){
            $(this).removeClass("hovered");
         });

         $('[data-countdown]').each(function() {
           var $this = $(this), finalDate = $(this).data('countdown');
           $this.countdown(finalDate, function(event) {
             $this.html(event.strftime('%D days %H:%M:%S'));
           });
         });

         $(document).ajaxStop(function(){
            setTimeout(function(){ 
               $('[data-countdown]').each(function() {
                 var $this = $(this), finalDate = $(this).data('countdown');
                 $this.countdown(finalDate, function(event) {
                   $this.html(event.strftime('%D days %H:%M:%S'));
                 });
               });
            },1000)
         });

         var great_deals = $(".great_deals");
           great_deals.owlCarousel({
               items: 4,
               itemsDesktop: [1199, 4],
               itemsDesktopSmall: [991, 3],
               itemsTablet: [767, 2],
               itemsMobile: [480, 1],
               autoPlay: true,
               stopOnHover: false,
               addClassActive: true,
            });

           // Custom Navigation Events
         $(".great_indian_sale .nexttab").click(function() {
               great_deals.trigger('owl.next');
            })
           $(".great_indian_sale .prevtab").click(function() {
                great_deals.trigger('owl.prev');
           })
      })
   </script>
   <link rel="stylesheet" type="text/css" href="<?=newUrl('css/jquery-ui.css')?>" />
   <script type="text/javascript" src="<?=newUrl('js/jquery.lazyload.min.js')?>"></script>
   <script type="text/javascript" src="<?=newUrl('js/jquery-ui-1.10.3.slider.js')?>"></script>
   <script type="text/javascript" src="<?=newUrl('js/v1/productlist.js')?>"></script>
   <script type="text/javascript" src="<?=newUrl('js/v1/jquery.countdown.min.js')?>"></script>
   <script>

      <?php if( count( $product ) == 0 ):?>
         ListingPage.model.vars.auto_load  = false;
      <?php else: ?>
         ListingPage.model.vars.auto_load  = true;
      <?php endif; ?>
   </script>
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
   .product-items{ position: relative;  }
   .product-items .show-more{ opacity: 0; position: absolute; top: 90%; margin-top: 0px; }
   .hovered .show-more {
     z-index: 9;
     background: #fff;
     left: -1px;
     opacity: 1;
     margin-top: -4px;
     width: 100.4%;
     border: 1px solid #dddddd;
     border-top: none;
     padding: 10px;
     -moz-transition: opacity .2s ease-in-out;
   -o-transition: opacity .2s ease-in-out;
   -webkit-transition: opacity .2s ease-in-out;
   transition: opacity .2s ease-in-out;
     top: 101%!important;
   }
   .product-items:hover
   {
   -webkit-box-shadow: 0px -4px 23px -10px rgba(215, 13, 0, 0.37);
   -moz-box-shadow: 0px -4px 23px -10px rgba(215, 13, 0, 0.37);
   box-shadow: 0px -4px 23px -10px rgba(215, 13, 0, 0.37);
   }
   .product-item:hover
   {
   -webkit-box-shadow: 0px 0px 23px -10px rgba(215, 13, 0, 0.37);
   -moz-box-shadow: 0px 0px 23px -10px rgba(215, 13, 0, 0.37);
   box-shadow: 0px 0px 23px -10px rgba(215, 13, 0, 0.37);
   }
   .hovered .show-more
   {
   -webkit-box-shadow: 0px 13px 23px -10px rgba(215, 13, 0, 0.37);
   -moz-box-shadow: 0px 13px 23px -10px rgba(215, 13, 0, 0.37);
   box-shadow: 0px 13px 23px -10px rgba(215, 13, 0, 0.37);
   }
   .great_deals_heading{color: #d70d00;
    font-size: 17px;}
   
   .product-items {
    height: 350px;
   }
   .deals_time_end {
    background: #d70d00 none repeat scroll 0 0;
    bottom: 0;
    color: #fff;
    font-size: 14px;
    left: 0;
    margin-top: 10px;
    padding: 10px;
    position: absolute;
    width: 100%;}
   </style>
   @endsection
@endif