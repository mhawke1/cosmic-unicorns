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
						<h1>About us</h1>
					</div>
					<nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">About Us</span></nav>
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
									<div><img class="noborder alignnone image-type size-full" src="client/images/banner/family.png" alt="kid_playing" width="385" height="373" /></div>
					
								</div>
							</div>
							<div class='grid_col grid_col_8'>
								<!-- about us -->
								<div class='ce clearfix'>
									<div>
										<h3 class="ce_title">About Us</h3>
										<p>Cosmic Unicorns is an idea born from the awareness that there are so few affirming representations available via customized children's books.</p>
										<p>There are SO MANY populations that are underrepresented in the media. While we want more than anything to change the world, it does not happen overnight, so this is one area in which we believe we can enact change! Being an author, artist, and a passionate social justice advocate, I gathered an amazing team of brilliant creatives, we put pencil to paper, and let the magic evolve.</p>
										<p>Each mini-story begins as an idea and a primitive stick figure sketch. Then, we add a little digital magic and you get what you now see as our final product! We are growing and expanding as quickly as possible and WELCOME your ideas for expansion.</p>
									</div>
								</div>
								<!-- / about us -->


							</div>
						</div>
						<!-- / section -->


						 <div class='grid_row clearfix' style='padding-top: 30px;'>

                        <div class='grid_col grid_col_4'>
                            <div class='ce clearfix'>
                                <div><img class="noborder alignnone image-type size-full" src="client/images/banner/Children-s-and-foil-colors.gif" alt="kid_playing" width="385" height="373" /></div>
                            </div>
                        </div>

                        <div class='grid_col grid_col_8'>
                            <!-- about us -->
                            <div class='ce clearfix'>
                                <div>
                                    <!--<h3 class="ce_title">A Few Words About <span >Our Center</span></h3>-->
                                    <p>Cosmic Unicorn's personalized children's book recognizes your little unicorn for what makes them beautiful and unique! We offer customization options that are not confined to the binary. We are LGBTQ+ inclusive, foster and adoptive family positive, and racial justice focused.</p>
                                    <p>We recognize that gender is on a spectrum and we provide a single androgynous child character. Rather than requiring you to select "male" or "female," we provide the options to customize skin tone, hair style, glasses, freckles, and more. New customization options will be added regularly!</p>
                                    <p>Our stories are built around inclusivity with a strong race and gender matters lens! We weave lessons around being an upstander to bullying, valuing diversity, exploring and adventure, learning how to make decisions, calm down when upset, and believing in our power to create our reality.</p>
                                    <p>We believe in magic and beauty and hope you do too!</p>
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


						
						
						
						
						
					<div class="grid_row clearfix">
                        <!-- contact form -->
                        <div class="grid_col grid_col_12">
                            <div class="ce clearfix">
                                <div>
                                    <div role="form" class="cf" id="cf-f16-p10-o1" lang="en-US" dir="ltr">
                                        <div class="screen-reader-response"></div>
										<h3 class="ce_title">Have an awesome idea? Please share!</h3>
										<form action="php/contacts-process.php" method="post" class="cf-form contact-form" novalidate="novalidate">
											<p>
												Name*
												<br>
												<span class="cf-form-control-wrap your-name"><input type="text" name="name" value="" size="107" class="cf-form-control cf-text cf-validates-as-required" aria-required="true" aria-invalid="false"></span>
											</p>
                                            <p>Email*
                                                <br>
                                                <span class="cf-form-control-wrap your-email"><input type="email" name="email" value="" size="107" class="cf-form-control cf-text cf-email cf-validates-as-required cf-validates-as-email" aria-required="true" aria-invalid="false"></span>
											</p>
                                            <p>Share your awesome idea
                                                <br>
                                                <span class="cf-form-control-wrap your-message"><textarea name="message" cols="107" rows="8" class="cf-form-control cf-textarea" aria-invalid="false"></textarea></span>
											</p>
                                            <p>
                                                <span class="captcha-wrapper">
                                                    <iframe src="php/capcha.php" class="capcha-frame" name="capcha_image_frame"></iframe>
                                                    <input class="verify" type="text" id="verify" name="verify">
                                                </span>
                                                <input type="submit" value="Send" class="cf-form-control cf-submit">
                                            </p>
                                            <div class="cws_msg_box error-box clearfix">
                                                <div class="icon_section"><i class="fa fa-exclamation"></i></div>
                                                <div class="content_section">
                                                    <div class="msg_box_title">Error box</div>
                                                    <div class="msg_box_text"></div>
                                                </div>
                                            </div>
                                        </form>
								</div>
							</div>
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
