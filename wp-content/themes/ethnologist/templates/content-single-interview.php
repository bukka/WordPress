<div class="main <?php echo kadence_main_class(); ?>" role="main">
	<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class('postclass'); ?>>
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php get_template_part('templates/entry', 'meta-subhead'); ?>
		</header>
		<div class="entry-content ethnologist-interview-content clearfix">
			<?php the_content(); ?>
			<?php the_field( 'interview' ); ?>
		</div>
		<footer class="single-footer clearfix">
			<?php get_template_part('templates/entry', 'meta-footer'); ?>
		</footer>
	</article>

   	<?php // comments_template('/templates/comments.php'); ?>
	<?php endwhile; ?>
</div>

