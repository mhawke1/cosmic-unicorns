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
						<h1>How It Works</h1>
					</div>
					<nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">How It Works</span></nav>
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
							<div class='grid_col grid_col_4'>
								<div class='ce clearfix'>
									<div><img class="noborder alignnone image-type size-full" src="client/images/banner/turtle5-how-to-order.gif" alt="kid_playing" width="385" height="373" /></div>
								</div>
							</div>
							<div class='grid_col grid_col_8'>
								<!-- about us -->
								<div class='ce clearfix'>
									<div>
										<h2>Cosmic Unicorns personalized children's books puts <b>YOUR</b> favorite little unicorn as the hero of the story!</h2>
										<h3 class="ce_title">Customize your character</h3>
										<ul class="checkmarks_style">
											<li>Enter YOUR child's name</li>
											<li>Select their skin tone</li>
											<li>Select their hairstyle</li>
											<li>Select their eye color</li>
											<li>Freckles?</li>
											<li>Glasses?</li>
											
										</ul>
										<p>Cosmic Unicorn stories all embody the joy of fun and adventure while weaving positive and empowering messages throughout. Stories include teaching young people how to make tough decisions, the beauty of imagination, being the artist in your own life and being kind and inclusive.</p>
									</div>
								</div>
								<!-- / about us -->
							</div>
						</div>
						<!-- / section -->

						<!-- section -->
						<div class='grid_row clearfix' style='padding-top: 30px;'>
							<div class='grid_col grid_col_12'>
								<!-- about us -->
								<div class='ce clearfix'>
									<div>
										<h3 class="ce_title">Select your stories</h3>
										<ul class="checkmarks_style">
											<li>
												<span>Select 10 of your favorite mini-stories</span>
												<ul class="arrow_style">
													<li style="padding-left:50px">Some of the stories include riding a unicorn or a dragon, playing with friends at the playground, going to space, playing basketball, a bedtime routine, riding a rainbow slide, picking flowers, playing music, going on an adventure on a big ship, riding an airship, and so many more!</li>
												</ul>
											</li>
											<li>Add a personalized message dedication</li>
											<li>Upload a photo of your little unicorn</li>
										</ul>
										<p>Your book will generate with YOUR child's name, customized character, your personal message, and your child's photo. You'll see the final print image generated so you can proof it immediately! Once you review the magic that is your Cosmic Unicorn book you can approve it and it will be sent to print! You'll receive your book delivered to your house within 2 weeks.</p>


					<form action="<?php echo $SWIM['basepath']?>#charactereditorarea" method="GET">
						<p class="form-row">
							<input type="submit" class="button" value="Design your Book Now">
						</p>
					</form>



									</div>
								</div>
								<!-- / about us -->
							</div>
						</div>
						<!-- / section -->


						<div class='grid_row clearfix' style='padding-top: 30px;'>
							<div class='grid_col grid_col_12'>
								<div class='ce clearfix'>
									<div style="text-align:center;"><img class="noborder alignnone image-type size-full" src="client/images/banner/Dragon.gif" alt="kid_playing" width="385" height="373" /></div>
								</div>
							</div>
						</div>

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
