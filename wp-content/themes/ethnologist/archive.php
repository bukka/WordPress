<?php get_header(); ?>
<?php get_template_part( 'templates/page', 'header' ); ?>

<div id="content" class="container">
	<div class="row">
		<div class="main <?php echo ethnologist_main_class(); ?>  postlist" role="main">
			<?php $wp_query->set( 'post_type', array( 'post', 'interview', 'section' ) ); $wp_query->get_posts(); ?>
			<?php if ( ! have_posts() ) : ?>
				<div class="alert">
					<?php etn_e( 'Sorry, no entries found.' ); ?>
				</div>
				<?php get_search_form(); ?>
			<?php endif; ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'templates/content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php if ( $wp_query->max_num_pages > 1 ) : ?>
				<nav class="post-nav">
					<ul class="pager">
						<li class="previous"><?php next_posts_link( etn__( '&larr; Older posts' ) ); ?></li>
						<li class="next"><?php previous_posts_link( etn__( 'Newer posts &rarr;' ) ); ?></li>
					</ul>
				</nav>
			<?php endif; ?>

		</div><!-- /.main -->
		<?php get_sidebar(); ?>
	</div><!-- /.row-->
</div><!-- /.content -->

</div><!-- /.wrap -->
<?php get_footer(); ?>
