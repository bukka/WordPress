<div class="kadence_social_widget clearfix">

<?php foreach ($params['types'] as $type_ident => $type_name): ?>
<?php   if ( ! empty( $params['instance'][$type_ident] ) ): ?>
	<a href="<?php echo esc_url( $params['instance'][$type_ident] ); ?>" class="<?php echo $type_ident; ?>_link"
		title="<?php echo $type_name ?>" target="_blank" data-toggle="tooltip" data-placement="top"
		data-original-title="<?php echo $type_name ?>">
			<i class="icon-<?php echo $type_ident === 'googleplus' ? 'google-plus' : $type_ident; ?>"></i>
	</a>
<?php   endif;?>
<?php endforeach; ?>

</div>
