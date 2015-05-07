			<?php get_template_part('templates/page', 'header'); ?>

	<div id="map_address" data-address="<?php echo $address;?>" data-zoom="<?php echo $zoom;?>"></div>

	<div id="content" class="container">
   		<div class="row">
   		<?php $form = get_post_meta( $post->ID, '_kad_contact_form', true );
      	if ($form == 'yes') { ?>
	  		<div id="main" class="main col-md-5" role="main">
	  			<div class="postclass pageclass">
	  	<?php } else { ?>
      		<div id="main" class="main col-md-12" role="main">
      			<div class="postclass pageclass">
      <?php } ?>
      <?php get_template_part('templates/content', 'page'); ?>
		      </div>
		  </div>
      <?php if ($form == 'yes') { ?>
      		<div class="contactformcase col-md-7">
      			<?php
      			 $contactformtitle = get_post_meta( $post->ID, '_kad_contact_form_title', true ); if (!empty($contactformtitle)) {
      				echo '<h3>'. $contactformtitle .'</h3>';
      			} ?>
				<?php if(isset($emailSent) && $emailSent == true) { ?>
							<div class="thanks">
								<p><?php pll_e( 'Thanks, your email was sent successfully.' );?></p>
							</div>
						<?php } else { ?>
							<?php if($params['has_error'] || isset($captchaError)) { ?>
								<p class="error"><?php pll_e( 'Sorry, an error occured.' );?><p>
							<?php } ?>

						<form action="<?php the_permalink(); ?>" id="contactForm" method="post"
							data-msg-required="<?php pll_e( 'This field is required.' ); ?>"
							data-msg-email="<?php pll_e( 'Please enter a valid email address.' ); ?>">
							<div class="contactform">
							<p>
								<label for="contactName"><b><?php pll_e( 'Name:' );?></b></label><?php if($params['name_error_msg']) { ?>
									<span class="error"><?php $params['name_error_msg'];?></span>
								<?php } ?>

								<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField full" />

							</p>

							<p>
								<label for="email"><b><?php pll_e( 'Email:' ); ?></b></label> <?php if($params['email_error_msg']) { ?>
									<span class="error"><?php $params['email_error_msg'];?></span>
								<?php } ?>
								<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email full" />
							</p>

							<p><label for="commentsText"><b><?php pll_e( 'Message:' ); ?></b></label>	<?php if($params['comment_error_msg']) { ?>
									<span class="error"><?php $params['comment_error_msg'];?></span>
								<?php } ?>
								<textarea name="comments" id="commentsText" rows="10" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							</p>
							<?php if($params['captcha_math']) { ?>
								<?php   $one = rand(5, 50);
									$two = rand(1, 9);
									$result = md5($one + $two); ?>
									<p>
									<label for="kad_captcha"><b><?php echo $one.' + '.$two; ?> = </b></label>
									<input type="text" name="kad_captcha" id="kad_captcha" class="required requiredField kad_captcha kad-quarter" />
									<?php if ($params['captch_error_msg']) { ?><label class="error"><?php echo $params['captch_error_msg'];?></label><?php } ?>
									<input type="hidden" name="hval" id="hval" value="<?php echo $result;?>" />
								</p>
							<?php } ?>
							<p>
								<input type="submit" class="kad-btn kad-btn-primary" id="submit" tabindex="5" value="<?php pll_e( 'Send Email' ); ?>" ></input>
							</p>
						</div><!-- /.contactform-->
						<input type="hidden" name="submitted" id="submitted" value="true" />
					</form>
				<?php } ?>
      </div><!--contactform-->
      <?php } ?>
      <?php get_sidebar(); ?>
            </div><!-- /.row-->
    </div><!-- /.content -->
  </div><!-- /.wrap -->