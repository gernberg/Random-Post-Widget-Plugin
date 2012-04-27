<?php

function rwp_get_random_post() {
	$args = array(
		"numberposts"	=> 1,
		"orderby"		=> "rand"
	);
	
	$data = get_posts($args);
	
	$randompost = array(
		"title"		=> $data[0]->post_title,
		"permalink"	=> $data[0]->guid
	);
	
	return $randompost;
}

?>