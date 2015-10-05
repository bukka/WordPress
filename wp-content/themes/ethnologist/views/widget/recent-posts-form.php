<p>
	<label for="<?php echo $context->get_field_id( 'title' ); ?>">
		<?php _e( 'Title:', 'ethnologist' ); ?>
	</label>
	<input class="widefat" id="<?php echo $context->get_field_id( 'title' ); ?>"
			name="<?php echo $context->get_field_name( 'title' ); ?>"
			type="text" value="<?php echo $params['title']; ?>" />
</p>
<p>
	<label for="<?php echo $context->get_field_id( 'number' ); ?>">
		<?php _e( 'Number of posts to show:', 'ethnologist' ); ?>
	</label>
	<input id="<?php echo $context->get_field_id( 'number' ); ?>"
			name="<?php echo $context->get_field_name( 'number' ); ?>"
			type="text" value="<?php echo $params['number']; ?>" size="3" />
</p>
<p>
	<label for="<?php echo $context->get_field_id( 'type' ); ?>">
		<?php _e('Type:', 'ethnologist'); ?>
	</label>
	<select id="<?php echo $context->get_field_id( 'type' ); ?>"
			name="<?php echo $context->get_field_name( 'type' ); ?>">
		<?php foreach ( $params['types'] as $type_slug => $type_name ): ?>
		<option value="<?php echo $type_slug ?>"
				<?php if ( $params['type'] === $type_slug ) echo 'selected="selected"'?>>
			<?php echo $type_name; ?>
		</option>
		<?php endforeach; ?>
	</select>
</p>
<p>
	<label for="<?php echo $context->get_field_id( 'thecate' ); ?>">
		<?php _e( 'Limit to Catagory (Optional):', 'ethnologist' ); ?>
	</label>
	<select id="<?php echo $context->get_field_id( 'thecate' ); ?>"
			name="<?php echo $context->get_field_name( 'thecate' ); ?>">
		<option value=""><?php _e( 'All', 'ethnologist' ); ?></option>
		<?php foreach ( get_categories() as $cate ): ?>
		<option value="<?php echo $cate->slug ?>"
				<?php if ( $params['thecate'] === $cate->slug ) echo 'selected="selected"'?>>
			<?php echo $cate->name; ?>
		</option>
		<?php endforeach; ?>
	</select>
</p>