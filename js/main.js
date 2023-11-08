/* =================================
------------------------------------
	ST GABRIEL PRE UNIVERSITY - University Template
	Version: 1.0
 ------------------------------------ 
 ====================================*/



'use strict';


var window_w = $(window).innerWidth();

$(window).on('load', function() {
	/*------------------
		Preloder
	--------------------*/
	$(".loader").fadeOut(); 
	$("#preloder").delay(400).fadeOut("slow");

});

(function($) {

	/*------------------
		Navigation
	--------------------*/
	$('.nav-switch').on('click', function(event) {
		$('.main-menu').slideToggle(400);
		event.preventDefault();
	});


	/*------------------
		Background set
	--------------------*/
	$('.set-bg').each(function() {
		var bg = $(this).data('setbg');
		$(this).css('background-image', 'url(' + bg + ')');
	});

	
	/*------------------
		Hero Slider
	--------------------*/
	var window_h = $(window).innerHeight();
	var header_h = $('.header-section').innerHeight();
	var nav_h = $('.nav-section').innerHeight();

	if (window_w > 767) {
		$('.hs-item').height((window_h)-((header_h)+(nav_h)));
	}

	$('.hero-slider').owlCarousel({
		loop: true,
		nav: false,
		dots: true,
		mouseDrag: false,
		animateOut: 'fadeOut',
    	animateIn: 'fadeIn',
		items: 1,
		autoplay: true
	});


	/*------------------
		Counter
	--------------------*/
	// $(".counter").countdown("2018/07/01", function(event) {
	// 	$(this).html(event.strftime("<div class='counter-item'><h4>%D</h4>Days</div>" + "<div class='counter-item'><h4>%H</h4>hours</div>" + "<div class='counter-item'><h4>%M</h4>Mins</div>" + "<div class='counter-item'><h4>%S</h4>secs</div>"));
	// });


	/*------------------
		Gallery
	--------------------*/
	$('.gallery').find('.gallery-item').each(function() {
		var pi_height1 = $(this).width(),
		pi_height2 = pi_height1/2;
		
		if($(this).hasClass('gi-long') && window_w > 991){
			$(this).css('height', pi_height2);
		}else{
			$(this).css('height', Math.abs(pi_height1));
		}
	});

	$('.gallery').masonry({
		itemSelector: '.gallery-item',
		columnWidth: '.grid-sizer'
	});
	


	/*------------------
		Testimonial
	--------------------*/
	$('.testimonial-slider').owlCarousel({
		loop: true,

		// if use nav, this is setup nav
		nav: false,
		navText: ['<button class="btn btn-danger btn-sm" style="vertical-align: super; !important">Previous</button>', '</i><button class="btn btn-danger btn-sm" style="vertical-align: super; !important">Next</button>'],
		// 		navText: ['<i class="fa fa-angle-left fa-sm" style="font-size: 0.5rem;"></i>', '</i><i class="fa fa-angle-right fa-sm" style="font-size: 0.5rem;"></i>'],
		
		// if use dots, set to fixed dots to true
		dots: false,

		animateOut: 'fadeOutUp',
		animateIn: 'fadeInUp',
		items: 1,
		autoplay: true,
	});


	var owl = $('.testimonial-slider');
	$('.prev-btn').click(function() {
		owl.trigger('prev.owl.carousel');
	});

	$('.next-btn').click(function() {
		owl.trigger('next.owl.carousel');
	});
	


	/*------------------
		Popup
	--------------------*/
	$('.gallery-popup').magnificPopup({
		type: 'image',
		mainClass: 'img-popup-warp',
		removalDelay: 400,
	});

	// Gallery - uses the magnific popup jQuery plugin
	// $('.gallery-popup').magnificPopup({
	// 	type: 'image',
	// 	removalDelay: 300,
	// 	mainClass: 'mfp-fade',
	// 	gallery: {
	// 	  enabled: true
	// 	},
	// 	zoom: {
	// 	  enabled: true,
	// 	  duration: 300,
	// 	  easing: 'ease-in-out',
	// 	  opener: function(openerElement) {
	// 		return openerElement.is('img') ? openerElement : openerElement.find('img');
	// 	  }
	// 	}
	//   });



})(jQuery);

