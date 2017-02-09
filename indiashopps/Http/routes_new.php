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
Route::get('/loghotdeal', 'RedirectController@loghotdeal1');
Route::get('/amazon-great-indian-sale/{page?}', [ 'as' => 'amazon-sale', 'uses' => 'ListingController@amazonSale' ]);
Route::get('/', [ 'as' => 'home', 'uses' => 'HomeController@index' ]);
// Route::get('about', 'HomeController@about');
Route::any('/user/register', [ 'as' => 'register', 'uses' => 'LoginController@register' ]);
Route::any('/user/login', [ 'as' => 'login', 'uses' => 'LoginController@login' ]);
Route::any('/myaccount', [ 'as' => 'myaccount', 'uses' => 'LoginController@myaccount' ]);
Route::get('/user/logout', [ 'as' => 'logout', 'uses' => 'LoginController@logout' ]);
Route::any('/user/resetPassword', [ 'as' => 'reset', 'uses' => 'LoginController@resetPassword' ]);
////
Route::get('about-us', [ 'as' => 'about', 'uses' => 'HomeController@about' ]);
Route::get('career', [ 'as' => 'career', 'uses' => 'HomeController@career'] );
Route::get('contact-us', [ 'as' => 'contact', 'uses' => 'HomeController@contact'] );
Route::post('contact-us', [ 'as' => 'contact', 'uses' => 'HomeController@contact'] );
Route::get('/thankyou.html', [ 'as' => 'thankyou', 'uses' => 'ExtensionController@thankyou' ] );
Route::post('/thankyou.html', [ 'as' => 'thankyou', 'uses' => 'ExtensionController@thankyou' ] );
Route::get('/coupons', [ 'as' => 'coupons', 'uses' => 'CouponController@index']);
Route::get( '/slogin/process', "ExtensionController@processAuth" );
Route::get( '/slogin/{provider}', "ExtensionController@login" );
Route::get('/coupons/{vendor}-coupons.html/{page?}', [ 'as' => 'couponlist', 'uses' => 'CouponController@couponlist' ] );

Route::get('mobiles/{brand}/best-phones-under-rs-{price}.html/{page?}', [ 'as' => 'bbphones', 'uses' => 'ProductController@bBrandPhones' ] );

Route::get('mobiles/best-mobile-phones-between-{minprice}-{maxprice}-india.html/{page?}', [ 'as' => 'bbetphones', 'uses' => 'ProductController@bbetPhones' ] );

Route::get('mobiles/best-phones-under-rs-{price}.html/{page?}', [ 'as' => 'bestphones', 'uses' => 'ProductController@bestPhones' ] );


Route::get('/coupons/discount/{category}/{page?}', [ 'as' => 'couponcat', 'uses' => 'CouponController@couponlistcategory' ] );
Route::get('/coupon/couponlistdetail', [ 'as' => 'coupondetail', 'uses' => 'CouponController@couponlistdetail' ] );
Route::get('/coupon/{name}/{promo}', [ 'as' => 'coupondetail', 'uses' => 'CouponController@couponlistdetail' ] );
Route::post('/coupon/{name}/{promo}', [ 'as' => 'coupondetail', 'uses' => 'CouponController@couponlistdetail' ] );
Route::get('/coupon/filter/{page?}', 'CouponController@filter');
Route::get('search/{page?}/{order_by?}/{sort_order?}', [ 'as' => 'search', 'uses' => 'ProductController@search' ] )->where(array('page'=>'[0-9]+'));
Route::get('couponsearch/{page?}/{order_by?}/{sort_order?}', [ 'as' => 'c_search', 'uses' => 'CouponController@couponsearch' ])->where(array('page'=>'[0-9]+'));

Route::get('products-list/{brand}/{cat}/{order_by?}/{sort_order?}/{page?}', 'ProductController@list_products')->where(array('page'=>'[0-9]+'));

Route::get('ajaxContent/{section}', 'HomeController@ajaxContent');
Route::get('products/vendor/{vendorid}/{page?}', 'ProductController@productList');
Route::get('compare-products', [ 'as' => 'compare-products', 'uses' => 'CompareController@index' ] );
Route::get('most-compared-mobiles.html', [ 'as' => 'most-compared', 'uses' => 'CompareController@mostCompared' ] );
Route::get('compare-mobiles/{mobile1?}/{mobile2?}', [ 'as' => 'compare-mobiles', 'uses' => 'CompareController@compareMobile' ]);
Route::get('redirect', 'RedirectController@send' );
Route::get('product/detail/{name}/{id}', 'ProductController@product_detail' );
Route::get('product/{name}/{id}', 'ProductController@product_detail_new' );

Route::get('{parent}/{category}.html/{page?}', [ 'as' => 'sub_category', 'uses' => 'ProductController@subCategoryList'] )->where(array('page'=>'[0-9]+'));


Route::get('{parent}/{category}/{page?}', [ 'as' => 'sub_category', 'uses' => 'ProductController@subCategoryList' ] )->where(array('page'=>'[0-9]+'));

if( !config('app.seoEnable') )
{
    Route::get('{parent}/{child}/{category}/{page?}', [ 'as' => 'product_list', 'uses' => 'ProductController@productList' ] )->where(array('page'=>'[0-9]+'));
    
}
else
{
    Route::get('{parent}/{child}/{category}.html/{page?}',['as' =>'product_list','uses'=>'ProductController@productList']);
    Route::get('{parent}/{child}/{category}/{page?}', [ 'as' => 'product_list', 'uses'=>'ProductController@productList' ]);
}

Route::get('/livesearch', 'HomeController@livesearch');
Route::get('/couponImage', 'CouponController@resizeCouponImages');

Route::get('/pimages', 'ImageController@index');
Route::get('log', 'RedirectController@log');
Route::get('hot-trending-products', [ 'as' => 'trending', 'uses' => 'ProductController@trending' ] );
Route::get('productfilter', 'ProductListController@filter');
Route::get('/all-categories', [ 'as' => 'all-cat', 'uses' => 'ProductController@categories' ] );
Route::get('/create_sitemap', 'ProductController@sitemap');
Route::get('{name}', ['as' => 'category', 'uses' => 'ProductController@category']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController'
]);
Route::get('users', function()
{
    return 'Users!';
});

   Route::get('getdata',function(){

        $term = Input::get('term');

        $data = [
            'R' => 'Red',
            'O' => 'Orange',
            'Y' => 'Yellow',
            'G' => 'Green'

        ];

        $result = [];

        foreach($data as $color) {
            if(strpos(Str::lower($color),$term) !== false) {
                $result[] = ['value' => $color];
            }
        }

        return Response::json($result);

    });