//S.A. Lowell: This is my general Javascript Library of useful stuff.
//FIX:
	//Some functions need to be fixed and prevent you from modifying the passed in OBJECTS
	//null throws an error when passed into isObjectInstanceType();

var SALOWELL=[];
SALOWELL['FPI']=0.00001,SALOWELL['FPI_2X']=SALOWELL['FPI']*2;//Floating Point Imprecision.

//Determines if two values are almost equal. AKA: tests if the values are within a valid Floating Point Imprecision range.
function nearlyEqual(a,b,epsilon){a=toFloat(a);b=toFloat(b);epsilon=toFloat(epsilon);var absA=Math.abs(a),absB=Math.abs(b),diff=Math.abs(a-b);if(a==b)return true;else if(a==0||b==0||(absA+absB<Number.MIN_VALUE))return diff<(epsilon*Number.MIN_VALUE);return diff/Math.min((absA+absB),Number.MAX_VALUE)<epsilon}




(function(window){
	window.htmlentities = {
		/**
		 * Converts a string to its html characters completely.
		 *
		 * @param {String} str String with unescaped HTML characters
		 **/
		encode : function(str) {
			var buf = [];
			
			for (var i=str.length-1;i>=0;i--) {
				buf.unshift(['&#', str[i].charCodeAt(), ';'].join(''));
			}
			
			return buf.join('');
		},
		/**
		 * Converts an html characterSet into its original character.
		 *
		 * @param {String} str htmlSet entities
		 **/
		decode : function(str) {
			return str.replace(/&#(\d+);/g, function(match, dec) {
				return String.fromCharCode(dec);
			});
		}
	};
})(window);





// To bypass errors (“Tainted canvases may not be exported” or “SecurityError: The operation is insecure”)
// The browser must load the image via non-authenticated request and following CORS headers


// The magic begins after the image is successfully loaded
function imageUriToBase64(uri)
{
console.log('000000999999')
	var img=new Image();
	img.crossOrigin='Anonymous';
	img.src=uri;
console.log(img)
	var canvas=document.createElement('canvas'),
	ctx=canvas.getContext('2d');

	canvas.height=img.naturalHeight;
	canvas.width=img.naturalWidth;
	ctx.drawImage(img,0,0);

	var uri=canvas.toDataURL('image/png');
console.log(uri)
	uri.replace(/^data:image.+;base64,/,'');
console.log(uri)
	return uri;
};


//This is good to limit the frequency that a function can be called, it also resets that frequency every time it's called.
//How it works: debounce returns a function(). You can assign that function to a variable (That variable will now be the returned function) Every call to that returned function will reset+start the delay timer. If the function is being called repeatedly really fast then  the timer keeps resetting until the function call is idle for the delay time, upon which it calls the function[f] only once!
function debounce(f,delay)
{
	var timer=null;
	return function()
	{
		var context=this,args=arguments;
		clearTimeout(timer);
		timer=window.setTimeout(function()
		{
			f.apply(context,args);
		},
		delay||500);
	};
}



//Checks if a string is an email. This function is as loose as possible with the rules of what constitutes an email. aka: it is non strict. It mainly just checks for the last @ symbol and at least one character on either side of that @ symbol.
function isEmail(email)
{
	if(!isArray(splitEmailDomainAndUsername(email)))return false;

	return true;
}


/* Usage:
*	$(window).resize(function()
*	{
*		waitForFinalEvent(function()
*		{
*			alert('Resize...');
*			//...
*		},500,"some unique string for the ID of this wait event");
*	});
* Waits a certain amount of time to call the function passed into this function. The timer resets each time the ID is called. Once the timer runs out it will call the passed in function!
* The ID is the key to ensuring the timer is reset.
*/
var waitForFinalEvent=(function()
{
	var timers={};

	return function(callback,ms,uniqueId)
	{
		if(!uniqueId)uniqueId="Don't call this twice without a uniqueId";

		if(timers[uniqueId])clearTimeout(timers[uniqueId]);

		timers[uniqueId]=setTimeout(callback,ms);
	};
})();




//Splits an email into its domain and name portions.
//email: a string representing an email address to split.
function splitEmailDomainAndUsername(email)
{
	email=trimString(email);

	if(email==='')return 0;//empty string or invalid data type passed in for [email]

	var exp=email.split('@');

	if(exp.length<2)return 1;//non email string passed in for [email]

	email=['',exp.splice(exp.length-1)[0]];

	var index=0;
	var last=exp.length;

	while(index < last)
	{
		if(index!==0)email[0]+='@';
		email[0]+=exp[index];
		++index;
	}

	return email;
}

function trimString(str)
{
	str=toString(str,'');
	return str.replace(/^\s\s*/,'').replace(/\s\s*$/,'');
}



//For now this function is insanely incomplete. It just returns true... I need to research it more!!!!
function canBeString(varVal)
{
	return true;


	//if((!isArray($item))&&((!is_object($item)&&settype($item,'string')!==false)||(is_object($item)&&method_exists($item,'__toString'))))return true;

	//return false;
}

function isFunction(functionToCheck)
{
	return functionToCheck && {}.toString.call(functionToCheck)==='[object Function]';
}


//gets the scale from one value to another.
function getScale(from,to)
{
	if(from===0)return 0;

	return to/from;
}

//Gets the scale used for positioning an element.
//leftPosition: style="left" of the element to position.
//topPosition: style="top" of the element to position.
//returns the scale values to use on the element's positioning [horizontal,vertical]
function getPositionScale(horizontalPosition,verticalPosition,toWidth,toHeight)
{
	return [getScale(horizontalPosition,toWidth),getScale(verticalPosition,toHeight)];
}

//Returns the new horizontal and vertical positions of the element based on the other elements [horizontal,vertical]
function getRelativePosition(defHorizontal,defVertical,toDefWidth,toDefHeight,toCurrentWidth,toCurrentHeight)
{
	return [getScale(defHorizontal,toDefWidth) * toCurrentWidth, getScale(defVertical,toDefHeight) * toCurrentHeight];
}

//Useful for elements that should scale and position together in a heirachy. For example: this is extremely useful for character editors.
function scaleGroup()
{
	this.addScaleVal=1.0;

	this.defWidth=0;
	this.defHeight=0;
	this.defHorizontal=0;
	this.defVertical=0;
	this.currentWidth=0;
	this.currentHeight=0;
	this.currentHorizontal=0;
	this.currentVertical=0;
	this.parentScaleGroup=null;
	this.childScaleGroups=[];
}

scaleGroup.prototype.addScale=function(scaleVal)
{
	this.addScaleVal=scaleVal;
}



scaleGroup.prototype.setDefWidth=function(width)
{
	this.defWidth=width;
}
scaleGroup.prototype.setDefHeight=function(height)
{
	this.defHeight=height;
}
scaleGroup.prototype.setDefWH=function(width,height)
{
	this.setDefWidth(width);
	this.setDefHeight(height);
}
scaleGroup.prototype.getDefWidth=function()
{
	return this.defWidth;
}
scaleGroup.prototype.getDefHeight=function()
{
	return this.defHeight;
}
scaleGroup.prototype.getDefWH=function()
{
	return [this.getDefWidth(),this.getDefHeight()];
}



scaleGroup.prototype.setCurrentWidth=function(width)
{
	this.currentWidth=width;
}
scaleGroup.prototype.setCurrentHeight=function(height)
{
	this.currentHeight=height;
}
scaleGroup.prototype.setCurrentWH=function(width,height)
{
	this.setCurrentWidth(width);
	this.setCurrentHeight(height);
}
scaleGroup.prototype.getCurrentWidth=function()
{
	return this.currentWidth;
}
scaleGroup.prototype.getCurrentHeight=function()
{
	return this.currentHeight;
}
scaleGroup.prototype.getCurrentWH=function()
{
	return [this.getCurrentWidth(),this.getCurrentHeight()];
}





scaleGroup.prototype.setDefaultHorizontal=function(horizontal)
{
	this.defHorizontal=horizontal;
}
scaleGroup.prototype.setDefaultVertical=function(vertical)
{
	this.defVertical=vertical;
}
scaleGroup.prototype.setDefHV=function(horizontal,vertical)
{
	this.setDefaultHorizontal(horizontal);
	this.setDefaultVertical(vertical);
}

scaleGroup.prototype.getDefaultHorizontal=function()
{
	return this.defHorizontal;
}
scaleGroup.prototype.getDefaultVertical=function()
{
	return this.defVertical;
}
scaleGroup.prototype.getDefHV=function()
{
	return [this.getDefaultHorizontal(),this.getDefaultVertical()];
}






scaleGroup.prototype.setCurrentHorizontal=function(horizontal)
{
	this.currentHorizontal=horizontal;
}
scaleGroup.prototype.setCurrentVertical=function(vertical)
{
	this.currentVertical=vertical;
}
scaleGroup.prototype.setCurrentHV=function(horizontal,vertical)
{
	this.setCurrentHorizontal(horizontal);
	this.setCurrentVertical(vertical);
}
scaleGroup.prototype.getCurrentHorizontal=function()
{
	return this.currentHorizontal;
}

scaleGroup.prototype.getCurrentVertical=function()
{ 


	return this.currentVertical;
}

scaleGroup.prototype.getCurrentHV=function()
{
	return [this.getCurrentHorizontal(),this.getCurrentVertical()];
}

scaleGroup.prototype.setParent=function(parent)
{
	this.parentScaleGroup=parent;
}

scaleGroup.prototype.addChild=function(child)
{
	child.setParent(this);
	this.childScaleGroups.push(child);
}

scaleGroup.prototype.removeAllChildren=function()
{
	for(var i=0;i<this.childScaleGroups.length;++i)
	{
		this.childScaleGroups[i].setParent(null);
	}

	this.childScaleGroups=[];
}

scaleGroup.prototype.setScale=function(val)
{
	this.addScale=val;
}

scaleGroup.prototype.scale=function()
{
//console.log('this.parentScaleGroup');
//console.log(this.parentScaleGroup);
	if(this.parentScaleGroup!==null)
	{
		this.setCurrentWidth(getScale(this.parentScaleGroup.defWidth,this.defWidth)*this.parentScaleGroup.getCurrentWidth());
		this.setCurrentHeight(getScale(this.parentScaleGroup.defHeight,this.defHeight)*this.parentScaleGroup.getCurrentHeight());
      
		this.setCurrentHorizontal(getScale(this.parentScaleGroup.defWidth,this.defHorizontal)*this.parentScaleGroup.getCurrentWidth());
		this.setCurrentVertical(getScale(this.parentScaleGroup.defHeight,this.defVertical)*this.parentScaleGroup.getCurrentHeight());
	}

	this.setCurrentWidth(this.getCurrentWidth()*this.addScaleVal);
	this.setCurrentHeight(this.getCurrentHeight()*this.addScaleVal);
//Do not apply the scale to the horizontal and vertical. Maybe I should create something to differentiate when to do this and when not to?
	//this.setCurrentHorizontal(this.getCurrentHorizontal()*this.addScaleVal);
	//this.setCurrentVertical(this.getCurrentVertical()*this.addScaleVal);

	for(var i=0;i<this.childScaleGroups.length;++i)this.childScaleGroups[i].scale();
}

//in order to scale, you must provide:
//ITEM TO SCALE:
	//Default Height
	//Default Width
	//Default Left/Right
	//Default Top/Bottom
//SCALED AGAINST ITEM:
	//Default Height
	//Default Width

//Takes an input number and returns an array where [0]= the whole number value of the number and [1]=the decimal portion of the number.
function splitWholeAndDecimal(a)
{
	a=toFloat(a);

	var split=[0,0];

	split[0]=Math.floor(a);
	split[1]=a-split[0];

	return split;
}

//converts the given inches into feet and inches, returns an array [0]=feet,[1]=inches
function inchesToFeetInches(inches)
{
	inches=toFloat(inches);

	return [Math.floor(inches/12),inches%12];
}

//Converts the input value to an integer if it currently is not an integer.
//Take note that there are instances where JavaScript does not differentiate between int and float values!
//a: The input value
//b: The fallback value in the event a can't be converted to an int.
function toInt10(a,b){a=parseInt(a,10);if(isNaN(a)){b=parseInt(b,10);if(isNaN(b))b=0;a=b}return a}

//Takes an input value and converts it to a Float. If it can't be converted then it's set to 0.0
//Take note that there are instances where JavaScript does not differentiate between int and float values!
function toFloat(a){a=parseFloat(a);if(a!==a)a=0.0;return a}

//a: the value to constrain;
//b: the minimum value;
//c: The maximum value;
function constrain(a,b,c){a=toFloat(a);b=toFloat(b);c=toFloat(c);var d;if(b>c){d=b;b=c;c=d}return Math.min(Math.max(a,b),c)}

//Converts the input value to a string if it currently isn't a string
//No error messages. This function will do everything possible to ensure a string is returned, with the furthest fallback being an empty string.
//a: The input value to convert
//b: The default string value to give a if it's not already a string;
function toString(a,b)
{
	if(canBeString(a))return ''+a;
	if(canBeString(b))return ''+b;
	return '';
/*
	if(typeof a!=='string'&&!(a instanceof String))
	{
		if(typeof b!=='string'&&!(a instanceof String))b='';
		a=b;
	}

	return a;
*/
}

//A message object.
msg=function()
{
	this.elements=[];//The elements to print this message to.
	this.console=false;//Print to browser console
	this.alert=false;
	this.messages=[];
	this.print=function()
	{
	}
}



//if(Object.prototype.toString.call(someVar) === '[object Array]' )
//Checks if the input value, a, is an array. If it is, true is returned. If not, false is returned.
function isArray(a)
{
	if(typeof a===null||typeof a==='undefined'||a===null||(a.constructor!==Array))return false;
 
	return true;
}

function toArray(a)
{
	if(!isArray(a))a=[];
	return a;
}

//Convert the input value to an object if it currently isn't (Also takes null and undefined into account since those can be considered objects. This function does not consider those as objects!)
function toObject(a)
{
	if(isObject(a))return a
	return {};
}

//Null and Undefined are not considered objects to this function.
function isObject(a){if(typeof a===null||typeof a==='undefined'||(typeof a!=='object'&&!(a instanceof Object||a instanceof String)))return false;return true}

//Determines if the input value, a, is an instance of b. Always pass in the actual object name for b, ie: "Vertex3D", not "new Vertex3D()"
//a: Input value to test
//b: The object type to test for. Always pass in the actual object name for b, ie: "Vertex3D", not "new Vertex3D()"
function isObjectInstanceType(a,b){if(isObject(a))if(a instanceof b||a.constructor==b||a.constructor.name==b)return true;return false}

//a: The input value to convert to boolean if it currently isn't
//b: The default value to assign to 'a' if 'a' is not a boolean
function toBoolean(a,b){if(typeof b!='boolean')b=false;if(typeof a!='boolean')a=b;return a}

function isFloat(a)
{
	if(toFloat(a)===a)
	{
return true;
	}
return false;

	//return a===+a&&a!==(a|0)
}

function isInt(a)
{
	return a===+a&&a===(a|0)
}

//-------------------
//Arrays
//Most of these functions only work with int indexed arrays.
//-------------------
//Calculate's the average of the numbers in the array
//This array will only use entries that are an explicit match to the function "isFloat". All other entries will be ignored.
function getArrayAverage(a){var a=toArray(a),b=0,c=0,d;for(d=0;d<a.length;++d){if(isFloat(a[d])){b+=a[d];++c}}if(c!=0)return b/c;return c}

//Returns the first index that contains a matching value
//a: the array to search in
//b: The value to search for in a
//Returns -1 if the given value is not in the given array.
function getFirstIndex(a,b){a=toArray(a);for(var i=0;i<a.length;++i)if(a[i]===b)return i;return -1}

//a: The start array
//b: The array to concat to the end of a
function concatArrays(a,b)
{
	a=toArray(a);
	b=toArray(b);
	for(var i=0;i<b.length;++i)a=pushToEndOfArray(a,b[i]);
	return a;
}
//Returns an array of all instainces in array[a] that match a given type[b]. Very useful if you want to ensure the new array only contains a certain type of object
//a: The Array to filter
//b: the type or VALUE to filter, Always pass in the actual object name for b, ie: "Vertex3D", not "new Vertex3D()", or pass in literals like "35435", "'JFIEOJ'", etc.
function arrayFilterType(a,b)
{
	a=toArray(a);
	var c=[],i;

	for(i=0;i<a.length;++i)if(a[i]===b||isObjectInstanceType(a[i],b))pushToEndOfArray(c,a[i])

	return c;
}

//Removes the given value, b, from the array and returns the new array.
//a: the array to search
//b: The value to remove from the array.
function removeFromArray(a,b){a=toArray(a);for(var c=0;c<a.length;++c)if(a[c]===b){d=[];for(var e=0;e<a.length;++e)if(e!==c)d=pushToEndOfArray(d,a[e]);a=d}return a}

//This function assumes the array is an integer indexed array. It will insert b into the c position of the array a.
//a: The array to insert into
//b: The item to insert into the array
//c: The position to insert into the array
function insertIntoArrayAtPosition(a,b,c){a=toArray(a);c=toInt10(c,a.length);if(c<0)c=0;if(c>a.length)c=a.length;a.splice(c,0,b);return a}

//Searches an array to see if the given value is in any of its indexes.
//a: The array to search.
//b: The value to search for.
function isInArray(a,b)
{
	a=toArray(a);

	for(var c=0;c<a.length;++c)if(a[c]===b)return true;
	return false;
}

//Retrieves the first selected radio button. Sometimes more than one can be selected depending on how the page was modified. But that's generally not the intended use of radio buttons, so just get the first one.
function getFirstSelectedRadio(name){var radios=document.getElementsByName(name),result=undefined,i;for(i=0;i<radios.length;++i)if(radios[i].checked){result=radios[i];break}return result}

//Pass in the name of the radio buttons and this function will return the first selected radio value or undefined if there are none. Sometimes more than one can be selected depending on how the page was modified. But that's generally not the intended use of radio buttons, so just get the first one.
function getFirstSelectedRadioVal(name){var radio=getFirstSelectedRadio(name);if(radio!==undefined)radio=radio.value;return radio}

//returns true if the given checkbox is checked or false if it is not or doesn't exist.
function getCheckboxChecked(id)
{
	var checked=false;

	document.getElementById('baseboardonoffcheckbox')
}

//Pushes any value to the end of an array. If the input value is not an array then it's converted to an empty array followed by pushing the value to the end [0 in this specific case.]
//a: the array to insert into
//b: the value to insert onto the end of the array.
function pushToEndOfArray(a,b)
{
	return insertIntoArrayAtPosition(a,b);
}

//<script>
//ready(function(){
//alert('It works!');
//});
//ready(function(){
//alert('Also works!');
//});
//</script>
var ready=(function(){var readyList,DOMContentLoaded,class2type={};class2type["[object Boolean]"]="boolean";class2type["[object Number]"]="number";class2type["[object String]"]="string";class2type["[object Function]"]="function";class2type["[object Array]"]="array";class2type["[object Date]"]="date";class2type["[object RegExp]"]="regexp";class2type["[object Object]"]="object";var ReadyObj={isReady:false,readyWait:1,holdReady:function(hold){if(hold)ReadyObj.readyWait++;else{ReadyObj.ready(true)}},ready:function(wait){if((wait===true&&!--ReadyObj.readyWait)||(wait!==true&&!ReadyObj.isReady)){if(!document.body)return setTimeout(ReadyObj.ready,1);ReadyObj.isReady=true;if(wait!==true&&--ReadyObj.readyWait>0)return;readyList.resolveWith(document,[ReadyObj])}},bindReady:function(){if(readyList)return;readyList=ReadyObj._Deferred();if(document.readyState==="complete")return setTimeout(ReadyObj.ready,1);if(document.addEventListener){document.addEventListener("DOMContentLoaded",DOMContentLoaded,false);window.addEventListener("load",ReadyObj.ready,false)}else if(document.attachEvent){document.attachEvent("onreadystatechange",DOMContentLoaded);window.attachEvent("onload",ReadyObj.ready);var toplevel=false;try{toplevel=window.frameElement==null}catch(e){}if(document.documentElement.doScroll&&toplevel)doScrollCheck()}},
		_Deferred:function()
		{
			var
			callbacks=[],
			fired,
			firing,
			cancelled,
			deferred=
			{
				done:function()
				{
					if(!cancelled)
					{
						var args=arguments,
						i,
						length,
						elem,
						type,
						_fired;
						if(fired)
						{
							_fired=fired;
							fired=0
						}
						for (i=0,length=args.length;i<length;i++)
						{
							elem=args[i];
							type=ReadyObj.type(elem);
							if(type==="array")deferred.done.apply(deferred,elem);
							else if(type==="function")callbacks.push(elem)
						}
						if(_fired)deferred.resolveWith(_fired[0],_fired[1])
					}
					return this
				},
				resolveWith:function(context,args)
				{
					if(!cancelled&&!fired&&!firing)
					{
						args=args||[];
						firing=1;
						try
						{
							while(callbacks[0])callbacks.shift().apply(context,args)
						}
						finally
						{
							fired=[context,args];
							firing=0
						}
					}
					return this
				},
				resolve:function()
				{
					deferred.resolveWith(this,arguments);
					return this
				},
				isResolved:function()
				{
					return !!(firing||fired)
				},
				cancel:function()
				{
					cancelled=1;
					callbacks=[];
					return this
				}
			};
			return deferred
		},
		type:function(obj)
		{
			return obj==null?String(obj):class2type[Object.prototype.toString.call(obj)]||"object"
		}
	}
	function doScrollCheck()
	{
		if(ReadyObj.isReady)return
		try
		{
			document.documentElement.doScroll("left")
		}
		catch(e)
		{
			setTimeout(doScrollCheck,1);
			return
	        }
		ReadyObj.ready()
	}
	if(document.addEventListener)
	{
		DOMContentLoaded=function()
		{
			document.removeEventListener("DOMContentLoaded",DOMContentLoaded,false);
			ReadyObj.ready()
		}
	}
	else if(document.attachEvent)
	{
		DOMContentLoaded=function()
		{
			if (document.readyState==="complete")
			{
				document.detachEvent("onreadystatechange",DOMContentLoaded);
				ReadyObj.ready()
			}
		}
	}
	function ready(fn)
	{
		ReadyObj.bindReady();
		var type=ReadyObj.type(fn);
		readyList.done(fn)
	}
	return ready
})();

//3D//2D
//Determines which direction an array of Vertex3D objects point in 2D space. < 0 === CCW, >= 0 === CW
//points: An array of Vertex3D objects. Any other elements will be ignored.
function determinePointsDirection(points){var vertices=arrayFilterType(points,Vertex3D),i,result=0,last=vertices.length-1,endpoint1;for(i=0;i<=last;++i){if(i===last)endpoint1=0;else{endpoint1=i+1}result+=(vertices[endpoint1].x-vertices[i].x)*(vertices[endpoint1].y+vertices[i].y)}return result}

//Calculates the interrior trinagles of a polygon from the given points.
//points: an array of vertexe3D objects. Any other values will be ignored.
function calculateInteriorTriangles(points){var vertices=arrayFilterType(points,Vertex3D),direction=determinePointsDirection(vertices),outsideEdgeCenter,outsideEdgeSide,triangles=[],point0Index,point1Index=0,point2Index,pointInside,tmpTriangle,unusedCorners,override=false;if(vertices.length>=3){unusedCorners=0;while(vertices.length>=3){if(unusedCorners>=vertices.length)override=true;if(point1Index===0){point0Index=vertices.length-1;point2Index=1}else if(point1Index==vertices.length-1){point0Index=point1Index-1;point2Index=0}else if(point1Index>=vertices.length){point1Index=0;point2Index=1;point0Index=vertices.length-1}else{point0Index=point1Index-1;point2Index=point1Index+1}outsideEdgeCenter=vertices[0].average([vertices[point0Index],vertices[point2Index]]);outsideEdgeSide=sideOfLineSegment(vertices[point0Index],vertices[point1Index],outsideEdgeCenter);pointInside=false;i=0;tmpTriangle=new Triangle3D();tmpTriangle.p1.setX(vertices[point0Index].getX());tmpTriangle.p1.setY(vertices[point0Index].getY());tmpTriangle.p1.setZ(vertices[point0Index].getZ());tmpTriangle.p2.setX(vertices[point1Index].getX());tmpTriangle.p2.setY(vertices[point1Index].getY());tmpTriangle.p2.setZ(vertices[point1Index].getZ());tmpTriangle.p3.setX(vertices[point2Index].getX());tmpTriangle.p3.setY(vertices[point2Index].getY());tmpTriangle.p3.setZ(vertices[point2Index].getZ());while(i<vertices.length){if(tmpTriangle.pointCollides(vertices[i])&&i!==point0Index&&i!==point1Index&&i!==point2Index){pointInside=true;break}++i}if(direction>=0){if((outsideEdgeSide>=0&&!pointInside)||tmpTriangle.area()===0||override){triangles=pushToEndOfArray(triangles,tmpTriangle);vertices.splice(point1Index,1);unusedCorners=0}else{++unusedCorners}}else{if((outsideEdgeSide<0&&!pointInside)||tmpTriangle.area()===0||override){unusedCorners=0;triangles=pushToEndOfArray(triangles,tmpTriangle);vertices.splice(point1Index,1)}else{++unusedCorners}}++point1Index}}return triangles}

//Determines which side of a line segment(Defined by endpoint0 and endpoint1) the point resides on.
//This only works for 2D.
//return: < 0: Left side (if endpoint1 is considered the front and endpoint0 the back, otherwise it's the right side)
//return: > 0: Right side (if endpoint1 is considered the front and endpoint0 the back, otherwise it's the left side)
//return: ===0: point is ON the line.
function sideOfLineSegment(endpoint0,endpoint1,point)
{
	return (point.getX()-endpoint0.getX())*(endpoint1.getY()-endpoint0.getY())-(point.getY()-endpoint0.getY())*(endpoint1.getX()-endpoint0.getX());
}

//Calculates the angle between point1 and point3 where point 2 forms an intersection
//point1: the first endpoint
//point2: the point where the angle will be calculated
//point3: the second endpoint.
function angleDeg(point1,point2,point3)
{
	return acosToDeg(angleRad(point1,point2,point3));
}

//Calculates an angle in radians between the 3 given points.
//point 1: end of the first line segment
//point 2: the point at which the two line segments meet and where the angle will be calculated.
//point 3: end of the second line segment.
function angleRad(point1,point2,point3){if(!isObjectInstanceType(point1,Vertex3D))point1=new Vertex3D();if(!isObjectInstanceType(point2,Vertex3D))point2=new Vertex3D();if(!isObjectInstanceType(point3,Vertex3D))point3=new Vertex3D();var u=point2.calculateVector(point1),v=point2.calculateVector(point3),cos0,div;div=u.distance()*v.distance();if(div===0)cos0=0;else{cos0=(u.dot(v))/(u.distance()*v.distance())}return Math.acos(cos0)}

function acosToDeg(acos)
{
	acos=toFloat(acos);

	return acos*180.0/Math.PI;
}

///Calculating triangles:
//When calculating the triangles you need to keep track of how many triangles were created on a loop. If there were zero then you need to shift all the points one place to the right or left in the array (right->endpoint is now the start, left<-startpoint is now the endpoint and 1 is now 0)
//If going clockwise, the left side is always the outside of the polygon, and the right side is always the inside.

//Canvas
function getCanvasContext(canvas)
{
	if(!isObjectInstanceType(canvas,HTMLCanvasElement))
	{
		return null;
	}

//	console.log(typeof canvas);
}

//Retrieves the cursor's position on the canvas.
function getCursorPixelPositionOnCanvas(canvasContext,event){if(!isObjectInstanceType(canvasContext,CanvasRenderingContext2D))return new Vertex3D();if(!isObjectInstanceType(event,MouseEvent))return new Vertex3D();var rect=canvasContext.canvas.getBoundingClientRect();return new Vertex3D(event.clientX-rect.left,event.clientY-rect.top,0.0)}

function clearCanvas(canvasContext){if(isObjectInstanceType(canvasContext,CanvasRenderingContext2D))canvasContext.clearRect(0,0,canvas.width,canvas.height)}

//This function needs to eventually take getContext('webgl') into consideration
//Get the center pixel of the canvas.
//Will return Vertex3D(0,0,0) if canvas is not an HTMLCanvasElement.
//a: The canvas context [document.getElementById(canvasID).getContext('2d')]
function getCanvasCenterPixel(a){var b=new Vertex3D();if(isObjectInstanceType(a,CanvasRenderingContext2D)){a=a.canvas;b.setX(getArrayAverage([1,a.width]));b.setY(getArrayAverage([1,a.height]))}return b}

function Object3D(name){this.setName(name);this.visible=true,this.owner=null}
Object3D.prototype.setName=function(name){this.name=toString(name)}//Set this object's name
Object3D.prototype.getName=function(name){return this.name}//Retrieve this object's name
Object3D.prototype.show=function(){this.visible=true}//Enable rendering.
Object3D.prototype.hide=function(){this.visible=false}//Disable rendering.

Object3D.prototype.setOwner=function(owner)
{
	this.owner=owner;
}

Object3D.prototype.getOwner=function()
{
	return this.owner;
}


//Triangle3D //Object
function Triangle3D()
{
	Object3D.call(this);

	this.p1=new Vertex3D();
	this.p2=new Vertex3D();
	this.p3=new Vertex3D();
}Triangle3D.prototype=Object.create(Object3D.prototype);

//Determines if the given point collides with the triangle.
//Use the area to determine if it's inside. Calculate the triangle's area and the 3 trinagles formed with the given point.
Triangle3D.prototype.pointCollides=function(point){var thisArea=this.area(),tArea,tri1,tri2,tri3;tri1=new Triangle3D();tri1.p1=point;tri1.p2=this.p1;tri1.p3=this.p2;tri2=new Triangle3D();tri2.p1=point;tri2.p2=this.p2;tri2.p3=this.p3;tri3=new Triangle3D();tri3.p1=point;tri3.p2=this.p3;tri3.p3=this.p1;tArea=tri1.area()+tri2.area()+tri3.area();return nearlyEqual(thisArea,tArea,SALOWELL['FPI'])}

//Get the area of this triangle.
Triangle3D.prototype.area=function(){return 0.5*this.p1.distance(this.p2)*this.p3.distance(this.p2)*Math.sin(angleRad(this.p1,this.p2,this.p3))}

Triangle3D.prototype.render=function(canvasContext,camera)
{
camera.gridPositionToPixelPosition(this,canvasContext);
var renderPoints=[camera.gridPositionToPixelPosition(this.p1,canvasContext),camera.gridPositionToPixelPosition(this.p2,canvasContext),camera.gridPositionToPixelPosition(this.p3,canvasContext)];

canvasContext.beginPath();
canvasContext.moveTo(renderPoints[0].getX(),renderPoints[0].getY());
canvasContext.lineTo(renderPoints[1].getX(),renderPoints[1].getY());
canvasContext.lineTo(renderPoints[2].getX(),renderPoints[2].getY());
canvasContext.closePath();

// the outline
canvasContext.lineWidth = 1;
canvasContext.strokeStyle = '#666666';
canvasContext.lineWidth=1;
canvasContext.stroke();

// the fill color
canvasContext.fillStyle = "#FFCC00";
canvasContext.fill();
}

//Vertex //Object
//This is the vertex object, will be useful for all 2D and 3D operations
function Vertex3D(x,y,z,name)
{
	Object3D.call(this,name);
	this.x=toFloat(x);
	this.y=toFloat(y);
	this.z=toFloat(z);
	this.radius=10.0;

	this.parent = null;//if null, then this vertex stands alone or it is the parent.
	this.synced = [];  //A list of synced vertexes.

	this.render=function(canvasContext,camera)
	{
		if(this.visible)
		{
			var toCanvas=camera.gridPositionToPixelPosition(this,canvasContext);
			canvasContext.strokeStyle="#000000";
			canvasContext.lineWidth=1;
			canvasContext.beginPath();
			canvasContext.arc(toCanvas.x, toCanvas.y, this.radius / 2, 0, 2 * Math.PI);
			canvasContext.stroke();
		}
	}
}Vertex3D.prototype=Object.create(Object3D.prototype);

//subtracts [right] from [this] and returns the result.
Vertex3D.prototype.subtract=function(right){if(!isObjectInstanceType(right,Vertex3D))right=new Vertex3D();return new Vertex3D(this.getX()-right.getX(),this.getY()-right.getY(),this.getZ()-right.getZ())}

//add [right] to [this] and returns the result.
Vertex3D.prototype.add=function(right)
{
	if(!isObjectInstanceType(right,Vertex3D))right=new Vertex3D();
	return new Vertex3D(this.getX()+right.getX(),this.getY()+right.getY(),this.getZ()+right.getZ())
}

//multiplies [scalar] with [this] and returns the resulting vertex/vector.
Vertex3D.prototype.multiply=function(scalar)
{
	scalar=toFloat(scalar);

	return new Vertex3D(this.getX()*scalar,this.getY()*scalar,this.getZ()*scalar)
}

Vertex3D.prototype.normalize=function()
{
	var length=this.distance();

	if(length===0)
	{
		this.setX(1);
		return;
	}

	this.setX(this.getX()/length);
	this.setY(this.getY()/length);
	this.setZ(this.getZ()/length);
}
//Computes and returns the dot product
//right: the right hand operand for the dot product.
Vertex3D.prototype.dot=function(right){return this.getX()*right.getX()+this.getY()*right.getY()+this.getZ()*right.getZ()}

//Takes an input array of vertices and returns a vertex that represents the average(center) of the vertices.
Vertex3D.prototype.average=function(vertices){var count=0,average=new Vertex3D();for(var i=0;i<vertices.length;++i)if(isObjectInstanceType(vertices[i],Vertex3D)){average.setX(average.getX()+vertices[i].getX());average.setY(average.getY()+vertices[i].getY());average.setZ(average.getZ()+vertices[i].getZ());++count}if(count!==0){average.setX(average.getX()/count);average.setY(average.getY()/count);average.setZ(average.getZ()/count)}return average}

//Performs modulus on the input vector.
Vertex3D.prototype.modulus=function(){return Math.sqrt(this.dot(this))}

//Calculates and returns the cross product. [this] is the left hand operand
//right: the right hand operand.
Vertex3D.prototype.cross=function(right){return new Vertex3D(this.getY()*right.getZ()-this.getZ()*right.getY(),this.getZ()*right.getX()-this.getX()*right.getZ(),this.getX()*right.getY()-this.getY()*right.getX())}

Vertex3D.prototype.copyVertexPosition=function(synced){if(isObjectInstanceType(synced,Vertex3D)){var resync=false;if(this.x!=synced.getX()){resync=true;this.x=synced.getX()}if(this.y!=synced.getY()){resync=true;this.y=synced.getY()}if(this.z!=synced.getZ()){resync=true;this.z=synced.getZ()}if(resync)this.syncPositionsToThis()}}
//Syncs all the synced vertexes to this one
Vertex3D.prototype.syncPositionsToThis=function(){for(var i=0;i<this.synced.length;++i)if(this!==this.synced[i])this.synced[i].copyVertexPosition(this)}
//Moves this vertex by moveAmount
Vertex3D.prototype.move=function(moveAmount){if(isObjectInstanceType(moveAmount,Vertex3D)){this.setX(this.getX()+moveAmount.getX());this.setY(this.getY()+moveAmount.getY());this.setZ(this.getZ()+moveAmount.getZ())}}
Vertex3D.prototype.setX=function(x){x=toFloat(x);var resync=false;if(this.x!=x)resync=true;this.x=x;if(resync)this.syncPositionsToThis()}
Vertex3D.prototype.setY=function(y){y=toFloat(y);var resync=false;if(this.y!=y)resync=true;this.y=y;if(resync)this.syncPositionsToThis()}
Vertex3D.prototype.setZ=function(z){z=toFloat(z);var resync=false;if(this.z!=z)resync=true;this.z=z;if(resync)this.syncPositionsToThis()}
Vertex3D.prototype.getX=function(){return this.x}
Vertex3D.prototype.getY=function(){return this.y}
Vertex3D.prototype.getZ=function(){return this.z}
//Traverses all the vertexes to find the absolute parent/base vertex. This function will not return null if this vertex is the parent, instead it will return itself.
Vertex3D.prototype.getAbsoluteParent=function(){var foundVertexes=[],currentParent=this,loopParent=currentParent;while(loopParent!==null&&!isInArray(foundVertexes,loopParent)){foundVertexes=pushToEndOfArray(foundVertexes,loopParent);currentParent=loopParent;loopParent=loopParent.parent}return currentParent}
Vertex3D.prototype.setParent=function(parent){if(isObjectInstanceType(parent,Vertex3D))this.parent=parent}
//Returns the parent vertex or null if this vertex is a parent (if it's a parent, it can be on its own or linked to other vertexes)
Vertex3D.prototype.getParent=function(){return this.parent}
//Syncs this vertex with another. Ensures they both have the same values
Vertex3D.prototype.sync=function(syncVertex){if(!isObjectInstanceType(syncVertex,Vertex3D))return;if(syncVertex===this)return;if(this.alreadySynced(syncVertex))return;var thisParent=this,syncList=syncVertex.synced;syncVertex.synced=[];for(var i=0;i<syncList.length;++i)if(syncVertex!==syncList[i]){syncList[i].synced=[];this.sync(syncList[i])}if(this.getParent()!==null)thisParent=this.getParent();if(!this.alreadySynced(this))this.synced=insertIntoArrayAtPosition(this.synced,this,0);this.synced=pushToEndOfArray(this.synced,syncVertex);syncVertex.setParent(thisParent);for(var i=0;i<this.synced.length;++i)this.synced[i].synced=this.synced.slice();this.syncPositionsToThis()}
//desyncs this vertex from the others it is linked to while keeping the others linked to each other.
Vertex3D.prototype.desync=function(){for(var i=0;i<this.synced.length;++i){if(this.synced[i]!==this){this.synced[i].synced=removeFromArray(this.synced[i].synced,this);if(this.synced[i].synced.length===1){this.synced[i].parent=null;this.synced[i].synced=[]}else if(this.parent===null){this.synced[i].parent=this.synced[1];if(this.synced[i]===this.synced[1])this.synced[i].parent=null}}}this.parent=null;this.synced=[]}
//Checks to see if a given vertex, syncCheck, is already synced to this vertex.
//syncCheck: The vertex to check and see if it's already synced to this.
Vertex3D.prototype.alreadySynced=function(syncCheck){if(isObjectInstanceType(syncCheck,Vertex3D))for(var i=0;i<this.synced.length;++i)if(this.synced[i]===syncCheck)return true;return false}
//calculates and returns a new vector (technically just a Vertex3D) from "this" to "end".
//end: A vertex used to calculate the direction the vector will point away from this vertex
Vertex3D.prototype.calculateVector=function(end){if(!isObjectInstanceType(end,Vertex3D))end=new Vertex3D();return new Vertex3D(end.getX()-this.getX(),end.getY()-this.getY(),end.getZ()-this.getZ())}
//Calculates the distance between this vertex and the input vertex. If you don't provide a vertex it will get the distance of this vertex from the origin (0,0,0)
Vertex3D.prototype.distance=function(vertex){if(!isObjectInstanceType(vertex,Vertex3D))vertex=new Vertex3D();return Math.sqrt(Math.pow(vertex.getX()-this.getX(),2)+Math.pow(vertex.getY()-this.getY(),2)+Math.pow(vertex.getZ()-this.getZ(),2))}
//Scales this vertex towards scaleToPoint so that it is scaleToUnit distance from scaleToPoint. If you do not provide a scaleToPoint then this vertex will be scaled to the origin as a vector would be.
Vertex3D.prototype.scaleToDistance=function(scaleToUnit,scaleToPoint){scaleToUnit=toFloat(scaleToUnit);if(!isObjectInstanceType(scaleToPoint,Vertex3D))scaleToPoint=new Vertex3D();this.setX(this.getX()-scaleToPoint.getX());this.setY(this.getY()-scaleToPoint.getY());this.setZ(this.getZ()-scaleToPoint.getZ());var currentLength=this.distance(),multiply=0;if(currentLength!==0)multiply=scaleToUnit/currentLength;this.setX(this.getX()*multiply+scaleToPoint.getX());this.setY(this.getY()*multiply+scaleToPoint.getY());this.setZ(this.getZ()*multiply+scaleToPoint.getZ())}

//Spatial3D //Object
function Spatial3D()
{
	Object3D.call(this,'');

//S.A. Lowell: Not Implemented Yet
	//this.scale=new Vertex3D();

	this.translation=new Vertex3D();
}Spatial3D.prototype=Object.create(Object3D.prototype);

//LineSegment3D //Object
function LineSegment3D()
{
	Spatial3D.call(this);
	this.endpoints=[new Vertex3D(),new Vertex3D()];
//this.endpoints[0].prototype.setParent(this);
	this.endpoints[0].setOwner(this);
	this.endpoints[1].setOwner(this);
}LineSegment3D.prototype=Object.create(Spatial3D.prototype);

//Flips the lines direction (Technically this just swaps the endpoints of this line segment).
LineSegment3D.prototype.flip=function()
{
	var tmp=this.endpoints[0];
	this.endpoints[0]=this.endpoints[1];
	this.endpoints[1]=tmp;
}
//Calculates which axis this line's side is mostly pointing towards, but only for the x and y axis (2D) The Z axis does not factor in to this calculation. The return value is a vector normalized entirely in the resulting axis direction (1,0,0)[x] or (0,1,0)[y]
LineSegment3D.prototype.getDominantNormalAxis2D=function(){var vertex=this.getEndpoint(0).subtract(this.getEndpoint(1));vertex.setX(Math.abs(vertex.getX()));vertex.setY(Math.abs(vertex.getY()));if(vertex.getX()>vertex.getY())return new Vertex3D(0,1,0);return new Vertex3D(1,0,0)}

//generates a 2D normal for the line that's perpendicular to the line itself. This is only for the X and Y coordinates.
LineSegment3D.prototype.getPNormal2D=function(){var pointOutsideOfLine=this.getEndpoint(0).add(this.getDominantNormalAxis2D());var pointOnLine=this.closestPointOnLine(pointOutsideOfLine);var normal=pointOnLine.calculateVector(pointOutsideOfLine);normal.scaleToDistance(1);return normal}

//Calculates and returns the center point of the line segment.
LineSegment3D.prototype.center=function()
{
	var center=new Vertex3D(),endpoints=[this.getEndpoint(0),this.getEndpoint(1)];
	center.setX((endpoints[0].getX()+endpoints[1].getX())/2);
	center.setY((endpoints[0].getY()+endpoints[1].getY())/2);
	center.setZ((endpoints[0].getZ()+endpoints[1].getZ())/2);

	return center;
}

LineSegment3D.prototype.getLength=function(){return this.endpoints[0].distance(this.endpoints[1])}

//Projects the given vertex onto the closest point on this line segment.
LineSegment3D.prototype.distance=function(vertex){var endpoints=[this.getEndpoint(0),this.getEndpoint(1)],ab=endpoints[1].subtract(endpoints[0]),av=vertex.subtract(endpoints[0]),bv;if(av.dot(ab)<=0)return av.modulus();bv=vertex.subtract(endpoints[1]);if(bv.dot(ab)>=0)return bv.modulus();return (ab.cross(av)).modulus()/ab.modulus()}

//Calculates the closest point on the line in which this line segment resides, which can technically be outside of this line segment.
LineSegment3D.prototype.closestPointOnLine=function(vertex){if(!isObjectInstanceType(vertex,Vertex3D))vertex=new Vertex3D();var linePnt=new Vertex3D(),v,d;linePnt.copyVertexPosition(this.getEndpoint(0));lineDir=linePnt.calculateVector(this.getEndpoint(1));lineDir.normalize();v=vertex.subtract(linePnt);d=v.dot(lineDir);lineDir.setX(lineDir.getX()*d);lineDir.setY(lineDir.getY()*d);lineDir.setZ(lineDir.getZ()*d);linePnt.setX(linePnt.getX()+lineDir.getX());linePnt.setY(linePnt.getY()+lineDir.getY());linePnt.setZ(linePnt.getZ()+lineDir.getZ());return linePnt}

//Calculates the closest point on the line segment to the given point.
LineSegment3D.prototype.closestPoint=function(vertex){var linePnt=this.closestPointOnLine(vertex),point0Dist=this.getEndpoint(0).distance(linePnt),point1Dist=this.getEndpoint(1).distance(linePnt);if(point0Dist>this.getLength()||point1Dist>this.getLength()){if(point0Dist>point1Dist)linePnt.copyVertexPosition(this.getEndpoint(1));else{linePnt.copyVertexPosition(this.getEndpoint(0))}}return linePnt}

//Subdivides a line segment.
//[this] line segment will be set at the [from] to [distance] point and the new/returned LineSegment will be set at [distance] to the opposite endpoint of [from]
//If the distance input is equal to or less than zero, a new LineSegment3D is created at the "from" endpoint with zero length
//If the distance input is equal to or greater than the line segment's length then a new LineSegment3D is created at the opposite endpoint with zero length.
//[this] LineSegment will be set to the endpoint[to] up to the new point that is [distance] away from to.
//The new LineSegment3D will be set from the new/division endpoint up to the opposite endpoint of "from"
//from: the side/endpoint where this split begins [0 or 1]
//distance: The distance from the "from" endpoint where the split begins. If this point lies beyond the line segment then a new segment is simply created outside of this line segment.
LineSegment3D.prototype.subdivide=function(from,distance){from=toInt10(from);distance=toFloat(distance);length=this.getLength();if(distance>length)distance=length;else if(distance<0)distance=0;from=this.toEndpointInt(from);var fromTo,vector,to;if(from===0){to=1;fromTo=[this.getEndpoint(0),this.getEndpoint(1)]}else{to=0;fromTo=[this.getEndpoint(1),this.getEndpoint(0)]}vector=fromTo[0].calculateVector(fromTo[1]);vector.scaleToDistance(distance);var lineSeg=new LineSegment3D();vector.setX(vector.getX()+fromTo[0].getX());vector.setY(vector.getY()+fromTo[0].getY());vector.setZ(vector.getZ()+fromTo[0].getZ());lineSeg.setEndpointPosition(0,vector);lineSeg.setEndpointPosition(1,fromTo[1]);this.setEndpointPosition(to,vector);return lineSeg}

//does the same thing as this.subdivide but it ALSO readjusts all the linked vertexes. The new LineSegment3D will also be returned.
LineSegment3D.prototype.subdivideAndRelink=function(from,distance)
{
	from=this.toEndpointInt(from);
	var to,endpoints,synced;

	if(from===0)
	{
		to=1;
//endpoints=[this.getEndpoint(1),this.getEndpoint(0)]
		endpoints=[this.getEndpoint(0),this.getEndpoint(1)]
	}
	else
	{
		to=0;
//endpoints=[this.getEndpoint(0),this.getEndpoint(1)]
		endpoints=[this.getEndpoint(1),this.getEndpoint(0)]
	}

	synced=endpoints[1].synced.slice();
	endpoints[1].desync();
	synced=removeFromArray(synced,endpoints[1]);
	var lineSeg=this.subdivide(from,distance);
	lineSeg.getEndpoint(0).sync(endpoints[1]);
	var lineSegEndpoint=lineSeg.getEndpoint(1);
	for(var i=0;i<synced.length;++i)lineSegEndpoint.sync(synced[i]);
	return lineSeg
}

//sets the position of the given endpoint
//endpoint: the endpoint, 0 = first ending, 1 = last endpoint.
LineSegment3D.prototype.setEndpointPosition=function(endpoint,position){endpoint=this.toEndpointInt(endpoint);if(!isObjectInstanceType(position,Vertex3D))position=new Vertex3D();this.getEndpoint(endpoint).copyVertexPosition(position)}

//moves the given endpoint[0 or 1] along the LineSegment's line by distance.
//endpoint: the endpoint, 0 = first ending, 1 = last endpoing.
//distance: how far the endpoint will slide across the line segment.
LineSegment3D.prototype.slideEndpointByDistance=function(endpoint,distance){distance=toFloat(distance);endpoint=this.toEndpointInt(endpoint);var endPoints,vector;if(endpoint===0)endPoints=[this.getEndpoint(0),this.getEndpoint(1)];else{endPoints=[this.getEndpoint(1),this.getEndpoint(0)]}vector=endPoints[0].calculateVector(endPoints[1]);vector.scaleToDistance(distance);endPoints[0].setX(endPoints[0].getX()+vector.getX());endPoints[0].setY(endPoints[0].getY()+vector.getY());endPoints[0].setZ(endPoints[0].getZ()+vector.getZ())}

//Simply constrains the input value to 0 or 1, which can be mapped to endpoint selectors.
LineSegment3D.prototype.toEndpointInt=function(endpoint){endpoint=toInt10(endpoint);if(endpoint<0)endpoint=0;else if(endpoint>1)endpoint=1;return endpoint}

//endpoint: the endpoint, 0 = first ending, 1 = last endpoing.
LineSegment3D.prototype.getEndpoint=function(endpoint){return this.endpoints[this.toEndpointInt(endpoint)]}

LineSegment3D.prototype.render=function(canvasContext,camera)
{
	var endpoint0=camera.gridPositionToPixelPosition(this.getEndpoint(0),canvasContext),
	endpoint1=camera.gridPositionToPixelPosition(this.getEndpoint(1),canvasContext);

	canvasContext.beginPath();
	canvasContext.strokeStyle="#000000";
	canvasContext.lineWidth=1;
	canvasContext.moveTo(endpoint0.getX(), endpoint0.getY());
	canvasContext.lineTo(endpoint1.getX(), endpoint1.getY());
	canvasContext.stroke();

	this.getEndpoint(0).render(canvasContext,camera);
	this.getEndpoint(1).render(canvasContext,camera);
}

//Collider3D //Object
function Collider3D()
{
	Spatial3D.call(this);
	this.extend=0;//How far this collider should extend(in or out) beyond its calculated size.
}
Collider3D.prototype=new Spatial3D();
Collider3D.prototype.pointCollides=function(){return false}

function RectangleCollider3D()
{
	Collider3D.call(this);
	this.points=[new Vertex3D(),new Vertex3D()];
	this.extend=[this.extend,0,0];
this.extend=[20,20,0];
	this.visible=false;
}
RectangleCollider3D.prototype=Object.create(Collider3D.prototype);

//returns the center of the collider
RectangleCollider3D.prototype.center=function()
{
	return this.points[0].average([this.points[0],this.points[1],this.points[2],this.points[3]]);
}


//Need to eventually calculate with rotations? Or maybe I'll keep this always static?
RectangleCollider3D.prototype.calculateFromPoints=function(pointsArray){pointsArray=arrayFilterType(pointsArray,Vertex3D);for(var i=0;i<pointsArray.length;++i){if(i===0){this.points[0].setX(pointsArray[i].getX());this.points[0].setY(pointsArray[i].getY());this.points[0].setZ(pointsArray[i].getZ());this.points[1].setX(pointsArray[i].getX());this.points[1].setY(pointsArray[i].getY());this.points[1].setZ(pointsArray[i].getZ())}else{if(pointsArray[i].getX()<this.points[0].getX())this.points[0].setX(pointsArray[i].getX());if(pointsArray[i].getY()>this.points[0].getY())this.points[0].setY(pointsArray[i].getY());if(pointsArray[i].getZ()>this.points[0].getZ())this.points[0].setZ(pointsArray[i].getZ());if(pointsArray[i].getX()>this.points[1].getX())this.points[1].setX(pointsArray[i].getX());if(pointsArray[i].getY()<this.points[1].getY())this.points[1].setY(pointsArray[i].getY());if(pointsArray[i].getZ()<this.points[1].getZ())this.points[1].setZ(pointsArray[i].getZ())}}this.points[0].setX(this.points[0].getX()-this.extend[0]);this.points[0].setY(this.points[0].getY()+this.extend[1]);this.points[0].setZ(this.points[0].getZ()+this.extend[2]);this.points[1].setX(this.points[1].getX()+this.extend[0]);this.points[1].setY(this.points[1].getY()-this.extend[1]);this.points[1].setZ(this.points[1].getZ()-this.extend[2])}

RectangleCollider3D.prototype.render=function(canvasContext,camera)
{
	if(this.visible)
	{
		var point0=camera.gridPositionToPixelPosition(this.points[0],canvasContext),point1=camera.gridPositionToPixelPosition(this.points[1],canvasContext);
		canvasContext.strokeStyle="#ff0000";
		canvasContext.lineWidth=1;
		canvasContext.rect(point0.getX(),point1.getY(),point1.getX()-point0.getX(),point0.getY()-point1.getY());
		canvasContext.stroke()
	}
}

RectangleCollider3D.prototype.pointCollides=function(point){if(!isObjectInstanceType(point,Vertex3D))point=new Vertex3D();if(point.getX()>=this.points[0].getX()&&point.getY()<=this.points[0].getY()&&point.getX()<=this.points[1].getX()&&point.getY()>=this.points[1].getY())return true;return false}

function CircleCollider3D()
{
	Collider3D.call(this);
	this.radius=1;
	this.visible=false;
}
CircleCollider3D.prototype=new Collider3D();

CircleCollider3D.prototype.setRadius=function(radius)
{
	radius=toInt10(radius);

	this.radius=radius;
}

CircleCollider3D.prototype.getRadius=function()
{
	return this.radius;
}

//Camera //Object
function Camera3D()
{
	Spatial3D.call(this);
	this.zoom=1.0;
	this.focus=new Vertex3D(0.0,0.0,0.0);//Grid focus point, this will also be dead center of the canvas (AKA, this is the grid point that is at the center of the canvas)
	this.position=new Vertex3D(0.0,0.0,-1.0);//Grid position, this will also be dead center of the canvas (Excluding Z)
}
Camera3D.prototype=new Spatial3D();
//determines of the number of pixels per 1 unit
Camera3D.prototype.getUnitsPerPixel=function(){return 1.0/this.zoom}
//retrives how long (number of pixels) a unit is relative to this camera's zoom. (Technically it's the same value as the zoom, but lets keep this function, as my comment here is also valuable)
Camera3D.prototype.getPixelsPerUnit=function(){return this.zoom}
Camera3D.prototype.slide=function(slideAmount){var unitPerPixel=this.getPixelsPerUnit();this.focus.setX(this.focus.getX()-slideAmount.getX()/unitPerPixel);this.focus.setY(this.focus.getY()-slideAmount.getY()/unitPerPixel);this.focus.setZ(this.focus.getZ()-slideAmount.getZ()/unitPerPixel);this.position.setX(this.focus.getX());this.position.setY(this.focus.getY());this.position.setZ(this.focus.getZ())}
Camera3D.prototype.zoomOut=function(){if(this.zoom<=0.001953125)this.zoom=0.001953125;else{this.zoom*=0.5}}
Camera3D.prototype.zoomIn=function(){if(this.zoom>=512.0)this.zoom=512.0;else{this.zoom*=2.0}}
//Converts a pixel Vertex to a grid Vertex
Camera3D.prototype.canvasPositionToGridPosition=function(pixelPosition,canvasContext){var gridsOriginPosition=this.getGridsOriginPositionOnCanvas(canvasContext),inchesPerPixel=this.getUnitsPerPixel();return new Vertex3D((pixelPosition.getX()-gridsOriginPosition.getX())*inchesPerPixel,(gridsOriginPosition.getY()-pixelPosition.getY())*inchesPerPixel,0)}
Camera3D.prototype.gridPositionToPixelPosition=function(gridPosition,canvasContext){if(!isObjectInstanceType(gridPosition,Vertex3D))gridPosition=new Vertex3D();var gridsOriginPosition=this.getGridsOriginPositionOnCanvas(canvasContext),pixelsPerInch=this.getPixelsPerUnit();return new Vertex3D(gridsOriginPosition.getX()+gridPosition.getX()*pixelsPerInch,gridsOriginPosition.getY()-gridPosition.getY()*pixelsPerInch,0)}
//Gets the grid's origin position on the canvas (AKA, which pixel position contains the grid's origin)
Camera3D.prototype.getGridsOriginPositionOnCanvas=function(canvasContext){var canvasCenterPixel=getCanvasCenterPixel(canvasContext),pixelsPerUnit=camera.getPixelsPerUnit();return new Vertex3D(canvasCenterPixel.getX()-this.focus.getX()*pixelsPerUnit,canvasCenterPixel.getY()-this.focus.getY()*pixelsPerUnit,canvasCenterPixel.getZ()-this.focus.getZ()*pixelsPerUnit)}
//Rounds a canvas Vertex to the closest grid vertex()
Camera3D.prototype.roundCanvasToGrid=function(canvasVertex,canvasContext){gridPosition=this.canvasPositionToGridPosition(canvasVertex,canvasContext);gridPosition.setX(Math.round(gridPosition.getX()));gridPosition.setY(Math.round(gridPosition.getY()));gridPosition.setZ(Math.round(gridPosition.getZ()));return gridPosition}