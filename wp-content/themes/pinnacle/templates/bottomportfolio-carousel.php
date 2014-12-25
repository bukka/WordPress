<div id="portfolio_carousel_container" class="carousel_outerrim">
    <?php global $post, $pinnacle; $text = get_post_meta( $post->ID, '_kad_portfolio_carousel_title', true ); if( $text != '') { echo '<h3 class="sectiontitle">'.$text.'</h3>'; } else {echo '<h3 class="sectiontitle">'.__('Recent Projects', 'virtue').'</h3>';} 
        if(isset($pinnacle['portfolio_style_default'])) {
		      			$pstyleclass = $pinnacle['portfolio_style_default'];
		      		} else {
		      			$pstyleclass = 'padded_style';
		      		}
		      		if(isset($pinnacle['portfolio_hover_style_default'])) {
		      			$phoverstyleclass = $pinnacle['portfolio_hover_style_default'];
		      		} else {
		      			$phoverstyleclass = 'p_lightstyle';
		      		}
		      		if(isset($pinnacle['portfolio_ratio_default'])) {
                   	 			$pimgratio = $pinnacle['portfolio_ratio_default'];
                   	 		} else {
                   	 			$pimgratio = "square";
                   	 		}
                   	 		$showexcerpt = false; $plb = false; $portfolio_item_types = true;
        $bporder = get_post_meta( $post->ID, '_kad_portfolio_carousel_order', true );
        $bpgroup = get_post_meta( $post->ID, '_kad_portfolio_carousel_group', true );
        if(isset($bporder)) {$bp_orderby = $bporder;} else {$bp_orderby = 'menu_order';}
		if($bp_orderby == 'menu_order') {$bp_order = 'ASC';} else {$bp_order = 'DESC';}
		if(empty($bpgroup) || $bpgroup == 'default') {
			if(isset($pinnacle['single_portfolio_carousel_items']) &&  $pinnacle['single_portfolio_carousel_items'] == 'cat') {
				$typeterms =  wp_get_post_terms( $post->ID, 'portfolio-type', array( 'orderby' => 'parent', 'order' => 'ASC' ));$typeterm = $typeterms[0]; $bp_cat_slug = $typeterm->slug; 
			} else {
				$bp_cat_slug = '';
			}
		} else if($bpgroup == 'cat') {
			$typeterms =  wp_get_post_terms( $post->ID, 'portfolio-type', array( 'orderby' => 'parent', 'order' => 'ASC' ));$typeterm = $typeterms[0]; $bp_cat_slug = $typeterm->slug; 
		} else {$bp_cat_slug = '';}  ?> 
            <div class="portfolio-carouselcase fredcarousel">
            <?php
            	if(!empty($pinnacle['portfolio_recent_car_column'])) {$portfolio_column = $pinnacle['portfolio_recent_car_column'];} else {$portfolio_column = 4;}
            	if ($portfolio_column == '2') {$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $slidewidth = 600; $md = 2; $sm = 2; $xs = 1; $ss = 1;} 
		                   else if ($portfolio_column == '3'){ $itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 400; $md = 3; $sm = 3; $xs = 2; $ss = 1;} 
		                   else if ($portfolio_column == '6'){ $itemsize = 'tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300; $md = 6; $sm = 4; $xs = 3; $ss = 2;} 
		                   else if ($portfolio_column == '5'){ $itemsize = 'tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300; $md = 5; $sm = 4; $xs = 3; $ss = 2;} 
		                   else {$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 300; $md = 4; $sm = 3; $xs = 2; $ss = 1;}
            	 if($pimgratio == 'portrait') {
									$temppimgheight = $slidewidth * 1.35;
									$slideheight = floor($temppimgheight);
						} else if($pimgratio == 'landscape') {
									$temppimgheight = $slidewidth / 1.35;
									$slideheight = floor($temppimgheight);
						} else if($pimgratio == 'widelandscape') {
									$temppimgheight = $slidewidth / 2;
									$slideheight = floor($temppimgheight);
						} else {
									$slideheight = $slidewidth;
						}?>
				<div id="carouselcontainer" class="rowtight">
            	<div id="portfolio-carousel" class="clearfix caroufedselclass <?php echo $pstyleclass;?> <?php echo $phoverstyleclass;?>">
                 <?php 
				$temp = $wp_query; 
				  $wp_query = null; 
				  $wp_query = new WP_Query();
				  $wp_query->query(array('orderby' => $bp_orderby,'order' => $bp_order,'post_type' => 'portfolio','portfolio-type'=> $bp_cat_slug,'post__not_in' => array($post->ID),'posts_per_page' => '8'));
					if ( $wp_query ) : 
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<div class="<?php echo $itemsize; ?> kad_portfolio_item">
					<div class="portfolio-item grid_item postclass kad-light-gallery">
                        <?php
								if (has_post_thumbnail( $post->ID ) ) {
									$image_url = wp_get_attachment_image_src( 
									get_post_thumbnail_id( $post->ID ), 'full' ); 
									$thumbnailURL = $image_url[0]; 
									 $image = aq_resize($thumbnailURL, $slidewidth, $slideheight, true);

									if(empty($image)) {$image = $thumbnailURL;} ?>
									<div class="portfolio-imagepadding">
										<div class="portfolio-hoverclass">
											<a href="<?php the_permalink() ?>" class="">
	                                       <img src="<?php echo esc_attr($image); ?>" alt="<?php the_title(); ?>" class="kad-lightboxhover">
	                                       <div class="portfolio-hoverover"></div>
	                                       <div class="portfolio-table">
	                                       		<div class="portfolio-cell">
	                                       			<?php if($pstyleclass == "padded_style" ) { ?>
		                                       				<a href="<?php the_permalink() ?>" class="kad-btn kad-btn-primary"><?php echo __('View details', 'pinnacle');?></a>
		                                       				<?php if($plb) {?><a href="<?php echo esc_attr($thumbnailURL); ?>" class="kad-btn kad-btn-primary plightbox-btn" title="<?php the_title();?>" rel="lightbox"><i class="kt-icon-search4"></i></a><?php } ?>
		                                       		<?php } elseif($pstyleclass == "flat-no-margin" || $pstyleclass == "flat-w-margin" ) { ?>
		                                       				<h5><?php the_title();?></h5>
                           									<?php if($portfolio_item_types == true) { $terms = get_the_terms( $post->ID, 'portfolio-type' ); if ($terms) {?> <p class="cportfoliotag"><?php $output = array(); foreach($terms as $term){ $output[] = $term->name;} echo implode(', ', $output); ?></p> <?php } } ?>
		                                       				<?php if($showexcerpt) {?> <p class="p_excerpt"><?php echo pinnacle_excerpt(16); ?></p> <?php } ?>
		                                       				<?php if($plb) {?><a href="<?php echo esc_attr($thumbnailURL); ?>" class="kad-btn kad-btn-primary plightbox-btn" title="<?php the_title();?>" rel="lightbox"><i class="kt-icon-search4"></i></a><?php }?>
		                                       		<?php } ?>
		                                       </div>
	                                       </div>
	                                   </a>
	                                   </div>
	                                </div>
	                                <?php $image = null; $thumbnailURL = null;?>
                           <?php } ?>
                           <?php if($pstyleclass == "padded_style" ) { ?>
              		<a href="<?php the_permalink() ?>" class="portfoliolink">
	              		<div class="piteminfo">   
	                          <h5><?php the_title();?></h5>
	                           <?php if($portfolio_item_types == true) { $terms = get_the_terms( $post->ID, 'portfolio-type' ); if ($terms) {?> <p class="cportfoliotag"><?php $output = array(); foreach($terms as $term){ $output[] = $term->name;} echo implode(', ', $output); ?></p> <?php } } ?>
	                          <?php if($showexcerpt == true) {?> <p><?php echo pinnacle_excerpt(16); ?></p> <?php } ?>
	                    </div>
                	</a>
                	<?php } ?>
                </div>
                    </div>
					<?php endwhile; else: ?>
					 
					<li class="error-not-found"><?php _e('Sorry, no portfolio entries found.', 'virtue');?></li>
						
				<?php endif; ?>	
                <?php 
					  $wp_query = null; 
					  $wp_query = $temp;  // Reset
					?>
                    <?php wp_reset_query(); ?>
													
			</div>
		</div>
     <div class="clearfix"></div>
            <a id="prevport_portfolio" class="prev_carousel icon-angle-left" href="#"></a>
			<a id="nextport_portfolio" class="next_carousel icon-angle-right" href="#"></a>
            </div>
</div><!-- Porfolio Container-->	
<script type="text/javascript">
	 jQuery( window ).load(function () {
	 	var $wcontainer = jQuery('#carouselcontainer');
	 	var $container = jQuery('#portfolio-carousel');
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
	 				function initCarousel_bottomportfolio() {
	 				$container.carouFredSel({
							scroll: { items:1,easing: "swing", duration: 700, pauseOnHover : true},
							auto: {play: true, timeoutDuration: 9000},
							prev: '#prevport_portfolio',
							next: '#nextport_portfolio',
							pagination: false,
							swipe: true,
								items: {visible: null
								}
						});
	 				}
	 				setWidths();
	 				initCarousel_bottomportfolio();
		 			jQuery(window).on("debouncedresize", function( event ) {
						$container.trigger("destroy");
						setWidths();
						initCarousel_bottomportfolio()
						});
});
</script>				