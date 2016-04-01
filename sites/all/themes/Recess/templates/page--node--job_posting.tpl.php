<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/includes/header.php'); ?>
<?php 
	$bodyfield = field_get_items('node', $node, 'body');
  	$body = field_view_value('node', $node, 'body', $bodyfield[0]);
?>
<article role="main">
	<div class="container">
		<section role="main" class="nine-col centered job-details">
			<header>
				<?php if ($title): ?>
				<h1 class="animate-in"><?php print $title; ?></h1>
				<?php endif; ?>
				<a class="back-to-careers animate-in first" href="/careers">Back to Careers</a> 
			</header>
			<div class="animate-in">
				<?php if ($bodyfield) { print render($body); } else { print render($page['content']); } ?>
			</div>
			<header>
				<a class="back-to-careers animate-in mobile-only" href="/careers" style="display:none;">Back to Careers</a>
			</header>
		</section>
 	</div>
 	<section class="apply-form animate-in">
 		<div class="container">
 			<div class="nine-col centered">
 				<?php 
					$block = block_load('webform', 'client-block-36');      
					$output = drupal_render(_block_get_renderable_array(_block_render_blocks(array($block))));        
					print $output;
				?>
				<section class="success">
					<?php 
						$blockConfirm = block_load('block', 10);      
						$outputConfirm = drupal_render(_block_get_renderable_array(_block_render_blocks(array($blockConfirm))));        
						print $outputConfirm;
					?>
					<a class="back-to-careers" href="/careers">Back to Careers</a>
				</section>
 			</div>
 		</div>
 	</section>
</article>
<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/recess/includes/footer.php'); ?>