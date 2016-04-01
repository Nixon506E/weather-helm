/*
* 
*  RECESS JS  
*  Recess Creative - @2014 UID 
*  
*/


// GLOBAL VARIABLES
var scuttlebutted = false;


	
if (typeof RECESS == 'undefined') { 
  RECESS = {};
}

RECESS.site = function() 
{
	return {

		init: function () 
		{
			//console.log('JS Working');
			$('.site-nav .expanded .menu, .sitemap .expanded .menu').remove();
			RECESS.site.initEvents();


			$(window).resize(function(){
				RECESS.site.resize();
			});

			$(window).load(function(){
				$(window).resize();
				RECESS.site.slideInAnimations();
				
				setTimeout(function(){
					RECESS.site.initScuttlebutt();

				}, 600);
				if (RECESS.site.queryString('confirmation') == 'true') { 
					$('.apply-form .success').show();
					$('.apply-form .block-webform').hide();
					$("body, html").delay(500).animate({
					    scrollTop: 1200
					});
				}
				if (RECESS.site.queryString('confirmation') == 'contact' && $('body').hasClass('page-node-7')) { 
					$('.contact-form-section .success').show();
					$('.contact-form-section .block-webform').hide();
					 $("body, html").animate({
					     scrollTop: 300
					 });
				}
			});

			$(window).scroll(RECESS.site.scroll);


			// TEMPORARILY REMOVE ARTISTSDEN LINK UNTIL FIXED
			if( $('body').hasClass('page-node-93') )
			{
				$('.leaderboard header a').remove();
				$('.share-section .button').remove();
			}
		},
		
		initEvents: function ()
		{
			// INIT JQUERY EVENTS 

			var returnedSort = $('.masonry .item').sort(function (b, a) {
		    	var contentA =parseInt( $(a).find('.description .date').attr('data-timestamp'));
		    	var contentB =parseInt( $(b).find('.description .date').attr('data-timestamp'));
		    	return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
	   		}); 

			$('.masonry.scuttlebutt').html(returnedSort);
			
			RECESS.site.resize();
			RECESS.site.caseStudyMathClasses();
			RECESS.site.flipCards();
			RECESS.site.sortBrandList();
			
			if ($('#home .banner .slide-container').length > 0 ) 
			{
				$('#home .banner .slide-container').carouFredSel({
						items : 1,
						scroll : {
				            items           : 1,
				            fx				: "crossfade",
				            easing          : "swing",
				            duration        : 1000,                         
				            pauseOnHover    : true,
							onAfter: function() {
								if( $('html').hasClass('no-touch') )
								{
					            	$('.slide-info').hoverIntent(function(){
										$(this).find('header').animate({'opacity': '1'}, 400, 'easeOutSine');
										$(this).find('header h3').animate({'top': '0px'}, 150, 'easeOutSine');
										$(this).find('header h1').delay(75).animate({'top': '0px'}, 150, 'easeOutSine');
									}, function(){
										$(this).find('header').animate({'opacity': '0'}, 400, 'easeOutSine');
										$(this).find('header h3').delay(75).animate({'top': '3em'}, 150, 'easeOutSine');
										$(this).find('header h1').animate({'top': '1em'}, 150, 'easeOutSine');
									});
					            }
				            }
				        },
				        responsive: true,
				        swipe: {
				        	onSwipe: true,
				        	onMouse: true
				        },
						auto: {
							play: true
						},
						pagination : {
							container : $('#home .banner .slide-counter')
						},
						prev : {
							button : $('#home .banner .latest-controls .prev')
						}, 
						next : {
							button : $('#home .banner .latest-controls .next')
						},
						onCreate: function(data) {
							if( $('html').hasClass('no-touch') )
							{
					           	$('.slide-info').hoverIntent(function(){
									$(this).find('header').animate({'opacity': '1'}, 400, 'easeOutSine');
									$(this).find('header h3').animate({'top': '0px'}, 150, 'easeOutSine');
									$(this).find('header h1').delay(75).animate({'top': '0px'}, 150, 'easeOutSine');
								}, function(e){
									$(this).find('header').animate({'opacity': '0'}, 400, 'easeOutSine');
									$(this).find('header h3').delay(75).animate({'top': '3em'}, 150, 'easeOutSine');
									$(this).find('header h1').animate({'top': '1em'}, 150, 'easeOutSine');
								});
							}
						}
					}
				);
			}

			if ($('section.carousel-wrapper').length > 0 ) {
				$('.node-type-case-study .carousel-wrapper .carousel-container').carouFredSel({
					items : 1,
					scroll : {
			            items           : 1,
			            easing          : "swing",
			            duration        : 1000,                         
			            pauseOnHover    : true
			        },
			        swipe: {
			        	onSwipe: true,
			        	onMouse: true
			        },
			        responsive: true,
					auto: {
						play: false
					},
					prev : {
						button : $('.node-type-case-study .carousel-wrapper .latest-controls .prev')
					}, 
					next : {
						button : $('.node-type-case-study .carousel-wrapper .latest-controls .next')
					}
				});
			}
			if ($('.leaderboard-carousel').length > 0 ) {
				$('.leaderboard-carousel').carouFredSel({
					items : 1,
					scroll : {
			            items           : 1,
			            easing          : "swing",
			            fx              : "crossfade",
			            duration        : 1000,                         
			            pauseOnHover    : false
			        },
			        responsive: true,
					auto: {
						play: true,
						timeoutDuration: 5000
					}
				});
			}


			if ($('.block-webform').length > 0 ) {
				if ($('.form-actions .button').length < 1 ) {
					$('.form-actions').append('<button class="button recess"><a href="javascript:void(0)">Submit</a></button>');
				}


				$('.webform-component-textfield input, .webform-component-email input').focus(function(){
					$(this).parents('.form-item').find('label').hide();
				});

				$('.webform-component-textfield input, .webform-component-email input').blur(function(){
					if ($(this).val() == '') {
						$(this).parents('.form-item').find('label').show();
					} else {
						$(this).parents('.form-item').find('label').hide();
					}
				});

				$('.webform-component-textarea textarea').focus(function(){
					$(this).parents('.form-item').find('label').hide();
				});

				$('.webform-component-textarea textarea').blur(function(){
					if ($(this).val() == '') {
						$(this).parents('.form-item').find('label').show();
					} else {
						$(this).parents('.form-item').find('label').hide();
					}
				});
				if ($('body').hasClass('page-node-7')) {
					$('#edit-submitted-whats-up').change(function(){
						if ($(this).val() == 'rfp' || $(this).val() == 'jobs') {
							$('.webform-component--upload-text-1, .webform-component--upload-field-1 , .webform-component--upload-field-2').show();
						} else {
							$('.webform-component--upload-text-1, .webform-component--upload-field-1 , .webform-component--upload-field-2').hide();
						}
					});
				}
				
				RECESS.site.formFileUpload();
				RECESS.site.formSubmitFunctions();
			}

			/*if ( ($(window).width() < 768 ) && ($('html').hasClass('touch')) ) {
				$('.fancybox-media').attr('target','_blank');
			} else {*/
			if ($('html').hasClass('no-touch')) {
				$('.fancybox-media').fancybox({
					type: 'iframe',
					minWidth: 300,
					minHeight:145
				});
			} else {
				$('a.fancybox-media').attr('href','javascript:void(0)');
			}



			// Drawer Nav
			var $pageHeader = $('#page-header'),
				$menuButton = $('.drawer-menu-button'),
				$mainNav = $('#main-nav');
			
			$menuButton.click(function()
				{ 
					$pageHeader.toggleClass('open'); 
					$menuButton.toggleClass('open'); 
					$mainNav.toggleClass('open'); 
					return false; 
				}
			);

			if( $('body').hasClass('page-node-5') )
			{
				RECESS.site.initMasonry();
				
			}

			if ( $('body').hasClass('page-node-2') ) {
				$('.bio-front').hoverIntent(function(){
					$(this).find('header').animate({'opacity': '1'}, 250, 'easeOutSine');
					$(this).find('header h3').animate({'top': '0px'}, 150, 'easeOutSine');
					$(this).find('header h4').delay(75).animate({'top': '0px'}, 150, 'easeOutSine');
				}, function() {
					$(this).find('header').animate({'opacity': '0'}, 250, 'easeOutSine');
					$(this).find('header h3').delay(75).animate({'top': '3em'}, 150, 'easeOutSine');
					$(this).find('header h4').animate({'top': '3em'}, 150, 'easeOutSine');
				});
			}
			if ($('body').hasClass('page-node-4')) {
				$('.work-item').each(function(){
					$(this).find('.inner').hoverIntent(function(){
						$(this).animate({'opacity': '1'}, 250, 'easeOutSine');
						$(this).find('h4').animate({'top': '0px'}, 150, 'easeOutSine');
						$(this).find('h5').delay(75).animate({'top': '0px'}, 150, 'easeOutSine');
					}, function() {
						$(this).animate({'opacity': '0'}, 250, 'easeOutSine');
						$(this).find('h4').delay(75).animate({'top': '2em'}, 150, 'easeOutSine');
						$(this).find('h5').animate({'top': '2em'}, 150, 'easeOutSine');
					});
				});
				
			}
			if ($('body').hasClass('node-type-article') && !$('article.article').hasClass('top-image')) {
				$('body').addClass('no-leaderboard');
			}

			RECESS.site.initSuperSquadEvent();

			RECESS.site.getMoreAccolades();
		},
		queryString: function(name){
		  name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
		  var regexS = "[\\?&]" + name + "=([^&#]*)";
		  var regex = new RegExp(regexS);
		  var results = regex.exec(window.location.search);
		  if(results == null)
		    return "";
		  else
		    return decodeURIComponent(results[1].replace(/\+/g, " "));
		},
		getMoreAccolades: function() {
			$('.page-node-2 .view-more a').click(function(){
				var size_flaps = $(".accolade-cards .flip").size();
			    x= $(".accolade-cards .flip:visible").size();
			    x = (x+5 <= size_flaps) ? x+5 : size_flaps;
		        $('.accolade-cards .flip:lt('+x+')').show();
		        if ($(".accolade-cards .flip:visible").length == size_flaps ) {
		        	$('.view-more').hide();
		        }
		        $(window).scroll();
			});
		},
		browserDetect: function() {
			if( getCookie( 'recess_browser_check' ) != "true" )
			{
				$('body').append('<a href="javascript:void(0)" title="Browser Detect" class="browserdetect">&nbsp;</a>');

				$('.browserdetect').click(function(){
					$.fancybox({
						content: $('#browserdetect-modal').html(),
						minWidth: 700
					});
					createCookie( 'recess_browser_check', 'true', 100);
				});

				$('.browserdetect').click();
			}

		},
		getFacebookPosts: function(){
			$.ajax({
				type: "GET",
				url: 'https://www.facebook.com/feeds/page.php?id=248739863730&format=JSON',
				async: true,
				type: 'json',
				success: function(data) {
					// console.log(data);
				}
			});
		},

		flipCards: function() {
			if (($('section.flip-cards').length > 0)) {
				if (!$('body').hasClass('page-node-3')) {
				    $('.flip').not('.no-flip').hoverIntent(function(){
				    	$(this).toggleClass('flipped-parent').find('.card').toggleClass('flipped');
				    });
				}
			    $('.services.flip-cards .flip .outer button').click(function(){
			        $(this).parents('.flip').find('.card').addClass('flipped');
			        $(this).parents('.flip').addClass('flipped-parent');
			        return false;
			    }); 
			    $('.services.flip-cards .flip .inner button').click(function() {
			    	$(this).parents('.flip').find('.card').removeClass('flipped');
			    	$(this).parents('.flip').removeClass('flipped-parent');
			    });
			} 
		},
		initSuperSquadEvent: function() 
		{
			if ( $('body').hasClass('page-node-2') ) 
			{
				$('.team-open a, .bio-front header').click(function()
					{ 
						if( $('html').hasClass('touch') && $(window).width() < 568 )
						{
							if( $(this).parents('.card').hasClass('flipped') )
							{
								$(this).parents('.card').toggleClass('flipped');
							}
							else
							{
								var orig = $('.super-squad article.bio .card.flipped');

								$(orig).find('.bio-back').css('margin-top','-200%').css('transition-duration','1ms');
								$(orig).removeClass('flipped'); 

								$('article.bio.flipped-squad').removeClass('flipped-squad');

								$(this).parents('article.bio').toggleClass('flipped-squad');
								$(this).parents('.card').toggleClass('flipped'); 

								// $('body,html').delay(400).animate( { scrollTop : $('article.bio.flipped-squad').offset().top }, 300 );

								console.log( $('.bio.flipped-squad .card.flipped').offset().top );

								$('body,html').animate( { scrollTop : $('.bio.flipped-squad .card.flipped').offset().top }, 300 );

								$(orig).find('.bio-back').attr('style','');
							}
						}
						else
						{
							$('.super-squad article.bio .card.flipped').removeClass('flipped');

							$(this).parents('article.bio').toggleClass('flipped-squad');
							$(this).parents('.card').toggleClass('flipped'); 
						}
					}
				);

				$('.team-close a, .bio-back .person-bio').click(function()
					{ 
						$(this).parents('article.bio').toggleClass('flipped-squad');
						$(this).parents('.card').toggleClass('flipped');  
					}
				);
			}
		},
		caseStudyMathClasses : function() {
			var length = $('article.case-study .metrics .metric').length;
			if (length == 5) {
				$('article.case-study .metrics .metric').addClass('five');
			} else if (length == 4) {
				$('article.case-study .metrics .metric').addClass('four');
			} else if (length == 3) {
				$('article.case-study .metrics .metric').addClass('three');
			} else if (length == 2) {
				$('article.case-study .metrics .metric').addClass('two');
			} else if (length == 1) {
				$('article.case-study .metrics .metric').addClass('one');
			}

			var lengthAward = $('article.case-study .awards .award-item').length;
			if (lengthAward == 5) {
				$('article.case-study .awards .award-item').addClass('five');
			} else if (lengthAward == 4) {
				$('article.case-study .awards .award-item').addClass('four');
			} else if (lengthAward == 3) {
				$('article.case-study .awards .award-item').addClass('three');
			} else if (lengthAward == 2) {
				$('article.case-study .awards .award-item').addClass('two');
			} else if (lengthAward == 1) {
				$('article.case-study .awards .award-item').addClass('one');
			}
		},
		workFlappingItems: function () {
			if ($('.our-work').length > 0 ) {
				$('.work-item').each(function(index) {
					var item = $(this);
					 item.delay(400*index).fadeIn(300);
					 setTimeout(function(){
					 	item.addClass('hovered');
					 	setTimeout(function(){
					 		item.removeClass('hovered');
					 	}, 2000);
					 }, (400*index));
				});
			}
		},
		sortBrandList: function() {
			$('#sort-brands').change(function(){
				
				var currentValue = $(this).val();
				if (currentValue == 'All') {
					$('.branding-clients .logos').animate({'opacity': '0'}, 500);
					$('.branding-clients .logos .brand-logo').fadeOut(500);
					setTimeout(function()
					{
						$('.branding-clients .logos').animate({'opacity': '1'}, 1000);
						$('.branding-clients .logos .brand-logo').each( function(index)
					        {
					        	var el = this;
						        setTimeout( function()
					        		{
										$(el).fadeIn(800);
										var cardHeight = $(el).height();
										var logoHeight = $(el).find('img').height();
										var newLogoMargin = (cardHeight - logoHeight)/2;
										$(el).find('img').css('margin-top', newLogoMargin+'px');
					        	  	}, 
					        	  	index * 100
						        );
					    	}
					    );
					}, 
					500
				);
				} else {
					$('.branding-clients .logos').animate({'opacity': '0'}, 500);
					$('.branding-clients .logos .brand-logo').fadeOut(500);
					setTimeout(function()
						{
							$('.branding-clients .logos').animate({'opacity': '1'}, 1000);
							$('.branding-clients .logos .brand-logo[data-category="'+currentValue+'"]').each( function(index)
						        {
						        	var el = this;
							        setTimeout( function()
						        		{
											$(el).fadeIn(800);
											var cardHeight = $(el).height();
											var logoHeight = $(el).find('img').height();
											var newLogoMargin = (cardHeight - logoHeight)/2;
											$(el).find('img').css('margin-top', newLogoMargin+'px');
						        	  	}, 
						        	  	index * 100
							        );
						    	}
						    );
						}, 
						500
					);
				}
			});
		},
		formFileUpload: function() {
			$('.webform-component-file').append('<div class="uploaded-file file-form-item"><h4>Uploaded File</h4><input class="uploadFile" disabled="disabled" type="text" /></div>');
			$('.webform-component-file').append('<div class="browse-files file-form-item"><h4>Choose Your File</h4><span class="browse">Browse</span></div>');
			$('.webform-component-file .form-file').change(function(){
				var newValue = $(this).val();
				var results = newValue.split("\\");
				if (results[2] != null ) {
					$(this).parents('.webform-component-file').find('.browse-files').fadeOut();
					$(this).parents('.webform-component-file').find('.uploaded-file').fadeIn();
				} else {
					$(this).parents('.webform-component-file').find('.browse-files').fadeIn();
					$(this).parents('.webform-component-file').find('.uploaded-file').fadeOut();
				}
				$(this).parents('.webform-component-file').find('.uploadFile').val(results[2]);
			});
		},
		formSubmitFunctions: function() {
			$('#webform-client-form-36 .form-actions button.button').click(function(){
				if ( $('#webform-client-form-36').parsley().validate() ) {
					$('#submit-loader').fadeIn();
		            $('.webform-submit.button-primary.form-submit').trigger('click');
		           
		        } else {
		        	
		        }
		    });
		    $('#webform-client-form-21 .form-actions button.button').on('click touchstart', function(){
				if ( $('#webform-client-form-21').parsley().validate() ) {
					$('#submit-loader').fadeIn();   
		            $('.webform-submit.button-primary.form-submit').trigger('click');
		        } else {
		        	
		        }
		    });
		},
		initMasonry: function() 
		{
			if ($('.masonry').length > 0) 
			{
				var msnry = new Masonry( '.masonry.scuttlebutt', 
					{
						itemSelector: '.item',
						columnWidth: '.general',
						isInitLayout: true,
						isResizeBound: false,
						transitionDuration: 0
					}
				);
			}
		},

		initScuttlebutt: function()
		{

			scuttlebutted = true;

			var st = $(window).scrollTop();
			var hOffset = -50;

			$('.masonry.scuttlebutt .item').css("margin-top", "+=300");
			
			$(window).scroll( function(e)
				{	
					var st = $(window).scrollTop();

					$('.masonry.scuttlebutt .item').not('.active').each( function(i,val)
						{
							if( (parseInt($(this).css('top'))-st) < ($(window).height()+hOffset) )
							{
								var thisItem = $(this);
								setTimeout(function(){
									$(thisItem).addClass('active');
								}, 250*i );
							}
							else
							{
								if( $('html').hasClass('touch') )
								{
									$(this).css('transition-duration','0').addClass('active');
								}
							}
						}
					);
				}
			);

			$(window).scroll();
		},
		scuttlebuttLoadMore: function(){
			var ScuttleButtSize = $('.scuttlebutt .item').size();
			var halfItems = ScuttleButtSize / 2;
			//console.log(ScuttleButtSize + ' '+ halfItems);
			$('.scuttlebutt .item').slice(halfItems).hide();
			//$(window).resize();
			$('.load-more .button a').click(function() {
			    $('.scuttlebutt .item').slice(halfItems).fadeIn(300);
			    $(window).scroll();
			});
		},
		slideInAnimations: function() 
		{
			var st = $(window).scrollTop();
			var hOffset = -50;

			if( $('body').hasClass('page-front') ){ hOffset = 2000; } // HOME
			if( $('body').hasClass('page-node-2') ){ hOffset = 220; } // AGENCY
			if( $('body').hasClass('page-node-4') ){ hOffset = 180; } // WORK
			if( $('body').hasClass('page-node-7') ){ hOffset = 180; } // CONTACT
			if( $('body').hasClass('page-node-6') ){ hOffset = 180; } // CAREERS
			if( $('body').hasClass('node-type-case-study') ){ hOffset = 80; } // CASE STUDY
		
			$(window).scroll( function()
				{	
					var st = $(window).scrollTop();

					$('.animate-in:visible').not('.active').each( function(i,val)
						{
							if( ($(this).offset().top - st) < ($(window).height()+hOffset) )
							{
								var thisItem = $(this);
								setTimeout(function(){
									$(thisItem).addClass('active');
								}, 220*i );
							}
							else
							{
								if( $('html').hasClass('touch') )
								{
									$(this).css('transition-duration','0').addClass('active');
								}
							}
						}
					);
				}
			);

			$(window).scroll();
		},
		scroll: function() 
		{
			var isAnimating = false;

			if ($('body').hasClass('page-node-2')) {
				if ( ($(document).scrollTop() >= ($('section.accolades').offset().top - $(window).height())) && $('#count-up').text() == '0' ) 
				{
					var options = {
					  useEasing : false, 
					  useGrouping : true
					}
					var demo = new countUp('count-up', 0, 103, 0, 1.5, options);
					demo.start();
				}
			}
		},

		resize: function() 
		{
			var windowHeight = $(window).height();
			if ($('.leaderboard').length > 0 &&  !$('body').hasClass('page-node-2')) {
				$('.leaderboard').height(windowHeight - 80);
			} 
			var leaderboardHeight = $('.leaderboard').height();
			var leaderboardHeaderHeight = $('.leaderboard header').height();
			var oldSliderHeight = 682;
			var oldSliderWidth = 1280;
			var newSliderWidth = $(window).width();
			var newSliderHeight = newSliderWidth * oldSliderHeight / oldSliderWidth;

			var oldSliderHeightAGENCY = 750;
			var oldSliderWidthAGENCY = 1650;
			var newSliderHeightAGENCY = newSliderWidth * oldSliderHeightAGENCY / oldSliderWidthAGENCY;
    		//console.log(newSliderHeight);
    		if ($('body').hasClass('front')) {
    			$('.banner, .latest-slide, .caroufredsel_wrapper, .slide-container').height(newSliderHeight);
    			$('.banner, .latest-slide, .caroufredsel_wrapper, .slide-container').css('max-height', (windowHeight - 100)+'px');
    		}

    		if ($('.leaderboard').length > 0 &&  $('body').hasClass('page-node-2')) {
				//$('.leaderboard, .caroufredsel_wrapper, .leaderboard-carousel').css('max-height', windowHeight - 80);
				$('.leaderboard, .leaderboard .caroufredsel_wrapper, .leaderboard-carousel').height(newSliderHeightAGENCY);
    			$('.leaderboard, .leaderboard .caroufredsel_wrapper, .leaderboard-carousel').css('max-height', (windowHeight - 80)+'px');
			}

			if ($('.leaderboard').length > 0 &&  !$('body').hasClass('page-node-2')) {
				if ($(window).width() > 767) {
					$('.leaderboard header').css('top', ((leaderboardHeight - leaderboardHeaderHeight)/2)+'px' );
				} else {
					$('.leaderboard header').css('top', (((leaderboardHeight - leaderboardHeaderHeight)/2)+66)+'px' );
				} 
			}

			if ($('body').hasClass('page-node-6')) {
				var containerHeight = $('.quote-section').height();
				var quoteHeight = $('.career-quote').height();
				if ($('.career-quote-container').css('margin-top') == '0px') {
					$('.career-quote').css('top', ( (containerHeight - quoteHeight) / 2) + 'px');
				} else {
					$('.career-quote').css('top', ( (containerHeight - quoteHeight - 300) / 2) + 'px');
				}
			}

			$('.super-squad-profiles .bio').each(function(){
				var frontHeight = $(this).find('.bio-front').height();
				var h4Height = $(this).find('.bio-front header h4').height();
				var h3Height = $(this).find('.bio-front header h3').height();

				var frontHeaderHeight = h3Height + h4Height;
				
				$(this).find('.bio-front header h3').css('margin-top', ((frontHeight - frontHeaderHeight)/2)+'px' );

				var newMinHeight = $(this).find('.left').height();
				$(this).find('.right .bio-content').css('min-height', (newMinHeight+'px') );
			});
			if ($('.masonry').length > 0 ) 
			{
				setTimeout(function()
					{
						var container = document.querySelector('.masonry.scuttlebutt');
						var msnry = Masonry.data( container );
						msnry.layout();
					}, 
					500
				);
			}
			$('.accolade-cards .flip').each(function(){
				var cardHeight = $(this).find('.front').height();
				var logoHeight = $(this).find('.front .award-image').height();
				var newLogoMargin = (cardHeight - logoHeight)/2 - 16;
				$(this).find('.front .award-image').css('margin-top', newLogoMargin+'px');
			});
			$('.logos .brand-logo').each(function(){
				var cardHeight = $(this).height();
				var logoHeight = $(this).find('img').height();
				var newLogoMargin = (cardHeight - logoHeight)/2;
				$(this).find('img').css('margin-top', newLogoMargin+'px');
			});
		}
	};
}(); 


function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}

// HELPER METHODS





