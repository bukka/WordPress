<div id="content" class="container homepagecontent">
	<div class="row">
		<div class="main <?php echo ethnologist_main_class(); ?>" role="main">

			<div class="home_blog home-margin clearfix home-padding">
				<?php ethnologist_view( 'page', 'grid', $params ); ?>
			</div><!--.home-blog -->

		</div><!-- /.main -->
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