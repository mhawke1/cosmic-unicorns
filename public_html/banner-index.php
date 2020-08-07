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
	headerHTML('Cosmic Unicorns',['j/jquery-3.4.1.min.js','j/adm.js']).'
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
					<nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">Banner</span></nav>
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

  $db->query('SELECT * FROM banner');
  $result=$db->exe();
  $banner=mysqli_fetch_assoc($result);

if($session->getUserId()!==null && $session->getRole()==0)
	{
			$request=new request();
			if($request->isPost())
				{   
					$description=$request->getPost('description',null);
					if(!empty($description))
						{
							
							$timestamp=time();
							if(mysqli_num_rows($result)>0)
								{  
								
									if(!empty($banner))
										{  
											$id= $banner['id'];

											$db->query('UPDATE `banner` SET `description`=\''.$description.'\' WHERE id='.$id);
											$updateResult=$db->exe();
											if($updateResult===false)
												{
													$msg='Something Went Wrong';
												}else {
													$banner['description']=$description;
													$success='Banner Updated Successfully';
												}
										}
								}else 
								{
									$db->query('INSERT INTO banner(description,timestamp) VALUES(\''.$description.'\','.$timestamp.')');
									$insertResult=$db->exe();
									if($insertResult===false)
										{
											$msg='Something Went Wrong';
										}else {
											$success='Banner Added Successfully';
										}
								}
						}
				}


?>











						<div class="grid_row clearfix">
   <div class="grid_col grid_col_12">
      <div class="ce clearfix">
         <div>
            <div class="woocommerce">
               <div class="grid_row clearfix">
                  <!--	<form action="#" method="post">-->
                  <!-- product cart table -->


                  <?php 

                  if($msg!='')
					{ ?>
			<div class="cws_msg_box error-box clearfix" style="display: block;">
				<div class="icon_section"><i class="fa fa-exclamation"></i></div>
				<div class="content_section">
				<div class="msg_box_title">Error</div>
				<div class="msg_box_text">
				<p for="name" class="error"><?=$msg?></p>
				</div>
			</div>
			</div>

             <?php 	}
                  ?>
             <?php 

                  if($success!='')
					{ ?>
			<div class="cws_msg_box success-box clearfix" style="display: block;">
				<div class="icon_section"><i class="fa fa-check"></i></div>
				<div class="content_section">
				<div class="msg_box_title">Success </div>
				<div class="msg_box_text">
				<p for="name" class="error"><?=$success?></p>
				</div>
			</div>
			</div>





				<?php 	}
                  ?>


                  <form action="" method="post">
                     <div class="row">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                         
                           <p>
                              Description*
                              <br>
                              <span class="cf-form-control-wrap">
                              <textarea name="description" required><?=isset($banner['description'])?$banner['description']:''?></textarea>
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