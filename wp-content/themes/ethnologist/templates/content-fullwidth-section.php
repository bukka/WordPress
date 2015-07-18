<article id="post-<?php the_ID(); ?>" <?php post_class('kad_blog_item postclass kad-animation'); ?> data-animation="fade-in" data-delay="0">
	<div class="row">
		<div class="col-md-12 postcontent">
			<header>
				<a href="<?php the_permalink() ?>"><h3 class="entry-title"><?php the_title(); ?></h3></a>
			</header>
			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div>
		</div><!-- Text size -->
		<div class="col-md-12 postfooterarea">
			<footer class="clearfix">
				<?php get_template_part('templates/entry', 'meta-footer'); ?>
			</footer>
		</div>
	</div><!-- row-->
</article> <!-- Article -->