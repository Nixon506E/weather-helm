<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/includes/header.php'); ?>
<?php 
	$bodyfield = field_get_items('node', $node, 'body');
  	$body = field_view_value('node', $node, 'body', $bodyfield[0]);
?>
<article role="main">
	<div class="container">
		<section role="main" class="nine-col centered">
			<header>
				<?php if ($title): ?>
				<h1><?php print $title; ?></h1>
				<?php endif; ?>
			</header>
			<?php if ($bodyfield) { print render($body); } else { print render($page['content']); } ?>
		</section>
 	</div>
</article>
<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/recess/includes/footer.php'); ?>