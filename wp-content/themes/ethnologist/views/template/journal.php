<div id="content" class="container">
	<div class="row single-article">
		<div class="main <?php echo ethnologist_main_class(); ?>" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'postclass' ); ?>>
				<div class="entry-content clearfix">
					<?php the_content(); ?>
				</div>
			</article>
			<?php endwhile; ?>
		</div>
		<?php get_sidebar(); ?>
	</div><!-- /.row-->
</div><!-- /.content -->

</div><!-- /.wrap -->