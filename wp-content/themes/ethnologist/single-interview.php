<?php get_header(); ?>
	<?php get_template_part( 'templates/blog', 'post-header' ); ?>

	<div id="content" class="container">
		<div class="row single-article">
			<?php get_template_part( 'templates/content', 'single-interview' ); ?>
			<?php get_sidebar(); ?>
		</div><!-- /.row-->
	</div><!-- /.content -->

</div><!-- /.wrap -->
<?php get_footer(); ?>