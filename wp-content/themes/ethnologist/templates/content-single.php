<div class="main <?php echo kadence_main_class(); ?>" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class( 'postclass' ); ?>>
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php get_template_part( 'templates/entry', 'meta-subhead' ); ?>
		</header>
		<div class="entry-content clearfix">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<nav class="page-nav"><p>' . etn__( 'Pages:' ), 'after' => '</p></nav>' ) ); ?>
		</div>
		<footer class="single-footer clearfix">
			<?php get_template_part( 'templates/entry', 'meta-footer' ); ?>
		</footer>
		<?php ethnologist_facebook_like_button(); ?>
	</article>
	<?php // comments_template('/templates/comments.php'); ?>
	<?php endwhile; ?>
</div>

