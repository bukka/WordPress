<div class="main <?php echo kadence_main_class(); ?>" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class( 'postclass' ); ?>>
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		<div class="entry-content clearfix">
			<?php the_content(); ?>
		</div>
		<footer class="single-footer clearfix">
			<?php get_template_part( 'templates/entry', 'meta-footer' ); ?>
		</footer>
	</article>
	<?php endwhile; ?>
</div>

