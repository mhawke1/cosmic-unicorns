<?php


  session_start();
    require_once 'swim.php';
    $db=new database();
    $db->databaseName($SWIM['dbDatabaseName']);
    $db->username($SWIM['dbUsername']);
    $db->password($SWIM['dbPass']);
    $db->connect();

    $key= isset($_POST['key'])?$_POST['key']:'';
     $response['status']='NOK';
    if(empty($key)){
     ignore_user_abort(true);
     define ('MAX_FILE_SIZE',1000000);
    $response['error']='';
    $childsImage='';
    $permitted=array('image/gif', 'image/jpeg', 'image/png', 'image/pjpeg'); //Set array of permittet filetypes
    $error=true; //Define an error boolean variable
    $filetype=""; //Just define it empty.
    $childImageFileName='';


      function imgResize($path) {

           ini_set('memory_limit', '-1');
           $x = getimagesize($path);            
           $width  = $x['0'];
           $height = $x['1'];

           $rs_width  = $width / 2;//resize to half of the original width.
           $rs_height = $height / 2;//resize to half of the original height.

           switch ($x['mime']) {
              case "image/gif":
                 $img = imagecreatefromgif($path);
                 break;
              case "image/jpg":
              case "image/jpeg":
                 $img = imagecreatefromjpeg($path);
                 break;
              case "image/png":
                 $img = imagecreatefrompng($path);
                 break;
           }

           $img_base = imagecreatetruecolor($rs_width, $rs_height);
           imagecopyresized($img_base, $img, 0, 0, 0, 0, $rs_width, $rs_height, $width, $height);

           $path_info = pathinfo($path);    
           switch ($path_info['extension']) {
              case "gif":
                 imagegif($img_base, $path);  
                 break;
            case "jpg":
            case "jpeg":
                 imagejpeg($img_base, $path);
                 break;
              case "png":
                 imagepng($img_base, $path);  
                 break;
           }

        }

if(array_key_exists('childspicture',$_FILES))
{
    foreach( $permitted as $key => $value ) //Run through all permitted filetypes
    {
        if( $_FILES['childspicture']['type'] == $value ) //If this filetype is actually permitted
        {
            $error = false; //Yay! We can go through
            $filetype = explode("/",$_FILES['childspicture']['type']); //Save the filetype and explode it into an array at /
            $filetype = $filetype[0]; //Take the first part. Image/text etc and stomp it into the filetype variable
        }
    }

   
  
        if( $error == false ) //If the file is permitted
        {
            $tmp_name=explode('\\',$_FILES['childspicture']["tmp_name"]);
            $tmp_name=$tmp_name[count($tmp_name)-1];

            $childImageFileName=time(). '.' . strtolower(pathinfo($_FILES['childspicture']['name'], PATHINFO_EXTENSION));;

           
            move_uploaded_file($_FILES['childspicture']["tmp_name"], "upload/" . $childImageFileName); //Move the file from the temporary position till a new one.


  if($_FILES['childspicture']['size'] >= MAX_FILE_SIZE) //Check for the size
    {
       
     

       ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
      $file_name= "upload/" . $childImageFileName;
       $img = imgResize($file_name);

    }



            if( $filetype == "image" ) //If the filetype is image, show it!
            {
                $response['status']='OK';
                $response['filename']=$childImageFileName;
                $response['img']=$childsImage;
                $childsImage='<img src="upload/'.$childImageFileName.'" class="lovenotechildspicture" style="max-width:100% !important;" />';
            }
        }
        else
        {
            $response['error']= "Not permitted filetype.";
        }
    
    echo json_encode($response);die();
}
}else if($key==1) {

   $code=  isset($_POST['code'])?trim($_POST['code']):'';
   $shipping_amount=  isset($_POST['shipping_amount'])?trim($_POST['shipping_amount']):'';
   $subtotal=  isset($_POST['subtotal'])?trim($_POST['subtotal']):'';
   $total=  isset($_POST['total'])?trim($_POST['total']):'';


   if(!empty($code)){
    

        $db->query("SELECT * FROM coupon WHERE code = '$code'");
         $res=$db->exe();
        $coupon=mysqli_fetch_assoc($res);
   if(!empty($coupon)){
   
   $min= $coupon['min'];
   if($coupon['min']<=$subtotal){
      $response['status']='OK';
      $response['type_id']=$coupon['type_id'];
     if($coupon['type_id']==0)
     {
          $response['discount']= $coupon['discount'].' %';
          $response['discount_amount']= number_format(($subtotal* $coupon['discount'])/100,2);
          $response['total']=number_format($total-$response['discount_amount'],2);
     }else if($coupon['type_id']==1)
     {
          $response['discount']= 'Pre Order';
          $response['discount_amount']= $total;
          $response['total']=0.00;
     }else {
         
         $cart= isset($_COOKIE['carts'])?$_COOKIE['carts']:[];
         if(!empty($cart))
         {
             $cart= json_decode($cart,true);
         }
         $count=count($cart);
         if($count>=2)
         {
             $response['discount']= 'Shipping Free';
             $response['discount_amount']= number_format($shipping_amount,2);
             $response['total']=number_format($total-$shipping_amount,2);
         }else {
             $response['status']='NOK';
             $response['error']='Please add 2 book to use this coupon code';
         }
        
     }
   }else {
     $response['error']="Your min order amount should be $ $min to use this coupon";
   }
   }else {
    $response['error']='Code not found';
   }

   }else {
     $response['error']='Code can not be blank';
   }
   echo json_encode($response);die();  
}else if($key==2)
{
    $response['status']='OK';
    setcookie('carts', " ", time() - 3600,"/");
    echo json_encode($response);die();  
    
}

else if($key==3)
{   $html='';
    $subTotal=0;
    $shipping_amount=0;
    $total=0;
    $cartQuantity=0;
    $response['status']='OK';
    $response['redirect']='NOK';
    
  $cookie_name = "carts";
  $old_cookie = json_decode($_COOKIE[$cookie_name],true);
  $id=  isset($_POST['id'])?trim($_POST['id']):'';
   $quantity=  isset($_POST['quantity'])?trim($_POST['quantity']):'';
   if($quantity!=0)
   {  
      $old_cookie[$id]['quantity']=$quantity;
      $cookie_value =json_encode($old_cookie);
   }else {
       
       $count=count($old_cookie);
       if($count==1)
       {
         $response['redirect']='OK';
         unset($old_cookie[$id]);
           setcookie('carts', " ", time() - 3600,"/");
         echo json_encode($response);die();
       }
       if (array_key_exists($id, $old_cookie)) {
            unset($old_cookie[$id]);
            $old_cookie = array_values($old_cookie);
             $cookie_value =json_encode($old_cookie);
       }
   }
       setcookie($cookie_name, $cookie_value, time() + (86400 * 30 * 30), "/");
       $cart = json_decode($_COOKIE[$cookie_name],true);

     
       if(!empty($cart)){
         foreach ($cart as $key=> $cartModel){ 
         $subTotal+=$cartModel['amount']*$cartModel['quantity'];
         $cartQuantity += $cartModel['quantity'];
         

         $shipping_amount=0;
         $basePath=$SWIM['basepath'].'show-book?id='.$key;
        $amount=number_format($cartModel['amount'],2);
        $order= $key+1;
        $subamount=number_format($cartModel['amount']*$cartModel['quantity'],2);
         if($cartModel['type']==1){
                  $img='YCBABookImageWeb.png';
                      }else {
                  $img='RiversBigAdventureWebBook.png';
                      }
                 $imglink= $SWIM['basepath'].'pic/revslider/general/'.$img;
               $html.='<tr>';
               $html.='<td> <a href="'.$basePath.'"><img style="max-width: 100px" src="'.$imglink.'"></a> </td>';
              $html.='<th scope="row">';
                         $html.=' <ul class="cart_list">';
                           $html.='<li class="list-inline-item pr20"><a href="#">Book '.$order.'';
                           $html.='</a>';
                           $html.=' </li>';
                         $html.=' </ul>';
                       $html.=' </th>';
                      $html.='<td class="text-thm">$'.$amount.'</td>';
                       $html.='<td>';
  $html.='<div class="num-block skin-2">';
  $html.='<div class="num-in">';
    $html.='<span class="minus dis" data-id="'.$key.'"></span>';
    $html.='<input type="text" class="in-num" id="quantity_value_'.$key.'" data-id="'.$key.'" value="'.$cartModel['quantity'].'" readonly="">';
    $html.='<span class="plus" data-id="'.$key.'"></span>';
  $html.='</div>';
$html.='</div>';
   $html.='</td>';

                      $html.='<td class="cart_total text-thm">$'.$subamount.'</td>';
  $html.='<td><a href="#" id="delete_cart" data-id="'.$key.'"><img src="'.$SWIM['basepath'].'img/delete.png" ></a></td>';
                   $html.=' </tr>';
                  }

                   $shipping_charge = 1 * 5 + ($cartQuantity - 1) * 3;
                $response['shipping_charge'] =number_format($shipping_charge, 2);
                 $response['subtotal'] =number_format($shipping_charge, 2);
                 $response['total'] =number_format($shipping_charge+$subTotal, 2);
                }else {
                  $response['redirect']='OK';
                }
     

                    $response['html']=$html;
                    

    echo json_encode($response);die();  
    
}