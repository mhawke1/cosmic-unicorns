//this is a copy of 0.js with some changes... how messy messy
$jq = jQuery.noConflict();

function generateCharacterInEditor()
{
	eyeImg=document.getElementById('eyeimg');
	eyeImg.src='./'+characterParts['eyes'][character['eyes']]['color'][character['eyecolor']];
	eyeImg.style.left=characterParts['eyes'][character['eyes']]['position']['left']+'px';
	eyeImg.style.bottom=characterParts['eyes'][character['eyes']]['position']['bottom']+'px';

	var bodyImg=document.getElementById('bodyimg');

	bodyImg.src='./'+characterParts['body'][character['body']]['skin'][character['skin']];

	bodyImg.height=characterParts['body'][character['body']]['size']['height'];
	bodyImg.width=characterParts['body'][character['body']]['size']['width'];
	bodyImg.style.marginLeft='-'+characterParts['body'][character['body']]['size']['width']+'px';
	bodyImg.style.marginTop='-'+characterParts['body'][character['body']]['size']['height']+'px';

	bodyImg.style.left=+characterParts['body'][character['body']]['position']['left']+'px';
	bodyImg.style.top=characterParts['body'][character['body']]['position']['top']+'px'

	var hairImg=document.getElementById('hairimg');

	hairImg.src='./'+characterParts['hair'][character['hair']]['color'][character['haircolor']];
	hairImg.height=characterParts['hair'][character['hair']]['size']['height'];
	hairImg.width=characterParts['hair'][character['hair']]['size']['width'];
	hairImg.style.right=characterParts['hair'][character['hair']]['position']['right']+'px';
	hairImg.style.bottom=characterParts['hair'][character['hair']]['position']['bottom']+'px';

	hairImg.style.marginLeft='-'+characterParts['hair'][character['hair']]['size']['width']+'px';
	hairImg.style.marginTop='-'+characterParts['hair'][character['hair']]['size']['height']+'px';

	if(isInt(character['freckles']))
	{
		document.getElementById('frecklesimg').style.visibility='visible';
	}
	else
	{
		document.getElementById('frecklesimg').style.visibility='hidden';
	}

	if(isInt(character['glasses']))
	{
		document.getElementById('glassesimg').style.visibility='visible';
	}
	else
	{
		document.getElementById('glassesimg').style.visibility='hidden';
	}
}

function setBody(type,color)
{
	type=toInt(type);
	type=constrain(type,0,1);
	color=toInt(color);
	color=constraing(color,0,5);
	character['body']=type;
	character['skin']=color;
}

function hideAllEditorSliders()
{
	$jq('#hairselect').parent().parent().addClass('cS-hidden');
	$jq('#haircolorselect').parent().parent().addClass('cS-hidden');
	$jq('#bodyselect').parent().parent().addClass('cS-hidden');
	$jq('#bodycolorselect').parent().parent().addClass('cS-hidden');
	$jq('#eyesselect').parent().parent().addClass('cS-hidden');
	$jq('#eyecolorselect').parent().parent().addClass('cS-hidden');
	$jq('#glassesselect').parent().parent().addClass('cS-hidden');
	$jq('#frecklesselect').parent().parent().addClass('cS-hidden');
}

function hideAllEditorButtons()
{
	$jq('#hairselector .hid').show();
	$jq('#hairselector .sho').hide();

	$jq('#eyeselector .hid').show();
	$jq('#eyeselector .sho').hide();

	$jq('#bodyselector .hid').show();
	$jq('#bodyselector .sho').hide();

	$jq('#extrasselector .hid').show();
	$jq('#extrasselector .sho').hide();

	//$jq('#frecklesselector .hid').show();
	//$jq('#frecklesselector .sho').hide();
}

function showEditorButton(id)
{
	$jq(id+' .hid').hide();
	$jq(id+' .sho').show();
}

function calculatePageRelativeSizing(bgRestWidth,currentBGWidth)
{
	return currentBGWidth/bgRestWidth;
}


//returns the new values in an array [newBodyWidth, newHairWidth, newEyesWidth, newGlassesWidth,newFrecklesWidth,theCalculatedScale]
function calculatePageSizing(bgRestWidth,currentBGWidth,bodyRestWidth,hairRestWidth,eyesRestWidth,glassesRestWidth,frecklesRestWidth)
{
	var scale=calculatePageRelativeSizing(bgRestWidth,currentBGWidth);
	return [bodyRestWidth*scale,hairRestWidth*scale,eyesRestWidth*scale,glassesRestWidth*scale,frecklesRestWidth*scale,scale];
}

function calculatePageElementSize(defaultRestSize,scale)
{
	return defaultRestSize*scale;
}

var pageObjects=[];

function refreshBook(defaultPage){}

ready(function()
{
	var img=[];

	for(var i=0;i<characterParts['body'].length;++i)
	{
		for(var n=0;n<characterParts['body'][i]['skin'].length;++n)
		{
			var newImg=new Image();
			newImg.src=characterParts['body'][i]['skin'][n];

			img=pushToEndOfArray(img,newImg);
		}
	}

	for(i=0;i<characterParts['hair'].length;++i)
	{
		for(n=0;n<characterParts['hair'][i]['color'].length;++n)
		{
			var newImg=new Image();
			newImg.src=characterParts['hair'][i]['color'][n];

			img=pushToEndOfArray(img,newImg);
		}
	}

	generateCharacterInEditor();
	updateAllPages();

	var hairSelImg=document.getElementsByClassName('hairselimg');

	for(i=0;i<hairSelImg.length;++i)
	{
		hairSelImg[i].onclick=function()
		{
			character['hair']=toInt10(this.getAttribute('data-value'));

			$jq('#selectedhairtype').val(character['hair']);

			generateCharacterInEditor();

			updateAllPages();
		};
	}

	var glassesSel=document.getElementsByClassName('glassesselector');

	for(i=0;i<glassesSel.length;++i)
	{
		glassesSel[i].onclick=function()
		{
			var glassesVal=this.getAttribute('data-value');

			if(glassesVal==='')
			{
				$jq('#selectedglasses').val(0);
				glassesVal=null;
			}
			else
			{
				$jq('#selectedglasses').val(1);
				glassesVal=toInt10(glassesVal);
			}
			character['glasses']=glassesVal;

			generateCharacterInEditor();
			updateAllPages();
		};
	}

	var frecklesSel=document.getElementsByClassName('frecklesselector');

	for(i=0;i<frecklesSel.length;++i)
	{
		frecklesSel[i].onclick=function()
		{
			var frecklesVal=this.getAttribute('data-value');

			if(frecklesVal==='')
			{
				$jq('#selectedfreckles').val(0);
				frecklesVal=null;
			}
			else
			{
				$jq('#selectedfreckles').val(1);
				frecklesVal=toInt10(frecklesVal);
			}
			character['freckles']=frecklesVal;

			generateCharacterInEditor();
			updateAllPages();
		};
	}

	var hairColorSel=document.getElementsByClassName('haircolorselector');

	for(i=0;i<hairColorSel.length;++i)
	{
		hairColorSel[i].onclick=function()
		{
			character['haircolor']=toInt10(this.getAttribute('data-value'));
			$jq('#selectedhaircolor').val(character['haircolor']);

			generateCharacterInEditor();
			updateAllPages();
		}
	}

	var bodySelImg=document.getElementsByClassName('bodyselimg');

	for(i=0;i<bodySelImg.length;++i)
	{
		bodySelImg[i].onclick=function()
		{
			character['body']=toInt10(this.getAttribute('data-value'));
			$jq('#selectedbodytype').val(character['body']);
			generateCharacterInEditor();
			updateAllPages();
		};
	}

	var eyesSelImg=document.getElementsByClassName('eyesselectimg');

	for(i=0;i<eyesSelImg.length;++i)
	{
		eyesSelImg[i].onclick=function()
		{
			character['eyes']=toInt10(this.getAttribute('data-value'));
			$jq('#selectedeyestype').val(character['eyes']);
			generateCharacterInEditor();
			updateAllPages();
		};
	}

	var eyesColorSel=document.getElementsByClassName('eyecolorselector');

	for(i=0;i<eyesColorSel.length;++i)
	{
		eyesColorSel[i].onclick=function()
		{
			character['eyecolor']=toInt10(this.getAttribute('data-value'));
			$jq('#selectedeyescolor').val(character['eyecolor']);
			generateCharacterInEditor();
			updateAllPages();
		};
	}

	var bodyColorSel=document.getElementsByClassName('bodycolorselector');

	for(i=0;i<bodyColorSel.length;++i)
	{
		bodyColorSel[i].onclick=function()
		{
			character['skin']=toInt10(this.getAttribute('data-value'));
			$jq('#selectedskincolor').val(character['skin']);
			generateCharacterInEditor();
			updateAllPages();
		};
	}

	document.getElementById('hairselector').onclick=function()
	{
		hideAllEditorSliders();
		hideAllEditorButtons();
		showEditorButton('#hairselector');

		$jq('#hairselect').parent().parent().removeClass('cS-hidden');
		$jq('#haircolorselect').parent().parent().removeClass('cS-hidden');
	}

	document.getElementById('eyeselector').onclick=function()
	{
		hideAllEditorSliders();
		hideAllEditorButtons();
		showEditorButton('#eyeselector');

		$jq('#eyesselect').parent().parent().removeClass('cS-hidden');
		$jq('#eyecolorselect').parent().parent().removeClass('cS-hidden');
	}

	document.getElementById('extrasselector').onclick=function()
	{
		hideAllEditorSliders();
		hideAllEditorButtons();
		showEditorButton('#extrasselector');

		document.getElementById('extrasselect').parentElement.parentElement.parentElement.style.display='block';
	}

	document.getElementById('bodyselector').onclick=function()
	{
		hideAllEditorSliders();
		hideAllEditorButtons();
		showEditorButton('#bodyselector');

		$jq('#bodyselect').parent().parent().removeClass('cS-hidden');
		$jq('#bodycolorselect').parent().parent().removeClass('cS-hidden');
	}

	document.getElementById('extrasselector').onclick=function()
	{
		hideAllEditorSliders();
		hideAllEditorButtons();
		showEditorButton('#extrasselector');

		$jq('#glassesselect').parent().parent().removeClass('cS-hidden');
		$jq('#frecklesselect').parent().parent().removeClass('cS-hidden');
	}

	hideAllEditorButtons();
	document.getElementById('hairselector').click();
});