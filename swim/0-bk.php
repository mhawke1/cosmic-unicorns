<?php
	require_once 'settings.php';
	require_once 'swim.php';
	

	$SWIM['version']='1002572389';

	function pageSpreadsHtmlTest($childsPicture='',$pdfVersion=false,$pages=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,19,20,21],$childsPictureBackground='')
	{
		GLOBAL $SWIM;
$childPictureStyle='';
if($childsPicture==='')
{
$childPictureStyle='background-size:contain;background-position:center;background-image:url('.$childsPictureBackground.');background-repeat:no-repeat;';
}
		$pages=array_map('intval', $pages);

		if($childsPicture=='')$childsPicture='<img src="" class="lovenotechildspicture" style="width:100% !important;height:100%;"/>';

		$pageSeparator='';
$res='HiRes.png';  
$pdf=1; 
		if(!$pdfVersion)
		{
			$pdf=0;
			$pageSeparator='<div class="pageline"></div>';
			$res='LoRes.png';
		}

		

		

		$html='		<div id="characterpagesarea" style="position:relative">
<div style="background-color:#ff0000"></div>
<input type="hidden" id="pdf_id" value='.$pdf.'>

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
					<div style="width: 460px;"><span class="childsnameautofill"></span>\'s</div>
				</div>
			</div>' : '').'

'.(in_array(0,$pages) ? '<div id="page0area" class="pagearea page0area" style="width:960px;height:361px">
				<img class="pagebackground pagebackground0" id="pagebackground0" width="100%" src="i/pages/Book-Cover-Package/CoverSpread'.$res.'?v='.$SWIM['version'].'"/>
				<div id="page0textcontainer" class="pagetextcontainer page0textcontainer" style="height:0px;position:relative;width:0px;color:#0f75bc;font-family:Caveat, cursive;font-weight:bold">
					<div><span class="childsnameautofill"></span>\'s</div>
				</div>
				<div id="page0charactercontainer" class="pagecharactercontainer page0charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page0body" id="page0body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page0characterheadstuff" class="page0characterheadstuff" style="position:relative">
						<img class="pageyes page0eyes" id="page0eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page0hair" id="page0hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page0glasses" id="page0glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page0freckles" id="page0freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
				</div>
			</div>' : '').'


			'.(in_array(1,$pages) ? '<div id="page1area" class="page1area pagearea">
				<img class="pagebackground pagebackground1" id="pagebackground1" width="100%" src="i/pages/AirshipPackage/AirshipSpreadPrint'.$res.'"/>
				<div id="page1textcontainer" class="page1textcontainer pagetextcontainer" style="height:0px;position:relative;width:0px;color:#000">
					



						<div>Over a sea of land,</div>
						<div>Over rough rocks and fine sand -</div> 
						<div>With the birds in the sky,</div>
						<div><span class="childsnameautofill"></span> soars so high!</div>
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
					<img class="pagebody page1body" id="page1body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page1characterheadstuff" class="page1characterheadstuff" style="position:relative">
						<img class="pageyes page1eyes" id="page1eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page1hair" id="page1hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page1glasses" id="page1glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page1freckles" id="page1freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
					<img class="pageairship page1airship" id="page1airship" style="display:block;position:relative" src="i/pages/AirshipPackage/Ship.png" />
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(2,$pages) ? '<div id="page2area" class="pagearea page2area">
				<img class="pagebackground pagebackground2" id="pagebackground2" width="100%" src="i/pages/BasketballPACKAGE/BasketballSpread'.$res.'"/>
				<div id="page2textcontainer" class="pagetextcontainer page2textcontainer" style="height:0px;position:relative;width:0px;color:#000">

						

							<div>The squeak of the shoes,</div>
							<div>And the way that they move,</div>
							<div>And how the half-time music,</div>
							<div>Gets me into the groove.</div>
							<div>&nbsp;</div>
							<div><span class="childsnameautofill"></span>’s really good at this,</div>
							<div><span class="childsnameautofill"></span>’s swift, <span class="childsnameautofill"></span> swoops,</div>
							<div><span class="childsnameautofill"></span> steals the ball,</div>
							<div>And just loves to shoot some hoops!</div>
							<div>&nbsp;</div>
							<div>Move, <span class="childsnameautofill"></span>, bounce, <span class="childsnameautofill"></span>,</div>
							<div>Go on and fake a fall,</div>
							<div>Here it is, it’s your chance,</div>
							<div>To slam dunk the ball!</div>

				</div>
				<div id="page2charactercontainer" class="pagecharactercontainer page2charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page2body" id="page2body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page2characterheadstuff" class="page2characterheadstuff" style="position:relative">
						<img class="pageyes page2eyes" id="page2eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page2hair" id="page2hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page2glasses" id="page2glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page2freckles" id="page2freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(3,$pages) ? '<div id="page3area" class="pagearea page3area" style="overflow:hidden">
				<img class="pagebackground pagebackground3" id="pagebackground3" width="100%" src="i/pages/Bedtime-SpreadPACKAGE/BedtimeSpread'.$res.'?v='.$SWIM['version'].'"/>
				<div id="page3textcontainer" class="pagetextcontainer page3textcontainer" style="text-align: left;height:0px;position:relative;width:0px;color:#fff">
				

								<div><span class="childsnameautofill"></span> prepares for bed,</div>
								<div style="position:relative">With a simple routine,</div>
								<div style="position:relative">First pajamas, then their teeth,</div>
								<div style="position:relative">Brushing till they’re super clean!</div>
								
								<div style="position:relative;top:20px;">Next is <span class="childsnameautofill"></span>’s favorite part,</div>
								<div style="position:relative;top:20px;">It’s time to listen and to look,</div>
								<div style="position:relative;top:20px;">At all the pretty pictures,</div>
								<div style="position:relative;top:20px;"> In their storybook.</div>


								<div style="position:relative;top:30px;">Then it’s good to think of all,</div>
								<div style="position:relative;top:30px;">The things we’re grateful for,</div>
								<div style="position:relative;top:30px;">Our family and our friends,</div>
								<div style="position:relative;top:30px;">And so, so much more!</div>

								



								
								
								<div style="position:relative;top:20px;"><span class="childsnameautofill"></span> crawls into bed,</div>
								<div style="position:relative;top:20px;">Big hugs and kisses goodnight!</div>
								<div style="position:relative;top:20px;>It’s time to slow our breathing,</div>
								<div style="position:relative;top:20px;">And close our eyes up tight.</div>

				</div>
				<div id="page3charactercontainer" class="pagecharactercontainer page3charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page3body" id="page3body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page3characterheadstuff" class="page3characterheadstuff" style="position:relative">
						<img class="pageyes page3eyes" id="page3eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page3hair" id="page3hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page3glasses" id="page3glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page3freckles" id="page3freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(4,$pages) ? '<div id="page4area" class="pagearea page4area" style="overflow:hidden">
				<img class="pagebackground pagebackground4" id="pagebackground4" width="100%" src="i/pages/CampingPackage/CampingSpread'.$res.'"/>
				<div id="page4textcontainer" class="pagetextcontainer page4textcontainer" style="height:0px;position:relative;width:0px;color:#000;text-align:right">
						<div>Flames flicker in the air,</div>
						<div>We’re mesmerized by the fire,</div>
						<div>We love spending time with <span class="childsnameautofill"></span>,</div>
						<div>A child we so admire.</div>
						<div>&nbsp;</div>
						<div>Toasting sweet marshmallows,</div>
						<div>A cool breeze tickles our face,</div>
						<div>Laughter is so contagious,</div>
						<div>At our favorite place!</div>
						<div>&nbsp;</div>
						<div>We tell funny stories,</div>
						<div>And sing ridiculous songs,</div>
						<div>Laughter is so healing,</div>
						<div>Come on, sing along!</div>

				</div>
				<div id="page4charactercontainer" class="pagecharactercontainer page4charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page4body" id="page4body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page4characterheadstuff" class="page4characterheadstuff" style="position:relative">
						<img class="pageyes page4eyes" id="page4eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page4hair" id="page4hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page4glasses" id="page4glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page4freckles" id="page4freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(5,$pages) ? '<div id="page5area" class="pagearea page5area" style="overflow:hidden">
				<img class="pagebackground pagebackground5" id="pagebackground5" width="100%" src="i/pages/ComicBookPACKAGE/ComicBookSprea'.$res.'?v='.$SWIM['version'].'"/>
				<div id="page5textcontainer" class="pagetextcontainer page5textcontainer" style="height:0px;position:relative;width:0px;color:#fff;text-align:right">



					<div>Superheroes are strong,</div>
					<div>Superheroes are clever,</div>
					<div>Superheros make a difference,</div>
					<div>Without thinking twice, ever.</div>
					<div>&nbsp;</div>
					<div>Sometimes <span class="childsnameautofill"></span> wonders,</div>
					<div>Could I be a superhero too?</div>
					<div>But I’ll have to ask my friends,</div>
					<div>What superheroes actually do.</div>
					<div>&nbsp;</div>
					<div>It turns out superheroes, </div>
					<div>Are always out and about,</div>
					<div>Racing off to lend a hand,</div>
					<div>Their main job is to help out.</div>


				</div>
				<div id="page5charactercontainer" class="pagecharactercontainer page5charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page5body" id="page5body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page5characterheadstuff" class="page5characterheadstuff" style="position:relative">
						<img class="pageyes page5eyes" id="page5eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page5hair" id="page5hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page5glasses" id="page5glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page5freckles" id="page5freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
						<img class="pagemask page5mask" id="page5mask" style="display:block;position:relative" src="i/pages/ComicBookPACKAGE/FaceMask.png" />
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(6,$pages) ? '<div id="page6area" class="pagearea page6area">
				<img class="pagebackground pagebackground6" id="pagebackground6" width="100%" src="i/pages/CrossroadsPACKAGE/CrossroadsSpread'.$res.'?v='.$SWIM['version'].'"/>
				<div id="page6textcontainer" class="pagetextcontainer page6textcontainer" style="height:0px;position:relative;width:0px;color:#000">
					

							<div class="first" style="position:relative;">
							<div>When there’s a tough decision,</div>
							<div>And <span class="childsnameautofill"></span> doesn’t know which way to go, </div>
							<div><span class="childsnameautofill"></span> is smart and takes a deep breath,</div> 
							<div>Then lets it out real slow.</div>
							<div>We all have an inner compass,</div>
							<div>Which guides our wrong from right,</div>
							<div>It tells us which way to go,</div>
							<div>It’s like a guiding light.</div>	
							<div>&nbsp;</div>							
							<div>But we must find some quiet,</div>
							<div>We must get really still,</div>
							<div>To hear the voice that knows inside -</div>
							<div>It’s our secret skill.</div> 
							<div>There are distractions and inner chatter,</div>
							<div>We must fight and trust our heart,</div>
							<div>Our intuition can guide us,</div>
							<div>Right from the very start.</div>


							</div>



				</div>
				<div id="page6charactercontainer" class="pagecharactercontainer page6charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page6body" id="page6body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page6characterheadstuff" class="page6characterheadstuff" style="position:relative">
						<img class="pageyes page6eyes" id="page6eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page6hair" id="page6hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page6glasses" id="page6glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page6freckles" id="page6freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(7,$pages) ? '<div id="page7area" class="pagearea page7area" style="overflow:hidden">
				<img class="pagebackground pagebackground7" id="pagebackground7" width="100%" src="i/pages/DragonPACKAGE/DragonSpread'.$res.'"/>
				<div id="page7textcontainer" class="pagetextcontainer page7textcontainer" style="height:0px;position:relative;width:0px;color:#000">
					

							<div>With fiery courage and </div>
							<div>Long graceful wings,</div>
							<div>Dragons are wise,</div>
							<div>With the knowledge they bring.</div>
							<div>&nbsp;</div>
							<div><span class="childsnameautofill"></span> loves dragons because</div>
							<div>They believe in what’s right,</div>
							<div>They lead with their hearts,</div>
							<div>As they take off in flight.</div>



				</div>
				<div id="page7charactercontainer" class="pagecharactercontainer page7charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page7body" id="page7body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page7characterheadstuff" class="page7characterheadstuff" style="position:relative">
						<img class="pageyes page7eyes" id="page7eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page7hair" id="page7hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page7glasses" id="page7glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page7freckles" id="page7freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(8,$pages) ? '<div id="page8area" class="pagearea page8area">
				<img class="pagebackground pagebackground8" id="pagebackground8" width="100%" src="i/pages/FishingPackage/FishingSpread'.$res.'"/>
				<div id="page8textcontainer" class="pagetextcontainer page8textcontainer" style="height:0px;position:relative;width:0px;color:#fff;font-size:12px !important;">
					


			<div class="first" style="position:relative">
										
					<div>Early in the morning,</div>
					<div>before the sun comes up,</div>
					<div>I travel to my fishing boat,</div>
					<div>With some worms in my cup.</div>
					<div>&nbsp;</div>
					<div>In the middle of the lake,</div>
					<div>I cast my line with bait,</div>
					<div>Then take in a deep breath of air,</div>
					<div>Watch the view and wait.</div>
			</div>
			<div class="second" style="position:relative">
					<div>I watch the bugs skate across,</div>
					<div>The surface of the water,</div>
					<div>I enjoy the twinkly ripples made</div>
					<div>By the jiggle of the bobber.</div>
					<div>&nbsp;</div>
					<div>I love being still in nature,</div>
					<div>I don’t need to catch a fish,</div>
					<div>It’s just like meditation,</div>
					<div>I’ll close my eyes and make a wish.</div>
			</div>










				</div>
				<div id="page8charactercontainer" class="pagecharactercontainer page8charactercontainer" style="height:0px;width:0px;position:relative">
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(9,$pages) ? '<div id="page9area" class="pagearea page9area">
				<img class="pagebackground pagebackground9" id="pagebackground9" width="100%" src="i/pages/MermaidPACKAGE/MermaidSpread'.$res.'"/>
					<div id="page9textcontainer" class="pagetextcontainer page9textcontainer" style="height:0px;position:relative;width:0px;color:#fff">

				
				<div class="first" style="position:relative">
				<div>When I’m under the sea,</div>
				<div>I feel so, so free. </div>
				<div>I’m free to just BE, </div>
				<div>I’m free to be ME!</div>
				<div>&nbsp;</div>
				<div><span class="childsnameautofill"></span> is a mermaid,</div>
				<div>With a sparkly tail,</div>
				<div>Beautiful and strong,</div>
				<div>The opposite of frail.</div>
				</div>
				<div class="second" style="position:relative">
				<div><span class="childsnameautofill"></span> swims between,</div>
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
					<img class="pagebody page9body" id="page9body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page9characterheadstuff" class="page9characterheadstuff" style="position:relative">
						<img class="pageyes page9eyes" id="page9eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page9hair" id="page9hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page9glasses" id="page9glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page9freckles" id="page9freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
						
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(10,$pages) ? '<div id="page10area" class="pagearea page10area">
				<img class="pagebackground pagebackground10" id="pagebackground10" width="100%" src="i/pages/MusicSpreadPACKAGE/MusicSpread'.$res.'" />
				<div id="page10textcontainer" class="pagetextcontainer page10textcontainer" style="height:0px;position:relative;width:0px;color:#fff">
				



				<div class="first" style="position:relative">
				<div>Through different types of music, </div>
				<div><span class="childsnameautofill"></span> and their friends come alive,</div>
				<div>All the cells in their bodies,</div>
				<div>Connect through dance and thrive!</div>
				</div>
				<div class="second" style="position:relative">
				<div>Music creates a space to be safe,</div>
				<div>To express a different feeling,</div>
				<div>Happy, sad, excited or mad,</div>
				<div>We can relate, and it’s so healing.</div>
				</div>

				<div class="third" style="position:relative">
				<div>Through music <span class="childsnameautofill"></span> and their friends,</div>
				<div>Are present in the moment now,</div>
				<div>Grooving their bodies and their souls,</div>
				<div>The rhythm of the music shows them how!</div>
				</div>

				</div>
				<div id="page10charactercontainer" class="pagecharactercontainer page10charactercontainer" style="height:0px;width:0px;position:relative">

					

					<img class="pagebody page10body" id="page10body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />

						


					<div id="page10characterheadstuff" class="page10characterheadstuff" style="position:relative">
						<img class="pageyes page10eyes" id="page10eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page10hair" id="page10hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page10glasses" id="page10glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page10freckles" id="page10freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />

						'.((!$pdfVersion) ?'
			<img class="pagemicro page10micro" id="page10micro" data-pdf="0" src="i/pages/MusicSpreadPACKAGE/MusicBody-Standing-Microphone-01.png?v=1564062346" />':
			'<img class="pagemicro selectfirstfmicroimage" id="selectfirstimage" data-pdf="1" style=" display: block;
    position: relative;  src="i/pages/MusicSpreadPACKAGE/MusicBody-Standing-Microphone-01.png?v=1564062346" />').'
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(11,$pages) ? '<div id="page11area" class="pagearea page11area" style="overflow:hidden">
				<img class="pagebackground pagebackground11" id="pagebackground11" width="100%" src="i/pages/PaintingPACKAGE/PaintingSpread'.$res.'" />
				<div id="page11charactercontainer" class="pagecharactercontainer page11charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page11body" id="page11body" style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page11characterheadstuff" class="page11characterheadstuff" style="position:relative;transform:rotate(16deg);">
						<img class="pagehair page11hair" id="page11hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page11glasses" id="page11glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page11freckles" id="page11freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
				</div>
				<div id="page11textcontainer" class="pagetextcontainer page11textcontainer" style="text-align:center;height:0px;position:relative;width:0px;color:#000">
					<div class="first">
						<div>Colors drip, slip, blip,</div>
						<div>Slop, plop, blop</div>
						<div><span class="childsnameautofill"></span><span> is careful</span></div>
						<div>not to drop...</div>
					</div>
					<div class="second">
						<div>Paint drips, slips, blips</div>
						<div>Moves like the tides,</div>
						<div>Guides, slides, colides...</div>
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'

				'.(in_array(12,$pages) ? '<div id="page12area" class="pagearea page12area" style="overflow:hidden">
				<img class="pagebackground pagebackground12" id="pagebackground12" width="100%" src="i/pages/PickingFlowersPACKAGE/PickingFlowersSpread'.$res.'" />
				<div id="page12textcontainer" class="pagetextcontainer page12textcontainer" style="height:0px;position:relative;width:0px;color:#000">
					
                            <div class="firstline" style="position:relative">
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
                            <div class="secondline" style="position:relative">
							<div><span class="childsnameautofill"></span>, look over here!</div>
							<div>Flowers of red, blue, pink and yellow,</div>
							<div>They open just for you each day,</div>
							<div>As if to say hello!</div>
							</div>




				</div>
				<div id="page12charactercontainer" class="pagecharactercontainer page12charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page12body" id="page12body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page12characterheadstuff" class="page12characterheadstuff" style="position:relative">
						<img class="pageyes page12eyes" id="page12eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page12hair" id="page12hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page12glasses" id="page12glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page12freckles" id="page12freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
		
			'.(in_array(13,$pages) ? '<div id="page13area" class="pagearea page13area" style="overflow:hidden">
				<img class="pagebackground pagebackground13" id="pagebackground13" width="100%" src="i/pages/PlaygroundPACKAGE/PlaygroundSpread'.$res.'" />
				<div id="page13textcontainer" class="pagetextcontainer page13textcontainer" style="height:0px;position:relative;width:0px;color:#000">




						<div class="first" style="position:relative">
						<div><span class="childsnameautofill"></span> hops in the saucer -</div>
						<div>Spins round and round,</div>
						<div>With friends and feeling free,</div>
						<div><span class="childsnameautofill"></span> loves the playground!</div>
						</div>
						<div class="second" style="position:relative">
						<div>We’re kind while we play,</div>
						<div>But if somebody is mean,</div>
						<div>We tell them politely to stop,</div>
						<div>We won’t make a big scene,</div>
						</div>

						<div class="third" style="position:relative">
						<div>The park is our safe place,</div>
						<div>We laugh, we sing and we play.</div>
						<div>All our friends are so nice,</div>
						<div>We could stay here all day!</div>
						</div>







				</div>
				<div id="page13charactercontainer" class="pagecharactercontainer page13charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page13body" id="page13body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page13characterheadstuff" class="page13characterheadstuff" style="position:relative">
						<img class="pageyes page13eyes" id="page13eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page13hair" id="page13hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page13glasses" id="page13glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page13freckles" id="page13freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(14,$pages) ? '<div id="page14area" class="pagearea page14area" style="overflow:hidden">
				<img class="pagebackground pagebackground14" id="pagebackground14" width="100%" src="i/pages/Rainbow-Slide-PACKAGE/RainbowSlideSpread'.$res.'?v='.$SWIM['version'].'" />
				<div id="page14textcontainer" class="pagetextcontainer page14textcontainer" style="height:0px;position:relative;width:0px;color:#283891;text-align:left">
										
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
				<div id="page14charactercontainer" class="pagecharactercontainer page14charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page14body" id="page14body" style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page14characterheadstuff" class="page14characterheadstuff" style="position:relative">
						<img class="pageyes page14eyes" id="page14eyes" style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page14hair" id="page14hair" style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page14glasses" id="page14glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page14freckles" id="page14freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(15,$pages) ? '<div id="page15area" class="pagearea page15area" style="overflow:hidden">
				<img class="pagebackground pagebackground15" id="pagebackground15" width="100%" src="i/pages/SailingPACKAGE/SailingSpread'.$res.'" />
				<div id="page15textcontainer" class="pagetextcontainer page15textcontainer" style="height:0px;position:relative;width:0px;color:#000;text-align:left">
				




							<div>Through rain and through wind,</div>
							<div>Through rough and stormy seas,</div>
							<div><span class="childsnameautofill"></span> sails and searches,</div>
							<div>For new discoveries.</div>
							<div>&nbsp;</div>
							<div>Finding adventure,</div>
							<div>Is so much fun, let’s go!</div>
							<div>The joy is in the journey,</div>
							<div>When one goes with the flow.</div>
							<div>&nbsp;</div>
							<div>But if <span class="childsnameautofill"></span> sometimes,</div>
							<div>Feels a bit unsure,</div>
							<div>It\'s time to take 3 deep breaths in -</diV>
							<diV>Breathe out and try once more.</div>
							<div>&nbsp;</div>
							<div><span class="childsnameautofill"></span> knows there\'s lessons,</div>
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
				<img class="pagebackground pagebackground16" id="pagebackground16" width="100%" src="i/pages/SpacePackage/SpaceSpread'.$res.'?v='.$SWIM['version'].'" />
				<div id="page16textcontainer" class="pagetextcontainer page16textcontainer" style="height:0px;position:relative;width:0px;color:#8cc63f">



									<div>Twinkle, twinkle, deep, dark sky,</div>
									<div>How <span class="childsnameautofill"></span> loves being up so high!</div>
									<div>Looking down on Earth below,</div>
									<div>Planning all the places we\'ll go.</div>
									<div>&nbsp;</div>
									<div>I-Spy Earth! We’re oh so far,</div>
									<div>We’ll count the stars and visit Mars.</div>
									<div>Exploring in this expansive place,</div>
									<div>We’re oh so tiny from up in space!</div>









				</div>
				<div id="page16charactercontainer" class="pagecharactercontainer page16charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page16body" id="page16body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page16characterheadstuff" class="page16characterheadstuff" style="position:relative">
						<img class="pageyes page16eyes" id="page16eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page16hair" id="page16hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page16glasses" id="page16glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page16freckles" id="page16freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(17,$pages) ? '<div id="page17area" class="pagearea page17area" style="overflow:hidden">
				<img class="pagebackground pagebackground17" id="pagebackground17" width="100%" src="i/pages/StillnessPACKAGE/StillnessSpread'.$res.'?v='.$SWIM['version'].'" />
				<div id="page17textcontainer" class="pagetextcontainer page17textcontainer" style="height:0px;position:relative;width:0px;color:#fff">

							<div><span class="childsnameautofill"></span> can match their breath,</div>
							<div>To the cricket’s song,</div>
							<div>It’s peaceful in the grass,</div>
							<div>Relaxing and humming along.</div>
							<div>&nbsp;</div>
							<div>Stars start to pop out,</div> 
							<div><span class="childsnameautofill"></span> counts them - one, two, three,</div>
							<div>But there’s so, so many more,</div>
							<div>How many can you see?</div>
				</div>
				<div id="page17charactercontainer" class="pagecharactercontainer page17charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page17body" id="page17body" style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page17characterheadstuff" class="page17characterheadstuff" style="position:relative;transform:rotate(-29.5deg)">
						<img class="pageyes page17eyes" id="page17eyes" style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page17hair" id="page17hair" style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page17glasses" id="page17glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page17freckles" id="page17freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(18,$pages) ? '<div id="page18area" class="pagearea page18area">
				<img class="pagebackground pagebackground18" id="pagebackground18" width="100%" src="i/pages/TreeClimbingPACKAGE/TreeClimbingSpreadBackground.png" />
				<div id="page18textcontainer" class="pagetextcontainer page18textcontainer" style="height:0px;position:relative;width:0px;color:#fff">
					<div>To climb up high we sometimes fall</div>
					<div><span class="childsnameautofill"></span><span>\'s biggest obstacle</span></div>
					<div>can be emotions and all</div>
					<div>The fear and worry that we might fail</div>
					<div>Could stop us before we can prevail</div>
					<div>When things are hard we must try our best</div>
					<div>Give it our all and then we rest!</div>
				</div>
				<div id="page18charactercontainer" class="pagecharactercontainer page18charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page18body" id="page18body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page18characterheadstuff" class="page18characterheadstuff" style="position:relative;transform: rotate(2deg);">
						<img class="pageyes page18eyes" id="page18eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page18hair" id="page18hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page18glasses" id="page18glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page18freckles" id="page18freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(19,$pages) ? '<div id="page19area" class="pagearea page19area">
				<img class="pagebackground pagebackground19" id="pagebackground19" width="100%" src="i/pages/UnicornSpreadPACKAGE/UnicornSpread'.$res.'" />
				<div id="page19textcontainer" class="pagetextcontainer page19textcontainer" style="height:0px;position:relative;width:0px;color:#6a3293">
					




					<div class="first" style="position:relative">
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
				<div id="page19charactercontainer" class="pagecharactercontainer page19charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page19body" id="page19body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page19characterheadstuff" class="page19characterheadstuff" style="position:relative;transform: rotate(-13.5deg);">
						<img class="pageyes page19eyes" id="page19eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page19hair" id="page19hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page19glasses" id="page19glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page19freckles" id="page19freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(20,$pages) ? '<div id="page20area" class="pagearea page20area">
				<img class="pagebackground pagebackground20" id="pagebackground20" width="100%" src="i/pages/WheelsPACKAGE/WheelsSpread'.$res.'" />
				<div id="page20textcontainer" class="pagetextcontainer page20textcontainer" style="height:0px;position:relative;bottom:316px;width:0px;color:#000">


				<div>There’s so many ways,</div>
				<div>That people get around,</div>
				<div>Wheels on the pavement is,</div>
				<div><span class="childsnameautofill"></span>’s favorite sound.</div>
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
				<div id="page20charactercontainer" class="pagecharactercontainer page20charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page20body" id="page20body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page20characterheadstuff" class="page20characterheadstuff" style="position:relative">
						<img class="pageyes page20eyes" id="page20eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page20hair" id="page20hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page20glasses" id="page20glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page20freckles" id="page20freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'
			'.(in_array(21,$pages) ? '<div id="page21area" class="pagearea page21area">
				<img class="pagebackground pagebackground21" id="pagebackground21" width="100%" src="i/pages/dedication/DedicatioSpread'.$res.'" style="display:block"/>
				<div class="lovenotechildspicturecontainer" style="'.$childPictureStyle.'">'.$childsPicture.'<img src="i/pages/dedication/Polaroid-Overlay.png" class="lovenotechildspictureborder" style="z-index:1" /></div>
				<div id="page21textcontainer" class="pagetextcontainer page21textcontainer" style="position:relative;color:#000;text-align:left;font-family:\'Caveat\', cursive;">
					<div class="lovenoteautofill"></div>
					<div class="lovenotefromautofill"></div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'

			'.(in_array(7,$pages) ? '<div id="page7area" class="pagearea page7area" style="overflow:hidden">
				<img class="pagebackground pagebackground7" id="pagebackground7" width="100%" src="i/pages/DragonPACKAGE/DragonSpread'.$res.'"/>
				<div id="page7textcontainer" class="pagetextcontainer page7textcontainer" style="height:0px;position:relative;width:0px;color:#000">
					

							<div>With fiery courage and </div>
							<div>Long graceful wings,</div>
							<div>Dragons are wise,</div>
							<div>With the knowledge they bring.</div>
							<div>&nbsp;</div>
							<div><span class="childsnameautofill"></span> loves dragons because</div>
							<div>They believe in what’s right,</div>
							<div>They lead with their hearts,</div>
							<div>As they take off in flight.</div>



				</div>
				<div id="page7charactercontainer" class="pagecharactercontainer page7charactercontainer" style="height:0px;width:0px;position:relative">
					<img class="pagebody page7body" id="page7body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />
					<div id="page7characterheadstuff" class="page7characterheadstuff" style="position:relative">
						<img class="pageyes page7eyes" id="page7eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />
						<img class="pagehair page7hair" id="page7hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />
						<img class="pageglasses page7glasses" id="page7glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />
						<img class="pagefreckles page7freckles" id="page7freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />
					</div>
				</div>
				'.$pageSeparator.'
			</div>' : '').'

<div style="background-color:#ff0000"></div>
		</div>';
			
		return $html;
	}

?>