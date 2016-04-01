<?php 
	$query2 = new EntityFieldQuery();
	$query2->entityCondition('entity_type', 'node')
	  ->entityCondition('bundle', 'approach_flip_cards')
	  ->propertyCondition('status', 1)
	  ->addTag('sort_by_weight');
	$result2 = $query2->execute();
	$nodes2 = node_load_multiple(array_keys($result2['node']));

	foreach($nodes2 as $card) { 
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