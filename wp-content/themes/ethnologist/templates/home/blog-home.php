<div class="home_blog home-margin clearfix home-padding">
<?php
global $pinnacle, $postcolumn, $wp_query;

$animate = ( isset( $pinnacle['pinnacle_animate_in'] ) && $pinnacle['pinnacle_animate_in'] == 1 ) ? 1 : 0;
$blogcount = isset( $pinnacle['home_post_count'] ) ? $pinnacle['home_post_count'] : 3;
$blog_grid_column = isset( $pinnacle['home_post_column'] ) ? $pinnacle['home_post_column'] : 3;

?>
	<div class="clearfix"><h3 class="hometitle"><?php pll_e( 'Latest from the Blog' ); ?></h3></div>
	<div id="kad-blog-grid" class="row" data-fade-in="<?php echo $animate;?>">
<?php

if ( $blog_grid_column == '2' ) {
	$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12';
	$postcolumn = '2';
} else if ( $blog_grid_column == '3' ) {
	$itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12';
	$postcolumn = '3';
} else {
	$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12';
	$postcolumn = '4';
}

if ( ! empty( $pinnacle['home_post_type'] ) ) {
	$blog_cat = get_term_by( 'id', $pinnacle['home_post_type'], 'category' );
	$blog_cat_slug = $blog_cat->slug;
} else {
	$blog_cat_slug = '';
}

$temp = $wp_query;
$wp_query = new WP_Query();
$wp_query->query( array(
	'posts_per_page' => $blogcount,
	'category_name'  => $blog_cat_slug
) );

if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
		<div class="<?php echo $itemsize;?> b_item kad_blog_item">
			<?php get_template_part('templates/content', 'post-grid');?>
		</div>
<?php endwhile; else: ?>
		<div class="error-not-found"><?php pll_e( 'Sorry, no entries found.' ); ?></div>
<?php endif; ?>

<?php
$wp_query = $temp;
wp_reset_query();
?>

	</div> <!-- #kad-blog-grid -->
</div> <!--.home-blog -->
<script type="text/javascript">
jQuery( window ).load( function($) {
	$( '#kad-blog-grid' ).masonry({
		itemSelector: '.b_item'
	});
});
</script>
