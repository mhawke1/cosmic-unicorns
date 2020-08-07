<?php
	session_start();
	require_once 'swim.php';
	require $SWIM['basepath'].'../swim/stripe/init.php';

	$session=new session();
	$session->start();

	$db=new database();
	$db->databaseName($SWIM['dbDatabaseName']);
	$db->username($SWIM['dbUsername']);
	$db->password($SWIM['dbPass']);
	$db->connect();

//... WTF is this line for? FIGURED IT OUT: IT LOGS THE USER OUT WHENEVER METHOD=POST...
	//if($_SERVER['REQUEST_METHOD']==='POST')$session->setUserId(null);

	echo '<!DOCTYPE html>
<html lang="en-US">'.
	headerHTML('Cosmic Unicorns',['j/jquery-3.4.1.min.js','js/custom.js']).'
	<body class="home page wide wave-style">
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TRBLWDG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
		<div class="page">'.
			topPanel();
//var_dump($session->getUserId());
//var_dump($session->sessionExists());
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
						<h1>Admin Panel</h1>
					</div>
					<nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">Add Coupon</span></nav>
					<!-- .breadcrumbs -->
				</div>
				<canvas class='breadcrumbs' data-bg-color='#f8f2dc' data-line-color='#f9e8b2'></canvas>
			</section> 
			<!-- / breadcrumbs -->

			<!-- main container -->
			<div id="main" class="site-main">


				<div class="container">
					 <div class="a-right">
								<a class="cws_button small" href="<?=$SWIM['basepath']?>adminpanel">
									Home</a>
								<a class="cws_button small" href="<?=$SWIM['basepath']?>coupon-index">
									Coupon</a>
							</div>
				</div>

				<div class="page_content">
					<!-- pattern conatainer / -->
					<div class='left-pattern pattern pattern-2'></div>
					<main>
<?php
  $msg='';
  $success='';

  $id=isset($_GET['id'])?$_GET['id']:'';
  if(!empty($id))
  {
  	$db->query('SELECT * FROM coupon WHERE id='.$id);
  $result=$db->exe();
  $coupon=mysqli_fetch_assoc($result);
  if(empty($coupon)){
  	echo site403();exit;
  }
  }

  

if($session->getUserId()!==null && $session->getRole()==0)
	{
			


?>











						<div class="grid_row clearfix">
   <div class="grid_col grid_col_12">
      <div class="ce clearfix">
         <div>
            <div class="woocommerce">
               <div class="grid_row clearfix">
                  <!--	<form action="#" method="post">-->
                  <!-- product cart table -->


                 


                  <form action="<?=$SWIM['basepath']?>couponSave" method="post">
                     <div class="row">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                          


                             <p>
                              Title*
                              <br>
                              <span class="cf-form-control-wrap">
                              <input type="text" name="title" value="<?=isset($coupon['title'])?$coupon['title']:''?>" required>
                           </p>
                           
                             <p>
                              Description*
                              <br>
                              <span class="cf-form-control-wrap">
                              <textarea  name="description"><?=isset($coupon['description'])?$coupon['description']:''?></textarea>
                           </p>

                            <p>
                              Min Order 
                              <br>
                              <span class="cf-form-control-wrap">
                              <input type="text" name="min" value="<?=isset($coupon['min'])?$coupon['min']:''?>">
                           </p>

                            <p>
                              Code*
                              <br>
                              <span class="cf-form-control-wrap">
                              	<input type="hidden" name="id"  value="<?=isset($id)?
                              	$id:''?>" required>


                              <input type="text" name="code"  value="<?=isset($coupon['code'])?$coupon['code']:''?>" required>
                           </p>
                           <?php

                          $discount= isset($coupon['discount'])?$coupon['discount']:0;
                           $type_id= isset($coupon['type_id'])?$coupon['type_id']:0;

                          ?>


                            <p>
                              Type*
                              <br>
                              <span class="cf-form-control-wrap">
                              <select name="type_id" id="type_id"required>
                              <option <?=($type_id==0)?'selected':''?> value="0">Entire Order</option>
                              <option <?=($type_id==1)?'selected':''?> value="1">Pre Paid Code</option>
                               <option  <?=($type_id==2)?'selected':''?> value="2">Free Shipping </option>
                              </select>
                           </p>


                           <p class="discount" <?=(empty($discount) && !empty($id))?"style=display:none":''?>>
                              Discount*
                              <br>
                              <span class="cf-form-control-wrap">
                              <input type="number"  step="any" id="discount-input"   value="<?=isset($coupon['discount'])?$coupon['discount']:''?>" name="discount">
                           </p>

                            


                          
                           <p>
                              <input type="submit" value="Save" class="cf-form-control cf-submit">
                           </p>
                        </div>
                     </div>
                  </form>
                  <!-- / product cart table -->
                  <!--</form>-->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>






















<?php
	}
	else
	{
		echo site403();
	}
?>
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
?>