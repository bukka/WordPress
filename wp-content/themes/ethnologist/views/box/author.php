<div class="author-box">
	<ul class="nav nav-tabs" id="authorTab">
		<li class="active"><a href="#about"><?php etn_e( 'About Author' ); ?></a></li>
		<li><a href="#latest"><?php etn_e( 'Latest Posts' ); ?></a></li>
	</ul>

	<div class="tab-content postclass">
		<div class="tab-pane clearfix active" id="about">
			<div class="author-profile vcard">
				<?php echo get_avatar( get_the_author_meta('ID'), 80 ); ?>
				<div class="author-follow">
					<span class="followtext"><?php etn_e( 'Follow' ); ?> <?php the_author_meta( 'display_name' ); ?>:</span>
					<?php if ( get_the_author_meta( 'facebook' ) ) { ?>
					<span class="facebooklink">
						<a href="<?php the_author_meta( 'facebook' ); ?>"
							title="<?php etn_e( 'Follow' ); ?>  <?php the_author_meta( 'display_name' ); ?> <?php etn_e( 'on Facebook' );?>">
							<i class="icon-facebook"></i>
						</a>
					</span>
					<?php } if ( get_the_author_meta( 'twitter' ) ) { ?>
					<span class="twitterlink">
						<a href="http://twitter.com/<?php the_author_meta( 'twitter' ); ?>" title="<?php etn_e( 'Follow' ); ?>  <?php the_author_meta( 'display_name' ); ?> <?php etn_e( 'on Twitter' );?>"><i class="icon-twitter"></i></a>
					</span>
					<?php } if ( get_the_author_meta( 'google' ) ) { ?>
					<span class="googlepluslink">
						<a href="<?php the_author_meta( 'google' ); ?>" title="<?php etn_e( 'Follow' ); ?>  <?php the_author_meta( 'display_name' ); ?> <?php etn_e( 'on Google Plus' );?>"><i class="icon-google-plus"></i></a>
					</span>
					<?php } if ( get_the_author_meta( 'flickr' ) ) { ?>
					<span class="flickrlink">
						<a href="<?php the_author_meta( 'flickr' ); ?>" title="<?php etn_e( 'Follow' ); ?>  <?php the_author_meta( 'display_name' ); ?> <?php etn_e( 'on Flickr' );?>"><i class="icon-flickr2"></i></a>
					</span>
					<?php } if ( get_the_author_meta( 'vimeo' ) ) { ?>
					<span class="vimeolink">
						<a href="<?php the_author_meta( 'vimeo' ); ?>" title="<?php etn_e( 'Follow' ); ?>  <?php the_author_meta( 'display_name' ); ?> <?php etn_e( 'on Vimeo' );?>"><i class="icon-vimeo"></i></a>
					</span>
					<?php } if ( get_the_author_meta( 'linkedin' ) ) { ?>
					<span class="linkedinlink">
						<a href="<?php the_author_meta( 'linkedin' ); ?>" title="<?php etn_e( 'Follow' ); ?>  <?php the_author_meta( 'display_name' ); ?> <?php etn_e( 'on linkedin' );?>"><i class="icon-linkedin"></i></a>
					</span>
					<?php } if ( get_the_author_meta( 'dribbble' ) ) { ?>
					<span class="dribbblelink">
						<a href="<?php the_author_meta( 'dribbble' ); ?>" title="<?php etn_e( 'Follow' ); ?>  <?php the_author_meta( 'display_name' ); ?> <?php etn_e( 'on Dribbble' );?>"><i class="icon-dribbble"></i></a>
					</span>
					<?php } if ( get_the_author_meta( 'pinterest' ) ) { ?>
					<span class="pinterestlink">
						<a href="<?php the_author_meta( 'pinterest' ); ?>" title="<?php etn_e( 'Follow' ); ?>  <?php the_author_meta( 'display_name' ); ?> <?php etn_e( 'on Pinterest' );?>"><i class="icon-pinterest"></i></a>
					</span>
	      			<?php } if ( get_the_author_meta( 'instagram' ) ) { ?>
					<span class="instagramlink">
						<a href="<?php the_author_meta( 'instagram' ); ?>" title="<?php etn_e( 'Follow' ); ?>  <?php the_author_meta( 'display_name' ); ?> <?php etn_e( 'on Instagram' );?>"><i class="icon-instagram"></i></a>
					</span>
					<?php } ?>
				</div><!--Author Follow-->

				<h5 class="author-name"><?php the_author_posts_link(); ?></h5>
				<?php if ( get_the_author_meta( 'occupation' ) ) { ?>
				<p class="author-occupation"><strong><?php the_author_meta( 'occupation' ); ?></strong></p>
				<?php } ?>
				<p class="author-description author-bio">
					<?php the_author_meta( 'description' ); ?>
				</p>
			</div>
		</div><!--pane-->
		<div class="tab-pane clearfix" id="latest">
			<div class="author-latestposts">
				<?php echo get_avatar( get_the_author_meta('ID'), 80 ); ?>
				<h5><?php etn_e( 'Latest posts from' ); ?> <?php the_author_posts_link(); ?></h5>
				<ul>
<?php
global $authordata, $post;
$temp = null;
$wp_query = new WP_Query();
$wp_query->query(array(
	'author' => $authordata->ID,
	'posts_per_page' => 3
));
$count =0;
if ( $wp_query ) :
	while ( $wp_query->have_posts() ) : $wp_query->the_post();
?>
					<li><a href="<?php the_permalink();?>"><?php the_title(); ?></a><span class="recentpost-date"> - <?php echo get_the_time('F j, Y'); ?></span></li>
<?php
endwhile;
endif; // Reset
wp_reset_query();
?>
				</ul>
			</div><!--Latest Post -->
		</div><!--Latest pane -->
	</div><!--Tab content -->
</div><!--Author Box -->