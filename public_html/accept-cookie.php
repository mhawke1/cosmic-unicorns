<?php 

require_once 'swim.php';
$cookie_name = "accept_cookie";

$id= isset($_GET['id'])?$_GET['id']:'';
if(!empty($id))
{
    setcookie($cookie_name, " ", time() - 3600,"/");
    
   
}else {
    setcookie($cookie_name,'Yes', time() + (86400 * 30 * 30), "/");
}

$time= time();
$newURL=$SWIM['basepath']."?t=$time";
header('Location: '.$newURL);