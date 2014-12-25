	<?php
/*
Template Name: Portfolio Grid
*/
?>
	<?php get_header(); ?>
		<?php get_template_part('templates/page', 'header'); ?>
	
      	<?php global $post, $pinnacle;
	      	$portfolio_category = get_post_meta( $post->ID, '_kad_portfolio_type', true );
	      	$portfolio_style = get_post_meta( $post->ID, '_kad_portfolio_style', true ); if(empty($portfolio_style) || $portfolio_style == 'default') {
		      		if(isset($pinnacle['portfolio_style_default'])) {
		      			$pstyleclass = $pinnacle['portfolio_style_default'];
		      		} else {
		      			$pstyleclass = 'padded_style';
		      		}
	      		} else {$pstyleclass = $portfolio_style;}
	      	$portfolio_hover_style = get_post_meta( $post->ID, '_kad_portfolio_hover_style', true ); if(empty($portfolio_hover_style) || $portfolio_hover_style == 'default') {
		      		if(isset($pinnacle['portfolio_hover_style_default'])) {
		      			$phoverstyleclass = $pinnacle['portfolio_hover_style_default'];
		      		} else {
		      			$phoverstyleclass = 'p_lightstyle';
		      		}
	      		} else {$phoverstyleclass = $portfolio_hover_style;}
			$portfolio_items = get_post_meta( $post->ID, '_kad_portfolio_items', true );
			$portfolio_column = get_post_meta( $post->ID, '_kad_portfolio_columns', true ); 
            $portfolio_ratio = get_post_meta( $post->ID, '_kad_portfolio_img_ratio', true );
            $pie = get_post_meta( $post->ID, '_kad_portfolio_item_excerpt', true ); if(!empty($pie) && $pie == "on") {$showexcerpt = true;} else {$showexcerpt = false;}
            $portfolio_item_types = get_post_meta( $post->ID, '_kad_portfolio_item_types', true );
			$portfolio_lightbox = get_post_meta( $post->ID, '_kad_portfolio_lightbox', true ); if (!empty($portfolio_lightbox) && $portfolio_lightbox == 'on'){$plb = true;} else {$plb = false;}
			$portfolio_order = get_post_meta( $post->ID, '_kad_portfolio_order', true ); if(isset($portfolio_order)) {$p_orderby = $portfolio_order;} else {$p_orderby = 'menu_order';}
			   	if($p_orderby == 'menu_order') {$p_order = 'ASC';} else {$p_order = 'DESC';}
				if($portfolio_category == '-1' || empty($portfolio_category)) { $portfolio_cat_slug = ''; $portfolio_cat_ID = ''; } else {
						$portfolio_cat = get_term_by ('id',$portfolio_category,'portfolio-type' );
						$portfolio_cat_slug = $portfolio_cat -> slug;
						$portfolio_cat_ID = $portfolio_cat -> term_id;
				}
				$portfolio_category = $portfolio_cat_slug;
				if($portfolio_items == 'all') { $portfolio_items = '-1'; }
                   	 if(empty($portfolio_ratio) || $portfolio_ratio == 'default') {
                   	 		if(isset($pinnacle['portfolio_ratio_default'])) {
                   	 			$pimgratio = $pinnacle['portfolio_ratio_default'];
                   	 		} else {
                   	 			$pimgratio = "square";
                   	 		}
                   	 } else {
                   	 	$pimgratio = $portfolio_ratio;
                   	 }
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
						}
		?>
	<div id="content" class="container">
   	<div class="row">
      <div class="main <?php echo kadence_main_class(); ?>" role="main">
		<div class="container"><?php get_template_part('templates/content', 'page'); ?></div>              

            <div id="portfoliowrapper" class="rowtight <?php echo $pstyleclass;?> <?php echo $phoverstyleclass;?>"> 
   
            <?php 
				$temp = $wp_query; 
				  $wp_query = null; 
				  $wp_query = new WP_Query();
				  $wp_query->query(array(
					'paged' => $paged,
					'orderby' => $p_orderby,
					'order' => $p_order,
					'post_type' => 'portfolio',
					'portfolio-type'=>$portfolio_cat_slug,
					'posts_per_page' => $portfolio_items));
					$count =0;
					
					if ( $wp_query ) : 
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<div class="<?php echo $itemsize;?> p-item">
                	<div class="portfolio-item grid_item postclass kad-light-gallery kad_portfolio_fade_in">
                        <?php if (has_post_thumbnail( $post->ID ) ) {
									$image_url = wp_get_attachment_image_src( 
									get_post_thumbnail_id( $post->ID ), 'full' ); 
									$thumbnailURL = $image_url[0]; 
									 $image = aq_resize($thumbnailURL, $slidewidth, $slideheight, true);

									if(empty($image)) {$image = $thumbnailURL;} ?>
									<div class="portfolio-imagepadding">
										<div class="portfolio-hoverclass">
											<a href="<?php the_permalink() ?>" class="">
	                                       <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" class="kad-lightboxhover">
	                                       <div class="portfolio-hoverover"></div>
	                                       <div class="portfolio-table">
	                                       		<div class="portfolio-cell">
	                                       			<?php if($pstyleclass == "padded_style" ) { ?>
		                                       				<a href="<?php the_permalink() ?>" class="kad-btn kad-btn-primary"><?php echo __('View details', 'pinnacle');?></a>
		                                       				<?php if($plb) {?><a href="<?php echo $thumbnailURL; ?>" class="kad-btn kad-btn-primary plightbox-btn" title="<?php the_title();?>" rel="lightbox"><i class="icon-search"></i></a><?php } ?>
		                                       		<?php } elseif($pstyleclass == "flat-no-margin" || $pstyleclass == "flat-w-margin" ) { ?>
		                                       				<h5><?php the_title();?></h5>
                           									<?php if($portfolio_item_types == true) { $terms = get_the_terms( $post->ID, 'portfolio-type' ); if ($terms) {?> <p class="cportfoliotag"><?php $output = array(); foreach($terms as $term){ $output[] = $term->name;} echo implode(', ', $output); ?></p> <?php } } ?>
		                                       				<?php if($showexcerpt) {?> <p class="p_excerpt"><?php echo pinnacle_excerpt(16); ?></p> <?php } ?>
		                                       				<?php if($plb) {?><a href="<?php echo $thumbnailURL; ?>" class="kad-btn kad-btn-primary plightbox-btn" title="<?php the_title();?>" rel="lightbox"><i class="icon-search"></i></a><?php }?>
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
					 
					<li class="error-not-found"><?php _e('Sorry, no portfolio entries found.', 'pinnacle');?></li>
						
				<?php endif; ?>
                </div> <!--portfoliowrapper-->
                                    
                    <?php if ($wp_query->max_num_pages > 1) : ?>
                            <?php if(function_exists('kad_wp_pagenavi')) { ?>
                            <?php kad_wp_pagenavi(); ?>   
                            <?php } else { ?>      
                            <nav id="post-nav" class="pager">
                                <div class="previous"><?php next_posts_link(__('&larr; Older posts', 'pinnacle')); ?></div>
                                <div class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'pinnacle')); ?></div>
                              </nav>
                            <?php } ?> 
                    <?php endif; ?>
                    <?php 
                      $wp_query = null; 
                      $wp_query = $temp;  // Reset
                    ?>
                    <?php wp_reset_query(); ?>
</div><!-- /.main -->
<?php get_sidebar(); ?>
      </div><!-- /.row-->
    </div><!-- /.content -->
  </div><!-- /.wrap -->
  <?php get_footer(); ?>