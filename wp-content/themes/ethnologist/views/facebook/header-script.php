<meta property="og:url"           content="<?php echo $params['url']; ?>" />
<meta property="og:type"          content="<?php echo $params['type']; ?>" />
<meta property="og:title"         content="<?php echo $params['title']; ?>" />
<?php if ( isset( $params['description'] ) ): ?>
<meta property="og:description"   content="<?php echo $params['description']; ?>" />
<?php endif; ?>
<?php if ( isset( $params['image']) ): ?>
<meta property="og:image"         content="<?php echo $params['image']; ?>" />
<?php endif; ?>

<script>
jQuery( document ).ready( function( $ ) {
	$.ajaxSetup({ cache: true });
	$.getScript( '//connect.facebook.net/<?php echo $params['lang']; ?>/sdk.js', function() {
		FB.init({
			appId: '<?php echo $params['api_id']; ?>',
			version: 'v2.5',
			xfbml: true
		});
	});
});
</script>