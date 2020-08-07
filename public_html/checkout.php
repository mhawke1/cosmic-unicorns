<?php
   require_once 'swim.php';
   
   $request = new request();
   
   echo '<!DOCTYPE html>
   <html lang="en-US"><script type="text/javascript">var res="LoRes.jpg";</script>' . headerHTML('Cosmic Unicorns', [
       'j/turnjs4/extras/jquery.mousewheel.min.js',
       'j/turnjs4/extras/modernizr.2.5.3.min.js',
       'j/turnjs4/lib/hash.js',
       'j/turnjs4/lib/scissor.js',
     
       'j/salowell-lib.js',
       'j/0.js',
       'j/bookpagescaling.js',
       'j/stripepaymentscript.js',
       'j/checkout.js'
   ], [
       // 'client/css/style.css',
   	'css/responsive.css',
       'client/css/owl.carousel.min.css',
       'client/css/justifiedGallery.min.css',
       'client/css/owl.theme.default.min.css',
       'c/0.css',
       'css/lightslider.min.css',
       'css/stripe-normalize.css',
       'css/stripe-global.css'
   ]) . '
   	<script src="https://js.stripe.com/v3/"></script>
   	<body class="home page wide wave-style">
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TRBLWDG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
   		<div class="page">' . topPanel();
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
               <a class="logo" href="./"><img src='i/logo.png'
                  data-at2x='i/logo2x.png' alt /></a>
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
         <h1>Checkout</h1>
      </div>
      <nav class="bread-crumbs">
         <a href="./">Home</a><i class="delimiter fa fa-chevron-right"></i><span
            class="current">Checkout</span>
      </nav>
      <!-- .breadcrumbs -->
   </div>
   <canvas class='breadcrumbs' data-bg-color='#f8f2dc'
      data-line-color='#f9e8b2'></canvas>
</section>
<!-- / breadcrumbs -->
<!-- main container -->
<div id="main" class="site-main">
   <div class="page_content">
      <!-- pattern conatainer / -->
      <div class='left-pattern pattern pattern-2'></div>
      <main>
         <?php
            ignore_user_abort(true);
            define('MAX_FILE_SIZE', 1000000);
            
            $childsImage = '';
            $permitted = array(
                'image/gif',
                'image/jpeg',
                'image/png',
                'image/pjpeg'
            ); // Set array of permittet filetypes
            $error = true; // Define an error boolean variable
            $filetype = ""; // Just define it empty.
            $childImageFileName = '';
            if (! isset($_COOKIE['carts'])) {
            
                /*
                 * var_dump($childImageFileName);
                 * var_dump(trim($request->getPost('childsname','')));
                 * var_dump(trim($request->getPost('childsname','')));
                 * var_dump(trim($request->getPost('bodytype','')));
                 * var_dump(trim($request->getPost('skincolor','')));
                 * var_dump(trim($request->getPost('eyestype','')));
                 * var_dump(trim($request->getPost('eyescolor','')));
                 * var_dump(trim($request->getPost('hairtype','')));
                 * var_dump(trim($request->getPost('haircolor','')));
                 * var_dump(trim($request->getPost('glasses','')));
                 * var_dump(trim($request->getPost('freckles','')));
                 * var_dump(trim($request->getPost('lovenote','')));
                 */
                echo '<div class="grid_row clearfix" style="padding-top: 30px;">
            				<div class="grid_col grid_col_12">
            					<div class="ce clearfix">
            						<div>
            							<h3 class="ce_title">Your cart is empty</h3>
            						</div>
            					</div>
            				</div>
            			</div>';
            } else {
                $cart = json_decode($_COOKIE['carts'], true);
                $count = count($cart);
                $type= $cart['0']['type'];
                if($type==1){
                	 $childImageFileName = $cart['0']['childspicture'];
                     $childsImage = '<img src="upload/' . $childImageFileName . '" class="lovenotechildspicture" style="max-width:100% !important;" />';
                ;
                }
               
            
                // var_dump(urldecode($request->getPost('lovenote','')));
                // var_dump(html_entity_decode(str_replace('<br>',"\n",$request->getPost('lovenote',''))));
                // var_dump(str_replace('<br>',"\n",$request->getPost('lovenote','')));
                ?>
         <div class='grid_row clearfix'>
            <div class='grid_col grid_col_12'>
              <div class="row">
                  <div class="col-md-12" style="text-align: right;">
                                  <a href="./" class="applyCouponCode">
                                         Continue Shopping >> </a>
                                </div>
                                <br><br>
              </div>
               <div class='ce clearfix'>
                  <div>
                     <div class="woocommerce">
                        <div class="grid_row clearfix">
                           <!-- checkout form -->
                           <form name="checkout" id="checkout" method="post"
                              class="checkout woocommerce-checkout" action="#"
                              enctype="multipart/form-data">
                              <!-- customer details form -->
                              <div class="row">
                              
                                 <div class="col-md-12">
                                    <div class="cart_page_form">
                                       <div class="table-responsive" >
                                          <table class="table " style="width: 100%">
                                             <thead>
                                                <tr class="carttable_row">
                                                   <th class="cartm_title">Image</th>
                                                   <th class="cartm_title">Product</th>
                                                   <th class="cartm_title">Price</th>
                                                   <th class="cartm_title">Quantity</th>
                                                   <th class="cartm_title">Total</th>
                                                   <th class="cartm_title"></th>
                                                </tr>
                                             </thead>
                                             <tbody class="table_body append_cart_html">
                                                <?php 
                                                   foreach ($cart as $key=> $cartModel){ ?>
                                                <tr>
                                                   <?php if($cartModel['type']==1){
                                                      $img='YCBABookImageWeb.png';
                                                     
                                                      $book=$cartModel['childsname']."’s Big Adventure";
                                                      }else {
                                                       $img='RiversBigAdventureWebBook.png';
                                                       $book= 'River’s Big Adventure';
                                                      }
                                                      ?>
                                                   <td> <a href="<?=$SWIM['basepath']?>show-book?id=<?=$key?>"><img style="max-width: 100px" src="<?php  echo $SWIM['basepath'];?>pic/revslider/general/<?=$img?>"></a> </td>
                                                   <th scope="row">
                                                      <ul class="cart_list">
                                                         <li class="list-inline-item pr20"><a href="<?=$SWIM['basepath']?>show-book?id=<?=$key?>">
                                                           <?=$book?>

                                                            
                                                            </a>
                                                         </li>
                                                      </ul>
                                                   </th>
                                                   <td class="text-thm">$<?=number_format($cartModel['amount'],2)?></td>
                                                   <td>
                                                      <!-- skin 2 -->
                                                      <div class="num-block skin-2">
                                                         <div class="num-in">
                                                            <span class="minus dis" data-id="<?=$key?>"></span>
                                                            <input type="text" class="in-num" id="quantity_value_<?=$key?>" data-id="<?=$key?>" value="<?=$cartModel['quantity']?>" readonly="">
                                                            <span class="plus" id="plus_<?=$key?>" data-id="<?=$key?>"></span>
                                                         </div>
                                                      </div>
                                                      <!-- / skin 2 -->
                                                   </td>
                                                   <td class="cart_total text-thm">$<?=number_format($cartModel['amount']*$cartModel['quantity'],2)?></td>
                                                   <td><a href="" class="delete_cart" data-id="<?=$key?>"><img src="<?php  echo $SWIM['basepath'];?>img/delete.png" ></a></td>
                                                </tr>
                                                <?php }
                                                   ?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col2-set" id="customer_details">
                                 <div class="col-1">
                                    <div class="woocommerce-billing-fields">
                                       <h3>Contact Info</h3>
                                       <p
                                          class="form-row form-row form-row-first validate-required"
                                          id="billing_first_name_field">
                                          <label for="billing_first_name" class="">First Name <abbr
                                             class="required" title="required">*</abbr>
                                          </label> <input type="text" class="input-text "
                                             name="billing_first_name" id="billing_first_name"
                                             placeholder="" value="" />
                                       </p>
                                       <p class="form-row form-row form-row-last validate-required"
                                          id="billing_last_name_field">
                                          <label for="billing_last_name" class="">Last Name <abbr
                                             class="required" title="required">*</abbr>
                                          </label> <input type="text" class="input-text "
                                             name="billing_last_name" id="billing_last_name"
                                             placeholder="" value="" />
                                       </p>
                                       <div class="clear"></div>
                                       <p
                                          class="form-row form-row form-row-first validate-required validate-email"
                                          id="billing_email_field">
                                          <label for="billing_email" class="">Email Address <abbr
                                             class="required" title="required">*</abbr>
                                          </label> <input type="email" class="input-text "
                                             name="billing_email" id="billing_email" placeholder=""
                                             value="" />
                                       </p>
                                       <p
                                          class="form-row form-row form-row-first validate-required validate-email"
                                          id="billing_email_field_confirm">
                                          <label for="billing_email_confirm" class="">Confirm Email <abbr
                                             class="required" title="required">*</abbr>
                                          </label> <input type="email" class="input-text "
                                             name="billing_email_confirm" id="billing_email_confirm"
                                             placeholder="" value="" />
                                       </p>
                                       <p
                                          class="form-row form-row form-row-last validate-required validate-phone"
                                          id="billing_phone_field">
                                          <label for="billing_phone" class="">Phone <abbr
                                             class="required" title="required">*</abbr>
                                          </label> <input type="tel" class="input-text "
                                             name="billing_phone" id="billing_phone" placeholder=""
                                             value="" />
                                       </p>
                                       <div class="clear"></div>
                                    </div>
                                 </div>
                                 <div class="col-2">
                                    <div class="woocommerce-shipping-fields">
                                       <h3>Shipping Details</h3>
                                       <p
                                          class="form-row form-row form-row-wide address-field update_totals_on_change validate-required"
                                          id="billing_country_field">
                                          <label for="billing_country" class="">Country <abbr
                                             class="required" title="required">*</abbr>
                                          </label> <input type="text" name="billing_country"
                                             id="billing_country"
                                             class="input-text  country_to_state country_select " />
                                       <noscript>
                                          <input type="submit"
                                             name="woocommerce_checkout_update_totals"
                                             value="Update country" />
                                       </noscript>
                                       </p>
                                       <p
                                          class="form-row form-row form-row-wide address-field validate-required"
                                          id="billing_address_1_field">
                                          <label for="billing_address_1" class="">Address <abbr
                                             class="required" title="required">*</abbr>
                                          </label> <input type="text" class="input-text "
                                             name="billing_address_1" id="billing_address_1"
                                             placeholder="Street address" value="" />
                                       </p>
                                       <p class="form-row form-row form-row-wide address-field"
                                          id="billing_address_2_field">
                                          <label for="billing_address_2" class="">Address Line 2 <abbr
                                             class="required" title="required">*</abbr>
                                          </label> <input type="text" class="input-text "
                                             name="billing_address_2" id="billing_address_2"
                                             placeholder="Apartment, suite, unit etc. (optional)"
                                             value="" />
                                       </p>
                                       <p
                                          class="form-row form-row form-row-wide address-field validate-required"
                                          id="billing_city_field">
                                          <label for="billing_city" class="">Town / City <abbr
                                             class="required" title="required">*</abbr>
                                          </label> <input type="text" class="input-text "
                                             name="billing_city" id="billing_city"
                                             placeholder="Town / City" value="" />
                                       </p>
                                       <p
                                          class="form-row form-row form-row-first address-field validate-required validate-state"
                                          id="billing_state_field">
                                          <label for="billing_state" class="">State / Region <abbr
                                             class="required" title="required">*</abbr>
                                          </label> <input type="text" class="input-text " value=""
                                             placeholder="" name="billing_state" id="billing_state" />
                                       </p>
                                       <p
                                          class="form-row form-row form-row-last address-field validate-required validate-postcode"
                                          id="billing_postcode_field">
                                          <label for="billing_postcode" class="">Postcode / Zip <abbr
                                             class="required" title="required">*</abbr>
                                          </label> <input type="text" class="input-text "
                                             name="billing_postcode" id="billing_postcode"
                                             placeholder="Postcode / Zip" value="" />
                                       </p>
                                       <div class="clear"></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="col-md-6">
                                       <p class="form-row form-row form-row-last "
                                          id="coupon_code_field">
                                          <label for="coupon_code" class="">Apply Coupon </label> <input
                                             type="text" class="input-text " id="coupon_code"
                                             placeholder="" value="" /> <a class="applyCouponCode">
                                          Apply Coupon </a>
                                       <div class="coupon_error" id="coupon_error"
                                          style="color: red"></div>
                                       </p>
                                    </div>
                                    <div class="col-md-6"></div>
                                 </div>
                              </div>
                              <!-- / customer details form -->
                              <h3 id="order_review_heading">Your order</h3>
                              <div id="order_review"
                                 class="woocommerce-checkout-review-order">
                                 <!-- order list -->
                                 <table
                                    class="shop_table woocommerce-checkout-review-order-table">
                                    <thead>
                                       <tr>
                                          <th class="product-name">Product</th>
                                          <th class="product-total">Total</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                          $subtotal=0;
                                          $cartQuantity=0;
                                          foreach($cart as $cartAmount)
                                          {  
                                          	$cartQuantity += $cartAmount['quantity'];
                                              $subtotal+=$cartAmount['amount']*$cartAmount['quantity'];
                                          }
                                          
                                          $shipping_charge = 1 * 5 + ($cartQuantity - 1) * 3;
                                          ?>
                                       <tr
                                          class="cart_item">
                                          <td class="product-name">Shipping <strong
                                             class="product-quantity">&times; <?=$cartQuantity?></strong>
                                          </td>
                                          <td class="product-total"><span class="amount" id="shipping_text">$<?php 
                                             echo number_format($shipping_charge, 2);
                                             
                                             ?>
                                             </span>
                                          </td>
                                       </tr>
                                    </tbody>
                                    <tfoot>
                                       <tr class="cart-subtotal">
                                          <th>Subtotal</th>
                                          <td><span class="amount" id="subtotal_text">$<?php
                                             $subtotal = number_format($subtotal, 2);
                                             echo $subtotal;
                                             
                                             ?></span></td>
                                       </tr>
                                       <tr class="cart-coupon" style="display:none">
                                          <th>Coupon</th>
                                          <td>
                                             <p class="amount" id="code_text">Code (50%)</p>
                                             <span id ="total_discount"class="amount">$0.00</span>
                                             <div class="checkout-p"><i class="fa fa-trash" id="delete_coupon"></i></div>
                                          </td>
                                       </tr>
                                       <tr class="order-total">
                                          <th>Total</th>
                                          <td><strong><span id="total_amount"class="amount">$<?php
                                             $total = number_format($subtotal + $shipping_charge, 2);
                                                 echo $total;
                                                 ?></span></strong>
                                          </td>
                                       </tr>
                                    </tfoot>
                                 </table>
                                 <!-- / order list -->
                                 <input type="hidden" id="subtotal_amount_input" value="<?=$subtotal;?>">
                              </div>
                              <input type="hidden" id="shipping_charge_input" value="<?=$shipping_charge;?>">
                        </div>
                        <input type="hidden" id="total_amount_input" value="<?=$total;?>">
                     </div>
                     <input type="hidden" name="amount" id="amount" value="<?=$total;?>"> <input
                        type="hidden" name="coupon_code" id="payment_coupon_code"> <input
                        type="hidden" name="discount" id="discount"> <input
                        type="hidden" name="coupon_type" id="coupon_type" value="0">
                  </div>
                  </form>
                  <!-- / checkout form -->
                  <div id="msg_error_box" class="cws_msg_box error-box clearfix"
                     style="display: none;">
                     <div class="icon_section">
                        <i class="fa fa-exclamation"></i>
                     </div>
                     <div class="content_section">
                        <div class="msg_box_title">Error</div>
                        <div class="msg_box_text" id="msg_error_box_text"></div>
                     </div>
                  </div>
                  <!-- payment methods -->
                  <a class="order-now" style="display: none"> Place Order </a>
                  <div id="payment" class="woocommerce-checkout-payment">
                     <ul class="payment_methods methods">
                        <li class="payment_method_cheque">
                           <input
                              id="payment_method_cheque" type="radio" class="input-radio"
                              name="payment_method" value="cheque"
                              data-order_button_text="" /> <label
                              for="payment_method_cheque"> Checkout with Debit/Credit Card</label>
                           <div class="payment_box payment_method_cheque"
                              style="display: none; background: unset">
                              <div class="sr-root">
                                 <div class="sr-main">
                                    <form id="payment-form1" class="sr-payment-form">
                                       <div class="sr-combo-inputs-row">
                                          <div class="sr-input sr-card-element card-element"></div>
                                       </div>
                                       <div class="sr-field-error" id="card-errors" role="alert"></div>
                                       <button id="submit">
                                          <div class="spinner hidden"></div>
                                          <span class="button-text">Pay</span><span
                                             id="order-amount"></span>
                                       </button>
                                    </form>
                                    <div id="payment-form1sr-result" class="sr-result hidden">
                                       <p>
                                          PAYMENT SUCCESSFUL!<br />Thank you for your pre-order!<br />We
                                          are SO EXCITED for the launch of Cosmic Unicorn's
                                          Personalized Children's Books! We anticipate our
                                          unicorns will be ready to ship your book by mid-June.
                                          We’ll send you an email as soon as your book is ready
                                          to ship<br />Any questions contact <a
                                             style="color: #000"
                                             href="mailto:info@cosmicunicorns.com">info@cosmicunicorns.com</a>
                                       </p>
                                       <pre id="payment-form1pre">
						<code></code>
					</pre>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </li>
                        <!--
                           <li class="payment_method_paypal">
                               <input id="payment_method_paypal" type="radio" class="input-radio" name="payment_method" value="paypal" data-order_button_text="Proceed to PayPal" />
                               <label for="payment_method_paypal">
                                   PayPal <a href="https://www.paypal.com/gb/webapps/mpp/paypal-popup" class="about_paypal" onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;" title="What is PayPal?">What is PayPal?</a> </label>
                               <div class="payment_box payment_method_paypal" style="display:none;">
                                   <p>Pay via PayPal; you can pay with your credit card if you don&#8217;t have a PayPal account.</p>
                               </div>
                           </li>
                           -->
                     </ul>
                     <div class="form-row place-order">
                        <noscript>
                           Since your browser does not support JavaScript, or it is
                           disabled, please ensure you click the <em>Update Totals</em>
                           button before placing your order. You may be charged more
                           than the amount stated above if you fail to do so. <br /> <input
                              type="submit" class="button alt"
                              name="woocommerce_checkout_update_totals"
                              value="Update totals" />
                        </noscript>
                        <input type="hidden" id="nonce" name="nonce"
                           value="218ded7efe" /> <input type="hidden"
                           name="http_referer" value="/checkout/" />
                        <!--<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Place order" data-value="Place order" />->
                           </div>
                           </div>
                           <!-- / payment methods -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
   </div>
   <?php
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
<script type="text/javascript">
   /////////////////// product +/-
   $jq(document).ready(function() {
    $jq('.num-in span').click(function () {
        var $input = $jq(this).parents('.num-block').find('input.in-num');
      if($jq(this).hasClass('minus')) {
        var count = parseFloat($input.val()) - 1;
        count = count < 1 ? 1 : count;
        if (count < 2) {
          $jq(this).addClass('dis');
        }
        else {
          $jq(this).removeClass('dis');
        }
        $input.val(count);
      }
      else {
        var count = parseFloat($input.val()) + 1
        $input.val(count);
        if (count > 1) {
          $jq(this).parents('.num-block').find(('.minus')).removeClass('dis');
        }
      }
      
      $input.change();
      return false;
    });
    
   });
   // product +/-
</script>
</body>
</html>