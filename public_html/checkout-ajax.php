<?php
  session_start();
    require_once 'swim.php';
    $db=new database();
    $db->databaseName($SWIM['dbDatabaseName']);
    $db->username($SWIM['dbUsername']);
    $db->password($SWIM['dbPass']);
    $db->connect();


 
     $response['status']='NOK';

  
     $carts= isset($_COOKIE['carts'])?$_COOKIE['carts']:'';
     if(!empty($carts))
     {
         $paidResponse['name']= $_POST['billing_first_name'].' '.$_POST['billing_last_name']; 
         $paidResponse['line1']= $_POST['billing_address_1']; 
         $paidResponse['line2']= $_POST['billing_address_2']; 
         $paidResponse['city']= $_POST['billing_city']; 
         $paidResponse['state']= $_POST['billing_state']; 
         $paidResponse['country']= $_POST['billing_country']; 
         $paidResponse['phone']= $_POST['billing_phone']; 
         $paidResponse['email']= $_POST['billing_email']; 
         $paidResponse['postal_code']= $_POST['billing_postcode']; 
         $billinginfo= json_encode($paidResponse);
         
      
         $insert=0;
         $carts= json_decode($carts,true);   
         foreach($carts as $key=> $cart){   
             $orderCount=$key+1;
            
             $pages=isset($cart['pages'])?implode('-',array_slice($cart['pages'],0,10)):0;

    $db->query('INSERT INTO `payments`
(`amount`,`paymentprocessor`, `paid`,`type_id`,`hair`,`haircolor`,`eyes`,`eyescolor`,`glasses`,`freckles`,`body`,`bodycolor`,`pages`,`billing_info`,`order_id`,`order_count`,`quantity`,`coupon_code`,`discount`,`coupon_type`
,`childsname`
,`lovenote`,`childspicture`,`timestamp`) VALUES

("'.$_POST['amount'].'","1","1",
"' . $db->escape($cart['type']) . '",
"' . $db->escape(isset($cart['hairtype'])?$cart['hairtype']:0) . '",
"' . $db->escape(isset($cart['haircolor'])?$cart['haircolor']:0) . '",
"' . $db->escape(isset($cart['eyestype'])?$cart['eyestype']:0) . '",
"' . $db->escape(isset($cart['eyescolor'])?$cart['eyescolor']:0) . '",
"' . $db->escape(isset($cart['glasses'])?$cart['glasses']:0) . '",
"' . $db->escape(isset($cart['freckles'])?$cart['freckles']:0) . '",
"' . $db->escape(isset($cart['bodytype'])?$cart['bodytype']:0) . '",
"' . $db->escape(isset($cart['skincolor'])?$cart['skincolor']:0) . '",
"'.$db->escape($pages).'",
"'.$db->escape($billinginfo).'",
"' .$insert . '",
"' . $orderCount . '",
"' . $db->escape(isset($cart['quantity'])?$cart['quantity']:0) . '",
"'.$_POST['coupon_code'].'",
"'.$_POST['discount'].'",
"'.$_POST['coupon_type'].'",
"' . $db->escape(html_entity_decode(isset($cart['childsname'])?$cart['childsname']:'')) . '",
"' . $db->escape(isset($cart['lovenote'])?$cart['lovenote']:'') . '",
"' . $db->escape(isset($cart['childspicture'])?$cart['childspicture']:'') . '","' . $db->escape(time()) . '")');

    $payDbResult=$db->exe(); 
    
    if(empty($insert))
    {
        $insert=  mysqli_insert_id($db->link());
        
    }

    if($payDbResult===false)
    {
       $response['error']='Something Went Wrong';
    }else {
        $response['status']='OK';
        setcookie('carts', " ", time() - 3600,"/");
    }
  }
    }else {
        $response['error']='Your cart is empty';
   }
  
   echo json_encode($response);die();  

    

