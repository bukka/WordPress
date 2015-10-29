<?php get_header(); ?>

<?php if (ethnologist_is_mobile()): ?>
	<?php get_template_part('templates/mobile_home/page-title', 'mhome'); ?>
<?php else: ?>
	<?php get_template_part('templates/home/page-title', 'home'); ?>
<?php endif; ?>

<div id="content" class="container homepagecontent">
	<div class="row">
		<div class="main <?php echo ethnologist_main_class(); ?>" role="main">

			<?php get_template_part('templates/home/blog', 'home'); ?>

		</div><!-- /.main -->
		<?php get_sidebar(); ?>
	</div><!-- /.row-->
</div><!-- /.content -->

</div><!-- /.wrap -->
<?php get_footer(); ?>