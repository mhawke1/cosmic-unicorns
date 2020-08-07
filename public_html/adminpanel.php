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
					<nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">Admin Panel</span></nav>
					<!-- .breadcrumbs -->
				</div>
				<canvas class='breadcrumbs' data-bg-color='#f8f2dc' data-line-color='#f9e8b2'></canvas>
			</section>
			<!-- / breadcrumbs -->

			<!-- main container -->
			<div id="main" class="site-main">

				<div class="container">
					 <div class="a-right">
								<a class="cws_button small" href="<?=$SWIM['basepath']?>banner-index">
									Banner</a>
									<a class="cws_button small" href="<?=$SWIM['basepath']?>coupon-index">
									Coupon</a>
							</div>
				</div>

             
				<div class="page_content">
					<!-- pattern conatainer / -->
					<div class='left-pattern pattern pattern-2'></div>
					<main>
<?php
	if($session->getUserId()!==null && $session->getRole()==0 )
	{
			$request=new request();

			if($request->isPost())
			{
				$dbId=$request->getPost('dbid',null);

				if($dbId!==null)
				{
					$selects=['paid','refunded','shippedtocustomer','pdfdownloaded','senttoprinters','printing','paymentid'];
					$search=['id'=>$dbId];
					$db->tablePrefix('');
					$db->tableName('payments');
					$paymentRow=$db->get($selects,$search);

					if($paymentRow!==false)
					{
						$paymentRow=mysqli_fetch_assoc($paymentRow);
						
						if($paymentRow!==null)
						{
							if($request->getPost('refunded',null)!==null)
							{
								$stripe=new stripe();

								$stripe->refund($paymentRow['paymentid']);
							}

							if($request->getPost('pdfdownloaded',null)!==null)
							{
								$db->query('UPDATE `payments` SET `pdfdownloaded`=1 WHERE id='.$db->escape($dbId));
								$db->exe();
							}

							if($request->getPost('senttoprinters',null)!==null)
							{
								$db->query('UPDATE `payments` SET `senttoprinters`=1 WHERE id='.$db->escape($dbId));
								$db->exe();
							}

							if($request->getPost('printing',null)!==null)
							{
								$db->query('UPDATE `payments` SET `printing`=1 WHERE id='.$db->escape($dbId));
								$db->exe();
							}

							if($request->getPost('shippedtocustomer',null)!==null)
							{
								$db->query('UPDATE `payments` SET `shippedtocustomer`=1 WHERE id='.$db->escape($dbId));
								$db->exe();
							}
						}
					}
				}
			}

//TEST FOR POSt data here. This post data is used to flag the shipping and other status.

$db->query('SELECT * FROM `payments` WHERE paid="1" ORDER BY id DESC');
$result=$db->exe();
?>









                      

						<div class="grid_row clearfix">

							
							<div class="grid_col grid_col_12" style="background-color: #fff">
								<div class="ce clearfix">
									<div>
										<div class="woocommerce">
											<div class="grid_row clearfix">
											<!--	<form action="#" method="post">-->
													<!-- product cart table -->
														<div class="table-responsive">
													<table id="purchasetable" class="shop_table cart">
														<thead>
															<tr> 
																<th>Id</th>
																<th class="product-name">Order Id</th>
																<th class="product-name">Date</th>
																<th class="product-name">Type</th>
																<th class="product-name">Payment Processor + ID</th>
																<th class="product-name">Child Name</th>
																<th class="product-name">Quantity</th>
																<th class="product-price">Status</th>
																<th class="product-quantity">Shipping</th>
																<th class="product-subtotal">Contact</th>
																<th class="product-remove">Settings</th>
															</tr>
														</thead>
														<tbody>
<?php

	while($payment=mysqli_fetch_assoc($result))
	{
		$paymentProcessor='Stripe';
		$paymentIntentId=htmlentities($payment['paymentintentid']);
		if(empty($paymentIntentId))
		{
		    $paymentProcessor='Pre Order';
		}
		
		if($payment['type_id']==1){
		 $type='Big Adventure';   
		}else {
		    $type='Rivers Big Adventure';  
		}

		$order_id= !empty($payment['order_id'])?$payment['order_id']:$payment['id'];
		$oId= $order_id.'-'.$payment['order_count'];
		$childname=htmlentities($payment['childsname']);
		$quantity=$payment['quantity'];
		$paymentId=htmlentities($payment['paymentid']);
		$refundId=htmlentities($payment['refundid']);
		$responseData3=json_decode($payment['paid_response']);
		$billingInfo=json_decode($payment['billing_info']);
		$step='<div>1.) paid</div>';


if($payment['refunded']==1)
{
	$step='<div>1.) Refunded</div>';

}
$indx=2;
if($payment['pdfdownloaded']==1)
{
	$step.='<div>'.$indx.'.) PDF Downloaded</div>';
	++$indx;
}

if($payment['senttoprinters']==1)
{
	$step.='<div>'.$indx.'.) Sent to Printers</div>';
	++$indx;
}

if($payment['printing']==1)
{
	$step.='<div>'.$indx.'.) Printing</div>';
	++$indx;
}

if($payment['shippedtocustomer']==1)
{
	$step.='<div>'.$indx.'.) Shipped</div>';
}


//'paid','refunded','shippedtocustomer','pdfdownloaded','senttoprinters','printing','paymentid'
$pagesTmp=explode('-',$payment['pages']);
$pages='';
foreach($pagesTmp AS $k=>$v)$pages.='&pages%5B%5D='.urlencode($v);


		echo '
															<tr class="cart_item">

															<td>
																	'.$payment['id'].'
																</td>

                                                                <td>
																	'.$oId.'
																</td>
																<td>'.gmdate("Y-m-d", $payment['timestamp']).'</td>
                                                                   <td class="product-price">
																	'.$type.'
																</td>
																<td>
																	<div>'.$paymentProcessor.'</div>
																	<div>'.$paymentIntentId.'</div>
																	<div>'.$paymentId.'</div>
																	<div>'.$refundId.'</div>
																</td>
                                                                <td >
																	'.$childname.'
																</td>
																<td>
																	'.$quantity.'
																</td>
                                                                
  
																<td>
																	'.$step.'
																</td>';
		                                                         if($paymentProcessor=='Stripe'){
    

																echo '<td>
																	<div>'.htmlentities($responseData3->data->object->shipping->name).'</div>
																	<div>'.htmlentities($responseData3->data->object->shipping->address->line1).' '.htmlentities($responseData3->data->object->shipping->address->line2).'</div>
																	<div>'.htmlentities($responseData3->data->object->shipping->address->city).', '.htmlentities($responseData3->data->object->shipping->address->state).' '.htmlentities($responseData3->data->object->shipping->address->postal_code).'</div>
																	<div>'.htmlentities($responseData3->data->object->shipping->address->country).'</div>
																</td>
																<td>
																	<div>'.htmlentities($responseData3->data->object->shipping->name).'</div>
																	<div>'.htmlentities($responseData3->data->object->shipping->phone).'</div>
																	<div>'.htmlentities($responseData3->data->object->receipt_email).'</div>
																</td>';
		                                                         }else {
		                                                             if(!empty($billingInfo))
		                                                             {
		                                                         echo  '<td>
																	<div>'.htmlentities($billingInfo->name).'</div>
																	<div>'.htmlentities($billingInfo->line1).' '.htmlentities($billingInfo->line2).'</div>
																	<div>'.htmlentities($billingInfo->city).', '.htmlentities($billingInfo->state).' '.htmlentities($billingInfo->postal_code).'</div>
																	<div>'.htmlentities($billingInfo->country).'</div>
																</td>
																<td>
																	<div>'.htmlentities($billingInfo->name).'</div>
																	<div>'.htmlentities($billingInfo->phone).'</div>
																	<div>'.htmlentities($billingInfo->email).'</div>
																</td>';
		                                                             }else {
		                                                                 
		                                                          echo  '<td>
																	<div></div>
																	<div></div>
																	<div></div>
																	<div></div>
																</td>
																<td>
																	<div></div>
																	<div></div>
																	<div></div>
																</td>';
		                                                             }
		                                                         
		                                                             
		                                                         }                                       



																echo '<td>';
																if($payment['type_id']==1)
echo '<div><a href="pdfdownload.php?id='.htmlentities($payment['id']).'" target="_blank" title="Download Book\'s PDF">Download PDF</a></div>';

if($payment['order_id']==0)

echo '<div><a href="order-form.php?id='.htmlentities($payment['id']).'" target="_blank" title="Order Form">Order Form</a></div>
 <div><a href="invoice.php?id='.htmlentities($payment['id']).'" target="_blank" title="Invoice">Invoice</a></div>';
if($paymentProcessor=='Stripe'){
echo '<div><form action="" class="refundform" method="post" enctype="multipart/form-data"><input type="hidden" name="dbid" value="'.htmlentities($payment['id']).'" /><input type="hidden" name="refunded"      value="1" /><input class="refundbutton" type="submit" value="Refund" /></form></div>';
}
echo '<div><form action="" method="post" enctype="multipart/form-data"><input type="hidden" name="dbid" value="'.htmlentities($payment['id']).'" /><input type="hidden" name="pdfdownloaded" value="1" /><input                      type="submit" value="1.) Mark PDF as Downloaded" /></form></div>
<div><form action="" method="post" enctype="multipart/form-data"><input type="hidden" name="dbid" value="'.htmlentities($payment['id']).'" /><input type="hidden" name="senttoprinters" value="1" /><input type="submit" value="2.) Mark as Sent to Printers" /></form></div>
<div><form action="" method="post" enctype="multipart/form-data"><input type="hidden" name="dbid" value="'.htmlentities($payment['id']).'" /><input type="hidden" name="printing" value="1" /><input type="submit" value="3.) Mark as Printing" /></form></div>
<div><form action="" method="post" enctype="multipart/form-data"><input type="hidden" name="dbid" value="'.htmlentities($payment['id']).'" /><input type="hidden" name="shippedtocustomer" value="1" /><input type="submit" value="4.) Mark as Shipped" /></form></div>
																</td>
															</tr>';
	}


/*
							if($request->getPost('refunded',null)!==null)
							{
								$stripe=new stripe();
								
								$stripe->refund($paymentRow['paymentid']);
							}

							if($request->getPost('pdfdownloaded',null)!==null)
							{
								$db->query('UPDATE `payments` SET `pdfdownloaded`=1 WHERE id='.$db->escape($dbId));
								$db->exe();
							}

							if($request->getPost('senttoprinters',null)!==null)
							{
								$db->query('UPDATE `payments` SET `senttoprinters`=1 WHERE id='.$db->escape($dbId));
								$db->exe();
							}

							if($request->getPost('printing',null)!==null)
							{
								$db->query('UPDATE `payments` SET `printing`=1 WHERE id='.$db->escape($dbId));
								$db->exe();
							}

							if($request->getPost('shippedtocustomer',null)!==null)
							{
								$db->query('UPDATE `payments` SET `shippedtocustomer`=1 WHERE id='.$db->escape($dbId));
								$db->exe();
							}
 */




	
/*
															<tr class="cart_item">
																<td class="product-name product-thumbnail">
																	<div class="media_part">
																		<div class="pic">
																			<a href="shop-single-product.html"><img width="90" height="90" src="http://placehold.it/90x90" class="attachment-90x90" alt="hoodie_4_front"></a>
																		</div>
																	</div>
																	<a href="shop-single-product.html">Bag</a>
																</td>
																<td class="product-price">
																	<span class="amount">�35.00</span>
																</td>
																<td class="product-quantity">
																	<div class="quantity">
																		<input type="number" step="1" min="0" name="cart[6abba5d8ab1f4f32243e174beb754661][qty]" value="1" title="Qty" class="input-text qty text" size="4">
																	</div>
																</td>
																<td class="product-subtotal">
																	<span class="amount">�35.00</span>
																</td>
																<td class="product-remove">
																	<a href="#" class="remove" title="Remove this item">�</a>
																</td>
															</tr>
*/
?>
														</tbody>
													</table>
												</div>
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