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
	private $post;
	private $post_title;
	private $post_url;
	
	public function __construct() {
		$post = rwp_get_random_post();
		$this->post = $post;
		$this->post_title = $post['title'];
		$this->post_url = $post['permalink'];
		
		parent::__construct(
	 		'Random_Post_Widget',
			'Random Post Widget',
			array('description' => __('Random Post Widget', 'text_domain'),)
		);
	}

 	public function form($instance) {
		if(isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = __('New title', 'text_domain');
		}
		
		echo "<p>";
		echo "<label for=".$this->get_field_id('title').">"._e( 'Title:' )."</label>"; 
		echo "<input class='widefat' id=".$this->get_field_id('title')." name=".$this->get_field_name('title')." type='text' value=".esc_attr($title)." />";
		echo "</p>";
	}

	public function update($new_instance, $old_instance) {
		return array(
			'title' => strip_tags($new_instance['title'])
		);
	}

	public function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;
		
		if(!empty( $title))
			echo $before_title . $title . $after_title;
		
		echo "<a href='".$this->post_url."'>";
		echo $this->post_title;
		echo "</a>";
		
		echo $after_widget;
	}
}


function rwp_register_widget() {
	register_widget('RandomPostWidget');
}
add_action('widgets_init', 'rwp_register_widget');

?>