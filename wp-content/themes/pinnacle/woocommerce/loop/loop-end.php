<?php
/**
 * Product Loop End
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $woocommerce, $woocommerce_loop, $pinnacle_premium;
if(isset($pinnacle_premium['infinitescroll']) && $pinnacle_premium['infinitescroll'] == 1) {
	$infinitescroll = true;
} else {
	$infinitescroll = false;
}
?>
</div>
	<script type="text/javascript">jQuery( window ).load(function () {var $container = jQuery('.kad_product_wrapper');$container.masonry({itemSelector: '.kad_product'});});</script>