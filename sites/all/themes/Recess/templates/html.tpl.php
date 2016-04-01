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
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<?php print $head; ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="format-detection" content="telephone=no">
	
	<title><?php print $head_title; ?></title>
	<?php 
		$node = menu_get_object();
		$metadescription = field_get_items('node', $node, 'meta_description');
		if (!$metadescription || !$node){
	?>
	<meta name="description" content="Recess Creative is a full-service digital advertising and integrated marketing agency based in downtown Cleveland.">
	<?php 
		}
		$metakeywords = field_get_items('node', $node, 'meta_keywords');
		if (!$metakeywords || !$node){
	?>
	<meta name="keywords" content="digital advertising agency, digital marketing agency, online marketing agency, full service advertising agency, integrated marketing, cleveland advertising">
	<?php } ?>
	<?php $alias = drupal_get_path_alias('node/'.$node->nid); ?>
	<meta name="canonical" content="http://<?php echo $_SERVER['HTTP_HOST']; ?>/<?php print $alias; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
	<meta name="google-site-verification" content="hUbyjZ4iyaqHRwlJG_9ehlgTlR3UegTnwfiR4fgzvWE" />
	<meta name="msvalidate.01" content="49571BFD8FB5F664EE274F64EF880E1A" />
	<meta name="robots" content="NOODP, NOYDIR" />

	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="no">

	<link rel="apple-touch-icon-precomposed" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sites/all/themes/recess/images/recess-touch-icon-iphone-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sites/all/themes/recess/images/recess-touch-icon-standard-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sites/all/themes/recess/images/recess-touch-icon-retina-precomposed.png"> 

	<meta property="og:title" content="<?php echo $head_title; ?>">
	<meta property="og:type" content="website">
	<meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'] ."/". $alias; ?>">
	<meta property="og:image" content="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sites/all/themes/recess/images/recess-fb-logo.jpg"> 
	<meta property="og:site_name" content="Recess Creative">
	<meta property="og:description" content="Recess Creative is a full-service digital advertising and integrated marketing agency based in downtown Cleveland.">

	<script> window.onload = function() { setTimeout (function () { scrollTo(0,1); }, 10); }; </script>
	<script src="<?php print base_path() . path_to_theme(); ?>/js/libs/modernizr-2.8.3.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php print base_path() . path_to_theme(); ?>/js/jquery-1.9.1.min.js"></script>
	<link rel="stylesheet" href="<?php print base_path() . path_to_theme(); ?>/js/libs/jquery.modal.css">
	<?php if ( $_SERVER['SERVER_NAME'] == '54.204.41.81' ) { ?><link rel="stylesheet" type="text/css" href="//cloud.typography.com/7562312/715766/css/fonts.css" />
	<?php } else { ?><link rel="stylesheet" type="text/css" href="//cloud.typography.com/7562312/675766/css/fonts.css" /><?php }?>
	<?php print $styles; ?> 
	<script>
		var b = document.documentElement;
		b.setAttribute('data-useragent',  navigator.userAgent);
		b.setAttribute('data-platform', navigator.platform );
	</script>
	<link rel="icon" href="<?php print base_path() . path_to_theme(); ?>/favicon.ico" type="image/x-icon">
	<!--[if lt IE 10]>
		<style type="text/css">
			.animate-in, .scuttlebutt .item  { margin-top: 0 !important;}
			.button {padding: 1em;}
			.flip-cards .flip .card .back {display: none;}
		    .flip-cards .flip:hover .card .back {display: block;}
		    .accolade-cards.flip-cards .flip .card .back {display: none !important;}
		    .accolade-cards.flip-cards .flip:hover .card .back {display: block !important;}
		    .super-squad article.bio .bio-back {display: none;}
    		.super-squad article.bio.flipped-squad .bio-back {display: block;}
		</style>
	<![endif]-->
	
	
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php print base_path() . path_to_theme(); ?>/css/html4/html4.css">
	<![endif]-->
</head>

<body class="<?php print $classes; ?>">
	<?php print $page_top; ?>
	<?php print $page; ?>
	<?php print $page_bottom; ?>
	<?php include(path_to_theme().'/includes/js-plugins.php'); ?>
	<!--[if lt IE 9]>
		<script src="<?php print base_path() . path_to_theme(); ?>/js/libs/respond.min.js" type="text/javascript"></script>
		<script src="<?php print base_path() . path_to_theme(); ?>/js/libs/html5.js" type="text/javascript"></script>  
		<script src="<?php print base_path() . path_to_theme(); ?>/js/libs/innershiv.min.js" type="text/javascript"></script>
		
	<![endif]-->
	<script type="text/javascript" src="<?php print base_path() . path_to_theme(); ?>/js/script.js"></script>
	
	<!--[if lte IE 8]>
		<script>
			$(document).ready(function(){
				RECESS.site.browserDetect();
			});
		</script>
	<![endif]-->    
	<script type="text/javascript">
	    var $ = jQuery.noConflict();
	    
	    //$(document).bind('pageinit', function()
	    $(document).ready(function() 
	        { 
	            RECESS.site.init();

	            // LOAD GA
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

				ga('create', 'UA-22356273-1', 'auto');
				ga('send', 'pageview');

				$("html[data-useragent*='MSIE 10.0']").addClass('ie10');
	        } 
	    );
	</script>
	
	<div id="fb-root" class="fb_reset"></div>
	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<script type="text/javascript">
	//<!--
		FB.init({
		    appId  : '732464433481380',
		    status : true, // check login status
		    cookie : true, // enable cookies to allow the server to access the session
		    xfbml  : true, // parse XFBML
		    oauth  : true
		});
	//-->  	
	</script>
	
	<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
	<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->
	
  	<div id="submit-loader"><img src="<?php print base_path() . path_to_theme(); ?>/images/ajax-loader.gif" alt="loading..." /></div>
  	<div id="browserdetect-modal" class="modal-container" style="display: none;">
	  	<aside class="twelve-col col browser-detect">
	  		<h2>Your browsers so old...</h2>
	  		<p>it DJ’d the Boston Tea Party.</p>
			<div class="browser-list">
				<ul>
					<li><a href="https://www.google.com/intl/en/chrome/browser/" title="Chrome" target="_blank" class="chrome"><span></span></a></li>
					<li><a href="http://www.mozilla.org/en-US/firefox/new/" title="Firefox" target="_blank" class="firefox"><span></span></a></li>
					<li><a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie" title="Internet Explorer" target="_blank" class="ie"><span></span></a></li>
					<li><a href="http://www.opera.com/computer/" title="Opera" target="_blank" class="opera"><span></span></a></li>
					<li><a href="http://support.apple.com/downloads/#safari" title="Safari" target="_blank" class="safari"><span></span></a></li>
				</ul>
			</div>
			<p>Please upgrade to a new browser for a better, safer and faster experience.</p>
	  	</aside>
	</div>
</body>
</html>
