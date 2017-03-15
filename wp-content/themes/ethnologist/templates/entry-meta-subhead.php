<div class="subhead">
	<span class="postauthortop author vcard">
		<?php etn_e( 'by' ); ?>
		<a href="<?php echo ethnologist_author_href(); ?>"
			class="fn" rel="author">
			<?php echo get_the_author_meta( 'first_name' ) ?>
			<?php echo get_the_author_meta( 'last_name' ) ?>
		</a>
	</span>
	<?php if (ethnologist_post_with_date()): ?>
	<span class="updated postdate">
		<?php etn_e( 'on' ); ?>
		<span class="postday"><?php echo get_the_date( etn__( 'ethnologist_post_date' ) ) ?></span>
	</span>
	<?php endif; ?>
</div>