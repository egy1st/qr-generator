/**
 * Created with JetBrains PhpStorm.
 * User: SUDARSHAN
 * Date: 2/6/13
 * Time: 2:58 PM
 * To change this template use File | Settings | File Templates.
 */


$(function(){

    var menu_status = 0;
    var w_px;
    var slideTime = 1;
    var slideMenuRotation = 1;
    var rotationSpeed = 1;
    var rotationSpeedTime = .8;
    var styleSwitchStatus = 0;
    var cw = Raphael.colorwheel($(".widget-color-wheel")[0],150).color("#F00");

    function switcher_widget()
    {
        var win_width = $(window).width();
        if(win_width < 768)
        {
            $('#switcher').hide();
        }
        else if(win_width > 767 && win_width <=900)
        {
            $('#switcher').removeClass('span3 span4').addClass('span5');
            $('.form-horizontal select.changeable').removeClass('span9').addClass('span11');
            //$('#switcher').removeClass('span3 span4 ca-to-span3 ca-done-span3 ca-to-span4 ca-done-span4').animate('.span5');
            $('#switcher').show();
        }
        else if(win_width > 900 && win_width <1300)
        {
            $('#switcher').removeClass('span5 span3').addClass('span4');
            $('.form-horizontal select.changeable').removeClass('span9').addClass('span11');
            //$('#switcher').removeClass('span3 span5 ca-to-span3 ca-done-span3 ca-to-span5 ca-done-span5').animate('.span4');
            $('#switcher').show();
        }
        else
        {
            $('#switcher').removeClass('span5 span4').addClass('span3');
            $('.form-horizontal select.changeable').removeClass('span11').addClass('span9');
            //$('#switcher').removeClass('span4 span5 ca-to-span4 ca-done-span4 ca-to-span5 ca-done-span5').animate('.span4');
            $('#switcher').show();
        }
    }

    function mega_menu_hide()
    {
        $("#ldd_menu li").find('div').hide();
    }

    function widget_menu()
    {
        var pos = $(window).scrollTop();
        var wdgt = $('.widget');
        if(pos >= 180)
        {
            wdgt.addClass('fixed-widget');
            //$('.menu-click').parent().css({'right':'-14.6%','margin-right':'-1px'});
            wdgt.show();
        }
        else
        {
            menu_status = 0;
            wdgt.removeClass('fixed-widget');
            $('.menu-click').parent().css({'right':'-14.6%','margin-right':'-1px'});
            wdgt.hide();
            //$('#content_body').removeClass('span8 ca-to-span8 ca-done-span8').removeAttr('style').addClass('span10');//.animate('.span10', 1000);//
            //$('#content_body').animate('.span10', 800);
        }
    }

    $('.menu-click').click(function(){
        if(!menu_status)
        {
            //$('#content_body').animate('.span8', 1000);
            //$('#content_body').removeClass('span10 ca-to-span10 ca-done-span10');
            $(this).parent().animate({'right':'0%','margin-right':'-2px'}, 1000);
            menu_status = 1;
        }
        else
        {
            //$('#content_body').removeClass('span8 ca-to-span8 ca-done-span8').animate('.span10', 1000);
            $(this).parent().animate({'right':'-14.6%','margin-right':'-1px'}, 1000);
            menu_status = 0;
        }
    });


    $('.switch-click').click(function(){
        if(!styleSwitchStatus)
        {
            $(this).parents('div#switcher').animate({'left': '0%'}, 1000);
            styleSwitchStatus = 1;
        }
        else
        {
            var win_width = $(window).width();
            styleSwitchStatus = 0;

            if(win_width < 900)
            {
                $(this).parents('div#switcher').animate({'left': '-39.9%'}, 1000);
            }
            else if(win_width > 1299)
            {
                $(this).parents('div#switcher').animate({'left': '-23%'}, 1000);
            }
            else
            {
                $(this).parents('div#switcher').animate({'left': '-31.9%'}, 1000);
            }
        }
    })

    function set_offset()
    {
        if($(window).width() < 900)
        {
            //console.log('test');
            $('div.navbar div div.span10').removeClass('offset2').addClass('offset1');
        }
        else
        {
            //console.log('test2');
            $('div.navbar div div.span10').removeClass('offset1').addClass('offset2');
        }
    }

    $("#ldd_menu li").mouseenter(function(){

        if($(window).width() < 768)
        {
            mega_menu_hide();
            return;
        }
        else
        {
            if(slideTime == 2)
            {
                //console.log('fast down');
                $(this).children('div').slideDown(200);
            }
            else
            {
                //console.log('slow down');
                $(this).children('div').slideDown(600);
            }

            switch (slideMenuRotation)
            {
                case '2':
                    jss('.ldd_submenu ul li:hover', {
                        '-moz-transition': 'all '+rotationSpeedTime+'s ease-in-out',
                        '-webkit-transition': 'all '+rotationSpeedTime+'s ease-in-out',
                        '-ms-transition': 'all '+rotationSpeedTime+'s ease-in-out',
                        '-o-transition': 'all '+rotationSpeedTime+'s ease-in-out',
                        '-moz-transform': 'rotateX(360deg)',
                        '-webkit-transform':'rotateX(360deg)',
                        '-ms-transform':'rotateX(360deg)',
                        '-o-transform':'rotateX(360deg)'
                    });
                    break;
                case '3':
                    jss('.ldd_submenu ul li:hover', {
                        '-moz-transition': 'all '+rotationSpeedTime+'s ease-in-out',
                        '-webkit-transition': 'all '+rotationSpeedTime+'s ease-in-out',
                        '-ms-transition': 'all '+rotationSpeedTime+'s ease-in-out',
                        '-o-transition': 'all '+rotationSpeedTime+'s ease-in-out',
                        '-moz-transform': 'rotateY(360deg)',
                        '-webkit-transform':'rotateY(360deg)',
                        '-ms-transform':'rotateY(360deg)',
                        '-o-transform':'rotateY(360deg)'
                    });
                    break;
                default :
                    console.log('Default: '+rotationSpeedTime);
                    //$("body").prepend('<div class="hidden_style" style="display: none;"><style type="text/css">.ldd_submenu ul li:hover{color: #7A0110 !important;-moz-transition: all '+rotationSpeedTime+'s ease-in-out;-webkit-transition: all '+rotationSpeedTime+'s ease-in-out;-ms-transition: all '+rotationSpeedTime+'s ease-in-out;-o-transition: all '+rotationSpeedTime+'s ease-in-out;}</style></div> ');
                    jss('.ldd_submenu ul li:hover', {
                        'transition': 'all '+rotationSpeedTime+'s ease-in-out',
                        '-webkit-transition': 'all '+rotationSpeedTime+'s ease-in-out',
                        '-ms-transition': 'all '+rotationSpeedTime+'s ease-in-out',
                        '-o-transition': 'all '+rotationSpeedTime+'s ease-in-out',
                        '-moz-transform': 'rotate(360deg)',
                        '-webkit-transform':'rotate(360deg)',
                        '-ms-transform':'rotate(360deg)',
                        '-o-transform':'rotate(360deg)'
                    });
                    break;
            }
        }
    });

    $("#ldd_menu li").mouseleave(function(){

        if($(window).width() < 768)
        {
            mega_menu_hide();
            return;
        }
        else
        {
            if(slideTime == 2)
            {
                //console.log('fast up');
                $(this).children('div').slideUp(200);
            }
            else
            {
                //console.log('slow up');
                $(this).children('div').slideUp(600);
            }

            $('.hidden_style').remove();
        }

    });

    $('.ldd_submenu ul').mouseleave(function(){


    });

    $('#slide-time').on('change', function(){
        slideTime = $(this).val();
    });

    $('#slide-menu-rotation').on('change', function(){
        slideMenuRotation = $(this).val();
    });

    $('#speed-controller').on('change', function(){
        rotationSpeed = $(this).val();
        switch (rotationSpeed)
        {
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
                rotationSpeedTime = rotationSpeed - 1;
                break;
            default :
                rotationSpeedTime = .8;
                break;
        }
        //alert(rotationSpeedTime);
    });

    set_offset();
    mega_menu_hide();
    widget_menu();
    switcher_widget();


    $(window).scroll(function(){
        widget_menu();
    });


    $(window).on('resize', function(event){
        // Do stuff here
        console.log($(window).width());
        if($(window).width() < 768)
        {
            mega_menu_hide();
        }

        set_offset();
        switcher_widget();
    });



    cw.onchange(function(color){
        //alert(color.hex);
        var where_will_be_changed = $('#widget-color-changer').val();
        console.log(where_will_be_changed);
        switch (where_will_be_changed)
        {
            case '2':
                jss('#widget ul',{
                    'background': color.hex
                });
                break;
            case '3':
                jss('#widget .nav li a:hover', {
                    background: color.hex
                });
                break;
            default :
                jss('#widget .nav', {
                    background: color.hex
                });
                break;
        }
    });

});