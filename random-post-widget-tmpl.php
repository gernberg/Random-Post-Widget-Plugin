<p>
<label for="<?php echo $this->get_field_id('title') ?>"><?php _e( 'Title:' ) ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" type='text' value="<?php echo esc_attr($title) ?>">
</p>

<p>
<label for="<?php echo $this->get_field_id('numberposts') ?>"><?php _e('Number of posts:') ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('numberposts') ?>" name="<?php echo $this->get_field_name('numberposts') ?>" type="text" value="<? echo esc_attr($numberposts) ?>">
</p>