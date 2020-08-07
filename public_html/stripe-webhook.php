<?php
	require_once 'swim.php';
	require $SWIM['basepath'].'../swim/stripe/init.php';

	$db=new database();
	$db->databaseName($SWIM['dbDatabaseName']);
	$db->username($SWIM['dbUsername']);
	$db->password($SWIM['dbPass']);
	$db->connect();

	header('Content-Type: application/json');

	$stripe=new stripe();

	$result=$stripe->verifyWebhook($SWIM['stripe.com']['webhook_secret']);

	if($result[0]===true)
	{
		$details='';

		//Fulfill any orders, e-mail receipts, etc
		//To cancel the payment you will need to issue a Refund (https://stripe.com/docs/api/refunds)
		if($result[1]->type=='payment_intent.succeeded')
		{
			$details='Payment received!';
		}
		else if($result[1]->type=='payment_intent.payment_failed')$details='Payment failed.';
		else if($result[1]->type=='charge.succeeded')
		{
//currently not error handling the update...
			$db->query('UPDATE `payments` SET paid_response="'.$db->escape(json_encode($result[1])).'",paid="1",paymentid="'.$db->escape($result[1]->data->object->id).'" WHERE paymentintentid="'.$db->escape($result[1]->data->object->payment_intent).'" AND paymentprocessor="1"');
			$rez=$db->exe();

			$details='Payment Success!';
		}
		else if($result[1]->type=='charge.refunded')
		{
//currently not error handling the update...
			$db->query('UPDATE `payments` SET refunded_response="'.$db->escape(json_encode($result[1])).'",refunded="1",refundid="'.$db->escape($result[1]->data->object->refunds->data->id).'" WHERE paymentid="'.$db->escape($result[1]->data->object->id).'" AND paymentprocessor="1"');
			$rez=$db->exe();

			$details='Payment Successfully Flaged as Refunded!';
		}
		
		
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