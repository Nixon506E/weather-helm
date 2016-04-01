(function(window, document, $){
	$(document).ready(function(){
		$('.parallax').parallax();
		
		$('#welcome-btn').click(function(){
			$('#page-wrapper').removeClass('welcome');
		});
		
		var $container = $('.view-feed .view-content');
		$container.masonry({
		// options
		  columnWidth: '.grid-sizer',
		  itemSelector: '.views-row',
		  percentPosition: true,
		  transitionDuration: 0
		});
        $container.imagesLoaded(function () {
          $container.masonry();
        });
        
		//$('.views-field-category a').click(function(e){
		//	e.preventDefault();
		//	
		//	var cat = e.target.href.substr(e.target.href.lastIndexOf('=') + 1);
		//	$('.views-exposed-form #edit-category').attr('value', cat);
		//	$('#edit-submit-feed').click();
		//});
	});
})(window, document, jQuery);