<?php
	require_once 'swim.php';


	echo '<!DOCTYPE html>
<html lang="en-US">'.
	headerHTML('Cosmic Unicorns').'
	<body class="home page wide wave-style">
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TRBLWDG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
		<div class="page">'.
			topPanel();
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
								<a class="logo" href="./"><img src='i/logo.png' data-at2x='i/logo2x.png' alt /></a>
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
						<h1>Return Policy</h1>
					</div>
					<nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">Return Policy</span></nav>
					<!-- .breadcrumbs -->
				</div>
				<canvas class='breadcrumbs' data-bg-color='#f8f2dc' data-line-color='#f9e8b2'></canvas>
			</section>
			<!-- / breadcrumbs -->

			<!-- main container -->
			<div id="main" class="site-main">
				<div class="page_content">
					<!-- pattern conatainer / -->
					<div class='left-pattern pattern pattern-2'></div>
					<main>

						<!-- section -->
						<div class='grid_row clearfix' style='padding-top: 30px;'>
							<div class='grid_col grid_col_12'>
								<div class='ce clearfix'>
									<div>
										<h3 class="ce_title" style="text-align:center">RETURN POLICY</h3>
										<h3 class="ce_title">An order can only be refunded in the following cases:</h3>
										<p>If you have not received your order within 30 days of approved proof and completed payment or after the delivery of a damaged book. If you have received a damaged product please notify us right away but no later than 5 days after the receipt of damaged product. Please contact us at <a href="mail:info@cosmicunicorns.com">info@cosmicunicorns.com</a></p>
										<p>After the order has been approved, payment cleared and artwork sent to the printing house, a cancellation is unfortunately no longer possible, each book is custom and created with your child's name and unique character.</p>
										<p>If you receive a damaged product please return the product in its original packaging, we will provide you with a prepaid shipping label. Once your return is received, we can either ship our a replacement book or a credit will be issued to the credit card used for payment of the original order. Shipping charges will not be refunded. Refunds typically take two (2) weeks to process, but may take longer during exceptionally busy times.</p>
										<p>The general terms and conditions provide no right for the return or refund for proofed, approved and paid custom products that have neither defects nor errors.</p>
										<h3 class="ce_title">If you need to change the personalization after you have placed the order</h3>
										<p>Once your order is proofed and submitted for print and payment clears the order is sent immediately to the print house. If you contact us within 1 hour we can usually stop the printing but cannot guarantee that is possible. Please please please proof the content carefully to ensure accuracy for your final product.</p>
										<h3 class="ce_title">Accuracy of the website content</h3>
										<p>We make every effort to keep the content of the website up to date, but cannot guarantee its accuracy and completeness. We reserve the right to make changes at any time without prior notice to the content of the website or to the listed products, prices or fees. Site content may be outdated and we assume no obligation to update it. This also applies, above all, to the presentation of the products offered, which may differ from the actual appearance of the products. This does not constitute a valid reason for a revocation of goods. Certain content of the website may come from third parties. We cannot provide any guarantee or responsibility for the accuracy, completeness, timeliness or reliability of this content.</p>
										<h3 class="ce_title" style="text-align:center">PAYMENT METHODS</h3>
										<p>Cosmic Unicorns uses accepts all major credit cards, VISA, MC, AMEX and Discover.</p>
										
										<h3 class="ce_title" style="text-align:center">SHIPPING OPTIONS</h3>







										<!-- pricing table -->
										<div class='grid_row eq_cols' style='padding-bottom: 50px;'>
											<div class='grid_col grid_col_3'>
												<div class='title_section'>Delivery option</div>
												<div class='encouragement'>USPS Parcel Post</div>
											</div>
											<div class='grid_col grid_col_3'>
												<div class='title_section'>ARRIVES</div>
												<div class='encouragement'>Delivery with 2 weeks</div>
											</div>
											<div class='grid_col grid_col_3'>
												<div class='title_section'>PRICE</div>
												<div class='encouragement'>$5.00</div>
											</div>
											<div class='grid_col grid_col_3'>
												<div class='title_section'>CARRIER</div>
												<div class='encouragement'>USPS</div>
											</div>
										</div>
										<!-- / pricing table -->









										<p>Cosmic Unicorns books are created in a cosmic realm, far away, but we have unicorn magic on our side! We will get your customized book in your hands within two weeks.</p>
										<p>Please note that deliveries to Alaska and Hawaii may take longer than the arrival times stated in the table above.</p>
									</div>
								</div>
							</div>
						</div>
						<!-- / section -->

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
