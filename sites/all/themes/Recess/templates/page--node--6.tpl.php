<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/includes/header.php'); ?>
<?php 
	$fieldimage = field_view_field('node', $node, 'field_image');
	$image = file_create_url($node->field_image['und'][0]['uri']);
	$bodyfield = field_get_items('node', $node, 'body');
  	$body = field_view_value('node', $node, 'body', $bodyfield[0]);
?>
<article role="main">
	<div class="container">
		<section role="main">
			<section class="centered eight-col col main_content animate-in">
				<header>
					<?php if ($title): ?>
					<h1><?php print $title; ?></h1>
					<?php endif; ?>
				</header>
				<?php print render($body); ?>
			</section>
			<?php
                // $blockReasons = block_load('block',8);
                // $outputReasons = drupal_render(_block_get_renderable_array(_block_render_blocks(array($blockReasons))));
                // print $outputReasons;
            ?>
		</section>
 	</div>
 	<section class="current-openings animate-in">
 		<div class="container">
	 		<h2 class="twelve-col col centered">Current Openings</h2>
	 		<section class="jobs">
	 			<?php 
	 			$query = new EntityFieldQuery();
				$query->entityCondition('entity_type', 'node')
					  	->entityCondition('bundle', 'job_posting')
					  	->propertyCondition('status', 1)
					  	->addTag('sort_by_weight');
				$result = $query->execute();
				$nodes = node_load_multiple(array_keys($result['node'])); 
				//$nodes = node_load_multiple(array(), array('type' => 'job_posting', 'status' => 1)); 
				foreach($nodes as $job):
					$nodeID = $job->nid;
					$nodejob = node_load($nodeID);
					$nodeurl = url('node/'. $job->nid);
					$fieldiconimage = field_view_field('node', $nodejob, 'field_image');
					$iconimage = file_create_url($job->field_image['und'][0]['uri']);
				?>
				<article class="job-posting four-col col">
		 			<a href="<?php print $nodeurl; ?>">
		 				<?php if ($fieldiconimage) { ?>
		 				<span class="image"><img src="<?php print $iconimage;?>" alt="<?php print $job->title;?>"></span>
		 				<?php } ?>
		 				<span class="job-title"><?php print $job->title; ?></span>
		 			</a>
		 		</article>
		 		<?php endforeach; ?>
		 		
		 	</section>
		 	<?php
		 		if (count($nodes) < 1) {
	                $blockNoOpenings = block_load('block',11);
	                $outputNoOpenings = drupal_render(_block_get_renderable_array(_block_render_blocks(array($blockNoOpenings))));
	                print $outputNoOpenings;
            	}
            ?>

            <script>
            	$(document).ready( function()
            		{
            			if( $('.jobs .job-posting').size() == 1 )
						{
						  $('.jobs .job-posting').removeClass('four-col').addClass('twelve-col');
						}

						if( $('.jobs .job-posting').size() == 2 )
						{
						  $('.jobs .job-posting').removeClass('four-col').addClass('six-col');
						}

						if( $('.jobs .job-posting').size() == 4 )
						{
						  $('.jobs .job-posting').removeClass('four-col').addClass('three-col');
						}
            		}
            	);
            </script>

 		</div>
 	</section>
 	<section class="quote-section">
 		<?php if ($fieldimage) { ?>
 		<div class="image five-col animate-in">
 			<img src="<?php print $image; ?>" alt="<?php print $node->title; ?>" />
 		</div>
 		<div class="seven-col animate-in career-quote-container">
 			<?php
                $blockQuote = block_load('block',9);
                $outputQuote = drupal_render(_block_get_renderable_array(_block_render_blocks(array($blockQuote))));
                print $outputQuote;
            ?>
 		</div>
 		<?php } ?>

 	</section>
</article>
<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/recess/includes/footer.php'); ?>