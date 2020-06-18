/*  ---------------------------------------------------
    Template Name: Fashi
    Description: Fashi eCommerce HTML Template
    Author: Colorlib
    Author URI: https://colorlib.com/
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Hero Slider
    --------------------*/
    $(".hero-items").owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        items: 1,
        dots: false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });

    /*------------------
        Product Slider
    --------------------*/
   $(".product-slider").owlCarousel({
        loop: true,
        margin: 25,
        nav: true,
        items: 4,
        dots: true,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            992: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    /*------------------
       logo Carousel
    --------------------*/
    $(".logo-carousel").owlCarousel({
        loop: false,
        margin: 30,
        nav: false,
        items: 5,
        dots: false,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        mouseDrag: false,
        autoplay: true,
        responsive: {
            0: {
                items: 3,
            },
            768: {
                items: 5,
            }
        }
    });

    /*-----------------------
       Product Single Slider
    -------------------------*/
    $(".ps-slider").owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        items: 3,
        dots: false,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });
    
    // rating system


    $('.rating .fa-star').click(function(){
        if($(this).hasClass('checked')) {
            $(this).toggleClass('checked');
            $(this).prevAll('.fa-star').addClass('checked');
            $(this).nextAll('.fa-star').removeClass('checked');
        }
        else
        {
            $(this).toggleClass('checked');
            $(this).prevAll('.fa-star').addClass('checked');
        }
        $("#hdnRateNumber").val($('.checked').length);        
     
    });
        
    /*----------------------------------------------------
     Language Flag js 
    ----------------------------------------------------*/
    $(document).ready(function(e) {
    //no use
    try {
        var pages = $("#pages").msDropdown({on:{change:function(data, ui) {
            var val = data.value;
            if(val!="")
                window.location = val;
        }}}).data("dd");

        var pagename = document.location.pathname.toString();
        pagename = pagename.split("/");
        pages.setIndexByValue(pagename[pagename.length-1]);
        $("#ver").html(msBeautify.version.msDropdown);
    } catch(e) {
        // console.log(e);
    }
    $("#ver").html(msBeautify.version.msDropdown);

    //convert
    $(".language_drop").msDropdown({roundedBorder:false});
        $("#tech").data("dd");
    });
  

    /*-------------------
		Collection slot Checkbox
    -------------------- */


        $('#wednesday').on('change', function(){ 
            var day = 'Wednesday';
            var time = $('#wednesday').val();      
            get_slot(time, day); 
            
        })
        $('#thursday').on('change', function(){  
            var day = 'Thursday';
            var time = $('#thursday').val();     
            
            get_slot(time,day);
                   
        })
        $('#friday').on('change', function(){       
            var day = 'Friday';
            var time = $('#friday').val();
             get_slot(time,day);
        })
       
      
            function get_slot(time, day){
              
            $.ajax({
                url:"collection_slot_process.php",
                method:"POST",
                data:{time:time,day:day},
                success:function(data){
                    alert(data);
                }
                
                
            });
            }
        

    
    
    /*-------------------
		Nice Select
    --------------------- */
    $('.sorting, .p-show').niceSelect();

    /*------------------
		Single Product
	--------------------*/
	$('.product-thumbs-track .pt').on('click', function(){
		$('.product-thumbs-track .pt').removeClass('active');
		$(this).addClass('active');
		var imgurl = $(this).data('imgbigurl');
		var bigImg = $('.product-big-img').attr('src');
		if(imgurl != bigImg) {
			$('.product-big-img').attr({src: imgurl});
			$('.zoomImg').attr({src: imgurl});
		}
	});

    $('.product-pic-zoom').zoom();
    
    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $('.pro-qty');
	proQty.prepend('<span class="dec qtybtn">-</span>');
	proQty.append('<span class="inc qtybtn">+</span>');
	proQty.on('click', '.qtybtn', function () {
		var $button = $(this);
		var oldValue = $button.parent().find('input').val();
		if ($button.hasClass('inc')) {      
           // Don't allow incrementing above 15
            if(oldValue>14){
                var newVal = parseFloat(oldValue);
            }
            else{
                newVal = parseFloat(oldValue)+1;
            }

		} else {
			// Don't allow decrementing below 1
			if (oldValue > 1) {
				var newVal = parseFloat(oldValue)-1;
			} else {
				newVal = 1;
            }
            
		}
		$button.parent().find('input').val(newVal);
    });
   

 // ajax product fetch

 $('#sortBy').on('change', function(){
    filter_data();
   
 });
   
    filter_data();
    
    function filter_data(){
        var action = "fetch_data";
        var min_price = $('#hidden_minimum_price').val();
        var max_price = $('#hidden_maximum_price').val(); 
        var categories = get_filter("categories");
        var shop = get_filter("shop");
        var sort = $("#sortBy").val();
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, min_price:min_price, max_price:max_price, categories:categories,shop:shop, sort:sort},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name){
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;      
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    /*-------------------
		Range Slider
	--------------------- */
	$('#price_range').slider({
        range:true,
        min:5,
        max:500,
        values:[0, 5000],
        step:5,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });




})(jQuery);