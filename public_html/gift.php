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
						<h1>Gift</h1>
					</div>
					<nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">Gift</span></nav>
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
										<p>Cosmic Unicorn's personalized books are excellent gifts for every occasion or JUST FOR FUN! There are so many awesome opportunities for a beautiful gift!</p>
									</div>
								</div>
							</div>
						</div>
						<!-- / section -->



						<!-- section -->
						<div class='grid_row clearfix' style='padding-top: 30px;'>
							<div class='grid_col grid_col_4'>
								<div class='ce clearfix'>
									<div><img class="noborder alignnone image-type size-full" src="client/images/banner/M_penguin_Gift_20120503.gif" alt="kid_playing" width="385" height="373" /></div>
								</div>
							</div>
							<div class='grid_col grid_col_4'>
								<!-- about us -->
								<div class='ce clearfix'>
									<div>
										<ul class="checkmarks_style">
											<li>Birthday Gift</li>
											<li>Graduation Gift</li>
											<li>New Years Gift</li>
											<li>Kwanzaa Gift</li>
											<li>Hanukkah Gift</li>
											<li>Purim Gift</li>
											<li>Chinese New Year Gift</li>
											<li>Ochugen Gift</li>
											<li>Oseibo Gift</li>
											<li>Christmas Gift</li>
											<li>Easter Gift</li>
											<li>Valentine's Day Gift</li>
											<li>Get Well Soon Gift</li>
											<li>Diwali or Deepavali Gift</li>
											<li>Eid al-Fitr</li>
											<li>Pancha Ganapati</li>
											<li>OR JUST FOR FUN!</li>
										</ul>

					<form action="<?php echo $SWIM['basepath']?>#charactereditorarea" method="GET">
						<p class="form-row">
							<input type="submit" class="button" value="Design your Book Now">
						</p>
					</form>
									</div>
								</div>
								<!-- / about us -->
							</div>
							<div class='grid_col grid_col_4'>
								<a href="<?php echo $SWIM['basepath']?>gift-up"><img src="pic/revslider/general/Gift_Certificate.jpg">
								</a>
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
