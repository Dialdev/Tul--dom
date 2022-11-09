"use strict";
var marker = null;
var menu_position = null;
// google multi recaptcha
var onloadCallback = function() {
	var arr_recaptcha =  $('.g-recaptcha');
	if(arr_recaptcha.length > 0){
		arr_recaptcha.each(function(index){
			grecaptcha.render($(arr_recaptcha[index]).attr('id'), {
				'sitekey' : recaptcha_open_key
			});
		});
    }
};

$(document).ready(function($){

    if($('body').width() < '1189'){
        var input_calendar = $('.form-window-wrap.form-appointments #date');
        if(input_calendar.length > 0){
            input_calendar.removeAttr('disabled');
		}
    }
	//search form
	$("body").on("click",'.template-search', function(event){
		event.preventDefault();
		var elem = $(this).parent().children(".search");
		if(!elem.hasClass('active')){
            elem.fadeIn(300);
            elem.addClass('active');
		}
		else{
            elem.fadeOut(300);
            elem.removeClass('active');
		}

	});
	//mobile menu
	$(".mobile-menu-switch").on("click", function(event){
		event.preventDefault();
		$(this).toggleClass('active');
		if(!$(".mobile-menu").is(":visible")) {
            $(".mobile-menu-divider").css("display", "block");
            $('.search-container').hide();
        }
		$(".mobile-menu").slideToggle(500, function(){
			if(!$(".mobile-menu").is(":visible")) {
                $(".mobile-menu-divider").css("display", "none");
                $('.search-container').fadeIn(100);
            }
		});
	});
	$(".collapsible-mobile-submenus .template-arrow-menu").on("click", function(event){
		event.preventDefault();
		$(this).toggleClass('active');
		$(this).next().slideToggle(300);
	});
	//header toggle
	$(".header-toggle").on("click", function(event){
		event.preventDefault();
		$(this).prev().slideToggle();
		$(this).toggleClass("active");
	});
	//parallax
	if(!navigator.userAgent.match(/(iPod|iPhone|iPad|Android)/))
		$(".parallax").parallax({});
	else
		$(".parallax").addClass("cover");

	//reviews for main page
	$(".testimonials-list").each(function(){
		var self = $(this);
		self.carouFredSel({
			width: "auto",
			items: {
				visible: 1
			},
			scroll: {
				items: 1,
				easing: "easeInOutQuint",
				duration: 750
			},
			auto: {
				play: false
			},
			'prev': {button: self.prev()},
			'next': {button: self.next()}
		},
		{
			transition: true,
			wrapper: {
				classname: "caroufredsel_wrapper caroufredsel_wrapper_testimonials"
			}
		});
		var base = "x";
		var scrollOptions = {
			scroll: {
				easing: "easeInOutQuint",
				duration: 750
			}
		};
		self.swipe({
			fallbackToMouseEvents: true,
			allowPageScroll: "vertical",
			excludedElements:"button, input, select, textarea, .noSwipe",
			swipeStatus: function(event, phase, direction, distance, fingerCount, fingerData ) {
				if(!self.is(":animated"))
				{
					self.trigger("isScrolling", function(isScrolling){
						if(!isScrolling)
						{
							if (phase == "move" && (direction == "left" || direction == "right"))
							{
								if(base=="x")
								{
									self.trigger("configuration", scrollOptions);
									self.trigger("pause");
								}
								if (direction == "left")
								{
									if(base=="x")
										base = 0;
									self.css("left", parseInt(base, 10)-distance + "px");
								}
								else if (direction == "right")
								{
									if(base=="x" || base==0)
									{
										self.children().last().prependTo(self);
										base = -self.children().first().width();
									}
									self.css("left", base+distance + "px");
								}

							}
							else if (phase == "cancel")
							{
								if(distance!=0)
								{
									self.trigger("play");
									self.animate({
										"left": base + "px"
									}, 750, "easeInOutQuint", function(){
										if(base==-self.children().first().width())
										{
											self.children().first().appendTo(self);
											self.css("left", "0px");
											base = "x";
										}
										self.trigger("configuration", {scroll: {
											easing: "easeInOutQuint",
											duration: 750
										}});
									});
								}
							}
							else if (phase == "end")
							{
								self.trigger("play");
								if (direction == "right")
								{
									self.animate({
										"left": 0 + "px"
									}, 750, "easeInOutQuint", function(){
										self.trigger("configuration", {scroll: {
											easing: "easeInOutQuint",
											duration: 750
										}});
										base = "x";
									});
								}
								else if (direction == "left")
								{
									if(base==-self.children().first().width())
									{
										self.children().first().appendTo(self);
										self.css("left", (parseInt(self.css("left"), 10)-base)+"px");
									}
									self.trigger("nextPage");
									base = "x";
								}
							}
						}
					});
				}
			}
		});
	});
	//our-clients
	$(".our-clients-list").each(function(index){
		$(this).addClass("re-preloader_" + index);
		$(".re-preloader_" + index).before("<span class='re-preloader'></span>");
		$(".re-preloader_" + index + " img:first").one("load", function(){
			$(".re-preloader_" + index).prev(".re-preloader").remove();
			$(".re-preloader_" + index).fadeTo("slow", 1, function(){
				$(this).css("opacity", "");
			});
			var self = $(".re-preloader_" + index);
			self.carouFredSel({
				items: {
					visible: ($(".header").width()>750 ? 6 : ($(".header").width()>462 ? 4 : 2))
				},
				scroll: {
					items: ($(".header").width()>750 ? 6 : ($(".header").width()>462 ? 4 : 2)),
					easing: "easeInOutQuint",
					duration: 750
				},
				auto: {
					play: false
				},
				pagination: {
					items: ($(".header").width()>750 ? 6 : ($(".header").width()>462 ? 4 : 2)),
					container: $(self).next()
				}
			});
			var base = "x";
			var scrollOptions = {
				scroll: {
					easing: "easeInOutQuint",
					duration: 750
				}
			};
			self.swipe({
				fallbackToMouseEvents: true,
				allowPageScroll: "vertical",
				excludedElements:"button, input, select, textarea, .noSwipe",
				swipeStatus: function(event, phase, direction, distance, fingerCount, fingerData ) {
					if(!self.is(":animated"))
					{
						self.trigger("isScrolling", function(isScrolling){
							if(!isScrolling)
							{
								if (phase == "move" && (direction == "left" || direction == "right"))
								{
									if(base=="x")
									{
										self.trigger("configuration", scrollOptions);
										self.trigger("pause");
									}
									if (direction == "left")
									{
										if(base=="x")
											base = 0;
										self.css("left", parseInt(base, 10)-distance + "px");
									}
									else if (direction == "right")
									{
										if(base=="x" || base==0)
										{
											self.children().last().prependTo(self);
											base = -self.children().first().width()-parseInt(self.children().first().css("margin-right"), 10);
										}
										self.css("left", base+distance + "px");
									}

								}
								else if (phase == "cancel")
								{
									if(distance!=0)
									{
										self.trigger("play");
										self.animate({
											"left": base + "px"
										}, 750, "easeInOutQuint", function(){
											if(base==-self.children().first().width()-parseInt(self.children().first().css("margin-right"), 10))
											{
												self.children().first().appendTo(self);
												self.css("left", "0px");
												base = "x";
											}
											self.trigger("configuration", {scroll: {
												easing: "easeInOutQuint",
												duration: 750
											}});
										});
									}
								}
								else if (phase == "end")
								{
									self.trigger("play");
									if (direction == "right")
									{
										self.trigger("prevPage");
										self.children().first().appendTo(self);
										self.animate({
											"left": 0 + "px"
										}, 200, "linear", function(){
											self.trigger("configuration", {scroll: {
												easing: "easeInOutQuint",
												duration: 750
											}});
											base = "x";
										});
									}
									else if (direction == "left")
									{
										if(base==-self.children().first().width()-parseInt(self.children().first().css("margin-right"), 10))
										{
											self.children().first().appendTo(self);
											self.css("left", (parseInt(self.css("left"), 10)-base)+"px");
										}
										self.trigger("nextPage");
										self.trigger("configuration", {scroll: {
											easing: "easeInOutQuint",
											duration: 750
										}});
										base = "x";
									}
								}
							}
						});
					}
				}
			});
		}).each(function(){
			if(this.complete)
				$(this).load();
		});
	});
	//preloader
	var preloader = function()
	{
		$(".blog a.post-image>img, .post.single .post-image img, .services-list a>img, .galleries-list:not('.isotope') a>img, .re-preload>img").each(function(){
			$(this).before("<span class='re-preloader'></span>");
			$(this).one("load", function(){
				$(this).prev(".re-preloader").remove();
				$(this).fadeTo("slow", 1, function(){
					$(this).css("opacity", "");
				});
				$(this).css("display", "block");
			}).each(function(){
				if(this.complete || $(this).height()>0)
					$(this).load();
			});
		});

	};
	preloader();

	//window resize
	function windowResize(){
		if($('.form-window-wrap.active').length > 0) {
            recalculateModalFormWrapHeight($('.form-window-wrap.active'));
        }
		$(".our-clients-list").each(function(){
			var self = $(this);
			self.trigger("configuration", {
				items: {
					visible: ($(".header").width()>750 ? 6 : ($(".header").width()>462 ? 4 : 2))
				},
				scroll: {
					items: ($(".header").width()>750 ? 6 : ($(".header").width()>462 ? 4 : 2))
				},
				pagination: {
					items: ($(".header").width()>750 ? 6 : ($(".header").width()>462 ? 4 : 2))
				}
			});
		});
		if($(".sticky").length){
            window.fly_menu();
		}
	}
	 window.fly_menu = function(){
        if($(".header-container").hasClass("sticky"))
            menu_position = $(".header-container").offset().top;
        var topOfWindow = $(window).scrollTop();
        if(menu_position!=null && $(".header-container .sf-menu").is(":visible"))
        {
            if(menu_position<topOfWindow)
            {
                if(!$("#cs-sticky-clone").length)
                    $(".header-container").after($(".header-container").clone().attr("id", "cs-sticky-clone").addClass("move"));
            }
            else
            {
                $("#cs-sticky-clone").remove();
            }
        }
        else
            $("#cs-sticky-clone").remove();
	}
	$(window).resize(windowResize);
	window.addEventListener('orientationchange', windowResize);

	if($(".header-container").hasClass("sticky"))
		menu_position = $(".header-container").offset().top;
	function animateElements()
	{
		$('.animated-element, .sticky, .re-smart-column').each(function(){
			var elementPos = $(this).offset().top;
			var topOfWindow = $(window).scrollTop();
			if($(this).hasClass("re-smart-column"))
			{
				var row = $(this).parent();
				var wrapper = $(this).children().first();
				var childrenHeight = 0;
				wrapper.children().each(function(){
					childrenHeight += $(this).outerHeight(true);
				});
				if(childrenHeight<$(window).height() && row.offset().top-20<topOfWindow && row.offset().top-20+row.outerHeight()-childrenHeight>topOfWindow)
				{
					wrapper.css({"position": "fixed", "bottom": "auto", "top": "20px", "width": $(this).width() + "px"});
					$(this).css({"height": childrenHeight+"px"});
				}
				else if(childrenHeight<$(window).height() && row.offset().top-20+row.outerHeight()-childrenHeight<=topOfWindow && (row.outerHeight()-childrenHeight>0))
				{
					wrapper.css({"position": "absolute", "bottom": "0", "top": (row.outerHeight()-childrenHeight) + "px", "width": "auto"});
					$(this).css({"height": childrenHeight+"px"});
				}
				else if(childrenHeight>=$(window).height() && row.offset().top+20+childrenHeight<topOfWindow+$(window).height() && row.offset().top+20+row.outerHeight()>topOfWindow+$(window).height())
				{
					wrapper.css({"position": "fixed", "bottom": "20px", "top": "auto", "width": $(this).width() + "px"});
					$(this).css({"height": childrenHeight+"px"});
				}
				else if(childrenHeight>=$(window).height() && row.offset().top+20+row.outerHeight()<=topOfWindow+$(window).height() && (row.outerHeight()-childrenHeight>0))
				{
					wrapper.css({"position": "absolute", "bottom": "0", "top": (row.outerHeight()-childrenHeight) + "px", "width": "auto"});
					$(this).css({"height": childrenHeight+"px"});
				}
				else
					wrapper.css({"position": "static", "bottom": "auto", "top": "auto", "width": "auto"});
			}
			else if($(this).hasClass("sticky"))
			{
				if(menu_position!=null && $(".header-container .sf-menu").is(":visible"))
				{
					if(menu_position<topOfWindow)
					{
						if(!$("#cs-sticky-clone").length)
							$(this).after($(this).clone().attr("id", "cs-sticky-clone").addClass("move"));
					}
					else
					{
						$("#cs-sticky-clone").remove();
					}
				}
			}
			else if(elementPos<topOfWindow+$(window).height()-20)
			{
				if($(this).hasClass("number") && !$(this).hasClass("progress") && $(this).is(":visible"))
				{
					var self = $(this);
					self.addClass("progress");
					if(typeof(self.data("value"))!="undefined")
					{
						var value = parseFloat(self.data("value").toString().replace(" ",""));
						self.text(0);
						self.text(value);
					}
				}
				else if(!$(this).hasClass("progress"))
				{
					var elementClasses = $(this).attr('class').split(' ');
					var animation = "fadeIn";
					var duration = 600;
					var delay = 0;
					if($(this).hasClass("scroll-top"))
					{
						if(topOfWindow<$(document).height()/2)
						{
							if($(this).hasClass("fadeIn") || $(this).hasClass("fadeOut"))
								animation = "fadeOut";
							else
								animation = "";
							$(this).removeClass("fadeIn")
						}
						else
							$(this).removeClass("fadeOut")
					}
					for(var i=0; i<elementClasses.length; i++)
					{
						if(elementClasses[i].indexOf('animation-')!=-1)
							animation = elementClasses[i].replace('animation-', '');
						if(elementClasses[i].indexOf('duration-')!=-1)
							duration = elementClasses[i].replace('duration-', '');
						if(elementClasses[i].indexOf('delay-')!=-1)
							delay = elementClasses[i].replace('delay-', '');
					}
					$(this).addClass(animation);
					$(this).css({"animation-duration": duration + "ms"});
					$(this).css({"animation-delay": delay + "ms"});
					$(this).css({"transition-delay": delay + "ms"});
				}
			}
		});
	}
	setTimeout(animateElements, 1);
	$(window).scroll(animateElements);
	// apply job
	$('.job-apply').click(function(){
		var form_job = $(this).attr('href');
		if ($(form_job).length != 0) {
            $(form_job).show();
			$('html, body').animate({ scrollTop: $(form_job).offset().top - 200 }, 500);
			var job = $('[name=job]');
            job.val($(this).data('jobname'));
            job.data('jobid',$(this).data('jobid'));
		}
		return false;
	});
    // ask question
    $('.ask-question').click(function(){
        var form_question = $(this).attr('href');
        if ($(form_question).length != 0) {
            $(form_question).show();
            $('html, body').animate({ scrollTop: $(form_question).offset().top - 200 }, 500);
			var staff = $('[name=staff]');
			staff.val($(this).data('staffname'));
			staff.data('staffid',$(this).data('staffid'));
			staff.data('email',$(this).data('email'));
        }
        return false;
    });
	//modal window build question
    $('.button-form.form-question').click(function(){
        var build = $('.form-question [name = build]');
        build.val($(this).data('buildname'));
        build.data('buildid',$(this).data('buildid'));
        var form = $('.form-window-wrap.form-question');
        form.height($(window).height());
        form.addClass('active');
        var body = $('html, body');
        if(body.width() > '1189') {
            body.css('padding-right', '8px');
        }
        body.css('overflow-y','hidden');
        form.fadeIn(300);
		return false;
	});

    $('.form-window-wrap .close').click(function(){
    	var form_window_wrap = $('.form-window-wrap');
        form_window_wrap.removeClass('active');
        if($('.popup-window').length){
        	$('.popup-window').hide();
		}
        form_window_wrap.fadeOut(300);
        var body = $('html, body');
        body.css('overflow-y','');
        body.css('padding-right','0px');
        return false;
    });
    //modal window call
    $('.button-form.form-call').click(function(){
    	var form = $('.form-window-wrap.form-call');
        form.height($(window).height());
        form.addClass('active');
        form.fadeIn(300);
        var body = $('html, body');
        if(body.width() > '1189') {
            body.css('padding-right', '8px');
        }
        body.css('overflow-y','hidden');
        return false;
    });
    //modal appointments
    $('.button-form.form-appointments').click(function(){
        var service = $('.form-appointments [name=service]');
        service.val($(this).data('servicename'));
        service.data('serviceid',$(this).data('serviceid'));
        var form = $('.form-window-wrap.form-appointments');
        form.height($(window).height());
        form.addClass('active');
        form.fadeIn(300);
        var body = $('html, body');
        if(body.width() > '1189') {
            body.css('padding-right', '8px');
        }
        body.css('overflow-y','hidden');
        return false;
    });
    //download files
	$('.download').click(function(){
		var type = $(this).data('type');
		var name = $(this).data('name');
		var src = $(this).data('src');
        location = "/bitrix/templates/.default/ajax/download.php?type="+type+"&name="+name+"&src="+src;
        return false;
	});

	//fancybox
    var $links = $('a.gallery');
    $links.on('click', function() {
        $.fancybox.open( $links, {
        }, $links.index( this ) );
        return false;
    });

	function recalculateModalFormWrapHeight(form){
		form.height($(window).height());
	}

});