jQuery(document).ready(function($) {
    
    var slider_auto, slider_loop, slider_control, rtl, mrtl, slider_animation, teamloop;
    /** Variables from Customizer for Slider settings */
    if( business_one_page_data.auto == '1' ){
        slider_auto = true;
    }else{
        slider_auto = false;
    }
    
    if( business_one_page_data.loop == '1' ){
        slider_loop = true;
    }else{
        slider_loop = false;
    }
    
    if( business_one_page_data.pager == '1' ){
        slider_control = true;
    }else{
        slider_control = false;
    }
    
    if( business_one_page_data.rtl == '1' ){
        rtl = true;
        mrtl = false;
    }else{
        rtl = false;
        mrtl = true;
    }

    var itemlength = $('#lightSlider li').length;
    if( itemlength > 3 ){
        teamloop = true;
    }else{
        teamloop = false;
    }

    if( business_one_page_data.animation == 'slide' ){
        slider_animation = '';
    }else{
        slider_animation = 'fadeOut';
    }

    /** Home Page Slider */
    $(".banner-slider").owlCarousel({
        items           : 1,
        margin          : 0,
        loop            : slider_loop,
        autoplay        : slider_auto,
        dots            : slider_control,
        nav             : false,
        animateOut      : slider_animation,
        autoplayTimeout : business_one_page_data.pause,
        lazyLoad        : true,
        mouseDrag       : false,
        rtl             : rtl,
        autoplaySpeed   : business_one_page_data.speed,
    });

    $(".testimonial-slide").owlCarousel({
        items           : 1,
        margin          : 0,
        dots            : true,
        nav             : false,
        lazyLoad        : true,
        mouseDrag       : false,
        rtl             : rtl,
        autoplaySpeed   : 500,
    });

    
    $("#lightSlider").owlCarousel({
        items           : 3,
        margin          : 30,
        loop            : teamloop,
        dots            : false,
        nav             : true,
        lazyLoad        : true,
        mouseDrag       : false,
        rtl             : rtl,
        responsive : {
            // breakpoint from 0 up
            0 : {
                items : 1,
            },
            // breakpoint from 480 up
            640 : {
                items : 2,
            },

            768 : {
                items : 3,
            }
        }
    });
    
    //scrollup javascript
    $('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    
    // grab an element
    var myElement = document.querySelector("header");
    // construct an instance of Headroom, passing the element
    var headroom  = new Headroom(myElement);
    // initialise
    headroom.init();
    
    $('#site-navigation').onePageNav({
        currentClass: 'current-menu-item',
        changeHash: false,
        scrollSpeed: 1500,
        scrollThreshold: 0.5,
        filter: '',
        easing: 'swing',        
    });

    $('#mobile-site-navigation').onePageNav({
        currentClass: 'current-menu-item',
        changeHash: false,
        scrollSpeed: 1500,
        scrollThreshold: 0.5,
        filter: '',
        easing: 'swing',        
    });
    
    /** Masonry */
    $('.js-masonry').imagesLoaded(function(){ 
        $('.js-masonry').masonry({
            itemSelector : '.portfolio-col',
            isOriginLeft : mrtl
        }); 
    });
    
    //same height js
    // these are (ruh-roh) globals. You could wrap in an
        // immediately-Invoked Function Expression (IIFE) if you wanted to...
        var currentTallest = 0,
            currentRowStart = 0,
            rowDivs = [];

        function setConformingHeight(el, newHeight) {
            // set the height to something new, but remember the original height in case things change
            el.data("originalHeight", (el.data("originalHeight") == undefined) ? (el.height()) : (el.data("originalHeight")));
            el.height(newHeight);
        }

        function getOriginalHeight(el) {
            // if the height has changed, send the originalHeight
            return (el.data("originalHeight") == undefined) ? (el.height()) : (el.data("originalHeight"));
        }

        function columnConform() {

            // find the tallest DIV in the row, and set the heights of all of the DIVs to match it.
            $('.three-cols > .row > .col').each(function() {

                // "caching"
                var $el = $(this);

                var topPosition = $el.position().top;

                if (currentRowStart != topPosition) {

                    // we just came to a new row.  Set all the heights on the completed row
                    for(currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) setConformingHeight(rowDivs[currentDiv], currentTallest);

                    // set the variables for the new row
                    rowDivs.length = 0; // empty the array
                    currentRowStart = topPosition;
                    currentTallest = getOriginalHeight($el);
                    rowDivs.push($el);

                } else {

                    // another div on the current row.  Add it to the list and check if it's taller
                    rowDivs.push($el);
                    currentTallest = (currentTallest < getOriginalHeight($el)) ? (getOriginalHeight($el)) : (currentTallest);

                }
                // do the last row
                for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) setConformingHeight(rowDivs[currentDiv], currentTallest);

            });

        }
        
        columnConform();
        
        $(window).resize(function() {
            columnConform();
        });

    var headerHeight = $('.site-header .container').outerHeight();
    $('.banner').css("margin-top", headerHeight);
    $('.site-content').css("margin-top", headerHeight);

    // Responsive Menu
    $('.mobile-menu').prepend('<div class="btn-close-menu"></div>');

    $('.mobile-menu-opener').click(function(){
        $('body').addClass('menu-open');

        $('.btn-close-menu').click(function(){
            $('body').removeClass('menu-open');
        });

        $('.mobile-main-navigation ul li a').click(function(){
            $('body').removeClass('menu-open');
        });

    });


    $('.overlay').click(function(){
        $('body').removeClass('menu-open');
    });

    $('.mobile-main-navigation ul .menu-item-has-children').append('<div class="angle-down"></div>');

    $('.mobile-main-navigation ul li .angle-down').click(function(){
        $(this).prev().slideToggle();
        $(this).toggleClass('active');
    });

    //accessible menu for edge
    var winWidth = $(window).width();
    if(winWidth > 1024){
        $(".main-navigation ul li a").focus(function() {
            $(this).parents("li").addClass("focus");
        }).blur(function() {
            $(this).parents("li").removeClass("focus");
        });
    }
    $(".menu-top-header-menu-container ul li a").focus(function() {
        $(this).parents("li").addClass("focus");
    }).blur(function() {
        $(this).parents("li").removeClass("focus");
    });
        
});
