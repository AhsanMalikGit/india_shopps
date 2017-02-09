<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Api Documentation</title>

    <!-- Bootstrap Core CSS -->
    <link media="all" type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="css/sb-admin-2.css">
    <link media="all" type="text/css" rel="stylesheet" href="css/metisMenu.css">
    <link media="all" type="text/css" rel="stylesheet" href="css/font-awesome.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="css/custom.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/default.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <nav class="navbar navbar_blue navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Api Documentation</a>

        </div>
        <!-- /.navbar-header -->
        <ul class="nav  navbar-top-links1 navbar-right">
            <li>
                <a href="?action=clear"><i class="fa fa-times"></i> Clear Cache</a>
            </li>
        </ul>

        <!-- /.navbar-top-links -->

        <div class="navbar-inverse sidebar1" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li>
                        <a href="javascript:void(0)" class="toggle" data-target="#home"><i class="fa fa-dashboard fa-fw"></i> checked</a>
                    </li>

                     <li>
						<a href="javascript:void(0)" class="toggle" data-target="#homepage"><span class="label label-success">GET</span> HomePage</a>
					</li> 
					<li>
						<a href="javascript:void(0)" class="toggle" data-target="#cat"><span class="label label-success">GET</span> Categories</a>
					</li>   
					<!-- <li>
						<a href="javascript:void(0)" class="toggle" data-target="#slider"><span class="label label-success">GET</span> Slider</a>
					</li>   -->
					 <li>
						<a href="javascript:void(0)" class="toggle" data-target="#products"><span class="label label-warning">POST</span> Products</a>
					</li> 
					<li>
						<a href="javascript:void(0)" class="toggle" data-target="#product-detail"><span class="label label-warning">POST</span> Product Detail</a>
					</li>
					 <li>
						<a href="javascript:void(0)" class="toggle" data-target="#login"><span class="label label-warning">POST</span> Login</a>
					</li>   
					 <li>
						<a href="javascript:void(0)" class="toggle" data-target="#coupon"><span class="label label-warning">POST</span> Coupon</a>
					</li>   
					<li>
						<a href="javascript:void(0)" class="toggle" data-target="#deals"><span class="label label-warning">POST</span> Deals of the day</a>
					</li>   
					<li>
						<a href="javascript:void(0)" class="toggle" data-target="#install"><span class="label label-warning">POST</span> Install by Tracking</a>
					</li>   
					
                    <!--  <li>
						<a href="javascript:void(0)" class="toggle" data-target="#0f101d2b-4e9f-4a58-1771-0d02294f5d86"><span class="label label-warning">POST</span> Find In People</a>-->
					</li>                                     
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>


    <div id="page-wrapper">
        <div id="home" class="toggle">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Api Documentation</h1>
                </div>
                <div class="col-lg-3">
                <form action="" method="post">
                    <div class="form-group">
                        <label>Api Key</label>
                        <input type="text" class="form-control" name="key" value="6d496a31d9b8ad7b650b" />
                    </div>
                    <input type="submit" name="setKey" value="Save" class="btn btn-success btn-sm" />
                </form>
                    </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
                    
		<div id="homepage" class="toggle" style="display: none">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">HomePage</h1>
					<p></p>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-lg-12">
					<p><strong>URL: </strong> http://app.indiashopps.com/api/home.php</p>
					<p><strong>Method: </strong> <span class="label label-warning">POST</span></p>
					<p><strong>Fields: </strong></p>
					<div class="row">
						<div class="col-md-8">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>Field Name</th>
									<th>Field Type</th>
									<th>Dummy Value</th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td>recent_prod</td>
										<td>String</td>
										<td>646832_16,646836_16,646838_16</td>
									</tr>
									<tr>
										<td>device_id</td>
										<td>String</td>
										<td>123123123</td>
									</tr>	
									<tr>
										<td>push_id</td>
										<td>String</td>
										<td>123123123</td>
									</tr>	
								</tbody>
							</table>
						</div>
						<div class="col-md-6">
	
						</div>
					</div>

							<h4 class="page-header">Responses:</h4>
							<p>Success</p>
							   <pre><code class="json">{
    "status": true,
    "keycode": 100,
    "category": [{
        "id": "1",
        "parent_id": "0",
        "name": "Women",
        "level": "0",
        "description": "",
        "sequence": "2",
        "image": null,
        "seo_title": "",
        "meta": ""
    }, {
        "id": "85",
        "parent_id": "0",
        "name": "Men",
        "level": "0",
        "description": "",
        "sequence": "2",
        "image": null,
        "seo_title": "",
        "meta": ""
    }]
}</code></pre>
                                                                    <p>No data</p>
                                    <pre><code class="json">{
    "status": false,
    "keycode": 300,
    "message": "No data found!"
}</code></pre>
					</div>
			</div>
		</div>
		
		<div id="cat" class="toggle" style="display: none">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Categories</h1>
					<p></p>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-lg-12">
					<p><strong>URL: </strong> http://app.indiashopps.com/api/category.php</p>
					<p><strong>Method: </strong> <span class="label label-success">GET</span></p>
					<p><strong>Fields: </strong></p>
					<div class="row">
						<div class="col-md-8">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>Field Name</th>
									<th>Field Type</th>
									<th>Dummy Value</th>
								</tr>
								</thead>
								<tbody>
										<tr>
											<td>level</td>
											<td>Integer</td>
											<td>0</td>
										</tr>
										<tr>
											<td>name</td>
											<td>String</td>
											<td>Men</td>
										</tr>
										<tr>
											<td>id</td>
											<td>Integer</td>
											<td>222</td>
										</tr>
										<tr>
											<td>parent_id</td>
											<td>Integer</td>
											<td>1</td>
										</tr>
										<tr>
											<td>pretty</td>
											<td>Boolean</td>
											<td>true</td>
										</tr>
											
								</tbody>
							</table>
						</div>
						<div class="col-md-6">

						</div>
					</div>

							<h4 class="page-header">Responses:</h4>
							<p>Success</p>
							   <pre><code class="json">{
    "status": true,
    "keycode": 100,
    "category": [{
        "id": "1",
        "parent_id": "0",
        "name": "Women",
        "level": "0",
        "description": "",
        "sequence": "2",
        "image": null,
        "seo_title": "",
        "meta": ""
    }, {
        "id": "85",
        "parent_id": "0",
        "name": "Men",
        "level": "0",
        "description": "",
        "sequence": "2",
        "image": null,
        "seo_title": "",
        "meta": ""
    }]
}</code></pre>
                                                                    <p>No data</p>
                                    <pre><code class="json">{
    "status": false,
    "keycode": 300,
    "message": "No data found!"
}</code></pre>
					</div>
			</div>
		</div>

		<div id="slider" class="toggle" style="display: none">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Slider</h1>
					<p></p>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-lg-12">
					<p><strong>URL: </strong> http://app.indiashopps.com/api/slider.php</p>
					<p><strong>Method: </strong> <span class="label label-success">GET</span></p>
					<p><strong>Fields: </strong></p>
					<div class="row">
						<div class="col-md-8">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>Field Name</th>
									<th>Field Type</th>
									<th>Dummy Value</th>
								</tr>
								</thead>
								<tbody>
										<tr>
											<td>home</td>
											<td>Integer</td>
											<td>1</td>
										</tr>
										<tr>
											<td>cat_id</td>
											<td>Integer</td>
											<td>86</td>
										</tr>
										<tr>
											<td>id</td>
											<td>Integer</td>
											<td>1</td>
										</tr>
										<tr>
											<td>type</td>
											<td>Integer</td>
											<td>0</td>
										</tr>
										<tr>
											<td>pretty</td>
											<td>Boolean</td>
											<td>true</td>
										</tr>
											
								</tbody>
							</table>
						</div>
						<div class="col-md-6">

						</div>
					</div>

							<h4 class="page-header">Responses:</h4>
							<p>Success</p>
							   <pre><code class="json">{
    "status": true,
    "keycode": 100,
    "slider": [{
        "id": "1",
        "image_url": "http:\/\/www.indiashopps.com\/app\/images\/480x300\/offer1.jpg",
        "cat_id": "0",
        "home": "1",
        "type": "0",
        "url": "",
        "size": "480x300",
        "active": "1",
        "update_on": "2015-07-15 13:54:27"
    }, {
        "id": "2",
        "image_url": "http:\/\/www.indiashopps.com\/app\/images\/480x300\/offer2.png",
        "cat_id": "86",
        "home": "1",
        "type": "0",
        "url": "",
        "size": "480x300",
        "active": "1",
        "update_on": "2015-07-15 13:54:27"
    }, {
        "id": "3",
        "image_url": "http:\/\/www.indiashopps.com\/app\/images\/480x300\/offer3.png",
        "cat_id": "0",
        "home": "1",
        "type": "1",
        "url": "",
        "size": "480x300",
        "active": "1",
        "update_on": "2015-07-15 13:54:27"
    }]
}</code></pre>
                                                                    <p>No data</p>
                                    <pre><code class="json">{
    "status": false,
    "keycode": 300,
    "message": "No data found!"
}</code></pre>
					</div>
			</div>
		</div>	
		
	<div id="products" class="toggle" style="display: none">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Products</h1>
					<p></p>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-lg-12">
					<p><strong>Test URL: </strong> http://www.indiashopps.com/ext/composer/ind_andr_test.php</p>
					<p><strong>URL: </strong> http://www.indiashopps.com/ext/composer/ind_andr.php</p>
					<p><strong>Filter URL: </strong> http://www.indiashopps.com/ext/composer/ind_andr_filter.php</p>
					<p><strong>Method: </strong> <span class="label label-success">GET</span></p>
					<p><strong>Fields: </strong></p>
					<div class="row">
						<div class="col-md-8">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>Field Name</th>
									<th>Field Type</th>
									<th>Dummy Value</th>
								</tr>
								</thead>
								<tbody>
										<tr>
											<td>_id</td>
											<td>String</td>
											<td>6324071_1</td>
										</tr>
										<tr>
											<td>query</td>
											<td>String</td>
											<td>shirt</td>
										</tr>
										<tr>
											<td>cat_id</td>
											<td>Integer</td>
											<td>3</td>
										</tr>
										<tr>
											<td>saleprice_max</td>
											<td>Integer</td>
											<td>2000</td>
										</tr>
										<tr>
											<td>saleprice_min</td>
											<td>Integer</td>
											<td>200</td>
										</tr>
										<tr>
											<td>brand</td>
											<td>String</td>
											<td>Nike</td>
										</tr>
										
										<tr>
											<td>group</td>
											<td>String</td>
											<td>Men</td>
										</tr>
										<tr>
											<td>vendor</td>
											<td>Integer</td>
											<td>1</td>
										</tr>
										<tr>
											<td>size</td>
											<td>Integer</td>
											<td>30</td>
										</tr>
										<tr>
											<td>sort_field</td>
											<td>String</td>
											<td>saleprice</td>
										</tr>
										<tr>
											<td>sort_type</td>
											<td>String</td>
											<td>asc/desc</td>
										</tr>
										<tr>
											<td>page</td>
											<td>Integer</td>
											<td>1</td>
										</tr>
										
										<tr>
											<td>pretty</td>
											<td>Boolean</td>
											<td>true</td>
										</tr>
											
								</tbody>
							</table>
						</div>
						<div class="col-md-6">

						</div>
					</div>

							<h4 class="page-header">Responses:</h4>
							<p>Success</p>
							   <pre><code class="json">{
    "status": true,
    "keycode": 100,
    "products": {
        "took": 70,
        "timed_out": false,
        "_shards": {
            "total": 6,
            "successful": 6,
            "failed": 0
        },
        "hits": {
            "total": 442932,
            "max_score": 4.275833,
            "hits": [{
                        "_index": "shopping",
                        "_type": "product",
                        "_id": "4713297_2",
                        "_score": 4.275833,
                        "_source": {
                            "id": "4713297",
                            "product_id": "716234",
                            "name": "Pink Shirt",
                            "category": "Women's Clothing",
                            "product_url": "http:\/\/tracking.vcommission.com\/aff_c?offer_id=126&aff_id=32558&url=http%3A%2F%2Fwww.jabong.com%2Fvero-moda-Pink-Shirt-716234.html%253Futm_source%253DVCOMMISSION.COM%2526utm_medium%253Ddc-clicktracker%2526utm_campaign%253D32558",
                            "description": "",
                            "brand": "Vero Moda",
                            "category_id": "678",
                            "original_link": "http:\/\/www.jabong.com\/vero-moda-Pink-Shirt-716234.html",
                            "price": 0,
                            "saleprice": 948,
                            "discount": "0",
                            "image_url": "http:\/\/static4.jassets.com\/p\/Vero-Moda-Pink-Shirt-8245-432617-1-catalog.jpg",
                            "vendor": "2",
                            "grp": "Women"
                        }
                    }, {
                        "_index": "shopping",
                        "_type": "product",
                        "_id": "6452143_2",
                        "_score": 4.2162433,
                        "_source": {
                            "id": "6452143",
                            "product_id": "1237277",
                            "name": "Pink Shirt",
                            "category": "Women's Clothing",
                            "product_url": "http:\/\/tracking.vcommission.com\/aff_c?offer_id=126&aff_id=32558&url=http%3A%2F%2Fwww.jabong.com%2Fdazzio-Pink-Shirt-1237277.html%253Futm_source%253DVCOMMISSION.COM%2526utm_medium%253Ddc-clicktracker%2526utm_campaign%253D32558",
                            "description": "",
                            "brand": "Dazzio",
                            "category_id": "678",
                            "original_link": "http:\/\/www.jabong.com\/dazzio-Pink-Shirt-1237277.html",
                            "price": 0,
                            "saleprice": 1380,
                            "discount": "0",
                            "image_url": "http:\/\/static4.jassets.com\/p\/Dazzio-Pink-Shirt-2456-7727321-1-catalog.jpg",
                            "vendor": "2",
                            "grp": "Women"
                        }
                    },
		 ]
        },
        "facets": {
            "category": {
                "_type": "terms",
                "missing": 0,
                "total": 442932,
                "other": 54371,
                "terms": [
                    {
                        "term": "Men's Clothing",
                        "count": 194391
                    },
                    {
                        "term": "Mobile Accessories",
                        "count": 42214
                    },
                    {
                        "term": "Women's Clothing",
                        "count": 38400
                    },
                    {
                        "term": "Shirts",
                        "count": 28179
                    },
                    {
                        "term": "T-Shirts",
                        "count": 22848
                    },
                    {
                        "term": "Kids' Clothing",
                        "count": 18242
                    },
                    {
                        "term": "Home Decore",
                        "count": 17591
                    },
                    {
                        "term": "Home Furnishing",
                        "count": 13151
                    },
                    {
                        "term": "Jewellery",
                        "count": 8857
                    },
                    {
                        "term": "Bags, Wallets & Belts",
                        "count": 4688
                    }
                ]
            },
            "vendor": {
                "_type": "terms",
                "missing": 0,
                "total": 442932,
                "other": 4386,
                "terms": [
                    {
                        "term": 16,
                        "count": 132013
                    },
                    {
                        "term": 1,
                        "count": 110038
                    },
                    {
                        "term": 3,
                        "count": 69303
                    },
                    {
                        "term": 44,
                        "count": 65551
                    },
                    {
                        "term": 2,
                        "count": 41716
                    },
                    {
                        "term": 5,
                        "count": 8980
                    },
                    {
                        "term": 41,
                        "count": 3971
                    },
                    {
                        "term": 43,
                        "count": 3208
                    },
                    {
                        "term": 21,
                        "count": 2832
                    },
                    {
                        "term": 45,
                        "count": 934
                    }
                ]
            },
            "brand": {
                "_type": "terms",
                "missing": 1,
                "total": 601074,
                "other": 556507,
                "terms": [
                    {
                        "term": "freezer",
                        "count": 5992
                    },
                    {
                        "term": "brain",
                        "count": 5992
                    },
                    {
                        "term": "freecultr",
                        "count": 5611
                    },
                    {
                        "term": "yepme",
                        "count": 5289
                    },
                    {
                        "term": "the",
                        "count": 5216
                    },
                    {
                        "term": "house",
                        "count": 4802
                    },
                    {
                        "term": "this",
                        "count": 4641
                    },
                    {
                        "term": "campus",
                        "count": 3178
                    },
                    {
                        "term": "express",
                        "count": 1936
                    },
                    {
                        "term": "adidas",
                        "count": 1910
                    }
                ]
            },
            "saleprice": {
                "_type": "statistical",
                "count": 442932,
                "total": 402480581,
                "min": 29,
                "max": 382410,
                "mean": 908.67352325,
                "sum_of_squares": 1.13623650906e+12,
                "variance": 1739574.15919,
                "std_deviation": 1318.92917141
            }
        }
    }
}
	</code></pre>
                                                                    <p>No data</p>
                                    <pre><code class="json">{
    "status": false,
    "keycode": 300,
    "message": "No data found!"
}</code></pre>
					</div>
			</div>
		</div>
		
		
<div id="product-detail" class="toggle" style="display: none">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Products</h1>
					<p></p>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-lg-12">
					<p><strong>Test URL: </strong> http://www.indiashopps.com/ext/composer/ind_andr_detail_test.php</p>
					<p><strong>URL: </strong> http://www.indiashopps.com/ext/composer/ind_andr_detail.php</p>
					
					<p><strong>Method: </strong> <span class="label label-success">GET</span></p>
					<p><strong>Fields: </strong></p>
					<div class="row">
						<div class="col-md-8">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>Field Name</th>
									<th>Field Type</th>
									<th>Dummy Value</th>
								</tr>
								</thead>
								<tbody>
										<tr>
											<td>_id</td>
											<td>Integer</td>
											<td>1</td>
										</tr>
										<tr>
											<td>id</td>
											<td>Integer</td>
											<td>2</td>
										</tr>
											
								</tbody>
							</table>
						</div>
						<div class="col-md-6">

						</div>
					</div>

							<h4 class="page-header">Responses:</h4>
							<p>Success</p>
							   <pre><code class="json">
							   {"_index":"test_prime","_type":"product","_id":"1","_score":null,"_source":{"id":"1","name":"Apple iPhone 6","category":"Mobiles","description":"Design and Build<\/th><\/tr>Dimensions<\/td>138.1 x 67 x 6.9 mm (5.44 x 2.64 x 0.27 in)<\/td><\/tr>Weight<\/td>129 g (4.55 oz)<\/td><\/tr>Software<\/th><\/tr>Operating System<\/td>iOS 8, upgradable to iOS 9.0.2<\/td><\/tr>Display<\/th><\/tr>Size<\/td>4.7 inches<\/td><\/tr>Resolution<\/td>750 x 1334 pixels (~326 ppi pixel density)<\/td><\/tr>Type<\/td>LED-backlit IPS LCD, capacitive touchscreen, 16M colors<\/td><\/tr>Protection<\/td>Ion-strengthened glass, oleophobic coating<\/td><\/tr>Screen-to-body ratio<\/td>~65.8% screen-to-body ratio<\/td><\/tr>Camera<\/th><\/tr>Primary<\/td>8 MP, 3264 x 2448 pixels, phase detection autofocus, dual-LED (dual tone) flash<\/td><\/tr>Front-facing<\/td>1.2 MP, 720p@30fps, face detection, HDR, FaceTime over Wi-Fi or Cellular<\/td><\/tr>Video<\/td>1080p@60fps, 720p@240fps<\/td><\/tr>Features<\/td>1\/3' sensor size, 1.5 \u00b5m pixel size, touch focus, geo-tagging, face\/smile detection, HDR (photo\/panorama)<\/td><\/tr>Storage<\/th><\/tr>Internal<\/td>1 GB RAM<\/td><\/tr>Expandable<\/td>No<\/td><\/tr>Battery<\/th><\/tr>Type<\/td>Non-removable Li-Po<\/td><\/tr>Capacity<\/td>1810 mAh battery (6.9 Wh),Up to 50 h<\/td><\/tr>Talk time<\/td>Up to 14 h (3G)<\/td><\/tr>Standby Time<\/td>Up to 250 h (3G)<\/td><\/tr>Network and Connectivity<\/th><\/tr>2G<\/td>Yes, (GSM 900MHz and\/or GSM 1800MHz)<\/td><\/tr>3G<\/td>Yes, HSPA\/HSDPA 2100MHz<\/td><\/tr>4G<\/td>Yes,TDD-LTE Band 40 (2300MHz) & FDD-LTE Band 3 (1800 MHz)<\/td><\/tr>SIM<\/td>Nano-SIM<\/td><\/tr>Wi-Fi<\/td>Wi-Fi 802.11 a\/b\/g\/n\/ac, dual-band, hotspot<\/td><\/tr>Bluetooth<\/td>v4.0, A2DP, LE<\/td><\/tr>GPS<\/td>Yes, with A-GPS, GLONASS<\/td><\/tr>NFC<\/td>Yes (Apple Pay only)<\/td><\/tr>Infrared<\/td>No<\/td><\/tr>Wired<\/td>v2.0, reversible connector<\/td><\/tr>Radio<\/td>No<\/td><\/tr>Platform<\/th><\/tr>Processor<\/td>Apple A8<\/td><\/tr>CPU<\/td>Dual-core 1.4 GHz Typhoon (ARM v8-based)<\/td><\/tr>GPU<\/td>PowerVR GX6450 (quad-core graphics)<\/td><\/tr>Sensors<\/td>Accelerometer, gyro, proximity, compass, barometer<\/td><\/tr>Sound<\/th><\/tr>Loudspeaker<\/td>Yes<\/td><\/tr>Headphones<\/td>Yes<\/td><\/tr>","mini_spec":"4.7 inch Screen;Single SIM;8 MP Camera;iOS 8 OS;1 GB RAM","excerpt":"
The Apple iPhone 6 features a 4.7-inch display with sapphire crystal glass protection<\/li>
It is powered by a Apple A8 64-bit processor and 1GB RAM<\/li>
The iPhone 6 sports an 8MP rear camera with dual-LED flash and a 1.2MP front camera<\/li>
The phone is succeeded by the Apple iphone 6S<\/li>
The phone has 16GB of non-expandable internal storage<\/li>
Connectivity features include Wi-Fi, 3G (HSPA+ 42.2Mbps), 4G LTE, Bluetooth 4.0, and NFC<\/li>
The iPhone 6 comes with a non-removable Li-Po 1810mAh battery<\/li>
It runs on the iOS 8 operating system<\/li><\/ul>","size":"16 GB","svariant":"[16 GB:64 GB:128 GB]","cvariant":"[Gold:Grey:Silver]","brand":"Apple","category_id":"351","image_url":"[\"http:\/\/img6a.flixcart.com\/image\/mobile\/f\/2\/j\/apple-iphone-6-400x400-imaeymdqs5gm5xkz.jpeg\",\"http:\/\/img6a.flixcart.com\/image\/mobile\/d\/c\/w\/apple-iphone-6-400x400-imaeymdqwfgvkqff.jpeg\",\"http:\/\/img6a.flixcart.com\/image\/mobile\/f\/b\/g\/apple-iphone-6-400x400-imaeynyptwbgfn5s.jpeg\"]","grp":"Electronics","track_stock":"1","product_id":"","product_url":"","original_link":"","saleprice":37890,"price":0,"discount":"0","vendor":"0"},"sort":[37890]}
	</code></pre>
                                                                    <p>No data</p>
                                    <pre><code class="json">{
    "status": false,
    "keycode": 300,
    "message": "No data found!"
}</code></pre>
					</div>
			</div>
		</div>
		
        
<div id="login" class="toggle" style="display: none">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Login</h1>
					<p></p>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-lg-12">
					<p><strong>URL: </strong> http://app.indiashopps.com/api/login.php</p>
					<p><strong>Method: </strong> <span class="label label-warning">POST</span></p>
					<p><strong>Fields: </strong></p>
					<div class="row">
						<div class="col-md-8">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>Field Name</th>
									<th>Field Type</th>
									<th>Dummy Value</th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td>name</td>
										<td>String</td>
										<td>Nitish Kumar</td>
									</tr>
									<tr>
										<td>device_id</td>
										<td>String</td>
										<td>123123123</td>
									</tr>	
									<tr>
										<td>email</td>
										<td>String</td>
										<td>niti@niti.com</td>
									</tr>	
									<tr>
										<td>gender</td>
										<td>String</td>
										<td>Male/Female</td>
									</tr>	
								</tbody>
							</table>
						</div>
						<div class="col-md-6">
	
						</div>
					</div>

							<h4 class="page-header">Responses:</h4>
							<p>Success</p>
							   <pre><code class="json">{
keycode: "100"
status: true
message: "Data Inserted Successfully."
}</code></pre>
                                                                    <p>No data</p>
                                    <pre><code class="json">{
    "status": false,
    "keycode": 200,
    "message": "Error!"
}</code></pre>
					</div>
			</div>
		</div>


<div id="coupon" class="toggle" style="display: none">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">coupon</h1>
					<p></p>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-lg-12">					
					<p><strong>URL: </strong> http://app.indiashopps.com/api/coupon.php</p>
					<p><strong>Method: </strong> <span class="label label-warning">POST</span></p>
					<p><strong>Fields: </strong></p>
					<div class="row">
						<div class="col-md-8">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>Field Name</th>
									<th>Field Type</th>
									<th>Dummy Value</th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td>vendor_name</td>
										<td>String</td>
										<td>Expedia</td>
									</tr>
									<tr>
										<td>promo</td>
										<td>String</td>
										<td>P17087</td>
									</tr>
									
								</tbody>
							</table>
						</div>
						<div class="col-md-6">
	
						</div>
					</div>

							<h4 class="page-header">Responses:</h4>
							<p>Success</p>
							   <pre><code class="json">{
    "status": true,
    "keycode": 100,
    "coupon": [
        {
            "promo": "P18022",
            "offerid": "779",
            "offer_name": "Expedia.co.in CPS - India",
            "title": "5&#37; discount on Hotels",
            "description": "T&C : Offer booking till 31st Dec 2015.",
            "category": "Hotels",
            "type": "Coupon",
            "code": "VCOM5",
            "offer_page": "http:\/\/tracking.vcommission.com\/aff_c?offer_id=779&aff_id=32558&url=http%253A%252F%252Fwww.expedia.co.in%252FHotels%253Faffcid%253DIN.NETWORK.VCOMMISSION.%257Baffiliate_id%257D.HOTELS.1406",
            "expiry_date": "2031-03-16",
            "added_date": "2006-05-15",
            "upvotes": "0",
            "downvotes": "0",
            "image_url": "",
            "vendor_name": "Expedia",
            "vendor_logo": "",
            "cat_id": "7",
            "sequence": "0"
        }
    ]
}</code></pre>
                                                                    <p>No data</p>
                                    <pre><code class="json">{
    "status": false,
    "keycode": 200,
    "message": "Error!"
}</code></pre>
					</div>
			</div>
		</div>


<div id="deals" class="toggle" style="display: none">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">coupon</h1>
					<p></p>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-lg-12">					
					<p><strong>URL: </strong> http://app.indiashopps.com/api/deals.php</p>
					<p><strong>Method: </strong> <span class="label label-warning">POST</span></p>
					<p><strong>Fields: </strong></p>
					<div class="row">
						<div class="col-md-8">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>Field Name</th>
									<th>Field Type</th>
									<th>Dummy Value</th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td>from</td>
										<td>Integer</td>
										<td>10</td>
									</tr>
									<tr>
										<td>size</td>
										<td>Integer</td>
										<td>30</td>
									</tr>
									<tr>
										<td>promo</td>
										<td>String</td>
										<td>P17087</td>
									</tr>
									
								</tbody>
							</table>
						</div>
						<div class="col-md-6">
	
						</div>
					</div>

							<h4 class="page-header">Responses:</h4>
							<p>Success</p>
							   <pre><code class="json">{
    "status": true,
    "keycode": 100,
    "coupon": [
        {
            "promo": "P18022",
            "offerid": "779",
            "offer_name": "Expedia.co.in CPS - India",
            "title": "5&#37; discount on Hotels",
            "description": "T&C : Offer booking till 31st Dec 2015.",
            "category": "Hotels",
            "type": "Coupon",
            "code": "VCOM5",
            "offer_page": "http:\/\/tracking.vcommission.com\/aff_c?offer_id=779&aff_id=32558&url=http%253A%252F%252Fwww.expedia.co.in%252FHotels%253Faffcid%253DIN.NETWORK.VCOMMISSION.%257Baffiliate_id%257D.HOTELS.1406",
            "expiry_date": "2031-03-16",
            "added_date": "2006-05-15",
            "upvotes": "0",
            "downvotes": "0",
            "image_url": "",
            "vendor_name": "Expedia",
            "vendor_logo": "",
            "cat_id": "7",
            "sequence": "0"
        }
    ]
}</code></pre>
                                                                    <p>No data</p>
                                    <pre><code class="json">{
    "status": false,
    "keycode": 200,
    "message": "Error!"
}</code></pre>
					</div>
			</div>
		</div>




<div id="install" class="toggle" style="display: none">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Install</h1>
					<p></p>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-lg-12">					
					<p><strong>URL: </strong> http://app.indiashopps.com/api/install.php</p>
					<p><strong>Method: </strong> <span class="label label-warning">POST</span></p>
					<p><strong>Fields: </strong></p>
					<div class="row">
						<div class="col-md-8">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>Field Name</th>
									<th>Field Type</th>
									<th>Dummy Value</th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td>device_id</td>
										<td>String</td>
										<td>21ewds2ss22ss22</td>
									</tr>
									<tr>
										<td>utm_source</td>
										<td>String</td>
										<td>abc</td>
									</tr>
									<tr>
										<td>utm_medium</td>
										<td>String</td>
										<td>tgf</td>
									</tr>
									<tr>
										<td>utm_campaign</td>
										<td>String</td>
										<td>gfr</td>
									</tr>
									<tr>
										<td>utm_content</td>
										<td>String</td>
										<td>sder</td>
									</tr>
									<tr>
										<td>tracking_id</td>
										<td>String</td>
										<td>12233333f</td>
									</tr>
									<tr>
										<td>ip_address</td>
										<td>String</td>
										<td>122.11.11.21</td>
									</tr>
									
								</tbody>
							</table>
						</div>
						<div class="col-md-6">
	
						</div>
					</div>

							<h4 class="page-header">Responses:</h4>
							<p>Success</p>
							   <pre><code class="json">{
"keycode": 100,
"status": true,
"message": "Data Inserted Successfully."
}</code></pre>
                                                                    <p>No data</p>
                                    <pre><code class="json">{
    "status": false,
    "keycode": 200,
    "message": "Error!"
}</code></pre>
					</div>
			</div>
		</div>














		
    </div>
</div>
<!-- /#wrapper -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/metisMenu.js"></script>
<script src="js/sb-admin-2.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<script>
    $('a.toggle').on('click',function(){
        $('div.toggle').slideUp();
        $($(this).data('target')).slideDown();
    })


</script>
</body>

</html>
