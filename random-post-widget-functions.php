<?php

function rwp_get_random_post() {
	$args = array(
		"numberposts"	=> 3,
		"orderby"		=> "rand"
	);
	
	$posts = get_posts($args);
	return $post;
}

?>