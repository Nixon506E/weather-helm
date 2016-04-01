/*
* 
*  CLIENT_NAME_HERE JS  
*  Recess Creative - @2013 UID 
*  
*/

// GLOBAL VARIABLES



	
if (typeof BRATENAHL == 'undefined') { 
  BRATENAHL = {};
}

BRATENAHL.site = function() 
{
	return {

		init: function () 
		{
			if (window.console && console.log)
				console.log('JS Working');
			
			BRATENAHL.site.initEvents();
		},
		
		initEvents: function ()
		{
			// INIT JQUERY EVENTS 
			//Background Cover Fallback
			$('.hero').css( "background-size", "cover" );
			
			//Placeholder Fallback
			$('input, textarea').placeholder();
			
			//404 Height Fallback
			var newHeight = $("html").height() - $("header").height() - $(".region-footer").height() + "px";
			$(".404").css("height", newHeight);
			
			//Two Column If No Image
			if ($('.field-name-field-full-image').length != 0) {
				$('.field-name-body .field-item').css('-webkit-columns', 1);
				$('.field-name-body .field-item').css('columns', 1);
				$('.field-name-body .field-item').css('-moz-columns', 1);
			}
			
			//Customize Dependent Filters
			if($('.form-type-radio.form-item-type input').eq(1).is(':checked')){
				$('#edit-stage-wrapper').css('display', 'none');
			    $('#edit-stage').val('All');
			    $('.annotation').css('display', 'block');
			} else {
				if ($(window).width() <= 767){
					$('#edit-stage-wrapper').css('display', 'block');
				} else {
					$('#edit-stage-wrapper').css('display', 'table-cell');
				}
				$('.annotation').css('display', 'none');
			}
			$('.form-type-radio.form-item-type input').eq(1).change(function(){
			  if($(this).is(':checked')){
				$('#edit-stage-wrapper').css('display', 'none');
			    $('#edit-stage').val('All');
			  }
			  $('.annotation').css('display', 'block');
			});
			
			$('.form-type-radio.form-item-type input').eq(0).change(function(){
			  if($(this).is(':checked')){
				if ($(window).width() <= 767){
					$('#edit-stage-wrapper').css('display', 'block');
				} else {
					$('#edit-stage-wrapper').css('display', 'table-cell');
				}
				$('.annotation').css('display', 'none');
			  }
			});
			
			$( window ).resize(function() {
			  	if ($(window).width() <= 767){
					$('#edit-stage-wrapper').css('display', 'block');
				} else {
					$('#edit-stage-wrapper').css('display', 'table-cell');
				}
				
				//404 Height Fallback
				var newHeight = $("html").height() - $("header").height() - $(".region-footer").height() + "px";
				$(".404").css("height", newHeight);
			});
			
			//Ajaxify the portfolio page.
			$('select.ctools-auto-submit,.ctools-auto-submit-full-form *[type!=input]').change(function() {
				$(this.form).find('.ctools-auto-submit-click').click();
         	});
         	reloadPager();
         	
         	// Set up an event listener for the portfolio filters.
			$('.ctools-auto-submit-full-form').submit(function(event) {
				// Stop the browser from submitting the form.
				event.preventDefault();

			    // Serialize the form data.
				var formData = $(this).serialize();
				
				var progress = $('<div class="ajax-progress ajax-progress-throbber" style="height:72px;margin:200px 0;display:inline-block !important;"><div class="throbber" style="height:100%;">&nbsp;</div></div>');
				$('.view-content').html(progress);
				$('.item-list').html('');
				
				// Submit the form using AJAX.
				$.ajax({
				    type: 'POST',
				    url: $(this).attr('action') + '?' + formData,
					progress: { type: 'throbber' }
				}).done(function(response) {
				    $('.view-content').html($(response).find('.view-content').html());
				    $('.item-list').html($(response).find('.item-list').html());
				    reloadPager();
				});
			});
			
			function reloadPager() {
				$('.pager a').click(function(event) {
					// Stop the browser from submitting the form.
					event.preventDefault();
					
					var progress = $('<div class="ajax-progress ajax-progress-throbber" style="height:72px;margin:200px 0;display:inline-block !important;"><div class="throbber" style="height:100%;">&nbsp;</div></div>');
					$('.view-content').html(progress);
					//$('.item-list').html('');
					
					// Submit the form using AJAX.
					$.ajax({
					    type: 'POST',
					    url: $(this).attr('href'),
						progress: { type: 'throbber' }
					}).done(function(response) {
					    $('.view-content').html($(response).find('.view-content').html());
					    $('.item-list').html($(response).find('.item-list').html());
					    reloadPager();
					});
				});
			}
			
			//Custom Select Box
			// Iterate over each select element
			$('select').each(function () {
			
			    // Cache the number of options
			    var $this = $(this),
			        numberOfOptions = $(this).children('option').length;
			
			    // Hides the select element
			    $this.addClass('s-hidden');
			
			    // Wrap the select element in a div
			    $this.wrap('<div class="select"></div>');
			
			    // Insert a styled div to sit over the top of the hidden select element
			    $this.after('<div class="styledSelect"></div>');
			
			    // Cache the styled div
			    var $styledSelect = $this.next('div.styledSelect');
			
			    // Show the first select option in the styled div
			    $styledSelect.text($this.children('option').eq(0).text());
			
			    // Insert an unordered list after the styled div and also cache the list
			    var $list = $('<ul />', {
			        'class': 'options'
			    }).insertAfter($styledSelect);
			
			    // Insert a list item into the unordered list for each select option
			    for (var i = 0; i < numberOfOptions; i++) {
				    if ($this.children('option').eq(i).text() != "- Any -") {
				        $('<li />', {
				            text: $this.children('option').eq(i).text(),
				            rel: $this.children('option').eq(i).val()
				        }).appendTo($list);
				        if ($this.children('option').eq(i).attr('selected')) {
						    $styledSelect.text($this.children('option').eq(i).text());
					    }
			        } else {
				        $('<li />', {
				            text: 'All',
				            rel: $this.children('option').eq(i).val()
				        }).appendTo($list);
				        if ($this.children('option').eq(i).attr('selected')) {
						    $styledSelect.text('All');
					    }
			        }
			    }
			
			    // Cache the list items
			    var $listItems = $list.children('li');
			
				var $height = 0;
			    // Show the unordered list when the styled div is clicked (also hides it if the div is clicked again)
			    $styledSelect.click(function (e) {
			        e.stopPropagation();
			        if ($(this).hasClass('active')) {
				        $('div.styledSelect.active').each(function () {
					        $(this).next('ul.options').animate({
								height: "0"
							}, 200, function() {
								// Animation complete.
								$(this).hide();
							});
				        });
				        $('div.styledSelect.active').removeClass('active');
			        } else {
				        if ($height == 0) {
					        $height = $(this).next('ul.options').css('height');
				        }
				        $('div.styledSelect.active').each(function () {
					        $(this).next('ul.options').animate({
								height: "0"
							}, 200, function() {
								// Animation complete.
								$(this).hide();
							});
				        });
				        $('div.styledSelect.active').removeClass('active');
				        $(this).next('ul.options').css('height', '0px');
				        $(this).addClass('active').next('ul.options').show();
				        $(this).next('ul.options').animate({
							height: $height
						}, 200, function() {
							// Animation complete.
						});
			        }
			    });
			
			    // Hides the unordered list when a list item is clicked and updates the styled div to show the selected list item
			    // Updates the select element to have the value of the equivalent option
			    $listItems.click(function (e) {
			        e.stopPropagation();
			        $styledSelect.text($(this).text()).removeClass('active');
			        $this.children().removeAttr('selected');
			        $($this.children()[$(this).index()]).attr('selected', '');
			        $this.val($(this).attr('rel'));
			        $list.hide();
			        /* alert($this.val()); Uncomment this for demonstration! */
			        $this.closest('form').find('.ctools-auto-submit-click').click();
			    });
			
			    // Hides the unordered list when clicking outside of it
			    $(document).click(function () {
			        $styledSelect.removeClass('active');
			        $list.hide();
			    });
			
			});
			
			//Webform AJAX Replacement
			$(function() {
			    // Get the form.
			    var form = $('.webform-client-form-9');
			
			    // Get the messages div.
			    var formMessages = $('#webform-ajax-wrapper-9');
			
			    // Set up an event listener for the contact form.
				$(form).submit(function(event) {
					// Stop the browser from submitting the form.
					event.preventDefault();
					
					if (validateForm()) {
					    // Serialize the form data.
						var formData = $(form).serialize();
						
						// Submit the form using AJAX.
						$.ajax({
						    type: 'POST',
						    url: $(form).attr('action'),
						    data: formData
						}).done(function(response) {
						    // Make sure that the formMessages div has the 'success' class.
						    $(formMessages).removeClass('error');
						    $(formMessages).addClass('success');
						
						    // Set the message text.
						    //$(formMessages).text(response);
						
						    // Clear the form.
						    $('.form-text').val('');
						    $('.form-textarea').val('');
						}).fail(function(data) {
						    // Make sure that the formMessages div has the 'error' class.
						    $(formMessages).removeClass('success');
						    $(formMessages).addClass('error');
						
						    // Set the message text.
						    if (data.responseText !== '') {
						        //$(formMessages).text(data.responseText);
						    } else {
						        //$(formMessages).text('Oops! An error occured and your message could not be sent.');
						    }
						});
					}
				});
			});
			
			function validateForm() {
			    var nameReg = /^[A-Za-z]+$/;
			    var numberReg =  /^[0-9]+$/;
			    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			    
			    var errors = false;
			
			    var inputVal = $('.webform-component input, .webform-component textarea');
			
			     $('.error').hide();
			     
			    inputVal.each(function () {
				    if ($(this).hasClass('required') && $(this).val() == "") {
					    $(this).addClass('invalid');
					    errors = true;
				    } else {
					    $(this).removeClass('invalid');
					    if ($(this) == $('#edit-submitted-name') && !nameReg.test($(this).val())) {
							$(this).setCustomValidity('');
						    errors = true;
						} else {
						    $(this).removeClass('invalid');
					    }
						if ($(this) == $('#edit-submitted-email') && !emailReg.test($(this).val())) {
							$(this).setCustomValidity('');
						    errors = true;  
						} else {
						    $(this).removeClass('invalid');
					    }
						if ($(this) == $('#edit-submitted-phone') && !numberReg.test($(this).val())) {
							$(this).setCustomValidity('');
						    errors = true;    
						} else {
						    $(this).removeClass('invalid');
					    }
				    }
			    });
		        
		        if (errors) {
			        return false;
		        }
		        
		        return true;       
			}   
			
			// Slider Setup
			(function() {
				var cycle_check, cycle_init, cycle_timer, cycle_next, cycle_active = 0;
				
				clearTimeout( cycle_timer );
			    cycle_timer = setTimeout( function() {
			        cycle_check();
			    }, 100 );
	
				(cycle_check = function() {
				    var width = $(window).width(); // Checking size again after window resize
				    if ( width < 768 && $( ".slideshow" ).attr( "data-cycle-carousel-visible" ) !== "1" ) {
				        $( ".slideshow" ).cycle( "destroy" ).attr( "data-cycle-carousel-visible", "1" );
				        cycle_init( 1 );
				    } else if ( width >= 768 && width < 965 && $( ".slideshow" ).attr( "data-cycle-carousel-visible" ) !== "2" ) {
				        $( ".slideshow" ).cycle( "destroy" ).attr( "data-cycle-carousel-visible", "2" );
				        cycle_init( 2 );
				    } else if ( width >= 965 && width < 1200 && $( ".slideshow" ).attr( "data-cycle-carousel-visible" ) !== "3" ) {
				        $( ".slideshow" ).cycle( "destroy" ).attr( "data-cycle-carousel-visible", "3" );
				        cycle_init( 3 );
				    } else if ( width >= 1200 && width < 1440 && $( ".slideshow" ).attr( "data-cycle-carousel-visible" ) !== "4" ) {
				        $( ".slideshow" ).cycle( "destroy" ).attr( "data-cycle-carousel-visible", "4" );
				        cycle_init( 4 );
				    } else if ( width >= 1440 && $( ".slideshow" ).attr( "data-cycle-carousel-visible" ) !== "5" ) {
				        $( ".slideshow" ).cycle( "destroy" ).attr( "data-cycle-carousel-visible", "5" );
				        cycle_init( 5 );
				    }
				})();
				
				function cycle_init( visibleSlides ) {
				    $( ".slideshow-container .slideshow" ).cycle({
				        slides: '> li',
			            fx: 'carousel',
			    		carouselFluid: true,
			    		carouselVisible: visibleSlides,
				        startingSlide: cycle_active,
				        carouselHops: visibleSlides,
			            timeout: 0,
			            swipe: true,
						centerVert: true,
			            prev: '.slideshow-prev',
			            next: '.slideshow-next'
				    });
				}
				
				$(window).resize( function() {
				    clearTimeout( cycle_timer );
				    cycle_timer = setTimeout( function() {
				        cycle_check();
				    }, 100 );
				});
				
				$(".slideshow").on("cycle-update-view", function ( e, optionHash, slideOptionsHash, currSlideEl ) {
				    cycle_active = optionHash.currSlide;
				});
			}());
			
			// Smooth Scrolling For Inline Links
			function filterPath(string) {
				return string
				  .replace(/^\//,'')
				  .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
				  .replace(/\/$/,'');
			}
			var locationPath = filterPath(location.pathname);
			var scrollElem = scrollableElement('html', 'body');
			 
			$('a[href*=#]').each(function() {
			  var thisPath = filterPath(this.pathname) || locationPath;
			  if (  locationPath == thisPath
			  		&& (location.hostname == this.hostname || !this.hostname)
			    	&& this.hash.replace(/#/,'') ) {
				      	var $target = $(this.hash), target = this.hash;
				      	if (target) {
				        	var targetOffset = $target.offset().top;
				        	$(this).click(function(event) {
				          		event.preventDefault();
				          		$(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
				            		location.hash = target;
				          		});
				        	});
				      	}
			  }
			});
			 
			// use the first element that is "scrollable"
			function scrollableElement(els) {
			    for (var i = 0, argLength = arguments.length; i <argLength; i++) {
			     	var el = arguments[i],
			          	$scrollElement = $(el);
			      	if ($scrollElement.scrollTop()> 0) {
			        	return el;
			      	} else {
			        	$scrollElement.scrollTop(1);
			        	var isScrollable = $scrollElement.scrollTop()> 0;
			        	$scrollElement.scrollTop(0);
			        	if (isScrollable) {
			          		return el;
			        	}
			      	}
			  	}
				return [];
			}
			
			// Fade in sections on scroll
			$('.fade-item').each(function (i) {
				$(this).css('opacity', 0);
			});
			$(window).scroll(function () {
		        /* Check the location of each desired element */
		        $('.fade-item').each(function (i) {
		
		            var bottom_of_object = $(this).offset().top + $(this).outerHeight();
		            var bottom_of_window = $(window).scrollTop() + $(window).height();
		
		            /* If the object is completely visible in the window, fade it it */
		            if (bottom_of_window > bottom_of_object && $(this).css('opacity') == 0) {
		
		                $(this).filter(':not(:animated)').animate({
		                    'opacity': '1'
		                }, 500);
						
		            }
		
		        });
		
		    });
		    //Mobile browser scroll updates only on release so add this as well
		    if( navigator.userAgent.match(/(iPad|iPhone|iPod touch);.*CPU.*OS 7_\d/i) ) {
			    $('.fade-item').css('opacity', '1');
		    }
		    //Initialize visibile elements on load
		    $('.fade-item').each(function (i) {
	
	            var bottom_of_object = $(this).offset().top + $(this).outerHeight();
	            var bottom_of_window = $(window).scrollTop() + $(window).height();
	
	            /* If the object is completely visible in the window, fade it it */
	            if (bottom_of_window > bottom_of_object && $(this).css('opacity') == 0) {
	
	                $(this).filter(':not(:animated)').animate({
	                    'opacity': '1'
	                }, 500);
					
	            }
	
	        });
		    
		}

	};
}(); 




// HELPER METHODS





