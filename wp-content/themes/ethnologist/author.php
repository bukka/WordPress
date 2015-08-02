<?php get_header(); ?>

	<?php query_posts( ethnologist_author_query_args() ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'templates/header', 'author' ); ?>

	<div id="content" class="container">
		<div class="row single-article">
			<?php get_template_part( 'templates/content', 'author' ); ?>
			<?php get_sidebar(); ?>
		</div><!-- /.row-->
	</div><!-- /.content -->

	<?php endwhile; ?>
</div><!-- /.wrap -->
<?php get_footer(); ?>