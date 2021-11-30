$(function () {
	Carousels.init();
	ArticlesFilter.init();
	MainCarousel.init();
	Articles.init();
	Aside.init();
	Calendar.init();
	Map.init();
	CustomSelect.init();
	Navigation.init();
	Modals.init();
	Search.init();
	Shortener.init();
	MasonryListing.init();
	Countdown.init();
	CountTo.init();
	SkillsPercentage.init();
	ImageLightbox.init();
	Accordion.init();
	Charts.init();
	Preloader.init();

	$(window).resize(function() {
		Shortener.init();
		CustomSelect.init();
	});
});

// Carousels init
Carousels = {
	init: function() {
		// Aside carousels init
		if ($('.js-quotes-carousel')) {
			$('.js-quotes-carousel').owlCarousel({
				items: 1,
				loop: false,
				nav: false,
				dots: true,
				mouseDrag: false
			});
		}

		// Partners
		if ($('.js-partners').length) {
			$('.js-partners').owlCarousel({
				margin: 30,
				nav: false,
				smartSpeed: 500,
				dots: true,
				mouseDrag: false,
				responsive: {
					0: {
						items: 1
					},
					400: {
						items: 2
					},
					768: {
						items: 3
					},
					992: {
						items: 4
					},
				}
			});
		}
	}
}

// Main carousel
MainCarousel = {
	init: function() {
		if ('.js-main-carousel-1') {
			$('.js-main-carousel-1').owlCarousel({
				items: 2,
				loop: true,
				nav: false,
				dots: true,
				mouseDrag: false,
				responsive: {
					0: {
						items: 1
					},
					580: {
						items: 2
					}
				},
				smartSpeed: 100
			});
		}
	}
}

// Tabs
ArticlesFilter = {
	init: function() {
		$('.js-tabs a').on('click', function() {
			$(this).parent().siblings().find('a').removeClass('active');
			$(this).addClass('active');
		});
	}
}

// Articles
Articles = {
	init: function() {

		// Post gallery carousel init
		if ($('.js-post-gallery-carousel').length) {
			$('.js-post-gallery-carousel').owlCarousel({
				loop: true,
				margin: 0,
				nav: true,
				items: 1,
				smartSpeed: 150,
				dots: false,
				mouseDrag: false,
				navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
			});
		}

		// Related articled carosuel init
		if ($('.js-related-articles-carousel').length) {
			$('.js-related-articles-carousel').owlCarousel({
				margin: 20,
				nav: false,
				smartSpeed: 300,
				dots: true,
				mouseDrag: false,
				navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
				responsive: {
					0: {
						items: 1
					},
					601: {
						items: 2
					},
					768: {
						items: 1
					},
					992: {
						items: 2
					},
				}
			});
		}
	}
}

// Aside carousels
Aside = {
	init: function() {

		// Aside carousels init
		if ($('.js-aside-carousel')) {
			$('.js-aside-carousel').owlCarousel({
				items: 1,
				loop: false,
				nav: true,
				dots: false,
				mouseDrag: false,
				navRewind: false,
				navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
			});
		}
	}
}

// Calendar
Calendar = {
	init: function() {
		if ($('.js-calendar').length) {
			$('.js-calendar').clndr({
				template: $('#clndr-template').html(),
				weekOffset: 1,
				events: Calendar.events,
				clickEvents: {
					click: function(target) {
						if (target.events[0]) {
							window.location.href = target.events[0].url;
						}
					}
				}
			});
		}
	}
}

// Google map initialization
Map = {
	init: function() {
		if ($('#googleMap').length) {
			var lat = $('#googleMap').attr('data-lat');
			var lng = $('#googleMap').attr('data-lng');
			var zoomSize = typeof $('#googleMap').attr('data-zoom') === 'undefined' ? 16 : parseInt($('#googleMap').attr('data-zoom'));
			
			function initialize() {
				var view = new google.maps.LatLng(lat, lng);
				var mapOptions = {
					zoom: zoomSize,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					scrollwheel: false,
					disableDefaultUI: true,
					center: view,
					draggable: true
				}
				
				var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
				
				// Set custom marker
				var myLatLng = new google.maps.LatLng(lat, lng);
				var marker = new google.maps.Marker({
					position: myLatLng,
					map: map,
					icon: 'img/map-pin.png'
				});
			}

			google.maps.event.addDomListener(window, 'load', initialize);
		}
	}
}

// Custom select initialization
CustomSelect = {
	init: function() {
		if ($('.js-select').length) {
			$('.js-select').select2();
		}
	}
}

// Navigation
Navigation = {
	init: function() {
		
		if ($('.categoriesNavigation').length) {
			var stickyRibbonTop = $('.categoriesNavigation').offset().top;
			$(window).scroll(function(){
				if($(window).scrollTop() > stickyRibbonTop && $('.navbar-toggle').is(':hidden')) {
					$('.categoriesNavigation').addClass('fixedCategories');
				} else {
					$('.categoriesNavigation').removeClass('fixedCategories');
				}
			});
		}

		$('.dropdown.onHover').hover(
			function() {
				if ($('.navbar-toggle').is(':hidden')) {
					$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
				}
			}, 
			function() {
				if ($('.navbar-toggle').is(':hidden')) {
					$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
				}
			});

		$('.dropdown.onHover .dropdown-menu').hover(
			function() {
				if ($('.navbar-toggle').is(':hidden')) {
					$(this).stop(true, true);
				}
			},
			function() {
				if ($('.navbar-toggle').is(':hidden')) {
					$(this).stop(true, true).delay(200).fadeOut(200);
				}
			}
		);
	}
}

// Modals
Modals = {
	init: function() {
		$('.modal').on('show.bs.modal', centerModals);
		$(window).on('resize', centerModals);
	}
}

// Search
Search = {
	init: function() {
		$('.js-advanced-search').click(function() {
			$(this).siblings('.advancedWrap').slideToggle(200, function() {
				$('.js-select').select2();
			});
		});
	}
}

// Text shortener
Shortener = {
	init: function() {
		if ($('.js-shortener').length) {
			$('.js-shortener').each(function() {
				var maxHeight = parseInt($(this).attr('data-maxheight'));
				$(this).dotdotdot({
					height: maxHeight
				});
			});
		}
	}
}

// Masonry listing
MasonryListing = {
	init: function() {
		MasonryListing.work();
		$(window).load(function() {
			MasonryListing.work();
		});
	},
	work: function() {
		if ($('.js-masonry-listing').length) {
			$('.js-masonry-listing').masonry({
				isOriginLeft: true,
			});
		}
	}
}

// Countdown initialization
Countdown = {
	init: function() {
		if ($('.js-countdown').length) {
			$('.js-countdown').countdown('2015/12/30').on('update.countdown', function(event) {
				var template = '<div class="i"><div class="num">%D</div><div class="text">days</div></div>';
				template += '<div class="i"><div class="num">%H</div><div class="text">hours</div></div>';
				template += '<div class="i"><div class="num">%M</div><div class="text">minutes</div></div>';
				template += '<div class="i"><div class="num">%S</div><div class="text">seconds</div></div>';
				var $this = $(this).html(event.strftime(template));
			});
		}
	}
}

// Count to
CountTo = {
	init: function() {
		if ($('.js-count').length) {
			$('.js-count').waypoint(function() {
				$('.js-count').data('countToOptions', {
					formatter: function (value, options) {
						return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
					}
				});
				$('.js-count').each(CountTo.count);
			}, {
				triggerOnce: true,
				offset: 'bottom-in-view'
			});
		}	
	},
	count: function(options) {
		var $this = $(this);
		options = $.extend({}, options || {}, $this.data('countToOptions') || {});
		$this.countTo(options);
	}
}

// Skills
SkillsPercentage = {
	init: function() {
		if ($('.js-percentage').length) {
			$('.js-percentage').waypoint(function() {
				var percentage = $(this.element).attr('data-percentage') + '%';
				$(this.element).width(percentage);
			}, {
				triggerOnce: true,
				offset: 'bottom-in-view'
			});
		}	
	}
}

// Image lightbox
ImageLightbox = {
	init: function() {
		if ($('.js-imagelightbox').length) {
			$('.js-imagelightbox').magnificPopup({
				delegate: '.js-lightbox',
				type: 'image',
				gallery: {
					enabled: false
				},
				zoom: {
					enabled: true					
				}
			});
		}
	}
}

Accordion = {
	init: function() {
		$('.js-accordion-title a').click(function() {
			var text = $(this).find('span em').text() == '+' ? '-'  : '+';
			$(this).parents('.panel-group').find('.js-accordion-title a span em').text('+');
			$(this).find('span em').text(text);
		});
	}
}

Charts = {
	init: function() {
		// Charts initialization
		if ($('.chart').length) {
			$('.chart').waypoint(function() {
				$('.chart').easyPieChart({
					barColor: $('.navbar-toggle').css('color'),
					animate: 3000,
					trackColor: '#e1e1e1',
					lineWidth: 6,
					size: 170,
					lineCap: 'square',
					scaleColor: '#fff'
				});
			}, {
				triggerOnce: true,
				offset: 'bottom-in-view'
			});
		}
	},
	update: function() {
		$('.chart').each(function() {
			var api = $(this).data('easyPieChart');
			var value = $(this).attr('data-percent');
			api.options.barColor = $('.navbar-toggle').css('color');
			api.update(value);
		});
	}
}

Preloader = {
	init: function() {
		Pace.on('done', function() {
			$('body').addClass('page-loaded');
		});
	}
}


/***** FUNCTIONS ************************************************************************************************/
function centerModals(){
	$('.modal').each(function(i){
		var $clone = $(this).clone().css('display', 'block').appendTo('body');
		var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
		top = top > 0 ? top : 0;
		$clone.remove();
		$(this).find('.modal-content').css("margin-top", top);
	});
}