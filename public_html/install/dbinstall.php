<?php
	require_once 'swim.php';

	$db=new database();
	$db->databaseName($SWIM['dbDatabaseName']);
	$db->username($SWIM['dbUsername']);
	$db->password($SWIM['dbPass']);
	$db->connect();

//First insert 'payments' (status default=0), 'books', and 'bookpages' into the database
//Send the Payments ID over to the payment processor!
	$db->tablePrefix('');
	$db->tableName('payments');
	$db->clearCreateTableColumns();
	$db->createTableColumn('id', 'BIGINT', null, array('UNSIGNED', 'PRIMARY KEY', 'AUTO_INCREMENT', 'UNIQUE'), null, true, false);
	$db->createTableColumn('status', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 0, false, true);
//step 0 = disabled/deleted/removed
//step 1 = refunded
//step 2 = unpaid
//step 3 = paid
//step 4 = shipped
	
//images
//Lovenote
	$db->createTableColumn('paid', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 0, false, true);
	$db->createTableColumn('refunded', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 0, false, true);
	$db->createTableColumn('shippedtocustomer', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 0, false, true);
	$db->createTableColumn('pdfdownloaded', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 0, false, true);
	$db->createTableColumn('senttoprinters', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 0, false, true);
	$db->createTableColumn('printing', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 0, false, true);
	$db->createTableColumn('paymentintent_response', 'TEXT', array(4096), array('CHARACTER SET utf8'), '', true, false);
	$db->createTableColumn('paid_response', 'TEXT', array(4096), array('CHARACTER SET utf8'), '', true, false);
	$db->createTableColumn('refunded_response', 'TEXT', array(4096), array('CHARACTER SET utf8'), '', true, false);
//paymentprocessor 1 = Stripe
	$db->createTableColumn('paymentprocessor', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), null, false, true);//0=stripe,1=paypal,2=amazonPay
	$db->createTableColumn('paymentintentid', 'CHAR', array(255), array('CHARACTER SET utf8'), null, true, false);
	$db->createTableColumn('paymentid', 'CHAR', array(255), array('CHARACTER SET utf8'), null, true, false);
	$db->createTableColumn('refundid', 'CHAR', array(255), array('CHARACTER SET utf8'), null, true, false);
	$db->createTableColumn('hair', 'TINYINT', array(2), array('UNSIGNED', 'NOT NULL'), 0, false, true);
	$db->createTableColumn('haircolor', 'TINYINT', array(2), array('UNSIGNED', 'NOT NULL'), 0, false, true);
	$db->createTableColumn('eyes', 'TINYINT', array(2), array('UNSIGNED', 'NOT NULL'), 0, false, true);
	$db->createTableColumn('eyescolor', 'TINYINT', array(2), array('UNSIGNED', 'NOT NULL'), 0, false, true);
	$db->createTableColumn('glasses', 'TINYINT', array(2), array('UNSIGNED', 'NOT NULL'), 0, false, true);
	$db->createTableColumn('freckles', 'TINYINT', array(2), array('UNSIGNED', 'NOT NULL'), 0, false, true);
	$db->createTableColumn('body', 'TINYINT', array(2), array('UNSIGNED', 'NOT NULL'), 0, false, true);
	$db->createTableColumn('bodycolor', 'TINYINT', array(2), array('UNSIGNED', 'NOT NULL'), 0, false, true);
	$db->createTableColumn('pages', 'CHAR', array(64), array('CHARACTER SET ASCII', 'NOT NULL'), null, true, false);
	$db->createTableColumn('childsname', 'VARCHAR', array(128), array('CHARACTER SET utf8', 'NOT NULL'), null, true, false);
	$db->createTableColumn('lovenote', 'VARCHAR', array(1024), array('CHARACTER SET utf8', 'NOT NULL'), null, true, false);
	$db->createTableColumn('childspicture', 'VARCHAR', array(1024), array('CHARACTER SET utf8', 'NOT NULL'), null, true, false);

	$db->createTableColumn('ip', 'BIGINT', null, array('UNSIGNED', 'NOT NULL'), null, false, true);
	$db->createTableColumn('timestamp', 'BIGINT', null, array('UNSIGNED','NOT NULL'), null, false, true);
	var_dump($db->createTable());
	var_dump($db->error());

	$db->tablePrefix('');
	$db->tableName('domains');
	$db->clearCreateTableColumns();
	$db->createTableColumn('id', 'BIGINT', null, array('UNSIGNED', 'PRIMARY KEY', 'AUTO_INCREMENT', 'UNIQUE'), null, true, false);
	$db->createTableColumn('status', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 1, false, true);
	$db->createTableColumn('name', 'CHAR', array(64), array('CHARACTER SET utf8', 'UNIQUE', 'NOT NULL'), null, true, false);
	$db->createTableColumn('ip', 'BIGINT', null, array('UNSIGNED', 'NOT NULL'), null, false, true);
	$db->createTableColumn('timestamp', 'BIGINT', null, array('UNSIGNED','NOT NULL'), null, false, true);
	var_dump($db->createTable());
	var_dump($db->error());

	$db->tablePrefix('');
	$db->tableName('emails');
	$db->clearCreateTableColumns();
	$db->createTableColumn('id', 'BIGINT', null, array('UNSIGNED', 'PRIMARY KEY', 'AUTO_INCREMENT', 'UNIQUE'), null, true, false);
	$db->createTableColumn('status', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 1, false, true);
	$db->createTableColumn('name', 'CHAR', array(64), array('CHARACTER SET utf8', 'UNIQUE', 'NOT NULL'), null, true, false);
	$db->createTableColumn('domain', 'BIGINT', null, array('UNSIGNED', 'NOT NULL'), null, false, true);
	$db->createTableColumn('ip', 'BIGINT', null, array('UNSIGNED', 'NOT NULL'), null, false, true);
	$db->createTableColumn('timestamp', 'BIGINT', null, array('UNSIGNED','NOT NULL'), null, false, true);
	var_dump($db->createTable());
	var_dump($db->error());

	$db->tablePrefix('');
	$db->tableName('ip');
	$db->clearCreateTableColumns();
	$db->createTableColumn('id', 'BIGINT', null, array('UNSIGNED', 'PRIMARY KEY', 'AUTO_INCREMENT', 'UNIQUE'), null, true, false);
	$db->createTableColumn('status', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 1, false, true);
	$db->createTableColumn('ip', 'VARBINARY', array(16), array('UNIQUE','NOT NULL'), null, true, false);
	$db->createTableColumn('timestamp', 'BIGINT', null, array('UNSIGNED','NOT NULL'), null, false, true);
	var_dump($db->createTable());
	var_dump($db->error());

	$db->tablePrefix('');
	$db->tableName('timestamps');
	$db->clearCreateTableColumns();
	$db->createTableColumn('id', 'BIGINT', null, array('UNSIGNED', 'PRIMARY KEY', 'AUTO_INCREMENT', 'UNIQUE'), null, true, false);
	$db->createTableColumn('status', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 1, false, true);
	$db->createTableColumn('timestamp', 'BIGINT', null, array('UNSIGNED', 'NOT NULL'), null, false, true);
	var_dump($db->createTable());
	var_dump($db->error());

	$db->tablePrefix('');
	$db->tableName('useremails');
	$db->clearCreateTableColumns();
	$db->createTableColumn('id', 'BIGINT', null, array('UNSIGNED', 'PRIMARY KEY', 'AUTO_INCREMENT', 'UNIQUE'), null, true, false);
	$db->createTableColumn('status', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 1, false, true);
	$db->createTableColumn('email', 'BIGINT', null, array('UNSIGNED'), null, false, true);
	$db->createTableColumn('user', 'BIGINT', null, array('UNSIGNED'), null, false, true);
	$db->createTableColumn('ip', 'BIGINT', null, array('UNSIGNED', 'NOT NULL'), null, false, true);
	$db->createTableColumn('timestamp', 'BIGINT', null, array('UNSIGNED','NOT NULL'), null, false, true);
	var_dump($db->createTable());
	var_dump($db->error());

	$db->tablePrefix('');
	$db->tableName('users');
	$db->clearCreateTableColumns();
	$db->createTableColumn('id', 'BIGINT', null, array('UNSIGNED', 'PRIMARY KEY', 'AUTO_INCREMENT', 'UNIQUE'), null, true, false);
	$db->createTableColumn('status', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 1, false, true);
	$db->createTableColumn('fname', 'CHAR', array(32), array(), '', true, true);
	$db->createTableColumn('lname', 'CHAR', array(32), array(), '', true, true);
	$db->createTableColumn('password', 'CHAR', array(255), array('BINARY', 'NOT NULL'), null, true, true);
	$db->createTableColumn('ip', 'BIGINT', null, array('UNSIGNED', 'NOT NULL'), null, false, true);
	$db->createTableColumn('timestamp', 'BIGINT', null, array('UNSIGNED','NOT NULL'), null, false, true);


  var_dump($db->createTable());
	var_dump($db->error());

	$db->tablePrefix('');
	$db->tableName('banner');
	$db->clearCreateTableColumns();
	$db->createTableColumn('id', 'BIGINT', null, array('UNSIGNED', 'PRIMARY KEY', 'AUTO_INCREMENT', 'UNIQUE'), null, true, false);
	$db->createTableColumn('status', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 1, false, true);
	$db->createTableColumn('title', 'CHAR', array(255), array('CHARACTER SET utf8'), null, true, false);

	$db->createTableColumn('description', 'TEXT', array(4096), array('CHARACTER SET utf8'), null, true, false);


	$db->createTableColumn('timestamp', 'BIGINT', null, array('UNSIGNED','NOT NULL'), null, false, true);
	var_dump($db->createTable());
	var_dump($db->error());


		$db->tablePrefix('');
	$db->tableName('coupon');
	$db->clearCreateTableColumns();
	$db->createTableColumn('id', 'BIGINT', null, array('UNSIGNED', 'PRIMARY KEY', 'AUTO_INCREMENT', 'UNIQUE'), null, true, false);
	$db->createTableColumn('status', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 1, false, true);
	$db->createTableColumn('title', 'CHAR', array(255), array('CHARACTER SET utf8'), null, true, false);
	$db->createTableColumn('code', 'CHAR', array(255), array('CHARACTER SET utf8'), null, true, false);

	$db->createTableColumn('discount', 'CHAR', array(255), array('CHARACTER SET utf8'), null, true, false);

	$db->createTableColumn('description', 'TEXT', array(4096), array('CHARACTER SET utf8'), null, true, false);
	$db->createTableColumn('type_id', 'TINYINT', array(1), array('UNSIGNED', 'NOT NULL'), 1, false, true);


	$db->createTableColumn('timestamp', 'BIGINT', null, array('UNSIGNED','NOT NULL'), null, false, true);

	var_dump($db->createTable());
	var_dump($db->error());
?>