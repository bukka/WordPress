<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/<?php echo $params['lang']; ?>/sdk.js#xfbml=1&version=v10.0&appId=<?php echo $params['api_id']; ?>&autoLogAppEvents=1"
        nonce="FOKrbAYI">
</script>

<div class="fb-like"
	data-href="<?php echo $params['href']; ?>"
	data-layout="<?php echo $params['layout']; ?>"
	data-action="like"
	data-share="<?php echo $params['share'] ? 'true' : 'false'; ?>"
	data-show-faces="<?php echo $params['show-faces'] ? 'true' : 'false'; ?>">
</div>