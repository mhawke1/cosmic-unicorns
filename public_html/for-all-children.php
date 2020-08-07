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
                    <h1>For All Children</h1></div>
                <nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">For all Children</span></nav>
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
                    <!-- / section -->


                    <div class='grid_row clearfix' style='padding-top: 30px;'>
                        <div class='grid_col grid_col_12'>
                            <div class='ce clearfix'>
                                <div style="text-align:center;"><img class="noborder alignnone image-type size-full" src="client/images/banner/UnicornMagicImage.png" alt="kid_playing" width="385" height="373" /></div>
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
