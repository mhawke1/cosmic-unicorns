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
require_once __DIR__ . '/pdf-css/page0.php'; 
     require_once __DIR__ . '/pdf-css/page1.php'; 
       require_once __DIR__ . '/pdf-css/page2.php';
        require_once __DIR__ . '/pdf-css/page3.php'; 
       require_once __DIR__ . '/pdf-css/page4.php';
        require_once __DIR__ . '/pdf-css/page5.php'; 
       require_once __DIR__ . '/pdf-css/page6.php';
        require_once __DIR__ . '/pdf-css/page7.php'; 
       require_once __DIR__ . '/pdf-css/page8.php';
        require_once __DIR__ . '/pdf-css/page9.php'; 
       require_once __DIR__ . '/pdf-css/page10.php';
        require_once __DIR__ . '/pdf-css/page11.php'; 
       require_once __DIR__ . '/pdf-css/page12.php';
        require_once __DIR__ . '/pdf-css/page13.php'; 
       require_once __DIR__ . '/pdf-css/page14.php';
        require_once __DIR__ . '/pdf-css/page15.php'; 
       require_once __DIR__ . '/pdf-css/page16.php';
        require_once __DIR__ . '/pdf-css/page17.php'; 
        require_once __DIR__ . '/pdf-css/page19.php'; 
       require_once __DIR__ . '/pdf-css/page20.php';

    
  
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];


$pdf = new \Mpdf\Mpdf([
  'mode' => 'utf-8','format' => [285.75,222.25],

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
 //$pages=[0,11,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22];



 


   $pages=explode('-',$paymentRow['pages']);
     array_unshift($pages ,0);
   array_push($pages,21); 
    array_push($pages,22); 
  

     
     $childsPictureBackground='';
   
   $childPictureStyle='';
   if($childsPicture==='')
   {
   $childPictureStyle='background-size:contain;background-position:center;background-image:url('.$childsPictureBackground.');background-repeat:no-repeat;';
   }
     $pages=array_map('intval', $pages);
   
     if($childsPicture=='')$childsPicture='<img src="upload/'.$childImageFileName.'" class="lovenotechildspicture" style="width:100% !important;height:100%;"/>';




   
     $pageSeparator='';
   $res='HiRes.png';   
   $pdfi=1;
     if(!$pdfVersion)
     {
       $pdfi=0;
       $pageSeparator='<div class="pageline"></div>';
       $res='LoRes.png';
   
     }

      $res='HiRes.png';
   
    
   
    $html='    <div id="characterpagesarea" style="position:relative">
   <div style="background-color:#ff0000"></div>
   <input type="hidden" id="pdf_id" value='.$pdfi.'>


   
   '.($pdfVersion ? '<div id="page219area" class="insidecoverarea page219area" style="width:3375px;height:2625px">
         <img class="insidecoverbackground pagebackground219" id="pagebackground219" width="100%" src="i/pages/InteriorCover.png"/>
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
           <div style="width: 460px;"><span class="childsnameautofill">'.$childsname.'</span>\'s</div>
         </div>
       </div>' : '').'
   
       '.(in_array(0,$pages) ? '






         <div id="page20area" class="pagearea page20area">
        

       
       
 <div style="background-image:url(i/pages/Book-Cover-Package/CoverSpreadHiResOLD.png);  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">


        
      

 '.$pdf->WriteHTML('
         <div style="position:fixed; text-align: center; padding-top:-90px; color: #0f75bc;   font-size: 70pt; font-family: frutiger; width:100%">
        

       <p style="text-align: center">'.$childsname.'</p>
           </div>
         ').'

 






           
         </div>
         '.$pageSeparator.'
       </div>' : '').'
































   
   
       '.(in_array(1,$pages) ? 
   
   
   
   
   
   
   
         '
         <div id="page1area" class="page1area pagearea" >
   <div style="background-image:url(i/pages/AirshipPackage/AirshipSpreadPrint'.$res.'); 

      background-position: 0px 0px;   background-repeat: no-repeat;height: 1000px; width:2500px; background-size: 200% 101.2%;">

      <div id="page1textcontainer" class="page1textcontainer pagetextcontainer" style="padding-top:230px; font-family: Arial;  font-size:24px; font-weight:600; padding-left:200; ">
         <div>Over a sea of land,</div>
         <div>Over rough rocks and fine sand -</div>
         <div>With the birds in the sky,</div>
         <div><span class="childsnameautofill">'.$childsname.'</span> soars so high!</div>
         <div>&nbsp;</div>
         <div>Above the infinite ocean,</div>
         <div>Life moves below in slow motion;</div>
         <div>We explore side by side,</div>
         <div>On adventures far and wide.</div>
         <div>&nbsp;</div>
         <div>We soar higher and higher,</div>
         <div>It’s so fun, we never tire!</div>
         <div>Watch us flip and dip - </div>
         <div>On our magical airship.</div>
      </div>
      <div id="page1charactercontainer" class="page1charactercontainer pagecharactercontainer" style="height:0px;width:0px;position:relative">
        
       
         <img class="pageairship page1airship" id="page1airship" style="display:block;position:absolute; 
width:1525px;
height:1200px;
padding-top:-650px;
padding-bottom:-58px;
padding-right:-650px;
padding-left:740px;


" src="i/pages/AirshipPackage/Ship.png" />







      </div>
   </div>
</div>


<div id="page1area" class="page1area pagearea" style="position:absolute;" >

   <div style="background-image:url(i/pages/AirshipPackage/AirshipSpreadPrint'.$res.');  
      background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">

<img class="pageairship page1airship" id="page1airship" style="display:block;position:absolute; z-index: -1; 
    transform: rotate(0deg);   width:1212px;  padding-left:-415px;   padding-top:25px;" src="i/pages/AirshipPackage/ShipHiRes.png" />



  <img class="pageairship page1airship" id="page1airship" style=" position:absolute; 
    width:'.$characterParts['body'][$body][1]['width'].'px; 
    height:'.$characterParts['body'][$body][1]['height'].'px; 
    padding-left:'.$characterParts['body'][$body][1]['padding-left'].'px; 
    padding-bottom:'.$characterParts['body'][$body][1]['padding-bottom'].'px;" 
    src="'.$characterParts['body'][$body][1]['skin'][$bodycolor].'" />



<img class="pagehair page1hair" id="page1hair" style=" display:block; position:fixed;
transform:rotate(0); 
     width:'.$characterParts['hair'][$hair][$body][1]['width'].'px;
     height:'.$characterParts['hair'][$hair][$body][1]['height'].'px;  
     padding-left:'.$characterParts['hair'][$hair][$body][1]['padding-left'].'px;
     padding-bottom:'.$characterParts['hair'][$hair][$body][1]['padding-bottom'].'px;"
     src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />


 

  <img class="pageyes page1eyes" id="page1eyes" style="position:absolute;
    width:'.$characterParts['eyes'][$eyes][$hair][$body][1]['width'].'px;
    height:'.$characterParts['eyes'][$eyes][$hair][$body][1]['height'].'px;  
    padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][1]['padding-left'].'px;
    padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][1]['padding-bottom'].'px;"
    src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" /> 


'.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$body][$hair][$eyes][1]['width'].'px;
height:'.$characterParts['glasses'][$body][$hair][$eyes][1]['height'].'px;
padding-left:'.$characterParts['glasses'][$body][$hair][$eyes][1]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][$eyes][1]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][$eyes][1]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][$eyes][1]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'




'.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
width:'.$characterParts['freckles'][$body][$hair][$glasses][1]['width'].'px;
height:'.$characterParts['freckles'][$body][$hair][$glasses][1]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$hair][$glasses][1]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$hair][$glasses][1]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$hair][$glasses][1]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$hair][$glasses][1]['padding-bottom'].'px; "
    src="i/character/Freckles/FrecklesPointsHiRes-01.png" /> 

  ' : '').'









       
   </div>

</div>


</div>
   
   
   
   
         '.$pageSeparator.'
       </div>' : '').'
   
   
   
   















   
   
   
   
   
   
   
       '.(in_array(2,$pages) ? '



              <div id="page2area" class="pagearea page2area">
   <div style="background-image:url(i/pages/BasketballPACKAGE/BasketballSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">




      <div id="page2charactercontainer" class="pagecharactercontainer page2charactercontainer" style="height:0px;width:0px;position:absolute;">


  <img class="pageairship page1body" id="page1airship" style=" position:absolute; 
    width:'.$characterParts['body'][$body][2]['width'].'px; 
    height:'.$characterParts['body'][$body][2]['height'].'px; 
    padding-left:'.$characterParts['body'][$body][2]['padding-left'].'px; 
     padding-top:'.$characterParts['body'][$body][2]['padding-top'].'px;" 
     padding-bottom:'.$characterParts['body'][$body][2]['padding-bottom'].'px;"
      padding-right:'.$characterParts['body'][$body][2]['padding-right'].'px;" 
    src="'.$characterParts['body'][$body][2]['skin'][$bodycolor].'" />

    <img class="pagehair page1hair" id="page1hair" style="position:absolute;
    transform:rotate(0); 
     width:'.$characterParts['hair'][$hair][$body][2]['width'].'px;
     height:'.$characterParts['hair'][$hair][$body][2]['height'].'px;  
     padding-left:'.$characterParts['hair'][$hair][$body][2]['padding-left'].'px;
     padding-bottom:'.$characterParts['hair'][$hair][$body][2]['padding-bottom'].'px;"
     src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />


      <img class="pageyes page2eyes" id="page2eyes"     style="position:absolute; 
     width:'.$characterParts['eyes'][$eyes][$hair][$body][2]['width'].'px;
     
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][2]['padding-left'].'px;
     padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][2]['padding-bottom'].'px;"
     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />



     '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$body][$hair][2]['width'].'px;
height:'.$characterParts['glasses'][$body][$hair][2]['height'].'px;
padding-left:'.$characterParts['glasses'][$body][$hair][2]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][2]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][2]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][2]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'




'.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;
width:'.$characterParts['freckles'][$body][$hair][$glasses][2]['width'].'px;
height:'.$characterParts['freckles'][$body][$hair][$glasses][2]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$hair][$glasses][2]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$hair][$glasses][2]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$hair][$glasses][2]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$hair][$glasses][2]['padding-bottom'].'px; "
    src="i/character/Freckles/Freckles.png" /> 

  ' : '').'



         <div id="page2characterheadstuff" class="page2characterheadstuff" style="position:relative">
           
           
         </div>
      </div>
   </div>
</div>





<div id="page2area" class="pagearea page2area">
   <div style="background-image:url(i/pages/BasketballPACKAGE/BasketballSpread'.$res.');  
      background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">
      <div id="page2textcontainer" class="pagetextcontainer page2textcontainer" style="width:0px;color:#000 padding-top:230px; font-size:25px; font-weight:600;font-family: Arial; padding-left:500; ">
         <div style="padding-top:160px;padding-left:610;">The squeak of the shoes,</div>
         <div style="padding-left:610;">And the way that they move,</div>
         <div style="padding-left:610;">And how the half-time music,</div>
         <div style="padding-left:610;">Gets me into the groove.</div>
         <div>&nbsp;</div>
         <div style="padding-left:610;"><span class="childsnameautofill">'.$childsname.'</span>’s really good at this,</div>
         <div style="padding-left:610;"><span class="childsnameautofill">'.$childsname.'</span>’s swift, <span class="childsnameautofill">'.$childsname.'</span> swoops,</div>
         <div style="padding-left:610;"><span class="childsnameautofill"></span> steals the ball,</div>
         <div style="padding-left:610;">And just loves to shoot some hoops!</div>
         <div>&nbsp;</div>
         <div style="padding-left:610;">Move, <span class="childsnameautofill">'.$childsname.'</span>, bounce, <span class="childsnameautofill">'.$childsname.'</span>,</div>
         <div style="padding-left:610;">Go on and fake a fall,</div>
         <div style="padding-left:610;">Here it is, it’s your chance,</div>
         <div style="padding-left:610;">To slam dunk the ball!</div>
      </div>
      <div id="page2charactercontainer" class="pagecharactercontainer page2charactercontainer" style="height:0px;width:0px;position:relative">
         
       
      </div>
   </div>
</div>
   
         '.$pageSeparator.'
       </div>' : '').'





















       '.(in_array(3,$pages) ? '       <div id="page2area" class="pagearea page2area">
   <div style="background-image:url(i/pages/Bedtime-SpreadPACKAGE/BedtimeSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">




      <div id="page2charactercontainer" class="pagecharactercontainer page2charactercontainer" style="height:0px;width:0px;position:absolute;">


  <img class="pageairship page1body" id="page1airship" style=" display:inline-block; position:absolute; 
    width:'.$characterParts['body'][$body][3]['width'].'px; 
   
    padding-left:'.$characterParts['body'][$body][3]['padding-left'].'px; 
     padding-top:'.$characterParts['body'][$body][3]['padding-top'].'px;" 
     padding-bottom:'.$characterParts['body'][$body][3]['padding-bottom'].'px;"
      padding-right:'.$characterParts['body'][$body][3]['padding-right'].'px;" 
    src="'.$characterParts['body'][$body]['skin'][$bodycolor].'" />

    <img class="pagehair page1hair" id="page1hair" style="display:inline-block;position:absolute;transform:rotate(0); 
     width:'.$characterParts['hair'][$hair][$body][3]['width'].'px;
     
     padding-left:'.$characterParts['hair'][$hair][$body][3]['padding-left'].'px;
     padding-bottom:'.$characterParts['hair'][$hair][$body][3]['padding-bottom'].'px;"
     src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />


      <img class="pageyes page2eyes" id="page2eyes"     style="position:absolute; 
     width:'.$characterParts['eyes'][$eyes][$hair][$body][3]['width'].'px;
      
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][3]['padding-left'].'px;
     padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][3]['padding-bottom'].'px;"
     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />






'.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$hair][$eyes][3]['width'].'px;
height:'.$characterParts['glasses'][$hair][$eyes][3]['height'].'px;
padding-left:'.$characterParts['glasses'][$hair][$eyes][3]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$hair][$eyes][3]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$hair][$eyes][3]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$hair][$eyes][3]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'




'.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
width:'.$characterParts['freckles'][$hair][$glasses][3]['width'].'px;
height:'.$characterParts['freckles'][$hair][$glasses][3]['height'].'px;
padding-left:'.$characterParts['freckles'][$hair][$glasses][3]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$hair][$glasses][3]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$hair][$glasses][3]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$hair][$glasses][3]['padding-bottom'].'px; "
    src="i/character/Freckles/Freckles.png" /> 

  ' : '').'

















      </div>
   </div>
</div>







<div id="page3area" class="pagearea page3area" style="overflow:hidden">
   <div style="background-image:url(i/pages/Bedtime-SpreadPACKAGE/BedtimeSpread'.$res.');  
      background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">
      <div id="page3textcontainer" class="pagetextcontainer page3textcontainer" style="width:0px;color:#fff ; font-family: Arial;font-size:25px; font-weight:600; padding-left:500; ">
         <div class="first" style="position:relative;">
            <div style="padding-left:535; padding-top:100px;"><span class="childsnameautofill">'.$childsname.'</span> prepares for bed,</div>
            <div style="padding-left:535; ">With a simple routine,</div>
            <div style="padding-left:535; ">First pajamas, then their teeth,</div>
            <div style="padding-left:535; ">Brushing till they’re super clean!</div>
         </div>
         <div class="second" style="position:relative;">
            <div style="padding-left:535; padding-top:20px; " >Next is <span class="childsnameautofill">'.$childsname.'</span>’s favorite part,</div>
            <div style="padding-left:535; " >It’s time to listen and to look,</div>
            <div style="padding-left:535; " >At all the pretty pictures,</div>
            <div style="padding-left:535; " > In their storybook.</div>
         </div>
         <div class="third" style="position:relative;">
            <div style="padding-left:535;padding-top:20px;  ">Then it’s good to think of all,</div>
            <div style="padding-left:535; ">The things we’re grateful for,</div>
            <div style="padding-left:535; ">Our family and our friends,</div>
            <div style="padding-left:535; ">And so, so much more!</div>
         </div>
         <div class="fourth" style="position:relative;">
            <div style="padding-left:535;padding-top:20px;  " ><span class="childsnameautofill">'.$childsname.'</span> crawls into bed,</div>
            <div  style="padding-left:535; ">Big hugs and kisses goodnight!</div>
            <div style="padding-left:535; " >It’s time to slow our breathing,</div>
            <div style="padding-left:535; " >And close our eyes up tight.</div>
         </div>
      </div>
      
   </div>
</div>
         '.$pageSeparator.'
       </div>' : '').'






























       '.(in_array(4,$pages) ? '

        <div id="page4area" class="pagearea page4area" style="overflow:hidden">
   <div style="background-image:url(i/pages/CampingPackage/CampingSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">
      <div id="page4textcontainer" class="pagetextcontainer page4textcontainer" style="width:0px;color:#000 ; font-family: Arial;font-size:25px; font-weight:600; text-align:right; ">
         <div style="padding-right:120;padding-top:80px;  ">Flames flicker in the air,</div>
         <div style="padding-right:120;">We’re mesmerized by the fire,</div>
         <div style="padding-right:120;">We love spending time with <span class="childsnameautofill">'.$childsname.'</span>,</div>
         <div style="padding-right:120;">A child we so admire.</div>
         <div>&nbsp;</div>
         <div style="padding-right:120;padding-top:2px;">Toasting sweet marshmallows,</div>
         <div style="padding-right:120;">A cool breeze tickles our face,</div>
         <div style="padding-right:120;">Laughter is so contagious,</div>
         <div style="padding-right:120;">At our favorite place!</div>
         <div>&nbsp;</div>
         <div style="padding-right:120; padding-top:2px;">We tell funny stories,</div>
         <div style="padding-right:120;">And sing ridiculous songs,</div>
         <div style="padding-right:120;">Laughter is so healing,</div>
         <div style="padding-right:120;">Come on, sing along!</div>
      </div>
    
   </div>
</div>



<div id="page4area" class="pagearea page4area" style="overflow:hidden position:absolute">
<div style="background-image:url(i/pages/CampingPackage/CampingSpread'.$res.');  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; position:absolute width:2500px; background-size: 200% 100%;">

   
   
 
  <img class="pageairship page4body" id="page4body" style=" display:inline-block; position:absolute;    width:'.$characterParts['body'][$body][4]['width'].'px; 
    height:'.$characterParts['body'][$body][4]['height'].'px; 
    padding-left:'.$characterParts['body'][$body][4]['padding-left'].'px; 
     padding-top:'.$characterParts['body'][$body][4]['padding-top'].'px;
     padding-bottom:'.$characterParts['body'][$body][4]['padding-bottom'].'px;
      padding-right:'.$characterParts['body'][$body][4]['padding-right'].'px; "
    src="'.$characterParts['body'][$body][4]['skin'][$bodycolor].'" />
   

    <img class="pagehair page4hair" id="page4hair" style="display:inline-block;position:absolute;  transform:rotate(0);
 
     width:'.$characterParts['hair'][$hair][$body][4]['width'].'px;

     height:'.$characterParts['hair'][$hair][$body][4]['height'].'px;
     
      padding-top:'.$characterParts['hair'][$hair][$body][4]['padding-top'].'px;
     padding-left:'.$characterParts['hair'][$hair][$body][4]['padding-left'].'px;
     padding-bottom:'.$characterParts['hair'][$hair][$body][4]['padding-bottom'].'px;"

     src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />


      <img class="pageyes page2eyes" id="page2eyes"     style="position:absolute; 
  
      padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][4]['padding-bottom'].'px;
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][4]['padding-left'].'px;
      padding-top:'.$characterParts['eyes'][$eyes][$hair][$body][4]['padding-top'].'px;
           
       width:'.$characterParts['eyes'][$eyes][$hair][$body][4]['width'].'px; "

     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />





   '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$body][$hair][$eyes][4]['width'].'px;

padding-left:'.$characterParts['glasses'][$body][$hair][$eyes][4]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][$eyes][4]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][$eyes][4]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][$eyes][4]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'



   '.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
  height:0px;
width:'.$characterParts['freckles'][$body][$hair][$glasses][4]['width'].'px;
padding-left:'.$characterParts['freckles'][$body][$hair][$glasses][4]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$hair][$glasses][4]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$hair][$glasses][4]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$hair][$glasses][4]['padding-bottom'].'px; "
    src="i/character/Freckles/Freckles.png" /> 

  ' : '').'





   </div></div>
   
         '.$pageSeparator.'
       </div>' : '').'





























       '.(in_array(5,$pages) ? '<div id="page5area" class="pagearea page5area" style="overflow:hidden">

   <div style="background-image:url(i/pages/ComicBookPACKAGE/ComicBookSprea'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">



      <div id="page5textcontainer" class="pagetextcontainer page5textcontainer" style="width:0px;color:#fff ;font-family: Arial; font-size:24px; font-weight:600; text-align:right; ">
         <div style="padding-right:150;padding-top:30px;  ">Superheroes are strong,</div>
         <div style="padding-right:150;">Superheroes are clever,</div>
         <div style="padding-right:150;">Superheros make a difference,</div>
         <div style="padding-right:150;">Without thinking twice, ever.</div>
         <div>&nbsp;</div>
         <div style="padding-right:150;">Sometimes <span class="childsnameautofill">'.$childsname.'</span> wonders,</div>
         <div style="padding-right:150;">Could I be a superhero too?</div>
         <div style="padding-right:150;">But I’ll have to ask my friends,</div>
         <div style="padding-right:150;">What superheroes actually do.</div>
         <div style="padding-right:150;">&nbsp;</div>
         <div style="padding-right:150;">It turns out superheroes, </div>
         <div style="padding-right:150;">Are always out and about,</div>
         <div style="padding-right:150;">Racing off to lend a hand,</div>
         <div style="padding-right:150;">Their main job is to help out.</div>
      </div>
      <div id="page5charactercontainer" class="pagecharactercontainer page5charactercontainer" style="height:0px;width:0px;position:absolute">
         
     

  <img class="pageairship page1body" id="page1airship" style=" display:inline-block; position:absolute; 
    width:'.$characterParts['body'][$body][5]['width'].'px; 
    padding-left:'.$characterParts['body'][$body][5]['padding-left'].'px; 
     padding-top:'.$characterParts['body'][$body][5]['padding-top'].'px; 
     padding-bottom:'.$characterParts['body'][$body][5]['padding-bottom'].'px;" 
    src="'.$characterParts['body'][$body][5]['skin'][$bodycolor].'" />

      <img class="pagehair page1hair" id="page1hair" style="display:block;position:absolute; transform:rotate(0);
     width:'.$characterParts['hair'][$hair][$body][5]['width'].'px;  
     padding-left:'.$characterParts['hair'][$hair][$body][5]['padding-left'].'px;
       padding-top:'.$characterParts['hair'][$hair][$body][5]['padding-top'].'px;
     padding-bottom:'.$characterParts['hair'][$hair][$body][5]['padding-bottom'].'px;"
     src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />


 <img class="pageyes page2eyes" id="page2eyes"     style="position:absolute; 
  
      padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][5]['padding-bottom'].'px;
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][5]['padding-left'].'px;
      padding-top:'.$characterParts['eyes'][$eyes][$hair][$body][5]['padding-top'].'px;
           
       width:'.$characterParts['eyes'][$eyes][$hair][$body][5]['width'].'px; "

     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />


           '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$body][$hair][$eyes][5]['width'].'px;
height:'.$characterParts['glasses'][$body][$hair][$eyes][5]['height'].'px;
padding-left:'.$characterParts['glasses'][$body][$hair][$eyes][5]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][$eyes][5]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][$eyes][5]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][$eyes][5]['padding-bottom'].'px;
"
src="i/pages/ComicBookPACKAGE/FaceMask.png" /> 

  ' : '').'




'.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;
width:'.$characterParts['freckles'][$body][$hair][$glasses][5]['width'].'px;
height:'.$characterParts['freckles'][$body][$hair][$glasses][5]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$hair][$glasses][5]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$hair][$glasses][5]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$hair][$glasses][5]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$hair][$glasses][5]['padding-bottom'].'px; "
    src="i/character/Freckles/FrecklesPointsHiRes-01.png" /> 

  ' : '').'


       
         
      </div>
   </div>
</div>


<div id="page5area" class="pagearea page5area" style="overflow:hidden">
<div style="background-image:url(i/pages/ComicBookPACKAGE/ComicBookSprea'.$res.');  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">

   </div>
</div>
         '.$pageSeparator.'
       </div>' : '').'





















       '.(in_array(6,$pages) ? '<div id="page6area" class="pagearea page6area">
   
   
              
   <div style="background-image:url(i/pages/CrossroadsPACKAGE/CrossroadsSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">
   
   
   
         <div id="page6textcontainer" class="pagetextcontainer page6textcontainer"  style="width:0px;color:#000 ; font-size:25px; font-weight:600; font-family: Arial; text-align:left; ">
           
   
               <div class="first" style="position:relative;">
               <div style="padding-left:380;padding-top:100px;">When there’s a tough decision,</div>
               <div style="padding-left:380;">And <span class="childsnameautofill">'.$childsname.'</span> doesn’t know which way to go, </div>
               <div style="padding-left:380;"><span class="childsnameautofill">'.$childsname.'</span> is smart and takes a deep breath,</div> 
               <div style="padding-left:380;">Then lets it out real slow.</div>
               <div style="padding-left:380;">We all have an inner compass,</div>
               <div style="padding-left:380;">Which guides our wrong from right,</div>
               <div style="padding-left:380;">It tells us which way to go,</div>
               <div style="padding-left:380;">It’s like a guiding light.</div> 
               <div style="padding-left:380;">&nbsp;</div>             
               <div style="padding-left:380;">But we must find some quiet,</div>
               <div style="padding-left:380;">We must get really still,</div>
               <div style="padding-left:380;">To hear the voice that knows inside -</div>
               <div style="padding-left:380;">It’s our secret skill.</div> 
               <div style="padding-left:380;">There are distractions and inner chatter,</div>
               <div style="padding-left:380;">We must fight and trust our heart,</div>
               <div style="padding-left:380;">Our intuition can guide us,</div>
               <div style="padding-left:380;">Right from the very start.</div>
   
   
               </div>
   
   
   
         </div>
         </div></div>






               <div id="page6area" class="pagearea page6area">
   
    
              
  
   
   <div style="background-image:url(i/pages/CrossroadsPACKAGE/CrossroadsSpread'.$res.');  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">

<img class="pageairship page6body" id="page6body" style=" display:inline-block; position:absolute; 
    width:'.$characterParts['body'][$body][6]['width'].'px; 
    padding-left:'.$characterParts['body'][$body][6]['padding-left'].'px; 
     padding-top:'.$characterParts['body'][$body][6]['padding-top'].'px; 
     padding-bottom:'.$characterParts['body'][$body][6]['padding-bottom'].'px;
     " 
    src="'.$characterParts['body'][$body][6]['skin'][$bodycolor].'" />


    <img class="pagehair page1hair" id="page1hair" style="display:block;position:absolute; transform:rotate(0);
     width:'.$characterParts['hair'][$hair][$body][6]['width'].'px;  
     padding-left:'.$characterParts['hair'][$hair][$body][6]['padding-left'].'px;
       padding-top:'.$characterParts['hair'][$hair][$body][6]['padding-top'].'px;
     padding-bottom:'.$characterParts['hair'][$hair][$body][6]['padding-bottom'].'px;"
     src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />



 <img class="pageyes page2eyes" id="page2eyes"     style="position:absolute; 
  
      padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][6]['padding-bottom'].'px;
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][6]['padding-left'].'px;
      padding-top:'.$characterParts['eyes'][$eyes][$hair][$body][6]['padding-top'].'px;     
     width:'.$characterParts['eyes'][$eyes][$hair][$body][6]['width'].'px; "
     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />

       

          '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$body][$hair][6]['width'].'px;
height:'.$characterParts['glasses'][$body][$hair][6]['height'].'px;
padding-left:'.$characterParts['glasses'][$body][$hair][6]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][6]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][6]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][6]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'




          '.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;
width:'.$characterParts['freckles'][$body][$hair][$glasses][6]['width'].'px;
height:'.$characterParts['freckles'][$body][$hair][$glasses][6]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$hair][$glasses][6]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$hair][$glasses][6]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$hair][$glasses][6]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$hair][$glasses][6]['padding-bottom'].'px; "
    src="i/character/Freckles/FrecklesPointsHiRes-01.png" /> 

  ' : '').'


         
           </div>
         </div>
         '.$pageSeparator.'
       </div>' : '').'




















       '.(in_array(7,$pages) ? '<div id="page7area" class="pagearea page7area" style="overflow:hidden">
   
       <div style="background-image:url(i/pages/DragonPACKAGE/DragonSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">
   

   
         <div id="page7textcontainer" class="pagetextcontainer page7textcontainer" style="width:0px;color:#000 ; font-size:25px; font-weight:600; font-family: Arial; text-align:right;">
           
   
               <div style="padding-right:210; padding-top:190">With fiery courage and </div>
               <div style="padding-right:210;">Long graceful wings,</div>
               <div style="padding-right:210;">Dragons are wise,</div>
               <div style="padding-right:210;">With the knowledge they bring.</div>
               <div style="padding-right:210;">&nbsp;</div>
               <div style="padding-right:210;"><span class="childsnameautofill">'.$childsname.'</span> loves dragons because</div>
               <div style="padding-right:210;">They believe in what’s right,</div>
               <div style="padding-right:210;">They lead with their hearts,</div>
               <div style="padding-right:210;">As they take off in flight.</div>
   
   
   
         </div>
         </div></div>





         <div id="page7area" class="pagearea page7area" style="overflow:hidden">
  
   
<div style="background-image:url(i/pages/DragonPACKAGE/DragonSpread'.$res.');  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">
   
          <img class="pagebody page7body" id="page7body"     style="display:block;position:absolute;  width:2000px; padding-top:-202px; padding-bottom:-300px; padding-right:-380px; padding-left:80px; height:250px;" src="'.$characterParts['body'][$body][7]['skin'][$bodycolor].'" />

          <img class="pagehair page1hair" id="page1hair" style="display:block;position:absolute;transform:rotate(0);
          width:'.$characterParts['hair'][$hair][$body][7]['width'].'px;  
          padding-left:'.$characterParts['hair'][$hair][$body][7]['padding-left'].'px;
          padding-top:'.$characterParts['hair'][$hair][$body][7]['padding-top'].'px;
          padding-bottom:'.$characterParts['hair'][$hair][$body][7]['padding-bottom'].'px;"
          src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />


           <img class="pageyes page2eyes" id="page2eyes"     style="position:absolute; 
  
      padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][7]['padding-bottom'].'px;
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][7]['padding-left'].'px;
      padding-top:'.$characterParts['eyes'][$eyes][$hair][$body][7]['padding-top'].'px;     
     width:'.$characterParts['eyes'][$eyes][$hair][$body][7]['width'].'px; "
     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />

       

          '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$body][$hair][7]['width'].'px;
height:'.$characterParts['glasses'][$body][$hair][7]['height'].'px;
padding-left:'.$characterParts['glasses'][$body][$hair][7]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][7]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][7]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][7]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'




          '.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;
width:'.$characterParts['freckles'][$body][$glasses][$hair][7]['width'].'px;
height:'.$characterParts['freckles'][$body][$glasses][$hair][7]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$glasses][$hair][7]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$glasses][$hair][7]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$glasses][$hair][7]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$glasses][$hair][7]['padding-bottom'].'px; "
    src="i/character/Freckles/FrecklesPointsHiRes-01.png" /> 

  ' : '').'


       
           </div>
         </div>
         '.$pageSeparator.'
       </div>' : '').'




























       '.(in_array(8,$pages) ? '<div id="page8area" class="pagearea page8area">
   
        <div style="background-image:url(i/pages/FishingPackage/FishingSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">
   



   
   
         <div id="page8textcontainer" class="pagetextcontainer page8textcontainer"  style="width:0px;color:#fff ; font-size:25px; font-family: Arial; font-weight:600; text-align:left;">
           
   
   
       <div class="first" >
                     
           <div style="padding-left:640;padding-top:110">Early in the morning,</div>
           <div style="padding-left:640;">before the sun comes up,</div>
           <div style="padding-left:640;">I travel to my fishing boat,</div>
           <div style="padding-left:640;">With some worms in my cup.</div>
           <div style="padding-left:640;">&nbsp;</div>
           <div style="padding-left:640;">In the middle of the lake,</div>
           <div style="padding-left:640;">I cast my line with bait,</div>
           <div style="padding-left:640;">Then take in a deep breath of air,</div>
           <div style="padding-left:640;">Watch the view and wait.</div>
       </div>
      
   
   
   
   
  




      <img class="pageairship page1body" id="page1airship" style=" display:block; position:absolute; 
    width:'.$characterParts['body'][$body][8]['width'].'px; 
      height:'.$characterParts['body'][$body][8]['height'].'px; 
    padding-left:'.$characterParts['body'][$body][8]['padding-left'].'px; 
     padding-top:'.$characterParts['body'][$body][8]['padding-top'].'px; 
     padding-bottom:'.$characterParts['body'][$body][8]['padding-bottom'].'px;
      padding-right:'.$characterParts['body'][$body][8]['padding-right'].'px;" 
    src="'.$characterParts['body'][$body][8]['skin'][$bodycolor].'" />


   
      <img class="pagehair page1hair" id="page1hair" style="display:block;position:absolute; transform:rotate(0);
      width:'.$characterParts['hair'][$hair][$body][8]['width'].'px;  
      padding-left:'.$characterParts['hair'][$hair][$body][8]['padding-left'].'px;
      padding-top:'.$characterParts['hair'][$hair][$body][8]['padding-top'].'px;
       padding-bottom:'.$characterParts['hair'][$hair][$body][8]['padding-bottom'].'px;"
          src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />
   
   
   <img class="pageyes page2eyes" id="page2eyes"     style=" ply:block;position:absolute; 
  
      padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][8]['padding-bottom'].'px;
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][8]['padding-left'].'px;
      padding-top:'.$characterParts['eyes'][$eyes][$hair][$body][8]['padding-top'].'px;     
     width:'.$characterParts['eyes'][$eyes][$hair][$body][8]['width'].'px; "
     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />








          '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$body][$hair][$eyes][8]['width'].'px;
height:'.$characterParts['glasses'][$body][$hair][$eyes][8]['height'].'px;
padding-left:'.$characterParts['glasses'][$body][$hair][$eyes][8]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][$eyes][8]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][$eyes][8]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][$eyes][8]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'





          '.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;
width:'.$characterParts['freckles'][$body][$hair][$glasses][8]['width'].'px;
height:'.$characterParts['freckles'][$body][$hair][$glasses][8]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$hair][$glasses][8]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$hair][$glasses][8]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$hair][$glasses][8]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$hair][$glasses][8]['padding-bottom'].'px; "
    src="i/character/Freckles/FrecklesPointsHiRes-01.png" /> 

  ' : '').'

   
         </div>
         </div></div>






         <div id="page8area" class="pagearea page8area">
   
       
   <div style="background-image:url(i/pages/FishingPackage/FishingSpread'.$res.');  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">
   
   
         <div id="page8textcontainer" class="pagetextcontainer page8textcontainer"  style="width:0px;color:#fff ; font-size:25px; font-family: Arial; font-weight:600; text-align:left;">
           
   
   
       <div class="first" >
                     
           <div  style="padding-left:490;padding-top:390;">I watch the bugs skate across,</div>
       
          <div style="padding-left:490;">The surface of the water,</div>
          <div style="padding-left:490;">I enjoy the twinkly ripples made</div>
          <div style="padding-left:490;">By the jiggle of the bobber.</div>
          <div style="padding-left:490;">&nbsp;</div>
          <div style="padding-left:490;">I love being still in nature,</div>
          <div style="padding-left:490;">I don’t need to catch a fish,</div>
          <div style="padding-left:490;">It’s just like meditation,</div>
          <div style="padding-left:490;">I’ll close my eyes and make a wish.</div>
       </div>
      
   
   
         </div>
        
   
       
         
         '.$pageSeparator.'
       </div>' : '').'

















'.(in_array(9,$pages) ? '<div id="page9area" class="pagearea page9area">
   
   
        


    <div style="background-image:url(i/pages/MermaidPACKAGE/MermaidSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">
   
           <div id="page9textcontainer" class="pagetextcontainer page9textcontainer" style="height:0px;position:relative;width:0px;color:#fff;font-size:24px;font-family: Arial;">
   
         
         <div class="first" style="padding-left:325;padding-top:70;">
         <div>When I’m under the sea,</div>
         <div>I feel so, so free. </div>
         <div>I’m free to just BE, </div>
         <div>I’m free to be ME!</div>
         <div>&nbsp;</div>
         <div><span class="childsnameautofill">'.$childsname.'</span> is a mermaid,</div>
         <div>With a sparkly tail,</div>
         <div>Beautiful and strong,</div>
         <div>The opposite of frail.</div>
         </div>
   
   
   
         <div class="second" style="padding-left:590;padding-top:-150;">
         <div><span class="childsnameautofill">'.$childsname.'</span> swims between,</div>
         <div>Schools of jellyfish,</div>
         <div>Then takes a moment to,</div>
         <div>Make a special wish.</div>
         <div>&nbsp;</div>
         <div>A wish for a world,</div>
         <div>Filled with peace and love,</div>
         <div>To bring this peace from,</div>
         <div>The sea to up above!</div>
         </div>
   
         </div>
         <div id="page9charactercontainer" class="pagecharactercontainer page9charactercontainer" style="height:0px;width:0px;position:relative">
   
           
   
   
   </div> </div>





         <div id="page9area" class="pagearea page9area">

           <div style="background-image:url(i/pages/MermaidPACKAGE/MermaidSpread'.$res.');  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">

<img class="pageairship page1body" id="page1airship" style=" display:inline-block; position:absolute; 
    width:'.$characterParts['body'][$body][9]['width'].'px; 
   
    padding-left:'.$characterParts['body'][$body][9]['padding-left'].'px; 
     padding-top:'.$characterParts['body'][$body][9]['padding-top'].'px;" 
     padding-bottom:'.$characterParts['body'][$body][9]['padding-bottom'].'px;"
      padding-right:'.$characterParts['body'][$body][9]['padding-right'].'px;" 
    src="'.$characterParts['body'][$body][9]['skin'][$bodycolor].'" />








       <img class="pagehair page1hair" id="page1hair" style="display:block;position:absolute; transform:rotate(0);
      width:'.$characterParts['hair'][$hair][$body][9]['width'].'px;  
      padding-left:'.$characterParts['hair'][$hair][$body][9]['padding-left'].'px;
      padding-top:'.$characterParts['hair'][$hair][$body][9]['padding-top'].'px;
       padding-bottom:'.$characterParts['hair'][$hair][$body][9]['padding-bottom'].'px;"
          src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />



             <img class="pageyes page2eyes" id="page2eyes"     style=" ply:block;position:absolute; 
  
      padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][9]['padding-bottom'].'px;
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][9]['padding-left'].'px;
      padding-top:'.$characterParts['eyes'][$eyes][$hair][$body][9]['padding-top'].'px;     
     width:'.$characterParts['eyes'][$eyes][$hair][$body][9]['width'].'px; "
     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />
   



          '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$body][$hair][9]['width'].'px;
height:'.$characterParts['glasses'][$body][$hair][9]['height'].'px;
padding-left:'.$characterParts['glasses'][$body][$hair][9]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][9]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][9]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][9]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'


            '.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;
width:'.$characterParts['freckles'][$body][$glasses][9]['width'].'px;
height:'.$characterParts['freckles'][$body][$glasses][9]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$glasses][9]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$glasses][9]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$glasses][9]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$glasses][9]['padding-bottom'].'px; "
    src="i/character/Freckles/FrecklesPointsHiRes-01.png" /> 

  ' : '').'




           </div>
         </div>
         '.$pageSeparator.'
       </div>' : '').'








































       '.(in_array(10,$pages) ? '<div id="page10area" class="pagearea page10area">
        
   
   
    
   
    <div style="background-image:url(i/pages/MusicSpreadPACKAGE/MusicSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">
   
         <div id="page10textcontainer" class="pagetextcontainer page10textcontainer" style="height:0px; font-family: Arial; position:relative;width:0px;color:#fff">
         
   
   
   
         <div class="first" style="color:#fff;text-align:left; padding-left:130px;padding-top:40px; font-size:25px;" >
         <div>Through different types of music, </div>
         <div><span class="childsnameautofill">'.$childsname.'</span> and their friends come alive,</div>
         <div>All the cells in their bodies,</div>
         <div>Connect through dance and thrive!</div>
         </div>
         <div class="second" style="color:#fff;text-align:left; padding-left:130px;padding-top:40px; font-size:25px;" >
         <div>Music creates a space to be safe,</div>
         <div>To express a different feeling,</div>
         <div>Happy, sad, excited or mad,</div>
         <div>We can relate, and it’s so healing.</div>
         </div>
   
         <div class="third" style="color:#fff;text-align:left; padding-left:130px;padding-top:40px; font-size:25px;" >
         <div>Through music <span class="childsnameautofill">'.$childsname.'</span> and their friends,</div>
         <div>Are present in the moment now,</div>
         <div>Grooving their bodies and their souls,</div>
         <div>The rhythm of the music shows them how!</div>
         </div>
   
         </div>
         <div id="page10charactercontainer" class="pagecharactercontainer page10charactercontainer" style="height:0px;width:0px;position:relative">
   
           
   
          
   
             <img class="pageairship page1body" id="page1airship" style=" display:inline-block; position:absolute; 
    width:'.$characterParts['body'][$body][10]['width'].'px; 
   
    padding-left:'.$characterParts['body'][$body][10]['padding-left'].'px; 
     padding-top:'.$characterParts['body'][$body][10]['padding-top'].'px; 
     padding-bottom:'.$characterParts['body'][$body][10]['padding-bottom'].'px;"
     
    src="'.$characterParts['body'][$body][10]['skin'][$bodycolor].'" />




        <img class="pagehair page1hair" id="page1hair" style="display:block;position:absolute; transform:rotate(0);
      width:'.$characterParts['hair'][$hair][$body][10]['width'].'px;  
       height:'.$characterParts['hair'][$hair][$body][10]['height'].'px;  
      padding-left:'.$characterParts['hair'][$hair][$body][10]['padding-left'].'px;
      padding-top:'.$characterParts['hair'][$hair][$body][10]['padding-top'].'px;
       padding-bottom:'.$characterParts['hair'][$hair][$body][10]['padding-bottom'].'px;"
          src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />




         '.($body==0 ? '

  <img class="pageairship page1body" id="page1airship" style=" display:inline-block; position:absolute; transform:rotate(0);

   width:'.$characterParts['microphone'][$hair][$body][10]['width'].'px;  
      padding-left:'.$characterParts['microphone'][$hair][$body][10]['padding-left'].'px;
      padding-top:'.$characterParts['microphone'][$hair][$body][10]['padding-top'].'px;
       padding-bottom:'.$characterParts['microphone'][$hair][$body][10]['padding-bottom'].'px;

   
   "
 src="i/pages/MusicSpreadPACKAGE/MusicBody-Standing-Microphone-01.png" />

  ' : '').'
   

       '.($body==1 ? '
<img class="pageairship page1body" id="page1airship" style=" display:inline-block; position:absolute; transform:rotate(0);
     width:'.$characterParts['microphone'][$hair][$body][10]['width'].'px;  
      padding-left:'.$characterParts['microphone'][$hair][$body][10]['padding-left'].'px;
      padding-top:'.$characterParts['microphone'][$hair][$body][10]['padding-top'].'px;
       padding-bottom:'.$characterParts['microphone'][$hair][$body][10]['padding-bottom'].'px;
   "
 src="i/pages/MusicSpreadPACKAGE/MusicWheelchair-Microphone-01.png" />

  ' : '').'
   




 <img class="pageyes page2eyes" id="page2eyes"     style=" ply:block;position:absolute; 
  
      padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][10]['padding-bottom'].'px;
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][10]['padding-left'].'px;
      padding-top:'.$characterParts['eyes'][$eyes][$hair][$body][10]['padding-top'].'px;     
     width:'.$characterParts['eyes'][$eyes][$hair][$body][10]['width'].'px; "
     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />


             '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$body][$hair][10]['width'].'px;

padding-left:'.$characterParts['glasses'][$body][$hair][10]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][10]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][10]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][10]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'




            '.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;
width:'.$characterParts['freckles'][$body][$hair][$glasses][10]['width'].'px;
height:'.$characterParts['freckles'][$body][$hair][$glasses][10]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$hair][$glasses][10]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$hair][$glasses][10]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$hair][$glasses][10]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$hair][$glasses][10]['padding-bottom'].'px; "
    src="i/character/Freckles/FrecklesPointsHiRes-01.png" /> 

  ' : '').'






</div>
         </div></div></div>

     
   
        
           





         <div id="page10area" class="pagearea page10area">
        
      
   <div style="background-image:url(i/pages/MusicSpreadPACKAGE/MusicSpread'.$res.');  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">

   
    

       
         <div id="page10charactercontainer" class="pagecharactercontainer page10charactercontainer" style="height:0px;width:0px;position:relative">
   
           
   
   
   
          
   
             '.((!$pdfVersion) ?'
       ':
       '').'
           </div>
         </div>
         '.$pageSeparator.'
       </div>' : '').'


















 '.(in_array(11,$pages) ? '
       </div>' : '').'


      
   
      
   














         '.(in_array(12,$pages) ? '<div id="page12area" class="pagearea page12area" style="overflow:hidden">
   
  <div style="background-image:url(i/pages/PickingFlowersPACKAGE/PickingFlowersSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">
   
 
   
   
   
         <div id="page12textcontainer" class="pagetextcontainer page12textcontainer" style="height:0px;position:relative;width:0px; font-family: Arial; color:#000">
           
                             <div class="firstline" style="color:#000;text-align:left; padding-left:595px;padding-top:150px; font-size:25px;" >
               <div>Life can be challenging, </div>
               <div>And sometimes we may want more,</div>
               <div>But there are so many things,</div> 
               <div>We can be grateful for.</div>
               <div>&nbsp;</div>
               <div>Like the clouds and the wind,</div>
               <div>Or blue, sunny skies,</div>
               <div>Beauty is everywhere, </div>
               <div>When we focus our eyes.</div>
               <div>&nbsp;</div>
               </div>
                          
   
   
   
   
         </div>
    </div></div>










         <div id="page12area" class="pagearea page12area" style="overflow:hidden">
   
 
   <div style="background-image:url(i/pages/PickingFlowersPACKAGE/PickingFlowersSpread'.$res.');  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">
   
   
         <div id="page12textcontainer" class="pagetextcontainer page12textcontainer" style="height:0px;position:relative;font-family: Arial;width:0px;color:#000">
           
                             <div class="secondline" style="color:#000;text-align:left; padding-left:95px;padding-top:130px; font-size:25px;" >
               
              <div><span class="childsnameautofill">'.$childsname.'</span>, look over here!</div>
              <div>Flowers of red, blue, pink and yellow,</div>
              <div>They open just for you each day,</div>
              <div>As if to say hello!</div>
              </div>
               </div>
                          
   
     <img class="pageairship page1body" id="page1airship" style=" display:block; position:absolute; 
  width:'.$characterParts['body'][$body][12]['width'].'px; 
    height:'.$characterParts['body'][$body][12]['height'].'px;
  padding-left:'.$characterParts['body'][$body][12]['padding-left'].'px; 
  padding-top:'.$characterParts['body'][$body][12]['padding-top'].'px;
  padding-bottom:'.$characterParts['body'][$body][12]['padding-bottom'].'px;
  padding-right:'.$characterParts['body'][$body][12]['padding-right'].'px;" 
  src="'.$characterParts['body'][$body][12]['skin'][$bodycolor].'" />

   



       <img class="pagehair page1hair" id="page1hair" style="display:block;position:absolute; transform:rotate(0);
  width:'.$characterParts['hair'][$hair][$body][12]['width'].'px;  
  padding-left:'.$characterParts['hair'][$hair][$body][12]['padding-left'].'px;
  padding-right:'.$characterParts['hair'][$hair][$body][12]['padding-right'].'px;
  padding-top:'.$characterParts['hair'][$hair][$body][12]['padding-top'].'px;
  padding-bottom:'.$characterParts['hair'][$hair][$body][12]['padding-bottom'].'px;"
          src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />




           <img class="pageyes page2eyes" id="page2eyes"     style=" ply:block;position:absolute; 
  
      padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][12]['padding-bottom'].'px;
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][12]['padding-left'].'px;
      padding-top:'.$characterParts['eyes'][$eyes][$hair][$body][12]['padding-top'].'px;     
     width:'.$characterParts['eyes'][$eyes][$hair][$body][12]['width'].'px; "
     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />











      '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$body][$hair][12]['width'].'px;

padding-left:'.$characterParts['glasses'][$body][$hair][12]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][12]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][12]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][12]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'


       '.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;
width:'.$characterParts['freckles'][$body][$hair][$glasses][12]['width'].'px;
height:'.$characterParts['freckles'][$body][$hair][$glasses][12]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$hair][$glasses][12]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$hair][$glasses][12]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$hair][$glasses][12]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$hair][$glasses][12]['padding-bottom'].'px; "
    src="i/character/Freckles/FrecklesPointsHiRes-01.png" /> 

  ' : '').'

   
         </div>
         






         
         '.$pageSeparator.'
       </div>' : '').'






































     
                     '.(in_array(13,$pages) ? '<div id="page13area" class="pagearea page13area" style="overflow:hidden">
   

   <div style="background-image:url(i/pages/PlaygroundPACKAGE/PlaygroundSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">

    
         
         <div id="page13textcontainer" class="pagetextcontainer page13textcontainer" style="height:0px;position:relative;font-family: Arial;width:0px;color:#000">
   
   
   
   
             <div class="first" style="color:#000;text-align:left; padding-left:455px;padding-top:65px; font-size:22px;">
             <div><span class="childsnameautofill">'.$childsname.'</span> hops in the saucer -</div>
             <div>Spins round and round,</div>
             <div>With friends and feeling free,</div>
             <div><span class="childsnameautofill">'.$childsname.'</span> loves the playground!</div>
             </div>
             <div class="second" style="color:#000;text-align:left; padding-left:530px;padding-top:19px; font-size:22px;">
             <div>We’re kind while we play,</div>
             <div>But if somebody is mean,</div>
             <div>We tell them politely to stop,</div>
             <div>We won’t make a big scene,</div>
             </div>
   
             <div class="third" style="color:#000;text-align:left; padding-left:610px;padding-top:19px; font-size:22px;">
             <div>The park is our safe place,</div>
             <div>We laugh, we sing and we play.</div>
             <div>All our friends are so nice,</div>
             <div>We could stay here all day!</div>
             </div>
   
   
         </div>
         </div></div>











<div id="page13area" class="pagearea page13area" style="overflow:hidden">

    <div style="background-image:url(i/pages/PlaygroundPACKAGE/PlaygroundSpread'.$res.');  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">
         
       
     <img class="pageairship page1body" id="page1airship" style=" display:inline-block; position:absolute; 
    width:'.$characterParts['body'][$body][13]['width'].'px; 
   
    padding-left:'.$characterParts['body'][$body][13]['padding-left'].'px; 
     padding-top:'.$characterParts['body'][$body][13]['padding-top'].'px;" 
     padding-bottom:'.$characterParts['body'][$body][13]['padding-bottom'].'px;"
      padding-right:'.$characterParts['body'][$body][13]['padding-right'].'px;" 
    src="'.$characterParts['body'][$body][13]['skin'][$bodycolor].'" />



    <img class="pagehair page1hair" id="page1hair" style="display:block;position:absolute; 
    transform:rotate(0);
      width:'.$characterParts['hair'][$hair][$body][13]['width'].'px;  
      padding-left:'.$characterParts['hair'][$hair][$body][13]['padding-left'].'px;
      padding-top:'.$characterParts['hair'][$hair][$body][13]['padding-top'].'px;
       padding-bottom:'.$characterParts['hair'][$hair][$body][13]['padding-bottom'].'px;"
          src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />



             <img class="pageyes page2eyes" id="page2eyes"     style=" ply:block;position:absolute; 
  
      padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][13]['padding-bottom'].'px;
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][13]['padding-left'].'px;
      padding-top:'.$characterParts['eyes'][$eyes][$hair][$body][13]['padding-top'].'px;     
     width:'.$characterParts['eyes'][$eyes][$hair][$body][13]['width'].'px; "
     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />
   


    '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$body][$hair][13]['width'].'px;
height:'.$characterParts['glasses'][$body][$hair][13]['height'].'px;
padding-left:'.$characterParts['glasses'][$body][$hair][13]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][13]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][13]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][13]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'


      '.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;
width:'.$characterParts['freckles'][$body][$glasses][13]['width'].'px;
height:'.$characterParts['freckles'][$body][$glasses][13]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$glasses][13]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$glasses][13]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$glasses][13]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$glasses][13]['padding-bottom'].'px; "
    src="i/character/Freckles/FrecklesPointsHiRes-01.png" /> 

  ' : '').'

</div>



         

         '.$pageSeparator.'
       </div>' : '').'



























       '.(in_array(14,$pages) ? '<div id="page14area" class="pagearea page14area" style="overflow:hidden">

         


   <div style="background-image:url(i/pages/Rainbow-Slide-PACKAGE/RainbowSlideSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">



         <div id="page14textcontainer" class="pagetextcontainer page14textcontainer" style="color:#000;text-align:left; padding-left:440px;padding-top:65px; font-family: Arial;font-size:24px;">
                     
             <div>Come, let’s take a ride,</div>
             <div>On a magical rainbow slide,</div>
             <div>To a special place where,</div>
             <div>No one needs to hide.</div>
             <div>&nbsp;</div>
             <div>No matter who we love,</div>
             <div>Or our color, religion, or gender,</div>
             <div>We’re embraced for our beauty,</div>
             <div>We’re proud of our splendour.</div>
           
   
   
         </div>
       </div> </div>








         <div id="page14area" class="pagearea page14area" style="overflow:hidden">

         
<div style="background-image:url(i/pages/Rainbow-Slide-PACKAGE/RainbowSlideSpread'.$res.');  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">







  <img class="pageairship page1body" id="page1airship" style=" display:block; position:absolute; 
  width:'.$characterParts['body'][$body][14]['width'].'px; 
    height:'.$characterParts['body'][$body][14]['height'].'px;
  padding-left:'.$characterParts['body'][$body][14]['padding-left'].'px; 
  padding-top:'.$characterParts['body'][$body][14]['padding-top'].'px;
  padding-bottom:'.$characterParts['body'][$body][14]['padding-bottom'].'px;
  padding-right:'.$characterParts['body'][$body][14]['padding-right'].'px;" 
  src="'.$characterParts['body'][$body][14]['skin'][$bodycolor].'" />




   
    <img class="pagehair page1hair" id="page1hair" style="display:block;position:absolute; transform:rotate(0);
  width:'.$characterParts['hair'][$hair][$body][14]['width'].'px;  
  padding-left:'.$characterParts['hair'][$hair][$body][14]['padding-left'].'px;
    padding-right:'.$characterParts['hair'][$hair][$body][14]['padding-right'].'px;
  padding-top:'.$characterParts['hair'][$hair][$body][14]['padding-top'].'px;
  padding-bottom:'.$characterParts['hair'][$hair][$body][14]['padding-bottom'].'px;"
  src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />



 <img class="pageyes page2eyes" id="page2eyes"     style=" ply:block;position:absolute; 
  
      padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][14]['padding-bottom'].'px;
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][14]['padding-left'].'px;
      padding-top:'.$characterParts['eyes'][$eyes][$hair][$body][14]['padding-top'].'px;     
     width:'.$characterParts['eyes'][$eyes][$hair][$body][14]['width'].'px; "
     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />
   



          '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$body][$hair][14]['width'].'px;
height:'.$characterParts['glasses'][$body][$hair][14]['height'].'px;
padding-left:'.$characterParts['glasses'][$body][$hair][14]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][14]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][14]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][14]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'



      '.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;
width:'.$characterParts['freckles'][$body][$glasses][14]['width'].'px;
height:'.$characterParts['freckles'][$body][$glasses][14]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$glasses][14]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$glasses][14]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$glasses][14]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$glasses][14]['padding-bottom'].'px; "
    src="i/character/Freckles/FrecklesPointsHiRes-01.png" /> 

  ' : '').'


        </div></div>

         '.$pageSeparator.'
       </div>' : '').'






















       '.(in_array(15,$pages) ? '<div id="page15area" class="pagearea page15area" style="overflow:hidden">

<div style="background-image:url(i/pages/SailingPACKAGE/SailingSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">




        <img class="pageairship page1body" id="page1airship" style=" display:block; position:absolute; 
  width:'.$characterParts['body'][$body][15]['width'].'px; 
    height:'.$characterParts['body'][$body][15]['height'].'px;
  padding-left:'.$characterParts['body'][$body][15]['padding-left'].'px; 
  padding-top:'.$characterParts['body'][$body][15]['padding-top'].'px;
  padding-bottom:'.$characterParts['body'][$body][15]['padding-bottom'].'px;
  padding-right:'.$characterParts['body'][$body][15]['padding-right'].'px;" 
  src="'.$characterParts['body'][$body][15]['skin'][$bodycolor].'" />



        
         </div></div></div>







         <div id="page15area" class="pagearea page15area" style="overflow:hidden">


 <div style="background-image:url(i/pages/SailingPACKAGE/SailingSpread'.$res.');  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">

   

         <div id="page15textcontainer" class="pagetextcontainer page15textcontainer" style="color:#000;text-align:left; padding-left:620px;padding-top:85px;font-family: Arial; font-size:24px;">
         
   
   
   
   
               <div>Through rain and through wind,</div>
               <div>Through rough and stormy seas,</div>
               <div><span class="childsnameautofill">'.$childsname.'</span> sails and searches,</div>
               <div>For new discoveries.</div>
               <div>&nbsp;</div>
               <div>Finding adventure,</div>
               <div>Is so much fun, let’s go!</div>
               <div>The joy is in the journey,</div>
               <div>When one goes with the flow.</div>
               <div>&nbsp;</div>
               <div>But if <span class="childsnameautofill">'.$childsname.'</span> sometimes,</div>
               <div>Feels a bit unsure,</div>
               <div>It\'s time to take 3 deep breaths in -</diV>
               <diV>Breathe out and try once more.</div>
               <div>&nbsp;</div>
               <div><span class="childsnameautofill">'.$childsname.'</span> knows there\'s lessons,</div>
               <div>We can always discern,</div>
               <div>If we ask our higher self,</div>
               <div>What is it we’re meant to learn.</div>
   
   
   
         </div>
         <div id="page15charactercontainer" class="pagecharactercontainer page15charactercontainer" style="height:0px;width:0px;position:relative">
           <img class="pagebody page15body" id="page15body" style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
           <div id="page15characterheadstuff" class="page15characterheadstuff" style="position:relative">
             
             
           </div>
         </div>






















         '.$pageSeparator.'
       </div>' : '').'
       '.(in_array(16,$pages) ? '<div id="page16area" class="pagearea page16area">


        <div style="background-image:url(i/pages/SpacePackage/SpaceSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">


         
         <div id="page16textcontainer" class="pagetextcontainer page16textcontainer"style="color:#8cc63f;text-align:left; padding-left:260px;padding-top:80px; font-family: Arial; font-size:24px;">
   
   
   
                   <div>Twinkle, twinkle, deep, dark sky,</div>
                   <div>How <span class="childsnameautofill">'.$childsname.'</span> loves being up so high!</div>
                   <div>Looking down on Earth below,</div>
                   <div>Planning all the places we\'ll go.</div>
                   <div>&nbsp;</div>
                   <div>I-Spy Earth! We’re oh so far,</div>
                   <div>We’ll count the stars and visit Mars.</div>
                   <div>Exploring in this expansive place,</div>
                   <div>We’re oh so tiny from up in space!</div>
   
   
   
         </div>
          </div> </div>






         <div id="page16area" class="pagearea page16area">

<div style="background-image:url(i/pages/SpacePackage/SpaceSpread'.$res.');  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">






         
         <div id="page16textcontainer" class="pagetextcontainer page16textcontainer"style="color:#8cc63f;text-align:left; padding-left:260px;padding-top:80px; font-family: Arial; font-size:24px;">
   
   
   
                

         <img class="pageairship page1body" id="page1airship" style=" display:inline-block; position:absolute; 
    width:'.$characterParts['body'][$body][16]['width'].'px; 
    height:'.$characterParts['body'][$body][16]['height'].'px; 
    padding-left:'.$characterParts['body'][$body][16]['padding-left'].'px; 
     padding-top:'.$characterParts['body'][$body][16]['padding-top'].'px;" 
     padding-bottom:'.$characterParts['body'][$body][16]['padding-bottom'].'px;"
      padding-right:'.$characterParts['body'][$body][16]['padding-right'].'px;" 
    src="'.$characterParts['body'][$body][16]['skin'][$bodycolor].'" />



        <img class="pagehair page1hair" id="page1hair" style="display:block;position:absolute; 
  width:'.$characterParts['hair'][$hair][$body][16]['width'].'px;  
  padding-left:'.$characterParts['hair'][$hair][$body][16]['padding-left'].'px;
    padding-right:'.$characterParts['hair'][$hair][$body][16]['padding-right'].'px;
  padding-top:'.$characterParts['hair'][$hair][$body][16]['padding-top'].'px;
  padding-bottom:'.$characterParts['hair'][$hair][$body][16]['padding-bottom'].'px;"
  src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />


   <img class="pageyes page2eyes" id="page2eyes"     style=" ply:block;position:absolute; 
  
      padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][16]['padding-bottom'].'px;
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][16]['padding-left'].'px;
      padding-top:'.$characterParts['eyes'][$eyes][$hair][$body][16]['padding-top'].'px;     
     width:'.$characterParts['eyes'][$eyes][$hair][$body][16]['width'].'px; "
     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />
   


        

        '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$body][$hair][16]['width'].'px;
height:'.$characterParts['glasses'][$body][$hair][16]['height'].'px;
padding-left:'.$characterParts['glasses'][$body][$hair][16]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][16]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][16]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][16]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'



      '.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;
width:'.$characterParts['freckles'][$body][$glasses][16]['width'].'px;
height:'.$characterParts['freckles'][$body][$glasses][16]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$glasses][16]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$glasses][16]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$glasses][16]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$glasses][16]['padding-bottom'].'px; "
    src="i/character/Freckles/FrecklesPointsHiRes-01.png" /> 

  ' : '').'


           
           </div>
         </div>
         '.$pageSeparator.'
       </div>' : '').'






























       '.(in_array(17,$pages) ? '<div id="page17area" class="pagearea page17area" style="overflow:hidden">

                <div style="background-image:url(i/pages/StillnessPACKAGE/StillnessSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">


      
     

   

      <img class="pagehair page1hair" id="page1hair" style="display:block;position:absolute; 
width:900px;
height:500px;
padding-top:450px;
padding-bottom:-500px;
padding-right:-300px;
padding-left:350px;


"
  src="'.$characterParts['body'][$body][17]['skin'][$bodycolor].'" />




       <img class="pagehair page1hair" id="page1hair" style="display:block;position:absolute; 

        
  width:'.$characterParts['hair'][$hair][$body][17]['width'].'px;  
  height:'.$characterParts['hair'][$hair][$body][17]['height'].'px; 
  padding-left:'.$characterParts['hair'][$hair][$body][17]['padding-left'].'px;
  padding-top:'.$characterParts['hair'][$hair][$body][17]['padding-top'].'px;
   padding-bottom:'.$characterParts['hair'][$hair][$body][17]['padding-bottom'].'px;
  transform:rotate('.$characterParts['hair'][$hair][$body][17]['transform'].');"
  src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />



          <img class="pageyes page2eyes" id="page2eyes"     style=" ply:block;position:absolute; 
  
      padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][17]['padding-bottom'].'px;
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][17]['padding-left'].'px;
      padding-top:'.$characterParts['eyes'][$eyes][$hair][$body][17]['padding-top'].'px;     
     width:'.$characterParts['eyes'][$eyes][$hair][$body][17]['width'].'px;
       transform:rotate('.$characterParts['eyes'][$eyes][$hair][$body][17]['transform'].');
        "
     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />
   




        '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(330); 
width:'.$characterParts['glasses'][$body][$hair][17]['width'].'px;
height:'.$characterParts['glasses'][$body][$hair][17]['height'].'px;
padding-left:'.$characterParts['glasses'][$body][$hair][17]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][17]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][17]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][17]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'



      '.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;   transform:rotate(330); 
width:'.$characterParts['freckles'][$body][$hair][$glasses][17]['width'].'px;
height:'.$characterParts['freckles'][$body][$hair][$glasses][17]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$hair][$glasses][17]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$hair][$glasses][17]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$hair][$glasses][17]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$hair][$glasses][17]['padding-bottom'].'px; "
    src="i/character/Freckles/FrecklesPointsHiRes-01.png" /> 

  ' : '').'
         </div></div>




         <div id="page17area" class="pagearea page17area" style="overflow:hidden">

   
<div style="background-image:url(i/pages/StillnessPACKAGE/StillnessSpread'.$res.');  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">






         <div id="page17textcontainer" class="pagetextcontainer page17textcontainer" style="color:#fff;text-align:left; padding-left:160px;padding-top:150px; font-family: Arial; font-size:24px;">
   
               <div><span class="childsnameautofill">'.$childsname.'</span> can match their breath,</div>
               <div>To the cricket’s song,</div>
               <div>It’s peaceful in the grass,</div>
               <div>Relaxing and humming along.</div>
               <div>&nbsp;</div>
               <div>Stars start to pop out,</div> 
               <div><span class="childsnameautofill">'.$childsname.'</span> counts them - one, two, three,</div>
               <div>But there’s so, so many more,</div>
               <div>How many can you see?</div>
         </div>



         <img class="pageairship page1airship" id="page1airship" style="display:block;position:absolute; z-index: -1; 
    transform: rotate(0deg);   width:1212px;  padding-left:-990px;   padding-top:-70px; padding-bottom:-500px" src="i/pages/StillnessPACKAGE/StillnessBody1.png" />


        
         </div>
         '.$pageSeparator.'
       </div>' : '').'






















       '.(in_array(19,$pages) ? '<div id="page19area" class="pagearea page19area">

           <div style="background-image:url(i/pages/UnicornSpreadPACKAGE/UnicornSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">


         <div id="page19textcontainer" class="pagetextcontainer page19textcontainer" style="height:0px;position:relative;width:0px;color:#6a3293">
   
           <div class="first" style="color:#6a3293;text-align:left; padding-left:125px;padding-top:140px; font-family: Arial; font-size:25px;" >
               <div>A unicorn soaks up energy,</div>
             <div>From the tip of their horn,</div>
             <div>And their love grows bigger,</div>
             <div>Every time a baby is born!</div>
             <div>&nbsp;</div>
             <div>A baby unicorn is called,</div>
             <div>A ‘sparkle’ did you know?</div>
             <div>Their horns are called ‘alicorns’,</div>
             <div>And at night time, watch them glow!</div>
             <div>&nbsp;</div>
             <div>‘Be loving and kind’, they warn,</div>
             <div>Ask others how they are,</div>
             <div>With love and kindness,</div>
             <div>In life you will go far!</div>
           </div>
   
   
   
   
         </div>



                        <img class="pagebody page19body" id="page1body" style=" display:block; position:absolute; 
    width:'.$characterParts['body'][$body][19]['width'].'px; 
    padding-left:'.$characterParts['body'][$body][19]['padding-left'].'px; 
     padding-top:'.$characterParts['body'][$body][19]['padding-top'].'px;
     padding-bottom:'.$characterParts['body'][$body][19]['padding-bottom'].'px;
      padding-right:'.$characterParts['body'][$body][19]['padding-right'].'px;" 
    src="'.$characterParts['body'][$body][19]['skin'][$bodycolor].'" />



          
            <img class="pagehair page1hair" id="page1hair" style="display:block;position:absolute; 
        transform:rotate(0);
  width:'.$characterParts['hair'][$hair][$body][19]['width'].'px;  
  padding-left:'.$characterParts['hair'][$hair][$body][19]['padding-left'].'px;
  padding-top:'.$characterParts['hair'][$hair][$body][19]['padding-top'].'px;
   padding-right:'.$characterParts['hair'][$hair][$body][19]['padding-right'].'px;
   padding-bottom:'.$characterParts['hair'][$hair][$body][19]['padding-bottom'].'px;
     transform:rotate('.$characterParts['hair'][$hair][$body][19]['transform'].');"
  
  src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />


  <img class="pageyes page2eyes" id="page2eyes"     style=" display:block;position:absolute; 
  
      padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][19]['padding-bottom'].'px;
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][19]['padding-left'].'px;
      padding-top:'.$characterParts['eyes'][$eyes][$hair][$body][19]['padding-top'].'px;     
     width:'.$characterParts['eyes'][$eyes][$hair][$body][19]['width'].'px;
       transform:rotate('.$characterParts['eyes'][$eyes][$hair][$body][19]['transform'].');
        "
     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />


        

        '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(340); 
width:'.$characterParts['glasses'][$body][$hair][19]['width'].'px;
height:'.$characterParts['glasses'][$body][$hair][19]['height'].'px;
padding-left:'.$characterParts['glasses'][$body][$hair][19]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][19]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][19]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][19]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'



      '.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;
     transform:rotate(340); 
width:'.$characterParts['freckles'][$body][$hair][$glasses][19]['width'].'px;
height:'.$characterParts['freckles'][$body][$hair][$glasses][19]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$hair][$glasses][19]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$hair][$glasses][19]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$hair][$glasses][19]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$hair][$glasses][19]['padding-bottom'].'px; "
    src="i/character/Freckles/FrecklesPointsHiRes-01.png" /> 

  ' : '').'


</div></div>








         <div id="page19area" class="pagearea page19area">

 <div style="background-image:url(i/pages/UnicornSpreadPACKAGE/UnicornSpread'.$res.');  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">

   
           </div>
         </div>
         '.$pageSeparator.'
       </div>' : '').'






























        '.(in_array(20,$pages) ? '<div id="page20area" class="pagearea page20area">
        

           <div style="background-image:url(i/pages/WheelsPACKAGE/WheelsSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">


              <img class="pageairship page1body" id="page1airship" style=" display:inline-block; position:absolute; 
    width:'.$characterParts['body'][$body][20]['width'].'px; 
    height:'.$characterParts['body'][$body][20]['height'].'px; 
    padding-left:'.$characterParts['body'][$body][20]['padding-left'].'px; 
     padding-top:'.$characterParts['body'][$body][20]['padding-top'].'px;" 
     padding-bottom:'.$characterParts['body'][$body][20]['padding-bottom'].'px;"
      padding-right:'.$characterParts['body'][$body][20]['padding-right'].'px;" 
    src="'.$characterParts['body'][$body][20]['skin'][$bodycolor].'" />


            <img class="pagehair page1hair" id="page1hair" style="display:block;position:absolute; transform:rotate(0);
        
  width:'.$characterParts['hair'][$hair][$body][20]['width'].'px;  
  padding-left:'.$characterParts['hair'][$hair][$body][20]['padding-left'].'px;
  padding-top:'.$characterParts['hair'][$hair][$body][20]['padding-top'].'px;
   padding-bottom:'.$characterParts['hair'][$hair][$body][20]['padding-bottom'].'px;
  "
  src="'.$characterParts['hair'][$hair]['color'][$haircolor].'" />



  <img class="pageyes page2eyes" id="page2eyes"     style=" ply:block;position:absolute; 
  
      padding-bottom:'.$characterParts['eyes'][$eyes][$hair][$body][20]['padding-bottom'].'px;
     padding-left:'.$characterParts['eyes'][$eyes][$hair][$body][20]['padding-left'].'px;
      padding-top:'.$characterParts['eyes'][$eyes][$hair][$body][20]['padding-top'].'px;     
     width:'.$characterParts['eyes'][$eyes][$hair][$body][20]['width'].'px; "
     src="'.$characterParts['eyes'][$eyes]['color'][$eyescolor].'" />




             '.($glasses==1 ? '

   <img class="pagglasses page1glasses" id="page1glasses" style="display:block; position:absolute;
   transform:rotate(0); 
width:'.$characterParts['glasses'][$body][$hair][20]['width'].'px;
height:'.$characterParts['glasses'][$body][$hair][20]['height'].'px;
padding-left:'.$characterParts['glasses'][$body][$hair][20]['padding-left'].'px;
padding-right:'.$characterParts['glasses'][$body][$hair][20]['padding-right'].'px;
padding-top:'.$characterParts['glasses'][$body][$hair][20]['padding-top'].'px;
padding-bottom:'.$characterParts['glasses'][$body][$hair][20]['padding-bottom'].'px;
"
src="i/character/Glasses/Glasses1.png" /> 

  ' : '').'



      '.($freckles==1 ? '

  <img class="pagglasses page1glasses" id="page1glasses" style="position:absolute;
width:'.$characterParts['freckles'][$body][$glasses][$hair][20]['width'].'px;
height:'.$characterParts['freckles'][$body][$glasses][$hair][20]['height'].'px;
padding-left:'.$characterParts['freckles'][$body][$glasses][$hair][20]['padding-left'].'px;
padding-right:'.$characterParts['freckles'][$body][$glasses][$hair][20]['padding-right'].'px;
padding-top:'.$characterParts['freckles'][$body][$glasses][$hair][20]['padding-top'].'px;
padding-bottom:'.$characterParts['freckles'][$body][$glasses][$hair][20]['padding-bottom'].'px; "
    src="i/character/Freckles/FrecklesPointsHiRes-01.png" /> 

  ' : '').'

         
     </div></div>






         <div id="page20area" class="pagearea page20area">
        

       
 <div style="background-image:url(i/pages/WheelsPACKAGE/WheelsSpread'.$res.');  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">

         <div id="page20textcontainer" class="pagetextcontainer page20textcontainer" style="color:#000;text-align:left; padding-left:90px;padding-top:55px; font-family: Arial;font-size:25px;">
   
   
         <div>There’s so many ways,</div>
         <div>That people get around,</div>
         <div>Wheels on the pavement is,</div>
         <div><span class="childsnameautofill">'.$childsname.'</span>’s favorite sound.</div>
         <div>&nbsp;</div>
         <div>Bikes, roller skates, scooters,</div>
         <div>Trikes, skateboards, cars,</div>
         <div>And some people use wheelchairs,</div>
         <div>That also takes them far.</div>
         <div>&nbsp;</div>
         <div>Getting about outside,</div>
         <div>Makes for an excellent day,</div>
         <div>Always include others and,</div>
         <div>Invite everyone to play!</div>
   
   
   
         </div>
         
         </div>
         '.$pageSeparator.'
       </div>' : '').'


























       '.(in_array(21,$pages) ? '<div id="page21area" class="pagearea page21area">



              <div style="background-image:url(i/pages/dedication/DedicatioSpread'.$res.');  
      background-position: 0px 0px;   background-repeat: no-repeat;height: 1200px; width:2500px; background-size: 200% 100%;">


  <img class="pageairship page1body" id="page1airship" style=" display:block; position:fixed; 

              width:430px;
            
             min-height:310px;
             height:310px;
              max-height:310px;
              padding-bottom:-570px;
              transform:rotate(344);
              padding-left:282px;
              padding-top:290px;

              
   "
     src="upload/'.$childImageFileName.'" />
        
         </div></div>


         <div id="page21area" class="pagearea page21area">

 <div style="background-image:url(i/pages/dedication/DedicatioSpread'.$res.');  
   background-position: 100% 10%;    background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 200% 100%;">


<div style="transform:rotate(20); padding-left:380px; padding-top:80px; ;">

<table border="0" rotate="90">
<tr>
<th style="text-rotate: 83"><p style="font-size:40px;line-height:50px;:100px;">'.$childsname.'</p></th>

</tr>
</table>

</div>






<div style="transform:rotate(20); padding-left:375px; padding-top:19px; ;">

<table border="0" rotate="90">
<tr>
<th style="text-rotate: 83"><p style="font-size:40px;line-height:50px;:100px;">'.$lovenote.' </p></th>

</tr>
</table>

</div>


               </div>


         '.$pageSeparator.'
       </div>' : '').'

























          '.(in_array(22,$pages) ? '






         <div id="page20area" class="pagearea page20area">
        

       
 <div style="background-image:url(i/pages/InteriorBackCover.png);  
   background-position: 100% 10%;   background-repeat: no-repeat;height: 1050px; width:2500px; background-size: 100% 100%;">


         
        
           
         </div>
         '.$pageSeparator.'
       </div>' : '').'

   
   '.($pdfVersion ? '<div id="page221area" class="insidecoverarea page221area" style="width:3375px;height:2625px">
         <img class="insidecoverbackground pagebackground221" id="pagebackground221" width="100%" src="i/pages/InteriorBackCover.png"/>
       </div>' : '').'
   
   <div style="background-color:#ff0000"></div>
     </div>';
   
   //print_r($html);exit;
   
   
    $pdf->writeHTML($html);
    $fileName=$lastname.'.'.$firstname.'.'.$orderId.'.page.pdf';
    $pdf->Output($fileName, 'D');
   
   }}
    
    
    ?>