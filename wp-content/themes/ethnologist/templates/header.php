<?php
global $pinnacle;

if ( isset( $pinnacle['header_height'] ) ) {
	$header_height = $pinnacle['header_height'];
} else {
	$header_height = 90;
}
?>
<header id="kad-banner" class="banner headerclass kad-header-style-basic" role="banner"
	data-pageheaderbg="<?php echo kadence_pagetitle_behind_header() ? '1' : '0'; ?>" data-header-base-height="<?php echo $header_height;?>">

	<?php if (kadence_display_topbar()) : ?>
		<?php get_template_part('templates/header', 'topbar'); ?>
	<?php endif; ?>

	<style type="text/css">
	.kad-header-style-basic #nav-main ul.sf-menu > li > a, .kad-header-style-basic #kad-shrinkheader #mobile-nav-trigger a {
		line-height:<?php echo $header_height;?>px;
	}
	</style>
	<div id="kad-shrinkheader" class="container"
		style="height:<?php echo $header_height;?>px; line-height:<?php echo $header_height;?>px;">

		<div class="row">
			<div class="col-md-3 col-sm-8 col-ss-9 clearfix kad-header-left">
				<div id="logo" class="logocase">
					<a class="brand logofont"
							tyle="height:<?php echo $header_height;?>px; line-height:<?php echo $header_height;?>px; display:block;"
							href="<?php echo home_url(); ?>/">
						<?php if ( ! empty( $pinnacle['x1_logo_upload']['url'] ) ): ?>
						<div id="thelogo" style="height:<?php echo $header_height;?>px; line-height:<?php echo $header_height;?>px;">
							<img src="<?php echo $pinnacle['x1_logo_upload']['url']; ?>" alt="<?php  bloginfo('name');?>"
									style="max-height:<?php echo $header_height;?>px" class="kad-standard-logo" />
							<?php if ( ! empty( $pinnacle['x2_logo_upload']['url'] ) ): ?>
							<img src="<?php echo $pinnacle['x2_logo_upload']['url'];?>" class="kad-retina-logo"
									style="max-height:<?php echo $header_height;?>px; max-width:<?php echo $pinnacle['x1_logo_upload']['width'];?>px" />
							<?php endif; ?>
							<?php if ( ! empty( $pinnacle['th_x1_logo_upload']['url'] ) ): ?>
							<img src="<?php echo $pinnacle['th_x1_logo_upload']['url']; ?>" alt="<?php  bloginfo('name');?>"
									style="max-height:<?php echo $header_height;?>px" class="kad-standard-logo-tranbg" />
							<?php endif; ?>
							<?php if ( ! empty( $pinnacle['th_x2_logo_upload']['url'] ) ): ?>
							<img src="<?php echo $pinnacle['th_x2_logo_upload']['url'];?>" class="kad-retina-logo-tranbg"
									style="max-height:<?php echo $header_height;?>px; max-width:<?php echo $pinnacle['th_x1_logo_upload']['width'];?>px" />
							<?php endif; ?>
						</div>
						<?php else: ?>
						<?php bloginfo('name'); ?>
						<?php endif; ?>
					</a>
				</div> <!-- Close #logo -->
			</div><!-- close col -->
			<div class="col-md-9 col-sm-4 col-ss-3 kad-header-right">
				<?php if ( has_nav_menu( 'primary_navigation' ) ) : ?>
				<nav id="nav-main" class="clearfix kad-primary-nav" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary_navigation', 'menu_class' => 'sf-menu' ) );?>
				</nav>
				<div id="mobile-nav-trigger" class="nav-trigger">
					<a class="nav-trigger-case collapsed" data-toggle="collapse" rel="nofollow" data-target=".mobile_menu_collapse">
						<div class="kad-navbtn mobileclass clearfix"><i class="icon-reorder"></i></div>
					</a>
				</div>
				<?php  else : ?>
				<nav id="nav-main" class="clearfix kad-primary-nav" role="navigation">
					<ul class="sf-menu">
						<li><a href="#"><?php _e('No menu assigned', 'pinnacle');?></a></li>
					</ul>
				</nav>
	           <?php endif; ?>
			</div> <!-- Close col -->
		</div> <!-- Close Row -->
	</div> <!-- Close Container -->
	<?php if ( has_nav_menu( 'primary_navigation' ) ): ?>
 	<div class="container">
		<div id="kad-mobile-nav" class="kad-mobile-nav">
			<div class="kad-nav-inner mobileclass">
				<div id="mobile_menu_collapse" class="kad-nav-collapse collapse mobile_menu_collapse">
					<?php if ( isset( $pinnacle['menu_search'] ) && $pinnacle['menu_search'] == '1') get_search_form(); ?>
					<?php wp_nav_menu( array('theme_location' => 'primary_navigation','items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'menu_class' => 'kad-mnav')); ?>
				</div>
			</div>
		</div>
	</div> <!-- Close Container -->
 	<?php  endif; ?>
</header>