<div id="content" class="container">
	<div class="row">
		<div class="main <?php echo $params['main_class'] ?>" role="main">
		<?php while (have_posts()) : the_post(); ?>
  			<?php the_content(); ?>
 			<?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
		<?php endwhile; ?>
		<?php if ( $params['query']->have_posts() ): ?>
		<?php 	while ( $params['query']->have_posts() ) : $params['query']->the_post(); ?>
			<?php get_template_part( 'templates/content', 'fullwidth' ); ?>
		<?php 	endwhile; ?>
		<?php 	if ($params['query']->max_num_pages > 1): ?>
			<?php kad_wp_pagenavi(); ?>
		<?php 	endif; ?>
		<?php else: ?>
			<div class="error-not-found"><?php echo $params['not_found_msg']; ?></div>
		<?php endif; ?>
		</div><!-- /.main -->
	</div><!-- /.row-->
</div><!-- /.content -->

</div><!-- /.wrap -->
