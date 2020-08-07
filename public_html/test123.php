<?php
  require_once 'swim.php';
$request=new request();

  $session=new session();
  $session->start();

  $db=new database();
  $db->databaseName($SWIM['dbDatabaseName']);
  $db->username($SWIM['dbUsername']);
  $db->password($SWIM['dbPass']);
  $db->connect();

  echo headerHTML('Cosmic Unicorns',[
    
    'j/salowell-lib.js',
    'j/pdfprint.js',
    'j/html2canvas/html2canvas.min.js',
    'j/rasterizeHTML.allinone.js',
    'j/test.js',
  ],['c/0.css','c/pdfprint.css']);

  if($session->getUserId()!==null)
  {
    $selects=['paymentprocessor','paid_response','billing_info','paymentintentid','paymentid','hair','haircolor','eyes','eyescolor','glasses','freckles','body','bodycolor','pages','childsname','lovenote','childspicture'];
    $search=['id'=>$request->getGet('id',0)];
    $db->tablePrefix('');
    $db->tableName('payments');
    $paymentRow=$db->get($selects,$search);

    if($paymentRow!==false)
    {
      $paymentRow=mysqli_fetch_assoc($paymentRow);
            
      if($paymentRow!==null)
      {
        $paymentProcessor='Stripe';
        if($paymentRow['paymentprocessor']==2)$paymentProcessor='PayPal';
?>

<script type="text/javascript">var res="LoRes.jpg";</script>
<style type="text/css">.pagetextcontainer{line-height:100% !important} img, iframe, .wp-caption, select{max-width:unset !important;}</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>


<?php
   $paymentProcessor='Stripe';
    $paymentIntentId=htmlentities($paymentRow['paymentintentid']);
    if(empty($paymentIntentId))
    {
        $paymentProcessor='Pre Order';
    }

    if($paymentProcessor=='stripe')
    {
        
        $responseData3=json_decode($payment['paid_response']);
        $name= htmlentities($responseData3->data->object->shipping->name);

    }else{
        
        $billingInfo=json_decode($paymentRow['billing_info']);
        $name =$billingInfo->name;
    }
    $nameArray= explode(' ', $name);
    $firstname= isset($nameArray[0])?$nameArray[0]:'';
    $lastname= isset($nameArray[1])?$nameArray[1]:'';
    $orderId= $paymentRow['id'];
    

 ?>


<input type="hidden" id="pdffilename" value="<?="$lastname.$firstname.$orderId"?>" />
<input type="hidden" name="bodytype" id="selectedbodytype" value="<?php echo htmlentities($paymentRow['body']);?>" />
<input type="hidden" name="skincolor" id="selectedskincolor" value="<?php echo htmlentities($paymentRow['bodycolor']);?>" />
<input type="hidden" name="eyestype" id="selectedeyestype" value="<?php echo htmlentities($paymentRow['eyes']);?>" />
<input type="hidden" name="eyescolor" id="selectedeyescolor" value="<?php echo htmlentities($paymentRow['eyescolor']);?>" />
<input type="hidden" name="hairtype" id="selectedhairtype" value="<?php echo htmlentities($paymentRow['hair']);?>" />
<input type="hidden" name="haircolor" id="selectedhaircolor" value="<?php echo htmlentities($paymentRow['haircolor']);?>" />
<input type="hidden" name="glasses" id="selectedglasses" value="<?php echo htmlentities($paymentRow['glasses']);?>" />
<input type="hidden" name="freckles" id="selectedfreckles" value="<?php echo htmlentities($paymentRow['freckles']);?>" />

<textarea class="form-control grid_col_8" id="lovenoteinput" style="overflow: hidden; height: 184px;display:none;visibility:hidden" placeholder=""><?php echo htmlentities($paymentRow['lovenote']);?></textarea>

<?php
    $pages=explode('-',$paymentRow['pages']);
array_unshift($pages ,0);
    array_push($pages,21);
    if(count($pages) !== 0)
    {  

      
      //if(!is_array($pages))
      //{
      //  $pages=[$pages];
      //}

      foreach($pages AS $k=>$v)echo '<input class="hiddenpagesinput" type="hidden" value="'.$v.'" name="pages[]" />';
    }
?>

<div id="infoheaderthing" style="position:absolute;z-index:219;">
  <div id="editor"></div>
  <div id="currentstatus"></div>
  <div id="cmd" style="display:none">DOWNLOAD</div>
  <div id="pdfstatus"></div>
</div>
<section class="hero-section bg-cover">
  <div class="container">

<div id="charactereditorarea" class="noprint" style="margin-top:-210px;padding-top:210px;display:none;visibility:hidden;">
<input id="childsnameinput" value="<?php echo htmlentities($paymentRow['childsname']);?>" class="form-control mb-3" type="text" style="position:relative" placeholder="Child's Name"/>
      <div id="characterdisplay">
        <div id="partselectors">
          <div id="hairselectorarea"><div id="hairselector"><div class="hid"><img src="i/buttons/Green.png" /></div><div class="sho"><img src="i/buttons/Green-Hair-Cover.png" /></div></div></div>
          <div id="hisabselectorarea"><div id="hisabselector"><div class="hid"><img src="i/buttons/Green.png" /></div><div class="sho"><img src="i/buttons/Green-Hair-Cover.png" /></div></div></div>
          
          <div id="eyeselectorarea"><div id="eyeselector"><div class="hid"><img src="i/buttons/Blue.png" /></div><div class="sho"><img src="i/buttons/Blue-Eyes.png" /></div></div></div>
          <div id="extrasselectorarea"><div id="extrasselector"><div class="hid"><img src="i/buttons/Pink.png" /></div><div class="sho"><img src="i/buttons/Pink-Extras.png" /></div></div></div>
          <div id="bodyselectorarea"><div id="bodyselector"><div class="hid"><img src="i/buttons/Teal.png" /></div><div class="sho"><img src="i/buttons/Teal-Body.png" /></div></div></div>
        </div>
        <img id="eyeimg" src="i/character/Eyes/EyesEyelashes/2EyesBlueLashes-01.png" height="108" width="108" />
        <img id="bodyimg" src="i/character/FullbodyStanding/fullbodyst1.png" height="365" width="137" />
        <img id="frecklesimg" src="i/character/Freckles/Freckles.png" height="32" width="103" />
        <img id="glassesimg" src="i/character/Glasses/Glasses1.png" height="27.05" width="108" />
        <img id="hairimg" src="i/character/Hair/LongBraidsDown/LongBraidsDownDarkBrown.png" height="288" width="144" />
      </div>
      <div id="hairselect">
        <li style="height:50px">&nbsp;</li>
        <li>
          <img class="hairselimg" src="./i/character/Hair/Cornrow/cornrowblack.png" height="50px" data-value="0" />
        </li>
        <li>
          <img class="hairselimg" src="./i/character/Hair/Hijab/Hijabblack.png" height="50px" data-value="1" />
        </li>
        <li>
          <img class="hairselimg" src="./i/character/Hair/LongBraidsDown/LongBraidsDownBlack.png" height="50px" data-value="2" />
        </li>
        <li>
          <img class="hairselimg" src="./i/character/Hair/LongPonytail/LongPonytailBlack.png" height="50px" data-value="3" />
        </li>
        <li>
          <img class="hairselimg" src="./i/character/Hair/MedAfro/MedAfroblack.png" height="50px" data-value="4" />
        </li>
        <li>
          <img class="hairselimg" src="./i/character/Hair/MedCurlyPomsDown/MedCurlyPomsDownBlack.png" height="50px" data-value="5" />
        </li>
        <li>
          <img class="hairselimg" src="./i/character/Hair/MedPigtail/Medpigtailblack.png" height="50px" data-value="6" />
        </li>
        <li>
          <img class="hairselimg" src="./i/character/Hair/MedPuffsUp/MedPuffsUpBlack.png" height="50px" data-value="7" />
        </li>
        <li>
          <img class="hairselimg" src="./i/character/Hair/MedSpikey/MedSpikeyHairBlack.png" height="50px" data-value="8" />
        </li>
        <li>
          <img class="hairselimg" src="./i/character/Hair/ShortCurlyHair/ShortCurlyHairBlack.png" height="50px" data-value="9" />
        </li>
        <li>
          <img class="hairselimg" src="./i/character/Hair/ShortHair/Shorthairblack.png" height="50px" data-value="10" />
        </li>
        <li>
          <img class="hairselimg" src="./i/character/Hair/ShortHairWavy/Shorthairwavyblack.png" height="50px" data-value="11" />
        </li>
        <li>
          <img class="hairselimg" src="./i/character/Hair/ShortSpikeyHair/ShortSpikeyHairBlack.png" height="50px" data-value="12" />
        </li>
        <li style="height:50px">&nbsp;</li>
      </div>
      <div id="haircolorselect">
        <li style="height:50px">&nbsp;</li>
        <li>
          <div id="haircolorselector0" class="haircolorselector" data-value="0"></div>
        </li>
        <li>
          <div id="haircolorselector2" class="haircolorselector" data-value="2"></div>
        </li>
        <li>
          <div id="haircolorselector4" class="haircolorselector" data-value="4"></div>
        </li>
        <li>
          <div id="haircolorselector3" class="haircolorselector" data-value="3"></div>
        </li>
        <li>
          <div id="haircolorselector1" class="haircolorselector" data-value="1"></div>
        </li>

        <li>
          <div id="haircolorselector6" class="haircolorselector" data-value="6"></div>
        </li>
        <li>
          <div id="haircolorselector5" class="haircolorselector" data-value="5"></div>
        </li>
        <li style="height:50px">&nbsp;</li>
      </div>
      <div id="bodyselect">
        <li style="height:50px">&nbsp;</li>
        <li>
          <img class="bodyselimg" src="./i/character/FullbodyStanding/fullbodyst1.png" height="50px" data-value="0" />
        </li>
        <li>
          <img class="bodyselimg" src="./i/character/FullBodyWheelchair/FullbodywheelchairStackedST1.png" height="50px" data-value="1" />
        </li>
        <li style="height:50px">&nbsp;</li>
      </div>
      <div id="bodycolorselect">
        <li style="height:50px">&nbsp;</li>
        <li>
          <div id="bodycolorselector0" class="bodycolorselector" data-value="0"></div>
        </li>
        <li>
          <div id="bodycolorselector1" class="bodycolorselector" data-value="1"></div>
        </li>
        <li>
          <div id="bodycolorselector2" class="bodycolorselector" data-value="2"></div>
        </li>
        <li>
          <div id="bodycolorselector3" class="bodycolorselector" data-value="3"></div>
        </li>
        <li>
          <div id="bodycolorselector4" class="bodycolorselector" data-value="4"></div>
        </li>
        <li>
          <div id="bodycolorselector5" class="bodycolorselector" data-value="5"></div>
        </li>
        <li style="height:50px">&nbsp;</li>
      </div>
      <div id="eyesselect">
        <li style="height:50px">&nbsp;</li>
        <li>
          <img class="eyesselectimg" src="./i/character/Eyes/Eyes/1EyesBlue-01.png" height="50px" data-value="0" />
        </li>
        <li>
          <img class="eyesselectimg" src="./i/character/Eyes/EyesEyelashes/2EyesBlueLashes-01.png" height="50px" data-value="1" />
        </li>
        <li style="height:50px">&nbsp;</li>
      </div>
      <div id="eyecolorselect">
        <li style="height:50px">&nbsp;</li>
        <li>
          <div id="eyecolorselector0" class="eyecolorselector" data-value="0"></div>
        </li>
        <li>
          <div id="eyecolorselector1" class="eyecolorselector" data-value="1"></div>
        </li>
        <li>
          <div id="eyecolorselector2" class="eyecolorselector" data-value="2"></div>
        </li>
        <li>
          <div id="eyecolorselector3" class="eyecolorselector" data-value="3"></div>
        </li>
        <li>
          <div id="eyecolorselector4" class="eyecolorselector" data-value="4"></div>
        </li>
        <li style="height:50px">&nbsp;</li>
      </div>

      <div id="glassesselect">
        <li style="height:50px">&nbsp;</li>
        <li>
          <div id="glassesselectornull" class="glassesselector  xselector" data-value="">X</div>
        </li>
        <li>
          <img id="glassesselector0" class="glassesselector" src="./i/character/Glasses/Glasses1.png" width="108" height="" data-value="0" />
        </li>
        <li style="height:50px">&nbsp;</li>
      </div>
      <div id="frecklesselect">
        <li style="height:50px">&nbsp;</li>
        <li>
          <div id="frecklesselectornull" class="frecklesselector xselector" data-value="">X</div>
        </li>
        <li>
          <img id="frecklesselector0" class="frecklesselector" src="./i/character/Freckles/Freckles.png" height="40px" data-value="0" />
        </li>
        <li style="height:50px">&nbsp;</li>
      </div>
    </div>
    <?php 

        $pages=['4'];
      $childsImage ='<img src="upload/'.htmlentities($paymentRow['childspicture']).'" class="lovenotechildspicture" style="width:unset !important;height:unset !important;max-width:100% !important;max-height:100% !important;margin-left:auto !important;margin-right:auto !important;" />';
      echo pageSpreadsHtmlTest('',true,$pages,htmlentities('upload/'.$paymentRow['childspicture']));
      //echo pageSpreadsHtml($childsImage,true,[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14]);
      //echo pageSpreadsHtml($childsImage,true,[0,1,2,3,4,5,6]);
      //echo pageSpreadsHtml('',true,[21],htmlentities('upload/'.$paymentRow['childspicture']));//Just 1
    ?>
  </div>
</section>

<?php
      }
    }
  }
?>
</body>
</html>