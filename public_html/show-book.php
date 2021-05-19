<?php
require_once 'swim.php';

$request = new request();

echo '<!DOCTYPE html>
<html lang="en-US"><script type="text/javascript">var res="LoRes.jpg";</script>' . headerHTML('Cosmic Unicorns', [
    'j/turnjs4/extras/jquery.mousewheel.min.js',
    'j/turnjs4/extras/modernizr.2.5.3.min.js',
    'j/turnjs4/lib/hash.js',
    'j/turnjs4/lib/scissor.js',
    'j/turnjs4/lib/turn.html4.min.js',
    'j/salowell-lib.js',
    'j/0.js',
    'j/bookpagescaling.js',
    'j/stripepaymentscript.js',
    'j/checkout.js'
], [
    // 'client/css/style.css',
    'client/css/owl.carousel.min.css',
    'client/css/justifiedGallery.min.css',
    'client/css/owl.theme.default.min.css',
    'c/0.css',
    'css/lightslider.min.css',
    'css/stripe-normalize.css',
    'css/stripe-global.css'
]) . '
	<script src="https://js.stripe.com/v3/"></script>
	<body class="home page wide wave-style">
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TRBLWDG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
		<div class="page">' . topPanel();
?>
<!-- header container -->
<div class='header_cont'>
	<div class='header_mask'>
		<div class='header_pattern'></div>
		<div class='header_img'></div>
	</div>
	<header class='site_header logo-in-menu' data-menu-after="3">
		<div class="header_box">
			<div class="container">
				<!-- logo -->
				<div class="header_logo_part with_border" role="banner">
					<a class="logo" href="./"><img src='i/logo.png'
						data-at2x='i/logo2x.png' alt /></a>
				</div>
				<!-- / logo -->
<?php
echo mainMenu();
?>
						</div>
		</div>
	</header>
	<!-- #masthead -->
</div>

<!-- breadcrumbs -->
<section class='page_title wave'>
	<div class='container'>
		<div class='title'>
			<h1>Book Preview</h1>
		</div>
		<nav class="bread-crumbs">
			<a href="./">Home</a><i class="delimiter fa fa-chevron-right"></i><span
				class="current">Book Preview</span>
		</nav>
		<!-- .breadcrumbs -->
	</div>
	<canvas class='breadcrumbs' data-bg-color='#f8f2dc'
		data-line-color='#f9e8b2'></canvas>
</section>
<!-- / breadcrumbs -->

<!-- main container -->
<div id="main" class="site-main">
	<div class="page_content">
		<!-- pattern conatainer / -->
		<div class='left-pattern pattern pattern-2'></div>
		<main>






<?php
ignore_user_abort(true);
define('MAX_FILE_SIZE', 1000000);

$childsImage = '';
$permitted = array(
    'image/gif',
    'image/jpeg',
    'image/png',
    'image/pjpeg'
); // Set array of permittet filetypes
$error = true; // Define an error boolean variable
$filetype = ""; // Just define it empty.
$childImageFileName = '';
$id=isset($_GET['id'])?$_GET['id']:null;


if ($id===null || !isset($_COOKIE['carts'])) {

    /*
     * var_dump($childImageFileName);
     * var_dump(trim($request->getPost('childsname','')));
     * var_dump(trim($request->getPost('childsname','')));
     * var_dump(trim($request->getPost('bodytype','')));
     * var_dump(trim($request->getPost('skincolor','')));
     * var_dump(trim($request->getPost('eyestype','')));
     * var_dump(trim($request->getPost('eyescolor','')));
     * var_dump(trim($request->getPost('hairtype','')));
     * var_dump(trim($request->getPost('haircolor','')));
     * var_dump(trim($request->getPost('glasses','')));
     * var_dump(trim($request->getPost('freckles','')));
     * var_dump(trim($request->getPost('lovenote','')));
     */
    echo '<div class="grid_row clearfix" style="padding-top: 30px;">
				<div class="grid_col grid_col_12">
					<div class="ce clearfix">
						<div>
							<h3 class="ce_title">An error occurred. Please return to the book editor and try again. (Do not use the browser\'s back button, otherwise this error is likely to recur.)</h3>
						</div>
					</div>
				</div>
			</div>';
} else {
    $cart = json_decode($_COOKIE['carts'], true);
    $getCart= isset($cart[$id])?$cart[$id]:null;
    if($getCart===null)
    {
        
        echo '<div class="grid_row clearfix" style="padding-top: 30px;">
				<div class="grid_col grid_col_12">
					<div class="ce clearfix">
						<div>
							<h3 class="ce_title">Book not found</h3>
						</div>
					</div>
				</div>
			</div>';
        
    }else {
        
    
    $count = count($cart);
    $type= $getCart['type'];
    if($type==1){
        $childImageFileName = $getCart['childspicture'];
        $childsImage = '<img src="upload/' . $childImageFileName . '" class="lovenotechildspicture" style="max-width:100% !important;" />';
        ;
    }
   

    // var_dump(urldecode($request->getPost('lovenote','')));
    // var_dump(html_entity_decode(str_replace('<br>',"\n",$request->getPost('lovenote',''))));
    // var_dump(str_replace('<br>',"\n",$request->getPost('lovenote','')));
    ?>
                       <div class='grid_row clearfix'>
			<div class='grid_col grid_col_12'>

				  <div class="row">
                  <div class="col-md-12" style="text-align: right;">
                                  <a href="<?=$SWIM['basepath']?>checkout?t=<?=time()?>" class="applyCouponCode">
                                         Return to Cart >> </a>
                                </div>
                                <br><br>
              </div>
				<div class='ce clearfix'>
					<div>
						<div class="woocommerce">
							<div class="grid_row clearfix">
								<!-- checkout form -->
							
									<h3 id="order_review_heading">Your order</h3>
									<div id="order_review"
										class="woocommerce-checkout-review-order">
										<!-- order list -->
										<table
											class="shop_table woocommerce-checkout-review-order-table">
											<thead>
												<tr>
													<th class="product-name">Product</th>
													<th class="product-total">Total</th>
												</tr>
											</thead>
											<tbody>
												<tr class="cart_item">
													<td class="product-name">Book <strong
														class="product-quantity">&times; 1</strong>
													</td>
													<td class="product-total"><span class="amount">$<?=number_format($getCart['amount'],2)?></span>
													</td>
												</tr>

                                                  <?php if($type==1){?>
												<tr class="cart_item">
													<td class="product-name" colspan="2"><input type="hidden"
														name="childsname" id="childsname"
														value="<?php echo htmlentities($getCart['childsname']);?>" />
														<input type="hidden" name="childspicture"
														id="childspicture"
														value="<?php echo htmlentities($childImageFileName);?>" />
														<input type="hidden" name="childsnameinput"
														id="childsnameinput"
														value="<?php echo $getCart['childsnameinput'];?>" /> <input
														type="hidden" name="bodytype" id="selectedbodytype"
														value="<?php echo htmlentities($getCart['bodytype']);?>" />
														<input type="hidden" name="skincolor"
														id="selectedskincolor"
														value="<?php echo htmlentities($getCart['skincolor']);?>" />
														<input type="hidden" name="eyestype" id="selectedeyestype"
														value="<?php echo htmlentities($getCart['eyestype']);?>" />
														<input type="hidden" name="eyescolor"
														id="selectedeyescolor"
														value="<?php echo htmlentities($getCart['eyescolor']);?>" />
														<input type="hidden" name="hairtype" id="selectedhairtype"
														value="<?php echo htmlentities($getCart['hairtype']);?>" />
														<input type="hidden" name="haircolor"
														id="selectedhaircolor"
														value="<?php echo htmlentities($getCart['haircolor']);?>" />
														<input type="hidden" name="glasses" id="selectedglasses"
														value="<?php echo htmlentities($getCart['glasses']);?>" />
														<input type="hidden" name="freckles" id="selectedfreckles"
														value="<?php echo htmlentities($getCart['freckles']);?>" />
														<input type="hidden" name="lovenote" id="lovenotenote"
														value="<?php echo htmlentities($getCart['lovenote'])?>" />
	
<?php
$pages = isset($getCart['pages']) ? $getCart['pages'] : null;

    if ($pages !== null) {
        if (! is_array($pages)) {
            $pages = [
                $pages
            ];
        }

        foreach ($pages as $k => $v)
            echo '<input class="hiddenpagesinput" type="hidden" value="' . $v . '" name="pages[]" />';
    }
    ?>


<style type="text/css">
.pageline {
	margin-right: -1px;
	margin-left: -1px
}

#characterpagesarea {
	width: 920px;
	height: 320px;
}

#characterpagesarea .page {
	width: 400px;
	height: 300px;
	background-color: white;
	line-height: 300px;
	font-size: 20px;
	text-align: center;
}

#characterpagesarea .page-wrapper {
	-webkit-perspective: 2000px;
	-moz-perspective: 2000px;
	-ms-perspective: 2000px;
	-o-perspective: 2000px;
	perspective: 2000px;
}

#characterpagesarea .hard {
	background: #ccc !important;
	color: #333;
	-webkit-box-shadow: inset 0 0 5px #666;
	-moz-box-shadow: inset 0 0 5px #666;
	-o-box-shadow: inset 0 0 5px #666;
	-ms-box-shadow: inset 0 0 5px #666;
	box-shadow: inset 0 0 5px #666;
	font-weight: bold;
}

#characterpagesarea .odd {
	background: -webkit-gradient(linear, right top, left top, color-stop(0.95, #FFF),
		color-stop(1, #DADADA));
	background-image: -webkit-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
	background-image: -moz-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
	background-image: -ms-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
	background-image: -o-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
	background-image: linear-gradient(right, #FFF 95%, #C4C4C4 100%);
	-webkit-box-shadow: inset 0 0 5px #666;
	-moz-box-shadow: inset 0 0 5px #666;
	-o-box-shadow: inset 0 0 5px #666;
	-ms-box-shadow: inset 0 0 5px #666;
	box-shadow: inset 0 0 5px #666;
}

#characterpagesarea .even {
	background: -webkit-gradient(linear, left top, right top, color-stop(0.95, #fff),
		color-stop(1, #dadada));
	background-image: -webkit-linear-gradient(left, #fff 95%, #dadada 100%);
	background-image: -moz-linear-gradient(left, #fff 95%, #dadada 100%);
	background-image: -ms-linear-gradient(left, #fff 95%, #dadada 100%);
	background-image: -o-linear-gradient(left, #fff 95%, #dadada 100%);
	background-image: linear-gradient(left, #fff 95%, #dadada 100%);
	-webkit-box-shadow: inset 0 0 5px #666;
	-moz-box-shadow: inset 0 0 5px #666;
	-o-box-shadow: inset 0 0 5px #666;
	-ms-box-shadow: inset 0 0 5px #666;
	box-shadow: inset 0 0 5px #666;
}
</style>
														<style type="text/css">
#pageselectors {
	position: relative;
	text-align: center;
}

#pageselectors img {
	border-radius: 36px;
	border: 2px solid #fff;
	margin: 5px;
}

.lSSlideOuter {
	width: 0px;
	display: none;
	visibility: hidden;
}
.lSPrev
,
.lSNext
</style>

														<div class="hero-section bg-cover" id="hero-section">
															<div>
																<div id="charactereditorarea" class="noprint"
																	style="width: 0px; display: none; visibility: hidden;">
																	<input id="childsnameinput" class="form-control mb-3"
																		type="text" style="position: relative"
																		placeholder="Child's Name" />
																	<div id="characterdisplay">
									<div id="partselectors">
																			<div id="hairselectorarea">
																				<div id="hairselector">
																					<div class="hid">
																						<img src="i/buttons/Green.png" />
																					</div>
																					<div class="sho">
																						<img src="i/buttons/Green-Hair-Cover.png" />
																					</div>
																				</div>
																			</div>

																			<div id="hisabselectorarea"><div id="hisabselector"><div class="hid"><img src="i/buttons/Green.png" /></div><div class="sho"><img src="i/buttons/Green-Hair-Cover.png" /></div></div></div>
																			
																			<div id="eyeselectorarea">
																				<div id="eyeselector">
																					<div class="hid">
																						<img src="i/buttons/Blue.png" />
																					</div>
																					<div class="sho">
																						<img src="i/buttons/Blue-Eyes.png" />
																					</div>
																				</div>
																			</div>
																			<div id="extrasselectorarea">
																				<div id="extrasselector">
																					<div class="hid">
																						<img src="i/buttons/Pink.png" />
																					</div>
																					<div class="sho">
																						<img src="i/buttons/Pink-Extras.png" />
																					</div>
																				</div>
																			</div>
																			<div id="bodyselectorarea">
																				<div id="bodyselector">
																					<div class="hid">
																						<img src="i/buttons/Teal.png" />
																					</div>
																					<div class="sho">
																						<img src="i/buttons/Teal-Body.png" />
																					</div>
																				</div>
																			</div>
																		</div>
																		<img id="eyeimg"
																			src="i/character/Eyes/EyesEyelashes/EyesEyelashesBlue.png"
																			height="108" width="108" /> <img id="bodyimg"
																			src="i/character/FullbodyStanding/fullbodyst1.png"
																			height="365" width="137" /> <img id="frecklesimg"
																			src="i/character/Freckles/Freckles.png" height="32"
																			width="103" /> <img id="glassesimg"
																			src="i/character/Glasses/Glasses1.png" height="27.05"
																			width="108" /> <img id="hairimg"
																			src="i/character/Hair/LongBraidsDown/LongBraidsDownDarkBrown.png"
																			height="288" width="144" />
																	</div>
																	<div id="hairselect">
																		<li style="height: 50px">&nbsp;</li>
																		<li><img class="hairselimg"
																			src="./i/character/Hair/Cornrow/cornrowblack.png"
																			height="50px" data-value="0" /></li>
																		<li><img class="hairselimg"
																			src="./i/character/Hair/Hijab/Hijabblack.png"
																			height="50px" data-value="1" /></li>
																		<li><img class="hairselimg"
																			src="./i/character/Hair/LongBraidsDown/LongBraidsDownBlack.png"
																			height="50px" data-value="2" /></li>
																		<li><img class="hairselimg"
																			src="./i/character/Hair/LongPonytail/LongPonytailBlack.png"
																			height="50px" data-value="3" /></li>
																		<li><img class="hairselimg"
																			src="./i/character/Hair/MedAfro/MedAfroblack.png"
																			height="50px" data-value="4" /></li>
																		<li><img class="hairselimg"
																			src="./i/character/Hair/MedCurlyPomsDown/MedCurlyPomsDownBlack.png"
																			height="50px" data-value="5" /></li>
																		<li><img class="hairselimg"
																			src="./i/character/Hair/MedPigtail/Medpigtailblack.png"
																			height="50px" data-value="6" /></li>
																		<li><img class="hairselimg"
																			src="./i/character/Hair/MedPuffsUp/MedPuffsUpBlack.png"
																			height="50px" data-value="7" /></li>
																		<li><img class="hairselimg"
																			src="./i/character/Hair/MedSpikey/MedSpikeyHairBlack.png"
																			height="50px" data-value="8" /></li>
																		<li><img class="hairselimg"
																			src="./i/character/Hair/ShortCurlyHair/ShortCurlyHairBlack.png"
																			height="50px" data-value="9" /></li>
																		<li><img class="hairselimg"
																			src="./i/character/Hair/ShortHair/Shorthairblack.png"
																			height="50px" data-value="10" /></li>
																		<li><img class="hairselimg"
																			src="./i/character/Hair/ShortHairWavy/Shorthairwavyblack.png"
																			height="50px" data-value="11" /></li>
																		<li><img class="hairselimg"
																			src="./i/character/Hair/ShortSpikeyHair/ShortSpikeyHairBlack.png"
																			height="50px" data-value="12" /></li>
																		<li style="height: 50px">&nbsp;</li>
																	</div>
																	<div id="haircolorselect">
																		<li style="height: 50px">&nbsp;</li>
																		<li>
																			<div id="haircolorselector0"
																				class="haircolorselector" data-value="0"></div>
																		</li>
																		<li>
																			<div id="haircolorselector2"
																				class="haircolorselector" data-value="2"></div>
																		</li>
																		<li>
																			<div id="haircolorselector4"
																				class="haircolorselector" data-value="4"></div>
																		</li>
																		<li>
																			<div id="haircolorselector3"
																				class="haircolorselector" data-value="3"></div>
																		</li>
																		<li>
																			<div id="haircolorselector1"
																				class="haircolorselector" data-value="1"></div>
																		</li>

																		<li>
																			<div id="haircolorselector6"
																				class="haircolorselector" data-value="6"></div>
																		</li>
																		<li>
																			<div id="haircolorselector5"
																				class="haircolorselector" data-value="5"></div>
																		</li>
																		<li style="height: 50px">&nbsp;</li>
																	</div>
																	<div id="bodyselect">
																		<li style="height: 50px">&nbsp;</li>
																		<li><img class="bodyselimg"
																			src="./i/character/FullbodyStanding/fullbodyst1.png"
																			height="50px" data-value="0" /></li>
																		<li><img class="bodyselimg"
																			src="./i/character/FullBodyWheelchair/FullbodywheelchairStackedST1.png"
																			height="50px" data-value="1" /></li>
																		<li style="height: 50px">&nbsp;</li>
																	</div>
																	<div id="bodycolorselect">
																		<li style="height: 50px">&nbsp;</li>
																		<li>
																			<div id="bodycolorselector0"
																				class="bodycolorselector" data-value="0"></div>
																		</li>
																		<li>
																			<div id="bodycolorselector1"
																				class="bodycolorselector" data-value="1"></div>
																		</li>
																		<li>
																			<div id="bodycolorselector2"
																				class="bodycolorselector" data-value="2"></div>
																		</li>
																		<li>
																			<div id="bodycolorselector3"
																				class="bodycolorselector" data-value="3"></div>
																		</li>
																		<li>
																			<div id="bodycolorselector4"
																				class="bodycolorselector" data-value="4"></div>
																		</li>
																		<li>
																			<div id="bodycolorselector5"
																				class="bodycolorselector" data-value="5"></div>
																		</li>
																		<li style="height: 50px">&nbsp;</li>
																	</div>
																	<div id="eyesselect">
																		<li style="height: 50px">&nbsp;</li>
																		<li><img class="eyesselectimg"
																			src="./i/character/Eyes/Eyes/1EyesBlue-01.png"
																			height="50px" data-value="0" /></li>
																		<li><img class="eyesselectimg"
																			src="./i/character/Eyes/EyesEyelashes/2EyesBlueLashes-01.png"
																			height="50px" data-value="1" /></li>
																		<li style="height: 50px">&nbsp;</li>
																	</div>
																	<div id="eyecolorselect">
																		<li style="height: 50px">&nbsp;</li>
																		<li>
																			<div id="eyecolorselector0" class="eyecolorselector"
																				data-value="0"></div>
																		</li>
																		<li>
																			<div id="eyecolorselector1" class="eyecolorselector"
																				data-value="1"></div>
																		</li>
																		<li>
																			<div id="eyecolorselector2" class="eyecolorselector"
																				data-value="2"></div>
																		</li>
																		<li>
																			<div id="eyecolorselector3" class="eyecolorselector"
																				data-value="3"></div>
																		</li>
																		<li>
																			<div id="eyecolorselector4" class="eyecolorselector"
																				data-value="4"></div>
																		</li>
																		<li style="height: 50px">&nbsp;</li>
																	</div>

																	<div id="glassesselect">
																		<li style="height: 50px">&nbsp;</li>
																		<li>
																			<div id="glassesselectornull"
																				class="glassesselector  xselector" data-value="">X</div>
																		</li>  <li>
                                       <img id="glassesselector0" class="glassesselector" src="./i/character/Glasses/Glasses1.png" width="80" height="" data-value="1" />
                                    </li>

                                      <li>
                                       <img id="glassesselector1" class="glassesselector" src="./i/character/Glasses/Glasses2.png" width="80" height="" data-value="2" />
                                    </li>

                                      <li>
                                       <img id="glassesselector2" class="glassesselector" src="./i/character/Glasses/Glasses3.png" width="80" height="" data-value="3" />
                                    </li>

                                      <li>
                                       <img id="glassesselector3" class="glassesselector" src="./i/character/Glasses/Glasses4.png" width="80" height="" data-value="4" />
                                    </li>
																		<li style="height: 50px">&nbsp;</li>
																	</div>
																	<div id="frecklesselect">
																		<li style="height: 50px">&nbsp;</li>
																		<li>
																			<div id="frecklesselectornull"
																				class="frecklesselector xselector" data-value="">X</div>
																		</li>
																		<li><img id="frecklesselector0"
																			class="frecklesselector"
																			src="./i/character/Freckles/Freckles.png"
																			height="40px" data-value="0" /></li>
																		<li style="height: 50px">&nbsp;</li>
																	</div>
																</div>

																<div id="pageselectors" class="noprint"
																	style="width: 0px; display: none; visibility: hidden;">
																	<div>
																		<img data-pagenumber="1" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/Airship.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="2" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/Basketball.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="3" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/Bedtime.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="4" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/Camping.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="5" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/superhero.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="6" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/Crossroads.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="7" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/Dragon.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="8" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/Fishing.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="9" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/Mermaid.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="10" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/Music.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="11" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/Painting.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="12" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/PickingFlowers.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="13" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/Playground.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="14" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/RainbowSlide.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="15" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/Pirates.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="16" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/Space.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="17" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/StarGazing.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="18" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/TreeClimbing.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="19" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/Unicorn.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																	<div>
																		<img data-pagenumber="20" width="72" height="72"
																			src="<?php echo $SWIM['basepath'];?>i/spreadselectors/Wheels.png?v=<?php echo $SWIM['version'];?>" />
																	</div>
																</div>
<?php echo pageSpreadsHtml($childsImage);?>
<div class="noprint"
																	style="width: 100%; text-align: center; position: relative; font-weight: bold; font-size: 27px;"></div>
																<link rel="stylesheet" type="text/css"
																	href="./c/lightslider.min.css" />
																<script language="javascript" type="text/javascript"
																	src="./j/lightslider.min.js"></script>


															</div>
														</div>
												
												</tr><?php }else { ?>
												
												<tr class="cart_item">
													<td class="product-name" colspan="2">
													 <img id="pagebackground0" class="coverpage-right" src="<?php echo $SWIM['basepath'];?>pic/revslider/general/RiversBigAdventureWebBook.png"  width="100%">
													</td></tr>
													<?php 
												    
												    

												}


													?>
                                                   

 

											</tbody>
											
										</table>
										<!-- / order list -->




									</div>
								
							



							




								



							</div>
						</div>
					</div>
				</div>


























<?php
    } }
?>
					
		
		</main>
		<div class='right-pattern pattern pattern-2'></div>
		<!-- pattern conatainer / -->
	</div>
</div>
<!-- main container -->
<?php
echo siteFooter();
?>
</body>
</html>