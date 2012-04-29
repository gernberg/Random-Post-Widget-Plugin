<?php

function rwp_get_random_posts($count) {
	$args = array(
		"numberposts"	=> $count,
		"orderby"		=> "rand"
	);
	
	$posts = get_posts($args);
	return $posts;
}

?>