<div id="post-<?php the_ID(); ?>" class="blog_item postclass kad_blog_fade_in grid_item">
	<div class="postcontent">
		<header>
			<a href="<?php the_permalink() ?>"><h5><?php the_title(); ?></h5></a>
			<?php get_template_part('templates/entry', 'meta-subhead'); ?>
		</header>
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div>
		<footer class="clearfix">
			<?php get_template_part('templates/entry', 'meta-footer'); ?>
		</footer>
	</div><!-- Text size -->
</div> <!-- Blog Item -->