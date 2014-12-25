<?php $icons = array(
    array('icon_o' => 'icon-pencil', 'link' => '', 'title' => 'Clean Design', 'url' => '', 'description' => 'Phasellus varius, risus et cursus imperdiet, sapien velit condimentum nisl, ut imperdiet magna elit lacinia quam. Duis ornare eleifend felis quis consectetur. Quisque lorem sapien, vulputate eget consequat sit amet.'),
    array('icon_o' => 'icon-mobile-phone', 'link' => '', 'title' => 'Responsive', 'url' => '', 'description' => 'Phasellus varius, risus et cursus imperdiet, sapien velit condimentum nisl, ut imperdiet magna elit lacinia quam. Duis ornare eleifend felis quis consectetur. Quisque lorem sapien, vulputate eget consequat sit amet.'),
    array('icon_o' => 'icon-cogs', 'link' => '', 'title' => 'Tons of Options', 'url' => '', 'description' => 'Phasellus varius, risus et cursus imperdiet, sapien velit condimentum nisl, ut imperdiet magna elit lacinia quam. Duis ornare eleifend felis quis consectetur. Quisque lorem sapien, vulputate eget consequat sit amet.'),
    array('icon_o' => 'icon-shopping-cart', 'link' => '', 'title' => 'Ecommerce', 'url' => '', 'description' => 'Phasellus varius, risus et cursus imperdiet, sapien velit condimentum nisl, ut imperdiet magna elit lacinia quam. Duis ornare eleifend felis quis consectetur. Quisque lorem sapien, vulputate eget consequat sit amet.'),
    ); 
    $itemsize = 'tcol-lg-3 tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12';
    $iconbtn = '';                  
    ?>
                <div class="home-margin home-padding">
                	<div class="rowtight homepromo">
                    <?php $counter = 1;?>
                        <?php foreach ($icons as $icon) : ?>
                        <?php if(!empty($icon['target']) && $icon['target'] == 1) {$target = '_blank';} else {$target = '_self';} ?>
                            <div class="<?php echo $itemsize;?> home-iconmenu <?php echo 'homeitemcount'.$counter;?>">
                                <?php if(!empty($icon['link'])) {?> 
	                            <a href="<?php echo $icon['link']; ?>" target="<?php echo $target; ?>"  title="<?php echo esc_attr($icon['title']); ?>" class="home-icon-item">
                               <?php } else { ?>
                                <div class="home-icon-item">
                                <?php } 
	                           if(!empty($icon['url'])) echo '<i><img src="'.esc_attr($icon['url']).'"/></i>' ; else echo '<i class="'.$icon['icon_o'].'"></i>'; 
	                            if ($icon['title'] != '') echo '<h4>'.$icon['title'].'</h4>'; 
                                if (!empty($icon['description'])) echo '<p>'.$icon['description'].'</p>'; 
                                 if(!empty($iconbtn)) echo '<div class="kad-btn sm-kad-btn kad-btn-primary">'.$iconbtn.'</div>';
                                if(!empty($icon['link'])) {?> 
	                            </a>
                                 <?php } else { ?>
                                </div>
                                <?php } ?>
                            </div>
                             <?php $counter ++ ?>
                        <?php endforeach; ?>

                    </div> <!--homepromo -->
                </div>