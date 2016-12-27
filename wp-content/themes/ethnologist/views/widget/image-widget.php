<div class="kad_img_upload_widget">
	<?php if ( $params['uselink'] ): ?>
	<a href="<?php echo $params['link']; ?>" <?php echo $params['link_type']; ?>>
		<img style="width: 50%"  src="<?php echo $params['image_href']; ?>" />
	</a>
	<?php else: ?>
	<img style="width: 50%" src="<?php echo $params['image_href']; ?>" />
	<?php endif; ?>
	<?php if( ! empty( $params['text'] ) ): ?>
	<p class="kadence_image_widget_caption"><?php echo $params['text']; ?></p>
	<?php endif; ?>
</div>