<p>
	<label for="<?php echo esc_attr( $context->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'ethnologist' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $context->get_field_id( 'title' ) ); ?>"
		name="<?php echo esc_attr( $context->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $params['title'] ); ?>" />
</p>