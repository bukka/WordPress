<div class="kad_img_upload_widget">
	<?php if ( strlen( $params['image_uri'] ) > 0 ): ?>
	<p>
		<img class="kad_custom_media_image"
			src="<?php echo $params['image_uri'] ?>"
			style="margin:0;padding:0;max-width:100px;display:block" />
	</p>
	<?php endif; ?>
	<p>
		<label for="<?php echo $context->get_field_id( 'image_uri' ); ?>"><?php _e( 'Image URL', 'ethnologist' ); ?></label><br />
		<input type="text" class="widefat kad_custom_media_url" name="<?php echo $context->get_field_name( 'image_uri' ); ?>"
			id="<?php echo $context->get_field_id( 'image_uri' ); ?>" value="<?php echo $params['image_uri']; ?>" />
		<input type="button" value="<?php _e( 'Upload', 'ethnologist' ); ?>" class="button kad_custom_media_upload" id="kad_custom_image_uploader" />
	</p>
	<p>
		<label for="<?php echo $context->get_field_id( 'image_link_open' ); ?>"><?php _e( 'Image opens in', 'ethnologist' ); ?></label><br />
		<select id="<?php echo $context->get_field_id( 'image_link_open' ); ?>" name="<?php echo $context->get_field_name( 'image_link_open' ); ?>">
			<?php echo implode( '', $params['link_options_array'] );?>
		</select>
	</p>
	<p>
		<label for="<?php echo $context->get_field_id( 'image_link' ); ?>"><?php _e( 'Image Link (optional)', 'ethnologist' ); ?></label><br />
		<input type="text" class="widefat kad_img_widget_link" name="<?php echo $context->get_field_name( 'image_link' ); ?>"
				id="<?php echo $context->get_field_id( 'image_link' ); ?>" value="<?php echo $params['image_link']; ?>">
	</p>
	<p>
		<label for="<?php echo $context->get_field_id( 'text' ); ?>"><?php _e( 'Text/Caption (optional)', 'ethnologist' ); ?></label><br />
		<textarea name="<?php echo $context->get_field_name( 'text' ); ?>" id="<?php echo $context->get_field_id( 'text' ); ?>"
				class="widefat" ><?php echo $params['text']; ?></textarea>
	</p>
</div>