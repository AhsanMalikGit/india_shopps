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
Route::get('/', 'HomeController@index');
// Route::get('about', 'HomeController@about');
Route::get('about-us', [ 'as' => 'about', 'uses' => 'HomeController@about' ]);
Route::get('career', [ 'as' => 'career', 'uses' => 'HomeController@career'] );
Route::get('contact-us', [ 'as' => 'contact', 'uses' => 'HomeController@contact'] );
Route::post('contact-us', 'HomeController@contact');
Route::get('/coupons', [ 'as' => 'coupons', 'uses' => 'CouponController@index']);
Route::get('/coupon/couponlist', [ 'as' => 'couponlist', 'uses' => 'CouponController@couponlist' ] );
Route::get('/coupon/couponlistcategory', [ 'as' => 'couponcat', 'uses' => 'CouponController@couponlistcategory' ] );
Route::get('/coupons/{vendor_name}/{page?}', 'CouponController@couponlistcategory')->where(array('page'=>'[0-9]+'));
Route::get('/coupon/couponlistdetail', [ 'as' => 'coupondetail', 'uses' => 'CouponController@couponlistdetail' ] );
Route::post('/coupon/couponlistdetail', 'CouponController@couponlistdetail');
Route::get('/coupon/filter/{page?}', 'CouponController@filter');
Route::get('search/{page?}/{order_by?}/{sort_order?}', [ 'as' => 'search', 'uses' => 'ProductController@search' ] )->where(array('page'=>'[0-9]+'));
Route::get('couponsearch/{order_by?}/{sort_order?}/{page?}', 'CouponController@couponsearch')->where(array('page'=>'[0-9]+'));
//Route::get('products-list/{brand}/{cat_name}-{cat}/{order_by?}/{sort_order?}/{page?}', 'ProductController@list_products')->where(array('page'=>'[0-9]+'));
Route::get('products-list/{brand}/{cat}/{order_by?}/{sort_order?}/{page?}', 'ProductController@list_products')->where(array('page'=>'[0-9]+'));
Route::get('products/vendor/{vendorid}/{page?}', 'ProductController@productList');
Route::get('compare-products', [ 'as' => 'compare-products', 'uses' => 'CompareController@index' ] );
Route::get('compare-mobiles/{mobile1?}/{mobile2?}', [ 'as' => 'compare-mobiles', 'uses' => 'CompareController@compareMobile' ]);
Route::get('product/detail/{name}/{id}', [ 'as' => 'p_detail', 'uses' => 'ProductController@product_detail' ]);
Route::get('product/{name}/{id}', [ 'as' => 'p_detail_new', 'uses' => 'ProductController@product_detail_new' ] );
Route::get('{parent}/{category}.html/{page?}', [ 'as' => 'about', 'uses' => 'HomeController@about' ]'ProductController@subCategoryList' )->where(array('page'=>'[0-9]+'));
Route::get('{parent}/{category}/{page?}', [ 'as' => 'about', 'uses' => 'HomeController@about' ]'ProductController@subCategoryList' )->where(array('page'=>'[0-9]+'));

if( !config('app.seoEnable') )
{
    Route::get('{parent}/{child}/{category}/{page?}', [ 'as' => 'about', 'uses' => 'HomeController@about' ]'ProductController@productList')->where(array('page'=>'[0-9]+'));
    
}
else
{
    Route::get('{parent}/{child}/{category}.html/{page?}', [ 'as' => 'about', 'uses' => 'HomeController@about' ]'ProductController@productList');
    Route::get('{parent}/{child}/{category}/{page?}', [ 'as' => 'about', 'uses' => 'HomeController@about' ]'ProductController@productList');
}
//Route::get('product/detail1/{name}/{id}', 'ProductController@product_detail_new');
Route::get('log', 'RedirectController@log');
Route::get('hot-trending-products', [ 'as' => 'about', 'uses' => 'HomeController@about' ]'ProductController@trending');
Route::get('productfilter', 'ProductListController@filter');
//Route::get('{parent_name}/{name}', 'ProductListController@list_products');
Route::get('/all-categories', [ 'as' => 'all-cat', 'uses' => 'ProductController@categories' ] );
// Route::get('{parent_name}/pricelist/{name}.html', ['as' => 'mobile-category', 'uses' => 'ProductListController@pricelist_products']);
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