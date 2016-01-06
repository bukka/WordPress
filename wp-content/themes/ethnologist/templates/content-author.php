<div class="main <?php echo kadence_main_class(); ?>" role="main">
	<article <?php post_class('postclass'); ?>>
		<div class="entry-content clearfix">
			<?php echo ethnologist_author_content(); ?>
		</div>
		<?php ethnologist_facebook_like_button( array( 'href' => get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ); ?>
	</article>
</div>