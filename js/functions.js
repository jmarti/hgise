// source and publications
$(document).ready(function() {

	//sources and publications
	height_publications = function() {
		return $('#publications').height();
	};
	height_sources = function() {
		return $('#sources').height();
	};
	if (height_sources < height_publications) {
		$('#publications').css("height",height_sources()+"px");
	};
	if (height_sources > height_publications) {
		$('#sources').css("height",height_publications()+"px");
	};

	//accordion
	$('.accordionButton').click(function() {
		$('.accordionButton').removeClass('opened');
	 	$('.accordionContent').slideUp('normal');
		if($(this).next().is(':hidden') == true) {
			$(this).addClass('opened');
			$(this).next().slideDown('normal');
		}
	});
	$('.accordionButton').mouseover(function() {
		$(this).addClass('over');
	}).mouseout(function() {
		$(this).removeClass('over');										
	});
	$('.accordionContent').hide();
	$('.accordionButton').each(function() {
		if($(this).hasClass('opened') && $(this).next().is(':hidden') == true) {
			$(this).addClass('opened');
			$(this).next().slideDown('normal');
		}
	})

	//fancybox
    $('.fancybox').fancybox();

	//sliders
	$('#video-gallery-slider-1').rhinoslider({
		controlsMousewheel: false,
		controlsKeyboard: false,
		controlsPlayPause: false,
		showCaptions: 'always',
		showBullets: 'never',
		showControls: 'always',
		slidePrevDirection: 'toRight',
		slideNextDirection: 'toLeft',
		effectTime: 600,
		partDelay: 0
	});

	$('#facts-gallery-slider').rhinoslider({
		controlsMousewheel: false,
		controlsKeyboard: false,
		controlsPlayPause: false,
		showCaptions: 'always',
		showBullets: 'never',
		showControls: 'always',
		slidePrevDirection: 'toRight',
		slideNextDirection: 'toLeft',
		effectTime: 600,
		partDelay: 0
	});

	$('#home-featured-slider').rhinoslider({
		controlsMousewheel: false,
		controlsKeyboard: false,
		controlsPlayPause: false,
		showCaptions: 'always',
		showBullets: 'never',
		slidePrevDirection: 'toRight',
		slideNextDirection: 'toLeft',
		effectTime: 600,
		partDelay: 0
	});

	$('#home-videos-slider').rhinoslider({
		controlsMousewheel: false,
		controlsKeyboard: false,
		controlsPlayPause: false,
		showCaptions: 'always',
		showBullets: 'never',
		slidePrevDirection: 'toRight',
		slideNextDirection: 'toLeft',
		effectTime: 600,
		partDelay: 0
	});

	$('#ines').rhinoslider({
		controlsMousewheel: false,
		controlsKeyboard: false,
		controlsPlayPause: false,
		showCaptions: 'always',
		showBullets: 'never',
		slidePrevDirection: 'toRight',
		slideNextDirection: 'toLeft',
		effectTime: 600,
		partDelay: 0
	});

	//tabs
	$( "#areas-type" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#areas-type li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
});


$(window).on('load', function() {
	$('.map-gallery-slider').each(function() {
		$(this).rhinoslider({
			controlsMousewheel: false,
			controlsKeyboard: false,
			controlsPlayPause: false,
			showCaptions: 'always',
			showBullets: 'never',
			showControls: 'always',
			slidePrevDirection: 'toRight',
			slideNextDirection: 'toLeft',
			effectTime: 600,
			partDelay: 0
		});
		$(this).addClass('slider-loaded');
	})
});