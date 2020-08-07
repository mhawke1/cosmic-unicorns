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
						<h1>FAQ</h1>
					</div>
					<nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">FAQ</span></nav>
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
										<p>Greetings Fellow Unicorns!</p>
										<p>Are you having difficulty ordering? Have another question? If your questions aren't answered with the FAQ below, please reach out and we will gladly assist you.</p>
										<p>E-mail address: <a href="mailto:info@cosmicunicorns.com">info@cosmicunicorns.com</a><br/>We return emails within 24 hours</p>
										<h3 class="ce_title">What is a personalized book?</h3>
										<p>A personalized book puts YOUR favorite unicorn as the star of the story. You enter the child's name and then select their skin tone, hair style, eye color, whether they have freckles, or wear glasses or use a wheelchair (even more customization options in progress). Then you select 10 of their favorite interests or your favorite short stories and a totally custom personalized book is created for you! You proof the book right away, approve it and it's sent to the cosmic print house. Just like magic within 2 weeks your book arrives at your doorstep.</p>
										<h3 class="ce_title">How do I proof the book after making my customization selections?</h3>
										<p>After you customize your character, select your stories, add a personal dedication and upload a photo the cosmic magic that is digital technology creates a proof within a few seconds. You'll be able to turn page by page and review everything before approving.</p>
										<h3 class="ce_title">What ages are Cosmic Unicorns children's books intended for?</h3>
										<p>Cosmic Unicorn books are written with children 3-10 in mind, but if you're a goofy adult like us, we'd love a custom book with our inner child character, so I guess you gotta know your audience.</p>
										<h3 class="ce_title">Can I also add a personal message or dedication?</h3>
										<p>Yes! The last page is reserved for a special message to your intended gift recipient and you can upload your favorite picture to go along with it.</p>
										<h3 class="ce_title">How fast will I receive the package?</h3>
										<p>After completing your order, proofing and approving and successfully paying you can expect your book to magically appear on your doorstep!</p>

					<form action="<?php echo $SWIM['basepath']?>#charactereditorarea" method="GET">
						<p class="form-row">
							<input type="submit" class="button" value="Design your Book Now">
						</p>
					</form>


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
