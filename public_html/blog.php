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
                    <h1>Blog</h1></div>
                <nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">Blog</span></nav>
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

                    <div class="powr-social-feed" id="b2867fa7_1594915303"></div><script src="https://www.powr.io/powr.js?platform=html"></script>

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
