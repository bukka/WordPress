<div class="main <?php echo kadence_main_class(); ?>" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class( 'postclass' ); ?>>
		<div class="entry-content ethnologist-interview-content clearfix">
			<?php the_content(); ?>
		</div>
		<footer class="single-footer clearfix">
			<?php get_template_part( 'templates/entry', 'meta-subhead' ); ?>
			<?php get_template_part( 'templates/entry', 'meta-footer' ); ?>
		</footer>
	</article>

   	<?php // comments_template('/templates/comments.php'); ?>
	<?php endwhile; ?>
</div>

