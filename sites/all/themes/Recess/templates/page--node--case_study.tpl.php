<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/includes/header.php'); ?>
<?php 
	$fieldimage = field_view_field('node', $node, 'field_image');
	$image = file_create_url($node->field_image['und'][0]['uri']);
	$bodyfield = field_get_items('node', $node, 'body');
  	$body = field_view_value('node', $node, 'body', $bodyfield[0]);
  	$subtitlefield = field_get_items('node', $node, 'field_tagline');
  	$subtitle = field_view_value('node', $node, 'field_tagline', $subtitlefield[0]);
  	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  	$tagsfield = field_view_field('node', $node, 'field_tags');
  	$cssclassfield = field_get_items('node', $node, 'field_css_class');
  	$cssclass = field_view_value('node', $node, 'field_css_class', $cssclassfield[0]); 
  	$hexcolorfield = field_get_items('node', $node, 'field_hex_color_value');
  	$hexcolor = field_view_value('node', $node, 'field_hex_color_value', $hexcolorfield[0]); 
  	$websiteurlfield = field_get_items('node', $node, 'field_website_url');
  	$websiteurl = field_view_value('node', $node, 'field_website_url', $websiteurlfield[0]); 
  	$vimeourlfield = field_get_items('node', $node, 'field_leaderboard_vimeo_url');
  	$vimeourl = field_view_value('node', $node, 'field_leaderboard_vimeo_url', $vimeourlfield[0]); 
  	$pnglogofield = field_view_field('node', $node, 'field_png_logo');
	$pnglogo = file_create_url($node->field_png_logo['und'][0]['uri']);
	$thechallengefield = field_get_items('node', $node, 'field_the_challenge');
  	$thechallenge = field_view_value('node', $node, 'field_the_challenge', $thechallengefield[0]);
  	$theideafield = field_get_items('node', $node, 'field_the_idea');
  	$theidea = field_view_value('node', $node, 'field_the_idea', $theideafield[0]);
  	$theideaimgfield = field_view_field('node', $node, 'field_the_idea_image');
	$theideaimg = file_create_url($node->field_the_idea_image['und'][0]['uri']);
	$thesolutionherofield = field_view_field('node', $node, 'field_the_solution_hero_image');
	$thesolutionhero = file_create_url($node->field_the_solution_hero_image['und'][0]['uri']);
	$thesolutioncol1field = field_get_items('node', $node, 'field_the_solution_column_1');
  	$thesolutioncol1 = field_view_value('node', $node, 'field_the_solution_column_1', $thesolutioncol1field[0]);
  	$thesolutioncol2field = field_get_items('node', $node, 'field_the_solution_column_2');
  	$thesolutioncol2 = field_view_value('node', $node, 'field_the_solution_column_2', $thesolutioncol2field[0]);
  	$thesolutionmorecontentfield = field_get_items('node', $node, 'field_the_solution_more_content');
  	$thesolutionmorecontent = field_view_value('node', $node, 'field_the_solution_more_content', $thesolutionmorecontentfield[0]);
  	$imgbreak1field = field_view_field('node', $node, 'field_the_solution_image_break_1');
	$imgbreak1 = file_create_url($node->field_the_solution_image_break_1['und'][0]['uri']);
	$imgbreak2field = field_view_field('node', $node, 'field_the_solution_image_break_2');
	$imgbreak2 = file_create_url($node->field_the_solution_image_break_2['und'][0]['uri']);
	$imgbreak3field = field_view_field('node', $node, 'field_the_solution_image_break_3');
	$imgbreak3 = file_create_url($node->field_the_solution_image_break_3['und'][0]['uri']);
	$carousel1field = field_view_field('node', $node, 'field_carousel_image_1');
	$carousel1 = file_create_url($node->field_carousel_image_1['und'][0]['uri']);
	$carousel2field = field_view_field('node', $node, 'field_carousel_image_2');
	$carousel2 = file_create_url($node->field_carousel_image_2['und'][0]['uri']);
	$carousel3field = field_view_field('node', $node, 'field_carousel_image_3');
	$carousel3 = file_create_url($node->field_carousel_image_3['und'][0]['uri']);
	$carousel4field = field_view_field('node', $node, 'field_carousel_image_4');
	$carousel4 = file_create_url($node->field_carousel_image_4['und'][0]['uri']);
	$carousel5field = field_view_field('node', $node, 'field_carousel_image_5');
	$carousel5 = file_create_url($node->field_carousel_image_5['und'][0]['uri']);
	$quote1field = field_get_items('node', $node, 'field_quote_1');
  	$quote1 = field_view_value('node', $node, 'field_quote_1', $quote1field[0]);
  	$quote2field = field_get_items('node', $node, 'field_quote_2');
  	$quote2 = field_view_value('node', $node, 'field_quote_2', $quote2field[0]);
  	$quote3field = field_get_items('node', $node, 'field_quote_3');
  	$quote3 = field_view_value('node', $node, 'field_quote_3', $quote3field[0]);
  	$quote4field = field_get_items('node', $node, 'field_quote_4');
  	$quote4 = field_view_value('node', $node, 'field_quote_4', $quote4field[0]);
  	$theresultssubheadfield = field_get_items('node', $node, 'field_the_result_subhead');
  	$theresultssubhead = field_view_value('node', $node, 'field_the_result_subhead', $theresultssubheadfield[0]);
  	$theresultsgoalsfield = field_get_items('node', $node, 'field_the_results_client_goals');
  	$theresultsgoals = field_view_value('node', $node, 'field_the_results_client_goals', $theresultsgoalsfield[0]);
  	$metric1headlinefield = field_get_items('node', $node, 'field_metric_tile_1_headline');
  	$metric1headline = field_view_value('node', $node, 'field_metric_tile_1_headline', $metric1headlinefield[0]);
  	$metric1subheadfield = field_get_items('node', $node, 'field_metric_tile_1_subhead');
  	$metric1subhead = field_view_value('node', $node, 'field_metric_tile_1_subhead', $metric1subheadfield[0]);
  	$metric1metricfield = field_get_items('node', $node, 'field_metric_tile_1_metric');
  	$metric1metric = field_view_value('node', $node, 'field_metric_tile_1_metric', $metric1metricfield[0]);
  	$metric2headlinefield = field_get_items('node', $node, 'field_metric_tile_2_headline');
  	$metric2headline = field_view_value('node', $node, 'field_metric_tile_2_headline', $metric2headlinefield[0]);
  	$metric2subheadfield = field_get_items('node', $node, 'field_metric_tile_2_subhead');
  	$metric2subhead = field_view_value('node', $node, 'field_metric_tile_2_subhead', $metric2subheadfield[0]);
  	$metric2metricfield = field_get_items('node', $node, 'field_metric_tile_2_metric');
  	$metric2metric = field_view_value('node', $node, 'field_metric_tile_2_metric', $metric2metricfield[0]);
  	$metric3headlinefield = field_get_items('node', $node, 'field_metric_tile_3_headline');
  	$metric3headline = field_view_value('node', $node, 'field_metric_tile_3_headline', $metric3headlinefield[0]);
  	$metric3subheadfield = field_get_items('node', $node, 'field_metric_tile_3_subhead');
  	$metric3subhead = field_view_value('node', $node, 'field_metric_tile_3_subhead', $metric3subheadfield[0]);
  	$metric3metricfield = field_get_items('node', $node, 'field_metric_tile_3_metric');
  	$metric3metric = field_view_value('node', $node, 'field_metric_tile_3_metric', $metric3metricfield[0]);
  	$metric4headlinefield = field_get_items('node', $node, 'field_metric_tile_4_headline');
  	$metric4headline = field_view_value('node', $node, 'field_metric_tile_4_headline', $metric4headlinefield[0]);
  	$metric4subheadfield = field_get_items('node', $node, 'field_metric_tile_4_subhead');
  	$metric4subhead = field_view_value('node', $node, 'field_metric_tile_4_subhead', $metric4subheadfield[0]);
  	$metric4metricfield = field_get_items('node', $node, 'field_metric_tile_4_metric');
  	$metric4metric = field_view_value('node', $node, 'field_metric_tile_4_metric', $metric4metricfield[0]);
  	$metric5headlinefield = field_get_items('node', $node, 'field_metric_tile_5_headline');
  	$metric5headline = field_view_value('node', $node, 'field_metric_tile_5_headline', $metric5headlinefield[0]);
  	$metric5subheadfield = field_get_items('node', $node, 'field_metric_tile_5_subhead');
  	$metric5subhead = field_view_value('node', $node, 'field_metric_tile_5_subhead', $metric5subheadfield[0]);
  	$metric5metricfield = field_get_items('node', $node, 'field_metric_tile_5_metric');
  	$metric5metric = field_view_value('node', $node, 'field_metric_tile_5_metric', $metric5metricfield[0]);
	
?>
<?php if ($hexcolorfield) { ?>
	<style type="text/css">
		.case-study .leaderboard { border-bottom-color: <?php print render($hexcolor); ?>; }
		.case-study .the-challenge { background-color: <?php print render($hexcolor); ?>; }
		.case-study h3 { color: <?php print render($hexcolor); ?>;}
		.case-study .the-solution .words-of-wisdom blockquote {background: <?php print render($hexcolor); ?>;}
		.case-study .the-results .check-list ul li:before { color: <?php print render($hexcolor); ?>; }
		.case-study .the-results .metrics .metric:hover {background-color: <?php print render($hexcolor); ?>;}
		.case-study .the-results .awards .award-item:hover {background-color: <?php print render($hexcolor); ?>;}
		.case-study .share-section h4 { color: <?php print render($hexcolor); ?>; }
		.case-study .share-section .mini-button.recess { border-color: <?php print render($hexcolor); ?>; color: <?php print render($hexcolor); ?>; }
		.case-study .share-section .mini-button.recess:hover { background: <?php print render($hexcolor); ?>; border-color: <?php print render($hexcolor); ?>; }
		.case-study .share-section .mini-button.recess a { border-color: <?php print render($hexcolor); ?>; color: <?php print render($hexcolor); ?>; }
		.case-study .share-section .mini-button.recess a:hover { color: #fff; }
		.case-study .share-section .button.recess { border-color: <?php print render($hexcolor); ?>; color: <?php print render($hexcolor); ?>; }
		.case-study .share-section .button.recess:hover { background: <?php print render($hexcolor); ?>; border-color: <?php print render($hexcolor); ?>; }
		.case-study .share-section .button.recess a { border-color: <?php print render($hexcolor); ?>; color: <?php print render($hexcolor); ?>; }
		.case-study .share-section .button.recess a:hover { color: #fff; }
	</style>
<?php } ?>

<article role="main" class="case-study <?php print render($cssclass);?>">
	<?php if ($fieldimage) { ?>
		<section class="leaderboard animate-in">
			<img src="<?php print $image; ?>" alt="<?php print $node->title; ?>" />
			<?php if ($vimeourlfield) { ?>
			<a class="vimeo-play fancybox-media" href="<?php print render($vimeourl); ?>">&nbsp;</a>
			<?php } ?>
			<?php if ($brandcategoryfield || $tagsfield) { ?>
			<section class="tags">
				<?php foreach($node->field_brand_category[LANGUAGE_NONE] as $terms) { ?>
					<a class="tag category-item" href="javascript:void(0)">
						<span class="icon" aria-label="<?php print $terms['taxonomy_term']->name; ?>"><?php print $terms['taxonomy_term']->field_icon_character['und'][0]['value'];  ?></span>
						<div class="tooltip">
							<span class="carrot"></span>
							<span class="title"><?php print $terms['taxonomy_term']->name; ?></span>
						</div>
					</a>
				<?php } ?>
				<?php foreach($node->field_tags[LANGUAGE_NONE] as $tags) { ?>
					<a class="tag category-item" href="javascript:void(0)">
						<span class="icon" aria-label="<?php print $tags['taxonomy_term']->name;  ?>"><?php print $tags['taxonomy_term']->field_icon_character['und'][0]['value'];  ?></span>
						<div class="tooltip">
							<span class="carrot"></span>
							<span class="title"><?php print $tags['taxonomy_term']->name; ?></span>
						</div>
					</a>
				<?php } ?>
			</section>
			<?php } ?>
			<header>
				<?php if ($title): ?>
				<h1 class="hidden"><?php print $title; ?></h1>
				<?php endif; ?>
				<?php if ($subtitlefield): ?>
				<h2><?php print render($subtitle); ?></h2>
				<?php endif;?>
				<?php if ($websiteurlfield): ?>
				<a href="http://<?php print render($websiteurl); ?>" target="_blank"><?php print str_replace("www.", "", render($websiteurl)); ?></a>
				<?php endif; ?>
			</header>
		</section>
	<?php } ?>
	<section class="the-client">
		<div class="container">
			<?php if ($pnglogofield) { ?>
			<figure class="col four-col project-branding animate-in">
				<img src="<?php print $pnglogo; ?>" alt="<?php print $node->title; ?>">
			</figure>
			<?php } ?>
			<section class="col eight-col project-intro animate-in">
				<h2><?php print $node->title; ?></h2>
				<?php print render($body); ?>
			</section>
		</div>
	</section>
	<?php if ($thechallengefield) { ?>
	<section class="the-challenge animate-in">
		<div class="container">
			<div class="col twelve-col">
				<header>
					<h3>The Challenge</h3>
				</header>
				<?php print render($thechallenge); ?>
			</div>
		</div>
	</section>
	<?php } ?>
	<?php if ($theideafield) { ?>
	<section class="the-idea">
		<div class="container">
			<?php if ($theideaimgfield && ($node->field_float_the_idea_image_right['und'][0]['value'] == 0)) { ?>
			<figure class="col six-col animate-in">
				<img src="<?php print $theideaimg; ?>" alt="The Idea">
			</figure>
			<?php } ?>
			<section class="col six-col animate-in">
				<header>
					<h3>The Idea</h3>
				</header>
				<?php print render($theidea); ?>
			</section>
			<?php if ($theideaimgfield && ($node->field_float_the_idea_image_right['und'][0]['value'] == 1)) { ?>
			<figure class="col six-col animate-in">
				<img src="<?php print $theideaimg; ?>" alt="The Idea">
			</figure>
			<?php } ?>
		</div>
	</section>
	<?php } ?>
	<section class="the-solution">
		<section class="container solution-main">
			<?php if ($thesolutioncol1field || $thesolutioncol2field || $thesolutionherofield ) { ?>
			<header class="animate-in">
				<h3>The Solution</h3>
			</header>
			<?php } ?>
			<section class="animate-in">
			<?php if ($thesolutionherofield) { ?>
			<figure>
				<img src="<?php print $thesolutionhero; ?>" alt="The Solution" class="hero-image">
				<figcaption class="">
					<hr class="double-rule">
				</figcaption>
			</figure>
			<?php } ?>
			<?php if ($thesolutioncol1field) { ?>
			<section class="solution-main-copy">
				<div class="col <?php if ($thesolutioncol2field) { print 'six-col'; } else { print 'twelve-col centered-text'; } ?>">
					<?php print render($thesolutioncol1); ?>
				</div>
				<?php if ($thesolutioncol2field) { ?>
				<div class="col six-col">
					<?php print render($thesolutioncol2); ?>
				</div>
				<?php } ?>
			</section>
			<?php } ?>
			</section>
		</section>
		<?php if ($thesolutionmorecontentfield) { ?>
			<section class="more-content animate-in">
				<?php print render($thesolutionmorecontent); ?>
			</section>
		<?php } ?>
		<?php if ($carousel1field) { ?>
			<section class="carousel-wrapper animate-in">
				<nav role="navigation" class="latest-controls">
					<a class="latest-pagination prev" href="javascript:void(0)"><span aria-label="Previous Slide" class="icon"><</span></a>
					<a class="latest-pagination next" href="javascript:void(0)"><span aria-label="Next Slide" class="icon">></span></a>
				</nav>
				<section class="carousel-container">
					<img src="<?php print $carousel1; ?>">
					<?php if ($carousel2field) { ?>
					<img src="<?php print $carousel2; ?>">
					<?php } ?>
					<?php if ($carousel3field) { ?>
					<img src="<?php print $carousel3; ?>">
					<?php } ?>
					<?php if ($carousel4field) { ?>
					<img src="<?php print $carousel4; ?>">
					<?php } ?>
					<?php if ($carousel5field) { ?>
					<img src="<?php print $carousel5; ?>">
					<?php } ?>
				</section>
			</section>
		<?php } ?>
		<?php if ($node->field_the_solution_image_break['und'][0]['value'] == 1) { ?>
		<section class="case-study-image-break animate-in">
			<div class="container overflow-visible">
				<img class="image-one nine-col col centered" src="<?php print $imgbreak1; ?>">
				<img class="image-two nine-col col" src="<?php print $imgbreak2; ?>" <?php //get the alt tag ?>>
				<img class="image-three nine-col col" src="<?php print $imgbreak3; ?>" <?php //get the alt tag ?>>
			</div>
		</section>
		<?php } ?>
		<?php if ($quote1field) { ?>
		<section class="words-of-wisdom animate-in">
			<blockquote>
				<?php print render($quote1); ?>
			</blockquote>
			<?php if ($quote2field) { ?>
			<blockquote>
				<?php print render($quote2); ?>
			</blockquote>
			<?php } ?>
			<?php if ($quote3field) { ?>
			<blockquote>
				<?php print render($quote3); ?>
			</blockquote>
			<?php } ?>
			<?php if ($quote4field) { ?>
			<blockquote>
				<?php print render($quote4); ?>
			</blockquote>
			<?php } ?>
		</section>
		<?php } ?>
	</section>
	<?php if ($theresultssubheadfield) { ?>
	<section class="the-results">
		<header class="container animate-in">
			<h3>The Results</h3>
			<h4><?php print render($theresultssubhead); ?></h4>
		</header>
		<?php if ($theresultsgoalsfield) { ?>
		<section class="check-list animate-in">
			<?php print render($theresultsgoals); ?>
		</section>
		<?php } ?>
		<?php if ($metric1headlinefield || $metric1subheadfield || $metric1metricfield) { ?>
		<section class="metrics animate-in">
			<figure class="metric card">
				<figcaption>
					<?php if ($metric1headlinefield) { ?>
					<span class="line-one"><?php print render($metric1headline); ?></span>
					<?php } ?>
					<?php if ($metric1subheadfield) { ?>
					<span class="line-two"><?php print render($metric1subhead); ?></span>
					<?php } ?>
					<?php if ($metric1metricfield) { ?>
					<span class="line-three"><?php print render($metric1metric); ?></span>
					<?php } ?>
				</figcaption>
			</figure>
			<?php if ($metric2headlinefield || $metric2subheadfield || $metric2metricfield) { ?>
			<figure class="metric card">
				<figcaption>
					<?php if ($metric2headlinefield) { ?>
					<span class="line-one"><?php print render($metric2headline); ?></span>
					<?php } ?>
					<?php if ($metric2subheadfield) { ?>
					<span class="line-two"><?php print render($metric2subhead); ?></span>
					<?php } ?>
					<?php if ($metric2metricfield) { ?>
					<span class="line-three"><?php print render($metric2metric); ?></span>
					<?php } ?>
				</figcaption>
			</figure>
			<?php } ?>
			<?php if ($metric3headlinefield || $metric3subheadfield || $metric3metricfield) { ?>
			<figure class="metric card">
				<figcaption>
					<?php if ($metric3headlinefield) { ?>
					<span class="line-one"><?php print render($metric3headline); ?></span>
					<?php } ?>
					<?php if ($metric3subheadfield) { ?>
					<span class="line-two"><?php print render($metric3subhead); ?></span>
					<?php } ?>
					<?php if ($metric3metricfield) { ?>
					<span class="line-three"><?php print render($metric3metric); ?></span>
					<?php } ?>
				</figcaption>
			</figure>
			<?php } ?>
			<?php if ($metric4headlinefield || $metric4subheadfield || $metric4metricfield) { ?>
			<figure class="metric card">
				<figcaption>
					<?php if ($metric4headlinefield) { ?>
					<span class="line-one"><?php print render($metric4headline); ?></span>
					<?php } ?>
					<?php if ($metric4subheadfield) { ?>
					<span class="line-two"><?php print render($metric4subhead); ?></span>
					<?php } ?>
					<?php if ($metric4metricfield) { ?>
					<span class="line-three"><?php print render($metric4metric); ?></span>
					<?php } ?>
				</figcaption>
			</figure>
			<?php } ?>
			<?php if ($metric5headlinefield || $metric5subheadfield || $metric5metricfield) { ?>
			<figure class="metric card">
				<figcaption>
					<?php if ($metric5headlinefield) { ?>
					<span class="line-one"><?php print render($metric5headline); ?></span>
					<?php } ?>
					<?php if ($metric5subheadfield) { ?>
					<span class="line-two"><?php print render($metric5subhead); ?></span>
					<?php } ?>
					<?php if ($metric5metricfield) { ?>
					<span class="line-three"><?php print render($metric5metric); ?></span>
					<?php } ?>
				</figcaption>
			</figure>
			<?php } ?>
		</section>
		<?php } ?>
		<?php if ($node->field_display_awards['und'][0]['value'] == 1) {?>
		<section class="awards">
			<?php foreach($node->field_award_type[LANGUAGE_NONE] as $awards) { ?>
			<?php 
				$termLoad = taxonomy_term_load($awards['taxonomy_term']->tid);
				$term_page =  taxonomy_term_view($termLoad, $view_mode = 'full');
				$term_url = taxonomy_term_uri($termLoad);
				$white_image = $term_page['#term']->field_white_image['und'][0]['uri']; 
			?>
			<div class="award-item">
				<div class="icon">
					<img src="<?php print file_create_url($white_image); ?>" alt="<?php print $awards['taxonomy_term']->name;  ?>">
				</div>
				<div class="award-name">
					<?php print $awards['taxonomy_term']->name;  ?>
				</div>
			</div>
			<?php } ?>
		</section>
		<?php } ?>
	</section>
	<?php } ?>
	<footer class="container animate-in case-study-bottom">
		<section class="pagination">
			<nav class="pagination">
				<?php 
					$allNodeList = array();
					$queryCS = new EntityFieldQuery();
					$queryCS->entityCondition('entity_type', 'node')
						  	->entityCondition('bundle', 'case_study')
						  	->propertyCondition('status', 1)
						  	->addTag('sort_by_weight');
					$resultCS = $queryCS->execute();
					$CaseStudyNodes = node_load_multiple(array_keys($resultCS['node']));  
					foreach($CaseStudyNodes as $projects)  
					{
						array_push($allNodeList, $projects->nid);
					}

					$currentLocation = array_search($node->nid, $allNodeList);

					$prevNodeId = $allNodeList[$currentLocation - 1];
					$nextNodeId = $allNodeList[$currentLocation + 1];

					if ($prevNodeId != null) { 
						echo '<a class="pagination-button previous" href="'.url("node/$prevNodeId").'">Previous <span class="desktop-only">Project</span></a>';
					}

					if ($nextNodeId != null) {
						echo '<a class="pagination-button next" href="'.url("node/$nextNodeId").'">Next <span class="desktop-only">Project</span></a>';
					}
				?>
			</nav>
		</section>
		<section role="main" class="nine-col centered">
			<?php //if ($bodyfield) { print render($body); } else { print render($page['content']); } ?>
			<section class="share-section">
				<h4>If you like it so much, why don't you marry it?</h4>
				<div class="share">
					<button class="mini-button recess icon-social">
						<a href="http://twitter.com/home?status=Check out this super fun work from Recess Creative: <?php print $actual_link; ?> @RecessCreative." target="_blank">T</a>
					</button>
					<button class="mini-button recess icon-social">
						<a href="javascript:void(0)" id="facebook-share">F</a>
					</button>
					<button class="mini-button recess icon-social">
						<a href="#" id="linked-in-share" target="_blank">L</a>
					</button>
				</div>
				<button class="button recess">
					<a href="http://<?php print render($websiteurl); ?>" target="_blank">Check Out <?php print $node->title; ?></a>
				</button>
			</section>
		</section>
 	</footer>
</article>
<script type="text/javascript">
	var captionText = $('h1').text();
	var descriptionText = $('.leaderboard header h2').text();
	$('#facebook-share').click(function(){
		FB.ui({
			method: 'feed',
			name: captionText,
			link: document.URL,
			caption: 'Recess Creative',
			/*picture: quizImage,*/
			description: descriptionText
		}, function(response){});
	});
	var linkedInShareURL = 'http://www.linkedin.com/shareArticle?mini=true&url=' + document.URL + '&title=' + captionText + '&summary=' + descriptionText + '&source=RecessCreative';
	$('#linked-in-share').attr('href', linkedInShareURL);

</script>
<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/recess/includes/footer.php'); ?>