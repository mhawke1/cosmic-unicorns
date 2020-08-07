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
	var orderData=
	{
		items:itms//,
		//currency:"usd"
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
	//Initiate the payment.
	//If authentication is required, confirmCardPayment will automatically display a modal
	stripe
		.confirmCardPayment(clientSecret,{payment_method:{card:card}})
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
console.log('#'+formId+'pre');
		document.querySelector('#'+formId+'pre').textContent=paymentIntentJson;
		document.querySelector('#'+formId+'sr-result').classList.remove("hidden");
		setTimeout(function()
		{
			document.querySelector('#'+formId+'sr-result').classList.add("expand");
		},200);

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