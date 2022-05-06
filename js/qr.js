$(function() {
                
    // load tabs
    $('#tabs').tabs();  
	
    
    
    $.ajaxSetup({
        cache: false
    });                
                 
    $('#geo').find('.hidden').addClass('hide');
    $('#geo').validate({
        rules: {
            lati: {
                required: true,
                range: [-90, 90]
            },
            longi: {
                required: true,
                digits: true
            }
        },
        submitHandler: function(form) {
            $('input[type="submit"]').prop('disabled', true);
            $.post("qr-code.php", $("#geo").serialize(),
                function(data){
                    if(data.status=='ok')
                    {                             
                            $('#geo').find('#qr-img').attr('src', 'loading.gif') ;
							imgrnd = Math.floor(Math.random()*1000) ;
							MakeRequest(data.id, imgrnd); 
					
						    $('#geo').find('.hidden').removeClass('hide');                     
						    $('#geo').find('#qr-real').val(data.real);
						    $('#geo').find('#qr-png').attr('href', 'images/' + imgrnd +'.png');
						    $('#geo').find('#qr-jpg').attr('href', 'images/' + imgrnd +'.jpg');
						    $('#geo').find('#qr-gif').attr('href', 'images/' + imgrnd +'.gif');
						    $('#geo').find('#qr-content').html('<p>'+data.content+'</p>');
						    $('#geo').find('#qr-result').val(data.id) ;
						    $('#geo').find('#qr-img').attr('src', 'images/' + imgrnd +'.png');
                    }
                    $('input[type="submit"]').prop('disabled', false);
                }, 'json');                          
        }                            
    });               


    qrAjax('#contact');
    qrAjax('#emailform');
    qrAjax('#phone');
    qrAjax('#smsform');
    qrAjax('#msgform');
    qrAjax('#urlform');
    qrAjax('#wifiform');
    qrAjax('#eventform');
                
    function qrAjax(formID)
    {
        $(formID).find('.hidden').addClass('hide');
        $(formID).validate({
            submitHandler: function(form) {
                $('input[type="submit"]').prop('disabled', true);
	
                $.post("qr-code.php", $(formID).serialize(),
                    function(data){
                        if(data.status=='ok')
                        {                            
                            $(formID).find('#qr-img').attr('src', 'loading.gif') ;
							imgrnd = Math.floor(Math.random()*1000) ;
					
							MakeRequest(data.id, imgrnd); 
						
						    $(formID).find('.hidden').removeClass('hide');                     
						    $(formID).find('#qr-real').val(data.real);
						    $(formID).find('#qr-png').attr('href', 'images/' + imgrnd +'.png');
						    $(formID).find('#qr-jpg').attr('href', 'images/' + imgrnd +'.jpg');
						    $(formID).find('#qr-gif').attr('href', 'images/' + imgrnd +'.gif');
						    $(formID).find('#qr-content').html('<p>'+data.content+'</p>');
						    $(formID).find('#qr-result').val(data.id) ;
						    $(formID).find('#qr-img').attr('src', 'images/' + imgrnd +'.png');
							
                        }
                        $('input[type="submit"]').prop('disabled', false);
                    }, 'json');                          
            }                            
        }); 
	
    }
                
                
    $.widget( "ui.timespinner", $.ui.spinner, {
        options: {
            // seconds
            step: 60 * 1000,
            // hours
            page: 60
        },
 
        _parse: function( value ) {
            if ( typeof value === "string" ) {
                // already a timestamp
                if ( Number( value ) == value ) {
                    return Number( value );
                }
                return +Globalize.parseDate( value );
            }
            return value;
        },
 
        _format: function( value ) {
            return Globalize.format( new Date(value), "T" );
        }
    });
  
    $('#datepicker1').datepicker({
        defaultDate: +0, 
        altField: '#date1', 
        altFormat: 'yy-mm-dd'
    });
    $('#datepicker2').datepicker({
        defaultDate: +0, 
        altField: '#date2', 
        altFormat: 'yy-mm-dd'
    });
    $( "#time1" ).timespinner();
    $( "#time2" ).timespinner();
                
    $('#allday').click( function(){
        if($(this).is(':checked'))
        {
            $('.dt').addClass('hide');
        }
        else
        {
            $('.dt').removeClass('hide');
        }
    });
                
                
    $('input[type=submit]').button();
    $( "input[type=radio]" ).button();
    
    $(".size").slider({
        value:250,
        min: 100,
        max: 500,
        step: 50,
		
        change: function( event, ui ) {
            var sval = $( this ).slider( "value" );
            $(this).find(".ui-slider-handle").attr("title", sval+'px X '+sval+'px');
            $(this).parent().parent().parent().parent().find('#hsize').val(sval);
        }
    });
    $( ".size-image" ).slider({
        value:250,
        min: 100,
        max: 500,
        step: 50,
        change: function( event, ui ) {           
            var sval = $( this ).slider( "value" );
            $(this).find(".ui-slider-handle").attr("title", sval+'px X '+sval+'px');
            $(this).parent().parent().parent().parent().parent().find('#hsize').val(sval);
            $(this).parent().parent().parent().find('input[type="submit"]').click();
        }
    });

    $(".collapsed").click(function()
    {
        var heading = $(this);

        $(this).next("#qr-content").slideToggle(function(){
            if(heading.hasClass('coldown'))
            {
                heading.html('+ QR Text');
           
                heading.removeClass('coldown');
            }
            else
            {
                heading.html('- QR Text');
               
                heading.addClass('coldown');
            }
            
        });
    });

    $('.red').hover(function(){
        $(this).addClass('redt');
    },function(){
        $(this).removeClass('redt');
    })
    $('.dark').hover(function(){
        $(this).addClass('darkt');
    },function(){
        $(this).removeClass('darkt');
    })
});

function getXMLHttp()
{
	var xmlHttp

	try
	{
		//Firefox, Opera 8.0+, Safari
		xmlHttp = new XMLHttpRequest();
	
	}
	catch(e)
	{
		//Internet Explorer
		try
		{
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			try
			{
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e)
			{
				alert("Your browser does not support AJAX!");
				return false;
			}
		}
	}
	return xmlHttp;
}

function MakeRequest(var1, imgrnd)
{
	var xmlHttp = getXMLHttp();
	
	xmlHttp.onreadystatechange = function()
	{
		if(xmlHttp.readyState == 4 ) // && xmlHttp.status == 200
		{
			HandleResponse(xmlHttp.responseText);
			
		}
	}


	var2 = getCookie('fore_red_val') ;
	var3 = getCookie('fore_green_val') ;
	var4 = getCookie('fore_blue_val') ;
	foreparams = "&forered=" + var2 + "&foregreen=" + var3  + "&foreblue=" + var4 ;  
	
	var5 = getCookie('back_red_val') ;
	var6 = getCookie('back_green_val') ;
	var7 = getCookie('back_blue_val') ;
	backparams = "&backred=" + var5 + "&backgreen=" + var6  + "&backblue=" + var7 ;  
	
	xmlHttp.open("GET", "ajax.php?url=" + var1 + '&imgrnd=' + imgrnd + foreparams + backparams, false); 
	xmlHttp.send();
	
	
}

function HandleResponse(response)
{
	document.getElementById('ResponseDiv').innerHTML = response;
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

