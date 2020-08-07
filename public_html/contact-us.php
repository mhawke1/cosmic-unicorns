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
						<h1>Contact Us</h1>
					</div>
					<nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">Contact Us</span></nav>
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


<div class='grid_row clearfix'>
                        <!-- contact form -->
                        <div class='grid_col grid_col_12'>
                            <div class='ce clearfix'>
                                <div>
                                    <div role="form" class="cf" id="cf-f16-p10-o1" lang="en-US" dir="ltr">
                                        <div class="screen-reader-response"></div>
                                        <form action="php/contacts-process.php" method="post" class="cf-form contact-form" novalidate="novalidate">
						<p>
							Name*
							<br />
							<span class="cf-form-control-wrap your-name"><input type="text" name="name" value="" size="107" class="cf-form-control cf-text cf-validates-as-required" aria-required="true" aria-invalid="false" /></span>
						</p>
						<p>
							Subject*
							<br />
							<span class="cf-form-control-wrap your-name"><input type="text" name="name" value="" size="107" class="cf-form-control cf-text cf-validates-as-required" aria-required="true" aria-invalid="false" /></span>
						</p>
                                            <p>Email*
                                                <br />
                                                <span class="cf-form-control-wrap your-email"><input type="email" name="email" value="" size="107" class="cf-form-control cf-text cf-email cf-validates-as-required cf-validates-as-email" aria-required="true" aria-invalid="false" /></span> </p>
						<p>
							Reasons*
							<br />
							<span class="cf-form-control-wrap your-name">
								<select class="form-control mb-3" id="reasons" name="reasons" style="height: 60px;">
									<option value="0">Reasons</option>
									<option value="1">Issues with an order</option>
									<option value="2">Questions about products</option>
									<option value="3">Idea for new content</option>
									<option value="4">Something else</option>
								</select>
							</span>
						</p>
                                            <p>Message
                                                <br />
                                                <span class="cf-form-control-wrap your-message"><textarea name="message" cols="107" rows="8" class="cf-form-control cf-textarea" aria-invalid="false"></textarea></span> </p>
                                            <p>
                                                <span class="captcha-wrapper">
                                                    <iframe src="php/capcha.php" class="capcha-frame" name="capcha_image_frame"></iframe>
                                                    <input class="verify" type="text" id="verify" name="verify" />
                                                </span>
                                                <input type="submit" value="Send" class="cf-form-control cf-submit" />
                                            </p>
                                            <div class="cws_msg_box error-box clearfix">
                                                <div class="icon_section"><i class="fa fa-exclamation"></i></div>
                                                <div class="content_section">
                                                    <div class="msg_box_title">Error box</div>
                                                    <div class="msg_box_text"></div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="email_server_responce"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / conatct form -->
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