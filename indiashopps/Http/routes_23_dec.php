<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');

Route::get('/amazon-great-indian-sale/{page?}', [ 'as' => 'amazon-sale', 'uses' => 'ListingController@amazonSale' ]);
Route::get('/flipkart-the-freedom-sale/{page?}', [ 'as' => 'amazon-sale', 'uses' => 'ListingController@flipkartSale' ]);
Route::get('/flipkart-big-billion-day-sale/{page?}', [ 'as' => 'bbillion-sale', 'uses' => 'ListingController@bbillionSale' ]);
Route::get('/amazon-great-indian-festival-sale/{page?}', [ 'as' => 'amazon-festival-sale', 'uses' => 'ListingController@amazonfestivalSale' ]);
Route::get('/get-the-real-deal', [ 'as' => 'amazon-festival-sale', 'uses' => 'ScrapeController@real_time_deal' ]);
Route::post('/get-the-real-deal', [ 'as' => 'amazon-festival-sale', 'uses' => 'ScrapeController@real_time_deal' ]);
/***************************************************SNIPPET*******************************************************************/
Route::get('/{brand}-shoes-for-{group}/{page?}', [ 'as' => 'sports_shoes', 'uses' => 'ListingController@brandwise_sports_shoes_for' ]);
/***************************************************SNIPPET*******************************************************************//***************************************************SNIPPET*******************************************************************/
Route::get('/mobile/smartphones/{page?}', [ 'as' => 'smartphone', 'uses' => 'ListingController@smartphone' ]);
Route::get('/mobile/dual-sim-phones/{page?}', [ 'as' => 'dual_sim', 'uses' => 'ListingController@dual_sim' ]);
Route::get('/mobile/android-phones/{page?}', [ 'as' => 'android_phones', 'uses' => 'ListingController@android_phones' ]);
Route::get('/mobile/windows-phones/{page?}', [ 'as' => 'windows_phones', 'uses' => 'ListingController@windows_phones' ]);
/***************************************************SNIPPET*******************************************************************/
Route::get('/scrape-it', ['uses' => 'ScrapeController@scrape']);



Route::get('/loghotdeal', 'RedirectController@loghotdeal1');
Route::get('/', [ 'as' => 'home', 'uses' => 'HomeController@index' ]); //HomePage Route

Route::any('/user/register', [ 'as' => 'register', 'uses' => 'LoginController@register' ]); //Registration
Route::any('/user/login', [ 'as' => 'login', 'uses' => 'LoginController@login' ]); //User Login Route
Route::any('/myaccount', [ 'as' => 'myaccount', 'uses' => 'LoginController@myaccount' ]); //User Account
Route::get('/user/logout', [ 'as' => 'logout', 'uses' => 'LoginController@logout' ]); // User Logout
Route::any('/user/resetPassword', [ 'as' => 'reset', 'uses' => 'LoginController@resetPassword' ]); // Password reset

Route::get('instagram', [ 'as' => 'instagram', 'uses' => 'HomeController@instagram' ]); // instagram Page
Route::get('about-us', [ 'as' => 'about', 'uses' => 'HomeController@about' ]); // About Us Page
Route::get('career', [ 'as' => 'career', 'uses' => 'HomeController@career'] ); // Career Page.
Route::get('contact-us', [ 'as' => 'contact', 'uses' => 'HomeController@contact'] ); // Contact Us Page.
Route::post('contact-us', [ 'as' => 'contact', 'uses' => 'HomeController@contact'] ); // Contact US post page.
Route::get('/thankyou.html', [ 'as' => 'thankyou', 'uses' => 'ExtensionController@thankyou' ] ); //Extn thank you page
Route::post('/thankyou.html', [ 'as' => 'thankyou', 'uses' => 'ExtensionController@thankyou' ] ); // Extn Thank you page submitting the values.
Route::get('/coupons', [ 'as' => 'coupons', 'uses' => 'CouponController@index']); // Coupon index page.
Route::get( '/slogin/process', "ExtensionController@processAuth" ); // Social Login/Registration process request page
Route::get( '/slogin/{provider}', "ExtensionController@login" ); // Social Login/Registration Page
Route::get('/coupons/{vendor}-coupons.html/{page?}', [ 'as' => 'couponlist', 'uses' => 'CouponController@couponlist' ] ); // Coupon Lising by Vendor..

Route::get('mobiles/{brand}/best-phones-under-rs-{price}.html/{page?}', [ 'as' => 'bbphones', 'uses' => 'ListingController@bBrandPhones' ] ); // Mobile phone listing by Max price & Brand wise filter

Route::get('mobiles/best-mobile-phones-between-{minprice}-{maxprice}-india.html/{page?}', [ 'as' => 'bbetphones', 'uses' => 'ListingController@bbetPhones' ] ); // Mobile phone listing by Min & Max price filter

Route::get('mobiles/best-phones-under-rs-{price}.html/{page?}', [ 'as' => 'bestphones', 'uses' => 'ListingController@bestPhones' ] ); // Mobile phone listing by Max price filter


Route::get('coupons/discount/{category}/{page?}', [ 'as' => 'couponcat', 'uses' => 'CouponController@couponlistcategory' ] ); // Coupon Listing by Category 
Route::get('coupon/couponlistdetail', [ 'as' => 'coupondetail', 'uses' => 'CouponController@couponlistdetail' ] ); // Coupon Detail page old ..
Route::get('coupon/{name}/{promo}', [ 'as' => 'coupondetail', 'uses' => 'CouponController@couponlistdetail' ] ); // Coupon detail page new. 
Route::post('coupon/{name}/{promo}', [ 'as' => 'coupondetail', 'uses' => 'CouponController@couponlistdetail' ] );// Coupon Report POST request
Route::get('coupon/filter/{page?}', 'CouponController@filter'); // Coupon Filter Ajax request..
Route::get('search/{page?}/{order_by?}/{sort_order?}', [ 'as' => 'search', 'uses' => 'ListingController@searchList' ] )->where(array('page'=>'[0-9]+')); // Product search page and controller.

Route::get('couponsearch/{page?}/{order_by?}/{sort_order?}', [ 'as' => 'c_search', 'uses' => 'CouponController@couponsearch' ])->where(array('page'=>'[0-9]+')); // Coupon Search Page.

Route::get('products-list/{brand}/{cat}/{order_by?}/{sort_order?}/{page?}', 'ProductController@list_products')->where(array('page'=>'[0-9]+')); // Product Listing by brand and category.... this is not used by still there to avoid 404 requests.

Route::get('ajaxContent/{section}', 'HomeController@ajaxContent'); // GET request for Ajax request on home page
Route::get('products/vendor/{vendorid}/{page?}', 'ProductController@productList'); // ProductList old.. 
Route::get('compare-products', [ 'as' => 'compare-products', 'uses' => 'CompareController@index' ] ); // Compare products
Route::get('most-compared-mobiles.html', [ 'as' => 'most-compared', 'uses' => 'CompareController@mostCompared' ] ); // Most Compared mobiles route
Route::get('compare-mobiles/{mobile1?}/{mobile2?}', [ 'as' => 'compare-mobiles', 'uses' => 'CompareController@compareMobile' ]); // Compare two mobiles with their product ID
Route::get('redirect', 'RedirectController@send' ); // redirect controller to send out the link on other websites
Route::get('product/detail/{name}/{id}', 'ProductController@product_detail_old' ); //Product detail page non comparitive
Route::get('product/{name}/{id}-{vendor}', 'ProductController@product_detail' ); //Product detail page non comparitive
Route::get('product/{name}/{id}', 'ProductController@product_detail_new' ); // Product detail page comparitive, mobiles etc
Route::get('product/detail1/{name}/{id}', 'ProductController@product_detail_red' ); // Product detail page comparitive, mobiles etc

Route::get('{parent}/{category}.html/{page?}', [ 'as' => 'sub_category', 'uses' => 'ListingController@subCategoryList'] )->where(array('page'=>'[0-9]+')); // Product Listing page 2nd level...


Route::get('{parent}/{category}/{page?}', [ 'as' => 'sub_category', 'uses' => 'ListingController@subCategoryList' ] )->where(array('page'=>'[0-9]+')); // Product Listing page 2nd level..used to redirect link to .html link 

Route::get('{parent}/pricelist/{category}.html/{page?}',['as' =>'product_list','uses'=>'ListingController@error_404']); // 404 

// seoEnable is defined in config/app.php
if( !config('app.seoEnable') )
{
    Route::get('{parent}/{child}/{category}/{page?}', [ 'as' => 'product_list', 'uses' => 'ListingController@categoryList' ] )->where(array('page'=>'[0-9]+')); // Product Listing page 3rd level
    
}
else
{
    Route::get('{parent}/{child}/{category}.html/{page?}',['as' =>'product_list','uses'=>'ListingController@categoryList']); // Product Listing page 3rd level.
    Route::get('{parent}/{child}/{category}/{page?}', [ 'as' => 'product_list', 'uses'=>'ListingController@categoryList' ]); // Product Listing page 3rd level..used to redirect link to .html link 
}

Route::get('/livesearch', 'HomeController@livesearch'); // AutoSuggest json file 
Route::get('/couponImage', 'CouponController@resizeCouponImages'); // Storing dealz image on indiashopps server

Route::get('/pimages', 'ImageController@index'); // Storing image to local server from remote server with different image sizes...

Route::get('log', 'RedirectController@log'); // Logging controller to get the trending products. 
Route::get('hot-trending-products', [ 'as' => 'trending', 'uses' => 'ProductController@trending' ] ); // Trending Products..
Route::get('/all-categories', [ 'as' => 'all-cat', 'uses' => 'ProductController@categories' ] ); // List of all categories.. 
Route::get('/create_sitemap', 'ProductController@sitemap'); // Generate Sitemap with categories and products.
Route::get('{name}', ['as' => 'category', 'uses' => 'ProductController@category']); //Category page.. 
Route::get('500', function()
{
    abort(500);
});
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController'
]);
/*Event::listen('illuminate.query', function($query)
{    
    print_r($query);echo "<br>";
});*/
/*Route::filter('www',  function () {
    //Add the 'www.' to all requests
  $request=app('request');
  $host=$request->header('host');
  if (substr($host, 0, 4) != 'www.') {
    $request->headers->set('host', 'www.'.$host);
    return Redirect::to($request->path());
  }
});

Route::group(['before' => 'www'], function () {
  get('/', 'HomeController@index');
    // other routes here ...
});*/