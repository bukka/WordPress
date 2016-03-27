<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">Comments</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 32,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'ethnologist' ); ?></h2>
			<div class="nav-links">
				<?php if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'ethnologist' ) ) ) : ?>
					<div class="nav-previous"><?php echo $prev_link ?></div>
				<?php endif; ?>

				<?php if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'ethnologist' ) ) ) : ?>
					<div class="nav-next"><?php echo $next_link ?></div>
				<?php endif; ?>
			</div><!-- .nav-links -->
		</nav><!-- .comment-navigation -->
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'twentyfifteen' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- .comments-area -->
