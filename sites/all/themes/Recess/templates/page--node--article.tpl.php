<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/includes/header.php'); ?>
<?php 
	$fieldimage = field_view_field('node', $node, 'field_image');
	$image = file_create_url($node->field_image['und'][0]['uri']);
	$bodyfield = field_get_items('node', $node, 'body');
  	$body = field_view_value('node', $node, 'body', $bodyfield[0]);
  	$subtitlefield = field_get_items('node', $node, 'field_subtitle');
  	$subtitle = field_view_value('node', $node, 'field_subtitle', $subtitlefield[0]);
  	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  	$tagsfield = field_view_field('node', $node, 'field_tags');
?>
<article role="main" class="article <?php if ($fieldimage) { echo 'top-image'; }?>">
	<?php if ($fieldimage) { ?>
		<section class="leaderboard animate-in">
			<img src="<?php print $image; ?>" alt="<?php print $node->title; ?>" />
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
			<header>
				<?php if ($title): ?>
				<h1><?php print $title; ?></h1>
				<?php endif; ?>
				<?php if ($subtitlefield): ?>
				<h2><?php print render($subtitle); ?></h2>
				<?php endif; ?>
				<div class="date">
					<?php print date('m/d/Y', $node->created); ?>
				</div>
			</header>
		</section>
	<?php } ?>
	<div class="container">
		<section role="main" class="nine-col centered">
			<?php if (!$fieldimage) { ?>
			<header class="animate-in">
				<?php if ($tagsfield) { ?>
				<section class="categories-terms">
					<?php foreach($node->field_tags[LANGUAGE_NONE] as $tags) { ?>
					<div class="category-item">
						<div class="icon" aria-label="<?php print $tags['taxonomy_term']->name;  ?>">
							<?php print $tags['taxonomy_term']->field_icon_character['und'][0]['value'];  ?>
						</div>
						<div class="tooltip">
							<?php print $tags['taxonomy_term']->name;  ?>
						</div>
					</div>
					<?php } ?>
				</section>
				<?php } ?>
				<?php if ($title): ?>
				<h1><?php print $title; ?></h1>
				<?php endif; ?>
				<?php if ($subtitlefield): ?>
				<h2><?php print render($subtitle); ?></h2>
				<?php endif; ?>
				<div class="date">
					<?php print date('m/d/Y', $node->created); ?>
				</div>
			</header>
			<?php } ?>
			<div class="animate-in">
				<?php if ($bodyfield) { print render($body); } else { print render($page['content']); } ?>
			</div>
			<section class="share-section animate-in">
				<h4>If you like it so much, why don't you marry it?</h4>
				<div class="share">
					<button class="mini-button recess icon-social">
						<a href="http://twitter.com/home?status=Check out this News Article <?php print $actual_link; ?> via @RecessCreative." target="_blank">T</a>
					</button>
					<button class="mini-button recess icon-social">
						<a href="javascript:void(0)" id="facebook-share">F</a>
					</button>
					<button class="mini-button recess icon-social">
						<a href="#" id="linked-in-share" target="_blank">L</a>
					</button>
				</div>
				<button class="button recess">
					<a href="/scuttlebutt">Back to Scuttlebutt</a>
				</button>
			</section>
		</section>
 	</div>
</article>
<script type="text/javascript">
	var captionText = $('h1').text();
	var descriptionText = $('.leaderboard header h2').text();
	$('#facebook-share').click(function(){
		FB.ui({
			method: 'feed',
			name: captionText,
			link: document.URL,
			caption: 'Recess Creative',
			/*picture: quizImage,*/
			description: descriptionText
		}, function(response){});
	});
	var linkedInShareURL = 'http://www.linkedin.com/shareArticle?mini=true&url=' + document.URL + '&title=' + captionText + '&summary=' + descriptionText + '&source=RecessCreative';
	$('#linked-in-share').attr('href', linkedInShareURL);
</script>
<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/recess/includes/footer.php'); ?>