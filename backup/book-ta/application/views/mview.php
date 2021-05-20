<?php
$cndURL = 'https://cdn.shopify.com/s/files/1/0277/6091/8628/t/2/assets/';
$childTone = '';
$parentTone = '';
$child_name = "Ahmad";
$parent_name = "Javaid";
$cGen = "boys3";
$pGen = "dads2";
if($cGen == 'girs1'){
	$childTone = 'gir-s1';
}
else if($cGen == 'girs2'){
	$childTone = 'gir-s2';
}
else if($cGen == 'girs3'){
	$childTone = 'gir-s3';
}
else if($cGen == 'boys1'){
	$childTone = 'boy-s1';
}
else if($cGen == 'boys2'){
	$childTone = 'boy-s2';
}
else if($cGen == 'boys3'){
	$childTone = 'boy-s3';
}

if($pGen == 'dads1'){
	$parentTone = 'dad-s1';
}
else if($pGen == 'dads2'){
	$parentTone = 'dad-s2';
}
else if($pGen == 'dads3'){
	$parentTone = 'dad-s3';
}
else if($pGen == 'moms1'){
	$parentTone = 'mom-s1';
}
else if($pGen == 'moms2'){
	$parentTone = 'mom-s2';
}
else if($pGen == 'moms3'){
	$parentTone = 'mom-s3';
}
else if($pGen == 'gdas1'){
	$parentTone = 'gda-s1';
}
else if($pGen == 'gdas2'){
	$parentTone = 'gda-s2';
}
else if($pGen == 'gdas3'){
	$parentTone = 'gda-s3';
}
else if($pGen == 'gmas1'){
	$parentTone = 'gma-s1';
}
else if($pGen == 'gmas2'){
	$parentTone = 'gma-s2';
}
else if($pGen == 'gmas3'){
	$parentTone = 'gma-s3';
}
?>
<style>
@import url('assets/fonts/font.css');
*{margin:0;padding:0;}
body{font-family:'comfortaabold';font-size:16px;font-size:1em;line-height:14px;letter-spacing:0px}
.flipbook{width:630px;margin:0 auto}
.flipbook:before,
.flipbook:after{content:' ';display:table;width:100%;clear:both}
.flipbook > div{width:612px;height:612px;padding:9px;position:relative;background-size:100% 100%;background-position:center center;background-repeat:no-repeat;page-break-after:always}
.flipbook > div .childImg{position:absolute;left:0;top:0;right:0;z-index:1;}
.flipbook > div .parentImg{position:absolute;left:0;top:0;right:0;z-index:0;}
.flipbook > div > .border01{padding:36px;width:540px;height:540px;position:relative;z-index:5;}
.border01 p{color:#0f316e}
.border01 p > span{display:block;margin-bottom:1.438em}
.border01 p > span.child,
.border01 p > span.parent{display:inline;margin:0}
.whiteBox1 p{width:19.34em;margin:14.563em auto 0}
.whiteBox2 p{width:19.875em;margin:5em 0 0 3.313em}
.whiteBox3 p{width:18.5em;margin:0 0 0 1em;color:#fff}
.whiteBox3 p>span{margin-bottom:2.188em}
.whiteBox3 p>span+span{margin:0 0 0 .25em;font-family:'comfortaaItalic';font-style:italic}
.whiteBox4 p{width:17.25em;margin-left:13.75em;color:#fff}
.whiteBox5 p{width:17.25em;margin:27.688em 0 0 auto}
.whiteBox6 p{width:9.375em;margin:20.500em 0 0 auto}
.whiteBox7 p{margin-left:1em}
.whiteBox7 p>span{margin-bottom:.5em}
.whiteBox8 p{width:19.125em;margin:0 1em 0 auto}
.whiteBox8 p>span{margin-bottom:2.5em}
.whiteBox8 p>span+span{width:13.438em;margin:0 0 0 auto;text-align:center}
.whiteBox9 p{margin-left:1em}
.whiteBox10 p{margin:.8em 0 0 1em;font-family:'comfortaaItalic';font-style:italic}
.whiteBox11 .one{width:17.188em;text-align:center;margin-left:4.688em}
.whiteBox11 .two{width:14.25em;margin:16.875em 0 0 1em}
.whiteBox12 p{line-height:11.2px;}
.whiteBox12 .one{margin:0 0 0 4.625em;color:#fff}
.whiteBox12 .one>span{margin-bottom:1em}
.whiteBox12 .one>span+span{margin:0;line-height:6.4px}
.whiteBox12 .two{margin:12.75em 0 0 27em}
.whiteBox12 .two>span{text-indent:1.688em;margin-bottom:2.375em}
.whiteBox12 .two>span+span{margin:0 0 0 2.813em;text-indent:2em;line-height:4.8px;}
.whiteBox13 p{margin:1.375em 0 0 1em}
.whiteBox13 p>span{margin-bottom:0.625em}
.whiteBox13 p>span+span{width:16.75em;margin-bottom:0}
.whiteBox14 p{width:16.875em;text-align:center;margin:0 0 0 auto}
.whiteBox14 .one{margin-top:.5em}
.whiteBox14 .two{margin-top:3.75em}
.whiteBox14 .three{margin-top:14.5em;text-align:left;color:#fff}
.whiteBox15 p{margin:.5em 0 0 1em}
.whiteBox15 p>span{}
.whiteBox15 p>span+span{margin:0 0 0 2.313em}
.whiteBox16 .one{width:13.75em;margin-left:1em;color:#fff}
.whiteBox16 .two{width:9em;margin-top:1.75em;margin-left:auto;color:#fff}
.whiteBox16 .three{margin-top:18.5em;text-align:center}
.whiteBox17 p{width:18.75em;margin-left:auto;text-align:center}
.whiteBox18 p{width:18.75em;margin:24.375em 0 0 .5em;line-height:12.8px}
.whiteBox19 .one{margin:.4em 0 0 1em;}
.whiteBox19 .one>span{line-height:8px;display:inline-block;margin-bottom:.75em}
.whiteBox19 .one>span+span{line-height:2.8px;margin-bottom:0;margin-left:2em}
.whiteBox19 .two{width:30.5em;margin-left:auto;margin-right:.3em}
.whiteBox19 .two>span{margin-bottom:0}
.whiteBox20 .one{width:24.125em}
.whiteBox20 .two{width:11.75em;text-align:right;margin:4.125em 0 0 auto}
.whiteBox21 p{width:30.125em;margin-top:1em;margin-left:1em;color:#fff}
.whiteBox21 p>span{margin:0 6em 1em 0}
.whiteBox21 p>span+span{margin:0}
.whiteBox22 p{margin:.8em 0 0 1.5em}
.whiteBox22 p>span{margin-bottom:.25em}
.whiteBox22 p>span+span{margin:0 0 0 5.5em}
.whiteBox24 p{width:37.5em;margin:0 auto;font-size:.75em;text-align:center;line-height:9px;}
.whiteBox24 p>span{margin:2.5em 0 11.25em}
	
.whiteBox1{
	text-align:center;
	background-image:url('<?php echo $cndURL ?>cover-01.jpg')
}
.whiteBox2{
	background-image:url('<?php echo $cndURL ?>cover-02.jpg')
}
.whiteBox3{
	background-image:url('<?php echo $cndURL ?>cover-03.jpg')
}
.whiteBox4{
	background-image:url('<?php echo $cndURL ?>cover-04.jpg')
}
.whiteBox5{
	background-image:url('<?php echo $cndURL ?>cover-05.jpg')
}
.whiteBox6{
	background-image:url('<?php echo $cndURL ?>cover-06.jpg')
}
.whiteBox7{
	background-image:url('<?php echo $cndURL ?>cover-07.jpg')
}
.whiteBox8{
	background-image:url('<?php echo $cndURL ?>cover-08.jpg')
}
.whiteBox9{
	background-image:url('<?php echo $cndURL ?>cover-09.jpg')
}
.whiteBox10{
	background-image:url('<?php echo $cndURL ?>cover-10.jpg')
}
.whiteBox11{
	background-image:url('<?php echo $cndURL ?>cover-11.jpg')
}
.whiteBox12{
	background-image:url('<?php echo $cndURL ?>cover-12.jpg')
}
.whiteBox13{
	background-image:url('<?php echo $cndURL ?>cover-13.jpg')
}
.whiteBox14{
	background-image:url('<?php echo $cndURL ?>cover-14.jpg')
}
.whiteBox15{
	background-image:url('<?php echo $cndURL ?>cover-15.jpg')
}
.whiteBox16{
	background-image:url('<?php echo $cndURL ?>cover-16.jpg')
}
.whiteBox17{
	background-image:url('<?php echo $cndURL ?>cover-17.jpg')
}
.whiteBox18{
	background-image:url('<?php echo $cndURL ?>cover-18.jpg')
}
.whiteBox19{
	background-image:url('<?php echo $cndURL ?>cover-19.jpg')
}
.whiteBox20{
	background-image:url('<?php echo $cndURL ?>cover-20.jpg')
}
.whiteBox21{
	background-image:url('<?php echo $cndURL ?>cover-21.jpg')
}
.whiteBox22{
	background-image:url('<?php echo $cndURL ?>cover-22.jpg')
}
.whiteBox23{
	background-image:url('<?php echo $cndURL ?>cover-23.jpg')
}
.whiteBox24{
	background-image:url('<?php echo $cndURL ?>cover-01.jpg')
}

@page{size:630px 630px;margin:0;page-break-after:always}
@media print{
.no-print{display:none}
}
</style>
<div class="printBl">
	<div class="flipbook <?php echo $cGen.' '.$pGen; ?>">
<?php
$cGen = substr($cGen, 0, 3);
if($cGen == "boy"){
   $chi="he";
   $cha="his";
}else{
   $chi="she";
   $cha="her";
}
?>
        <div class="whiteBox1">
          <div class="border01">
            <p><span>Dear <span class="child"><?php echo $child_name ?></span>,</span> Life is full of joy and wonder. May you find the sweetness in everything, my little ladoo! </p>
          </div>
        </div>
        <div class="whiteBox2">
          <div class="border01">
            <p>Unable to sleep, little <span class="child"><?php echo $child_name ?></span> lay tossing around in bed one night.</p>
          </div>
			<img class="childImg" src="<?php echo $cndURL.''.$childTone; ?>_p02.png" alt="<?php echo $child_name; ?>">
        </div>
        <div class="whiteBox3">
          <div class="border01">
            <p>
              <span>With a tickle in <span class="cHin"><?php echo $cha ?></span> nose and a smile on <span class="cHin"><?php echo $cha ?></span> face, <span class="cGen"><?php echo $chi ?></span> woke up to something delicious in the air.</span>
              <span>Would today be the day <span class="cHin"><?php echo $cha ?></span> sweet dreams came true?</span>
            </p>
          </div>
			<img class="childImg" src="<?php echo $cndURL.''.$childTone; ?>_p03.png" alt="<?php echo $child_name; ?>">
        </div>
        <div class="whiteBox4">
          <div class="border01">
            <p><span class="child"><?php echo $child_name ?></span> jumped out of bed and tippy toe’d down the stairs.</p>
          </div>
			<img class="childImg" src="<?php echo $cndURL.''.$childTone; ?>_p04.png" alt="<?php echo $child_name; ?>">
        </div>
        <div class="whiteBox5">
          <div class="border01">
            <p><span><span class="cGen"><?php echo $chi ?></span> followed the smell all the way into the kitchen to find…</span></p>
          </div>
			<img class="childImg" src="<?php echo $cndURL.''.$childTone; ?>_p05.png" alt="<?php echo $child_name; ?>">
        </div>
        <div class="whiteBox6">
          <div class="border01">
            <p>...<span class="parent"><?php echo $parent_name ?></span></p>
          </div>
			<img class="parentImg" src="<?php echo $cndURL.''.$parentTone; ?>_p06.png" alt="<?php echo $parent_name; ?>">
        </div>
        <div class="whiteBox7">
          <div class="border01">
            <p>
              <span>After a big hug and a tight squeeze, <span class="child"><?php echo $child_name ?></span> asked, “What are you making, <span class="parent"><?php echo $parent_name ?></span>?”<br>
                “I’m making my favorite Indian dessert!” said <span class="parent"><?php echo $parent_name ?></span>. Would you like to help me?”</span>
              “I’d love to!” <br> <span class="child"><?php echo $child_name ?></span> replied.
            </p>
          </div>
			<img class="childImg" src="<?php echo $cndURL.''.$childTone; ?>_p07.png" alt="<?php echo $child_name; ?>">
			<img class="parentImg" src="<?php echo $cndURL.''.$parentTone; ?>_p07.png" alt="<?php echo $parent_name; ?>">
        </div>
        <div class="whiteBox8">
          <div class="border01">
            <p>
              <span><span class="parent"><?php echo $parent_name ?></span> and <span class="child"><?php echo $child_name ?></span> put on their matching aprons and tied them up tightly.</span>
              <span>“Today will be the day we make ladoos!” exclaimed <span class="parent"><?php echo $parent_name ?></span>.</span>
            </p>
          </div>
			<img class="parentImg" src="<?php echo $cndURL.''.$parentTone; ?>_p08.png" alt="<?php echo $parent_name; ?>">
        </div>
        <div class="whiteBox9">
          <div class="border01">
            <p><span>“What is that?” <span class="child"><?php echo $child_name ?></span> asked, as <span class="cGen"><?php echo $chi ?></span> pointed to the stove.<br> “That is called ghee, little <span class="child"><?php echo $child_name ?></span>.
              Ghee is made of melted butter, and it is used to cook traditional Indian dishes”, said <span class="parent"> <?php echo $parent_name ?> </span>.<br>  “We’ll need a few more ingredients to make this dessert,
              so let us gather them from the pantry. This next step is for you, my super helper!”</span></p>
          </div>
			<img class="childImg" src="<?php echo $cndURL.''.$childTone; ?>_p09.png" alt="<?php echo $child_name; ?>">
			<img class="parentImg" src="<?php echo $cndURL.''.$parentTone; ?>_p09.png" alt="<?php echo $parent_name; ?>">
        </div>
        <div class="whiteBox10">
          <div class="border01">
            <p>
              <span>Can you find the besan flour?</span>
              Can you find the pistachios?
            </p>
          </div>
        </div>
        <div class="whiteBox11">
          <div class="border01">
            <p class="one">Can you find the cardamom powder? <br> Can you find the powdered sugar? <br> Can you find the raisins?</p>
            <p class="two"> With all the ingredients gathered on the table, <span class="parent"><?php echo $parent_name ?></span> and <span class="child"><?php echo $child_name ?></span> began to prepare the mixture.</p>
          </div>
        </div>
        <div class="whiteBox12">
          <div class="border01">
            <p class="one">
              <span>“In goes the<br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; besan flour.”</span>
              <span>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Stir.<br>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Stir.<br>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Stir.
              </span>
            </p>
            <p class="two">
              <span>
                “Next goes<br>
                the ghee.”
              </span>
              <span>
                Stir.<br>
                Stir.<br>
                &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Stir.
              </span>
            </p>
          </div>
        </div>
        <div class="whiteBox13">
          <div class="border01">
            <p>
              <span>“Will I ever be able to stir as fast as you?” <span class="child"><?php echo $child_name ?></span> asked. “Working the mixture takes a lot of strength,” said <span class="parent"><?php echo $parent_name ?></span>,
                “and you are the strongest little ladoo I know.”</span>
              <span><span class="child"><?php echo $child_name ?></span> and <span class="parent"><?php echo $parent_name ?></span> continued stirring the mixture until it became golden brown.</span>
            </p>
          </div>
			<img class="childImg" src="<?php echo $cndURL.''.$childTone; ?>_p13.png" alt="<?php echo $child_name; ?>">
			<img class="parentImg" src="<?php echo $cndURL.''.$parentTone; ?>_p13.png" alt="<?php echo $parent_name; ?>">
        </div>
        <div class="whiteBox14">
          <div class="border01">
            <p class="one">“Are we ready to roll the ladoos?” <span class="child"><?php echo $child_name ?></span> asked.</p>
            <p class="two">“Not yet,” said <span class="parent"><?php echo $parent_name ?></span>. “We need to wait a few minutes for the mixture to cool.</p>
            <p class="three">Waiting will not be easy, but patience is our secret ingredient, and the key to success!”</p>
          </div>
        </div>
        <div class="whiteBox15">
          <div class="border01">
            <p>
              <span>“In the meantime, let’s wipe all that flour off your face, <span class="child"><?php echo $child_name ?></span>.”</span>
              <span>Hey, how did that get there?</span>
            </p>
          </div>
			<img class="childImg" src="<?php echo $cndURL.''.$childTone; ?>_p15.png" alt="<?php echo $child_name; ?>">
			<img class="parentImg" src="<?php echo $cndURL.''.$parentTone; ?>_p15.png" alt="<?php echo $parent_name; ?>">
        </div>
        <div class="whiteBox16">
          <div class="border01">
            <p class="one">“In goes the sugar and the cardamom powder.”</p>
            <p class="two">“Next goes the pistachios, and the raisins.”</p>
            <p class="three">“Are we all done?” <span class="child"><?php echo $child_name ?></span> asked.<br> “Almost!” replied <span class="parent"><?php echo $parent_name ?></span>. “We’re missing the most important ingredient of all—</p>
          </div>
        </div>
        <div class="whiteBox17">
          <div class="border01">
            <p>Together <span class="child"><?php echo $child_name ?></span> and <span class="parent"><?php echo $parent_name ?></span> put their Love into the pot.</p>
          </div>
			<img class="childImg" src="<?php echo $cndURL.''.$childTone; ?>_p17.png" alt="<?php echo $child_name; ?>">
			<img class="parentImg" src="<?php echo $cndURL.''.$parentTone; ?>_p17.png" alt="<?php echo $parent_name; ?>">
        </div>
        <div class="whiteBox18">
          <div class="border01">
            <p>“Now, let’s<br> race to see<br> who can make<br> the most ladoos!”<br> shouted <span class="child"><?php echo $child_name ?></span>.<br> “Okay!” said <span class="parent"><?php echo $parent_name ?></span>.</p>
          </div>
			<img class="parentImg" src="<?php echo $cndURL.''.$parentTone; ?>_p18.png" alt="<?php echo $parent_name; ?>">
        </div>
        <div class="whiteBox19">
          <div class="border01">
            <p class="one">
              <span>“Ready? Set? GO!”</span>
              <span>
                Roll.<br>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Roll.<br>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Roll.
              </span>
            </p>
            <p class="two">
              <span>“Great job, <span class="child"><?php echo $child_name ?></span>! You’ve been my most speedy helper yet, and I couldn’t have done it without you!</span>
              <span>Now, our last and final step is to set the ladoos out on a<br> plate, so that the entire family can enjoy them.”</span>
            </p>
          </div>
			<img class="childImg" src="<?php echo $cndURL.''.$childTone; ?>_p19.png" alt="<?php echo $child_name; ?>">
        </div>
        <div class="whiteBox20">
          <div class="border01">
            <p class="one">I wonder how they taste.<br> Before <span class="parent"><?php echo $parent_name ?></span> could even reach for the plate, <span class="child"><?php echo $child_name ?></span> shouted...</p>
            <p class="two">...“Try this one!” <span class="cGen"><?php echo $chi ?></span> handed <span class="parent"><?php echo $parent_name ?></span> a special ladoo that looked like no other.</p>
          </div>
			<img class="childImg" src="<?php echo $cndURL.''.$childTone; ?>_p20.png" alt="<?php echo $child_name; ?>">
			<img class="parentImg" src="<?php echo $cndURL.''.$parentTone; ?>_p20.png" alt="<?php echo $parent_name; ?>">
        </div>
        <div class="whiteBox21">
          <div class="border01">
            <p>
              <span>“Why, <span class="child"><?php echo $child_name ?></span>! What a surprise! This one has a cashew on it!</span>
              <span>Mmmmm… this is the best ladoo I’ve ever had! How in the world did you make it taste so good?” <span class="parent"><?php echo $parent_name ?></span> asked.</span>
            </p>
          </div>
			<img class="childImg" src="<?php echo $cndURL.''.$childTone; ?>_p21.png" alt="<?php echo $child_name; ?>">
			<img class="parentImg" src="<?php echo $cndURL.''.$parentTone; ?>_p21.png" alt="<?php echo $parent_name; ?>">
        </div>
        <div class="whiteBox22">
          <div class="border01">
            <p>
              <span>“It was simple, <span class="parent"><?php echo $parent_name ?></span>”, <span class="child"><?php echo $child_name ?></span> replied.</span>
              <span>—“With strength, patience, and a whole lot of love.”</span>
            </p>
          </div>
        </div>
        <div class="whiteBox23">
          <div class="border01">
          </div>
			<img class="childImg" src="<?php echo $cndURL.''.$childTone; ?>_p23.png" alt="<?php echo $child_name; ?>">
			<img class="parentImg" src="<?php echo $cndURL.''.$parentTone; ?>_p23.png" alt="<?php echo $parent_name; ?>">
        </div>
        <div class="whiteBox24">
          <div class="border01">
            <p><span>Copyright © 2020</span> All rights reserved. No part of this book may be reproduced in any form or by any electronic or mechanical means, including information storage and retrieval systems, without permission
              in writing from the publisher, except by reviewers, who may quote brief passages in a review.<br><br> Cataloging in Publication Data<br><br> Written by Nupur Vagale<br> Edited by Odetta King<br>Illustrations by Evgeniya Parkina</p>
          </div>
        </div>
    </div>
</div>