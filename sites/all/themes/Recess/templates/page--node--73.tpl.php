<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/includes/header.php'); ?>
<?php 
	$fieldimage = field_view_field('node', $node, 'field_image');
	$image = file_create_url($node->field_image['und'][0]['uri']);
	$bodyfield = field_get_items('node', $node, 'body');
  	$body = field_view_value('node', $node, 'body', $bodyfield[0]);
?>
<article role="main" class="sitemap-page">
	<?php if ($fieldimage) { ?>
		<section class="leaderboard">
			<img src="<?php print $image; ?>" alt="<?php print $node->title; ?>" />
		</section>
	<?php } ?>
	<div class="container">
		<section role="main" class="nine-col centered">
			<header>
				<?php if ($title): ?>
				<h1><?php print $title; ?></h1>
				<?php endif; ?>
			</header>
			<?php print render($body); ?>
			<section class="sitemap-section">
				<?php 
		      		$menu_name = variable_get('menu_main_links_source', 'main-menu');
				    $tree = menu_tree($menu_name);
				    print drupal_render($tree);
		      	?>
			</section>
		</section>
 	</div>
</article>
<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/recess/includes/footer.php'); ?>