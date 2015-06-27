<?php

/**
 * Ethnologist Template class
 */
class Ethnologist_Template
{
	/**
	 * Render template
	 */
	public function render() {
		global $post, $wp_query, $paged;

		get_header();
		get_template_part('templates/page', 'header');

		$params = array();

		if ( kadence_display_sidebar() ) {
			$params['display_sidebar'] = true;
			$params['fullclass'] = '';
		} else {
			$params['disaplay_sidebar'] = false;
			$params['fullclass'] = 'fullwidth';
		}

		if( get_post_meta( $post->ID, '_kad_blog_summery', true ) == 'full' ) {
			$params['summery'] = 'full';
			$params['postclass'] = "single-article fullpost";
		} else {
			$params['summery']= 'normal';
			$params['postclass'] = 'postlist';
		}

		?>
		<div id="content" class="container">
			<div class="row">
				<div class="main <?php echo kadence_main_class();?> <?php echo $params['postclass'] . ' ' . $params['fullclass']; ?>" role="main">
		<?php
		get_template_part('templates/content', 'page');

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
			'post_type'      => $this->get_post_type(),
		));
		$count =0;
		if ( $wp_query->have_posts() ) {
			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();
				if ( $params['summery'] == 'full' ) {
					if ( $params['disaplay_sidebar'] ){
						get_template_part( 'templates/content', 'fullpost' );
					} else {
						get_template_part( 'templates/content', 'fullpostfull' );
					}
				} else {
					if ( $params['disaplay_sidebar'] ){
						get_template_part( 'templates/content', get_post_format() );
					} else {
						get_template_part( 'templates/content', 'fullwidth' );
					}
				}
			}
		} else { ?>
					<div class="error-not-found"><?php echo $this->get_not_found_message(); ?></div>
		<?php
		}

		if ( $wp_query->max_num_pages > 1 ) {
			if ( function_exists ( 'kad_wp_pagenavi' ) ) {
				kad_wp_pagenavi();
			} else { ?>
					<nav class="post-nav">
						<ul class="pager">
							<li class="previous"><?php next_posts_link( pll__( '&larr; Older posts' ) ); ?></li>
							<li class="next"><?php previous_posts_link( pll__( 'Newer posts &rarr;' ) ); ?></li>
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

	}

	/**
	 * Get post type
	 *
	 * @return string
	 */
	protected function get_post_type() {
		return 'post';
	}

	/**
	 * Get message when there are no items
	 *
	 * @return string
	 */
	protected function get_not_found_message() {
		return pll__( 'Sorry, no entries found.' );
	}
}