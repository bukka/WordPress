
<div id="map_address" data-address="<?php echo $params['map_address'];?>" data-zoom="<?php echo $params['map_zoom'];?>"></div>

<div id="content" class="container">
	<div class="row">
		<div id="main" class="main col-md-<?php echo $params['form'] ? 5 : 12; ?>" role="main">
			<div class="postclass pageclass contact-info-box">

				<div class="contact-info-field">
					<h3 class="widget-title"><?php pll_e( 'Location' ); ?></h3>
					<div class="textwidget">
						<h5 style="text-align: center;">
							<span style="color: #444444;"><?php the_field( 'address_name' ); ?></span>
						</h5>
						<div style="text-align: center;">
							<?php the_field( 'address_description' ); ?>
						</div>
					</div>
				</div>
				<div class="contact-info-field">
					<h3 class="widget-title"><?php pll_e( 'Phone' ); ?></h3>
					<div class="textwidget">
						<h5 style="text-align: center;">
							<span style="color: #444444;"><?php the_field( 'phone_number' ); ?></span>
						</h5>
						<div style="text-align: center;">
							<?php the_field( 'phone_description' ); ?>
						</div>
					</div>
				</div>

				<div class="contact-info-field">
					<h3 class="widget-title"><?php pll_e( 'Email' ); ?></h3>
					<div class="textwidget">
						<h5 style="text-align: center;">
							<span style="color: #444444;"><?php the_field( 'email_address' ); ?></span>
						</h5>
						<div style="text-align: center;">
							<?php the_field( 'email_description' ); ?>
						</div>
					</div>
				</div>

			</div>
		</div>

		<?php if ( $params['form'] ): ?>
		<div class="contactformcase col-md-7">
			<h3><?php pll_e( 'Send us an email' ); ?></h3>
			<?php if ( $params['email_sent'] ): ?>
			<div class="thanks">
				<p><?php pll_e( 'Thanks, your email was sent successfully.' );?></p>
			</div>
			<?php else: ?>
			<?php	if ( $params['has_error'] ): ?>
			<p class="error"><?php pll_e( 'Sorry, an error occured.' );?><p>
			<?php	endif; ?>
			<form action="<?php the_permalink(); ?>" id="contactForm" method="post"
					data-msg-required="<?php pll_e( 'This field is required.' ); ?>"
					data-msg-email="<?php pll_e( 'Please enter a valid email address.' ); ?>"
					data-msg-form-success="<?php pll_e( 'The email has been successfully delivered.' ); ?>"
					data-msg-form-error="<?php pll_e( 'The email sending failed. Please email us directly.' ); ?>">
				<div class="contactform">
					<p>
						<label for="contactName"><b><?php pll_e( 'Name' );?></b></label>
						<?php if ( $params['name_error_msg'] ): ?>
						<span class="error"><?php $params['name_error_msg'];?></span>
						<?php endif; ?>
						<input type="text" name="contactName" id="contactName"
								value="<?php echo $params['name_value']; ?>"
								class="required requiredField full" />
					</p>
					<p>
						<label for="email"><b><?php pll_e( 'Email' ); ?></b></label>
						<?php if ( $params['email_error_msg'] ): ?>
						<span class="error"><?php $params['email_error_msg']; ?></span>
						<?php endif; ?>
						<input type="text" name="email" id="email"
								value="<?php echo $params['email_value']; ?>"
								class="required requiredField email full" />
					</p>
					<p>
						<label for="commentsText"><b><?php pll_e( 'Message' ); ?></b></label>
						<?php if ( $params['comment_error_msg'] ): ?>
						<span class="error"><?php echo $params['comment_error_msg'];?></span>
						<?php endif; ?>
						<textarea name="comments" id="commentsText" rows="10"
							class="required requiredField"><?php echo $params['comment_value']; ?></textarea>
					</p>
					<?php if ( $params['captcha_math'] ): ?>
					<p>
						<label for="kad_captcha"><b><?php echo $params['captcha_one'] ?> + <?php echo $params['captcha_two'] ?> = </b></label>
						<input type="text" name="kad_captcha" id="kad_captcha" class="required requiredField kad_captcha kad-quarter" />
						<?php if ( $params['captch_error_msg']): ?>
						<label class="error"><?php echo $params['captch_error_msg'];?></label>
						<?php endif; ?>
						<input type="hidden" name="hval" id="hval" value="<?php echo $params['captcha_res']; ?>" />
					</p>
					<?php endif; ?>
					<p>
						<input type="submit" class="kad-btn kad-btn-primary" id="submit" tabindex="5" value="<?php pll_e( 'Send Email' ); ?>" ></input>
					</p>
				</div><!-- /.contactform-->
				<input type="hidden" name="submitted" id="submitted" value="true" />
				<input type="hidden" name="action" id="ethnologist_contact_email" value="true" />
				<?php wp_nonce_field( 'ethnologist_contact_form' ); ?>
			</form>
			<?php endif; ?>
		</div><!--contactform-->
		<?php endif; ?>
		<?php get_sidebar(); ?>
	</div><!-- /.row-->
</div><!-- /.content -->

</div><!-- /.wrap -->