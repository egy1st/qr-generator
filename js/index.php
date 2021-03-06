<!DOCTYPE html>
<?php 
if (isset($_GET['webstyle'])) { 
	$theme = $_GET['webstyle']; 
	if ($theme != "" ) { 
		setcookie("webstyle", $theme, time()+60*60*24*100, "/"); // COOKIE SET FOR 30 DAYS
		header("location: index.php"); 
		exit(); 
	}
}
?>
<?php 
include 'css_cookie.php'; // Check if the user has a style cookie
?>

<html lang="en">
<head>
<title>QR Code</title>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="style/<?php echo $default_theme; ?>/jquery-ui.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/style.css" />
<script src="js/jquery-1.9.0.js"></script>
<script src="js/ui/jquery.ui.core.js"></script>
<script src="js/ui/jquery.ui.widget.js"></script>
<script src="js/ui/jquery.ui.mouse.js"></script>
<script src="js/ui/jquery.ui.slider.js"></script>
<style  type="text/css"> 
#header-content { position: absolute; bottom: 0; left: 0; }	
#widget { width: 240px; height: 240px; display: inline-table; border: 1px solid #ccc;   }
#widget div { width: 200px; height: 200px; margin-left: 20px; margin-top: 20px; border: 1px solid #ccc;  }
#widget div.mini { width: 160px; height: 160px; margin-left: 20px; margin-top: 20px; border: 1px solid #ccc;  }
#red, #green, #blue {
float: left;
clear: left;
width: 300px;
margin: 15px;
}
#swatch {
width: 150px;
height: 150px;
	margin-top: 18px;
	margin-left: 350px;
	background-image: none;
}
#swatch2 {
width: 200px;
height: 200px;
	margin-top: 18px;
	margin-left: 350px;
	background-image: none;
}
#red .ui-slider-range { background: #ef2929; }
#red .ui-slider-handle { border-color: #ef2929; }
#green .ui-slider-range { background: #8ae234; }
#green .ui-slider-handle { border-color: #8ae234; }
#blue .ui-slider-range { background: #729fcf; }
#blue .ui-slider-handle { border-color: #729fcf; }
</style>


<script LANGUAGE="JavaScript">

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

function refreshSwatch() {
	var red = $( "#red" ).slider( "value" ),
	green = $( "#green" ).slider( "value" ),
	blue = $( "#blue" ).slider( "value" ),
	hex = hexFromRGB( red, green, blue );
	hex2 = hexFromRGB( 0, 0, blue );
	if(document.getElementById('backgr-color').checked) {
		$( "#swatch" ).css( "background-color", "#" + hex );
		setCookie('back_red_val', red,30)
	setCookie('back_blue_val', blue,30)
	setCookie('back_green_val', green,30)
	
	}else if(document.getElementById('fore-color').checked) {
		$( "#swatch2" ).css( "background-color", "#" + hex );
		setCookie('fore_red_val', red,30)
	setCookie('fore_blue_val', blue,30)
	setCookie('fore_green_val', green,30)
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
slide: refreshSwatch,
change: refreshSwatch,
		
slide: function( event, ui ) {
			
			
		}
	});
	
	$( "#green" ).slider({
orientation: "horizontal",
range: "min",
max: 255,
value:  getColorVal('green'),
slide: refreshSwatch,
change: refreshSwatch,
		
slide: function( event, ui ) {
			//$( "#amount_green" ).val( ui.value );
			
		}
	});
	



$(function() {
		$( "#slider-vertical" ).slider({
			orientation: "vertical",
			range: "min",
			min: 0,
			max: 4,
			value: 2,
			slide: function( event, ui ) {
				$( "#amount" ).val( ui.value );
			}
		});
		$( "#amount" ).val( $( "#slider-vertical" ).slider( "value" ) );
	});

	
	
}
);
</script>
</head>
<body>
<p class="ui-state-default ui-corner-all ui-helper-clearfix" style="padding:4px;">
<span class="ui-icon ui-icon-pencil" style="float:left; margin:-2px 5px 0 0;"></span>
Choose your QR Style
</p>


<table class="table">
<tbody>
<tr class="success">
<td></td>
<td><a href="index.php?webstyle=base">Base</a></td>
<td><a href="index.php?webstyle=black-tie">Black Tie</a></td>
<td><a href="index.php?webstyle=blitzer">Blitzer</a></td>
<td><a href="index.php?webstyle=cupertino">Cupertino</a></td>
<td><a href="index.php?webstyle=dark-hive">Dark Hive</a></td>
<td><a href="index.php?webstyle=dot-luv">Cupertino</a></td>
<td><a href="index.php?webstyle=cupertino">Egg Plant</a></td>
<td><a href="index.php?webstyle=cupertino">Excite Bike</a></td>
<td><a href="index.php?webstyle=flick">Flick</a></td>
<td></td>
</tr>
<tr class="warning">
<td></td>
<td><a href="index.php?webstyle=hot-sneaks">Hot Sneaks</a></td>
<td><a href="index.php?webstyle=humanity">Humanity</a></td>
<td><a href="index.php?webstyle=le-frog">Le Frog</a></td>
<td><a href="index.php?webstyle=mint-choc">Mint Choc</a></td>
<td><a href="index.php?webstyle=overcast">Overcast</a></td>
<td><a href="index.php?webstyle=pepper-grinder">Pepper Grinder</a></td>
<td><a href="index.php?webstyle=redmond">Redmond</a></td>
<td><a href="index.php?webstyle=smoothness">Smoothness</a></td>
<td><a href="index.php?webstyle=south-street">South Street</a></td>
<td></td>
</tr>
<tr class="info">
<td></td>
<td><a href="index.php?webstyle=start">Start</a></td>
<td><a href="index.php?webstyle=sunny">Sunny</a></td>
<td><a href="index.php?webstyle=swanky-purse">Swanky Purse</a></td>
<td><a href="index.php?webstyle=trontastic">Trontastic</a></td>
<td><a href="index.php?webstyle=ui-darkness">UI Darkness</a></td>
<td><a href="index.php?webstyle=ui-lightness">UI Lightness</a></td>
<td><a href="index.php?webstyle=vader">Vader</a></td>
<td></td>
<td></td>
<td></td>
</tr>
</tbody>
</table>

<p class="ui-state-default ui-corner-all ui-helper-clearfix" style="padding:4px;">
<span class="ui-icon ui-icon-pencil" style="float:left; margin:-2px 5px 0 0;"></span>
Choose your QR Color Scheme
</p>

<table class="table">
<tbody>
<tr class="">
<td><div class="control-group">
<div class="controls wide">
<input type="radio" id="backgr-color" name="backgr" value="backgr-color"  /><label for="backgr-color">Set Background Color</label>
<input type="radio" id="fore-color" name="backgr" value ="fore-color" checked /><label for="fore-color">Set Fore Color</label></label>
</div>
</div>
</td>
<td rowspan="2"><div id="widget">  
<div id="swatch"><div id="swatch2" class="mini"></div></div>
</div>
</td>
</tr>
<tr class="">
<td><div id="red"></div>
<div id="green"></div>
<div id="blue"></div></td>
</tr>
</tbody>
</table>




<p class="ui-state-default ui-corner-all ui-helper-clearfix" style="padding:4px;">
<span class="ui-icon ui-icon-pencil" style="float:left; margin:-2px 5px 0 0;"></span>
Enter data to encode using QR
</p>
<div align='center'><h1>Bootstrap QR Generator Demo</h1></div>
<div class="container">
<div id="tabs">
<ul>
<li><a href="#tabs-1">Contact Information</a></li>
<li><a href="#tabs-2">Email</a></li>
<li><a href="#tabs-3">Phone Number</a></li>
<li><a href="#tabs-4">Geo Location</a></li>
<li><a href="#tabs-5">SMS</a></li>
<li><a href="#tabs-6">Message</a></li>
<li><a href="#tabs-7">URL</a></li>
<li><a href="#tabs-8">Wifi network</a></li>
<li><a href="#tabs-9">Calendar Event</a></li>
</ul>
<div id="tabs-1">
<div class="row">
<form id="contact" class="form-horizontal">
<div class="span4">
<div class="control-group">
<label class="control-label" for="name">Name:</label>
<div class="controls">
<input type="text" id="name" name="name" class="tiny required">
</div>
</div>
<div class="control-group">
<label class="control-label" for="company">Company:</label>
<div class="controls">
<input type="text" id="company" name="company" class="tiny">
</div>
</div>
<div class="control-group">
<label class="control-label" for="title">Title:</label>
<div class="controls">
<input type="text" id="title" name="title" class="tiny">
</div>
</div>
<div class="control-group">
<label class="control-label" for="pnum">Phone number:</label>
<div class="controls">
<input type="text" id="pnum" name="pnum" class="tiny digits">
</div>
</div>
<div class="control-group">
<label class="control-label" for="email">Email:</label>
<div class="controls">
<input type="text" id="email" name="email" class="tiny email">
</div>
</div>
<div class="control-group">
<label class="control-label" for="address">Address:</label>
<div class="controls">
<input type="text" id="address" name="address" class="tiny">
</div>
</div>
<div class="control-group">
<label class="control-label" for="address2">Address 2:</label>
<div class="controls">
<input type="text" id="address2" name="address2" class="tiny">
</div>
</div>
<div class="control-group">
<label class="control-label" for="website">Website:</label>
<div class="controls">
<input type="text" id="website" name="website" class="tiny url">
</div>
</div>
<div class="control-group">
<label class="control-label" for="memo">Memo:</label>
<div class="controls">
<input type="text" id="memo" name="memo" class="tiny">
</div>
</div>
<div class="control-group">
<label class="control-label  middle" for="encoding">Encoding:</label>
<div class="controls wide">
<input type="radio" id="radio1" name="encoding" value="vCard" checked="checked" /><label for="radio1">vCard</label>
<input type="radio" id="radio2" name="encoding" value ="MECARD" /><label for="radio2">MECARD</label>
</div>
</div>
<?php echo chart_config(90); ?>
<div class="control-group">
<div class="controls">
<input type="hidden" name="type" value="contact" />
<input type="hidden" name="size" id="hsize" value="250" />
<input type="submit" name="submit" value="Generate" />
</div>
</div>
</div>
<?php echo display_section(); ?>
</form>
</div>
</div>
<div id="tabs-2">
<div class="row">
<form id="emailform" class="form-horizontal">   
<div class="span4">
<div class="control-group">
<label class="control-label" for="email">Email:</label>
<div class="controls">
<input type="text" name="email" class="tiny email required">
</div>
</div>                              
<?php echo chart_config(10); ?>
<div class="control-group">
<div class="controls">
<input type="hidden" name="type" value="emailform" />
<input type="hidden" name="size" id="hsize" value="250" />
<input type="submit" name="submit" value="Generate" class="btn btn-block" />
</div>
</div>
</div>
<?php echo display_section(); ?>
</form>
</div>
</div>
<div id="tabs-3">
<div class="row">
<form id="phone" class="form-horizontal">     
<div class="span4">
<div class="control-group">
<label class="control-label" for="pnum">Phone number:</label>
<div class="controls">
<input type="text" id="pnum" name="pnum" class="tiny digits required">
</div>
</div>                            
<?php echo chart_config(20); ?>
<div class="control-group">
<div class="controls">
<input type="hidden" name="type" value="phone" />
<input type="hidden" name="size" id="hsize" value="250" />
<input type="submit" name="submit" value="Generate" class="btn btn-block" />
</div>
</div>
</div>
<?php echo display_section(); ?>
</form>
</div>
</div>
<div id="tabs-4">
<div class="row">
<form id="geo" class="form-horizontal">   
<div class="span4">
<div class="control-group">
<label class="control-label" for="lati">Latitude:</label>
<div class="controls">
<input type="text" id="lati" name="lati" class="tiny">
</div>
</div>     
<div class="control-group">
<label class="control-label" for="longi">Longitude:</label>
<div class="controls">
<input type="text" id="longi" name="longi" class="tiny">
</div>
</div>    
<div class="control-group">
<label class="control-label" for="q">Query:</label>
<div class="controls">
<input type="text" id="q" name="q" class="tiny">
</div>
</div> 
<?php echo chart_config(30); ?>
<div class="control-group">
<div class="controls">
<input type="hidden" name="type" value="geo" />
<input type="hidden" name="size" id="hsize" value="250" />
<input type="submit" name="submit" value="Generate" class="btn btn-block" />
</div>
</div>
</div>
<?php echo display_section(); ?>
</form>
</div>
</div>
<div id="tabs-5">
<div class="row">
<form id="smsform" class="form-horizontal">   
<div class="span4">
<div class="control-group">
<label class="control-label" for="pnum">Phone number:</label>
<div class="controls">
<input type="text" id="pnum" name="pnum" class="tiny digits required">
</div>
</div>    
<div class="control-group">
<label class="control-label" for="msg">Message:</label>
<div class="controls">
<input type="text" id="msg" name="msg" class="tiny">
</div>
</div>  
<?php echo chart_config(40); ?>
<div class="control-group">
<div class="controls">
<input type="hidden" name="type" value="smsform" />
<input type="hidden" name="size" id="hsize" value="250" />
<input type="submit" name="submit" value="Generate" class="btn btn-block" />
</div>
</div>
</div>
<?php echo display_section(); ?>
</form>
</div>
</div>
<div id="tabs-6">
<div class="row">
<form id="msgform" class="form-horizontal">   
<div class="span4"> 
<div class="control-group">
<label class="control-label" for="msg">Message:</label>
<div class="controls">
<textarea id="msg" name="msg" class="required"></textarea>
</div>
</div>  
<?php echo chart_config(50); ?>
<div class="control-group">
<div class="controls">
<input type="hidden" name="type" value="msgform" />
<input type="hidden" name="size" id="hsize" value="250" />
<input type="submit" name="submit" value="Generate" class="btn btn-block" />
</div>
</div>
</div>
<?php echo display_section(); ?>
</form>
</div>
</div>
<div id="tabs-7">
<div class="row">
<form id="urlform" class="form-horizontal">   
<div class="span4"> 
<div class="control-group">
<label class="control-label" for="msg">URL:</label>
<div class="controls">
<input type="text" id="msg" name="msg" class="tiny url required">
</div>
</div>                                
<?php echo chart_config(60); ?>                                
<div class="control-group">
<div class="controls">
<input type="hidden" name="type" value="urlform" />
<input type="hidden" name="size" id="hsize" value="250" />
<input type="submit" name="submit" value="Generate" class="btn btn-block" />
</div>
</div>
</div>                            
<?php echo display_section(); ?>                            
</form>
</div>
</div>
<div id="tabs-8">
<div class="row">
<form id="wifiform" class="form-horizontal">   
<div class="span4"> 
<div class="control-group">
<label class="control-label" for="ssid">SSID:</label>
<div class="controls">
<input type="text" id="ssid" name="ssid" class="tiny required">
</div>
</div>
<div class="control-group">
<label class="control-label" for="pass">Password:</label>
<div class="controls">
<input type="text" id="pass" name="pass" class="tiny">
</div>
</div>
<div class="control-group">
<label class="control-label" for="ntype">Network type:</label>
<div class="controls wide">
<input type="radio" id="radio-1" name="ntype" value="WEP" checked="checked" /><label for="radio-1">WEP</label>
<input type="radio" id="radio-2" name="ntype" value ="WPA" /><label for="radio-2">WPA/WPA2</label>
<input type="radio" id="radio-3" name="ntype" value ="nopass" /><label for="radio-3">None</label>
</div>
</div>
<?php echo chart_config(70); ?>
<div class="control-group">
<div class="controls">
<input type="hidden" name="type" value="wifiform" />
<input type="hidden" name="size" id="hsize" value="250" />
<input type="submit" name="submit" value="Generate" class="btn btn-block" />
</div>
</div>
</div>
<?php echo display_section(); ?>
</form>
</div>
</div>
<div id="tabs-9">
<div class="row">
<form id="eventform" class="form-horizontal">   
<div class="span4"> 
<div class="control-group">
<label class="control-label" for="allday">All day event:</label>
<div class="controls">
<input type="checkbox" id="allday" name="allday" value="on" >
</div>
</div>
<div class="control-group">
<label class="control-label" for="evtitle">Event title:</label>
<div class="controls">
<input type="text" id="evtitle" name="evtitle" class="tiny required">
</div>
</div>
<div class="control-group">
<label class="control-label" for="datepicker1">Start date:</label>
<div class="controls">
<div id="datepicker1"></div>
</div>
</div>
<div class="control-group dt">
<label class="control-label" for="time1">Time:</label>
<div class="controls">
<input id="time1" name="time1" value="00:00:00" />
</div>
</div>
<div class="control-group">
<label class="control-label" for="datepicker2">End date:</label>
<div class="controls">
<div id="datepicker2"></div>
</div>
</div>
<div class="control-group dt">
<label class="control-label" for="time2">Time:</label>
<div class="controls">
<input id="time2" name="time2" value="00:00:00" />
</div>
</div>
<div class="control-group dt">
<label class="control-label" for="tz">Timezone:</label>
<div class="controls">
<select name="tz">
<option value="GMT">GMT GMT</option>
<option value="UTC">GMT UTC</option>
<option value="ECT">GMT+1:00 ECT</option>
<option value="EET">GMT+2:00 EET</option>
<option value="ART">GMT+2:00 ART</option>
<option value="EAT">GMT+3:00 EAT</option>
<option value="MET">GMT+3:30 MET</option>
<option value="NET">GMT+4:00 NET</option>
<option value="PLT">GMT+5:00 PLT</option>
<option value="IST">GMT+5:30 IST</option>
<option value="BST">GMT+6:00 BST</option>
<option value="VST">GMT+7:00 VST</option>
<option value="CTT">GMT+8:00 CTT</option>
<option value="JST">GMT+9:00 JST</option>
<option value="ACT">GMT+9:30 ACT</option>
<option value="AET">GMT+10:00 AET</option>
<option value="SST">GMT+11:00 SST</option>
<option value="NST">GMT+12:00 NST</option>
<option value="MIT">GMT-11:00 MIT</option>
<option value="HST">GMT-10:00 HST</option>
<option value="AST">GMT-9:00 AST</option>
<option value="PST">GMT-8:00 PST</option>
<option value="PNT">GMT-7:00 PNT</option>
<option value="MST">GMT-7:00 MST</option>
<option value="CST">GMT-6:00 CST</option>
<option value="EST">GMT-5:00 EST</option>
<option value="IET">GMT-5:00 IET</option>
<option value="PRT">GMT-4:00 PRT</option>
<option value="CNT">GMT-3:30 CNT</option>
<option value="AGT">GMT-3:00 AGT</option>
<option value="BET">GMT-3:00 BET</option>
<option value="CAT">GMT-1:00 CAT</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label" for="loc">Location:</label>
<div class="controls">
<input type="text" id="loc" name="loc" class="tiny">
</div>
</div> 
<div class="control-group">
<label class="control-label" for="desc">Description:</label>
<div class="controls">
<input type="text" id="desc" name="desc" class="tiny">
</div>
</div>
<?php echo chart_config(80); ?>
<div class="control-group">
<div class="controls">
<input type="hidden" name="date1" id="date1" value="" />
<input type="hidden" name="date2" id="date2" value="" />
<input type="hidden" name="size" id="hsize" value="250" />
<input type="hidden" name="type" value="eventform" />
<input type="submit" name="submit" value="Generate" class="event" />
</div>
</div>
</div>
<?php echo display_section(); ?>
</form>
</div>
</div>
</div>
</div>

<script src="js/jquery-1.9.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui-1.10.0.custom.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/globalize.js"></script>
<script src="js/qr.js"></script>

<div align='center'>   	
<!-- bjqs.css contains the *essential* css needed for the slider to work -->
<link rel="stylesheet" href="css/bjqs.css">
<!-- demo.css contains additional styles used to set up this demo page - not required for the slider --> 
<link rel="stylesheet" href="css/sliderdemo.css">
<script src="js/bjqs-1.3.min.js"></script>        		
<!--  Outer wrapper for presentation only, this can be anything you like -->
<div id="banner-fade">
<!-- start Basic Jquery Slider -->
<ul class="bjqs">
<li><img src="img/callus.png" title="Call Us"></li>
<li><img src="img/contactus.png" title="Contact Us"></li>
<li><img src="img/ourlocation.png" title="Visit Our Location"></li>
<li><img src="img/ourwebsite.png" title="View Our Website"></li>
<li><img src="img/ourcard.png" title="View Our vCard"></li>
</ul>
<!-- end Basic jQuery Slider -->
</div>
</div>
<script class="secret-source">
jQuery(document).ready(function($) {
	$('#banner-fade').bjqs({
		animtype      : 'slide',
		height      : 300,
		width       : 300,
		showcontrols : false,
		responsive  : true,
	});
});
</script>
<!-- End outer wrapper -->

</body>
</html>
<?php
/**
* echoing display area for image
* <img src="" id="qr-img" class="hidden qrimage" />
*/
function display_section() {
	?>
	<div class="span3 offset2">      
	<div class="right-area">  
	<img src="" id="qr-img"  />
	<p></p>
	<div class="hidden size-image"></div>
	<p></p>
	<p class="hidden">QR image url</p>
	<p><input type="text" value="" id="qr-real" class="hidden" /></p>
	<p class="hidden">Short QR image url</p>
	<p><input type="text" value="" id="qr-result" class="hidden" /></p>
	<p class="hidden"><a href="" target="_blank" title="Download png QR image" id="qr-png">PNG </a></p>
	<p class="hidden"><a href="" target="_blank" title="Download jpg QR image" id="qr-jpg">JPG </a></p>
	<p class="hidden"><a href="" target="_blank" title="Download gif QR image" id="qr-gif">GIF </a></p>
	<div class="hidden">
	<div class="collapsed red" >+ QR Text</div>
	<div id="qr-content" style="display: none;"></div>
	</div>
	</div>
	</div>
	<?php
}
/**
* function to help make id not same
* 
* @param type $start
*/
function chart_config($start) {
	?>
	<div class="control-group">
	<label class="control-label" for="size">Barcode size:</label>
	<div class="controls clow">
	<div class="size"></div>
	</div>
	</div>
	<div class="control-group">
	<label class="control-label middle" for="error">Error correction:</label>
	<div class="controls">
	<input type="radio" id="radio<?php echo $start + 1; ?>" name="error" value="L" checked="checked" /><label for="radio<?php echo $start + 1; ?>">L</label>
	<input type="radio" id="radio<?php echo $start + 2; ?>" name="error" value ="M" /><label for="radio<?php echo $start + 2; ?>">M</label>
	<input type="radio" id="radio<?php echo $start + 3; ?>" name="error" value ="Q" /><label for="radio<?php echo $start + 3; ?>">Q</label>
	<input type="radio" id="radio<?php echo $start + 4; ?>" name="error" value ="H" /><label for="radio<?php echo $start + 4; ?>">H</label>
	</div>
	</div>
	<div class="control-group">
	<label class="control-label" for="char">Character encoding:</label>
	<div class="controls wide middle">
	<input type="radio" id="radio<?php echo $start + 5; ?>" name="char" value="UTF-8" checked="checked" /><label for="radio<?php echo $start + 5; ?>">UTF-8</label>
	<input type="radio" id="radio<?php echo $start + 6; ?>" name="char" value ="ISO-8859-1" /><label for="radio<?php echo $start + 6; ?>">ISO-8859-1</label>
	<input type="radio" id="radio<?php echo $start + 7; ?>" name="char" value ="Shift_JIS" /><label for="radio<?php echo $start + 7; ?>">Shift_JIS</label>
	</div>
	</div>
	<?php
}
?>
