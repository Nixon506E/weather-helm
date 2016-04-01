<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/bratenahl/includes/header.php'); ?>

	<div class="wrap">
		<div class="container">
			<?php $sidebar_first  = render($page['sidebar_first']);  ?>
	        <?php if ($sidebar_first): ?>
				<aside class="three-col col">
		            <?php print $sidebar_first; ?>
				</aside>
				<section class="nine-col col">
					<?php print render($page['content']); ?>
				</section>
			<?php else: ?>	
				<?php print render($page['content']); ?>
			<?php endif; ?>
		</div>
	</div>

<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/bratenahl/includes/footer.php'); ?>