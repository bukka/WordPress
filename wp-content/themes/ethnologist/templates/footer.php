<?php global $pinnacle; ?>
<footer id="containerfooter" class="footerclass" role="contentinfo">
	<div class="container">
		<div class="row">
			<?php if ( is_active_sidebar( 'footer_1' ) ): ?>
			<div class="col-md-4 col-sm-6 footercol1">
				<?php dynamic_sidebar( 'footer_1' ); ?>
			</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer_1' ) ): ?>
			<div class="col-md-4 col-sm-6 footercol2">
				<?php dynamic_sidebar( 'footer_2' ); ?>
			</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer_1' ) ): ?>
			<div class="col-md-4 col-sm-6 footercol3">
				<?php dynamic_sidebar( 'footer_3' ); ?>
			</div>
			<?php endif; ?>
			<!--
			<?php if ( is_active_sidebar( 'footer_4' ) ): ?>
			<div class="col-md-3 col-sm-6 footercol4">
				<?php dynamic_sidebar('footer_4'); ?>
			</div>
			<?php endif; ?>
			-->
		</div> <!-- Row -->
		<div class="footercredits clearfix">
			<?php if ( has_nav_menu( 'footer_navigation' ) ): ?>
			<div class="footernav clearfix">
				<?php wp_nav_menu( array( 'theme_location' => 'footer_navigation', 'menu_class' => 'footermenu' ) ); ?>
			</div>
			<?php endif; ?>
        	<p>&copy; <?php echo date('Y'); ?> Ethnologist</p>
    	</div><!-- credits -->
    </div><!-- container -->
</footer>

<?php wp_footer(); ?>
