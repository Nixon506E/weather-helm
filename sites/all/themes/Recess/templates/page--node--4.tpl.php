<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/includes/header.php'); ?>
<?php 
	$fieldimage = field_view_field('node', $node, 'field_image');
	$image = file_create_url($node->field_image['und'][0]['uri']);
	$bodyfield = field_get_items('node', $node, 'body');
  	$body = field_view_value('node', $node, 'body', $bodyfield[0]);
?>
<article role="main">
	<?php if ($fieldimage) { ?>
		<section class="leaderboard animate-in">
			<img src="<?php print $image; ?>" alt="<?php print $node->title; ?>" />
		</section>
	<?php } ?>
	<div class="container work-container">
		<section role="main" class="twelve-col col">
			<header>
				<?php if ($title): ?>
				<h1><?php print $title; ?></h1>
				<?php endif; ?>
			</header>
			<?php if ($bodyfield) { print render($body); } else { print render($page['content']); } ?>
		</section>
		<section class="our-work">
			
			<?php 
			$queryCS = new EntityFieldQuery();
			$queryCS->entityCondition('entity_type', 'node')
				  	->entityCondition('bundle', 'case_study')
				  	->propertyCondition('status', 1)
				  	->addTag('sort_by_weight');
			$resultCS = $queryCS->execute();
			$CaseStudyNodes = node_load_multiple(array_keys($resultCS['node'])); 
			$count = 1;
			foreach($CaseStudyNodes as $projects):
				$nodeID = $projects->nid;
				$nodeproject = node_load($nodeID);
				$thumbnailimagefield = field_get_items('node', $nodeproject, 'field_work_landing_thumbnail');
				$thumbnailimage = file_create_url($projects->field_work_landing_thumbnail['und'][0]['uri']);
				$leaderboardimage = file_create_url($projects->field_image['und'][0]['uri']);
				$nodeurl = url('node/'. $projects->nid);
				$taglinefield = field_get_items('node', $nodeproject, 'field_tagline');
  				$tagline = field_view_value('node', $nodeproject, 'field_tagline', $taglinefield[0]);


				if ($count == 1 || $count == 2) {
					$colWidth = 'six-col';
				} else {
					$colWidth = 'four-col';
				}

			?>
				<div class="animate-in <?php print $colWidth; ?> col">
					<article class="work-item col" style="background-image: url(<?php if ($thumbnailimagefield) { print $thumbnailimage; } else { print $leaderboardimage; } ?>);">
							<img src="<?php if ($thumbnailimagefield) { print $thumbnailimage; } else { print $leaderboardimage; } ?>" alt="<?php print $projects->title; ?>">
							<header class="inner">
								<a href="<?php print $nodeurl; ?>">
									<div class="text-container">
										<h4><?php print $projects->title; ?></h4>
										<h5><?php print render($tagline);?></h5>
									</div>
								</a>
							</header>
					</article>
				</div>
			<?php $count++; endforeach; ?>
			<?php 
			$nodes = node_load_multiple(array(), array('type' => 'work', 'status' => 1)); 
			foreach($nodes as $work):
				$nodeID = $work->nid;
				$nodework = node_load($nodeID);
				$thumbnailimage = file_create_url($work->field_scuttlebutt_image['und'][0]['uri']);
				$nodeurl = url('node/'. $work->nid);

			?>
				<div class="animate-in four-col col">
					<article class="work-item col">
						<div class="inner">
							<a href="<?php print $nodeurl; ?>">
							<h4><?php print $work->title; ?></h4>
							<img src="<?php print $thumbnailimage; ?>">
							</a>
						</div>
					</article>
				</div>
			<?php endforeach; ?>
		</section>
 	</div>
 	<section class="branding-clients animate-in">
 		<div class="container">
		<?php
            $blockClients = block_load('block',15);
            $outputClients = drupal_render(_block_get_renderable_array(_block_render_blocks(array($blockClients))));
            print $outputClients;
        ?>
    	</div>
		<div class="styled-select four-col col centered">
			<select id="sort-brands">
				<option value="All">Sort By - All Clients -</option>
				<?php 
					function taxonomy_options_array($machine_name) {
						$v = taxonomy_vocabulary_machine_name_load($machine_name);
						$terms = taxonomy_get_tree($v->vid);
						foreach ($terms as $term) {
							$options[$term->tid] = $term->name;
						}
						return $options;
					}
					$vocabularyTerms = taxonomy_options_array('project_category');

					foreach($vocabularyTerms as $key => $val) { 
				?>
				<option><?php print $val; ?></option>
				<?php } ?>
				
			</select>
		</div>
		<section class="logos">
		<?php 
    		$queryBrand = new EntityFieldQuery();
			$queryBrand->entityCondition('entity_type', 'node')
			  		   ->entityCondition('bundle', 'brands_clients')
			  		   ->propertyCondition('status', 1)
			  		   ->propertyOrderBy('title', 'ASC');
			$resultBrand = $queryBrand->execute();
			$nodesBrand = node_load_multiple(array_keys($resultBrand['node']));

			foreach($nodesBrand as $brand) {
				$nodeID2 = $brand->nid;
				$nodebrand = node_load($nodeID2);
				$brandlogo = file_create_url($brand->field_image['und'][0]['uri']);
				$urlfield = field_get_items('node', $nodebrand, 'field_url');
				$url2 = field_view_value('node', $nodebrand, 'field_url', $urlfield[0]);
				$brandcategoryfield = field_view_field('node', $nodebrand, 'field_brand_category');
				$brandCategoryTerm = $nodebrand->field_brand_category[LANGUAGE_NONE][0]['taxonomy_term']->name;
	    ?>
	    	<div class="brand-logo" data-category="<?php print $brandCategoryTerm; ?>">
	    		<?php if ($urlfield) { ?>
	    			<a href="<?php print render($url2); ?>" target="_blank"><img src="<?php print $brandlogo; ?>" alt="<?php print $brand->title;?>" /></a>
	    		<?php } else { ?> 
	    			<img src="<?php print $brandlogo; ?>" alt="<?php print $brand->title;?>" />
	    		<?php } ?>
	    	</div>
	    <?php } ?>					
		</section>
 	</section>
</article>
<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/recess/includes/footer.php'); ?>