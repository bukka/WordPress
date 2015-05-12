<div id="pageheader" class="<?php echo $params['title_class']; ?>">
	<div class="header-color-overlay"></div>
	<div class="container">
		<?php if ( $params['show_page_header'] ): ?>
		<div class="page-header">
			<div class="row">
				<div class="col-md-12">
					<h1 class="kad-page-title"><?php ethnologist_title(); ?></h1>
					<?php ethnologist_subtitle() ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div><!--container-->
</div><!--titleclass-->