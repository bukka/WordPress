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