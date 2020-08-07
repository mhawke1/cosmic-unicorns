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
         <h1>Welcome</h1>
      </div>
      <nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">Welcome</span></nav>
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


         <section>
         	<div class='grid_row clearfix' style='padding-top: 30px;'>
            <div class='grid_col grid_col_12'>
               <div class='ce clearfix'>
               	<div class="welcome-img">
                  
               		<img src="img/MandiHawke-CosmicUnicorns-1001HiRes.jpg">
               		<h6 class="welcom-Maker-name">Chief Magic Maker</h6>
               		<p class="welcome-title">Cosmic Unicorns</p>
               		<div><img src="img/str.png"></div>
               	</div>
               </div>
              
            </div>
        </div>
         </section>


         <section class="bg-light1">
         	<div class='grid_row clearfix' >
            <div class='grid_col grid_col_12'>
               <div class='ce clearfix'>
               	<div class="welcome-socal">

               		<a href="https://www.instagram.com/cosmic_unicorns_official/" class="socalbtn">INSTAGRAM </a>
               		<a href="https://www.facebook.com/CosmicUnicorns/" class="socalbtn">FACEBOOK  </a>
               		<a href="https://twitter.com/UnicornsCosmic" class="socalbtn">TWITTER</a>
               		<a href="https://www.youtube.com/channel/UCvCNgK16TSoBWM2gy_qhhKw?view_as=subscriber" class="socalbtn">YOUTUBE </a>
               		<a href="https://www.tiktok.com/@cosmicunicorns" class="socalbtn">TIKTOK </a>
               		<a href="https://www.pinterest.com/cosmicunicorns" class="socalbtn">PINTEREST </a>
               		<a href="https://www.linkedin.com/in/mandi-hawke-36b4515a/" class="socalbtn">MANDI HAWKE LINKEDIN </a>
                  
               	
               	</div>
               </div>
              
            </div>
        </div>
         </section>



           <section >
         	<div class='grid_row clearfix' >
            <div class='grid_col grid_col_12'>
               <div class='ce clearfix'>
               	<div class="welcome">

               		<h2 class="welcome-heading">VIDEO ABOUT COSMIC UNICORNS</h2>

               		<iframe style="margin: 0 auto; display: block;" width="560" height="315" src="https://www.youtube.com/embed/uXYDFVqq-d0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  
               	       <div class="text-center-advntur">
               	       	<a class="welcome-adventure" href="https://www.flipsnack.com/cosmicunicorns/river-s-big-adventure.html">CHECK OUT RIVERS BIG ADVENTURE</a>
               	       </div>
               	</div>
               </div>
              
            </div>
        </div>
         </section>


         
        <!--  <div class='grid_row clearfix' style='padding-top: 30px;'>
            <div class='grid_col grid_col_12'>
               <div class='ce clearfix'>
                  <div>
                     <h3 class="ce_title" style="text-align:center">Cookie Policy for Cosmic Unicorns</h3>
                     <p>This is the Cookie Policy for Cosmic Unicorns, accessible from cosmicunicorns.com</p>
                     <h3 class="ce_title">What Are Cookies</h3>
                     <p>As is common practice with almost all professional websites this site uses cookies, which are tiny files that are downloaded to your computer, to improve your experience. This page describes what information they gather, how we use it and why we sometimes need to store these cookies. We will also share how you can prevent these cookies from being stored however this may downgrade or 'break' certain elements of the sites functionality.For more general information on cookies see the Wikipedia article on HTTP Cookies.</p>
                     <h3 class="ce_title">How We Use Cookies</h3>
                     <p>We use cookies for a variety of reasons detailed below. Unfortunately in most cases there are no industry standard options for disabling cookies without completely disabling the functionality and features they add to this site. It is recommended that you leave on all cookies if you are not sure whether you need them or not in case they are used to provide a service that you use.</p>
                     <h3 class="ce_title">Disabling Cookies</h3>
                     <p>You can prevent the setting of cookies by adjusting the settings on your browser (see your browser Help for how to do this). Be aware that disabling cookies will affect the functionality of this and many other websites that you visit. Disabling cookies will usually result in also disabling certain functionality and features of the this site. Therefore it is recommended that you do not disable cookies.</p>
                     <h3 class="ce_title">The Cookies We Set</h3>
                     <ul>
                        <li>
                           <span>Account related cookies</span>
                           <ul class="arrow_style" style="margin-left:10px">
                              <li>If you create an account with us then we will use cookies for the management of the signup process and general administration. These cookies will usually be deleted when you log out however in some cases they may remain afterwards to remember your site preferences when logged out.</li>
                           </ul>
                        </li>
                        <br />
                        <li>
                           <span>Login related cookies</span>
                           <ul class="arrow_style" style="margin-left:10px">
                              <li>We use cookies when you are logged in so that we can remember this fact. This prevents you from having to log in every single time you visit a new page. These cookies are typically removed or cleared when you log out to ensure that you can only access restricted features and areas when logged in.</li>
                           </ul>
                        </li>
                        <br />
                        <li>
                           <span>Email newsletters related cookies</span>
                           <ul class="arrow_style" style="margin-left:10px">
                              <li>This site offers newsletter or email subscription services and cookies may be used to remember if you are already registered and whether to show certain notifications which might only be valid to subscribed/unsubscribed users.</li>
                           </ul>
                        </li>
                        <br />
                        <li>
                           <span>Orders processing related cookies</span>
                           <ul class="arrow_style" style="margin-left:10px">
                              <li>This site offers e-commerce or payment facilities and some cookies are essential to ensure that your order is remembered between pages so that we can process it properly.</li>
                           </ul>
                        </li>
                        <br />
                        <li>
                           <span>Surveys related cookies</span>
                           <ul class="arrow_style" style="margin-left:10px">
                              <li>From time to time we offer user surveys and questionnaires to provide you with interesting insights, helpful tools, or to understand our user base more accurately. These surveys may use cookies to remember who has already taken part in a survey or to provide you with accurate results after you change pages.</li>
                           </ul>
                        </li>
                        <br />
                        <li>
                           <span>Forms related cookies</span>
                           <ul class="arrow_style" style="margin-left:10px">
                              <li>When you submit data to through a form such as those found on contact pages or comment forms cookies may be set to remember your user details for future correspondence.</li>
                           </ul>
                        </li>
                        <br />
                        <li>
                           <span>Site preferences cookies</span>
                           <ul class="arrow_style" style="margin-left:10px">
                              <li>In order to provide you with a great experience on this site we provide the functionality to set your preferences for how this site runs when you use it. In order to remember your preferences we need to set cookies so that this information can be called whenever you interact with a page is affected by your preferences.</li>
                           </ul>
                        </li>
                     </ul>
                     <h3 class="ce_title">Third Party Cookies</h3>
                     <p>In some special cases we also use cookies provided by trusted third parties. The following section details which third party cookies you might encounter through this site.</p>
                     <ul>
                        <li>
                           This site uses Google Analytics which is one of the most widespread and trusted analytics solution on the web for helping us to understand how you use the site and ways that we can improve your experience. These cookies may track things such as how long you spend on the site and the pages that you visit so we can continue to produce engaging content.
                           <br />
                           For more information on Google Analytics cookies, see the official Google Analytics page.
                        </li>
                        <br />
                        <li>
                           Third party analytics are used to track and measure usage of this site so that we can continue to produce engaging content. These cookies may track things such as how long you spend on the site or pages you visit which helps us to understand how we can improve the site for you.
                        </li>
                        <br />
                        <li>
                           From time to time we test new features and make subtle changes to the way that the site is delivered. When we are still testing new features these cookies may be used to ensure that you receive a consistent experience whilst on the site whilst ensuring we understand which optimizations our users appreciate the most.
                        </li>
                        <br />
                        <li>
                           As we sell products it's important for us to understand statistics about how many of the visitors to our site actually make a purchase and as such this is the kind of data that these cookies will track. This is important to you as it means that we can accurately make business predictions that allow us to monitor our advertising and product costs to ensure the best possible price.
                        </li>
                        <br />
                        <li>
                           The Google AdSense service we use to serve advertising uses a DoubleClick cookie to serve more relevant ads across the web and limit the number of times that a given ad is shown to you.
                           <br />
                           For more information on Google AdSense see the official Google AdSense privacy FAQ.
                        </li>
                        <br />
                        <li>
                           We use adverts to offset the costs of running this site and provide funding for further development. The behavioural advertising cookies used by this site are designed to ensure that we provide you with the most relevant adverts where possible by anonymously tracking your interests and presenting similar things that may be of interest.
                        </li>
                        <br />
                        <li>
                           We also use social media buttons and/or plugins on this site that allow you to connect with your social network in various ways. For these to work the following social media sites including; Facebook, Instagram, Snapchat, Twitter, will set cookies through our site which may be used to enhance your profile on their site or contribute to the data they hold for various purposes outlined in their respective privacy policies.
                        </li>
                     </ul>
                     <h3 class="ce_title">More Information</h3>
                     <p>Hopefully that has clarified things for you and as was previously mentioned if there is something that you aren't sure whether you need or not it's usually safer to leave cookies enabled in case it does interact with one of the features you use on our site. However if you are still looking for more information then you can contact us at <a href="mailto:info@cosmicunicorns.com">info@cosmicunicorns.com</a></p>
                  </div>
               </div>
            </div>
         </div> -->
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