<?php foreach( $context->get_form_fields() as $field_name => $field_label ): ?>
<p>
	<label for="<?php echo esc_attr( $context->get_field_id( $field_name ) ); ?>"><?php _e( $field_label, 'ethnologist' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $context->get_field_id( $field_name ) ); ?>"
		   name="<?php echo esc_attr( $context->get_field_name( $field_name ) ); ?>"
		   type="text" value="<?php echo $params[$field_name]; ?>" />
</p>
<?php endforeach; ?>