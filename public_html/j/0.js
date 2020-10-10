$jq=jQuery.noConflict();


 var glassPart=[];
    glassPart[1]='i/character/Glasses/Glasses1.png';
    glassPart[2]='i/character/Glasses/Glasses2.png';
    glassPart[3]='i/character/Glasses/Glasses3.png';
    glassPart[4]='i/character/Glasses/Glasses4.png';
 

function generateCharacterInEditor()
{
	eyeImg=document.getElementById('eyeimg');
	eyeImg.src='./'+characterParts['eyes'][character['eyes']]['color'][character['eyecolor']];
	eyeImg.style.left=characterParts['eyes'][character['eyes']]['position']['left']+'px';
	eyeImg.style.marginLeft=(-characterParts['eyes'][character['eyes']]['size']['width'])+'px';
	eyeImg.style.bottom=characterParts['eyes'][character['eyes']]['position']['bottom']+'px';
	eyeImg.style.marginBottom=(-characterParts['eyes'][character['eyes']]['size']['height'])+'px';
	eyeImg.width=characterParts['eyes'][character['eyes']]['size']['width'];
	eyeImg.height=characterParts['eyes'][character['eyes']]['size']['height'];

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
	hairImg.height=0.095*hairWH[character['hair']][1];//characterParts['hair'][character['hair']]['size']['height'];
	hairImg.width=0.095*hairWH[character['hair']][0];//characterParts['hair'][character['hair']]['size']['width'];
	hairImg.style.right=characterParts['hair'][character['hair']]['position']['right']+'px';
	hairImg.style.bottom=characterParts['hair'][character['hair']]['position']['bottom']+'px';
	hairImg.style.marginLeft='-'+(0.095*hairWH[character['hair']][0])+'px';//'-'+characterParts['hair'][character['hair']]['size']['width']+'px';
	hairImg.style.marginTop='-'+(0.095*hairWH[character['hair']][1])+'px';//'-'+characterParts['hair'][character['hair']]['size']['height']+'px';

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

		var glassId = document.getElementById('selectedglasses').value;
     
         document.getElementById("glassesimg").src=glassPart[glassId];
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


	$jq('#hisabselector .hid').show();
	$jq('#hisabselector .sho').hide();

	$jq('#eyeselector .hid').show();
	$jq('#eyeselector .sho').hide();

	$jq('#bodyselector .hid').show();
	$jq('#bodyselector .sho').hide();

	$jq('#extrasselector .hid').show();
	$jq('#extrasselector .sho').hide();
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

function updatePageTurnClickJs()
{
	$jq('#characterpagesarea .odd').off('click');
	$jq('#characterpagesarea .odd').on('click',function()
	{
		$jq("#characterpagesarea").turn("next");
	});

	$jq('#characterpagesarea .even').off('click');
	$jq('#characterpagesarea .even').on('click',function()
	{
		$jq("#characterpagesarea").turn("previous");
	});
}

var pageObjects=[];
var frontbackcover=$jq('<div><div id="page0area" class="pagearea page0area" style="width:960px;height:361px">'
	+'<img class="pagebackground pagebackground0" id="pagebackground0" width="100%" src="i/pages/Book-Cover-Package/CoverSpreadWeb'+res+'?v=0"/>'
	+'<div id="page0textcontainer" class="pagetextcontainer page0textcontainer textimg-section" style="height:0px;position:relative;width:0px;color:#0f75bc;font-family:Caveat, cursive;font-weight:bold">'
	+'	<div><span class="childsnameautofill"></span>\'s</div>'
	+'</div>'
	+'<input type="hidden" id="front-image-hidden">'
	+'<div id="page0charactercontainer" class="pagecharactercontainer page0charactercontainer fullbody-section" style="height:0px;width:0px;position:relative">'
	+'	<img class="pagebody page0body" id="page0body"     style="display:block;position:relative" src="i/pages/AirshipPackage/AirspreadCharacter1.png?v=1564062674" />'
	+'	<div id="page0characterheadstuff" class="page0characterheadstuff" style="position:relative">'
	+'		<img class="pageyes page0eyes" id="page0eyes"     style="display:block;position:relative" src="i/character/Eyes/Eyes/Eyesblue.png?v=1564062674" />'
	+'		<img class="pagehair page0hair" id="page0hair"     style="display:block;position:relative" src="i/character/Hair/MedPigtail/Medpigtaillightbrown.png?v=1564062674" />'
	+'		<img class="pageglasses page0glasses" id="page0glasses" style="display:block;position:relative" src="i/character/Glasses/Glasses1.png?v=1564062674" />'
	+'		<img class="pagefreckles page0freckles" id="page0freckles" style="display:block;position:relative" src="i/character/Freckles/Freckles.png?v=1564062674" />'
	+'	</div>'
	+'</div>'
	+'</div></div>');

function refreshBook(defaultPage)
{   
	if(typeof pdfPrint==='undefined')
	{
		var numberOfPages=$jq("#characterpagesarea").turn("pages");
		if(typeof defaultPage==='undefined')defaultPage=1;
		defaultPage=parseInt(defaultPage);
		if(defaultPage<1)defaultPage=1;
		if(defaultPage>numberOfPages)defaultPage=numberOfPages;
		if($jq("#characterpagesarea").turn("is"))$jq("#characterpagesarea").turn('destroy');

		//Book front Cover
		$jq(frontbackcover).find('#page0area').css('left','-460px');
		$jq(frontbackcover).find('#page0area').css('position','relative');
		$jq("#characterpagesarea").append(frontbackcover.clone());

		for(var i=0;i<pageObjects.length;++i)
		{
			if(typeof pageObjects[i] !== 'undefined' && pageObjects[i][0])$jq("#characterpagesarea").append(pageObjects[i][2].clone());
		}

		$jq("#characterpagesarea").append(pageObjects[21][2].clone());

		//Book back cover.
		$jq(frontbackcover).find('#page0area').css('left','');
		$jq(frontbackcover).find('#page0area').css('position','');
		$jq("#characterpagesarea").append(frontbackcover.clone());
		$jq('.pagearea').scissor();
		$jq("#characterpagesarea").turn(
		{
			width:920,
			height:361,
			autoCenter:true,
			gradients:true,
			turnCorners:"bl,br",
			elevation:10,
			page:defaultPage,
			when:{
				turning:function(event, page, pageObject) 
				{
					updateAllPages();
				},
				turned:function(event, page, pageObject) 
				{
					updatePageTurnClickJs();
					updateAllPages();
				},
				start:function(event, page, pageObject) 
				{
					updateAllPages();
				},
			}
		});
	}
}

ready(function()
{   
   $jq('.homePage #privy-container').hide();
   getLocalStorage ();
   function getLocalStorage()
   {

   	   if ($jq("body").hasClass("homePage")) {
        var childsnameinput=  localStorage.getItem("childsnameinput");
        var hair = localStorage.getItem("hair");
        var glasses = localStorage.getItem("glasses");
        var freckles = localStorage.getItem("freckles");
        var haircolor = localStorage.getItem("haircolor");
        var body = localStorage.getItem("body");
        var eyes = localStorage.getItem("eyes");
        var eyecolor = localStorage.getItem("eyecolor");
        var skin = localStorage.getItem("skin");
         

          
       	 if(childsnameinput!==null && childsnameinput!=='')
        	{  
            $jq('#childsnameinput').val(childsnameinput);
             $jq('#childsname').val(childsnameinput);
       		}
           if(hair!==null && hair!=='')
           {   

           	$jq('#selectedhairtype').val(hair);
           }
            if(glasses!==null && glasses!=='')
           {    
           	   $jq('#selectedglasses').val(glasses);
           }
            if(freckles!==null && freckles!=='')
           {     
           	 $jq('#selectedfreckles').val(freckles);
           }
           
            if(haircolor!==null && haircolor!=='')
           {     
           	 $jq('#selectedhaircolor').val(haircolor);
           }
            if(body!==null && body!=='')
           {     
           	  $jq('#selectedbodytype').val(body);
           }
            if(eyes!==null && eyes!=='')
           {     
           	  $jq('#selectedeyestype').val(eyes);
           }
            if(eyecolor!==null && eyecolor!=='')
           {   console.log("eyecolor");
           	  $jq('#selectedeyescolor').val(eyecolor);
           } 
            if(skin!==null && skin!=='')
           { console.log("skin");
           	 $jq('#selectedskincolor').val(skin);
           }
       }
        
     
       
       
      
      
      
       
       
   }


	/* $jq("#lovenoteinput").keyup(function(e)
	{
		while($jq(this).outerHeight()>=this.scrollHeight+parseFloat($jq(this).css("borderTopWidth"))+parseFloat($jq(this).css("borderBottomWidth")))
		{
			$jq(this).height($jq(this).height()-1);
		};

		while($jq(this).outerHeight()<this.scrollHeight+parseFloat($jq(this).css("borderTopWidth"))+parseFloat($jq(this).css("borderBottomWidth")))
		{
			$jq(this).height($jq(this).height()+1);
		};
	});*/

	$jq('#lovenoteinput').trigger('keyup');
	$jq("#tmpsubmitform").submit(function(e)
	{
		e.preventDefault();

		var submitSafe=true;
		var erMsgs='';

		if($jq('#pageselectors .showit').length<10)
		{
			submitSafe=false;
			erMsgs+='<p class="error">Please select 10 stories to include in your personalized book.</p>';
		}

		

		if($jq.trim($jq('#childsnameinput').val()).length==0)
		{                        
			submitSafe=false;
			erMsgs+='<p class="error">Remember to enter your child\'s name.</p>';
		}

		

		//Validate here
		if(submitSafe)
             {
             	       
             	        	$jq('#checkoutform').submit();
             	        
                        
             }
			
		else
		{
			$jq('#booksubmissionerrormessagebox .msg_box_text').html(erMsgs);
			$jq('#booksubmissionerrormessagebox').show();
		}
	});


   $jq('#childpictureinput').change(function(index)
	{
	  
   
    if($jq('#childpictureinput')[0].files.length==0)
		{
			$jq('#childpictureinput').addClass('error');
	       $jq('#file_error').html('<p class="error">Don\'t forget to select a picture of your child.</p>');


		   return;
		}/*
		else if($jq('#childpictureinput')[0].files[0].size>1000000)
		{

			$jq('#childpictureinput').addClass('error');
	       $jq('#file_error').html('<p class="error">Please make sure your child\'s picture is no larger than 1MB in size.</p>');

		  return;
		}*/
		else
		{
			var file = $jq('#childpictureinput')[0].files[0];
			var fileType = file["type"];
			var validImageTypes = ["image/gif", "image/jpeg", "image/png"];

			if ($jq.inArray(fileType, validImageTypes) < 0)
			{

				$jq('#childpictureinput').addClass('error');
	            $jq('#file_error').html('<p class="error">You selected an invalid image file for your child, please select a different file (Must be a gif, jpg, or png file).</p>');

			     return;
			}

           
             var file_data = $jq('#childpictureinput').prop('files')[0];   
   			 var form_data = new FormData();                  
    form_data.append('childspicture', file_data);
     $jq('#childpictureinput').addClass('error');
	            $jq('#file_error').html(' ');

			$jq.ajax({
                url: 'ajax.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
			success : function(response) {
				var data=JSON.parse(response);


				if(data.status=='OK')
				{
               $jq('#childspicture').val(data.filename);
						
					
				}else {
                $jq('#childpictureinput').addClass('error');
	            $jq('#file_error').html('<p class="error">Something Went Wrong</p>');

				}
				
			}

		});




		}

	});

	$jq('.pagearea').each(function(index)
	{
		var pageNum=index+1;
		var actualPageNumber= $jq(this).attr('id').substring(4);
		actualPageNumber = parseInt(actualPageNumber.substring(0,actualPageNumber.length-4));
		pageObjects[actualPageNumber]=[false,[pageNum*2,pageNum*2+1],$jq(this).clone()];
	});
     



	$jq("#characterpagesarea").html('');
      
  
  $jq('#delete_design').on('click',function(){
     removeLocalStorage();
	});
      function removeLocalStorage()
      {
      	        localStorage.setItem("localpage",'');
                localStorage.setItem("childsnameinput",'');
                localStorage.setItem("hair",'');
                localStorage.setItem("glasses",'');
                localStorage.setItem("freckles",''); 
                localStorage.setItem("haircolor",'');
                localStorage.setItem("body",'');
                localStorage.setItem("eyes",'');
                localStorage.setItem("eyecolor",'');
                localStorage.setItem("skin",'');
                location.reload();
      }
	
      

      var localpage =[];
      function selectPages()
      {
      	 localpage=localStorage.getItem("localpage");
      
      	 if(localpage!='')
      	 {
      	 	pageArray= JSON.parse(localpage);
            
      	 	$jq(pageArray).each(function(index,value)
			{    
               var parentElement = $jq("img[data-pagenumber="+value+"]").parent();
               pageNumber(parentElement);
           });

      	 } 
        
      }

      if ($jq("body").hasClass("homePage")) {
          selectPages();
  		}

    
    function pageNumber(parentElement)
    {
        var imgElement=$jq(parentElement).find('img');
		 var pageNumber=parseInt(imgElement.data('pagenumber'));


    	if(typeof pageObjects[pageNumber] !== 'undefined' && pageObjects[pageNumber][0])
		{
			$jq(parentElement).removeClass('showit');

			$jq('#pageselectors .showit').each(function(index)
			{   
				//localStorage.setItem("pages", index+1);

				$jq(this).find('.pagenumbercontainer').html(index+1);
			})

			 localpage=localStorage.getItem("localpage");
			 
             if(localpage!='')
             {
               localpage= JSON.parse(localpage);

                 
               
                 var index = localpage.indexOf(pageNumber);
					if (index > -1) {
 					 localpage.splice(index, 1);
					}

             	localStorage.setItem("localpage",JSON.stringify(localpage));
             
             }
             
			
            
			$jq('#checkoutform .text[value="'+pageNumber+'"]').remove();
			imgElement.removeClass('highlight');

			var currentPage=$jq("#characterpagesarea").turn("page");

			if(currentPage>=pageObjects[pageNumber][1][1])currentPage-=2;

			$jq("#characterpagesarea").turn('removePage',pageObjects[pageNumber][1][0]);
			$jq("#characterpagesarea").turn('removePage',pageObjects[pageNumber][1][0]);

			var actualPageNumbers=pageObjects[pageNumber][1];

			pageObjects[pageNumber][0]=false;
			pageObjects[pageNumber][1]=[];

			for(var i=pageNumber;i<pageObjects.length;++i)
			{
				if(typeof pageObjects[i] !== 'undefined' && pageObjects[i][0]&&pageObjects[i][1][0]>=actualPageNumbers[0])
				{
					pageObjects[i][1][0]=pageObjects[i][1][0]-2;
					pageObjects[i][1][1]=pageObjects[i][1][1]-2;
				}
			}
            
			refreshBook(currentPage);
		}
		else if(typeof pageObjects[pageNumber] !== 'undefined')
		{  

			if($jq('#pageselectors .showit').length>=10)return;

         
           
           
			 localpage=localStorage.getItem("localpage");

             if(localpage==''||localpage==null)
             { 

               localpage=[];
               localpage.push(pageNumber);
             
             }else {
             	localpage= JSON.parse(localpage);
             	if(jQuery.inArray(pageNumber, localpage) == -1)
             	{
             		
                  localpage.push(pageNumber);
             	}
                
               
             }
             localStorage.setItem("localpage",JSON.stringify(localpage));
			
            
			$jq(imgElement).parent().addClass('showit');
			$jq(parentElement).find('.pagenumbercontainer').html($jq('#pageselectors .showit').length);
			$jq('#checkoutform').append('<input class="text" type="hidden" value="'+pageNumber+'" name="pages[]" />');

			imgElement.addClass('highlight');

			var pageCount=$jq("#characterpagesarea").turn("pages");

			//var lastPage=console.log($jq("#characterpagesarea").turn('removePage',pageCount));

			pageObjects[pageNumber][0]=true;
			pageObjects[pageNumber][1]=[pageCount,pageCount+1]

			var tmpPageNum=2;

			for(var i=0;i<pageObjects.length;++i)
			{
				if(typeof pageObjects[i] !== 'undefined' && pageObjects[i][0])
				{
					pageObjects[i][1][0]=tmpPageNum;
					pageObjects[i][1][1]=pageObjects[i][1][0]+1;
					tmpPageNum+=2;
				}
			}

			$jq("#characterpagesarea").turn('addPage',pageObjects[pageNumber][2].clone());
			$jq("#characterpagesarea").turn('addPage',pageObjects[pageNumber][2].clone());
			$jq("#characterpagesarea").turn('addPage',$jq('<div style="background-color:#ff0000"></div>'));

			var currentPage=$jq("#characterpagesarea").turn("page");

			if(currentPage>=pageObjects[pageNumber][1][1])currentPage+=2;

			refreshBook(currentPage);
		}
    }

	$jq('#pageselectors img,#pageselectors .crosscontainer,#pageselectors .checkboxcontainer,#pageselectors .pagenumbercontainer').on('click',function()
	{   
		var parentElement=$jq(this).parent();
		pageNumber(parentElement)
		
	});

	refreshBook();

	$jq('#childsnameinput').on('keyup',function()
	{
		$jq('.childsnameautofill').html(htmlentities.encode($jq(this).val()));
		$jq('#childsname').val(htmlentities.encode($jq(this).val()));
		localStorage.setItem("childsnameinput", $jq(this).val());
		


		
	});

	$jq('#childsnameinput').on('keydown',function()
	{  
		localStorage.setItem("childsnameinput", $jq(this).val());

		$jq('.childsnameautofill').html(htmlentities.encode($jq(this).val()));
		$jq('#childsname').val(htmlentities.encode($jq(this).val()));
	});

	$jq('#lovenoteinput').on('keydown',function()
	{

		$jq('.lovenoteautofill').html(htmlentities.encode($jq(this).val()).replace(/'&#13;&#10;|&#13;|&#10;/g,"<br />"));
		$jq('#lovenotenote').val($jq(this).val());
	});

	$jq('#lovenoteinput').on('keyup',function()
	{   
		$jq('.lovenoteautofill').html(htmlentities.encode($jq(this).val()).replace(/'&#13;&#10;|&#13;|&#10;/g,"<br />"));
		$jq('#lovenotenote').val($jq(this).val());

	});

	updateAllPages();

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

	$jq("#hairselect").lightSlider({item:5,autoWidth:false}).goToSlide(5);
	$jq("#haircolorselect").lightSlider({item:5,autoWidth:false}).goToSlide(2);
	$jq("#bodyselect").lightSlider({item:4,autoWidth:false}).goToSlide(1);
	$jq("#bodycolorselect").lightSlider({item:5,autoWidth:false});
	$jq("#eyesselect").lightSlider({item:4,autoWidth:false});
	$jq('#eyecolorselect').lightSlider({item:5,autoWidth:false}).goToSlide(1);
	$jq('#glassesselect').lightSlider({item:5,autoWidth:false});
	$jq('#frecklesselect').lightSlider({item:5,autoWidth:false});
	$jq('#pageselectors').lightSlider({item:5,autoWidth:false});

	var hairSelImg=document.getElementsByClassName('hairselimg');

	for(i=0;i<hairSelImg.length;++i)
	{
		hairSelImg[i].onclick=function()
		{
			character['hair']=toInt10(this.getAttribute('data-value'));
            
             localStorage.setItem("hair",character['hair']);

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
				 localStorage.setItem("glasses",0);
				$jq('#selectedglasses').val(0);
				glassesVal=null;
			}
			else
			{   localStorage.setItem("glasses",glassesVal);
				$jq('#selectedglasses').val(glassesVal);
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
				 localStorage.setItem("freckles",0);
				$jq('#selectedfreckles').val(0);
				frecklesVal=null;
			}
			else
			{    localStorage.setItem("freckles",1);
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
			localStorage.setItem("haircolor",character['haircolor']);

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

			localStorage.setItem("body",character['body']);

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

			localStorage.setItem("eyes",character['eyes']);

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

			localStorage.setItem("eyecolor",character['eyecolor']);

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

			localStorage.setItem("skin",character['skin']);

			generateCharacterInEditor();
			updateAllPages();
		};
	}

	document.getElementById('hairselector').onclick=function()
	{
		hideAllEditorSliders();
		hideAllEditorButtons();
		showEditorButton('#hairselector');
		
		
		$jq('.showhisab').hide();
		$jq('.showhair').show();

		$jq('#hairselect').parent().parent().removeClass('cS-hidden');
		$jq('#haircolorselect').parent().parent().removeClass('cS-hidden');
	}


	document.getElementById('hisabselector').onclick=function()
	{
		hideAllEditorSliders();
		hideAllEditorButtons();
		showEditorButton('#hisabselector');

		$jq('.showhisab').show();
		$jq('.showhair').hide();
		

		$jq('#hisabselector').parent().parent().removeClass('cS-hidden');
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



