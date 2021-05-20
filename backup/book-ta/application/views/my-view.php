<?php $site_url = "http://dev.technology-architects.com/unicorns/unicorns/unicorns/new/book-ta/assets/" ?>
<!doctype html>
<html>
<head>
<title>:: PDF File Preview ::</title>
<link rel="stylesheet" href="<?php echo $site_url ?>style.css">
</head>
<body>
	<div class="flipbook characterS">
    <?php
	$hair_real_image;
	$hair;
	if($hair_class == "Cornrow"){
		$hair = "cornrow";
	}
	
	if($hair_class == "LongBraidsDown"){
		$hair = "longBraidsDown";
	}
	
	if($hair_class == "LongPonytail"){
		$hair = "longPonytail";
	}
	
	if($hair_class == "MedAfro"){
		$hair = "medAfro";
	}
	
	if($hair_class == "MedCurlyPomsDown"){
		$hair = "medCurlyPomsDown";
	}
	
	if($hair_class == "MedCurlyPomsDown2"){
		$hair = "medPigtail";
	}
	
	if($hair_class == "MedPuffsUp"){
		$hair = "medPuffsUp";
	}
	
	if($hair_class == "MedSpikeyHair"){
		$hair = "medSpikey";
	}
	
	if($hair_class == "ShortCurlyHair"){
		$hair = "shortCurlyHair";
	}
	
	if($hair_class == "Shorthair"){
		$hair = "shortHair";
	}
	
	if($hair_class == "Shorthairwavy"){
		$hair = "shortHairWavy";
	}
	
	if($hair_class == "MedSpikeyHair2"){
		$hair = "shortSpikeyHair";
	}
	
	
	if (strpos($hair_image, 'Black') !== false){
		$hair_real_image  = $site_url.'images/elements/hair/'.$hair.'/black.png';
	}
	
	if (strpos($hair_image, 'DarkBrown') !== false){
		$hair_real_image  = $site_url.'images/elements/hair/'.$hair.'/dkBrown.png';
	}
	
	if (strpos($hair_image, 'MedBrown') !== false){
		$hair_real_image  = $site_url.'images/elements/hair/'.$hair.'/medBrown.png';
	}
	
	if (strpos($hair_image, 'LightBrown') !== false){
		$hair_real_image  = $site_url.'images/elements/hair/'.$hair.'/ltBrown.png';
	}
	
	if (strpos($hair_image, 'HairBlond') !== false){
		$hair_real_image  = $site_url.'images/elements/hair/'.$hair.'/blond.png';
	}
	
	if (strpos($hair_image, 'Red') !== false){
		$hair_real_image  = $site_url.'images/elements/hair/'.$hair.'/red.png';
	}
	
	if (strpos($hair_image, 'Pink') !== false){
		$hair_real_image  = $site_url.'images/elements/hair/'.$hair.'/pink.png';
	}
	if($body_attribute == 0){
		$character = "character1.png";
	}
	
	if($body_attribute == 1){
		$character = "character2.png";
	}
	
	if($body_attribute == 2){
		$character = "character3.png";
	}
	
	if($body_attribute == 3){
		$character = "character4.png";
	}
	
	if($body_attribute == 4){
		$character = "character5.png";
	}
	
	if($body_attribute == 5){ 
		$character = "character6.png";
	}
	
	
	if($body_type == "full_body") {
		$body_class = "sCharacter";
		$airship_body = $site_url.'images/airship/sCharacter/'.$character;
		$basketballbody = $site_url.'images/basketball/sCharacter/'.$character;
		$Campingbody = $site_url.'images/camping/sCharacter/'.$character;
		$Superherobody =  $site_url.'images/superhero/sCharacter/'.$character;
		$Flowersbody = $site_url.'images/flowers/sCharacter/'.$character;
		$Crossroadsbody = $site_url.'images/crossroads/sCharacter/'.$character;
		$Musicbody = $site_url.'images/music/sCharacter/'.$character;
		$Piratesbody = $site_url.'images/pirates/sCharacter/'.$character;
	} else {
		$body_class = "wCharacter";
		$airship_body = $site_url.'images/airship/wCharacter/'.$character;
		$basketballbody = $site_url.'images/basketball/wCharacter/'.$character;
		$Campingbody = $site_url.'images/camping/wCharacter/'.$character;
		$Superherobody =  $site_url.'images/superhero/wCharacter/'.$character;
		$Flowersbody = $site_url.'images/flowers/wCharacter/'.$character;
		$Crossroadsbody = $site_url.'images/crossroads/wCharacter/'.$character;
		$Musicbody = $site_url.'images/music/wCharacter/'.$character;
		$Piratesbody = $site_url.'images/pirates/wCharacter/'.$character;
	}
	/************ Type of Eye ******************** Eye image is eye color */
	if($eye_val == 0) {
		$eyesfolder = 'NoLashes';
	} else {
		$eyesfolder = 'Lashes';
	}
	if($eye_image == 0) {
		$eyeimg = "blue.png";
	}
	if($eye_image == 1) {
		$eyeimg = "brown.png";
	}
	if($eye_image == 2) {
		$eyeimg = "green.png";
	}
	if($eye_image == 3) {
		$eyeimg = "grey.png";
	}
	
	if($eye_image == 4) {
		$eyeimg = "hazel.png";
	}
	
	/************************* Glasses *******************/
	
	if($glass_image == 10) {
		?>
        <style> .eyesElement{display:none !important;} </style>
        <?php
	} else {
		if($glass_image == 1){
			$glass_img = $site_url.'images/elements/glasses/01/black.png';
		}
		if($glass_image == 2){
			$glass_img = $site_url.'images/elements/glasses/01/purple.png';
		}
		if($glass_image == 3){
			$glass_img = $site_url.'images/elements/glasses/01/rainbow.png';
		}
		if($glass_image == 4){
			$glass_img = $site_url.'images/elements/glasses/01/red.png';
		}
		
	}
	
	?>
	<?php
		$Airship = '<div class="page-wrapper airship">
			<div class="txt_content">
				<p>Over a sea of land<br>Over rough rocks and fine sand<br>With the birds in the sky<br><span class="name">'.$childname.'</span> soars so high!</p>
				<p>Above the infinite ocean<br>Life moves below in slow motion<br>We explore side by side<br>On adventures far and wide.</p>
				<p>We soar higher and higher<br>Its so fun, we never tire!<br>Watch us flip and dip<br>On our magical airship.</p>
			</div>
			<img src="'.$site_url.'images/airship/airship-ship.png" alt="" class="airshipImg">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$airship_body.'" alt="" class="'.$body_class.'">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';

		?>

<?php
		$Basketball = '<div class="page-wrapper basketball">
			<div class="txt_content">
				<p>On the basketball court<br><span class="name">'.$childname.'</span> worries disappear<br>Present and breathing deeply<br>We let go of any fear</p>
				<p>The game becomes our focus<br>We concentrate on play<br>What may have happened earlier<br>Simply fades away</p>
				<p>Move, <span class="name">'.$childname.'</span><br>Bounce, <span class="name">'.$childname.'</span><br>Go on. Fake a fall<br>Here is your chance.<br>To slam dunk the ball!</p>
			</div>
			<img src="'.$basketballbody.'" alt="" class="'.$body_class.'">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';
?>

<?php

	$Camping = '<div class="page-wrapper camping">
			<div class="txt_content">
				<p><span class="name">'.$childname.'</span> imagines toasting marshmallows<br>And the cool breeze tickling their face<br>Laughter is so contagious<br>At this amazing place</p>
				<p><span class="name">'.$childname.'</span> watches flames kiss the air<br>Mesmerized by the campfire<br>Being surrounded by loved ones<br>Special time we so desire</p>
				<p>After dark we tell funny stories<br>And sing ridiculous songs<br>Laughter is so healing<br>Come on, sing along</p>
			</div>
			<img src="'.$Campingbody.'" alt="" class="'.$body_class.'">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';
?>

<?php
	$Superhero = '<div class="page-wrapper superhero">
			<div class="txt_content">
				<p><span class="name">'.$childname.'</span> imagines being  a superhero!</p>
				<p>Superheroes are strong,<br>Superheroes are clever,<br>Superheroes make a difference,<br>Without thinking twice, ever.</p>
				<p>Sometimes <span class="name">'.$childname.'</span> wonders,<br>Could I be a superhero too?<br>But Ill have to ask my friends,<br>What superheroes actually do.</p>
				<p>It turns out superheroes,<br>Are often out and about,<br>Racing off to lend a hand,<br>Trying to help out.</p>
			</div>
			<img src="'.$Superherobody.'" alt="" class="'.$body_class.'">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';
?>

<?php
	$Flowers = '<div class="page-wrapper flowers">
			<div class="txt_content">
				<p class="text1">Life can be challenging,<br>Sometimes you can feel sad.<br>Take a look outside your home<br>And maybe nature can help just a tad.</p>
				<p class="text2"><span class="name">'.$childname.'</span>, look over here!<br>Flowers of red, blue, pink and yellow,<br>They open just for you each day,<br>As if to say hello!</p>
				<div class="clear"></div>
				<p class="text1">See the clouds and the wind,<br>And the blue, sunny skies,<br>Beauty is everywhere,<br>When we focus our eyes.</p>
			</div>
			<img src="'.$Flowersbody.'" alt="" class="'.$body_class.'">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';
?>

<?php
	$Crossroads = '<div class="page-wrapper crossroads">
			<div class="txt_content">
				<p><span class="name">'.$childname.'</span> adventure takes them to a crossroad, a place in life where they need to make a difficult choice.</p>
				<p>When theres a tough decision<br>And <span class="name">'.$childname.'</span> doesnt know where to go<br>They take a deep breath in<br>And let it out real slow</p>
				<p><span class="name">'.$childname.'</span> has an inner compass<br>Which guides their wrong from right<br>It helps them make tough decisions<br>Its a guiding light</p>
				<p>But they must find some quiet<br>And must get really still<br>To hear the inner voice<br>Its a secret skill</p>
				<p>There are distractions and inner chatter<br><span class="name">'.$childname.'</span> trust their heart<br>Intuition can guide them<br>Right from the very start</p>
			</div>
			<img src="'.$Crossroadsbody.'" alt="" class="'.$body_class.'"> 
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';
?>
<?php

		$Dragon = '<div class="page-wrapper dragon">
			<div class="txt_content">
				<p>A dragon can seem like<br>A very scary thing<br>With their fire-breathing power<br>And their pointed tail and wings.</p>
				<p>But take a closer look <span class="name">'.$childname.'</span><br>Past their rough, scaly hide.<br>They arre not so very different<br>Deep down on the inside.</p>
				<p>With fiery courage and<br>Long graceful wings,<br>Dragons are wise,<br>With the knowledge they bring.</p>
				<p><span class="name">'.$childname.'</span> likes dragons because<br>They believe in what,s right,<br>They lead with their hearts,<br>As they take off in flight.</p>
			</div>
			<img src="'.$site_url.'images/dragon/character/'.$character.'" alt="" class="characterSkin">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';
?>

<?php
		$Music = '<div class="page-wrapper music">
			<div class="txt_content">
				<p>Theres a whole lot of music<br>To be found in the world<br>That brings <span class="name">'.$childname.'</span>s friends together<br>To toe-tap and twirl!</p>
				<p>Music can help you express<br>Lots of different feelings<br>Play it soft...PLAY IT LOUD<br>Til it bounces from the ceiling!</p>
				<p>Maybe you like to sing along,<br>Or hum if you dont know the words<br>Music is absolutely everywhere<br>Just waiting to be heard!</p>
			</div>
			<img src="'.$Musicbody.'" alt="" class="'.$body_class.'">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
			<img src="'.$site_url.'images/music/sMic.png" alt="" class="sMic">
		</div>';
?>

<?php
		$Playground = '<div class="page-wrapper playground">
			<div class="txt_content">
				<div class="text1">
					<p><span class="name">'.$childname.'</span> hops in the saucer -<br>Spins around and around,<br>With friends they are feeling free,<br><span class="name">'.$childname.'</span> loves the playground!</p>
				</div>
				<div class="clear"></div>
				<div class="text2">
					<p>We make the park a safe space<br>For all to laugh, sing, and play<br>We treat each other with respect<br>So we can stay and play all day</p>
				</div>
			</div>
			<img src="'.$site_url.'images/playground/character/'.$character.'" alt="" class="characterSkin">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';
?>		

<?php
		$Space = '<div class="page-wrapper space">
			<div class="txt_content">
				<p>Twinkle, twinkle, deep, dark sky<br>How <span class="name">'.$childname.'</span> loves being up so high!<br>Looking down on Earth below<br>Thinking about all that <span class="pronounce"></span> know</p>
				<p>What adventures are in store?<br>With imagination we open a door<br>A door to adventure up in space<br>Exploring in this expansive place<br></p>
				<p>Space is impressive, its so big and vast<br>Zooming around, we are having a blast<br>What will our next adventure be?<br>We create it - on one, two, three!</p>
			</div>
			<img src="'.$site_url.'images/space/character/'.$character.'" alt="" class="characterSkin">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';
?>		

<?php
		$Bedtime = '<div class="page-wrapper bedtime">
			<div class="txt_content">
				<p><span class="name">'.$childname.'</span> gets excited<br>Its time to listen and look<br>At all the exciting pictures<br>In their colorful adventure book</p>
				<p>We love to think of all<br>The things were grateful for<br>Like family and friends<br><span class="name">'.$childname.'</span> can you think of some more?</p>
				<p><span class="name">'.$childname.'</span> crawls into bed<br>Big hugs and kisses goodnight<br>Its time to slow our breathing<br>And close our eyes up tight</p>
            </div>
			<img src="'.$site_url.'images/bedtime/character/'.$character.'" alt="" class="characterSkin">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';
?>	

<?php	
	$Fishing = '<div class="page-wrapper fishing">
			<div class="txt_content">
				<div class="text1">
					<p>Early in the morning<br>before the sun comes up<br><span class="name">'.$childname.'</span> travels to the fishing boat<br>Worms in their cup.</p>
					<p>In the middle of the lake<br>They cast the line with bait<br>Then take in a deep breath of air<br>Watch the view and wait.</p>
				</div>
				<div class="text2">
					<p>Watching the bugs skate across<br>The surface of the water<br>Enjoying the twinkly ripples made<br>By the jiggle of the bobber.</p>
					<p><span class="name">'.$childname.'</span> loves being still in nature<br>They dont need to catch a fish<br>Its just like meditation<br>They close their eyes and make a wish.</p>
				</div>
			</div>
			<img src="'.$site_url.'images/fishing/character/'.$character.'" alt="" class="characterSkin">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';
?>		

<?php	
	$Mermaid = '<div class="page-wrapper mermaid">
			<div class="txt_content">
				<div class="text1">
					<p>When I am a mermaid<br>I feel happy and FREE<br>I am safe to just BE<br>I am free to be ME</p>
					<p><span class="name">'.$childname.'</span>is a mermaid<br>With a sparkly tail<br>Powerful and strong<br>The opposite of frail.</p>
				</div>
				<div class="text2">
					<p><span class="name">'.$childname.'</span> swims between<br>Schools of jellyfish,<br>Then takes a moment to<br>Make a special wish.</p>
					<p>A wish for a world<br>Filled with peace and love<br>To bring this peace from<br>The sea to up above!</p>
				</div>
			</div>
			<img src="'.$site_url.'images/mermaid/character/'.$character.'" alt="" class="characterSkin">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';
?>		
<?php		
	$Rainbows =	'<div class="page-wrapper rainbow">
			<div class="txt_content">
				<p><span class="name">'.$childname.'</span>, Come, lets take a ride,<br>On a magical rainbow slide,<br>To a special place where,<br>No one needs to hide.</p>
				<p>No matter who we love,<br>Or our color, religion, or gender,<br>We are embraced for our beauty,<br>We are proud of our splendour.</p>
				<p>For none of us are seen,<br>As less of than the other,<br>Our community has progressed,<br>To love one another.</p>
			</div>
			<img src="'.$site_url.'images/rainbow/character/'.$character.'" alt="" class="characterSkin">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';
?>		
<?php
	$Pirates =	'<div class="page-wrapper pirates">
			<div class="txt_content">
				<p>Through rain and through wind<br>Through rough and stormy sea<br><span class="name">'.$childname.'</span> sails and searches<br>For new discoveries.</p>
				<p>Finding adventure<br>Is so much fun, lets go!<br>The joy is in the journey<br>When one goes with the flow.</p>
				<p>But if <span class="name">'.$childname.'</span> sometimes<br>Feels a bit torn<br>Its time to take a deep breath in -<br>Breathe out and try once more.</p>
				<p><span class="name">'.$childname.'</span> knows there are lessons<br>We can always discern<br>If we ask our higher self<br>What were meant to learn.</p>
			</div>
			<img src="'.$Piratesbody.'" alt="" class="'.$body_class.'">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$site_url.'images/pirates/hat.png" alt="" class="hat">
		</div>';
?>

<?php
	$CountingStars =	'<div class="page-wrapper stillness">
			<div class="txt_content">
				<p><span class="name">'.$childname.'</span> matches their breath<br>To the crickets song<br>Its peaceful in the grass<br>Relaxing and humming along.</p>
				<p>Stars start to pop out<br><span class="name">'.$childname.'</span> counts them - one, two, three<br>But there are so many more<br>How many can you see?</p>
			</div>
			<img src="'.$site_url.'images/stillness/character/'.$character.'" alt="" class="characterSkin">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';
?>

<?php
		$Unicorn =	'<div class="page-wrapper unicorn">
			<div class="txt_content">
				<p>A unicorn soaks up energy<br>From the tip of their horn<br>And their love grows bigger<br>Every time a baby is born!</p>
				<p>A baby unicorn is called<br>A sparkle did you know?<br>Their horns are called alicorns<br>And at nighttime, watch them glow!</p>
				<p>Use your imagination <span class="name">'.$childname.'</span><br>And dream while you sleep<br>Whisper all of your wishes<br>And your secrets they shall keep!</p>
			</div>
			<img src="'.$site_url.'images/unicorn/character/'.$character.'" alt="" class="characterSkin">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';
?>
<?php		
	$Wheels = '<div class="page-wrapper wheels">
			<div class="txt_content">
				<p>Theres so many ways<br><span class="name">'.$childname.'</span> can get around<br>Two wheels, three wheels<br>Four wheels on the ground</p>
				<p>Bikes and scooters<br>Roller skates and cars,<br>Some children use wheelchairs,<br>That also takes them far.</p>
				<p>Having fun outside<br>Makes for a very excellent day,<br>Always include others -<br>Invite EVERYONE to play!</p>
			</div>
			<img src="'.$site_url.'images/wheels/character/'.$character.'" alt="" class="characterSkin">
			<img src="'.$site_url.'images/elements/eyes/'.$eyesfolder.'/'.$eyeimg.'" alt="" class="faceSmile">
			<img src="'.$site_url.'images/elements/freckles.png" alt="" class="freckles">
			<img src="'.$glass_img.'" alt="" class="eyesElement">
			<img src="'.$hair_real_image.'" alt="" class="'.$hair.'">
		</div>';
?>		
<?php
	$story1 = $$story_1;
	$story2 = $$story_2;
	$story3 = $$story_3;
	$story4 = $$story_4;
	$story5 = $$story_5;
	$story6 = $$story_6;
	$story7 = $$story_7;
	$story8 = $$story_8;
	$story9 = $$story_9;
	$story10 = $$story_10;
	echo $story1.$story2.$story3.$story4.$story5.$story6.$story7.$story8.$story9.$story10;
?>


		
	</div>
</body>
</html>