<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/includes/header.php'); ?>
<?php 
	$fieldimage = field_view_field('node', $node, 'field_image');
	$image = file_create_url($node->field_image['und'][0]['uri']);
	$bodyfield = field_get_items('node', $node, 'body');
  	$body = field_view_value('node', $node, 'body', $bodyfield[0]);
?>
<article role="main" id="home">
	
	<section class="banner latest animate-in">
		
		<nav role="navigation" class="latest-controls">
			<a class="latest-pagination prev" href="javascript:void(0)"><span aria-label="Previous Slide" class="icon"><</span></a>
			<a class="latest-pagination next" href="javascript:void(0)"><span aria-label="Next Slide" class="icon">></span></a>
		</nav>
		
		<nav role="navigation" class="slide-counter">
		</nav>
		
		<!-- Slide -->
		<div class="slide-container">
			
			<?php 
				//$nodes = node_load_multiple(array(), array('type' => 'home_carousel', 'status' => 1)); 
				$query = new EntityFieldQuery();
				$query->entityCondition('entity_type', 'node')
				  ->entityCondition('bundle', 'home_carousel')
				  ->propertyCondition('status', 1)
				  ->addTag('sort_by_weight');
				$result = $query->execute();
				$nodes = node_load_multiple(array_keys($result['node'])); 
				foreach($nodes as $slides):
					$nodeID = $slides->nid;
					$nodeslides = node_load($nodeID);
					$bgimage = file_create_url($slides->field_image['und'][0]['uri']);
					$slidesmalltextfield = field_get_items('node', $nodeslides, 'field_small_text');
  			 		$slidesmalltext = field_view_value('node', $nodeslides, 'field_small_text', $slidesmalltextfield[0]);
  			 		$hexcolorfield = field_get_items('node', $nodeslides, 'field_hex_color_value');
  			 		$hexcolor = field_view_value('node', $nodeslides, 'field_hex_color_value', $hexcolorfield[0]);
  			 		$clickurlfield = field_get_items('node', $nodeslides, 'field_url_path');
  			 		$clickurl = field_view_value('node', $nodeslides, 'field_url_path', $clickurlfield[0]);

  					if ($hexcolorfield) { 
  						$borderColor = 'border-bottom-color: '.render($hexcolor).';';
  					}
			?>	

			<section onclick="window.location='<?php print render($clickurl); ?>'" class="latest-slide" style="background-image: url(<?php print $bgimage; ?>); <?php print $borderColor; ?>">
				<section class="slide-info">
					<header>
						<h3><?php print render($slidesmalltext);?></h3>
						<h1><?php print $slides->title; ?></h1>
					</header>
				</section>
			</section>
		<?php  endforeach; ?>
		</div>
	</section>

	<section class="recess-is animate-in">
		<div class="container">
			<div class="col twelve-col centered">
				<?php 
					$randomword = array();
					function taxonomy_options_array($machine_name) {
						$v = taxonomy_vocabulary_machine_name_load($machine_name);
						$terms = taxonomy_get_tree($v->vid);
						foreach ($terms as $term) {
							$options[$term->tid] = $term->name;
						}
						return $options;
					}
					$vocabularyTerms = taxonomy_options_array('recess_is');
					foreach($vocabularyTerms as $key => $val) {
						array_push($randomword, $val);
					}
				?>
				<header>
					<h1>It’s a lot of work to have this much fun.</h1>
					<?php /*<h2>Recess is <?php echo $randomword[array_rand($randomword)]; ?></h2> */ ?>
				</header>
				<?php if ($bodyfield) { print render($body); } else { print render($page['content']); } ?>
				<button class="button recess" >
					<a href="/agency" title="Explore the Agency" data-transition="slide">Let's Disco</a>
				</button>
			</div>
		</div>
	</section>

</article>
<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/recess/includes/footer.php'); ?>