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
	headerHTML('Cosmic Unicorns',['j/jquery-3.4.1.min.js','j/adm.js','js/custom.js']).'
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
					<nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">Coupon Index</span></nav>
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
								<a class="cws_button small" href="<?=$SWIM['basepath']?>banner-index">
									Banner</a>

									<a class="cws_button small" href="<?=$SWIM['basepath']?>coupon-add">
									Add Coupon</a>

									
							</div>
				</div>

             
				<div class="page_content">
					<!-- pattern conatainer / -->
					<div class='left-pattern pattern pattern-2'></div>
					<main>
<?php
	if($session->getUserId()!==null && $session->getRole()==0)
	{
			
			$request=new request();

			if($request->isPost())
			{

            $id=$request->getPost('id',null);
            if($id!==null){
            	$db->query('DELETE from `coupon` WHERE id='.$id);
								$db->exe();



            }


			}

			

//TEST FOR POSt data here. This post data is used to flag the shipping and other status.

$db->query('SELECT * FROM `coupon`  ORDER BY `id` DESC');
$result=$db->exe();
?>









                      

						<div class="grid_row clearfix">

							
							<div class="grid_col grid_col_12">
								<div class="ce clearfix">
									<div>
										<div class="woocommerce">
											<div class="grid_row clearfix">
											<!--	<form action="#" method="post">-->
													<!-- product cart table -->
													<table id="purchasetable" class="shop_table cart">
														<thead>
															<tr>
																<th >Date</th>
																<th >Title</th>
																<th >Description</th>
																<th >Min Order</th>
																<th >Code</th>
																<th >Discount</th>
																<th >Type</th>
																<th >Settings</th>
															</tr>
														</thead>
														<tbody>
<?php

	while($coupon=mysqli_fetch_assoc($result))
	{
		if($coupon['type_id']==0)
		{
          $type='Entire Order';
		}else if($coupon['type_id']==1){
           $type='Pre Paid Code';
		}else {
           $type='Free Shipping';
		}
		
	



		echo '
															<tr class="cart_item">
																<td>'.gmdate("Y-m-d", $coupon['timestamp']).'</td>
																<td >
																	'.$coupon['title'].'
																	
																</td>
                                                                   <td >
																	'.$coupon['description'].'
																	
																</td>

																<td>
																	'.$coupon['min'].'
																</td>

																<td>
																	'.$coupon['code'].'
																</td>
																<td >
																	<div>'.$coupon['discount'].'</div>
																	
																	
																	
																</td>
																<td >
																	<div>'.$type.'</div>
																	
																</td>
																<td>

																<a href="'.$SWIM['basepath'].'coupon-add?id='.$coupon['id'].'">
																<input type="submit" value="Edit" />
																</a>

																<a href="">
																

																<form action="" id="couponDelete" method="post" enctype="multipart/form-data">
																<input type="hidden" name="id" value="'.$coupon['id'].'" />
																<input type="hidden" name="delete" value="1" />
																<input type="submit"  value="Delete" /></form>


																	 



																</td>
															</tr>';
	}


?>
														</tbody>
													</table>
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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

	</body>
</html>
?>