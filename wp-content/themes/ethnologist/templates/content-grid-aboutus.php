<div id="post-<?php the_ID(); ?>" class="blog_item postclass kad_blog_fade_in grid_item">
<?php
if ( has_post_thumbnail( $post->ID ) ) {
	$image_width = 382;
	$image_height = 255;
	$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$thumbnailURL = $image_url[0];
	$image = aq_resize( $thumbnailURL, $image_width, $image_height, true );
	if ( empty($image) ) {
		$image = $thumbnailURL;
	}
} else {
	$image = pinnacle_img_placeholder();
}
?>
	<div class="imghoverclass img-margin-center">
		<img src="<?php echo esc_attr($image); ?>" alt="<?php the_title(); ?>" class="iconhover" style="display:block;">
	</div>
	<div class="postcontent">
		<header>
			<a href="<?php the_permalink() ?>"><h5><?php the_title(); ?></h5></a>
		</header>
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div>
	</div><!-- Text size -->
</div> <!-- Blog Item -->