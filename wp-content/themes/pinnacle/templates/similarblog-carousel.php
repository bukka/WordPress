    <div id="blog_carousel_container" class="carousel_outerrim">
        <?php global $post; $text = get_post_meta( $post->ID, '_kad_blog_carousel_title', true ); if(!empty($text)) { 
        	echo '<h3 class="sectiontitle">'.$text.'</h3>'; } else {
    		echo '<h3 class="sectiontitle">'.__('Similar Posts', 'pinnacle').'</h3>';} ?>
            <div class="blog-carouselcase fredcarousel">
            	<?php if (kadence_display_sidebar()) {
            		$itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $md = 3; $sm = 3; $xs = 2; $ss = 1; 
            	} else {
            		$itemsize = 'tcol-md-3 tcol-sm-3 tcol-xs-4 tcol-ss-12'; $md = 4; $sm = 3; $xs = 2; $ss = 1;
            	} ?>
			<div id="carouselcontainer" class="rowtight">
    		<div id="blog_carousel" class="blog_carousel clearfix">
      		<?php $categories = get_the_category($post->ID);
					if ($categories) {
						$category_ids = array();
						foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id; 
					}
					$temp = $wp_query; 
				  	$wp_query = null; 
				  	$wp_query = new WP_Query();
				  	$wp_query->query(array('category__in' => $category_ids,'orderby' => 'rand','post__not_in' => array($post->ID),'posts_per_page'=>6));
					if ( $wp_query ) : 
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                	<div class="<?php echo $itemsize;?> b_item kad_blog_item">
							<?php get_template_part('templates/content', 'post-grid-carousel');?>
					</div>
					<?php endwhile; else: ?>
						<li class="error-not-found"><?php _e('Sorry, no blog entries found.', 'pinnacle'); ?></li>
					<?php endif; 
				$wp_query = null; 
			  	$wp_query = $temp;  // Reset
				wp_reset_query(); ?>								
				</div>
     		<div class="clearfix"></div>
	            <a id="prevport_blog" class="prev_carousel icon-angle-left" href="#"></a>
				<a id="nextport_blog" class="next_carousel icon-angle-right" href="#"></a>
            </div>
        </div>
</div><!-- blog_carousel_container-->
<script type="text/javascript">
	 jQuery( window ).load(function () {
	 	var $wcontainer = jQuery('#carouselcontainer');
	 	var $container = jQuery('#blog_carousel');
	 				function getUnitWidth() {
					var width;
					if(jQuery(window).width() <= 480) {
					width = $wcontainer.width() / <?php echo $ss;?>;
					} else if(jQuery(window).width() <= 768) {
					width = $wcontainer.width() / <?php echo $xs;?>;
					} else if(jQuery(window).width() <= 990) {
					width = $wcontainer.width() / <?php echo $sm;?>;
					} else {
					width = $wcontainer.width() / <?php echo $md;?>;
					}
					return width;
					}
					function setWidths() {
					var unitWidth = getUnitWidth() -1;
					$container.children().css({ width: unitWidth });
					}
	 				function initCarousel_blog() {
	 					$container.carouFredSel({
							scroll: { items:1,easing: "swing", duration: 700, pauseOnHover : true},
							auto: {play: true, timeoutDuration: 9000},
							prev: '#prevport_blog',
							next: '#nextport_blog',
							pagination: false,
							swipe: true,
								items: {visible: null
								}
						});
	 				}
	 				setWidths();
	 				initCarousel_blog();
					jQuery(window).on("debouncedresize", function( event ) {
						$container.trigger("destroy");
						setWidths();
						initCarousel_blog();
					});
});
</script>					