<div class="kad_img_upload_widget">
	<?php if ( $params['post'] ): ?>
	<a href="<?php get_permalink( $params['post'] ); ?>">
		<?php echo get_the_post_thumbnail( $params['post'] ); ?>
	</a>
	<div class="ethnologist-editors-pick-post-title">
		<a href="<?php echo get_permalink( $params['post'] ); ?>">
			<?php echo $params['post']->post_title; ?>
		</a>
	</div>
	<?php endif; ?>
</div>