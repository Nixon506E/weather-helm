<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/includes/header.php'); ?>
<?php 
	$fieldimage = field_view_field('node', $node, 'field_image');
	$image = file_create_url($node->field_image['und'][0]['uri']);
	$bodyfield = field_get_items('node', $node, 'body');
  	$body = field_view_value('node', $node, 'body', $bodyfield[0]);
?>
<article role="main">
	<?php if ($fieldimage) { ?>
		<section class="leaderboard">
			<img src="<?php print $image; ?>" alt="<?php print $node->title; ?>" />
		</section>
	<?php } ?>
	<div class="container">
		<section role="main" class="nine-col centered">
			<header>
			</header>
		</section>
		
 	</div>
 	<section class="masonry scuttlebutt" id="scuttlebutt">
 		<?php $currenttime = date('U'); ?>
 		 <article class="intro item" style="display: none;">
 			<div class="intro-container">
 				<h1><?php print $title; ?></h1>
				<div class="intro-content">
					<?php print render($body); ?>
				</div>
				<div class="description"><span class="date" data-timestamp="<?php print $currenttime; ?>"></span></div>
 			</div>
 		</article> 
 		<?php include(path_to_theme().'/php/tweets.php'); ?>
 		<?php include(path_to_theme().'/php/instagram.php'); ?>
 		<?php include(path_to_theme().'/php/facebook-posts.php'); ?>
 		
 		<?php 
			$nodes = node_load_multiple(array(), array('type' => 'article', 'status' => 1)); 
			foreach($nodes as $article):
				$nodeID = $article->nid;
				$nodearticle = node_load($nodeID);
				$image = file_create_url($article->field_image['und'][0]['uri']);
				$thumbnailimage = file_create_url($article->field_thumbnail_image['und'][0]['uri']);
				$newstypefield = field_get_items('node', $nodearticle, 'field_news_type');
  				$newstype = field_view_value('node', $nodearticle, 'field_news_type', $newstypefield[0]);
  				$externalurlfield = field_get_items('node', $nodearticle, 'field_external_news_url');
  				$externalurl = field_view_value('node', $nodearticle, 'field_external_news_url', $externalurlfield[0]);
				$nodeurl = url('node/'. $article->nid);
				$timestamp = $article->created;


				if (trim(render($newstype)) == 'Press Release') {
		?>
			<article class="pr item">
				<div class="pr-container">
					<div class="icon-header">
						<img src="/<?php print path_to_theme();?>/images/icon_scuttlebutt_news.png" alt="Press Release">
					</div>
					<h3><?php print $article->title; ?></h3>
					<div class="pr-content">
						<?php print $article->body[LANGUAGE_NONE][0]['summary']; ?>
					</div>
					<button class="button reverse-recess">
						<a href="<?php print $nodeurl; ?>">Read More</a>
					</button>
					<div class="description"><span class="date" data-timestamp="<?php print $timestamp; ?>"><?php print date('m/d/Y', $timestamp); ?></span> | Press Release</div>
				</div>
			</article>
		<?php } else if (trim(render($newstype)) == 'In The News') {
		?>
			<article class="general item">
				<div class="general-container">
					<div class="icon-header">
						<img src="/<?php print path_to_theme();?>/images/icon_scuttlebutt_news.png" alt="News">
					</div>
					<h3><?php print $article->title; ?></h3>
					<div class="general-content">
						<?php print $article->body[LANGUAGE_NONE][0]['summary']; ?>
					</div>
					<button class="button reverse-recess">
						<a href="<?php print render($externalurl); ?>" target="_blank">Read More</a>
					</button>
					<div class="description"><span class="date" data-timestamp="<?php print $timestamp; ?>"><?php print date('m/d/Y', $timestamp); ?></span> | In The News</div>
				</div>
			</article>
		<?php } else if (trim(render($newstype)) == 'Post') {
		?>
			<article class="general item">
				<div class="general-container">
					<div class="icon-header">
						<img src="/<?php print path_to_theme();?>/images/icon_scuttlebutt_news.png" alt="News">
					</div>
					<h3><?php print $article->title; ?></h3>
					<div class="general-content">
						<?php print $article->body[LANGUAGE_NONE][0]['summary']; ?>
					</div>
					<button class="button reverse-recess">
						<a href="<?php print $nodeurl; ?>">Read More</a>
					</button>
					<div class="description"><span class="date" data-timestamp="<?php print $timestamp; ?>"><?php print date('m/d/Y', $timestamp); ?></span> | Post</div>
				</div>
			</article>
		<?php } else { ?>
			<article class=" item">
				<?php print render($newstype); ?>
				<div class="description"><span class="date" data-timestamp="<?php print $timestamp; ?>"><?php print date('m/d/Y', $timestamp); ?></span></div>
			</article>
		<?php } endforeach; ?>
		<article class="final-item item">
			<div class="item-container">
				<div class="icon-header">
					<img src="/<?php print path_to_theme();?>/images/icon_scuttlebutt_final.png" alt="More Social">
				</div>
				<div class="item-content">
					<p>Craving a little more? You can dig into a loaded buffet of content at any of our Social Channels.</p>
					<p class="links">
						<a class="icon-social" aria-label="Twitter" href="http://twitter.com/recesscreative" target="_blank">T</a>
						<a class="icon-social" aria-label="Facebook" href="http://facebook.com/recesscreative" target="_blank">F</a>
						<a class="icon-social" aria-label="LinkedIn" href="http://www.linkedin.com/company/recess-creative" target="_blank">L</a>
						<a class="icon-social" aria-label="Instagram" href="http://instagram.com/recesscreative" target="_blank">I</a>
					</p>
				</div>
				<div class="description"><span class="date" data-timestamp="1"></span></div>
			</div>
		</article>
		<?php 
			/*$nodes2 = node_load_multiple(array(), array('type' => 'case_study', 'status' => 1)); 
			foreach($nodes2 as $casestudy):
				$nodeID = $casestudy->nid;
				$nodecasestudy = node_load($nodeID);
				//$image = file_create_url($article->field_image['und'][0]['uri']);
				$scuttlebuttimage = file_create_url($casestudy->field_scuttlebutt_image['und'][0]['uri']);
				$taglinefield = field_get_items('node', $nodecasestudy, 'field_tagline');
  				$tagline = field_view_value('node', $nodecasestudy, 'field_tagline', $taglinefield[0]);
  				$classfield = field_get_items('node', $nodecasestudy, 'field_css_class');
  				$cssclass = field_view_value('node', $nodecasestudy, 'field_css_class', $classfield[0]);
  				//$colorfield = field_get_items('node', $nodecasestudy, 'field_color_hex_value');
  				//$color = field_view_value('node', $nodecasestudy, 'field_color_hex_value', $colorfield[0]);
				$nodeurl = url('node/'. $casestudy->nid);
				$timestamp = $casestudy->created;
		?>
		<article onclick="window.location='<?php print $nodeurl; ?>';" class="case-study item <?php print render($cssclass); ?>" style="background: url(<?php print $scuttlebuttimage; ?>) no-repeat center center; background-size: cover;">
			<img src="<?php print $scuttlebuttimage; ?>" class="case-study-img" alt="<?php print $casestudy->title; ?>">
			<div class="case-study-container">
				<div class="case-study-content">
					<div class="label">Case Study</div>
					<h2><?php print $casestudy->title; ?>.<br><?php print render($tagline); ?></h2>
				</div>
				<div class="description"><span class="date" data-timestamp="<?php print $timestamp; ?>"></span></div>
			</div>
		</article>
		<?php endforeach; */ ?>
 	</section>
</article>
<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/recess/includes/footer.php'); ?>