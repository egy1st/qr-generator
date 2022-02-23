function setCookie(c_name,value,exdays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}

function getCookie(c_name)
{
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++)
	{
		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x=x.replace(/^\s+|\s+$/g,"");
		if (x==c_name)
		{
			return unescape(y);
		}
	}
}

function checkCookie()
{
var forered = parseInt(getCookie("fore_red_val"));
var foregreen = parseInt(getCookie("fore_green_val"));
var foreblue = parseInt(getCookie("fore_blue_val"));

var backred = parseInt(getCookie("back_red_val"));
var backgreen = parseInt(getCookie("back_green_val"));
var backblue = parseInt(getCookie("back_blue_val"));

alert("Checking") ;
  if (forered !=null && foregreen !=null && foreblue !=null )
  {
  	
	forehex = hexFromRGB( forered, foregreen, foreblue );
	backhex = hexFromRGB( backred, backgreen, backblue );
	$( "#swatch-backcolor" ).css( "background-color", "#" + backhex );
	$( "#swatch-forecolor" ).css( "background-color", "#" + forehex );
  }
else
  {
    setCookie('fore_red_val', 0, 30);
	setCookie('fore_green_val', 0, 30);
	setCookie('fore_blue_val', 0, 30);
	
	setCookie('back_red_val', 0, 30);
	setCookie('back_green_val', 0, 30);
	setCookie('back_blue_val', 0, 30);
  }
}

function setSlider(mode)
{
alert("Click") ;

if (mode == 'fore'){
 red = parseInt(getCookie("fore_red_val"));
 if (red == null  ){
  red = 0 ;
  //setCookie('fore_red_val', red, 30); 
  }
 
green = parseInt(getCookie("fore_green_val")); 
if (green == null ){
  green = 0;
  //setCookie('fore_green_val', green, 30);
  }

  blue = parseInt(getCookie("fore_blue_val"));
if (blue == null ){
  blue = 0;
   //setCookie('fore_blue_val', blue, 30);
   }
   
 //alert (red + " " + green + " " + blue );
$( "#red" ).slider({
value:  red 	}  );
$( "#green" ).slider({
value:  green 	}  );
$( "#blue" ).slider({
value:  blue 	}  );

}

else if (mode == 'back'){


 red = parseInt(getCookie("back_red_val"));
 if (red == null  ){
  red = 0 ;
  //setCookie('back_red_val', red, 30); 
  }
 
green = parseInt(getCookie("back_green_val")); 
if (green == null ){
  green = 0;
  //setCookie('back_green_val', green, 30); 
  }

  blue = parseInt(getCookie("back_blue_val"));
if (blue == null ){
  blue = 0;
   //setCookie('back_blue_val', blue, 30); 
   }
  
$( "#red" ).slider({
value:  red 	}  );
$( "#green" ).slider({
value:  green 	}  );
$( "#blue" ).slider({
value:  blue 	}  );


//alert (red + " " + green + " " + blue );
}
  	
}


function hexFromRGB(r, g, b) {
	var hex = [
	r.toString( 16 ),
	g.toString( 16 ),
	b.toString( 16 )
	];
	$.each( hex, function( nr, val ) {
		if ( val.length === 1 ) {
			hex[ nr ] = "0" + val;
		}
	});
	return hex.join( "" ).toUpperCase();
}

function hexFromRGB2(r, g, b) {
	return componentToHex(r) + componentToHex(g) + componentToHex(b);
}

function componentToHex(c) {
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}

function refreshSwatch() {
	alert("Refresh") ;
	red = $( "#red" ).slider( "value" ),
	green = $( "#green" ).slider( "value" ),
	blue = $( "#blue" ).slider( "value" ),
	hex = hexFromRGB( red, green, blue );
	if(document.getElementById('backgr-color').checked == true) {
		$( "#swatch-backcolor" ).css( "background-color", "#" + hex );
		setCookie('back_red_val', red,30);
	    setCookie('back_green_val', green,30);
		setCookie('back_blue_val', blue,30);
	
	}else if(document.getElementById('fore-color').checked == true) {
		$( "#swatch-forecolor" ).css( "background-color", "#" + hex );
		setCookie('fore_red_val', red,30);
	    setCookie('fore_green_val', green,30);
		setCookie('fore_blue_val', blue,30);
	
	}
	
}


function getColorVal(color)
{
	
	if(document.getElementById('backgr-color').checked) {
	  if(color == 'red') return getCookie('back_red_val');
	  else if(color == 'green') return getCookie('back_green_val') ; 
	  else if(color == 'blue') return getCookie('back_blue_val') ;
		
	}else if(document.getElementById('fore-color').checked) {
		if(color == 'red') return getCookie('fore_red_val');
	    else if(color == 'green') return getCookie('fore_green_val') ; 
	    else if(color == 'blue') return getCookie('fore_blue_val') ;
	}
}

$(function() {
	$( "#red" ).slider({
orientation: "horizontal",
range: "min",
max: 255,
value:  getColorVal('red'),
animate: true,
slide: refreshSwatch,
change: refreshSwatch,
		
slide: function( event, ui ) {
			
		 }
	}
 );
	
	
	$( "#green" ).slider({
orientation: "horizontal",
range: "min",
max: 255,
value:  getColorVal('green'),
animate: true,
slide: refreshSwatch,
change: refreshSwatch,
		
slide: function( event, ui ) {
			
		 }
	}
 );
 
 
 $( "#blue" ).slider({
orientation: "horizontal",
range: "min",
max: 255,
		
value:  getColorVal('blue'),
animate: true,
slide: refreshSwatch,
change: refreshSwatch,
		
slide: function( event, ui ) {
		 }
	}
 );
 
 
	});

$(function() {
		$( "#slider-margin" ).slider({
			orientation: "vertical",
			range: "min",
			min: 0,
			max: 12,
			value: 4,
			animate: true,
			slide: 	handleSliderChange
		
		});
		
		setCookie("margin",4,30);
	
	
	});

function handleSliderChange(event, slider){
        $('#widget div.mini').css('width', 240 - (slider.value* 8) );
        $('#widget div.mini').css('height', 240 - (slider.value* 8) );
		$('#widget div.mini').css('margin-left',  (slider.value* 4) );
		$('#widget div.mini').css('margin-top', (slider.value* 4) );
		setCookie("margin",slider.value,30);
						
    }
	

