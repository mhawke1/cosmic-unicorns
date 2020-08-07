var StripePaymentIntentCreated = false;
var attemptingToCreateStripePaymentIntent = false;

$jq(document).ready(function() {
    $jq('#payment_method_cheque').on('click', function() {
        $jq('#loadingstripepaymentinfo').remove();
        $jq('#payment #payment-form1').hide();
        $jq('#payment #payment-form1').parent().append('<div id="loadingstripepaymentinfo">Loading stripe payment info...</div>');
        //Loading here
        if (!attemptingToCreateStripePaymentIntent) {
            attemptingToCreateStripePaymentIntent = true;

            createStripePaymentIntent({}, 'payment-form1', 'create-stripe-payment-intent.php', function() {
                    $jq('#loadingstripepaymentinfo').remove();
                    $jq('#payment #payment-form1').show();
                },
                function(a, b, c) {},
                function() {})
        }

                           
        $jq('.lovenoteautofill').html($jq('#lovenoteinput').val());
        $jq('.childsnameautofill').html($jq('#childsname').val());
    });
    
             
        $jq('.plus').on('click', function() {
             var id= $jq(this).attr('data-id');
             
             var quantity=$jq("#quantity_value_"+id).val();
             quantity= parseInt(quantity)+1;
             changeQuantity(id,quantity);
          });

        $jq('.minus').on('click', function() {
             var id= $jq(this).attr('data-id');
            
              var quantity=$jq("#quantity_value_"+id).val();
              if(quantity>1){
              quantity=parseInt(quantity)-1;
             changeQuantity(id,quantity);
             }
          });

         $jq('.delete_cart').on('click', function(e) {
             e.preventDefault();
             var id= $jq(this).attr('data-id');
            
              var quantity=0;

               var result = confirm("Are you sure you want to delete this item?");
       if (result) {
           changeQuantity(id,quantity);
     }

              
          });

        

           function changeQuantity(id,quantity)
           { 
          
            var time= Date.now();
              $jq.ajax({
            url: 'ajax.php',

            data: {
                key: 3,
                id: id,
                quantity:quantity,
                
            },
            type: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status == 'OK') {
                  
                    $jq('#amount').val(data.total);
                    $jq('#total_amount').html("$"+data.total);
                    $jq('#shipping_text').html("$"+data.shipping_charge);
                    $jq('#subtotal_text').html("$"+data.subtotal);
                  //  $jq('.append_cart_html').html(data.html);
                    location.href="checkout?t"+time;
                   

                } else {
                   location.href="/?t"+time;

                }

            }

        });  
           }

    $jq('.applyCouponCode').on('click', function() {
       
    	
    
        var code = $jq("#coupon_code").val();
        var shipping_amount= $jq("#shipping_charge_input").val();
        var subtotal= $jq("#subtotal_amount_input").val();
        var total= $jq("#total_amount_input").val();
        $jq("#coupon_error").html(' ');
        $jq('#payment').show();
        $jq('.order-now').hide();
        
        $jq('.cart-coupon').hide();
        
      
        $jq('#payment_coupon_code').val();
        $jq('#discount').val();
        $jq('#coupon_type').val(0);


        $jq.ajax({
            url: 'ajax.php',

            data: {
                key: 1,
                code: code,
                shipping_amount:shipping_amount,
                subtotal:subtotal,
                total:total
                
            },
            type: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status == 'OK') {
                	$jq('.cart-coupon').show();
                    $jq('#amount').val(data.total);
                    $jq('#payment_coupon_code').val(code);
                    $jq('#discount').val(data.discount_amount);
                    $jq('#coupon_type').val(data.type_id);
                    $jq('#total_discount').html("$"+data.discount_amount);
                    $jq('#total_amount').html("$"+data.total);
                    $jq('#code_text').html(code+"("+data.discount+")");
                    if (data.type_id == 1) {
                        $jq('#payment').hide();
                        $jq('.order-now').show();
                    }

                } else {
                    $jq('#coupon_error').html('<p class="error">' + data.error + '</p>');

                }

            }

        });  


    });
    
    $jq('#delete_coupon').on('click', function() {
    	  var total= $jq("#total_amount_input").val();
    	  $jq('#total_amount').html("$"+total);
    	  $jq('#amount').val(total);
    	  $jq('#payment').show();
          $jq('.order-now').hide();
          $jq('.cart-coupon').hide();
    });

    $jq('.order-now').on('click', function() {


        var line1 = $jq.trim($jq('#billing_address_1').val());
        var line2 = $jq.trim($jq('#billing_address_2').val());
        var city = $jq.trim($jq('#billing_city').val());
        var country = $jq.trim($jq('#billing_country').val());
        var state = $jq.trim($jq('#billing_state').val());
        var zip = $jq.trim($jq('#billing_postcode').val());
        var fName = $jq.trim($jq('#billing_first_name').val());
        var lName = $jq.trim($jq('#billing_last_name').val());
        var email = $jq.trim($jq('#billing_email').val());
        var emailConf = $jq.trim($jq('#billing_email_confirm').val());
        var phone = $jq.trim($jq('#billing_phone').val());

        var lovenote = $jq.trim($jq('#lovenoteinput').val());

        var file = $jq.trim($jq('#childspicture').val())



        $jq('#billing_address_1').removeClass('error');
        $jq('#billing_address_2').removeClass('error');
        $jq('#billing_city').removeClass('error');
        $jq('#billing_country').removeClass('error');
        $jq('#billing_state').removeClass('error');
        $jq('#billing_postcode').removeClass('error');
        $jq('#billing_first_name').removeClass('error');
        $jq('#billing_last_name').removeClass('error');
        $jq('#billing_email').removeClass('error');
        $jq('#billing_email_confirm').removeClass('error');
        $jq('#billing_phone').removeClass('error');


        $jq(".cws_msg_box.error-box").slideUp('fast');
        $jq('#msg_error_box_text').html('');
        var error = false;

        if (!isEmail(email)) {
            $jq('#billing_email').addClass('error');
            $jq('#billing_email_confirm').addClass('error');

            $jq('#msg_error_box_text').append('<p class="error">Email field does not contain a valid email address.</p>');

            error = true;
        }

        if (email !== emailConf) {
            $jq('#billing_email').addClass('error');
            $jq('#billing_email_confirm').addClass('error');

            $jq('#msg_error_box_text').append('<p class="error">Email and Email Confirm must match.</p>');

            error = true;
        }

        if (phone === '') {
            $jq('#billing_phone').addClass('error');
            $jq('#msg_error_box_text').append('<p class="error">Phone Number must not be left blank</p>');
            error = true;
        }

        if (state === '') {
            $jq('#billing_state').addClass('error');
            $jq('#msg_error_box_text').append('<p class="error">State must not be left blank.</p>');
            error = true;
        }

        if (zip === '') {
            $jq('#billing_postcode').addClass('error');
            $jq('#msg_error_box_text').append('<p class="error">Postcode/Zip must not be left blank.</p>');
            error = true;
        }
        if (country === '') {
            $jq('#billing_country').addClass('error');
            $jq('#msg_error_box_text').append('<p class="error">Country must not be left blank.</p>');
            error = true;
        }
        if (city === '') {
            $jq('#billing_city').addClass('error');
            $jq('#msg_error_box_text').append('<p class="error">City must not be left blank.</p>');
            error = true;
        }
        if (line1 === '') {
            $jq('#billing_address_1').addClass('error');
            $jq('#msg_error_box_text').append('<p class="error">Address must not be left blank.</p>');
            error = true;
        }

        if ((fName + lName) === '') {
            $jq('#billing_first_name').addClass('error');
            $jq('#billing_last_name').addClass('error');
            $jq('#msg_error_box_text').append('<p class="error"></p>');
            //Name must not be left blank.
            error = true;
        }
        
       
    
        if (error) {
            $jq(".cws_msg_box.error-box").slideDown('fast');
            //stop the payment spinner.
            return;
        }
        var hair = $jq('#selectedhairtype').val();
        var haircolor = $jq('#selectedhaircolor').val();
        var body = $jq('#selectedbodytype').val();
        var bodycolor = $jq('#selectedskincolor').val();
        var eyes = $jq('#selectedeyestype').val();
        $jq.ajax({
            type: "POST",
            url: "checkout-ajax.php",
            data: $jq('#checkout').serialize() + "&hair=" + hair + "&haircolor=" + haircolor + "&body=" + body + "&bodycolor=" + bodycolor +
                "&eyes=" + eyes,
            dataType: "json",
            success: function(data) {
                if (data.status == 'OK') {
                    location.href = 'thank-you';
                }

            }
        });
    });


    $jq('#cartCheckout').on('click', function(event) {
        event.preventDefault();
        var error = false;
        $jq(".cws_msg_box.error-box").slideUp('fast');
        $jq('#msg_error_box_text').html('');
        var lovenote = $jq.trim($jq('#lovenotenote').val());
        var file = $jq.trim($jq('#childspicture').val())

        if (lovenote.length == 0) {
            $jq('#lovenoteinput').addClass('error');

            $jq('#msg_error_box_text').append('<p class="error">Don\'t forget to write a lovenote for your child.</p>');
            error = true;
        }

        if (file === '') {
            $jq('#childpictureinput').addClass('error');
            $jq('#msg_error_box_text').append('<p class="error">Don\'t forget to select a picture of your child.</p>');
            error = true;
        }

      if($jq('input[type="checkbox"]').prop("checked") == false){
         error = true;
         $jq('.checkmark').addClass('error');
         $jq('#msg_error_box_text').append('<p class="error">Please accept the proof.</p>');
      }
        if (error) {
            $jq(".cws_msg_box.error-box").slideDown('fast');
            //stop the payment spinner.
            return;
        }
        var hair = $jq('#selectedhairtype').val();
        var haircolor = $jq('#selectedhaircolor').val();
        var body = $jq('#selectedbodytype').val();
        var bodycolor = $jq('#selectedskincolor').val();
        var eyes = $jq('#selectedeyestype').val();
         var time= Date.now();
        $jq.ajax({
            type: "POST",
            url: "cartSave.php",
            data: $jq('#checkout').serialize() + "&hair=" + hair + "&haircolor=" + haircolor + "&body=" + body + "&bodycolor=" + bodycolor +
                "&eyes=" + eyes,
            dataType: "json",
            success: function(data) {
                if (data.status == 'OK') {
                     location.href="checkout?t"+time;
                }

            }
        });

    });
    
    
    $jq(document).ajaxStart(function(){
      //alert('start');
      });
    $jq(document).ajaxComplete(function(){
       // $("#wait").css("display", "none");
      });
});
