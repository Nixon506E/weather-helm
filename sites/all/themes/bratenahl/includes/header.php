
<div id="page" class="" role="main">
	<div class="wrap">
    
	    <header class="container">
	    	<div class="table padded-content">
				<?php if ($logo): ?>
					<div id="logo">
					  <a href="<?php print check_url($front_page) ?>" title="<?php print t('Home') ?>"><img class="mobile-logo" style="display:none;" src="/sites/all/themes/bratenahl/images/logo-mobile.png" alt="<?php print t('Home') ?>" /><img class="standard-logo" src="<?php print $logo ?>" alt="<?php print t('Home') ?>" /></a>
					</div>
				<?php endif; ?> 
				
				<button style="display:none" class="mobile-nav"></button>
				<nav>
					<div class="mobile-cell">
						<a class="mobile-close" style="display:none"><img src="/sites/all/themes/bratenahl/images/closex.png" alt="<?php print t('Close') ?>" /></a>
						<a class="home-logo" style="display:none" href="<?php print check_url($front_page) ?>" title="<?php print t('Home') ?>"><img class="standard-logo" src="/sites/all/themes/bratenahl/images/logo-min.png" alt="<?php print t('Home') ?>" /></a>
						<?php print render($page['navigation']); ?>
						<?php print render($page['header']); ?>
					</div>
				</nav>
	    	</div>
	    	
	    	<?php print render($page['featured']); ?>
	      
	    </header>

	</div>
	<script type="text/javascript">
		$('.mobile-close').on('click', function () {
			$('.mobile-nav').animate({
				opacity: 1,
			});
			$( "nav" ).animate({
				top: '-100vh',
			}, 200, function() {
			    // Animation complete.
			    $('html, body').css({
				    'overflow': 'auto',
				    'height': 'auto'
				})
			});
		});
		
		$('.mobile-nav').on('click', function () {
			$('.mobile-nav').animate({
				opacity: 0,
			});
			$( "nav" ).animate({
				top: 0,
			}, 800, function() {
			    // Animation complete.
			    $('html, body').css({
				    'overflow': 'hidden',
				    'height': '100%'
				})
			});
		});
		
		$('nav a').on('click', function () {
			if ($(".mobile-nav").css("display") != "none" ){
				$('.mobile-nav').animate({
					opacity: 1,
				});
				$( "nav" ).animate({
					top: '-100vh',
				}, 200, function() {
				    // Animation complete.
				    $('html, body').css({
					    'overflow': 'auto',
					    'height': 'auto'
					})
				});
			}
		});
	</script>





