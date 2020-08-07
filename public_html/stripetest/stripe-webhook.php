<?php
	require_once 'swim.php';
	require $SWIM['basepath'].'../swim/stripe/init.php';

	header('Content-Type: application/json');

	$stripe=new stripe();
	$result=$stripe->verifyWebhook('whsec_c2D6L4KnPAowJDn5KPd8yRGqNo6GvmfS');
	if($result[0]===true)
	{
		$details='';

		//Fulfill any orders, e-mail receipts, etc
		//To cancel the payment you will need to issue a Refund (https://stripe.com/docs/api/refunds)
		if($result[1]->type=='payment_intent.succeeded')$details='Payment received!';
		else if($result[1]->type=='payment_intent.payment_failed')$details='Payment failed.';
		else if($result[1]->type=='charge.succeeded')$details='Payment Success!';

		$output=[
			'status'=>'success',
			'details'=>$details,
			'type'=>$result[1]->type
		];

		echo json_encode($output,JSON_PRETTY_PRINT);
	}
	else
	{
		http_response_code(403);
		die(json_encode(['error'=>$result[1]->getMessage()]));
	}
?>