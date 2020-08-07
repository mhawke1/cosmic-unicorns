<?php
	require_once 'swim.php';
	require $SWIM['basepath'].'../swim/stripe/init.php';

	header('Content-Type: application/json');
	$stripe=new stripe();
	echo $stripe->createPaymentIntent();
?>