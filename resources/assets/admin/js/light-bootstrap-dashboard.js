var searchVisible = 0;
var transparent = true;

var transparentDemo = true;
var fixedTop = false;

var mobile_menu_visible = 0,
    mobile_menu_initialized = false,
    toggle_initialized = false,
    bootstrap_nav_initialized = false,
    $sidebar;


(function(){
    var mac = navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i) ? true : false;

    if (!mac){
       // if we are on windows OS we activate the perfectScrollbar function
       $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

       $('body').addClass('windows-os');
   } else {
       $('body').addClass('mac-os');
   }
})();

$(document).ready(function(){

    window_width = $(window).width();
    $sidebar = $('.sidebar');

    // check if there is an image set for the sidebar's background
    lbd.checkSidebarImage();

    // Init navigation toggle for small screens
    if(window_width <= 991){
        if($sidebar.length != 0){

            // we inith the sidebar if we we are in a page that contains the sidebar
            lbd.initSidebarMenu();
        } else {

            // if we don't have a sidebar we transform the regular navbar from bootstrap into a side menu for mobile
            lbd.initBootstrapNavbarMenu();
        }

    }

    $('.form-control').on("focus", function(){
        $(this).parent('.input-group').addClass("input-group-focus");
    }).on("blur", function(){
        $(this).parent(".input-group").removeClass("input-group-focus");
    });

    // Init Collapse Areas
    lbd.initCollapseArea();

    // Init Tooltips
    $('[rel="tooltip"]').tooltip();

    // Init Tags Input
    if($(".tagsinput").length != 0){
        $(".tagsinput").tagsInput();
    }

    //  Init Bootstrap Select Picker
    if($(".selectpicker").length != 0){
        $(".selectpicker").selectpicker();
    }

});

// activate mobile menus when the windows is resized
$(window).resize(function(){
    if($(window).width() <= 991){
        if($sidebar.length != 0){
            lbd.initSidebarMenu();
        } else {
            lbd.initBootstrapNavbarMenu();
        }
    }
});

lbd = {
    checkSidebarImage: function(){
        $sidebar = $('.sidebar');
        image_src = $sidebar.data('image');

        if(image_src !== undefined){
            sidebar_container = '<div class="sidebar-background" style="background-image: url(' + image_src + ') "/>'
            $sidebar.append(sidebar_container);
        }
    },

    checkFullPageBackgroundImage: function(){
        $page = $('.full-page');
        image_src = $page.data('image');

        if(image_src !== undefined){
            image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>'
            $page.append(image_container);
        }
    },

    initSidebarMenu: debounce(function(){
        $sidebar_wrapper = $('.sidebar-wrapper');

        if(!mobile_menu_initialized){

            $navbar = $('nav').find('.navbar-collapse').first().clone(true);

            nav_content = '';
            mobile_menu_content = '';

            //add the content from the regular header to the mobile menu
            $navbar.children('ul').each(function(){
                content_buff = $(this).html();
                nav_content = nav_content + content_buff;
            });

            nav_content = '<ul class="nav nav-mobile-menu">' + nav_content + '</ul>';
            $navbar_form = $('nav').find('.navbar-form').clone(true);

            $sidebar_nav = $sidebar_wrapper.find(' > .nav');

            // insert the navbar form before the sidebar list
            $navbar_form.insertBefore($sidebar_nav);
            $navbar_form.after(nav_content);

            $(".sidebar-wrapper .dropdown .dropdown-menu > li > a").click(function(event) {
                event.stopPropagation();
            });

            mobile_menu_initialized = true;
        } else {

            if($(window).width > 991){
                // reset all the additions that we made for the sidebar wrapper only if the screen is bigger than 991px
                $sidebar_wrapper.find('.navbar-form').remove();
                $sidebar_wrapper.find('.nav-mobile-menu').remove();

                mobile_menu_initialized = false;
            }
        }

        if(!toggle_initialized){
            $toggle = $('.navbar-toggle');

            $toggle.click(function (){

                if(mobile_menu_visible == 1) {
                    $('html').removeClass('nav-open');

                    $('.close-layer').remove();
                    setTimeout(function(){
                        $toggle.removeClass('toggled');
                    }, 400);

                    mobile_menu_visible = 0;
                } else {
                    setTimeout(function(){
                        $toggle.addClass('toggled');
                    }, 430);

                    main_panel_height = $('.main-panel')[0].scrollHeight;
                    $layer = $('<div class="close-layer"></div>');
                    $layer.css('height',main_panel_height + 'px');
                    $layer.appendTo(".main-panel");

                    setTimeout(function(){
                        $layer.addClass('visible');
                    }, 100);

                    $layer.click(function() {
                        $('html').removeClass('nav-open');
                        mobile_menu_visible = 0;

                        $layer.removeClass('visible');

                         setTimeout(function(){
                            $layer.remove();
                            $toggle.removeClass('toggled');

                         }, 400);
                    });

                    $('html').addClass('nav-open');
                    mobile_menu_visible = 1;

                }
            });

            toggle_initialized = true;
        }
    }, 500),

    initBootstrapNavbarMenu: debounce(function(){
        if(!bootstrap_nav_initialized){
            $navbar = $('nav').find('.navbar-collapse').first().clone(true);

            nav_content = '';
            mobile_menu_content = '';

            //add the content from the regular header to the mobile menu
            $navbar.children('ul').each(function(){
                content_buff = $(this).html();
                nav_content = nav_content + content_buff;
            });

            nav_content = '<ul class="nav navbar-nav">' + nav_content + '</ul>';

            $navbar.html(nav_content);
            $navbar.addClass('bootstrap-navbar');

            // append it to the body, so it will come from the right side of the screen
            $('body').append($navbar);

            $toggle = $('.navbar-toggle');

            $navbar.find('a').removeClass('btn btn-round btn-default');
            $navbar.find('button').removeClass('btn-round btn-fill btn-info btn-primary btn-success btn-danger btn-warning btn-neutral');
            $navbar.find('button').addClass('btn-simple btn-block');

            $toggle.click(function (){
                if(mobile_menu_visible == 1) {
                    $('html').removeClass('nav-open');

                    $('.close-layer').remove();
                    setTimeout(function(){
                        $toggle.removeClass('toggled');
                    }, 400);

                    mobile_menu_visible = 0;
                } else {
                    setTimeout(function(){
                        $toggle.addClass('toggled');
                    }, 430);

                    $layer = $('<div class="close-layer"></div>');
                    $layer.appendTo(".wrapper-full-page");

                    setTimeout(function(){
                        $layer.addClass('visible');
                    }, 100);

                    $layer.click(function() {
                        $('html').removeClass('nav-open');
                        mobile_menu_visible = 0;

                        $layer.removeClass('visible');

                         setTimeout(function(){
                            $layer.remove();
                            $toggle.removeClass('toggled');

                         }, 400);
                    });

                    $('html').addClass('nav-open');
                    mobile_menu_visible = 1;

                }

            });
            bootstrap_nav_initialized = true;
        }
    }, 500),

    initCollapseArea: function(){
        $('[data-toggle="collapse-hover"]').each(function () {
            var thisdiv = $(this).attr("data-target");
            $(thisdiv).addClass("collapse-hover");
        });

        $('[data-toggle="collapse-hover"]').hover(function(){
            var thisdiv = $(this).attr("data-target");
            if(!$(this).hasClass('state-open')){
                $(this).addClass('state-hover');
                $(thisdiv).css({
                    'height':'30px'
                });
            }

        },
        function(){
            var thisdiv = $(this).attr("data-target");
            $(this).removeClass('state-hover');

            if(!$(this).hasClass('state-open')){
                $(thisdiv).css({
                    'height':'0px'
                });
            }
        }).click(function(event){
                event.preventDefault();

                var thisdiv = $(this).attr("data-target");
                var height = $(thisdiv).children('.panel-body').height();

                if($(this).hasClass('state-open')){
                    $(thisdiv).css({
                        'height':'0px',
                    });
                    $(this).removeClass('state-open');
                } else {
                    $(thisdiv).css({
                        'height':height + 30,
                    });
                    $(this).addClass('state-open');
                }
            });
    }
}


// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds. If `immediate` is passed, trigger the function on the
// leading edge, instead of the trailing.

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		clearTimeout(timeout);
		timeout = setTimeout(function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		}, wait);
		if (immediate && !timeout) func.apply(context, args);
	};
};
