<ul>
	<?php  while ( $params['query']->have_posts() ) : $params['query']->the_post(); ?>
	<li class="clearfix postclass">
		<a href="<?php the_permalink() ?>"
			title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"
			class="recentpost_featimg">
			<?php if ( has_post_thumbnail() ): ?>
			<?php the_post_thumbnail( 'widget-thumb' ); ?>
			<?php else: ?>
			<img width="60" height="60" src="'.pinnacle_img_placeholder_small().'" class="attachment-widget-thumb wp-post-image" alt="">
			<?php endif; ?>
		</a>
		<a href="<?php the_permalink() ?>"
			title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"
			class="recentpost_title">
			<?php if ( get_the_title() ) the_title(); else the_ID(); ?>
		</a>
		<span class="recentpost_date color_gray"><?php echo get_the_date( pll__( 'ethnologist_post_date' ) ); ?></span>
	</li>
	<?php endwhile; ?>
</ul>
