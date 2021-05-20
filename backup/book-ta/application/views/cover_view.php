<!doctype html>
<html>
<head>
<?php
  $cndURL = 'https://cdn.shopify.com/s/files/1/0472/7606/4929/t/3/assets/';
  $childTone = '';
  $parentTone = '';
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
<style type="text/css">
@import url('assets/fonts/font.css');
*{margin:0;padding:0;}
body{font-size:12pt}
.flipbook{width:1404.32pt;margin:0 auto}
.flipbook>div{width:1321.22pt;height:665.53pt;padding:44.23pt 41.55pt 46.24pt 41.55pt;position:relative;background-size:1404.32pt 756pt;background-position:center center;background-repeat:no-repeat;page-break-after:always}
.flipbook>div .childImg{position:absolute;top:2.15em;left:56.586em;z-index:1}
.flipbook>div .parentImg{position:absolute;top:2.15em;left:55.2em;z-index:0}
.border01{position:relative}
.whiteBox1{
	background-image:url('<?php echo $cndURL ?>WeMakeLadoos_Cover1.jpg?v=17185072927287123265')
}
@page{size:1404.32pt 756pt;margin:0;page-break-after:always}
@media print{
.no-print{display:none}
}
</style>
</head>
<body><div class="printBl"><div class="flipbook"><div class="whiteBox1"><div class="border01">
<img class="childImg" src="<?php echo $cndURL.'main_'.$childTone; ?>.png?v=17185072927287123265" alt="<?php echo $child_name; ?>">
<img class="parentImg" src="<?php echo $cndURL.'main_'.$parentTone; ?>.png?v=17185072927287123265" alt="<?php echo $parent_name; ?>">
</div></div></div></div></body></html>