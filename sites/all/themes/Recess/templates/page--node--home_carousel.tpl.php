<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/includes/header.php'); ?>
<article role="main">
	<div class="container">
		<section role="main" class="nine-col centered">
			<header>
				<?php if ($title): ?>
				<h1><?php print $title; ?></h1>
				<?php endif; ?>
			</header>
			<?php print render($page['content']); ?>
		</section>
 	</div>
</article>
<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/recess/includes/footer.php'); ?>