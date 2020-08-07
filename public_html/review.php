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
                    <h1>Review</h1></div>
                <nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">Review</span></nav>
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

                       <script type="text/javascript"> (function e(){var e=document.createElement("script");e.type="text/javascript",e.async=!0, e.src="//staticw2.yotpo.com/r8J2iWjWOSRRwDXup8wh4RP9H4qGyLqfdb229u4j/widget.js";var t=document.getElementsByTagName("script")[0]; t.parentNode.insertBefore(e,t)})(); </script>
<div id='yotpo-testimonials-custom-tab'></div>


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
