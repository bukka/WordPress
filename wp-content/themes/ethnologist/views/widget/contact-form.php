<p>
	<label for="<?php echo esc_attr( $context->get_field_id('title') ); ?>"><?php _e( 'Title:', 'ethnologist' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $context->get_field_id('title') ); ?>" name="<?php echo esc_attr( $context->get_field_name('title') ); ?>" type="text" value="<?php echo $params['title']; ?>" />
</p>
<p>
	<label for="<?php echo esc_attr( $context->get_field_id('company') ); ?>"><?php _e( 'Company Name:', 'ethnologist' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $context->get_field_id('company') ); ?>" name="<?php echo esc_attr( $context->get_field_name('company') ); ?>" type="text" value="<?php echo $params['company']; ?>" />
</p>
<p>
	<label for="<?php echo esc_attr( $context->get_field_id('name') ); ?>"><?php _e( 'Name:', 'ethnologist' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $context->get_field_id('name') ); ?>" name="<?php echo esc_attr( $context->get_field_name('name') ); ?>" type="text" value="<?php echo $params['name']; ?>" />
</p>
<p>
	<label for="<?php echo esc_attr( $context->get_field_id('street_address') ); ?>"><?php _e( 'Street Address:', 'ethnologist' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $context->get_field_id('street_address') ); ?>" name="<?php echo esc_attr( $context->get_field_name('street_address') ); ?>" type="text" value="<?php echo $params['street_address']; ?>" />
</p>
<p>
	<label for="<?php echo esc_attr( $context->get_field_id('locality') ); ?>"><?php _e( 'City/Locality:', 'ethnologist' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $context->get_field_id('locality') ); ?>" name="<?php echo esc_attr( $context->get_field_name('locality') ); ?>" type="text" value="<?php echo $params['locality']; ?>" />
</p>
<p>
	<label for="<?php echo esc_attr( $context->get_field_id('region') ); ?>"><?php _e( 'State/Region:', 'ethnologist' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $context->get_field_id('region') ); ?>" name="<?php echo esc_attr( $context->get_field_name('region') ); ?>" type="text" value="<?php echo $params['region']; ?>" />
</p>
<p>
	<label for="<?php echo esc_attr( $context->get_field_id('postal_code') ); ?>"><?php _e( 'Zipcode/Postal Code:', 'ethnologist' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $context->get_field_id('postal_code') ); ?>" name="<?php echo esc_attr( $context->get_field_name('postal_code') ); ?>" type="text" value="<?php echo $params['postal_code']; ?>" />
</p>
<p>
	<label for="<?php echo esc_attr( $context->get_field_id('tel') ); ?>"><?php _e( 'Mobile Telephone:', 'ethnologist' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $context->get_field_id('tel') ); ?>" name="<?php echo esc_attr( $context->get_field_name('tel') ); ?>" type="text" value="<?php echo$params['tel']; ?>" />
</p>
<p>
	<label for="<?php echo esc_attr( $context->get_field_id('fixedtel') ); ?>"><?php _e( 'Fixed Telephone:', 'ethnologist' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $context->get_field_id('fixedtel') ); ?>" name="<?php echo esc_attr( $context->get_field_name('fixedtel') ); ?>" type="text" value="<?php echo $params['fixedtel']; ?>" />
</p>
<p>
	<label for="<?php echo esc_attr( $context->get_field_id('email') ); ?>"><?php _e( 'Email:', 'ethnologist' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $context->get_field_id('email') ); ?>" name="<?php echo esc_attr( $context->get_field_name('email') ); ?>" type="text" value="<?php echo $params['email']; ?>" />
</p>