<div class="ethnologist-grid row" data-fade-in="<?php echo $params['list']['animate'];?>">
	<?php $list_query = new WP_Query( $params['list']['query_args'] ); ?>
	<?php if ( $list_query->have_posts() ) : ?>
	<?php   while ( $list_query->have_posts() ) : $list_query->the_post(); ?>
	<div class="<?php echo $params['list']['grid_style']; ?> b_item kad_blog_item">
		<?php get_template_part ( 'templates/content', $params['list']['template'] );?>
	</div>
	<?php   endwhile; ?>
	<?php else: ?>
	<div class="error-not-found"><?php pll_e( 'Sorry, no entries found.' ); ?></div>
	<?php endif; ?>
</div><!-- .ethnologist-grid -->