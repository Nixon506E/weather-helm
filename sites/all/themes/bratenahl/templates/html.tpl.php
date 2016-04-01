<?php

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<?php print $head; ?>
	<meta name="format-detection" content="telephone=no">
	
	<title><?php print $head_title; ?></title>
	<meta name="author" content="">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 

	<meta property="og:title" content="Site Title">
	<meta property="og:type" content="website">
	<meta property="og:url" content="http://www.full_site_url.com">
	<meta property="og:image" content="<?php print base_path() . path_to_theme(); ?>/logo.png">
	<meta property="og:site_name" content="Site Title">
	<meta property="og:description" content="">
	
	<?php print $styles; ?> 
	<link rel="icon" href="<?php print base_path() . path_to_theme(); ?>/favicon.ico" type="image/x-icon">
	
	<script src="<?php print base_path() . path_to_theme(); ?>/js/libs/modernizr-2.0.6.min.js"></script>
	<script type="text/javascript" src="<?php print base_path() . path_to_theme(); ?>/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php print base_path() . path_to_theme(); ?>/js/jquery.cycle2.js"></script>
	<script type="text/javascript" src="<?php print base_path() . path_to_theme(); ?>/js/jquery.cycle2.carousel.js"></script>
	<script type="text/javascript" src="<?php print base_path() . path_to_theme(); ?>/js/jquery.cycle2.center.js"></script>
	<script type="text/javascript" src="<?php print base_path() . path_to_theme(); ?>/js/jquery.placeholder.js"></script>
	<script type="text/javascript" src="<?php print base_path() . path_to_theme(); ?>/js/jquery.backgroundSize.js"></script>
	<script type="text/javascript" src="<?php print base_path() . path_to_theme(); ?>/js/viewport-units-buggyfill.js"></script>
	<script type="text/javascript" src="<?php print base_path() . path_to_theme(); ?>/js/viewport-units-buggyfill.hacks.js"></script>
	<script>
		window.viewportUnitsBuggyfill.init({
			refreshDebounceWait: 250,
		    behaviorHack: true,
		    contentHack: true,
		    hacks: window.viewportUnitsBuggyfillHacks	
		});
	</script>
	<script type="text/javascript">
		var uri = window.location.toString();
		if (uri.indexOf("?") > 0) {
		    var clean_uri = uri.substring(0, uri.indexOf("?"));
		    window.history.replaceState({}, document.title, clean_uri);
		}
	</script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-57345624-1', 'auto');
	  ga('send', 'pageview');
	
	</script>

</head>

<body>
	<?php print $page_top; ?>
	<?php print $page; ?>
	<?php print $page_bottom; ?>

	<script type="text/javascript" src="<?php print base_path() . path_to_theme(); ?>/js/script.js"></script>    
	<script type="text/javascript">
	    var $ = jQuery.noConflict();
	    $(document).ready(function()
	        { 
	            BRATENAHL.site.init();
	        } 
	    );
	</script>
  
</body>
</html>
