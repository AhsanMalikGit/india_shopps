<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', newUrl('/'));
});

// Home > About
Breadcrumbs::register('about', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('About', newUrl('about'));
});

// Home > About
Breadcrumbs::register('career', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Career', newUrl('career') );
});

Breadcrumbs::register('contact', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Contact Us', newUrl('contact') );
});

Breadcrumbs::register('coupons', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Coupons', newUrl('coupons') );
});

Breadcrumbs::register('search', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Search', newUrl('coupons') );
});

Breadcrumbs::register('thankyou', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Thank You', newUrl('coupons') );
});

Breadcrumbs::register('register', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('New User', newUrl('user/register') );
});

Breadcrumbs::register('login', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Login', newUrl('user/login') );
});

Breadcrumbs::register('myaccount', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('My Account', newUrl('myaccount') );
});

Breadcrumbs::register('reset', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Reset Password', newUrl('user/resetPassword') );
});

Breadcrumbs::register('couponlist', function($breadcrumbs, $vendor )
{
    $breadcrumbs->parent('coupons');
    $breadcrumbs->push( ucfirst($vendor), newUrl('coupon/couponlist') );
});

Breadcrumbs::register('c_search', function($breadcrumbs )
{
    $breadcrumbs->parent('coupons');
    $breadcrumbs->push( "Search", newUrl('/coupons') );
});

Breadcrumbs::register('couponcat', function( $breadcrumbs, $category )
{
    $breadcrumbs->parent('coupons');
    $category = explode("-coupons.html", $category )[0];
    $category = helper::decode_url( $category );
    $breadcrumbs->push( ucwords( $category ), newUrl('coupon/couponlistcategory') );
});

Breadcrumbs::register('coupondetail', function( $breadcrumbs,$name, $promo )
{
    $breadcrumbs->parent('coupons');
    $breadcrumbs->push( unslug($name) , newUrl('coupon/$name/$promo') );
});

Breadcrumbs::register('compare-products', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Compare Products', newUrl('compare-products') );
});

Breadcrumbs::register('compare-mobiles', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Compare Mobiles', newUrl('compare-mobiles') );
});

Breadcrumbs::register('bestphones', function($breadcrumbs,$price)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Best Phone Under Rs.'.$price, newUrl('mobiles') );
});

Breadcrumbs::register('bbetphones', function($breadcrumbs,$min,$max)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Best Phone Between Rs.'.$min.' - Rs.'.$max, newUrl('mobiles') );
});

Breadcrumbs::register('sports_shoes', function($breadcrumbs,$brand, $group)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push($brand.' sports shoes for '.$group );
});
Breadcrumbs::register('smartphone', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push("mobile", newUrl('mobile') );
    $breadcrumbs->push("smartphone");
});
Breadcrumbs::register('dual_sim', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push("mobile", newUrl('mobile') );
    $breadcrumbs->push("dual sim phones");
});
Breadcrumbs::register('windows_phones', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push("mobile", newUrl('mobile') );
    $breadcrumbs->push("windows phones");
});
Breadcrumbs::register('android_phones', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push("mobile", newUrl('mobile') );
    $breadcrumbs->push("android phones");
});
Breadcrumbs::register('bbphones', function($breadcrumbs,$brand, $price)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Best '.$brand.' Phone Under Rs.'.$price, newUrl('mobiles') );
});

Breadcrumbs::register('category', function($breadcrumbs, $name )
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push( $name , newUrl( create_slug($name) ) );
});

Breadcrumbs::register('sub_category', function($breadcrumbs, $p_name, $cname )
{
    
    if( $cname == "mobiles-price-list-in-india" || $cname == "mobiles" )
    {
        $name = "mobile list";
    }
    else
        $name = $cname;

    $breadcrumbs->parent('category', $p_name, $cname );
    $name = str_replace("hp","HP",$name);
    $name = str_replace("htc","HTC",$name);
    $name = str_replace("lg","LG",$name);
    $breadcrumbs->push( clear_url( $name ) , newUrl( seoUrl( create_slug($p_name)."/".create_slug($cname) ) ) );
});

Breadcrumbs::register('product_list', function($breadcrumbs, $p_name, $child, $cname )
{
    $breadcrumbs->parent( 'sub_category', $p_name, $child );
    $breadcrumbs->push( clear_url( $cname ) , newUrl( seoUrl( create_slug($p_name)."/".create_slug($child)."/".create_slug($cname) ) ) );
});


/*************Custom Links**************************************/
Breadcrumbs::register('listing', function($breadcrumbs, $group,$category)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push( "List of $group ".reverse_slug($category));
});

Breadcrumbs::register('list_of_men_women', function($breadcrumbs,$group, $category, $keyword)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push( "List of $group ".reverse_slug($category) , newUrl( create_slug("list of $group $category") ) );
    $breadcrumbs->push(reverse_slug($keyword));
});
/*************Custom Links**************************************/



Breadcrumbs::register('p_detail', function( $breadcrumbs, $product )
{
    // dd($product);

    if( empty( $product->parent_category )   )
        $parent = $product->grp;
    else
        $parent = $product->parent_category;

    $child = $product->category;

    if( !empty( $product->grp ) && ( $parent != $product->grp ) )
        $breadcrumbs->parent( 'product_list', $product->grp, $parent, $child );
    else
        $breadcrumbs->parent( 'sub_category', $parent, $child );

    if(isset($product->brand) && !empty($product->brand) &&  $product->grp !='books')
    {        
        $c_brand = ucfirst( $product->brand );
        if($parent == $product->grp)
        {
            $breadcrumbs->push( clear_url( $c_brand." ".$child ) , newUrl( seoUrl(create_slug($parent)."/".create_slug( $product->brand)."--".create_slug($child) ) ) );
         }else{
            $breadcrumbs->push( clear_url( $c_brand." ".$child ) , newUrl( seoUrl( create_slug($product->grp)."/".create_slug($parent)."/".create_slug( $product->brand)."--".create_slug($child) ) ) );
        }
    }
    $breadcrumbs->push( clear_url( $product->name ), newUrl( 'product/'.$product->name."/".$product->id ) );
});

Breadcrumbs::register('p_detail_new', function( $breadcrumbs, $product )
{
    if( empty( $product->parent_category )   )
        $parent = $product->grp;
    else
        $parent = $product->parent_category;

    $child = $product->category;

    if( !empty( $product->grp ) && ( $parent != $product->grp ) )
        $breadcrumbs->parent( 'product_list', $product->grp, $parent, $child );
    else
        $breadcrumbs->parent( 'sub_category', $parent, $child );

    if(isset($product->brand) && !empty($product->brand))
    {
        if( strtolower($product->brand) == "lg" || strtolower($product->brand) == "htc" || strtolower($product->brand) == "hp" )
        {
             $c_brand = strtoupper($product->brand);
        }
        else{
             $c_brand = ucfirst( $product->brand );       
        }

        if($parent == $product->grp)
        {
            $breadcrumbs->push( clear_url( $c_brand." ".$child ) , newUrl( seoUrl(create_slug($parent)."/".create_slug( $product->brand)."--".create_slug($child) ) ) );
         }else{
            $breadcrumbs->push( clear_url( $c_brand." ".$child ) , newUrl( seoUrl( create_slug($product->grp)."/".create_slug($parent)."/".create_slug( $product->brand)."--".create_slug($child) ) ) );
        }
    }
    if($product->category_id == 351)
        $breadcrumbs->push( clear_url( $product->name )." Mobile Phone", newUrl( 'product/detail/'.$product->name."/".$product->id ) );
    else
        $breadcrumbs->push( clear_url( $product->name ), newUrl( 'product/detail/'.$product->name."/".$product->id ) );
});
Breadcrumbs::register('p_detail_amp', function( $breadcrumbs, $product )
{
    // dd($product);

    if( empty( $product->parent_category )   )
        $parent = $product->grp;
    else
        $parent = $product->parent_category;

    $child = $product->category;
    $breadcrumbs->push("amp","amp");
    if( !empty( $product->grp ) && ( $parent != $product->grp ) )
        $breadcrumbs->parent( 'product_list', $product->grp, $parent, $child );
    else
        $breadcrumbs->parent( 'sub_category', $parent, $child );

    if(isset($product->brand) && !empty($product->brand) &&  $product->grp !='books')
    {        
        $c_brand = ucfirst( $product->brand );
        if($parent == $product->grp)
        {
            $breadcrumbs->push( clear_url( $c_brand." ".$child ) , newUrl( seoUrl(create_slug($parent)."/".create_slug( $product->brand)."--".create_slug($child) ) ) );
         }else{
            $breadcrumbs->push( clear_url( $c_brand." ".$child ) , newUrl( seoUrl( create_slug($product->grp)."/".create_slug($parent)."/".create_slug( $product->brand)."--".create_slug($child) ) ) );
        }
    }
    $breadcrumbs->push( clear_url( $product->name ), newUrl( 'product/'.$product->name."/".$product->id ) );
});
Breadcrumbs::register('p_detail_new_amp', function( $breadcrumbs, $product )
{
    if( empty( $product->parent_category )   )
        $parent = $product->grp;
    else
        $parent = $product->parent_category;

    $child = $product->category;
    $breadcrumbs->push("amp","amp");
    if( !empty( $product->grp ) && ( $parent != $product->grp ) )
        $breadcrumbs->parent( 'product_list', $product->grp, $parent, $child );
    else
        $breadcrumbs->parent( 'sub_category', $parent, $child );

    if(isset($product->brand) && !empty($product->brand))
    {
        if( strtolower($product->brand) == "lg" || strtolower($product->brand) == "htc" || strtolower($product->brand) == "hp" )
        {
             $c_brand = strtoupper($product->brand);
        }
        else{
             $c_brand = ucfirst( $product->brand );       
        }

        if($parent == $product->grp)
        {
            $breadcrumbs->push( clear_url( $c_brand." ".$child ) , newUrl( seoUrl(create_slug($parent)."/".create_slug( $product->brand)."--".create_slug($child) ) ) );
         }else{
            $breadcrumbs->push( clear_url( $c_brand." ".$child ) , newUrl( seoUrl( create_slug($product->grp)."/".create_slug($parent)."/".create_slug( $product->brand)."--".create_slug($child) ) ) );
        }
    }
    if($product->category_id == 351)
        $breadcrumbs->push( clear_url( $product->name )." Mobile Phone", newUrl( 'product/detail/'.$product->name."/".$product->id ) );
    else
        $breadcrumbs->push( clear_url( $product->name ), newUrl( 'product/detail/'.$product->name."/".$product->id ) );
   
});

Breadcrumbs::register('trending', function( $breadcrumbs )
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Hot Trending Products', newUrl('hot-trending-products') );
});

Breadcrumbs::register('all-cat', function( $breadcrumbs )
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Categories', newUrl('hot-trending-products') );
});
Breadcrumbs::register('amazon-sale', function( $breadcrumbs )
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Amazon:: Great India Sale', newUrl('hot-trending-products') );
});