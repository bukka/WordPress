<div id="content" class="container homepagecontent">
	<div class="row">
		<div class="main <?php echo ethnologist_main_class(); ?>" role="main">

			<?php foreach ( $params['lists'] as $list ): ?>
			<div class="home_blog home-margin clearfix home-padding">
				<div class="clearfix">
					<h3 class="hometitle"><?php echo $list['title']; ?></h3>
				</div>
				<div class="ethnologist-front-page-grid row" data-fade-in="<?php echo $list['animate'];?>">
					<?php $list_query = new WP_Query( $list['query_args'] ); ?>
					<?php if ( $list_query->have_posts() ) : ?>
					<?php   while ( $list_query->have_posts() ) : $list_query->the_post(); ?>
					<div class="<?php echo $list['grid_style']; ?> b_item kad_blog_item">
						<?php get_template_part('templates/content', 'post-grid');?>
					</div>
					<?php   endwhile; ?>
					<?php else: ?>
					<div class="error-not-found"><?php pll_e( 'Sorry, no entries found.' ); ?></div>
					<?php endif; ?>
				</div><!-- .ethnologist-front-page-grid -->
			</div><!--.home-blog -->
			<?php endforeach; ?>

		</div><!-- /.main -->
		<?php get_sidebar(); ?>
	</div><!-- /.row-->
</div><!-- /.content -->

</div><!-- /.wrap -->

<script type="text/javascript">
jQuery( window ).load( function($) {
	$( '.ethnologist-front-page-grid' ).masonry({
		itemSelector: '.b_item'
	});
});
</script>