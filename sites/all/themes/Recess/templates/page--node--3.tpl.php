<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/includes/header.php'); ?>
<?php 
	$fieldimage = field_view_field('node', $node, 'field_image');
	$image = file_create_url($node->field_image['und'][0]['uri']);
	$bodyfield = field_get_items('node', $node, 'body');
  	$body = field_view_value('node', $node, 'body', $bodyfield[0]);
?>
<article role="main">
	<?php if ($fieldimage) { ?>
		<section class="leaderboard">
			<img src="<?php print $image; ?>" alt="<?php print $node->title; ?>" />
			<header>
				<?php if ($title): ?>
				<h1><?php print $title; ?></h1>
				<?php endif; ?>
			</header>
		</section>
	<?php } ?>
	<div class="container">
		<section role="main" class="nine-col centered">
			<?php if (!$fieldimage) { ?>
			<header>
				<?php if ($title): ?>
				<h1><?php print $title; ?></h1>
				<?php endif; ?>
			</header>
			<?php } ?>
			<?php print render($body); ?>
		</section>
 	</div>
 	<section class="services flip-cards">
 		<div class="container">
 				<?php 
 					$query = new EntityFieldQuery();
					$query->entityCondition('entity_type', 'node')
					  ->entityCondition('bundle', 'services')
					  ->propertyCondition('status', 1);
					$result = $query->execute();
					$nodes = node_load_multiple(array_keys($result['node']));

					foreach($nodes as $services) { 
						$nodeID = $services->nid;
						$nodeservices = node_load($nodeID);
						$servicesbodyfield = field_get_items('node', $nodeservices, 'body');
  						$servicesbody = field_view_value('node', $nodeservices, 'body', $servicesbodyfield[0]);
						$servicebigimage = file_create_url($services->field_image['und'][0]['uri']);
						$serviceinnerimage = file_create_url($services->field_inner_image['und'][0]['uri']);
						$iconfield = field_get_items('node', $nodeservices, 'field_icon_character');
  						$icon = field_view_value('node', $nodeservices, 'field_icon_character', $iconfield[0]);
				?>
					<article class="service flip">
						<div class="card">
						<div class="face front">
							<div class="outer">
								<h3><?php print $services->title; ?></h3>
								<img src="<?php print $servicebigimage; ?>" alt="<?php print $services->title; ?>">
								<button class="mini-button recess">
									<a href="javascript:void(0)" class="icon">+</a>
								</button>
							</div>
						</div>
						<div class="face back">
							<div class="inner">
								<div class="left">
									<h3><?php print $services->title; ?></h3>
									<?php print render($servicesbody); ?>
								</div>
								<div class="right">
									<span class="icon overlay"><?php print render($icon); ?></span>
									<img src="<?php print $serviceinnerimage; ?>" alt="<?php print $services->title; ?>">
								</div>
								<button class="mini-button recess">
									<a href="javascript:void(0)" class="icon">X</a>
								</button>
							</div>
						</div>
					</div>
					</article>
				<?php
					}
 				?>
 		</div>
 	</section>
 	<section class="branding-clients">
 		<div class="container">
 			<h2 class="twelve-col col">Branding & Clients</h2>
 			<section class="logos">
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
						//$valClass = strtolower(str_replace(' ', '-', $val));

				?>
					<section class="one-third brand-category">
						<h3><?php print $val; ?> </h3>
						<?php 
				    		$query2 = new EntityFieldQuery();
							$query2->entityCondition('entity_type', 'node')
							  ->entityCondition('bundle', 'brands_clients')
							  ->fieldCondition('field_brand_category', 'tid', $key)
							  ->propertyCondition('status', 1);
							$result2 = $query2->execute();
							$nodes2 = node_load_multiple(array_keys($result2['node']));

							foreach($nodes2 as $brand) {
								$nodeID2 = $brand->nid;
								$nodebrand = node_load($nodeID2);
								$brandlogo = file_create_url($brand->field_image['und'][0]['uri']);
								$urlfield = field_get_items('node', $nodebrand, 'field_url');
  								$url2 = field_view_value('node', $nodebrand, 'field_url', $urlfield[0]);
					    ?>
					    	<div class="one-half">
					    		<?php if ($urlfield) { ?>
					    			<a href="<?php print render($url2); ?>" target="_blank"><img src="<?php print $brandlogo; ?>" alt="<?php print $brand->title;?>" /></a>
					    		<?php } else { ?> 
					    			<img src="<?php print $brandlogo; ?>" alt="<?php print $brand->title;?>" />
					    		<?php } ?>
					    	</div>
					    <?php } ?>					
					</section>
				<?php } ?>
 			</section>
 		</div>
 	</section>
</article>
<script type="text/javascript">

	//$('.service').bookblock({orientation: 'vertical', direction: 'rtl'});
</script>
<script>
	/*		var Page = (function() {
				
				var config = {
						$bookBlock : $( '.service' ),
						$navNext : $( '#bb-nav-next' ),
						$navPrev : $( '#bb-nav-prev' )
					},
					init = function() {
						config.$bookBlock.bookblock( {
							speed : 2500,
							direction: 'rtl',
							shadowSides : 0.8,
							shadowFlip : 0.7,
							circular: true,
							onBeforeFlip: function( page ) { 
								if ( page == 0 ) {
									$('.bb-item').removeClass('active');
									$('.bb-item').eq(1).addClass('active');
								} else {
									$('.bb-item').removeClass('active');
									$('.bb-item').eq(0).addClass('active');
								}
								return false; 
							}
						} );
						initEvents();
					},
					initEvents = function() {
						
						var $slides = config.$bookBlock.children();

						// add navigation events
						config.$navNext.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'next' );
							return false;
						} );

						config.$navPrev.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'prev' );
							return false;
						} );
						// add keyboard events
						$( document ).keydown( function(e) {
							var keyCode = e.keyCode || e.which,
								arrow = {
									left : 37,
									up : 38,
									right : 39,
									down : 40
								};

							switch (keyCode) {
								case arrow.left:
									config.$bookBlock.bookblock( 'next' );
									break;
								case arrow.right:
									config.$bookBlock.bookblock( 'prev' );
									break;
							}
						} );
					};

					return { init : init };

			})();*/
		</script>
		<script>
				//Page.init();
		</script>
<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/recess/includes/footer.php'); ?>