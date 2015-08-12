<div class="main <?php echo kadence_main_class(); ?>" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class( 'postclass' ); ?>>
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php if ( get_field( 'author_info' ) ): ?>
			<?php get_template_part( 'templates/entry', 'meta-subhead' ); ?>
			<?php endif; ?>
		</header>
		<div class="entry-content clearfix">
			<?php the_content(); ?>
		</div>
		<footer class="single-footer clearfix">
			<?php get_template_part( 'templates/entry', 'meta-footer' ); ?>
		</footer>
	</article>

	<?php 	$subquery = new WP_Query( array( 'post_parent' => get_the_ID(), 'post_type' => 'section', 'posts_per_page' => -1 ) ); ?>
	<?php 	while ( $subquery->have_posts() ): $subquery->the_post(); ?>
	<?php 		get_template_part( 'templates/content', 'fullwidth-section' ); ?>
	<?php 	endwhile; ?>
	<?php endwhile; ?>
</div>

