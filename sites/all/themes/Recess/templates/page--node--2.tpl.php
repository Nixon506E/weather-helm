<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/includes/header.php'); ?>
<?php 
	$fieldimage = field_view_field('node', $node, 'field_image');
	$image = file_create_url($node->field_image['und'][0]['uri']);
	$fieldimage2 = field_view_field('node', $node, 'field_image_2');
	$image2 = file_create_url($node->field_image_2['und'][0]['uri']);
	$bodyfield = field_get_items('node', $node, 'body');
  	$body = field_view_value('node', $node, 'body', $bodyfield[0]);
?>
<article role="main">
	<?php if ($fieldimage) { ?>
		<section class="leaderboard animate-in">
			<?php if ($fieldimage2) {echo '<div class="leaderboard-carousel">'; } ?>
			<img src="<?php print $image; ?>" alt="<?php print $node->title; ?>" />
			<?php if ($fieldimage2) { ?>
			<img src="<?php print $image2; ?>" alt="<?php print $node->title; ?>" />
			<?php } ?>
			<?php if ($fieldimage2) {echo '</div>'; } ?>
		</section>
	<?php } ?>
	<section class="agency-intro">
		<div class="container">
			<header class="six-col col animate-in">
				<?php if ($title): ?>
					<h1><?php print $title; ?></h1>
				<?php endif; ?>
				<?php print render($body); ?>
			</header>
			<div class="six-col col animate-in">
				<?php
	                $blockMission = block_load('block',2);
	                $outputMission = drupal_render(_block_get_renderable_array(_block_render_blocks(array($blockMission))));
	                print $outputMission;
	            ?>
	            <?php
	                $blockVision = block_load('block',6);
	                $outputVision = drupal_render(_block_get_renderable_array(_block_render_blocks(array($blockVision))));
	                print $outputVision;
	            ?>
	            <?php
	                $blockValues = block_load('block',7);
	                $outputValues = drupal_render(_block_get_renderable_array(_block_render_blocks(array($blockValues))));
	                print $outputValues;
	            ?>
        	</div>
	 	</div>
	</section>
	<section class="services">
		<?php
            $blockTwo = block_load('block',1);
            $outputTwo = drupal_render(_block_get_renderable_array(_block_render_blocks(array($blockTwo))));
            print $outputTwo;
        ?>
        <div class="services-inner animate-in">
		<section class="services-intro">
	        <?php
	            // $blockServicesImage = block_load('block',13);
	            // $outputServicesImage = drupal_render(_block_get_renderable_array(_block_render_blocks(array($blockServicesImage))));
	            // print $outputServicesImage;
	        ?>
	        <?php
	            $blockServicesText = block_load('block',14);
	            $outputServicesText = drupal_render(_block_get_renderable_array(_block_render_blocks(array($blockServicesText))));
	            print $outputServicesText;
	        ?>
	    </section>
		<section class="flip-cards col twelve-col">
			<?php 
				$queryServices = new EntityFieldQuery();
				$queryServices->entityCondition('entity_type', 'node')
				  ->entityCondition('bundle', 'services')
				  ->propertyCondition('status', 1)
				  ->addTag('sort_by_weight');
				$resultServices = $queryServices->execute();
				$nodesServices = node_load_multiple(array_keys($resultServices['node']));

				foreach($nodesServices as $card) { 
					$nodeID = $card->nid;
					$nodecard = node_load($nodeID);
					$cardbodyfield = field_get_items('node', $nodecard, 'body');
					$cardbody = field_view_value('node', $nodecard, 'body', $cardbodyfield[0]);
					$cardimage = file_create_url($card->field_image['und'][0]['uri']);
			?>
				<div class="flip"> 
					<div class="card"> 
					    <div class="face front"> 
					    	<div class="card-image"><img src="<?php print $cardimage; ?>" alt="<?php print $card->title; ?>"></div>
					        <h3><?php print $card->title; ?></h3>
					    </div> 
					    <div class="face back"> 
					    	<h3><?php print $card->title; ?></h3>
					    	<div class="card-image-back"><img src="<?php print $cardimage; ?>" alt="<?php print $card->title; ?>"></div>
					        <?php print render($cardbody); ?>
					    </div> 
					</div> 
				</div>
			<?php } ?>
		</section>
		</div>
	</section>
	<section class="approach animate-in">
        <section class="approach-intro">
	        <?php
	            $blockFive = block_load('block',5);
	            $outputFive = drupal_render(_block_get_renderable_array(_block_render_blocks(array($blockFive))));
	            print $outputFive;
	        ?>
	        <?php
	            // $blockThree = block_load('block',3);
	            // $outputThree = drupal_render(_block_get_renderable_array(_block_render_blocks(array($blockThree))));
	            // print $outputThree;
	        ?>
	    </section>
        <section class="flip-cards col twelve-col">
			<?php include(path_to_theme().'/includes/approach-cards.php'); ?>
		</section>
	 </section>
 	<section class="super-squad">
 		<header class="container animate-in">
			<h2 class="twelve-col centered">The Recess Super Squad</h2>
			<p class="nine-col centered">We are persuaders, strategists, tech geeks and storytellers. We’re designers, developers, heroes and villains. We innovate. We transform. We game. We start fires. Get to know us a bit better by screwing around a bit below.</p>
		</header>
		<section class="super-squad-profiles">
			<?php 
				$query = new EntityFieldQuery();
			$query->entityCondition('entity_type', 'node')
			  ->entityCondition('bundle', 'super_squad')
			  ->propertyCondition('status', 1)
			  ->addTag('sort_by_weight');
			$result = $query->execute();
			$nodes = node_load_multiple(array_keys($result['node']));

			foreach($nodes as $bios) { 
				$nodeID = $bios->nid;
				$nodebios = node_load($nodeID);
				$squadbodyfield = field_get_items('node', $nodebios, 'body');
					$squadbody = field_view_value('node', $nodebios, 'body', $squadbodyfield[0]);
				$bioimage = file_create_url($bios->field_image['und'][0]['uri']);
				$biobackimage = file_create_url($bios->field_back_image['und'][0]['uri']);
				$positionfield = field_get_items('node', $nodebios, 'field_position');
					$position = field_view_value('node', $nodebios, 'field_position', $positionfield[0]);
					$goodatfield = field_get_items('node', $nodebios, 'field_things_they_are_good_at');
					$goodat = field_view_value('node', $nodebios, 'field_things_they_are_good_at', $goodatfield[0]);
					$badatfield = field_get_items('node', $nodebios, 'field_things_they_are_bad_at');
					$badat = field_view_value('node', $nodebios, 'field_things_they_are_bad_at', $badatfield[0]);

					$firstname = explode(' ', $nodebios->title);
					$firstname = $firstname[0];
		?>
			
			<article class="col three-col bio animate-in">
				<img src="<?php print $bioimage; ?>" alt="<?php print $bios->title; ?>" style="visibility: hidden; float: left;">
				<div class="card">
					<div class="bio-front face">
						<img src="<?php print $bioimage; ?>" alt="<?php print $bios->title; ?>">
						<header>
							<h3><?php print $bios->title; ?></h3>
							<h4><?php print render($position); ?></h4>
						</header>
						<button class="mini-button team-open">
							<a href="javascript:void(0)"><span aria-label="Open For More Info" class="icon">+</span></a>
						</button>
					</div>
					<div class="bio-back face">
						<div class="back-image">
							<span></span>
							<img src="<?php print $biobackimage; ?>" alt="<?php print $bios->title; ?>">
						</div>
						<section class="person-bio">
							<header>
								<h3><?php print $bios->title; ?></h3>
								<h4><?php print render($position); ?></h4>
							</header>
							<section class="bio-content">
								<div class="main-bio">
									<?php print render($squadbody); ?>
								</div>
								<div class="wicked-bad">
									<?php if ($goodatfield) { ?>
									<section class="wicked">
										<p><?php print $firstname; ?> is wicked good at:</p>
										<?php print render($goodat); ?>
									</section>
									<?php } if ($badatfield) { ?>
									<section class="bad">
										<p><?php print $firstname; ?> is super bad at:</p>
										<?php print render($badat); ?>
									</section>
									<?php } ?>
								</div>
							</section>
						</section>
						<button class="mini-button team-close">
							<a href="javascript:void(0)"><span aria-label="Close" class="icon">X</span></a>
						</button>
					</div>
				</div>
			</article>

		<?php
			}
			?>
		</section>
 		<div class="container join">
 			<button class="button recess four-col">
				<a href="/careers">Join The Team</a>
			</button>
 		</div>
 	</section>
 	<section class="accolades">
 		<div class="container">
 			<section class="col six-col accolades-info animate-in">
 				<header>
 					<h2>Accolades</h2>
 				</header>
 				<p class="big-p">Awards are great. We love to be recognized for our work. Who doesn’t? What we love more is when our cutting edge ideas deliver tangible results for our clients. But a little hardware never hurt anybody.</p>
 			</section>
 			<section class="col six-col nailed-it animate-in">
 				<span class="count" id="count-up">0</span>
 				<span class="line-2">Total Awards</span>
 				<span class="line-3">(so far)</span>
 			</section>
 		</div>
 	</section>
 	<section class="flip-cards twelve-col light-colored accolade-cards animate-in">
		<?php 
		function taxonomy_options_array($machine_name) {
			$v = taxonomy_vocabulary_machine_name_load($machine_name);
			$terms = taxonomy_get_tree($v->vid);
			foreach ($terms as $term) {
				$options[$term->tid] = $term->name;
			}
			return $options;
		}
		$vocabularyTerms = taxonomy_options_array('award_type');

		foreach($vocabularyTerms as $key => $val) { 
			$valClass = strtolower(str_replace(' ', '-', $val));
			$termLoad = taxonomy_term_load($key);
			$term_page =  taxonomy_term_view($termLoad, $view_mode = 'full');
			$term_url = taxonomy_term_uri($termLoad);
			$image_url=$term_page['#term']->field_image['und'][0]['uri']; 
			$white_image = $term_page['#term']->field_white_image['und'][0]['uri']; 
			if ($image_url != null) {
				$image_url = file_create_url($image_url);
			} else {
				$image_url = '/'.path_to_theme().'/images/w3-award.png';
			}

			if ($white_image != null) {
				$white_image = file_create_url($white_image);
			} else {
				$white_image = $image_url;
			}

			

	?>

	<div class="flip <?php print $valClass; ?>"> 
		<div class="card"> 
		    <div class="face front">
		    	<div class="award-image"><img src="<?php print $image_url; ?>"/></div>
		    </div> 
		    <div class="face back">
		   		<div class="award-image"><img src="<?php print $white_image; ?>"/></div> 
		    	<h3><?php print $val; ?></h3>
		    	<ul>
		    	<?php 
		    		/*$query2 = new EntityFieldQuery();
					$query2->entityCondition('entity_type', 'node')
					  ->entityCondition('bundle', 'accolades')
					  ->fieldCondition('field_award_type', 'tid', $key)
					  ->propertyCondition('status', 1);
					$result2 = $query2->execute();
					$nodes2 = node_load_multiple(array_keys($result2['node']));

					foreach($nodes2 as $award) {

		    	?>
		        <li><?php print $award->title; ?></li>
		        <?php }*/ ?>
		    	</ul>
		    </div> 
		</div> 
	</div>
	<?php	
		}

		?>
	</section>
	<?php /*<section class="view-more four-col animate-in">
		<button class="button light-grey">
			<a href="javascript:void(0)">View More Awards</a>
		</button>
	</section> */ ?>
</article>
<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/recess/includes/footer.php'); ?>