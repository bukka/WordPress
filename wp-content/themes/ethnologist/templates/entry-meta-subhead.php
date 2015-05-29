<div class="subhead">
	<span class="postauthortop author vcard">
		<?php pll_e( 'by' ); ?>
		<a href="<?php echo esc_attr( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
			class="fn" rel="author"><?php echo get_the_author() ?></a>
	</span>
	<span class="updated postdate">
		<?php pll_e( 'on' ); ?>
		<span class="postday"><?php echo get_the_date( pll__( 'ethnologist_post_date' ) ) ?></span>
	</span>
	<span class="postcommentscount">
		<?php pll_e( 'with' ); ?>
		<a href="<?php the_permalink();?>#post_comments"><?php comments_number(); ?></a>
    </span>
</div>