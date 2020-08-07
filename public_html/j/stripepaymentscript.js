// A reference to Stripe.js
var stripe;



//itms:[{id:1}] (use this to link the items on the front end to the backend. You an do security checks on these values from create-stripe-payment-intent.php
//formId: id of the form that contains the credit card input. Please note the layout of the form from within StripePaymentForm.html
//paymentIntentPHPUrl: The url to create-stripe-payment-intent.php. This parameter is here so that the coder can rename this file as they wish or call on different payment intent files depending on the instance!!!
//callbackIntentCreated: the callback function that is called AFTER the payment intent. stripe,card, and clientSecret are passed to this.
//callbackPaymentSuccess: called when a payment is successfully made. result is passed to this function.
//callbackPaymentFailure: called when a payment fails to go through. result is passed to this function.
function createStripePaymentIntent(itms,formId,paymentIntentPHPUrl,callbackIntentCreated,callbackPaymentSuccess,callbackPaymentFailure)
{
//Eventaully verify that variable "itms" is valid. It must be an array of objects. Each object with an id property. the id will be the id of the item the user is attempting to purchase!
 
var pages='';
$jq('.hiddenpagesinput').each(function(index)
{
	if(index!==0)pages+='-';

	pages+=$jq(this).val();
});
	var orderData=
	{
		items:itms,
		hair:$jq('#selectedhairtype').val(),
		haircolor:$jq('#selectedhaircolor').val(),
		eyes:$jq('#selectedeyestype').val(),
		eyescolor:$jq('#selectedeyescolor').val(),
		glasses:$jq('#selectedglasses').val(),
		freckles:$jq('#selectedfreckles').val(),
		body:$jq('#selectedbodytype').val(),
		bodycolor:$jq('#selectedskincolor').val(),
		childsname:$jq('#childsname').val(),
		lovenote:$jq('#lovenotenote').val(),
		childspicture:$jq('#childspicture').val(),
		amount:$jq('#amount').val(),
		discount:$jq('#discount').val(),
		coupon_type:$jq('#coupon_type').val(),
		coupon_code:$jq('#payment_coupon_code').val(),
		pages:pages
	};

	//Disable the button until we have Stripe set up on the page
	//document.querySelector("button").disabled=true;

	fetch(paymentIntentPHPUrl,{
		method:"POST",
		headers:{
			"Content-Type":"application/json"
		},
		body:JSON.stringify(orderData)
	}).then(function(result)
	{
		return result.json();
	}).then(function(data)
	{

//data.errorCode should be tracked here, make sure it returns from setupElements!!!
		return setupElements(data,formId);
	}).then(function({stripe,card,clientSecret})
	{
		//document.querySelector("button").disabled=false;
		//Handle form submission.

		var form=document.getElementById(formId);
		form.addEventListener("submit",function(event)
		{
			event.preventDefault();
			//Initiate payment when the submit button is clicked
			pay(stripe,card,clientSecret,formId,callbackPaymentSuccess,callbackPaymentFailure);
		});

if(isFunction(callbackIntentCreated))callbackIntentCreated(stripe,card,clientSecret);
	});
}

//Set up Stripe.js and Elements to use in checkout form
var setupElements=function(data,formId)
{
	stripe=Stripe(data.publishableKey);
	var elements=stripe.elements();
	var style={
		base:{
			color:"#32325d",
			fontFamily:'"Helvetica Neue", Helvetica, sans-serif',
			fontSmoothing:"antialiased",
			fontSize:"16px",
			"::placeholder":{
				color:"#aab7c4"
			}
		},
		invalid:{
		color:"#fa755a",
		iconColor:"#fa755a"
		}
	};

	var card=elements.create("card",{style:style});
	card.mount("#"+formId+' .card-element');

	return {
		stripe:stripe,
		card:card,
		clientSecret:data.clientSecret
	};
};

/*
 * Calls stripe.confirmCardPayment which creates a pop-up modal to
 * prompt the user to enter extra authentication details without leaving your page
 */
var pay=function(stripe,card,clientSecret,formId,callbackSuccess,callbackFailure)
{
	changeLoadingState(true,formId);

var line1=$jq.trim($jq('#billing_address_1').val());
var line2=$jq.trim($jq('#billing_address_2').val());
var city=$jq.trim($jq('#billing_city').val());
var country=$jq.trim($jq('#billing_country').val());
var state=$jq.trim($jq('#billing_state').val());
var zip=$jq.trim($jq('#billing_postcode').val());
var fName=$jq.trim($jq('#billing_first_name').val());
var lName=$jq.trim($jq('#billing_last_name').val());
var email=$jq.trim($jq('#billing_email').val());
var emailConf=$jq.trim($jq('#billing_email_confirm').val());
var phone=$jq.trim($jq('#billing_phone').val());

var lovenote= $jq.trim($jq('#lovenoteinput').val());

var file= $jq.trim($jq('#childspicture').val())



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
var error=false;

if(!isEmail(email))
{
	$jq('#billing_email').addClass('error');
	$jq('#billing_email_confirm').addClass('error');

	$jq('#msg_error_box_text').append('<p class="error">Email field does not contain a valid email address.</p>');

	error=true;
}

if(email!==emailConf)
{
	$jq('#billing_email').addClass('error');
	$jq('#billing_email_confirm').addClass('error');

	$jq('#msg_error_box_text').append('<p class="error">Email and Email Confirm must match.</p>');

	error=true;
}

if(phone==='')
{
	$jq('#billing_phone').addClass('error');

	$jq('#msg_error_box_text').append('<p class="error">Phone Number must not be left blank</p>');

	error=true;
}

if(state==='')
{
	$jq('#billing_state').addClass('error');
	$jq('#msg_error_box_text').append('<p class="error">State must not be left blank.</p>');

	error=true;
}

if(zip==='')
{
	$jq('#billing_postcode').addClass('error');
	$jq('#msg_error_box_text').append('<p class="error">Postcode/Zip must not be left blank.</p>');

	error=true;
}

if(country==='')
{
	$jq('#billing_country').addClass('error');
	$jq('#msg_error_box_text').append('<p class="error">Country must not be left blank.</p>');

	error=true;
}

if(city==='')
{
	$jq('#billing_city').addClass('error');

	$jq('#msg_error_box_text').append('<p class="error">City must not be left blank.</p>');

	error=true;
}

if(line1==='')
{
	$jq('#billing_address_1').addClass('error');
	$jq('#msg_error_box_text').append('<p class="error">Address must not be left blank.</p>');
	error=true;    
} 
	if((fName+lName)==='')
	{
		$jq('#billing_first_name').addClass('error');
		$jq('#billing_last_name').addClass('error');

		$jq('#msg_error_box_text').append('<p class="error"></p>');
		//Name must not be left blank.
		error=true;
	}
	
	
	
	
	 
	
	
if(error)
{
	changeLoadingState(false,formId);
	$jq(".cws_msg_box.error-box").slideDown('fast');
//stop the payment spinner.
return;
}

	stripe.confirmCardPayment(clientSecret,
		{
			payment_method:{card:card},
			shipping:{
				address:{
					line1:line1,
					line2:line2,
					city:city,
					country:country,     
					postal_code:zip,
					state:state
				},
				name:$jq.trim(fName+' '+lName),
				phone:phone,
			},
			receipt_email:email
		})
		.then(function(result){
			if(result.error)
			{  
				//Show error to your customer
				showError(result.error.message,formId);
if(isFunction(callbackFailure))callbackFailure(result);
			}
			else
			{ 
				//The payment has been processed!
				orderComplete(clientSecret,formId);
if(isFunction(callbackSuccess))callbackSuccess(result);
			}
		});
};

/* ------- Post-payment helpers ------- */
/* Shows a success / error message when the payment is complete */
var orderComplete=function(clientSecret,formId)
{
	stripe.retrievePaymentIntent(clientSecret).then(function(result)
	{
		var paymentIntent=result.paymentIntent;
		var paymentIntentJson=JSON.stringify(paymentIntent,null,2);
		document.querySelector('#'+formId).classList.add("hidden");
		document.querySelector('#'+formId+'pre').textContent=paymentIntentJson;
		document.querySelector('#'+formId+'sr-result').classList.remove("hidden");
		setTimeout(function()
		{
			document.querySelector('#'+formId+'sr-result').classList.add("expand");
		},200);
		
		 $jq.ajax({
	            type: "POST",
	            url: "ajax.php",
	            data: {
	            	key:2
	            },
	            dataType: "json",
	            success: function(data) {
	                if (data.status == 'OK') {
	                    location.href = 'thank-you';
	                }
	            }
	        });
		changeLoadingState(false,formId);
	}); 

};

var showError=function(errorMsgText,formId)
{
	changeLoadingState(false,formId);
	var errorMsg=document.querySelector('#'+formId+' .sr-field-error');
	errorMsg.textContent=errorMsgText;
	setTimeout(function()
	{
		errorMsg.textContent="";
	},4000);
};

//Show a spinner on payment submission
var changeLoadingState=function(isLoading,formId)
{
	if(isLoading)
	{
		document.querySelector('#'+formId+' button').disabled = true;
		document.querySelector('#'+formId+' .spinner').classList.remove("hidden");
		document.querySelector('#'+formId+' .button-text').classList.add("hidden");
	}
	else
	{
		document.querySelector('#'+formId+' button').disabled = false;
		document.querySelector('#'+formId+' .spinner').classList.add("hidden");
		document.querySelector('#'+formId+' .button-text').classList.remove("hidden");
	}
};