<?php

function kad_content_clean_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'kad_content_clean_shortcodes');
function kad_widget_clean_shortcodes($text){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        '<p></p>' => '', 
        ']<br />' => ']'
    );
    $text = strtr($text, $array);
    return $text;
}
add_filter('widget_text', 'kad_widget_clean_shortcodes');
add_filter('widget_text', 'do_shortcode', 50);

