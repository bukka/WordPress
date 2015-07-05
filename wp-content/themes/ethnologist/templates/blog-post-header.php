<?php
if ( kadence_pagetitle_behind_header() ) {
	global $post, $pinnacle;

	$bsub = get_post_meta( $post->ID, '_kad_subtitle', true );
	$post_header_title = get_post_meta( $post->ID, '_kad_post_header_title', true );

	if ( ! empty( $post_header_title ) ) {

		$page_title_title = $post_header_title;

	} else {

		if ( isset( $pinnacle['single_post_header_title'] ) && $pinnacle['single_post_header_title'] == 'custom' ) {
			if ( isset( $pinnacle['post_header_title_text'] ) ) {
				$page_title_title = $pinnacle['post_header_title_text'];
			} else {
				$page_title_title = '';
			}
			$bsub = $pinnacle['post_header_subtitle_text'];

		} else if ( isset( $pinnacle['single_post_header_title'] ) && $pinnacle['single_post_header_title'] == 'posttitle' ) {
			$page_title_title =  get_the_title();
		} else {
			if ( $terms = wp_get_post_terms( $post->ID, 'category', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
				$cat = $terms[0];
			} else {
				$cat = get_the_category(); $cat = $cat[0];
			}
			$page_title_title = $cat->name;
		}
	}
?>
<div id="pageheader" class="titleclass">
<div class="header-color-overlay"></div>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-12">
				  	<h1 class="post_page_title entry-title"><?php echo $page_title_title; ?></h1>
					  <?php if ( isset($bsub) && ! empty( $bsub ) ): ?>
					  <p class="subtitle"><?php echo $bsub ?></p>
					  <?php endif; ?>
				</div>
			</div>
		</div>
	</div><!--container-->
</div><!--titleclass-->

<?php } ?>