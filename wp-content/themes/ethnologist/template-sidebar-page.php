<?php
/*
Template Name: Ethnologist Sidebar Page
*/

get_header();
get_template_part( 'templates/page', 'header' );
?>
<div id="content" class="container">
	<div class="row">
		<div class="main <?php echo ethnologist_main_class(); ?>" role="main">
			<div class="postclass pageclass clearfix">
				<?php get_template_part( 'templates/content', 'page' ); ?>
			</div>
		</div><!-- /.main -->
		<?php get_sidebar(); ?>
	</div><!-- /.row-->
</div><!-- /.content -->

</div><!-- /.wrap -->
<?php get_footer(); ?>