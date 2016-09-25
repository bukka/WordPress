<?php if ( ethnologist_display_sidebar() ) : ?>
	<aside class="<?php echo ethnologist_sidebar_class(); ?>" role="complementary">
		<div class="sidebar">
			<?php dynamic_sidebar( 'sidebar-primary' ); ?>
			<h5 class="widget-title"><?php pll_e( 'Categories' ); ?></h5>
			<?php wp_tag_cloud(['taxonomy' => 'category']); ?>
		</div><!-- /.sidebar -->
	</aside><!-- /aside -->
<?php endif; ?>