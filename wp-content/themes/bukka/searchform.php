<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ) ?>">
	<div id="searchfield">
		<div id="searchsubmit-wrapper"><input type="submit" id="searchsubmit" value="" /></div>
		<div id="searchinput-wrapper"><input type="text" value="<?php the_search_query() ?>" name="s" id="searchinput" /></div>
	</div>
</form>