<p>
	<label for="<?php echo esc_attr( $context->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'ethnologist' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $context->get_field_id( 'title' ) ); ?>"
		name="<?php echo esc_attr( $context->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $params['title'] ); ?>" />
</p>

<?php foreach ( $context->types as $type_ident => $type_name ): ?>
<p>
	<label for="<?php echo esc_attr( $context->get_field_id( $type_ident ) ); ?>"><?php _e( $type_name, 'ethnologist' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $context->get_field_id( $type_ident ) ); ?>"
		name="<?php echo esc_attr( $context->get_field_name( $type_ident ) ); ?>" type="text" value="<?php echo esc_attr( $params[$type_ident] ); ?>" />
</p>
<?php endforeach; ?>