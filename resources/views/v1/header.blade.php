<!DOCTYPE HTML>
<html lang="en-us">
    <head>
        <meta charset="utf-8" />
        <title>IndiaShopps</title>
        <link rel="stylesheet" href="<?=asset("/css/v1/animate.css")?>" type="text/css" />
        <link rel="stylesheet" href="<?=asset("/css/v1/addition.css")?>" type="text/css" />
        <link rel="stylesheet" href="<?=asset("/css/v1/bootstrap.min.css")?>" type="text/css" />
		<link rel="stylesheet" href="<?=asset("/css/v1/main.css")?>" type="text/css" />
        <link rel="stylesheet" href="<?=asset("/css/v1/font-awesome.min.css")?>" type="text/css" />
        <script type="text/javascript" src="<?=asset("/js/v1/demo.js")?>"></script>
        <script type="text/javascript" src="<?=asset("/js/v1/jquery.min.js")?>"></script>
        <script type="text/javascript" src="<?=asset("/js/v1/bootstrap.min.js")?>"></script>
        <script type="text/javascript" src="<?=asset("/js/v1/v_7_cf743db1f417650581eef7f7e48238e4.js")?>"></script>
        <script src="<?=asset("/js/v1/owl.carousel.min.js")?>"></script>
        <script type="text/javascript" src="<?=asset("/js/v1/main.js")?>"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.nanoscroller/0.8.7/css/nanoscroller.min.css" type="text/css" />
    </head>
    <body>
    <!-- ==========Header===============- -->
<header class="StickyHeader">
    <div class="container">
        <div class="row">
            <hgroup class="col-sm-3 col-md-3">
                <a href="#" title="">
                    <img class="indiashopps-logo img-responsive" src="<?=asset("/images/v1/indiashopps_logo-final.png")?>" alt=""  />
                </a>
            </hgroup>
        <!-- ----- pos search module TOP ---- -->
			<div class="col-xs-12 col-sm-9 col-md-6">
                <div class="wrap_seach list-inline" id="pos_search_top">
                    <form class="form_search" id="searchbox" action="#" method="get">
                        <label for="pos_query_top"></label>
                        <!-- image on background -->
                            <input type="hidden" value="search" name="controller">
								<input type="hidden" value="position" name="orderby">
                                    <input type="hidden" value="desc" name="orderway">
                                        <input type="text" value="" name="search_query" id="pos_query_top" placeholder="Enter your search key..." class="search_query form-control ac_input" autocomplete="off" />
                                        <div class="pos_search form-group">
                                            <select class="selectpicker" name="poscats">
                                                <option value="">Categories</option>
                                                <option value="12"> Accessories </option>
                                            </select>
                                        </div>
                                        <button class="btn btn-default submit_search" value="Search" name="submit_search" type="submit">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                    </form>
                </div>
            </div>
			<div class="col-md-3 col-sm-3 hidden-xs hidden-sm">
				<a href="https://play.google.com/store/apps/details?id=com.indiashopps.android&referrer=source%3DSite ">
					<img src="<?=asset("/images/v1/download_aap3.png")?>" class="img-responsive aap-icons" width="130">
				</a>
				<a href="#">
					<img src="<?=asset("/images/v1/download_aap3.png")?>" class="img-responsive aap-icons" width="130">
				</a>
			</div>
        </div>
    </div>
</header>
<!-- ================================Category==========================- -->
<?php //dd($navigation); ?>
<div class="menu_out">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3">
                <div class="pt_vegamenu">
                    <div class="pt_vmegamenu_title">
                        <h1 class="main-cat-heading">Categories</h1>
                    </div>
                        <div id="pt_vmegamenu" class="pt_vegamenu_cate">
                            <div id="ver_pt_menu12" class="pt_menu">
                                <div class="parentMenu">
                                    <a href="#"><span class="cate-thumb">
                                        <img class="img-responsive" src="<?=asset("/images/v1/icons/women_icon.png")?>" alt= ""/></span>
                                        <span>Women</span>
									</a>
                                </div>
                                <div class="wrap-popup hidden-xs">
                                    <div id="ver_popup12" class="popup">
                                        <div class="box-popup">
                                            <div class="block1">
                                                <div class="column first col1" style="float:left;">
                                                    <div class="itemMenu level1">
                                                        <a class="itemMenuName level3" href="#">
                                                            <span>Ethnic Clothing</span>
                                                        </a>
															<div class="itemSubMenu level3">
                                                                <div class="itemMenu level4">
                                                                    <a class="itemMenuName level4" href="#">
                                                                        <span>Kurtas & Kurtis</span>
                                                                    </a>
                                                                    <a class="itemMenuName level4" href="#">
                                                                        <span>Salwar Suits</span>
                                                                    </a>
                                                                    <a class="itemMenuName level4" href="#">
                                                                        <span>Anarkali</span>
                                                                    </a>
                                                                    <a class="itemMenuName level4" href="#">
                                                                        <span>Churidars & Salwars</span>
                                                                    </a>
                                                                    <a class="itemMenuName level4" href="#">
                                                                        <span>Blouses</span>
                                                                    </a>
                                                                    <a class="itemMenuName level4" href="#">
                                                                        <span>View All</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <a class="itemMenuName level3" href="#">
                                                                <span>Clothing</span>
                                                            </a>
                                                            <div class="itemSubMenu level3">
                                                                <div class="itemMenu level4">
                                                                    <a class="itemMenuName level4" href="#">
																		<span>Shirt,Tops & Tees</span>
                                                                    </a>
                                                                    <a class="itemMenuName level4" href="#">
                                                                        <span>Dresses</span>
                                                                    </a>
                                                                    <a class="itemMenuName level4" href="#">
                                                                        <span>children</span>
                                                                    </a>
                                                                    <a class="itemMenuName level4" href="#">
                                                                        <span>Jumpsuits</span>
                                                                    </a>
                                                                    <a class="itemMenuName level4" href="#">
                                                                        <span>Jeans</span>
                                                                    </a>
                                                                    <a class="itemMenuName level4" href="#">
                                                                        <span>View All</span>
                                                                    </a>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
										<!-- --------------Lingerie & Sleepwear------- -->
                                                <div class="column last col2" style="float:left;">
                                                    <div class="itemMenu level1">
                                                        <a class="itemMenuName level3" href="#">
                                                            <span>Lingerie & Sleepwear</span>
                                                        </a>
                                                        <div class="itemSubMenu level3">
                                                            <div class="itemMenu level4">
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>Bras</span>
                                                                </a>
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>Panties</span>
                                                                </a>
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>Shapewear</span>
                                                                </a>
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>Babydolls</span>
                                                                </a>
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>Night Suits</span>
                                                                </a>
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>View All</span>
                                                                </a>
                                                            </div>
                                                        </div>
							<!-- --------------Winter-Wear------- -->
                                                        <a class="itemMenuName level3" href="#">
                                                            <span>Winter-Wear</span>
                                                        </a>
                                                        <div class="itemSubMenu level3">
                                                            <div class="itemMenu level4">
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>SweatShirts</span>
                                                                </a>
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>Sweaters & Pullovers</span>
                                                                </a>
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>Winter Jackets</span>
                                                                </a>
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>Coats</span>
                                                                </a>
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>Thermal Wear</span>
                                                                </a>
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>Winter Accessories</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                <!-- --------------Shoes--------------- -->
                                                <div class="column last col2" style="float:left;">
                                                    <div class="itemMenu level1">
                                                        <a class="itemMenuName level3" href="#"	>
                                                            <span>Shoes</span>
                                                        </a>
                                                        <div class="itemSubMenu level3">
                                                            <div class="itemMenu level4">
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>Sandals</span>
                                                                </a>
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>Platform & Wedges</span>
                                                                </a>
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>Heels</span>
                                                                </a>
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>Flats</span>
                                                                </a>
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>Bellies</span>
                                                                </a>
                                                                <a class="itemMenuName level4" href="#">
                                                                    <span>View All</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                    <!-- --------------Bags------- -->
                                                        <a class="itemMenuName level3" href="#"	>
															<span>Bags</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>HandBags</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Wallets</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Tote Bags</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Sling & Crossbody bags</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Clutches</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Backpacks</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>               
                                                    </div>
                                                </div>
                                    <!-- --------------Fancy Jewellery------- -->
                                                <div class="column last col2" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#"	>
															<span>Fancy Jewellery</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Earring</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Necklace & Sets</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Rings</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Bangles & Bracelets</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Pandant & sets</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Anklets & Toe Rings</span>
																</a>
															</div>
														</div>
														<!-- --------------Precious Jewellery------- -->
														<a class="itemMenuName level3" href="#"	>
															<span>Precious Jewellery</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Earring</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Bangles</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Rings</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Pendants</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Chains & Necklaces</span>
																</a>
															</div>
														</div>
													</div>
												</div>                
                                                <div class="clearBoth"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <!-- -===========category women end========= -->
                            <div id="ver_pt_menu13" class="pt_menu">
								<div class="parentMenu">
									<a href="#">
										<span class="cate-thumb">
											<img class="img-responsive" src="<?=asset("/images/v1/icons/men.png")?>" alt= ""/>
										</span>
										<span>Men</span>
									</a>
								</div>
								<div class="wrap-popup hidden-xs">
									<div id="ver_popup13" class="popup">
										<div class="box-popup">
											<div class="block1">
												<!-- --------------Shoes------- -->
												<div class="column first col1" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Shoes</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Casual Shoes</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Formal Shoes</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Sports Shoes</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Sandals & Floaters</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Loafers</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
														<!-- --------------Clothing------- -->
														<a class="itemMenuName level3" href="#">
															<span>Clothing</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Casual Shirts</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Formal Shirts</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>T-shirt</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Jeans</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Pants & trousers</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<!-- --------------Bags------- -->
												<div class="column last col2" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Bags</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Wallets</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Backpacks</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Utility/Travel</span>
																</a>
															</div>
														</div>
														<!-- --------------Innerwear/Sleepwear------- -->
														<a class="itemMenuName level3" href="#">
															<span>Innerwear/Sleepwear</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Briefs</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Trunks</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Boxers</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Vests</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<!-- --------------Winter Wear------- -->
												<div class="column last col2" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Winter Wear</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>SweatShirts</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Sweaters & Pullovers</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Winter Jackets</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Coats & Blazer</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
														<!-- --------------Accessories------- -->
														<a class="itemMenuName level3" href="#">
															<span>Accessories</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Watches</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Sunglasses</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Belts</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Eyeglasses</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Caps & Hats</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<!-- --------------Jewellery------- -->
												<div class="column last col2" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Bags</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Rings</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Bracelets</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Gold Coins</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Chains</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<div class="clearBoth"></div>
											</div>
										</div>
									</div>
								</div>
							</div>                
               <!-- -===========category men end========= -->
                            <div id="ver_pt_menu13" class="pt_menu">
								<div class="parentMenu">
									<a href="#">
										<span class="cate-thumb">
											<img class="img-responsive" src="<?=asset("/images/v1/icons/kids.png")?>" alt= ""/>
										</span>
										<span>Kids</span>
									</a>
								</div>
								<div class="wrap-popup hidden-xs">
									<div id="ver_popup13" class="popup">
										<div class="box-popup">
											<div class="block1">
												<!-- --------------Baby & Toddler Toys------- -->
												<div class="column first col1" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Baby & Toddler Toys</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Infant Play Gyms</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Soft Toys</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Blocks & Stacking Games</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Trains, Cars & Models</span>
																</a>
															</div>
														</div>
														<!-- --------------Kids Toys------------- -->
														<a class="itemMenuName level3" href="#">
															<span>Kids Toys</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Outdoor Play</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Educational & Learning</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Remote controlled Toys</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Soft Toys</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Trains, Cars and Models</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
														<!-- --------------Baby Footwear------------- -->
														<a class="itemMenuName level3" href="#">
															<span>Baby Footwear</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Boys</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Girls</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<!-- --------------Boy Clothing------------- -->
												<div class="column last col2" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Boy Clothing</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Accessories</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Dungarees & Jumpsuits</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>T-Shirts & Polos</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Shorts & Capris</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Jeans & Trousers</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
														<!-- --------------Girl Clothing------------- -->
														<a class="itemMenuName level3" href="#">
															<span>Girl Clothing</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Accessories</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Dungarees & Jumpsuits</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Formal Wear</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Ethnic Wear</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Dresses & Frocks</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
														<!----------------Baby Footwear------------- -->
														<a class="itemMenuName level3" href="#">
															<span>Baby Footwear</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Boys</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Girls</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<!----------------Baby Clothing------------- -->
												<div class="column last col2" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Baby Clothing</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Accessories</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Frocks</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Tops & Tees</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Shorts, Skirts & Jeans</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Pyjamas & Leggings</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
														<!----------------Baby Care------------- -->
														<a class="itemMenuName level3" href="#">
															<span>Baby Care</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Furniture & Decoration</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Diapering</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Birthday & Gifting</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Bath Care</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Feeding & Nursing</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
														<!----------------Accessories------------- -->
														<a class="itemMenuName level3" href="#">
															<span>Baby Footwear</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Ties, Belts & Suspenders</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<!----------------Boys Footwear------------- -->
												<div class="column last col2" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Boys Footwear</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Casual Shoes</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>School Shoes</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Sports Shoes</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Sandals</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
														<!----------------Girls Footwear------------- -->
														<a class="itemMenuName level3" href="#">
															<span>Girls Footwear</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Casual Shoes</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Sports Shoes</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Sandals</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Flats & Bellies</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Flats</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<!----------------Gear------------- -->
												<div class="column last col2" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Boys Footwear</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Baby Carriers & Carry Cots</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Bouncers, Rockers & Swings</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Strollers, Prams & Car Seats</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>High Chairs & Booster Seats</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<div class="clearBoth"></div>
											</div>
										</div>
									</div>
								</div>
							</div>                
                <!---===========category kids end=========-->
                            <div id="ver_pt_menu13" class="pt_menu">
								<div class="parentMenu">
									<a href="#">
										<span class="cate-thumb">
											<img class="img-responsive" src="<?=asset("/images/v1/icons/electronics.png")?>" alt= ""/>
										</span>
										<span>Electronics</span>
									</a>
								</div>
								<div class="wrap-popup hidden-xs">
									<div id="ver_popup13" class="popup">
										<div class="box-popup">
											<div class="block1">
												<!----------------LCD & LED TVs------------- -->
												<div class="column first col1" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>LCD & LED TVs</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>LED</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Plasma</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>LCD</span>
																</a>
															</div>
														</div>
														<!----------------iPods, Home Theaters & DVD Players------------- -->
														<a class="itemMenuName level3" href="#">
															<span>iPods, Home Theaters & DVD Players</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Apple iPod</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>MP3 Players</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Home Theaters</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Video & DVD Players</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Projectors</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<!----------------Gaming & Accessories------------- -->
												<div class="column last col2" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Gaming & Accessories</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Gaming Consoles</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Accessories</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Components</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Games</span>
																</a>
															</div>
														</div>
														<!----------------TV & Video Accessories------------- -->
														<a class="itemMenuName level3" href="#">
															<span>TV & Video Accessories</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Remote Controls</span>
																</a>
															</div>
														</div>
														<!---------------Security Systems------------- -->
														<a class="itemMenuName level3" href="#">
															<span>TV & Video Accessories</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Security Systems</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<div class="clearBoth"></div>
											</div>
										</div>
									</div>
								</div>
							</div>                
                <!---===========category Electronics end=========-->
                            <div id="ver_pt_menu13" class="pt_menu">
								<div class="parentMenu">
									<a href="#">
										<span class="cate-thumb">
											<img class="img-responsive" src="<?=asset("/images/v1/icons/mobile.png")?>" alt= ""/>
										</span>
										<span>Mobile</span>
									</a>
								</div>
								<div class="wrap-popup hidden-xs">
									<div id="ver_popup13" class="popup">
										<div class="box-popup">
											<div class="block1">
												<!---------------Mobile------------- -->
												<div class="column first col1" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Mobile</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Mobile</span>
																</a>
															</div>
														</div>
														<!---------------Tablets------------- -->
														<a class="itemMenuName level3" href="#">
															<span>Clothing</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Tablets</span>
																</a>
															</div>
														</div>
														<!----------------Car Mobile Accessories------------- -->
														<a class="itemMenuName level3" href="#">
															<span>Car Mobile Accessories</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Car Kits</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Car Kits</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Car Cradles & Mounts</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>GPS Navigation Devices</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<!---------------Landline Phones------------- -->
												<div class="column last col2" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Landline Phones</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Landline Phones</span>
																</a>
															</div>
														</div>
								<!---------------Tablet Accessories------------- -->
														<a class="itemMenuName level3" href="#">
															<span>Tablet Accessories</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Cases & Covers</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Screen guards</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<!---------------Landline Phones------------- -->
												<div class="column last col2" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Mobile Accessories</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Cases & Covers</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Smart Watches</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>MicroSD Memory Cards</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Mobile Battery</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Mobile Chargers</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
								<!---------------Headphones & Headsets------------- -->
														<a class="itemMenuName level3" href="#">
															<span>Headphones & Headsets</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Headphones</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Bluetoot Headsets</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Wired Headsets</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<div class="clearBoth"></div>
											</div>
										</div>
									</div>
								</div>
							</div>                
                <!---===========category mobile end=========-->
                            <div id="ver_pt_menu13" class="pt_menu">
								<div class="parentMenu">
									<a href="#">
										<span class="cate-thumb">
											<img class="img-responsive" src="<?=asset("/images/v1/icons/appliances.png")?>" alt= ""/>
										</span>
										<span>Appliances</span>
									</a>
								</div>
								<div class="wrap-popup hidden-xs">
									<div id="ver_popup13" class="popup">
										<div class="box-popup">
											<div class="block1">
												<!---------------Kitchen Appliances------------- -->
												<div class="column first col1" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Kitchen Appliances</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Mixer Grinder Juicers</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Electric Kettles</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Induction Cook Tops</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Choppers & Blenders</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Electric (Rice) Cookers</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
														<!---------------Home Appliances------------- -->
														<a class="itemMenuName level3" href="#">
															<span>Home Appliances</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Irons</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Vacuum Cleaners</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Washing Machines</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Refrigerators</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Emergency Lights</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<!---------------Heaters, Fans & Coolers------------- -->
												<div class="column last col2" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Heaters, Fans & Coolers</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Fans</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Geysers</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Immersion Rods</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Room Heaters</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Air Coolers</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<!---------------Lighting------------- -->
												<div class="column last col2" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Lighting</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>CFL</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>LED Light</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<div class="clearBoth"></div>
											</div>
										</div>
									</div>
								</div>
							</div>                
                <!---===========category Appliances end=========-->
                            <div id="ver_pt_menu13" class="pt_menu">
								<div class="parentMenu">
									<a href="#">
										<span class="cate-thumb">
											<img class="img-responsive" src="<?=asset("/images/v1/icons/home.png")?>" alt= ""/>
										</span>
										<span>Home</span>
									</a>
								</div>
								<div class="wrap-popup hidden-xs">
									<div id="ver_popup13" class="popup">
										<div class="box-popup">
											<div class="block1">
												<!---------------Decor------------- -->
												<div class="column first col1" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Decor</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Showpieces & Decoratives</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Clocks</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Paintings & Wall Art</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Flowers & Vases</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Candle & Fragrances</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
														<!---------------Furniture------------- -->
														<a class="itemMenuName level3" href="#">
															<span>Furniture</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Bean Bags</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Shoe Racks</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Bed & Bedsides</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Seatings & Chairs</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Sofa & Sets</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<!---------------Kitchen & Dining------------- -->
												<div class="column last col2" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Kitchen & Dining</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Dining & Serving</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Cookware & Bakeware</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Bar & Drinkware</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Everyday Glasses</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Tea & Coffee</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
														<!---------------Home Linen------------- -->
														<a class="itemMenuName level3" href="#">
															<span>Home Linen</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Bedsheets & Sets</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Curtains & Cushions</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Carpets, Rugs & Mats</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Towels</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Kitchen & Table Linens</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>View All</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<!---------------Plants & Gardening------------- -->
												<div class="column last col2" style="float:left;">
													<div class="itemMenu level1">
														<a class="itemMenuName level3" href="#">
															<span>Plants & Gardening</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Plants</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Seeds</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Garden Tool</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Pots & Planter</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Water Cans</span>
																</a>
															</div>
														</div>
														<!---------------Home Utility------------- -->
														<a class="itemMenuName level3" href="#">
															<span>Home Utility</span>
														</a>
														<div class="itemSubMenu level3">
															<div class="itemMenu level4">
																<a class="itemMenuName level4" href="#">
																	<span>Laundry Bags</span>
																</a>
																<a class="itemMenuName level4" href="#">
																	<span>Hangers & Organizers</span>
																</a>
															</div>
														</div>
													</div>
												</div>
												<div class="clearBoth"></div>
											</div>
										</div>
									</div>
								</div>
							</div>                
                <!---===========category Home end=========-->
                            <div id="ver_pt_menu19" class="pt_menu noSub">
                                <div class="parentMenu">
                                    <a href="#">
                                        <span class="cate-thumb">
                                            <img class="img-responsive" src="<?=asset("/images/v1/icons/view_all.png")?>" alt= ""/>
                                        </span>
                                            <span>View All</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <div class="clearfix"></div>
                </div>
            </div>
                <!-- Menu -->
                <div class="nav-container visible-desktop hidden-xs col-sm-9">
					<div id="pt_custommenu" class="pt_custommenu">
						<div id="pt_menu_home" class="pt_menu act">
							<div class="parentMenu">
								<a href="#">
									<span>Home</span>
								</a>
							</div>
						</div>
						<div class="pt_menu_cms pt_menu">
							<div class="parentMenu">
								<a href="#">
									<span>Compare Mobiles</span>
								</a>
							</div>
						</div>
						<div class="pt_menu_cms pt_menu">
							<div class="parentMenu">
								<a href="#">
									<span>Compare Electronics</span>
								</a>
							</div>
						</div>
						<div class="pt_menu_cms pt_menu">
							<div class="parentMenu">
								<a href="#">
									<span>About us</span>
								</a>
							</div>
						</div>
						<div class="pt_menu_cms pt_menu">
							<div class="parentMenu">
								<a href="#">
									<span>Coupons</span>
								</a>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>                
        </div>
    </div>
</div>