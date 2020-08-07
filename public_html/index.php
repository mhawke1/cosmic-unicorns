<?php
   $pagedesc = 'Imagine your little unicorn as the star of the story! Add their';
   $picurl = 'i/logo2x.png';
   require_once 'swim.php';
   
   $request = new request();
   
   echo '<!DOCTYPE html>
   <html lang="en-US"><script type="text/javascript">var res="LoRes.jpg";</script>' . headerHTML('Cosmic Unicorns', ['j/turnjs4/extras/jquery.mousewheel.min.js', 'j/turnjs4/extras/modernizr.2.5.3.min.js', 'j/turnjs4/lib/hash.js', 'j/turnjs4/lib/scissor.js', 'j/turnjs4/lib/turn.html4.min.js', 'j/salowell-lib.js', 'j/0.js', 'j/bookpagescaling.js'], [
   //'client/css/style.css',
   'client/css/owl.carousel.min.css', 'client/css/justifiedGallery.min.css', 'client/css/owl.theme.default.min.css', 'c/0.css','css/responsive.css', 'css/lightslider.min.css'], [], $picurl, $pagedesc) . '
   	<body class="home page wide wave-style homePage">
      <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TRBLWDG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

  
   		<div class="page">' . topPanel();
   ?>
<!-- BEGIN PRIVY WIDGET CODE -->
<script type='text/javascript'> var _d_site = _d_site || '77099845CCCB31F272B72AD6'; </script>
<script src='https://widget.privy.com/assets/widget.js'></script>


<div class="mobile-view-error">
   <p>For Full Version Please Log Onto Desktop</p>
<p>For Mobile Version: Turn Horizontal to Flip through Book</p>
</div>
<!-- END PRIVY WIDGET CODE -->
<?=banner(); ?>
<!-- header container -->
<div class='slider_vs_menu'>
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
   <?php
      echo mainSlider();
      
      ?>
</div>
<?php if (!isset($_COOKIE['accept_cookie']))
   { ?>
<section id="cookies">
   <div>
      <h4>By using our site, you acknowledge that you have read and understood our <a href="cookies">Cookie Policy & Privacy Policy</a></h4>
      <a href="accept-cookie" class="accpetbtn">Got it</a>
   </div>
</section>
<?php
   } ?>
<!-- 
   <?php if (!isset($_COOKIE['accept_cookie']))
      { ?>
   	<div class="container">
   <div class="grid_row clearfix" style="padding-top: 30px;">
   							<div class="grid_col grid_col_12">
   								<div class="cookie-body">
   								
   								<h4>By using our site, you acknowledge that you have read and understood our <a href="cookies">Cookie Policy & Privacy Policy</a></h4>
   								 <a href="accept-cookie" class="accpetbtn">Got it</a>
   								<div>
   			
   								</div>
   								
   								
   								
   								
   								</div>
   							</div>
   						
   </div></div>
   <?php
      } ?> -->
<style type="text/css">
   .pageline{margin-right:-1px;margin-left:-1px}
   #characterpagesarea{
   width:920px;
   height:320px;
   }
   #characterpagesarea .page{
   width:400px;
   height:300px;
   background-color:white;
   line-height:300px;
   font-size:20px;
   text-align:center;
   }
   #characterpagesarea .page-wrapper{
   -webkit-perspective:2000px;
   -moz-perspective:2000px;
   -ms-perspective:2000px;
   -o-perspective:2000px;
   perspective:2000px;
   }
   #characterpagesarea .hard{
   background:#ccc !important;
   color:#333;
   -webkit-box-shadow:inset 0 0 5px #666;
   -moz-box-shadow:inset 0 0 5px #666;
   -o-box-shadow:inset 0 0 5px #666;
   -ms-box-shadow:inset 0 0 5px #666;
   box-shadow:inset 0 0 5px #666;
   font-weight:bold;
   }
   #characterpagesarea .odd{
   background:-webkit-gradient(linear, right top, left top, color-stop(0.95, #FFF), color-stop(1, #DADADA));
   background-image:-webkit-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
   background-image:-moz-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
   background-image:-ms-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
   background-image:-o-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
   background-image:linear-gradient(right, #FFF 95%, #C4C4C4 100%);
   -webkit-box-shadow:inset 0 0 5px #666;
   -moz-box-shadow:inset 0 0 5px #666;
   -o-box-shadow:inset 0 0 5px #666;
   -ms-box-shadow:inset 0 0 5px #666;
   box-shadow:inset 0 0 5px #666;
   }
   #characterpagesarea .even{
   background:-webkit-gradient(linear, left top, right top, color-stop(0.95, #fff), color-stop(1, #dadada));
   background-image:-webkit-linear-gradient(left, #fff 95%, #dadada 100%);
   background-image:-moz-linear-gradient(left, #fff 95%, #dadada 100%);
   background-image:-ms-linear-gradient(left, #fff 95%, #dadada 100%);
   background-image:-o-linear-gradient(left, #fff 95%, #dadada 100%);
   background-image:linear-gradient(left, #fff 95%, #dadada 100%);
   -webkit-box-shadow:inset 0 0 5px #666;
   -moz-box-shadow:inset 0 0 5px #666;
   -o-box-shadow:inset 0 0 5px #666;
   -ms-box-shadow:inset 0 0 5px #666;
   box-shadow:inset 0 0 5px #666;
   }
</style>
<style type="text/css">
   #pageselectors
   {
   position:relative;
   text-align:center;
   }
   
   .lSPrev,.lSNext
</style>
<!-- breadcrumbs -->
<section class='page_title wave'>
   <div>
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
         <div class='grid_row clearfix' style='padding-top: 30px;'>
            <div class='grid_col grid_col_12'>
               <div class='ce clearfix' id="imaginetextarea">
                  <img src="i/17E877FE-6602-4B15-80BE-097692ACE5FE.gif" style="margin-left:auto;margin-right:auto;display:block" />
                  <!--<h3 class="ce_title" style="text-align:center;">Imagine...</h3>
                     <h3 class="ce_title" style="text-align:center;">Your favorite little unicorn AS THE STAR of the book!</h3>
                     <h3 class="ce_title" style="text-align:center;">Create</h3>
                     <h3 class="ce_title" style="text-align:center;">YOUR CHILD'S</h3>
                     <h3 class="ce_title" style="text-align:center;">Next favorite book now!</h3>-->
               </div>
            </div>
         </div>
         <div id="goToEditor" class="grid_row clearfix" style="padding-top: 50px;padding-bottom: 50px;">
            <div class="grid_col grid_col_12">
               <div class="ce clearfix">
                  <div class="cws_callout" style="border:2px solid #5d5d5d;">
                     <div class="content_section">
                        <div class="hero-section bg-cover" id="hero-section">
                           <div>
                              <div id="charactereditorarea" class="noprint" style="margin-top:-210px;padding-top:210px;">
                                 <input id="childsnameinput" class="form-control mb-3" type="text" style="position:relative" placeholder="Child’s First Name"/>
                                 <div id="characterdisplay">
                                    <div id="partselectors">
                                       <div id="hairselectorarea">
                                          <div id="hairselector">
                                             <div class="hid">
                                                <div class="cws_fa_wrapper round">
                                                   <span class="ring"></span>
                                                   <div class="imgdiv"><img src="<?php echo $SWIM['basepath']; ?>fonts/fontawesomenew/hat-wizard.svg" /></div>
                                                </div>
                                             </div>
                                             <div class="sho">
                                                <div class="cws_fa_wrapper round">
                                                   <div class="text">Hair</div>
                                                   <div class="imgdiv mediaqin-mobileshow"><img style="max-width: 22px !important;" src="<?php echo $SWIM['basepath']; ?>fonts/fontawesomenew/hat-wizard.svg" /></div>
                                                   <i class="bodyiconmobile-chek fa fa-check"></i>
                                                   <span class="ring"></span>
                                                </div>
                                             </div>


 


                                           



                                          </div>
                                       </div>



                                        



                                          


                                       <div id="eyeselectorarea">
                                          <div id="eyeselector">
                                             <div class="hid">
                                                <div class="cws_fa_wrapper round"><span class="ring"></span><i class="cws_fa fa fa-1x fa-eye"></i></div>
                                             </div>
                                             <div class="sho">
                                                <div class="cws_fa_wrapper round">
                                                   <div class="text">Eyes</div>
                                                   <i class="bodyiconmobile-chek fa fa-check"></i>
                                                   <i class="cws_fa fa fa-1x fa-eye mediaqin-mobileshow"></i>
                                                   <span class="ring"></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>


                                       <div id="hisabselectorarea">
                                          <div id="hisabselector">
                                             <div class="hid">
                                                <div class="cws_fa_wrapper round">
                                                   <span class="ring"></span>
                                                   <div class="imgdiv">
                                                      
                                                      <img class="opera-icon" style="max-width: 22px !important;     margin-top: 13px;
    margin-left: 5px;" src="<?php echo $SWIM['basepath']; ?>fonts/fontawesomenew/Hijab-Selector-Image.png" />
                                                   </div>
                                                </div>
                                             </div>
                                           <div class="sho">
                                                <div class="cws_fa_wrapper hearcovring round">
                                                   <div class="text">Hair covering</div>
                                                   <div class="imgdiv mediaqin-mobileshow">
                                                      
                                                      <img  style="max-width: 22px !important;margin-top: 13px;
    margin-left: 5px;" src="<?php echo $SWIM['basepath']; ?>fonts/fontawesomenew/Hijab-Selector-Image.png" />
                                                   </div>
                                                   <i class="bodyiconmobile-chek fa fa-check"></i>
                                                   <span class="ring"></span>
                                                </div>
                                             </div>



                                           



                                          </div>
                                       </div>
                                       <div id="extrasselectorarea">
                                          <div id="extrasselector">
                                             <div class="hid">
                                                <div class="cws_fa_wrapper round"><span class="ring"></span><i class="cws_fa fa fa-1x fa-headphones"></i></div>
                                             </div>
                                             <div class="sho">
                                                <div class="cws_fa_wrapper round">
                                                   <div class="text">Extras</div>
                                                   <i class="cws_fa fa fa-1x fa-headphones mediaqin-mobileshow"></i>
                                                   <i class="bodyiconmobile-chek fa fa-check"></i>
                                                   <span class="ring"></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div id="bodyselectorarea">
                                          <div id="bodyselector">
                                             <div class="hid">
                                                <div class="cws_fa_wrapper round"><span class="ring"></span><i class="cws_fa fa fa-1x fa-child"></i></div>
                                             </div>
                                             <div class="sho">
                                                <div class="cws_fa_wrapper round">
                                                   <div class="text">Body</div>
                                                   <i class="cws_fa fa fa-1x fa-child mediaqin-mobileshow"></i>
                                                   <i class="bodyiconmobile-chek fa fa-check"></i>
                                                   <span class="ring"></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <img id="eyeimg" src="i/character/Eyes/EyesEyelashes/2EyesBlueLashes-01.png" height="55.5" width="83" />
                                    <img id="bodyimg" src="i/character/FullbodyStanding/fullbodyst1.png" height="365" width="137" />
                                    <img id="frecklesimg" src="i/character/Freckles/Freckles.png" height="32" width="103" />
                                    <img id="glassesimg" src="i/character/Glasses/Glasses1.png" height="27.05" width="108" />
                                    <img id="hairimg" src="i/character/Hair/LongBraidsDown/LongBraidsDownDarkBrown.png" height="288" width="144" />
                                 </div>

                                 <div class="hisabselect">

                                     <div class="showhisab">
                                       <img style="height:50px;" class="hairselimg" src="./i/character/Hair/Hijab/HijabBlack.png" height="50px" data-value="1" />
                                    </div>

                                 </div>
                                 

                                  <div id="hairselect">
                                    
                                      
                                

                                    <li class="showhair" style="height:50px">&nbsp;</li>
                                    <li class="showhair">
                                       <img class="hairselimg" src="./i/character/Hair/Cornrow/CornrowBlack.png" height="50px" data-value="0" />
                                    </li>
                                
                                    <li class="showhair">
                                       <img class="hairselimg" src="./i/character/Hair/LongBraidsDown/LongBraidsDownBlack.png" height="50px" data-value="2" />
                                    </li>
                                    <li class="showhair">
                                       <img class="hairselimg" src="./i/character/Hair/LongPonytail/LongPonytailBlack.png" height="50px" data-value="3" />
                                    </li>
                                    <li class="showhair">
                                       <img class="hairselimg" src="./i/character/Hair/MedAfro/MedAfroBlack.png" height="50px" data-value="4" />
                                    </li>
                                    <li class="showhair">
                                       <img class="hairselimg" src="./i/character/Hair/MedCurlyPomsDown/MedCurlyPomsDownBlack.png" height="50px" data-value="5" />
                                    </li>
                                    <li class="showhair">
                                       <img class="hairselimg" src="./i/character/Hair/MedPigtail/MedpigtailBlack.png" height="50px" data-value="6" />
                                    </li>
                                    <li class="showhair">
                                       <img class="hairselimg" src="./i/character/Hair/MedPuffsUp/MedPuffsUpBlack.png" height="50px" data-value="7" />
                                    </li>
                                    <li class="showhair">
                                       <img class="hairselimg" src="./i/character/Hair/MedSpikey/MedSpikeyHairBlack.png" height="50px" data-value="8" />
                                    </li>
                                    <li class="showhair">
                                       <img class="hairselimg" src="./i/character/Hair/ShortCurlyHair/ShortCurlyHairBlack.png" height="50px" data-value="9" />
                                    </li>
                                    <li class="showhair">
                                       <img class="hairselimg" src="./i/character/Hair/ShortHair/ShorthairBlack.png" height="50px" data-value="10" />
                                    </li>
                                    <li class="showhair">
                                       <img class="hairselimg" src="./i/character/Hair/ShortHairWavy/ShorthairwavyBlack.png" height="50px" data-value="11" />
                                    </li>
                                    <li class="showhair">
                                       <img class="hairselimg" src="./i/character/Hair/ShortSpikeyHair/ShortSpikeyHairBlack.png" height="50px" data-value="12" />
                                    </li>
                                
                                    <li class="showhair" style="height:50px">&nbsp;</li>
                                 </div>
                                 <div id="haircolorselect">
                                    <li style="height:50px">&nbsp;</li>
                                    <li>
                                       <div id="haircolorselector0" class="haircolorselector" data-value="0"></div>
                                    </li>
                                    <li>
                                       <div id="haircolorselector2" class="haircolorselector" data-value="2"></div>
                                    </li>
                                    <li>
                                       <div id="haircolorselector4" class="haircolorselector" data-value="4"></div>
                                    </li>
                                    <li>
                                       <div id="haircolorselector3" class="haircolorselector" data-value="3"></div>
                                    </li>
                                    <li>
                                       <div id="haircolorselector1" class="haircolorselector" data-value="1"></div>
                                    </li>
                                    <li>
                                       <div id="haircolorselector6" class="haircolorselector" data-value="6"></div>
                                    </li>
                                    <li>
                                       <div id="haircolorselector5" class="haircolorselector" data-value="5"></div>
                                    </li>
                                    <li style="height:50px">&nbsp;</li>
                                 </div>
                                 <div id="bodyselect">
                                    <li style="height:50px">&nbsp;</li>
                                    <li>
                                       <img class="bodyselimg" src="./i/character/FullbodyStanding/fullbodyst1.png" height="50px" data-value="0" />
                                    </li>
                                    <li>
                                       <img class="bodyselimg" src="./i/character/FullBodyWheelchair/FullbodywheelchairStackedST1.png" height="50px" data-value="1" />
                                    </li>
                                    <li style="height:50px">&nbsp;</li>
                                 </div>
                                 <div id="bodycolorselect">
                                    <li style="height:50px">&nbsp;</li>
                                    <li>
                                       <div id="bodycolorselector0" class="bodycolorselector" data-value="0"></div>
                                    </li>
                                    <li>
                                       <div id="bodycolorselector1" class="bodycolorselector" data-value="1"></div>
                                    </li>
                                    <li>
                                       <div id="bodycolorselector2" class="bodycolorselector" data-value="2"></div>
                                    </li>
                                    <li>
                                       <div id="bodycolorselector3" class="bodycolorselector" data-value="3"></div>
                                    </li>
                                    <li>
                                       <div id="bodycolorselector4" class="bodycolorselector" data-value="4"></div>
                                    </li>
                                    <li>
                                       <div id="bodycolorselector5" class="bodycolorselector" data-value="5"></div>
                                    </li>
                                    <li style="height:50px">&nbsp;</li>
                                 </div>
                                 <div id="eyesselect">
                                    <li style="height:50px">&nbsp;</li>
                                    <li>
                                       <img class="eyesselectimg" src="./i/character/Eyes/Eyes/1EyesBlue-01.png" height="50px" data-value="0" />
                                    </li>
                                    <li>
                                       <img class="eyesselectimg" src="./i/character/Eyes/EyesEyelashes/2EyesBlueLashes-01.png" height="50px" data-value="1" />
                                    </li>
                                    <li style="height:50px">&nbsp;</li>
                                 </div>
                                 <div id="eyecolorselect">
                                    <li style="height:50px">&nbsp;</li>
                                    <li>
                                       <div id="eyecolorselector0" class="eyecolorselector" data-value="0"></div>
                                    </li>
                                    <li>
                                       <div id="eyecolorselector1" class="eyecolorselector" data-value="1"></div>
                                    </li>
                                    <li>
                                       <div id="eyecolorselector2" class="eyecolorselector" data-value="2"></div>
                                    </li>
                                    <li>
                                       <div id="eyecolorselector3" class="eyecolorselector" data-value="3"></div>
                                    </li>
                                    <li>
                                       <div id="eyecolorselector4" class="eyecolorselector" data-value="4"></div>
                                    </li>
                                    <li style="height:50px">&nbsp;</li>
                                 </div>
                                 <div id="glassesselect">
                                    <li style="height:50px">&nbsp;</li>
                                    <li>
                                       <div id="glassesselectornull" class="glassesselector  xselector" data-value="">X</div>
                                    </li>
                                    <li>
                                       <img id="glassesselector0" class="glassesselector" src="./i/character/Glasses/Glasses1.png" width="108" height="" data-value="0" />
                                    </li>
                                    <li style="height:50px">&nbsp;</li>
                                 </div>
                                 <div id="frecklesselect">
                                    <li style="height:50px">&nbsp;</li>
                                    <li>
                                       <div id="frecklesselectornull" class="frecklesselector xselector" data-value="">X</div>
                                    </li>
                                    <li>
                                       <img id="frecklesselector0" class="frecklesselector" src="./i/character/Freckles/Freckles.png" height="40px" data-value="0" />
                                    </li>
                                    <li style="height:50px">&nbsp;</li>
                                 </div>
                              </div>
                              <form method="post" action="cart" id="checkoutform" enctype="multipart/form-data">
                                 <input type="hidden" name="childsname" id="childsname" value="<?php echo htmlentities($request->getGet('childsname', 0)); ?>" />
                                 <input type="hidden" name="bodytype" id="selectedbodytype" value="<?php echo htmlentities($request->getGet('bodytype', 0)); ?>" />
                                 <input type="hidden" name="skincolor" id="selectedskincolor" value="<?php echo htmlentities($request->getGet('skincolor', 1)); ?>" />
                                 <input type="hidden" name="eyestype" id="selectedeyestype" value="<?php echo htmlentities($request->getGet('eyestype', 0)); ?>" />
                                 <input type="hidden" name="eyescolor" id="selectedeyescolor" value="<?php echo htmlentities($request->getGet('eyescolor', 2)); ?>" />
                                 <input type="hidden" name="hairtype" id="selectedhairtype" value="<?php echo htmlentities($request->getGet('hairtype', 8)); ?>" />
                                 <input type="hidden" name="haircolor" id="selectedhaircolor" value="<?php echo htmlentities($request->getGet('haircolor', 3)); ?>" />
                                 <input type="hidden" name="glasses" id="selectedglasses" value="<?php echo htmlentities($request->getGet('glasses', 0)); ?>" />
                                 <input type="hidden" name="freckles" id="selectedfreckles" value="<?php echo htmlentities($request->getGet('freckles', 0)); ?>" />
                                 <input type="hidden" name="lovenote" id="lovenotenote" value="<?php echo htmlentities($request->getGet('lovenote', '')); ?>" />
                                 <!--<input type="hidden" name="freckles" id="lovenotefrom" value="<?php echo htmlentities($request->getGet('lovenotefrom', '')); ?>" />-->
                                 <p class="form-row">
                                    <!--<input id="checkoutbutton" type="submit" class="button" value="Checkout" style="display:none">-->
                                 </p>
                              </form>
                              <div id="bookpagesarealink" style="margin-top:-210px;padding-top:210px"></div>
                              <?php echo pageSpreadsHtml(); ?>
                              <h3 class="ce_title" style="color:#fff">Please select 10 stories you wish to include in your book.</h3>
                              <div id="pageselectors" class="noprint">
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="1"  class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/Airship.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Airship</div>
                                 </div>
                                 <div>

                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="2"  class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/Basketball.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Basketball</div>
                                 </div>
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="3"  class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/Bedtime.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Bedtime</div>
                                 </div>
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="4"  class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/Camping.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Camping</div>
                                 </div>
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="5" class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/superhero.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Superhero</div>
                                 </div>
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="6"  class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/Crossroads.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Crossroads</div>
                                 </div>
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="7"  class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/Dragon.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Dragon</div>
                                 </div>
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="8"  class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/Fishing.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Fishing</div>
                                 </div>
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="9"  class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/Mermaid.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Mermaid</div>
                                 </div>
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="10"  class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/Music.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Music</div>
                                 </div>
                                 <!--<div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="11" class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/Painting.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div>Painting</div>
                                    </div>-->
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="12" class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/PickingFlowers.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Picking Flowers</div>
                                 </div>
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="13" class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/Playground.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Playground</div>
                                 </div>
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="14" class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/RainbowSlide.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Rainbows</div>
                                 </div>
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="15" class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/Pirates.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Pirates</div>
                                 </div>
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="16" class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/Space.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Space</div>
                                 </div>
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="17" class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/StarGazing.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Nature</div>
                                 </div>
                                 <!--
                                    <div>
                                    	<div class="pagenumbercontainer"></div>
                                    	<div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    	<img data-pagenumber="18" class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/TreeClimbing.png?v=<?php echo $SWIM['version']; ?>" />
                                    	<div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    	<div>Climbing Trees</div>
                                    </div>
                                    -->
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="19" class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/Unicorn.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Unicorn</div>
                                 </div>
                                 <div>
                                    <div class="pagenumbercontainer"></div>
                                    <div class="crosscontainer"><i class="pageremovercross fa fa-times"></i></div>
                                    <img data-pagenumber="20" class="curl-img-slider-check" src="<?php echo $SWIM['basepath']; ?>i/spreadselectors/Wheels.png?v=<?php echo $SWIM['version']; ?>" />
                                    <div class="checkboxcontainer"><i class="pageselectorcheckbox fa fa-check"></i></div>
                                    <div class="story-title-name">Wheels</div>
                                 </div>
                              </div>
                              <div class="noprint" style="width:100%;text-align:center;position:relative;font-weight: bold;font-size:27px;"></div>
                              <link rel="stylesheet" type="text/css" href="./c/lightslider.min.css" />
                              <script language="javascript" type="text/javascript" src="./j/lightslider.min.js"></script>
                           </div>
                        </div>
                        <form id="tmpsubmitform">
                           <div id="booksubmissionerrormessagebox" class="cws_msg_box error-box clearfix" style="display:none">
                              <div class="icon_section"><i class="fa fa-exclamation"></i></div>
                              <div class="content_section">
                                 <div class="msg_box_title">Attention</div>
                                 <div class="msg_box_text"></div>
                              </div>
                           </div>
                           <div>We are SO EXCITED for the launch of Cosmic Unicorn’s Personalized Children’s Books! We anticipate our unicorns will be ready to ship your book by mid-June. We’ll send you an email as soon as your book is ready to ship!</div>



<div class='grid_row clearfix' style='padding-top: 30px;'>
            <div class='grid_col grid_col_12'>

                           <div class="text-center"><input id="checkoutbutton" type="submit" class="button pre-order-checkout" value="Preorder Now"></div>
            </div>
            
         </div>

                        </form>



                        
               <div class='grid_row clearfix' style='padding-top: 30px;'>
          
             <div class='grid_col grid_col_12'>

                           <div class="remove-cache"> <input id="delete_design" type="submit" class="button get-started" value="Delete Design"></div>
            </div>
         </div>
            

                       
                        
                        

                        


                     </div>
                     <div class="button_section">
                        <a href="#bookpagesarealink" class="cws_button xlarge" style="background-color:#fff;color:#000">
                           Click the right side of the book to start flipping through the pages.
                           <div class="button-shadow"></div>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- section -->
         <div class='grid_row clearfix' style='padding-top: 30px;'>
            <div class='grid_col grid_col_4'>
               <div class='ce clearfix'>
                  <div><img class="noborder alignnone image-type size-full" src="client/images/banner/UnicornMagicImage.png" alt="kid_playing" width="385" height="373" /></div>
               </div>
            </div>
            <div class='grid_col grid_col_8'>
               <!-- about us -->
               <div class='ce clearfix'>
                  <div>
                     <h3 class="ce_title">Why Cosmic Unicorns</h3>
                     <p>Cosmic Unicorns exist because families of all diverse make-ups deserve representation and inclusion.</p>
                     <p>Did you know that a study by the Cooperative Children’s Book Center found there were more children’s books featuring animals and other non-human characters than all types of visible minorities combined? Also, half of all the children’s books featured white children. This study did not cover religion, ability, or gender-variance (but, from experience, there are VERY few children books that honor gender creativity or provide representation for disabilities. And most books feature boys as the lead.

Cosmic Unicorns believes in celebrating what makes each of us unique. Our books encourage imagination, acceptance, and creativity while bathed in a personal growth and mindfulness framework.
</p>
<p>The core messages within Cosmic Unicorn’s books include:
 <ul><li>Mindfulness</li>
 <li>Integrity</li>
<li>Authenticity</li>
<li>Acceptance</li>
<li>Love</li>
<li>Thoughtfulness</li>
<li>Empathy</li>
<li>Adventure</li>
<li>Spontaneity</li>
<li>Imagination</li>
<li>Introspection</li>
</ul>
</p>

<p>Throughout our books, we use gender-neutral language and play clothing or character-themed outfits such as a mermaid, superhero, or pirate. Every child is different and this should be celebrated! </p>
<p>One of our primary goals is to keep adding as many inclusive customization options as possible because ALL CHILDREN deserve to see themselves represented in storybooks.</p>

<p  style="font-weight: bolder;">Every little unicorn is special!</p>

                     
                  </div>
               </div>
               <!-- / about us -->
            </div>
         </div>
         <!-- / section -->
         <!-- section -->

         <div class='grid_row clearfix' style='padding-top: 30px; text-align:center'>
            <div class='grid_col grid_col_12'>
     <iframe width="920" height="415" src="https://www.youtube.com/embed/-x1vpyJHfMo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
         </div>

        


         <div class='grid_row clearfix' style='padding-top: 30px;'>
            <div class='grid_col grid_col_12'>
               <div class='ce clearfix'>
                  <div>
                     <h3 class="ce_title">What Makes Cosmic Unicorns So Awesome?</h3>
                     <div class="whatmakesawesomerow grid_row clearfix">
                        <!-- callout -->
                        <div class="grid_col grid_col_4">
                           <div class="ce clearfix">
                              <div class="cws_callout">
                                 <div class="content_section">
                                    <div class="woocommerce">
                                       <div class="media_part" style="border-color:#176c81 !important;border-width:2px;border-radius:9px">
                                          <div class="pic">
                                             <img src="<?php echo $SWIM['basepath']; ?>client/images/courses/FeaturesPhotos1.png" />
                                          </div>
                                       </div>
                                    </div>
                                    <div class="callout_title">
                                       <div class="bees bees-end"><span></span></div>
                                       Stories Teach Important Values
                                    </div>
                                    <div class="separate"></div>
                                    <div class="callout_text">
                                       <p>Stories include positive messages and values such as gratitude, kindness, cultivating a sense of adventure, and how to calm down.</p>
                                    </div>
                                 </div>
                                 <div class="button_section">
                                    <a href="<?php echo $SWIM['basepath']; ?>about-us" class="cws_button xlarge">
                                       About Us
                                       <div class="button-shadow"></div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- / callout -->
                        <!-- callout -->
                        <div class="grid_col grid_col_4">
                           <div class="ce clearfix">
                              <div class="cws_callout">
                                 <div class="content_section">
                                    <div class="woocommerce">
                                       <div class="media_part" style="border-color:#176c81 !important;border-width:2px;border-radius:9px">
                                          <div class="pic">
                                             <img src="<?php echo $SWIM['basepath']; ?>client/images/courses/FeaturesPhotos5.png" />
                                          </div>
                                       </div>
                                    </div>
                                    <div class="callout_title">
                                       <div class="bees bees-end"><span></span></div>
                                       Shipping Across US
                                    </div>
                                    <div class="separate"></div>
                                    <div class="callout_text">
                                       <p>Each cosmically awesome custom book ships to you anywhere across the US.</p>
                                    </div>
                                 </div>
                                 <div class="button_section">
                                    <a href="<?php echo $SWIM['basepath']; ?>return-policy" class="cws_button xlarge">
                                       Shipping
                                       <div class="button-shadow"></div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- / callout -->
                        <!-- callout -->
                        <div class="grid_col grid_col_4">
                           <div class="ce clearfix">
                              <div class="cws_callout">
                                 <div class="content_section">
                                    <div class="woocommerce">
                                       <div class="media_part" style="border-color:#176c81 !important;border-width:2px;border-radius:9px">
                                          <div class="pic">
                                             <img src="<?php echo $SWIM['basepath']; ?>client/images/courses/Secure.png?v=<?php echo $SWIM['version']; ?>" />
                                          </div>
                                       </div>
                                    </div>
                                    <div class="callout_title">
                                       <div class="bees bees-end"><span></span></div>
                                       Fast and Secure
                                    </div>
                                    <div class="separate"></div>
                                    <div class="callout_text">
                                       <p>Our website is protected by the best and brightest rainbows, glitter, and the finest internet wizardry. We promise we will never share or sell your information.</p>
                                    </div>
                                 </div>
                                 <div class="button_section">
                                    <a href="<?php echo $SWIM['basepath']; ?>return-policy" class="cws_button xlarge">
                                       Payments
                                       <div class="button-shadow"></div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- / callout -->
                     </div>
                     <div class="grid_row clearfix whatmakesawesomerow">
                        <!-- callout -->
                        <div class="grid_col grid_col_4">
                           <div class="ce clearfix">
                              <div class="cws_callout">
                                 <div class="content_section">
                                    <div class="woocommerce">
                                       <div class="media_part" style="border-color:#176c81 !important;border-width:2px;border-radius:9px">
                                          <div class="pic">
                                             <img src="<?php echo $SWIM['basepath']; ?>client/images/courses/FeaturesPhotos6.png" />
                                          </div>
                                       </div>
                                    </div>
                                    <div class="callout_title">
                                       <div class="bees bees-end"><span></span></div>
                                       Messages are Affirming and Value Diversity
                                    </div>
                                    <div class="separate"></div>
                                    <div class="callout_text">
                                       <p>Rather than forcing you to select a gender, our characters are customized to best match the likeness of your favorite little unicorn!</p>
                                    </div>
                                 </div>
                                 <div class="button_section">
                                    <a href="<?php echo $SWIM['basepath']; ?>about-us" class="cws_button xlarge">
                                       About Us
                                       <div class="button-shadow"></div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- / callout -->
                        <!-- callout -->
                        <div class="grid_col grid_col_4">
                           <div class="ce clearfix">
                              <div class="cws_callout">
                                 <div class="content_section">
                                    <div class="woocommerce">
                                       <div class="media_part" style="border-color:#176c81 !important;border-width:2px;border-radius:9px">
                                          <div class="pic">
                                             <img src="<?php echo $SWIM['basepath']; ?>client/images/courses/FeaturesPhotos3.png" />
                                          </div>
                                       </div>
                                    </div>
                                    <div class="callout_title">
                                       <div class="bees bees-end"><span></span></div>
                                       Perfect Gift Idea
                                    </div>
                                    <div class="separate"></div>
                                    <div class="callout_text">
                                       <p>Customize the character to look like your loved one and they become the STAR of the book! Excellent gift idea for birthdays, holidays, or just for fun!</p>
                                    </div>
                                 </div>
                                 <div class="button_section">
                                    <a href="<?php echo $SWIM['basepath']; ?>gift" class="cws_button xlarge">
                                       Gift
                                       <div class="button-shadow"></div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- / callout -->
                        <!-- callout -->
                        <div class="grid_col grid_col_4">
                           <div class="ce clearfix">
                              <div class="cws_callout">
                                 <div class="content_section">
                                    <div class="woocommerce">
                                       <div class="media_part" style="border-color:#176c81 !important;border-width:2px;border-radius:9px">
                                          <div class="pic">
                                             <img src="<?php echo $SWIM['basepath']; ?>client/images/courses/FeaturesPhotos4.png" />
                                          </div>
                                       </div>
                                    </div>
                                    <div class="callout_title">
                                       <div class="bees bees-end"><span></span></div>
                                       Each Books is Unique
                                    </div>
                                    <div class="separate"></div>
                                    <div class="callout_text">
                                       <p>To create your custom adventure, select 10 mini stories in the order you'd like. Create endless variations by selecting different stories each time!</p>
                                    </div>
                                 </div>
                                 <div class="button_section">
                                    <a href="<?php echo $SWIM['basepath']; ?>how-it-works" class="cws_button xlarge">
                                       How It Works
                                       <div class="button-shadow"></div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- / callout -->
                     </div>
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