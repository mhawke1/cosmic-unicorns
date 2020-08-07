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
         <h1>Order-Form</h1>
      </div>
      <nav class="bread-crumbs"><a href="./" >Home</a><i class="delimiter fa fa-chevron-right"></i><span class="current">Order-Form</span></nav>
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
         <?php
  if($session->getUserId()!==null )
  {  
    $request=new request();

     $selects=['paymentprocessor','id','quantity','amount','discount','type_id','paid_response','billing_info','paymentintentid','paymentid','hair','haircolor','eyes','eyescolor','glasses','freckles','body','bodycolor','pages','childsname','lovenote','childspicture','timestamp'];
    $search=['id'=>$request->getGet('id',0)];
    $db->tablePrefix('');
    $db->tableName('payments');
    $paymentRow=$db->get($selects,$search);

    if($paymentRow!==false)
    {
      $paymentRow=mysqli_fetch_assoc($paymentRow);
            
      if($paymentRow!==null)
      {
      

      $paymentProcessor='Stripe';
    $paymentIntentId=htmlentities($paymentRow['paymentintentid']);
    if(empty($paymentIntentId))
    {
        $paymentProcessor='Pre Order';
    }
    
    if($paymentRow['type_id']==1){
     $type='Big Adventure';   
    }else {
        $type='Rivers Big Adventure';  
    }


        $responseData3=json_decode($paymentRow['paid_response']);
    $billingInfo=json_decode($paymentRow['billing_info']);
    ?>
         <div class='grid_row clearfix' style='padding-top: 30px;'>
            <div class='grid_col grid_col_12'>
                  

                  <?php
   $paymentProcessor='Stripe';
    $paymentIntentId=htmlentities($paymentRow['paymentintentid']);
    if(empty($paymentIntentId))
    {
        $paymentProcessor='Pre Order';
    }

    if($paymentProcessor=='stripe')
    {
        
        $responseData3=json_decode($payment['paid_response']);
        $name= htmlentities($responseData3->data->object->shipping->name);

    }else{
        
        $billingInfo=json_decode($paymentRow['billing_info']);
        $name =$billingInfo->name;
    }
    $nameArray= explode(' ', $name);
    $firstname= isset($nameArray[0])?$nameArray[0]:'';
    $lastname= isset($nameArray[1])?$nameArray[1]:'';
    $orderId= $paymentRow['id'];
    

 ?>
              
              <input type="hidden" id="pdffilename" value="<?="$lastname.$firstname.$orderId"?>" />

               <div class="container">
                  

                  <div class="text-right">
                    <a id="preordrbtn" href="adminlogin" class="button get-started">Back </a>

                   </div>
                  <h2 class="order-from-heding">Cosmic Unicorns</h2>
                  <p class="order-from-email">orders@cosmicunicorns.com</p>
                  <p class="order-from-number">754.300.9292</p>

                  <h1 class="order-from-main-heading">Order Form</h1>
                  <p class="order-form-date">Date : <?=date('Y-m-d',$paymentRow['timestamp'])?></p>
                  <hr>
                  <div class="row">
                     <div class="grid_col grid_col_6">
                          <h2>Customer Name</h2>
                        <?php if($paymentProcessor=='Stripe'){ ?>
                           <h6 class="margin-remove"><?=htmlentities($responseData3->data->object->shipping->name)?></h6>
                      
                        <h6 class="margin-remove"><?=$responseData3->data->object->shipping->address->line1?>
                           <?=$responseData3->data->object->shipping->address->line2?>
                        </h6>
                        <h6 class="margin-remove"><?=$responseData3->data->object->shipping->address->city?>,
                          <?=$responseData3->data->object->shipping->address->state?>,
                        <?=$responseData3->data->object->shipping->address->postal_code?></h6>
                        <h6 class="margin-remove"><?=$responseData3->data->object->shipping->phone?></h6>
                        <?php }else { ?>

                         
                         <h6 class="margin-remove"><?=$billingInfo->name?></h6>
                      
                        <h6 class="margin-remove"><?=$billingInfo->line1?>
                           <?=$billingInfo->line2?>
                        </h6>
                        <h6 class="margin-remove"><?=$billingInfo->city?>,
                          <?=$billingInfo->state?>,
                        <?=$billingInfo->postal_code?></h6>
                        <h6 class="margin-remove"><?=$billingInfo->phone?></h6>
                       <?php  }?>
                      
                        

                     </div>
                     <div class="grid_col grid_col_6">
                        <h2>Invoice #</h2>
                        <h6 class="margin-remove"><?=$paymentRow['id']?>	</h6>
                        <h2>Due date</h2>
                        <h6 class="margin-remove"><?= date('Y-m-d', strtotime('+10 days', $paymentRow['timestamp'])); ?>	</h6>
                     </div>
                  </div>
                  <!-- order list -->
               </div>
            </div>

         </div>

               <div class='grid_row clearfix' style='padding-top: 30px; padding-bottom: 10px'>
            <div class='grid_col grid_col_12'>
               <table class="shop_table woocommerce-checkout-review-order-table" style="width: 100%">
                  <thead>
                     <tr>
                        <th class="product-name">Description</th>
                        <th class="product-total">Qty</th>
                         <th class="product-total">Unit price</th>
                          <th class="product-total">Total price</th>
                          <th>Action</th>

                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?=$type?>	</td>
                            <td><?=$paymentRow['quantity']?></td>
                            <td>$<?= $unit=($paymentRow['type_id']==1)?'29.00':'15.00'?></td>
                            <td>$ <?=number_format($unit*$paymentRow['quantity'],2)?></td>
                            <td><?php if($paymentRow['type_id']==1){?><a target="_blank" href="pdfdownload.php?id=<?=htmlentities($paymentRow['id'])?>">Download Pdf</a><?php }?></td>
                     </tr>

                        <?php 
                        $db->query('SELECT * FROM `payments` WHERE paid="1" AND order_id="'.$paymentRow['id'].'" ORDER BY `id` DESC');
                        $result=$db->exe();
                       while($payment=mysqli_fetch_assoc($result))
                      {
                        ?>
                      <tr>
                        <td> <?php 
                           if($payment['type_id']==1){
     $type='Big Adventure';   
    }else {
        $type='Rivers Big Adventure';  
    }
                        ?>	<?=$type?></td>
                            <td><?=$payment['quantity']?></td>
                            <td>$<?= $unit=($payment['type_id']==1)?'29.00':'15.00'?></td>
                            <td>$ <?=number_format($unit*$payment['quantity'],2)?></td>
                             <td><?php if($payment['type_id']==1){?><a target="_blank" href="pdfdownload.php?id=<?=htmlentities($payment['id'])?>">Download Pdf</a><?php }?></td>
                     </tr>

                   <?php } ?>


                      
                  </tbody>
               </table>
            </div>
        </div>

          <div class='grid_row clearfix' style='padding-top: 0px;'>
            
            <div class='grid_col grid_col_8 text-left'>
              Notes:

            </div>
            <div class='grid_col grid_col_4'>
             <table class="table-borderless" style="width: 100%">
               <tr>
                 <td>Subtotal</td>
                 <td class="text-right">$<?=number_format($paymentRow['discount']+$paymentRow['amount'],2)?></td>
               </tr>
               <tr>
                 <td>Adjustments</td>
                 <td class="text-right">-$<?=number_format($paymentRow['discount'],2)?></td>
               </tr>
               <tr>
                 <td colspan="2" class="text-right main-price">$<?=number_format($paymentRow['amount'],2)?>  </td>
               </tr>
             </table>

            </div>
          </div>



         <!-- / section -->

         <?php
  }}}
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