<?php
require_once 'swim.php';
require $SWIM['basepath'] . '../swim/stripe/init.php';

$db = new database();
$db->databaseName($SWIM['dbDatabaseName']);
$db->username($SWIM['dbUsername']);
$db->password($SWIM['dbPass']);
$db->connect();


$input = json_decode(file_get_contents('php://input'));   

if(isset($input->amount)){
    header('Content-Type: application/json');
    
    $carts= isset($_COOKIE['carts'])?$_COOKIE['carts']:'';
     if(!empty($carts))
     {  $carts= json_decode($carts,true);
         $stripe = new stripe();
         $amount= $input->amount*100;
         $stripe->setTotal($amount);
         $result = $stripe->createPaymentIntent();
         
         $result['errorCode'] = 0;
         
         $resultEncoded = json_encode($result);
         
         $insert=0;
       
         
         //$input->lovenote="test";
         
         
         // If any errors occur on this page, you should reset the payment intent process from the calling Ajax script.
         if ($result['error'] === null) {
             
             foreach($carts as $key=>$cart){
                 $orderCount=$key+1;
                 
                
                 $pages=isset($cart['pages'])?implode('-',array_slice($cart['pages'],0,10)):0;
             
             $db->query('INSERT INTO `payments`
(`paymentintentid`,`paymentprocessor`,`paymentintent_response`,`amount`,`type_id`,`coupon_code`,`discount`,`coupon_type`,`order_id`,`order_count`,`quantity`,`hair`,`haircolor`,`eyes`,`eyescolor`,`glasses`,`freckles`,`body`,`bodycolor`,`pages`
,`childsname`
,`lovenote`,`childspicture`,`timestamp`) VALUES
                 
("' . $db->escape($result['paymentintentresponse']->id) . '","1","' . $db->escape(json_encode($result['paymentintentresponse'])) . '",
"' . $db->escape($input->amount) . '",
"' . $db->escape($cart['type']) . '",
"' . $db->escape($input->coupon_code) . '",
"' . $db->escape($input->discount) . '",
"' . $db->escape($input->coupon_type) . '",
"' .$insert . '",
"' . $orderCount . '",
"' . $db->escape(isset($cart['quantity'])?$cart['quantity']:0) . '",
"' . $db->escape(isset($cart['hairtype'])?$cart['hairtype']:0) . '",
"' . $db->escape(isset($cart['haircolor'])?$cart['haircolor']:0) . '",
"' . $db->escape(isset($cart['eyestype'])?$cart['eyestype']:0) . '",
"' . $db->escape(isset($cart['eyescolor'])?$cart['eyescolor']:0) . '",
"' . $db->escape(isset($cart['glasses'])?$cart['glasses']:0) . '",
"' . $db->escape(isset($cart['freckles'])?$cart['freckles']:0) . '",
"' . $db->escape(isset($cart['bodytype'])?$cart['bodytype']:0) . '",
"' . $db->escape(isset($cart['skincolor'])?$cart['skincolor']:0) . '",
"' . $db->escape($pages) . '",
"' . $db->escape(html_entity_decode(isset($cart['childsname'])?$cart['childsname']:'')) . '",
"' . $db->escape(isset($cart['lovenote'])?$cart['lovenote']:'') . '",
"' . $db->escape(isset($cart['childspicture'])?$cart['childspicture']:'') . '","' . $db->escape(time()) . '")');
             
             $payDbResult = $db->exe();
             if(empty($insert))
             {
                 
                 $insert=  mysqli_insert_id($db->link());
                 
             }
             if ($payDbResult === false) {
                 // An error occurred while trying to insert the payment intent into the database.
                 $result['errorCode'] = 2;
             }
            }
         } else {
             // An error occurred while trying to
             $result['errorCode'] = 1;
         }
     }else {
         $result['errorCode'] = 1;
     }
    
}else {
    $result['errorCode'] = 1;
}


echo json_encode($result);
?>