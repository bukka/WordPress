<div class="sliderclass carousel_outerrim">
  <?php  global $pinnacle; 
         if(isset($pinnacle['slider_size'])) {$slideheight = $pinnacle['slider_size'];} else { $slideheight = 400; }
         if(isset($pinnacle['slider_size_width'])) {$slidewidth = $pinnacle['slider_size_width'];} else { $slidewidth = 1140; }
        if(isset($pinnacle['slider_captions'])) { $captions = $pinnacle['slider_captions']; } else {$captions = '';}
        if(isset($pinnacle['home_slider'])) {$slides = $pinnacle['home_slider']; } else {$slides = '';}
                ?>
  <div id="imageslider" class="loading">
    <div class="carousel_slider_outer fredcarousel fadein-carousel" style="overflow:hidden; max-width:<?php echo $slidewidth;?>px; height: <?php echo $slideheight;?>px; margin-left: auto; margin-right:auto;">
        <div class="carousel_slider">
            <?php foreach ($slides as $slide) : 
            if(!empty($slide['target']) && $slide['target'] == 1) {$target = '_blank';} else {$target = '_self';} 
                    $image = aq_resize($slide['url'], null, $slideheight, false, false);
                    if(empty($image)) {$image = array($slide['url'],$slidewidth,$slideheight);} 
                        echo '<div class="carousel_gallery_item" style="float:left; display: table; position: relative; text-align: center; margin: 0; width:auto; height:'.$image[2].'px;">';
                        echo '<div class="carousel_gallery_item_inner" style="vertical-align: middle; display: table-cell;">';
                        if($slide['link'] != '') echo '<a href="'.esc_attr($slide['link']).'" target="'.$target.'">';
                        echo '<img src="'.esc_attr($image[0]).'" width="'.esc_attr($image[1]).'" height="'.esc_attr($image[2]).'" />';
                        if ($captions == '1') { ?> 
                                <div class="flex-caption">
                                <?php if ($slide['title'] != '') echo '<div class="captiontitle headerfont">'.$slide['title'].'</div>'; ?>
                                <?php if ($slide['description'] != '') echo '<div><div class="captiontext headerfont"><p>'.$slide['description'].'</p></div></div>';?>
                                </div> 
                        <?php } ?>
                        <?php if($slide['link'] != '') echo '</a>'; ?>
                      </div>
                    </div>
                  <?php endforeach; ?>
            </div>
            <div class="clearfix"></div>
              <a id="prevport_carouselslider" class="prev_carousel icon-angle-left" href="#"></a>
              <a id="nextport_carouselslider" class="next_carousel icon-angle-right" href="#"></a>
          </div> <!--fredcarousel-->
  </div><!--Container-->
</div><!--sliderclass-->

      <?php 
          if(isset($pinnacle['slider_autoplay']) && $pinnacle['slider_autoplay'] == 0) {$autoplay = 'false';} else {$autoplay = 'true';}
          if(isset($pinnacle['slider_pausetime'])) {$pausetime = $pinnacle['slider_pausetime'];} else {$pausetime = '7000';}
      ?>
     <script type="text/javascript">
                jQuery( window ).load(function () {
                    var $wcontainer = jQuery('.carousel_slider_outer');
                    var $container = jQuery('.carousel_slider_outer .carousel_slider');
                      var align = 'center';
                      var carheight = <?php echo $slideheight; ?>;
                      function setWidths() {
                            var unitWidth = $container.width();
                            $container.children().css({ width: unitWidth });
                            if(jQuery(window).width() <= 768) {
                            carheight = null;
                            $container.children().css({ height: 'auto' });
                          }
                        }
                          function iniCarousel_slider() {
                            $container.carouFredSel({
                              width: '100%',
                              height: carheight,
                              align: align,
                              auto: {play: <?php echo $autoplay; ?>, timeoutDuration: <?php echo $pausetime; ?>},
                              scroll: {items : 1,easing: 'quadratic'},
                              items: {visible: 1,width: 'variable'},
                              prev: '.carousel_slider_outer .prev_carousel',
                              next: '.carousel_slider_outer .next_carousel',
                              swipe: {onMouse: false,onTouch: true},
                              });
                            }
                            setWidths();
                            iniCarousel_slider();
                            jQuery(window).on("debouncedresize", function( event ) {
                            $container.trigger("destroy");
                            setWidths();
                            iniCarousel_slider();
                            });
                          $wcontainer.animate({'opacity' : 1});
                          $wcontainer.css({ height: 'auto' });
                          $wcontainer.parent().removeClass('loading');
                });
              </script>                            
            