<?php
/*
Template Name: Ethnologist Contact
*/

get_header();

global $pinnacle, $post;

$address = get_post_meta( $post->ID, '_kad_contact_address', true );
$maptype = get_post_meta( $post->ID, '_kad_contact_maptype', true );
$mapzoom = get_post_meta( $post->ID, '_kad_contact_zoom', true );
if($mapzoom != '')
	$zoom = $mapzoom;
else
	$zoom = 15;

$pageemail = get_post_meta( $post->ID, '_kad_contact_form_email', true );
$form_math = get_post_meta( $post->ID, '_kad_contact_form_math', true );

if(isset($_POST['submitted'])) {
		if(isset($form_math) && $form_math == 'yes') {
			if(md5($_POST['kad_captcha']) != $_POST['hval']) {
				$kad_captchaError = pll__( 'Check your math.' );
				$hasError = true;
			}
		}
	if(trim($_POST['contactName']) === '') {
		$nameError = pll__( 'Please enter your name.' );
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = pll__('Please enter your email address.' );
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = pll__( 'You entered an invalid email address.' );
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = pll__( 'Please enter a message.' );
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if(!isset($hasError)) {
		if (isset($pageemail)) {
			$emailTo = $pageemail;
		} else {
			$emailTo = get_option('admin_email');
		}
		$sitename = get_bloginfo('name');
		$subject = '['.$sitename . ' ' . __("Contact", "ethnologist").'] '. __("From", "ethnologist") . ' '. $name;
		$body = __('Name', 'ethnologist').": $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

}  ?>
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
							<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p class="error"><?php pll_e( 'Sorry, an error occured.' );?><p>
							<?php } ?>

						<form action="<?php the_permalink(); ?>" id="contactForm" method="post"
							data-msg-required="<?php pll_e( 'This field is required.' ); ?>"
							data-msg-email="<?php pll_e( 'Please enter a valid email address.' ); ?>">
							<div class="contactform">
							<p>
								<label for="contactName"><b><?php pll_e( 'Name:' );?></b></label><?php if(isset($nameError)) { ?>
									<span class="error"><?php $nameError;?></span>
								<?php } ?>

								<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField full" />

							</p>

							<p>
								<label for="email"><b><?php pll_e( 'Email:' ); ?></b></label> <?php if(isset($emailError)) { ?>
									<span class="error"><?php $emailError;?></span>
								<?php } ?>
								<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email full" />
							</p>

							<p><label for="commentsText"><b><?php pll_e( 'Message:' ); ?></b></label>	<?php if(isset($commentError)) { ?>
									<span class="error"><?php $commentError;?></span>
								<?php } ?>
								<textarea name="comments" id="commentsText" rows="10" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							</p>
							<?php if(isset($form_math) && $form_math == 'yes') { ?>
								<?php   $one = rand(5, 50);
									$two = rand(1, 9);
									$result = md5($one + $two); ?>
									<p>
									<label for="kad_captcha"><b><?php echo $one.' + '.$two; ?> = </b></label>
									<input type="text" name="kad_captcha" id="kad_captcha" class="required requiredField kad_captcha kad-quarter" />
									<?php if(isset($kad_captchaError)) { ?><label class="error"><?php echo $kad_captchaError;?></label><?php } ?>
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
  <?php get_footer(); ?>