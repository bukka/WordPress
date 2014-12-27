	<div id="primary" class="site-content">
		<div id="content" role="main">
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<header class="entry-header">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(  the_title_attribute( 'echo=0' ) ); ?>" 
						rel="bookmark" class="entry-title"><?php the_title(); ?></a>
					<div class="entry-date"><?php echo get_the_date("j F Y"); ?></div>
				</header><!-- .entry-header -->
		
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
			<?php endwhile; ?>
			
			<?php bukka_pagination(); ?>
		<?php else : ?>

			<article id="post-0" class="post no-results not-found">

				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing to show', 'bukka' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'bukka' ); ?></p>
				</div><!-- .entry-content -->

			</article><!-- #post-0 -->

		<?php endif; // end have_posts() check ?>

		</div><!-- #content -->
	</div><!-- #primary -->