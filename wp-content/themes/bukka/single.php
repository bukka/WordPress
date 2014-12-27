<?php get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
			
				<div class="entry-content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bukka' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'bukka' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
				
				<?php $children = get_children( array('post_parent' => $post->ID, 'post_type' => 'project' ) ); ?>
				<?php if ( ! empty($children ) ): ?>
				<div class="entry-posts">Posts</div>
				<?php foreach ( get_children( array('post_parent' => $post->ID, 'post_type' => 'project' ) ) as $child ): ?>
				<header class="entry-header">
					<a href="<?php echo get_permalink( $child->ID ); ?>" title="<?php esc_attr(  the_title_attribute( 'post=' . $child->ID ) ); ?>" 
						rel="bookmark" class="entry-title"><?php echo get_the_title( $child->ID ); ?></a>
					<div class="entry-date"><?php echo mysql2date( "j F Y", $child->post_date ); ?></div>
				</header><!-- .entry-header -->
		
				<div class="entry-summary">
					<?php echo apply_filters( 'get_the_excerpt', $child->post_excerpt ); ?>
				</div><!-- .entry-summary -->
				<?php endforeach; ?>
				<?php endif; ?>
				
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>