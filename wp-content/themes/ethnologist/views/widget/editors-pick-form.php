<p>
	<label for="<?php echo esc_attr( $context->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'ethnologist' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $context->get_field_id( 'title' ) ); ?>"
		name="<?php echo esc_attr( $context->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $params['title'] ); ?>" />
</p>

<p>
	<label for="<?php echo $context->get_field_id( 'post_id' ); ?>">
		<?php _e( 'Post:', 'ethnologist' ); ?>
	</label>

	<select id="<?php echo $context->get_field_id( 'post_id' ); ?>"
			name="<?php echo $context->get_field_name( 'post_id' ); ?>">
		<option value=""></option>
		<?php foreach ( get_posts( $params['query_args'] ) as $post ): ?>
		<option value="<?php echo $post->ID ?>"
				<?php if ( $params['post_id'] == $post->ID ) echo 'selected="selected"'?>>
			<?php echo $post->post_title; ?> (<?php echo $post->post_type; ?>)
		</option>
		<?php endforeach; ?>
	</select>
</p>