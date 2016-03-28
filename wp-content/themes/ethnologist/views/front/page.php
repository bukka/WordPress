<div id="content" class="container homepagecontent">
	<div class="row">
		<div class="main <?php echo ethnologist_main_class(); ?>" role="main">

			<?php foreach ( $params['lists'] as $list_idx => $list ): ?>
			<div class="home_blog home-margin clearfix home-padding">
				<div class="clearfix">
					<?php if ($list_idx === 0): ?>
					<div class="ethnologist-front-page-search-form"><?php get_search_form(); ?></div>
					<h3 class="hometitle ethnologist-hometitle-with-search-form"><?php echo $list['title']; ?></h3>
					<?php else: ?>
					<h3 class="hometitle"><?php echo $list['title']; ?></h3>
					<?php endif; ?>
				</div>
				<?php ethnologist_view( 'page', 'grid', array( 'list' => $list ) ); ?>
			</div><!--.home-blog -->
			<?php endforeach; ?>

		</div><!-- /.main -->
		<?php get_sidebar(); ?>
	</div><!-- /.row-->
</div><!-- /.content -->

</div><!-- /.wrap -->

<script type="text/javascript">
jQuery( document ).load( function( $ ) {
	$( '.ethnologist-grid' ).masonry({
		itemSelector: '.b_item'
	});
});
</script>