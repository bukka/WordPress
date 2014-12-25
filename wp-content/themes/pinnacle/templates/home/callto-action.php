<?php global $pinnacle; 
?>
<div class="home_calltoaction home-margin clearfix home-padding">
<div class="kt-home-call-to-action panel-row-style-wide-feature">
	<div class="container">
		<div class="kt-cta">
			<div class="col-md-10 kad-call-title-case">
				<h1 class="kad-call-title"><?php if(isset($pinnacle['home_action_text'])) echo $pinnacle['home_action_text'];?></h1>
			</div>
			<div class="col-md-2 kad-call-button-case">
			<a href="<?php if(isset($pinnacle['home_action_link'])) echo esc_attr($pinnacle['home_action_link']);?>" class="kad-btn-primary kad-btn lg-kad-btn"><?php if(isset($pinnacle['home_action_text_btn'])) echo $pinnacle['home_action_text_btn'];?></a>   	
			</div>
		</div>
	</div><!--container-->
</div><!--call class-->
</div>