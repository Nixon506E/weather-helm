<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/includes/header.php'); ?>
<?php 
	$fieldimage = field_view_field('node', $node, 'field_image');
	$image = file_create_url($node->field_image['und'][0]['uri']);
	$bodyfield = field_get_items('node', $node, 'body');
  	$body = field_view_value('node', $node, 'body', $bodyfield[0]);
  	//$hexvaluefield = field_get_items('node', $node, 'field_color_hex_value');
  	//$hexvalue = field_view_value('node', $node, 'field_color_hex_value', $hexvaluefield[0]);
  	$cssclassfield = field_get_items('node', $node, 'field_css_class');
  	$cssclass = field_view_value('node', $node, 'field_css_class', $cssclassfield[0]);
  	$screenshotsfield = field_get_items('node', $node, 'field_extra_screenshots');
  	$screenshots = field_view_value('node', $node, 'field_extra_screenshots', $screenshotsfield[0]);
  	$weburlfield = field_get_items('node', $node, 'field_website_url');
  	$weburl = field_view_value('node', $node, 'field_website_url', $weburlfield[0]);
  	$weburldisplayfield = field_get_items('node', $node, 'field_website_url_display');
  	$weburldisplay = field_view_value('node', $node, 'field_website_url_display', $weburldisplayfield[0]);
  	$brandcategoryfield = field_view_field('node', $node, 'field_brand_category');
  	$tagsfield = field_view_field('node', $node, 'field_tags');
	//$brandCategoryTerm = $node->field_brand_category[LANGUAGE_NONE][0]['taxonomy_term']->name;
	//$brandCategoryIcon = $node->field_brand_category[LANGUAGE_NONE][0]['taxonomy_term']->field_icon_character['und'][0]['value'];
?>
<article role="main" class="<?php print render($cssclass); ?>">
	
	<section class="leaderboard">
		<header>
			<figure class="project-logo">
				<img src="<?php print $image; ?>" alt="<?php print $node->title; ?>" />
			</figure>
			<h1><?php print $node->title; ?></h1>
			<section class="container project-intro">
				<div class="nine-col col centered">
					<?php if ($bodyfield) { print render($body); } ?>
					<a class="site-link" href="<?php print render($weburl); ?>" target="_blank"><?php print render($weburldisplay); ?></a>
				</div>
			</section>
		</header>
		<?php if ($brandcategoryfield || $tagsfield) { ?>
		<section class="tags">
			<?php foreach($node->field_brand_category[LANGUAGE_NONE] as $terms) { ?>
				<a class="tag category-item" href="javascript:void(0)">
					<span class="icon" aria-label="<?php print $terms['taxonomy_term']->name; ?>"><?php print $terms['taxonomy_term']->field_icon_character['und'][0]['value'];  ?></span>
					<div class="tooltip">
						<span class="carrot"></span>
						<span class="title"><?php print $terms['taxonomy_term']->name; ?></span>
					</div>
				</a>
			<?php } ?>
			<?php foreach($node->field_tags[LANGUAGE_NONE] as $tags) { ?>
				<a class="tag category-item" href="javascript:void(0)">
					<span class="icon" aria-label="<?php print $tags['taxonomy_term']->name;  ?>"><?php print $tags['taxonomy_term']->field_icon_character['und'][0]['value'];  ?></span>
					<div class="tooltip">
						<span class="carrot"></span>
						<span class="title"><?php print $tags['taxonomy_term']->name; ?></span>
					</div>
				</a>
			<?php } ?>
		</section>
		<?php } ?>
	</section>

	<div class="container">
		<section role="main" class="twelve-col centered screenshots">
			<?php print $node->field_extra_screenshots[LANGUAGE_NONE][0]['value']; ?>
		</section>
		<section class="twelve-col centered more-site-links">
			<span>Check it out</span>
			<a class="site-link" href="<?php print render($weburl); ?>" target="_blank"><?php print render($weburldisplay); ?></a>
		</section>
 	</div>
</article>
<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/recess/includes/footer.php'); ?>