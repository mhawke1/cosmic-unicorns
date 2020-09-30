<?php

     ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '-1');
ini_set('max_execution_time', '0');

   require_once __DIR__ . '/../vendor/autoload.php';
   
    
   require_once 'swim.php';
   
   
   
   
   $db=new database();
   $db->databaseName($SWIM['dbDatabaseName']);
   $db->username($SWIM['dbUsername']);
   $db->password($SWIM['dbPass']);
   $db->connect();
    

/*******************page 1**************************/
require_once __DIR__ . '/pdf-css/page-cover.php'; 
   
 
    




$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];


$pdf = new \Mpdf\Mpdf([
  'mode' => 'utf-8','format' => [609.6,260.35],

    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/pdf-css',
    ]),
    'fontdata' => $fontData + [
        'frutiger' => [
            'R' => 'Caveat-Bold.ttf'
            
        ]
    ],
    'default_font' => 'frutiger'
]);



   
   $pdf->AddPageByArray([
     'margin-left' => 0,
     'margin-right' => 0,
     'margin-top' => 0,
     'margin-bottom' => 0,
   ]);
   
     $request=new request();
    
   
      $selects=['paymentprocessor','id','quantity','amount','discount','type_id','paid_response','billing_info','paymentintentid','paymentid','hair','haircolor','eyes','eyescolor','glasses','freckles','body','bodycolor','pages','childsname','lovenote','childspicture','timestamp'];
     $search=['id'=>$request->getGet('id',0)];
     $db->tablePrefix('');
     $db->tableName('payments');
     $paymentRow=$db->get($selects,$search);
   
     if($paymentRow!==false)
     {
       $paymentRow=mysqli_fetch_assoc($paymentRow);


             
       if($paymentRow!==null)
       {

          $body= $paymentRow['body'];
          $hair= $paymentRow['hair'];
          $eyes=$paymentRow['eyes'];



          $bodycolor= $paymentRow['bodycolor'];
          $haircolor= $paymentRow['haircolor'];
          $eyescolor=$paymentRow['eyescolor'];
          $childsname =$paymentRow['childsname'];

          $lovenote=$paymentRow['lovenote'];

          $childImageFileName=$paymentRow['childspicture'];


            $glasses=$paymentRow['glasses'];

          $freckles=$paymentRow['freckles'];


   
       $paymentProcessor='Stripe';
     $paymentIntentId=$paymentRow['paymentintentid'];
     if(empty($paymentIntentId))
     {
         $paymentProcessor='Pre Order';
     }
     
     if($paymentRow['type_id']==1){
      $type='Big Adventure';   
     }else {
         $type='Rivers Big Adventure';  
     }
   
   
         $responseData3=json_decode($paymentRow['paid_response']);
     $billingInfo=json_decode($paymentRow['billing_info']);
     
    $paymentProcessor='Stripe';
     $paymentIntentId=$paymentRow['paymentintentid'];
     if(empty($paymentIntentId))
     {
         $paymentProcessor='Pre Order';
     }
   
     if($paymentProcessor=='stripe')
     {
         
         $responseData3=json_decode($payment['paid_response']);
         $name= $responseData3->data->object->shipping->name;
   
     }else{
         
         $billingInfo=json_decode($paymentRow['billing_info']);
         $name =$billingInfo->name;
     }
     $nameArray= explode(' ', $name);
     $firstname= isset($nameArray[0])?$nameArray[0]:'';
     $lastname= isset($nameArray[1])?$nameArray[1]:'';
     $orderId= $paymentRow['id'];
   
     GLOBAL $SWIM;
     $childsPicture='';
     $pdfVersion=false;
   //$pages=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21];
$pages=[0];



     
     $childsPictureBackground='';
   
   $childPictureStyle='';
   if($childsPicture==='')
   {
   $childPictureStyle='background-size:contain;background-position:center;background-image:url('.$childsPictureBackground.');background-repeat:no-repeat;';
   }
     $pages=array_map('intval', $pages);
   
     if($childsPicture=='')$childsPicture='<img src="" class="lovenotechildspicture" style="width:100% !important;height:100%;"/>';
   
     $pageSeparator='';
   $res='HiRes.png';   
   $pdfi=1;
     if(!$pdfVersion)
     {
       $pdfi=0;
       $pageSeparator='<div class="pageline"></div>';
       $res='LoRes.png';
   
     }
   
    
   
    $html='    <div id="characterpagesarea" style="position:relative">
   <div style="background-color:#ff0000"></div>
   <input type="hidden" id="pdf_id" value='.$pdfi.'>
   
   '.($pdfVersion ? '<div id="page219area" class="insidecoverarea page219area" style="width:3375px;height:2625px">
         <img class="insidecoverbackground pagebackground219" id="pagebackground219" width="100%" src="i/pages/i/pages/Book-Cover-Package/CoverSpreadHiRes.png"/>
         <div  style="    height: 0px;
     position: relative;
     width: 0px;
     color: rgb(15, 117, 188);
     font-family: Caveat, cursive;
     font-weight: bold;
     bottom: 2348.63px;
     left: 1161px;
     margin-right: -184px;
     font-size: 334px;">
           <div style="width: 460px;"><span class="childsnameautofill"></span>\'s</div>
         </div>
       </div>' : '').'
   
       '.(in_array(0,$pages) ? '<div id="page20area" class="pagearea page20area">
         '.$pdf->WriteHTML('
         <div style="position:fixed; padding-left:500px; padding-top:50px; color: #0f75bc;  font-weight:bold; font-size: 54pt; font-weight:bold; font-family: frutiger; width:100%">
        

       <p style="text-align: center">

       '.$childsname.'\'s
       </p>
           </div>
         ').'

           <div style="background-image:url(i/pages/Book-Cover-Package/CoverSpreadHiRes.png);  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 100% 100%;">




 <img class="pageairship page1airship" id="page1airship" style=" position:absolute;



   width:'.$characterParts['body'][$body][0]['width'].'px; 
    height:'.$characterParts['body'][$body][0]['height'].'px; 
    padding-left:'.$characterParts['body'][$body][0]['padding-left'].'px; 
     padding-top:'.$characterParts['body'][$body][0]['padding-top'].'px; 
     padding-bottom:'.$characterParts['body'][$body][0]['padding-bottom'].'px;" 

    src="'.$characterParts['body'][$body][0]['skin'][$bodycolor].'" />




<img class="pagehair page1hair" id="page1hair" style=" display:block; position:fixed; transform:rotate(0); 
 width:'.$characterParts['hair'][$hair][$body][0]['width'].'px;  
    height:'.$characterParts['hair'][$hair][$body][0]['height'].'px;  
  padding-left:'.$characterParts['hair'][$hair][$body][0]['padding-left'].'px; 
  padding-top:'.$characterParts['hair'][$hair][$body][0]['padding-top'].'px; 
  padding-bottom:'.$characterParts['hair'][$hair][$body][0]['padding-bottom'].'px; "
   src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />



 <img class="pageyes page1eyes" id="page1eyes" style="position:absolute; 
width:'.$characterParts['eyes'][$eyes][$hair][$body][0]['width'].'px;  
    height:'.$characterParts['eyes'][$eyes][$hair][$body][0]['height'].'px;  
  padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][0]['padding-left'].'px; 
  padding-top:'.$characterParts['eyes'][$eyes][$hair][$body][0]['padding-top'].'px; 
  padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][0]['padding-bottom'].'px; "
    src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" /> 



   '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$body][$hair][0]['width'].'px;
height:'.$characterParts['glasses'][$body][$hair][0]['height'].'px;
padding-left:'.$characterParts['glasses'][$body][$hair][0]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][0]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][0]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][0]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'




'.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;
width:'.$characterParts['freckles'][$body][$glasses][0]['width'].'px;
height:'.$characterParts['freckles'][$body][$glasses][0]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$glasses][0]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$glasses][0]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$glasses][0]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$glasses][0]['padding-bottom'].'px; "
    src="i/character/Freckles/Freckles.png" /> 

  ' : '').'


     </div></div>






         '.$pageSeparator.'
       </div>' : '').'


   
   
   
   '.($pdfVersion ? '<div id="page221area" class="insidecoverarea page221area" style="width:3375px;height:2625px">
         <img class="insidecoverbackground pagebackground221" id="pagebackground221" width="100%" src="i/pages/InteriorBackCover.png"/>
       </div>' : '').'
   
   <div style="background-color:#ff0000"></div>
     </div>';
   
     //print_r($html);exit;
   
   
    $pdf->writeHTML($html);
    $fileName=$lastname.'.'.$firstname.'.'.$orderId.'.cover.pdf';
    $pdf->Output($fileName, 'D');
   
   }}
    
    
    ?>