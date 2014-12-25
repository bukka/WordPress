
<?php
	 if(!kadence_hide_pagetitle()) { ?>
<?php } else { 
	global $post, $pinnacle;

	if(is_page()) {
		$bsub = get_post_meta( $post->ID, '_kad_subtitle', true );
	} else if(is_category()) {
		$bsub = category_description();
	} else if(is_tag()) {
		$bsub = tag_description();
	}

?>
<div id="pageheader" class="titleclass">
<div class="header-color-overlay"></div>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-12">
				  	<h1 class="kad-page-title"><?php echo kadence_title(); ?></h1>
					  <?php if(!empty($bsub)) { echo '<div class="subtitle"> '.$bsub.' </div>'; } ?>
				</div>
			</div>
		</div>
	</div><!--container-->
</div><!--titleclass-->
<?php } ?>