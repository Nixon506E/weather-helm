<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/includes/header.php'); ?>
<?php 
	$fieldimage = field_view_field('node', $node, 'field_image');
	$image = file_create_url($node->field_image['und'][0]['uri']);
	$bodyfield = field_get_items('node', $node, 'body');
  	$body = field_view_value('node', $node, 'body', $bodyfield[0]);
?>
<article role="main" id="main-article">
	<?php if ($fieldimage) { ?>
		<section class="leaderboard animate-in">
			<img src="<?php print $image; ?>" alt="<?php print $node->title; ?>" />
			<header class="animate-in">
				<?php if ($title): ?>
				<h1><?php print $title; ?></h1>
				<?php endif; ?>
				<?php print render($body); ?>
			</header>
		</section>
	<?php } else { ?>
	<div class="container">
		<section role="main" class="nine-col centered" id="main-section">
			<header>
				<?php if ($title): ?>
				<h1><?php print $title; ?></h1>
				<?php endif; ?>
			</header>
			<?php if ($bodyfield) { print render($body); } else { print render($page['content']); } ?>
		</section>
 	</div>
 	<?php } ?>
</article>
<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/recess/includes/footer.php'); ?>