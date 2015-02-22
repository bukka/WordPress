<?php
/*
Template Name: Sections
*/

get_header();
get_template_part('templates/page', 'header');

?>
<div id="content" class="container">
	<div class="row">
<?php

if ( kadence_display_sidebar() ) {
	$display_sidebar = true;
	$fullclass = '';
} else {
	$display_sidebar = false;
	$fullclass = 'fullwidth';
}

global $post;

if( get_post_meta( $post->ID, '_kad_blog_summery', true ) == 'full' ) {
	$summery = 'full';
	$postclass = "single-article fullpost";
} else {
	$summery = 'normal';
	$postclass = 'postlist';
}
?>
		<div class="main <?php echo kadence_main_class();?> <?php echo $postclass . ' ' . $fullclass; ?>" role="main">
<?php
get_template_part('templates/content', 'page');

global $post;
$blog_category = get_post_meta( $post->ID, '_kad_blog_cat', true );
$blog_cat = get_term_by( 'id', $blog_category, 'category' );
if ( $blog_category == '-1' || $blog_category == '' ) {
	$blog_cat_slug = '';
} else {
	$blog_cat = get_term_by( 'id', $blog_category, 'category' );
	$blog_cat_slug = $blog_cat->slug;
}
$blog_items = get_post_meta( $post->ID, '_kad_blog_items', true );
if ( $blog_items == 'all') {
	$blog_items = '-1';
}

$temp = $wp_query;
$wp_query = new WP_Query();
$wp_query->query(array(
	'paged'          => $paged,
	'category_name'  => $blog_cat_slug,
	'posts_per_page' => $blog_items,
	'post_type'      => 'section',
));
$count =0;
if ( $wp_query->have_posts() ) {
	while ( $wp_query->have_posts() ) {
		$wp_query->the_post();
		if ( $summery == 'full' ) {
			if ( $display_sidebar ){
				get_template_part( 'templates/content', 'fullpost' );
			} else {
				get_template_part( 'templates/content', 'fullpostfull' );
			}
		} else {
			if ( $display_sidebar ){
				get_template_part( 'templates/content', get_post_format() );
			} else {
				get_template_part( 'templates/content', 'fullwidth' );
			}
		}
	}
} else { ?>
			<li class="error-not-found"><?php _e( 'Sorry, no sections found.', 'ethnologist' ); ?></li>
<?php
}

if ( $wp_query->max_num_pages > 1 ) {
	if ( function_exists ( 'kad_wp_pagenavi' ) ) {
		kad_wp_pagenavi();
	} else { ?>
			<nav class="post-nav">
				<ul class="pager">
					<li class="previous"><?php next_posts_link( __( '&larr; Older posts', 'ethnologist' ) ); ?></li>
					<li class="next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'ethnologist' ) ); ?></li>
				</ul>
			</nav>
<?php
	}
}
$wp_query = null;
$wp_query = $temp;  // Reset
wp_reset_query();
?>
		</div><!-- /.main -->
<?php get_sidebar(); ?>
	</div><!-- /.row-->
</div><!-- /.content -->
</div><!-- /.wrap -->
<?php
get_footer();
