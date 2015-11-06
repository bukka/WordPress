<?php get_header(); ?>
<?php get_template_part('templates/page', 'header'); ?>

<div id="content" class="container">
	<div class="row">
		<div class="main <?php echo ethnologist_main_class(); ?> kad_404_page" role="main">
			<h4 class="sectiontitle"><?php pll_e( 'Sorry, but the page you were trying to view does not exist.' ); ?></h4>

			<p><?php pll_e('It looks like this was the result of either:' ); ?></p>
			<ul>
				<li><?php pll_e( 'a mistyped address' ); ?></li>
				<li><?php pll_e( 'an out-of-date link' ); ?></li>
				<li><?php pll_e( 'incorrect permalink settings' ); ?></li>
			</ul>
			<p><?php pll_e( "You can return back to the site's homepage and see if you can " .
							"find what you are looking for or use the search form below." ); ?></p>
			<div class="search_form_404"><?php get_search_form(); ?></div>
		</div>
	<?php get_sidebar(); ?>
	</div><!-- /.row-->
</div><!-- /.content -->

</div><!-- /.wrap -->
<?php get_footer(); ?>