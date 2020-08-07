<?php
	require_once 'swim.php';


$cookie_name = "carts";
//setcookie($cookie_name, " ", time() - 3600,"/");
//print_r($_COOKIE[$cookie_name]);
//print_r(json_decode($_COOKIE[$cookie_name],true));
//die();
if(!isset($_COOKIE[$cookie_name])) {
  $postData[] = $_POST;
  $cookie_value =json_encode($postData);

}else {
   $old_cookie = json_decode($_COOKIE[$cookie_name],true);
   $postData = $_POST;
   array_push($old_cookie,$postData);
   $cookie_value =json_encode($old_cookie);
  
}
setcookie($cookie_name, $cookie_value, time() + (86400 * 30 * 30), "/");
$time=time();
$newURL=$SWIM['basepath']."checkout?t=$time";
header('Location: '.$newURL); 