<?php
if ( get_the_category() ): ?>
<span class="postedinbottom"><i class="icon-folder-close"></i> <?php the_category( ', ' ) ?></span>
<?php endif; ?>
<?php if ( get_the_tags() ): ?>
<span class="posttags color_gray"><i class="icon-tag"></i> <?php the_tags( '', ', ', '' ); ?> </span>
<?php endif; ?>