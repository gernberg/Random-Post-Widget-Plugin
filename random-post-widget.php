<?php
/*
Plugin Name: Random Post Widget
Version: BETA
Description: This plugin gives you a simple widget to display a random post. Helps visitors dig into your amazing article archive.

Author: Anton Niklasson
Author URI: http://www.antonniklasson.se
*/


if ( !function_exists( 'add_action' ) ) {
	echo "Not allowed to load directly.";
	exit;
}



require "random-post-widget-functions.php";

class RandomPostWidget extends WP_Widget {
	private $posts = array();
	
	public function __construct() {
		$this->posts = rwp_get_random_posts();
		
		parent::__construct(
	 		'Random_Post_Widget',
			'Random Post Widget',
			array('description' => __('Random Post Widget', 'text_domain'),)
		);
	}

 	public function form($instance) {
 		$title		 = (isset($instance['title'])) ? $instance['title'] : __('New title', 'text_domain') ;
		$numberposts = (isset($instance['numberposts'])) ? $instance['numberposts'] : __('Number of posts', 'text_domain') ;
		
		include plugin_dir_path(__FILE__)."random-post-widget-tmpl.php";
	}

	public function update($new_instance, $old_instance) {
		$title			= strip_tags($new_instance['title']);
		$numberposts	= strip_tags($new_instance['numberposts']);
		
		return array(
			'title'			=> $title,
			'numberposts'	=> $numberposts
		);
	}

	public function widget($args, $instance) {
		extract($args);
		
		$title			= apply_filters('widget_title', $instance['title']);
		$numberposts	= $instance['numberposts'];
		$this->posts	= rwp_get_random_posts($numberposts);
		

		echo $before_widget;
		
		if(!empty($title)) echo $before_title.$title.$after_title;
		echo "<ul>";
		for($i = 0; $i < sizeof($this->posts); $i++) {
			echo "<li>";
			echo "<a href='".$this->posts[$i]->guid."'>";
			echo $this->posts[$i]->post_title;
			echo "</a>";
			echo "</li>";
		}
		echo "</ul>";
		
		echo $after_widget;
	}
}


function rwp_register_widget() {
	register_widget('RandomPostWidget');
}
add_action('widgets_init', 'rwp_register_widget');

?>