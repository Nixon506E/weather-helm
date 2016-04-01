<footer role="contentinfo" id="page-footer">
	
	<div class="ankle">
		
		<section class="contact-us">
			<section class="address">
				<span class="icon" aria-hidden="true">l</span>
				<p><a href='http://maps.apple.com/?q=635+West+Lakeside+Ave+Suite 101+Cleveland+OH+44113' target="_blank">635 West Lakeside Ave<br />Suite 101<br />Cleveland, OH 44113</a></p>
			</section>
			<section class="call-us">
				<a class="phone" href="tel:2164007187"><span aria-hidden="true" class="icon">h</span></a>
				<a class="call-recess" href="tel:2164007187">(216) 400-7187</a>
			</section>
			<section class="email-us">
				<p><a href="/contact"><span aria-hidden="true" class="icon">c</span><span class="text">Contact Us</span></a></p>
			</section>
		</section>

		<section class="tuneage">
			<div class="wave-container">
				<img src="/sites/all/themes/recess/images/soundwave.png" width="100%" height="60">
				<div id="can-listen" class="hover start">
					<p>listen live</p>
				</div>
			</div>
			<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/php/song.php'); ?>
		</section>

	</div>
	
	<div class="feet">
		<nav role="navigation">
			<section class="sitemap">
				<?php 
		      		$menu_name = variable_get('menu_main_links_source', 'main-menu'); 
				    $tree = menu_tree($menu_name);
				    print drupal_render($tree);
		      	?>
			</section>
			<section class="social-nav">
				<a class="icon-social twitter" aria-label="Twitter" href="http://twitter.com/recesscreative" target="_blank">T</a>
				<a class="icon-social facebook" aria-label="Facebook" href="http://facebook.com/recesscreative" target="_blank">F</a>
				<a class="icon-social instagram" aria-label="Instagram" href="http://instagram.com/recesscreative" target="_blank">I</a>
				<a class="icon-social linkedin" aria-label="LinkedIn" href="http://www.linkedin.com/company/recess-creative" target="_blank">L</a>
				<a class="icon-social google" aria-label="Google+" rel="publisher" href="https://plus.google.com/102558462773867175506" target="_blank">G</a>
			</section>
		</nav>
	</div>
	
	<div class="toes">
		<ul>
			<li><sup>&copy;</sup><?php echo date("Y"); ?> Recess Creative, LLC</li>
			<li aria-hidden="true">|</li>
			<li>Made with <span aria-label="love" class="icon">"</span> in Cleveland, Ohio</li>
		</ul>
	</div>

</footer>