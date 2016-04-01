<?php require_once DRUPAL_ROOT . '/' . variable_get('header', 'sites/all/themes/recess/includes/header.php'); ?>
<?php 
	$fieldimage = field_view_field('node', $node, 'field_image');
	$image = file_create_url($node->field_image['und'][0]['uri']);
	$bodyfield = field_get_items('node', $node, 'body');
  	$body = field_view_value('node', $node, 'body', $bodyfield[0]);
?>
<article role="main" class="contact">
	<?php if ($fieldimage) { ?>
		<section class="leaderboard">
			<img src="<?php print $image; ?>" alt="<?php print $node->title; ?>" />
		</section>
	<?php } ?>
	<div class="container">
		<section role="main" class="eight-col centered main-contact-text">
			<header class="animate-in">
				<?php if ($title): ?>
				<h1><?php print $title; ?></h1>
				<?php endif; ?>
			</header>
			<div class="animate-in">
				<?php if ($bodyfield) { print render($body); } else { print render($page['content']); } ?>
			</div>
		</section>
 	</div>
 	<section class="contact-form-section animate-in">
 		<div class="container">
 			<div class="eight-col centered">
 				<?php 
					$block = block_load('webform', 'client-block-21');      
					$output = drupal_render(_block_get_renderable_array(_block_render_blocks(array($block))));        
					print $output;
				?>
				<section class="success">
					<?php 
						$blockConfirm = block_load('block', 12);      
						$outputConfirm = drupal_render(_block_get_renderable_array(_block_render_blocks(array($blockConfirm))));        
						print $outputConfirm;
					?>
					<a class="back-to-form" href="/contact">Something Else to Send?</a>
				</section>
 			</div>
 		</div>
 	</section>
 	<section class="contact-info animate-in">
 		<div id="map-canvas" class="left">&nbsp;</div>
 		<div class="location-info">
 			<h2>Office</h2>
 			<p><strong><a href='http://maps.apple.com/?q=635+West+Lakeside+Ave+Suite 101+Cleveland+OH+44113' target="_blank">635 West Lakeside Avenue<br>Suite 101<br>Cleveland, OH 44113</a></strong></p>
			<p>Tel: <a href="tel:2164007187">(216) 400-7187</a><br>Fax: (216) 274–9196</p>
 		</div>
 	</section>
</article>

<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
	function initialize() 
	{
		setTimeout( function()
			{
		        var map_canvas = document.getElementById('map-canvas');
		        var myLatlng = new google.maps.LatLng(41.500829, -81.700528); 
		        var map_options = {
		          center: myLatlng,
		          zoom: 15,
		          scrollwheel: false,
		          mapTypeId: google.maps.MapTypeId.ROADMAP
		        }
		        var map = new google.maps.Map(map_canvas, map_options);
		        var image = new google.maps.MarkerImage(
				  'sites/all/themes/recess/images/recess-map-marker.png',
				  new google.maps.Size(33,46),
				  new google.maps.Point(0,0),
				  new google.maps.Point(17,46)
				);
				var shadow = new google.maps.MarkerImage(
				  'sites/all/themes/recess/images/recess-map-marker-shadow.png',
				  new google.maps.Size(59,46),
				  new google.maps.Point(0,0),
				  new google.maps.Point(17,46)
				);
				var shape = {
				  coord: [22,0,24,1,25,2,27,3,28,4,28,5,29,6,30,7,30,8,31,9,31,10,32,11,32,12,32,13,32,14,32,15,32,16,32,17,32,18,32,19,32,20,31,21,31,22,30,23,30,24,29,25,28,26,27,27,26,28,25,29,24,30,22,31,20,32,19,33,19,34,19,35,18,36,18,37,18,38,18,39,17,40,17,41,17,42,17,43,17,44,16,45,14,45,14,44,14,43,14,42,14,41,14,40,14,39,13,38,13,37,13,36,13,35,12,34,12,33,12,32,10,31,8,30,6,29,5,28,4,27,3,26,2,25,2,24,1,23,1,22,0,21,0,20,0,19,0,18,0,17,0,16,0,15,0,14,0,13,0,12,0,11,0,10,1,9,1,8,2,7,2,6,3,5,4,4,5,3,6,2,8,1,10,0,22,0],
				  type: 'poly'
				};
		        var marker = new google.maps.Marker({
				      position: myLatlng,
				      draggable: false,
					  shadow: shadow,
					  shape: shape,
					  icon: image,
				      map: map,
				      title: 'Recess Creative'
				  });
		    }, 1500
	    );
      }
      google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php require_once DRUPAL_ROOT . '/' . variable_get('footer', 'sites/all/themes/recess/includes/footer.php'); ?>