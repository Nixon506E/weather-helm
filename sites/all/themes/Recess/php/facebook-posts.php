<?php 

$page_id = 'RecessCreative'; // Page ID or username

$token = '732464433481380|0e0cc56f335267c3b39d65e890d848cd'; // Valid access token, I used app token here but you might want to use a user token .. up to you
//echo $token;
$page_posts = file_get_contents('https://graph.facebook.com/'.$page_id.'/posts?access_token='.$token); // > fields=message < since you want to get only 'message' property (make your call faster in milliseconds) you can remove it

$pageposts = json_decode($page_posts); 
$count = 1;
foreach ($pageposts->data as $fppost) {
	if ($count < 21) {
             if (property_exists($fppost, 'message')) { // Some posts doesn't have message property (like photos set posts), errors-free ;)
                 //print_r($fppost);
                 //print $fppost->message.' '.strtotime($fppost->created_time).'</br>';
				$string = $fppost->message;
			    preg_match('/(http:\/\/[^\s]+)/', $string, $text);
			    $hypertext = "<a href=\"". $text[0] . "\" target=\"_blank\">" . $text[0] . "</a>";
			    $newMessage = preg_replace('/(http:\/\/[^\s]+)/', $hypertext, $string);

			    $newMessage = preg_replace(
			    '/\s+#(\w+)/',
			    ' <a href="http://facebook.com/hashtag/$1" target="_blank">#$1</a>',
			    $newMessage);

				$timestamp = strtotime($fppost->created_time);
				$formattedDate = date('m/d/Y', $timestamp);
				$postID = explode('_', $fppost->id);
                 echo '<article class="facebook item"><div class="facebook-container"><div class="icon-header"><img src="/'.path_to_theme().'/images/icon_scuttlebutt_facebook.png" alt="Facebook Post"></div><div class="handle"><a href="http://facebook.com/RecessCreative/posts/'.$postID[1].'" target="_blank">Recess Creative via Facebook</a></div><div class="post">'.$newMessage;
                 /*if (property_exists($fppost, 'picture')) { 
                 	echo '<a href="'.$fppost->link.'" target="_blank"><img src="'.$fppost->picture.'"></a>';
                 }*/
                 //echo $newMessage;
                 echo '</div><div class="description"><span class="date" data-timestamp="'.$timestamp.'">'.$formattedDate.'</span> | Facebook</div></div></article>';
            	//echo '<article class="facebook item"><div class="facebook-container"><div class="handle"><a href="http://facebook.com/RecessCreative" target="_blank">Recess Creative via Facebook</a></div><div class="post"><img src="'.$fppost->shared_story->picture.'"></div><div class="description"><span class="date" data-timestamp="'.$timestamp.'">'.$formattedDate.'</span> | Facebook</div></div></article>';
             } 
    }
    $count++;
}

?>

