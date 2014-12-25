<?php
/*
Template Name: Contact
*/
?>
	<?php get_header(); ?>
	<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$.extend($.validator.messages, {
	        required: "<?php echo __('This field is required.', 'pinnacle'); ?>",
			email: "<?php echo __('Please enter a valid email address.', 'pinnacle'); ?>",
		 });
		$("#contactForm").validate();
	});
	</script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.validate-ck.js"></script>
	<?php global $pinnacle, $post; $map = get_post_meta( $post->ID, '_kad_contact_map', true ); 
	if ($map == 'yes') { ?>
		    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
		    <?php global $post; $address = get_post_meta( $post->ID, '_kad_contact_address', true ); 
							    $maptype = get_post_meta( $post->ID, '_kad_contact_maptype', true ); 
							    $height = get_post_meta( $post->ID, '_kad_contact_mapheight', true ); 
							    if($height != '') {$mapheight = $height;} else {$mapheight = 300;}
							    $mapzoom = get_post_meta( $post->ID, '_kad_contact_zoom', true ); 
							    if($mapzoom != '') $zoom = $mapzoom; else $zoom = 15; 
		    ?>
		    <script type="text/javascript">
					jQuery(window).load(function() {
		
					jQuery('#map_address').gmap3({
			map: {
			    address:"<?php echo $address;?>",
				options: {
              		zoom:<?php echo $zoom;?>,
					draggable: true,
					mapTypeControl: true,
					mapTypeId: google.maps.MapTypeId.<?php echo $maptype;?>,
					scrollwheel: false,
					panControl: true,
					rotateControl: false,
					scaleControl: true,
					streetViewControl: true,
					zoomControl: true
				}
			},
			marker:{
            values:[
            		 {address: "<?php echo $address;?>",
			 	    data:"<div class='mapinfo'>'<?php echo $address;?>'</div>",
			 	},
            ],
            options:{
              draggable: false,
            },
			events:{
              click: function(marker, event, context){
                var map = jQuery(this).gmap3("get"),
                  infowindow = jQuery(this).gmap3({get:{name:"infowindow"}});
                if (infowindow){
                  infowindow.open(map, marker);
                  infowindow.setContent(context.data);
                } else {
                  jQuery(this).gmap3({
                    infowindow:{
                      anchor:marker, 
                      options:{content: context.data}
                    }
                  });
                }
              },
              closeclick: function(){
                var infowindow = jQuery(this).gmap3({get:{name:"infowindow"}});
                if (infowindow){
                  infowindow.close();
                }
			  }
			}
          }
        });
        
      });
			</script>
	<?php echo '<style type="text/css" media="screen">#map_address {height:'.$mapheight.'px;}</style>'; ?>
    <?php } 

    $pageemail = get_post_meta( $post->ID, '_kad_contact_form_email', true ); 
	$form_math = get_post_meta( $post->ID, '_kad_contact_form_math', true );
	if(isset($_POST['submitted'])) {
		if(isset($form_math) && $form_math == 'yes') {
			if(md5($_POST['kad_captcha']) != $_POST['hval']) {
				$kad_captchaError = __('Check your math.', 'pinnacle');
				$hasError = true;
			}
		}
	if(trim($_POST['contactName']) === '') {
		$nameError = __('Please enter your name.', 'pinnacle');
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = __('Please enter your email address.', 'pinnacle');
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = __('You entered an invalid email address.', 'pinnacle');
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = __('Please enter a message.', 'pinnacle');
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
		$subject = '['.$sitename . ' ' . __("Contact", "pinnacle").'] '. __("From", "pinnacle") . ' '. $name;
		$body = __('Name', 'pinnacle').": $name \n\nEmail: $email \n\nComments: $comments";
		$headers = __("From", "pinnacle").': '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

}  ?>
			<?php get_template_part('templates/page', 'header'); ?>
<?php if ($map == 'yes') { ?>
		            <div id="map_address">
		            </div>
  <?php } ?>

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
								<p><?php _e('Thanks, your email was sent successfully.', 'pinnacle');?></p>
							</div>
						<?php } else { ?>
							<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p class="error"><?php _e('Sorry, an error occured.', 'pinnacle');?><p>
							<?php } ?>

						<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
							<div class="contactform">
							<p>
								<label for="contactName"><b><?php _e('Name:', 'pinnacle');?></b></label><?php if(isset($nameError)) { ?>
									<span class="error"><?php $nameError;?></span>
								<?php } ?>
								
								<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField full" />
                               
							</p>

							<p>
								<label for="email"><b><?php _e('Email:', 'pinnacle'); ?></b></label> <?php if(isset($emailError)) { ?>
									<span class="error"><?php $emailError;?></span>
								<?php } ?>
								<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email full" />
							</p>

							<p><label for="commentsText"><b><?php _e('Message:', 'pinnacle'); ?></b></label>	<?php if(isset($commentError)) { ?>
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
								<input type="submit" class="kad-btn kad-btn-primary" id="submit" tabindex="5" value="<?php _e('Send Email', 'pinnacle'); ?>" ></input>
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