(function($) {
    "use strict";
    function main() {
        mobilecheck();
        mdselect();
        Learning();
        scrollStyle();

        jQuery(".feature-slider").owlCarousel({
            autoPlay: 10000,
            items: 4,
            itemsDesktop : [1199,4],
            itemsDesktopSmall : [979,3],
            itemsTablet: [768,2],
            itemsTabletSmall: [600,1],
            slideSpeed: 300,
            navigation: true,
            pagination: false,
            navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
        });



        jQuery('.view-grid').on('click', function() {
            jQuery('.categories-content .content').attr('class', 'content grid');
            jQuery('.grid').addClass('fade-1');
            jQuery('.list').removeClass('fade-2');
            jQuery(this).addClass('active');
            jQuery('.view-list').removeClass('active');
        });
        jQuery('.view-list').on('click', function() {
            jQuery('.categories-content .content').attr('class', 'content list');
            jQuery('.list').addClass('fade-2');
            jQuery('.grid').removeClass('fade-1');
            jQuery(this).addClass('active');
            jQuery('.view-grid').removeClass('active');
        });

        //Footer Newsletter
        var news_message = jQuery('.news_letter .inner form #edit-message').text();
        jQuery( ".news_letter .inner .letter-heading h3" ).append('<p>' + news_message +'</p>' );

        jQuery('.news_letter .inner form').wrap('<div class="letter"></div>');

        jQuery('.news_letter .inner form #edit-subscribe').text('Submit Now');
        jQuery(".news_letter .inner form #edit-subscribe").removeClass("button js-form-submit form-submit btn-default btn course-btn-tab").addClass("mc-btn btn-style-2");

        //Main Navigation Header
        jQuery(".navigation .menu li").first().removeClass("menu-item-has-children").addClass("current-menu-item");
        jQuery(".navigation .menu .menu-item-has-children:nth-child(2)").not('.navigation .menu .sub-menu .menu-item-has-children:nth-child(2)').addClass("megamenu col-4");



        /*==============================
            Account info
        ==============================*/

        var jQuerytoggleList = jQuery('.list-account-info .list-item .toggle-list');
        jQuery('html').on('click', function() {
            jQuerytoggleList.stop().removeClass('toggle-message-add');
            jQuery('.list-account-info .item-click').stop().removeClass('active-ac');
        });
        jQuery('.list-account-info .list-item').on('click', function(event) {
            event.stopPropagation();
        });
        jQuery('.list-account-info .item-click').on('click', function(event) {
            if (jQuery(this).hasClass('active-ac') == false) {
                jQuery('.list-account-info .item-click').removeClass('active-ac');
                jQuerytoggleList.stop().removeClass('toggle-message-add');
            }
            jQuery(this).toggleClass('active-ac');
            jQuery(this).siblings('.toggle-list')
                .stop()
                .toggleClass('toggle-message-add');
            
        });

        jQuery.each(jQuery('.content-bar'), function() {
            var widthList = jQuery(this).find('li').outerWidth(),
                totalList = jQuery(this).find('li').length;
            jQuery(this).find('ul').width(widthList * totalList + 20);
        });
        

        /*==============================
            PROGRESS BAR
        ==============================*/
        jQuery('.current-progress').appear(function () {
            jQuery('.current-progress .progress-run').addClass('progress-run-add');
            var percent = jQuery('.current-progress .count').text();
            jQuery('.progress-run-add').width(percent);
        });


        /*==============================
            PERCENT LEARN
        ==============================*/
        jQuery('.percent-learn').appear(function () {
            jQuery(this)
                .siblings('.percent-learn-bar')
                    .find('.percent-learn-run')
                        .addClass('percent-learn-run-add');
            var percentLearn = jQuery(this).text();
            var context = jQuery(this).siblings('.percent-learn-bar').find('.percent-learn-run-add');
            context.width(percentLearn);
        });


        /*==============================
            CHECKOUT
        ==============================*/
        var current_fs, next_fs, previous_fs;
        var left, opacity, scale;
        var animating;
        jQuery(".form-checkout .next").on('click', function() {
            if(animating) return false;
            animating = true;
            
            current_fs = jQuery(this).closest('fieldset');
            next_fs = jQuery(this).closest('fieldset').next();
            
            jQuery(".form-checkout #bar li").eq(jQuery("fieldset").index(next_fs)).addClass("active");
            
            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    left = (now * 50)+"%";
                    opacity = 1 - now;
                    current_fs.css({
                        'opacity': '0',
                        'position': 'absolute'
                    });
                    next_fs.css({
                        'left': left, 
                        'opacity': opacity,
                        'position': 'static'
                    });
                }, 
                duration: 800, 
                complete: function(){
                    current_fs.hide();
                    animating = false;
                }, 
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

        jQuery(".submit").on('click', function() {
            return false;
        });
        formCheckoutCal();

        jQuery('#page-wrap').append('<div class="overlayForm"></div>');
        jQuery('.take-this-course').on('click', function() {
            jQuery('.form-checkout, .overlayForm').fadeIn(400);
            jQuery(window).trigger('resize');
            return false;
        });
        
        jQuery('.closeForm').on('click', function() {
            jQuery('.form-checkout, .overlayForm').fadeOut(400);
        });
        jQuery('.closeForm').trigger('click');

        /*==============================
            TABS STYLE LINE
        ==============================*/
        if (jQuery('.nav-tabs').length) {
            jQuery.each(jQuery('.nav-tabs'), function() {
                var tabsItem = jQuery(this).find('a'),
                    tabs = jQuery(this),
                    leftActive = tabs.find('.active').children('a').position().left,
                    widthActive = tabs.find('.active').children('a').width();
                tabs.append('<li class="tabs-hr"></li>');
                jQuery('.tabs-hr').css({
                    left: leftActive,
                    width: widthActive
                });
                tabsItem.on('click', function() {
                    var left = jQuery(this).position().left,
                        width = jQuery(this).width();
                    jQuery('.tabs-hr').animate({
                        left: left,
                        width: width
                    }, 500, 'easeInOutExpo');
                });
            });
        }

        /*==============================
            FOOTER STYLE 2
        ==============================*/
        var $footerStyle2 = jQuery('footer#footer.footer-style-2'),
            heightFooter =  $footerStyle2.height();
        $footerStyle2.appendTo('body');
        $footerStyle2.siblings('#page-wrap').css('marginBottom', heightFooter);


        jQuery('.question-sidebar ul, .list-message, .list-notification').wrap('<div class="list-wrap"></div>');
    }
    /*==============================
        Mobile check
    ==============================*/
    function mobilecheck() {
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            return false;
        }
        return true;
    }

    function formCheckoutCal() {
        var heightWindow = jQuery(window).height(),
            heightForm = jQuery('.form-checkout .container').outerHeight(),
            formMiddle = (heightWindow - heightForm - 80) / 2;
        jQuery('.form-checkout').css('top', formMiddle);
    }

    /*==============================
        MC SELECT
    ==============================*/
    function mdselect() {
        jQuery('.mc-select').find('select.select').each(function() {
            var selected = jQuery(this).find('option:selected').text();
            jQuery(this)
                .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
                .after('<span class="select">' + selected + '</span>' + '<i class="fa fa-angle-down"></i>')
                .change(function(){
                    var val = jQuery('option:selected',this).text();
                    jQuery(this).next().text(val);
                });
        });
    }

    /*==============================
        Learning
    ==============================*/
    function Learning() {
        var $navListBody = jQuery('.top-nav-list').find('.list-item-body');
        var width = $navListBody.closest('.top-nav-list').width() - 1;
        $navListBody.width(width);
        if (jQuery('.top-nav-list').children('li').hasClass('active')) {
            jQuery('.learning-section')
                .toggleClass('learning-section-fly')
                .css('paddingRight', width);
        }
        jQuery('.top-nav-list').find('.outline-learn, .discussion-learn, .note-learn').on('click', '> a', function(e) {
            e.preventDefault();
            if (jQuery(this).parent().hasClass('active') == false) {
                jQuery('.top-nav-list').children('li').removeClass('active');
            }
            jQuery(this).parent().toggleClass('active');
            if (jQuery(this).parent().hasClass('active')) {
                jQuery('.learning-section')
                    .addClass('learning-section-fly')
                    .css('paddingRight', width);
            } else {
                jQuery('.learning-section')
                    .removeClass('learning-section-fly')
                    .css('paddingRight', '0');
            }
        });
        jQuery('html').on('click', function() {
            $navListBody.removeClass('item-fly');
            $navListBody.parent('li').removeClass('active');
            jQuery('.learning-section')
                .removeClass('learning-section-fly')
                .css('paddingRight', '0');
        });
        jQuery('.top-nav-list, .list-item-body').on('click', function(event) {
            event.stopPropagation();
        });
    }
    function setHeightRespon() {
        var windowHeight = jQuery(window).height(),
            w = window.innerWidth;
        jQuery('.learn-section').css('min-height', windowHeight);

        if (w < 992) {
            jQuery('.question-content-wrap').find('.question-sidebar').height('auto');
            jQuery('.question-content-wrap').find('.score-sb').find('.list-wrap').height('auto').css('max-height', '300px');
        } else if (w >= 992) {
            var height = jQuery('.question-content-wrap').find('.question-content').height() + 30;
            var heightUl = height - 90;
            jQuery('.question-content-wrap').find('.score-sb').find('.list-wrap').height(heightUl).css('max-height', 'none');
            jQuery('.question-content-wrap').find('.question-sidebar').height(height);
        }
    }

    /*==============================
        SET HEIGHT MESSAGE SB
    ==============================*/
    function setHeightMessagesb() {
        if (jQuery('.list-item-body').length) {
            var heightlist = jQuery(window).height() - jQuery('.list-item-body').css('margin-top').split('px')[0];
            jQuery('.list-item-body').height(heightlist);
        }
    }



    /*==============================
        SCROLL STYLE
    ==============================*/
    function scrollbar() {
        var $scrollbar = jQuery('.question-sidebar .list-wrap, .messages .list-wrap, .message-sb .list-wrap, .notification .list-wrap, .list-item-body, .table-wrap .tbody');
        $scrollbar.perfectScrollbar({
            maxScrollbarLength: 150,
        });
        $scrollbar.perfectScrollbar('update');

        jQuery('.content-bar').perfectScrollbar({
            maxScrollbarLength: 150,
            suppressScrollY: true,
            useBothWheelAxes: true,
        });
        jQuery('.content-bar').perfectScrollbar('update');
    }
    function scrollStyle() {
        scrollbar();
        jQuery(window).on('load', function() {
            if (jQuery('.content-bar').length > 0) {
                var  currentPosition =jQuery('.content-bar').find('.current').position().left;
                var  prevCurrentWidth =jQuery('.content-bar').find('.current').prev().width();
                setTimeout(function() {
                    jQuery('.content-bar').animate({
                        scrollLeft: currentPosition - prevCurrentWidth
                    }, 400);
                }, 100);
            }
        });
    }

    function uploadFile() {
        jQuery('.up-file').delegate('a', 'click', function(e) {
            e.preventDefault();
            jQuery(this).siblings('input[type="file"]').trigger('click');
        });
        jQuery('.up-file').delegate('input[type="file"]', 'change', function() {
            var nameFile = jQuery(this).val().replace(/\\/g, '/').replace(/.*\//, '');
            jQuery(this).siblings('input[type="hidden"]').val(nameFile);
            readURL(this);
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    jQuery('.changes-avatar')
                        .find('img')
                            .attr('src', e.target.result)
                            .width(140);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    }



    /*==========  Slider Home ==========*/
    function SliderHome(){
        if(jQuery('#slide-home').length){
            jQuery('#slide-home').owlCarousel({
                autoPlay: 10000,
                navigation: false,
                pagination: true,
                singleItem: true,
                mouseDrag:false,
                addClassActive:true,
                transitionStyle:'fade'
            });
        }
    }

    /*==========  Resize Slider Home ==========*/
    function ResizeSliderHome() {
        if(jQuery('#slide-home')) {
            var parentWidth = jQuery('.slide-cn').innerWidth(),
              imgWidth = jQuery('.item-inner').width(),
              imgHeight = jQuery('.item-inner').height(),
              scale = parentWidth/imgWidth,
              ratio = imgWidth/imgHeight,
              heightItem = parentWidth/ratio;

          jQuery('.slide-item').css({'height': heightItem});

          if (jQuery(window).width() <= 1200) {

            jQuery('.item-inner').css({
              '-webkit-transform': 'scale(' + scale + ')',
              '-moz-transform': 'scale(' + scale + ')',
              '-ms-transform': 'scale(' + scale + ')',
              'transform': 'scale(' + scale + ')'
            });

          } else {

            jQuery('.item-inner').css({
                '-webkit-transform': 'scale(1)',
                '-moz-transform': 'scale(1)',
                '-ms-transform': 'scale(1)',
                'transform': 'scale(1)'
            });

          }
      }
    }
         

    jQuery(document).ready(function() {
        main();
        setHeightRespon();
        uploadFile();
        setHeightMessagesb();
        scrollbar();
        jQuery('.nav-tabs').wrap('<div class="nav-tabs-wrap"></div>');

        jQuery('.open-menu').on('click', function() {
            jQuery(this).toggleClass('toggle-active');
            jQuery('.navigation .menu, .search-box').slideToggle(300);
        });
        jQuery('.menu-item-has-children').on('click', '> .toggle-sub', function(evt) {
            evt.preventDefault();
            jQuery(this).next().slideToggle(300);
            jQuery(this).prev().toggleClass('mobile-active');
        });
    });
    jQuery(window).load(function() {
        ResizeSliderHome();
    });

    jQuery(window).on('resize', function() {
        formCheckoutCal();
    });
    jQuery(window).on('resize', function() {
        setHeightRespon();
        setHeightMessagesb();
        scrollbar();
        SliderHome();
        ResizeSliderHome();

        if (window.innerWidth < 1200) {
            jQuery('.navigation .menu, .search-box').css('display', 'none');
            if (jQuery('.menu-item-has-children').children('.toggle-sub').length === 0 && jQuery('.menu-item-has-children').children('.toggle-sub').length < 1)
                jQuery('.menu-item-has-children > a').after('<span class="toggle-sub">Toggle</span>');
            jQuery('html').on('click', function() {
                jQuery('.open-menu').removeClass('toggle-active');
                jQuery('.navigation .menu, .search-box').slideUp(300);
            });
            jQuery('.navigation .menu, .open-menu, .search-box').on('click', function(evt) {
                evt.stopPropagation();
            });
        } else {
            jQuery('.navigation .menu, .search-box').css('display', 'inline-block');
            jQuery('.toggle-sub').remove();
        }
    }).trigger('resize');;
    

})(jQuery);